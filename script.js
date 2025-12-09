// ---------- Helpers ----------
const $ = s => document.querySelector(s);
const $$ = s => document.querySelectorAll(s);

// Smooth continuous autoscroll
let _autoRaf = null;
let _autoSpeed = 0.6;
let _autoScrollActive = false;

function startAutoScroll(){
  if(_autoRaf) return;
  _autoScrollActive = true;
  function step(){
    const max = document.documentElement.scrollHeight - window.innerHeight;
    if(window.scrollY >= max - 1){ stopAutoScroll(); return; }
    window.scrollBy(0, _autoSpeed);
    _autoRaf = requestAnimationFrame(step);
  }
  _autoRaf = requestAnimationFrame(step);
}

function stopAutoScroll(){
  if(_autoRaf){ cancelAnimationFrame(_autoRaf); _autoRaf = null; }
  _autoScrollActive = false;
}

// Stop autoscroll on user interaction
function attachStopOnUser(){
  const stopOnUser = () => { if(_autoScrollActive) stopAutoScroll(); };
  ['wheel','mousedown','touchstart'].forEach(evt => window.addEventListener(evt, stopOnUser, {passive:true}));
}

// ---------- DOMContentLoaded ----------
document.addEventListener('DOMContentLoaded', ()=>{

  attachStopOnUser();

  const cover = $('#cover');
  const page = $('#page');
  const bgmusic = $('#bgmusic');
  const openBtn = $('#openInvite');

  // Open invitation
  openBtn?.addEventListener('click', ()=>{
    if(cover) cover.style.opacity = '0';
    setTimeout(()=>{
      if(cover) cover.style.display = 'none';
      if(page) page.style.display = 'block';
      if(bgmusic) bgmusic.play().catch(()=>{});

      setTimeout(()=>{
        const hero = $('#hero');
        if(hero) hero.scrollIntoView({behavior:'smooth'});
        setTimeout(()=>{ startAutoScroll(); }, 800);
      }, 80);

    }, 600);
  });

  // Parallax
  window.addEventListener('scroll', ()=>{
    const sc = window.scrollY;
    const la = document.querySelector('.layer-a');
    const lb = document.querySelector('.layer-b');
    if(la) la.style.transform = `translateY(${sc*0.14}px)`;
    if(lb) lb.style.transform = `translateY(${sc*0.22}px)`;
  });

  // Fade-in
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{ if(e.isIntersecting) e.target.classList.add('inview'); });
  },{threshold:0.15});
  $$('.fade, .timeline-item').forEach(el=>io.observe(el));

  // Gallery lightbox
  const gallery = $('#galleryInner');
  const lightbox = $('#lightbox');
  const lbImg = $('#lbImg');
  const lbClose = $('#lbClose');
  if(gallery){
    gallery.addEventListener('click', e=>{
      const img = e.target.closest('img'); if(!img) return;
      if(lbImg) lbImg.src = img.src;
      if(lightbox) lightbox.style.display = 'flex';
      stopAutoScroll();
      $('#autoScrollToggle')?.classList.remove('bm-active');
      $('#autoI').textContent='⤓';
    });
  }
  lbClose?.addEventListener('click', ()=>{ if(lightbox) lightbox.style.display='none'; });
  lightbox?.addEventListener('click', (e)=>{ if(e.target===lightbox) lightbox.style.display='none'; });

  // Bottom menu
  const bottomMenu = $('#bottomMenu');
  bottomMenu?.addEventListener('click', (e)=>{
    const item = e.target.closest('.bm-item'); if(!item) return;
    const to = item.getAttribute('data-to');
    if(to){
      const el = document.querySelector(to);
      if(el) el.scrollIntoView({behavior:'smooth'});
      $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
      item.classList.add('bm-active');
    }
  });

  // Auto-scroll toggle
  let autoScroll = false;
  const autoBtn = $('#autoScrollToggle');
  const autoI = $('#autoI');
  autoBtn?.addEventListener('click', ()=>{
    autoScroll = !autoScroll;
    if(autoScroll){
      startAutoScroll();
      autoI.textContent = '⏸';
      autoBtn.classList.add('bm-active');
    } else {
      stopAutoScroll();
      autoI.textContent = '⤓';
      autoBtn.classList.remove('bm-active');
    }
  });

  // Music toggle
  const musicBtn = $('#musicToggle');
  const musicI = $('#musicI');
  musicBtn?.addEventListener('click', ()=>{
    if(!bgmusic) return;
    if(bgmusic.paused){ bgmusic.play().catch(()=>{}); musicI.textContent='♪'; musicBtn.classList.add('bm-active'); }
    else { bgmusic.pause(); musicI.textContent='♫'; musicBtn.classList.remove('bm-active'); }
  });

  // RSVP + Doa (localStorage + paging dummy)
  const rsvpForm = $('#rsvpForm');
  const rsvpList = $('#rsvpList');
  const itemsPerPage = 3;
  let currentPage = 1;

  function escapeHtml(s){ return (s||'').toString().replace(/&/g,'&amp;').replace(/</g,'&lt;'); }

  function loadRsvp(page=1){
    if(!rsvpList) return;
    const data = JSON.parse(localStorage.getItem('rsvps')||'[]');
    const start = (page-1)*itemsPerPage;
    const paged = data.slice(start, start+itemsPerPage);
    rsvpList.innerHTML = paged.map(d=>`
      <div style="padding:8px;border-bottom:1px solid #eee">
        <b>${escapeHtml(d.name)}</b> — ${escapeHtml(d.attend)}
        <div class="small-muted">${escapeHtml(d.phone||'')} ${escapeHtml(d.message||'')}</div>
      </div>
    `).join('');
    if(data.length > itemsPerPage){
      let pagination = '<div style="margin-top:8px;text-align:center;">';
      const totalPages = Math.ceil(data.length/itemsPerPage);
      for(let i=1;i<=totalPages;i++){
        pagination += `<button class="page-btn" data-page="${i}" style="margin:0 2px;padding:2px 6px;border-radius:4px;border:1px solid #ccc;background:${i===page?'var(--accent)':'#fff'};color:${i===page?'#fff':'#000'};cursor:pointer;">${i}</button>`;
      }
      pagination += '</div>';
      rsvpList.innerHTML += pagination;
      rsvpList.querySelectorAll('.page-btn').forEach(btn=>{
        btn.addEventListener('click', e=>{
          currentPage = parseInt(btn.dataset.page);
          loadRsvp(currentPage);
        });
      });
    }
  }

  if(rsvpForm){
    rsvpForm.addEventListener('submit', (e)=>{
      e.preventDefault();
      const name = $('#r_name').value.trim();
      const phone = $('#r_phone').value.trim();
      const attend = $('#r_attend').value;
      const message = $('#r_message').value.trim();
      if(!name) return alert('Isi nama');
      const arr = JSON.parse(localStorage.getItem('rsvps')||'[]');
      const item = {name,phone,attend,message,created:(new Date()).toISOString()};
      arr.push(item); localStorage.setItem('rsvps', JSON.stringify(arr));
      currentPage = Math.ceil(arr.length/itemsPerPage);
      loadRsvp(currentPage);
      alert('Terima kasih, konfirmasi Anda tersimpan.');
      rsvpForm.reset();
    });
    loadRsvp();
  }

  // Initial active menu & kpd param
  $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
  const homeBtn = document.querySelector('.bm-item[data-to="#hero"]');
  if(homeBtn) homeBtn.classList.add('bm-active');

  const params = new URLSearchParams(location.search);
  if(params.get('kpd')){
    const k = params.get('kpd'); const el = $('#kpdName'); if(el) el.textContent = k;
  }

});
