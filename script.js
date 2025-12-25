// ---------- Helpers ----------
const $  = s => document.querySelector(s);
const $$ = s => document.querySelectorAll(s);

// ---------- Smooth continuous autoscroll ----------
let _autoRaf = null;
let _autoSpeed = 0.4;
let _autoScrollActive = false;

function startAutoScroll(){
  if(_autoRaf) return;
  _autoScrollActive = true;

  function step(){
    const max = document.documentElement.scrollHeight - window.innerHeight;
    if(window.scrollY >= max - 1){
      stopAutoScroll();
      return;
    }
    window.scrollBy(0, _autoSpeed);
    _autoRaf = requestAnimationFrame(step);
  }
  _autoRaf = requestAnimationFrame(step);
}

function stopAutoScroll(){
  if(_autoRaf){
    cancelAnimationFrame(_autoRaf);
    _autoRaf = null;
  }
  _autoScrollActive = false;
}

// Stop autoscroll on user interaction
function attachStopOnUser(){
  const stopOnUser = () => {
    if(_autoScrollActive) stopAutoScroll();
  };
  ['wheel','mousedown','touchstart'].forEach(evt =>
    window.addEventListener(evt, stopOnUser, { passive:true })
  );
}

// ---------- DOMContentLoaded ----------
document.addEventListener('DOMContentLoaded', ()=>{

  attachStopOnUser();

  const cover   = $('#cover');
  const page    = $('#page');
  const bgmusic = $('#bgmusic');
  const openBtn = $('#openInvite');

  /* ---------- OPEN INVITATION ---------- */
  openBtn?.addEventListener('click', ()=>{
    if(cover) cover.style.opacity = '0';

    setTimeout(()=>{
      if(cover) cover.style.display = 'none';
      if(page) page.style.display = 'block';
      if(bgmusic) bgmusic.play().catch(()=>{});

      setTimeout(()=>{
        const hero = $('#hero');
        if(hero) hero.scrollIntoView({ behavior:'smooth' });
        setTimeout(()=> startAutoScroll(), 800);
      }, 80);

    }, 600);
  });

  /* ---------- PARALLAX HERO ---------- */
  window.addEventListener('scroll', ()=>{
    const sc = window.scrollY;
    const la = $('.layer-a');
    const lb = $('.layer-b');
    if(la) la.style.transform = `translateY(${sc * 0.14}px)`;
    if(lb) lb.style.transform = `translateY(${sc * 0.22}px)`;
  });

  /* ---------- FADE IN + TIMELINE ---------- */
  const io = new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(e.isIntersecting) e.target.classList.add('inview');
    });
  }, { threshold:0.15 });

  $$('.fade, .timeline-item').forEach(el => io.observe(el));

  /* ---------- GALLERY LIGHTBOX ---------- */
  const gallery  = $('#galleryInner');
  const lightbox = $('#lightbox');
  const lbImg    = $('#lbImg');
  const lbClose  = $('#lbClose');

  gallery?.addEventListener('click', e=>{
    const img = e.target.closest('img');
    if(!img) return;

    lbImg.src = img.src;
    lightbox.style.display = 'flex';

    stopAutoScroll();
    $('#autoScrollToggle')?.classList.remove('bm-active');
    $('#autoI').textContent = '⤓';
  });

  lbClose?.addEventListener('click', ()=> lightbox.style.display='none');
  lightbox?.addEventListener('click', e=>{
    if(e.target === lightbox) lightbox.style.display='none';
  });

  /* ---------- BOTTOM MENU ---------- */
  const bottomMenu = $('#bottomMenu');
  bottomMenu?.addEventListener('click', e=>{
    const item = e.target.closest('.bm-item');
    if(!item) return;

    const to = item.getAttribute('data-to');
    if(to){
      const el = $(to);
      if(el) el.scrollIntoView({ behavior:'smooth' });

      $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
      item.classList.add('bm-active');
    }
  });

  /* ---------- AUTO SCROLL TOGGLE ---------- */
  let autoScroll = false;
  const autoBtn = $('#autoScrollToggle');
  const autoI   = $('#autoI');

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

  /* ---------- MUSIC TOGGLE ---------- */
  const musicBtn = $('#musicToggle');
  const musicI   = $('#musicI');

  musicBtn?.addEventListener('click', ()=>{
    if(!bgmusic) return;
    if(bgmusic.paused){
      bgmusic.play().catch(()=>{});
      musicI.textContent = '♪';
      musicBtn.classList.add('bm-active');
    } else {
      bgmusic.pause();
      musicI.textContent = '♫';
      musicBtn.classList.remove('bm-active');
    }
  });

  /* ---------- RSVP (localStorage + paging) ---------- */
  const rsvpForm = $('#rsvpForm');
  const rsvpList = $('#rsvpList');
  const itemsPerPage = 3;

  function escapeHtml(s){
    return (s||'').toString()
      .replace(/&/g,'&amp;')
      .replace(/</g,'&lt;');
  }

  function loadRsvp(page=1){
    const data = JSON.parse(localStorage.getItem('rsvps') || '[]');
    const start = (page-1)*itemsPerPage;
    const paged = data.slice(start, start+itemsPerPage);

    rsvpList.innerHTML = paged.map(d=>`
      <div style="padding:8px;border-bottom:1px solid #eee">
        <b>${escapeHtml(d.name)}</b> — ${escapeHtml(d.attend)}
        <div class="small-muted">
          ${escapeHtml(d.phone||'')} ${escapeHtml(d.message||'')}
        </div>
      </div>
    `).join('');

    if(data.length > itemsPerPage){
      let nav = '<div style="text-align:center;margin-top:8px">';
      const total = Math.ceil(data.length/itemsPerPage);
      for(let i=1;i<=total;i++){
        nav += `<button data-page="${i}"
          style="margin:2px;padding:3px 8px;border-radius:4px;
          border:1px solid #ccc;
          background:${i===page?'var(--accent)':'#fff'};
          color:${i===page?'#fff':'#000'}">${i}</button>`;
      }
      nav += '</div>';
      rsvpList.innerHTML += nav;

      rsvpList.querySelectorAll('button').forEach(btn=>{
        btn.onclick = ()=> loadRsvp(+btn.dataset.page);
      });
    }
  }

  rsvpForm?.addEventListener('submit', e=>{
    e.preventDefault();
    const name = $('#r_name').value.trim();
    if(!name) return alert('Isi nama');

    const arr = JSON.parse(localStorage.getItem('rsvps') || '[]');
    arr.push({
      name,
      phone: $('#r_phone').value.trim(),
      attend: $('#r_attend').value,
      message: $('#r_message').value.trim(),
      created: new Date().toISOString()
    });

    localStorage.setItem('rsvps', JSON.stringify(arr));
    loadRsvp(Math.ceil(arr.length/itemsPerPage));
    alert('Terima kasih, konfirmasi Anda tersimpan.');
    rsvpForm.reset();
  });

  loadRsvp();

  /* ---------- PARAM ?kpd= ---------- */
  const params = new URLSearchParams(location.search);
  if(params.get('kpd')){
    const el = $('#kpdName');
    if(el) el.textContent = params.get('kpd');
  }

  /* ================= COUNTDOWN (FIXED & SAFE) ================= */
  document.querySelectorAll('.countdown').forEach(cd=>{
    const raw = cd.dataset.date; // contoh: 2025-12-07 09:00
    if(!raw) return;

    // Paksa timezone WITA (+08:00)
    const targetTime = new Date(raw.replace(' ', 'T') + '+08:00').getTime();

    const dEl = cd.querySelector('.cd-days');
    const hEl = cd.querySelector('.cd-hours');
    const mEl = cd.querySelector('.cd-minutes');
    const sEl = cd.querySelector('.cd-seconds');

    function tick(){
      const now = Date.now();
      let diff = targetTime - now;

      if(diff <= 0){
        dEl.textContent =
        hEl.textContent =
        mEl.textContent =
        sEl.textContent = '00';
        return;
      }

      dEl.textContent = Math.floor(diff / 86400000);
      hEl.textContent = String(Math.floor(diff / 3600000 % 24)).padStart(2,'0');
      mEl.textContent = String(Math.floor(diff / 60000 % 60)).padStart(2,'0');
      sEl.textContent = String(Math.floor(diff / 1000 % 60)).padStart(2,'0');
    }

    tick();
    setInterval(tick, 1000);
  });

});
