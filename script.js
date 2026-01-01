// ---------- Helpers ----------
const $  = s => document.querySelector(s);
const $$ = s => document.querySelectorAll(s);

// ===================================================
// AUTOSCROLL (ENGINE & UI TERPISAH)
// ===================================================
let autoScrollTimer = null;
let autoScrollRunning = false;
const AUTO_SCROLL_SPEED = 0.5;

function startAutoScroll(){
  if (autoScrollRunning) return;

  autoScrollRunning = true;
  autoScrollTimer = setInterval(() => {
    const max = document.documentElement.scrollHeight - window.innerHeight;

    if (max <= 0 || window.scrollY >= max - 1){
      stopAutoScroll(false);
      return;
    }

    window.scrollBy(0, AUTO_SCROLL_SPEED);
  }, 16);
}

function stopAutoScroll(resetUI = false){
  if (autoScrollTimer){
    clearInterval(autoScrollTimer);
    autoScrollTimer = null;
  }
  autoScrollRunning = false;

  if (resetUI){
    const autoBtn = $('#autoScrollToggle');
    const autoI   = $('#autoI');
    if (autoBtn && autoI){
      autoBtn.classList.remove('bm-active');
      autoI.textContent = '⤓';
    }
  }
}

// stop autoscroll on user interaction (engine only)
['wheel','touchstart','mousedown'].forEach(evt => {
  window.addEventListener(evt, () => {
    if (autoScrollRunning){
      stopAutoScroll(false);
    }
  }, { passive:true });
});

// ===================================================
// DOM READY
// ===================================================
document.addEventListener('DOMContentLoaded', ()=>{

  const cover   = $('#cover');
  const page    = $('#page');
  const bgmusic = $('#bgmusic');
  const openBtn = $('#openInvite');

  /* ---------- OPEN INVITATION ---------- */
  openBtn?.addEventListener('click', ()=>{
    if (cover) cover.style.opacity = '0';

    setTimeout(()=>{
      if (cover) cover.style.display = 'none';
      if (page) page.style.display = 'block';
      if (bgmusic) bgmusic.play().catch(()=>{});

      const hero = $('#hero');
      if (hero) hero.scrollIntoView({ behavior:'smooth' });

      setTimeout(()=>{
        startAutoScroll();
        const autoBtn = $('#autoScrollToggle');
        const autoI   = $('#autoI');
        if (autoBtn && autoI){
          autoBtn.classList.add('bm-active');
          autoI.textContent = '⏸';
        }
      }, 1200);

    }, 600);
  });

  /* ---------- PARALLAX HERO ---------- */
  window.addEventListener('scroll', ()=>{
    const sc = window.scrollY;
    const la = $('.layer-a');
    const lb = $('.layer-b');
    if (la) la.style.transform = `translateY(${sc * 0.14}px)`;
    if (lb) lb.style.transform = `translateY(${sc * 0.22}px)`;
  });

  /* ---------- FADE IN + TIMELINE ---------- */
  if ('IntersectionObserver' in window){
    const io = new IntersectionObserver(entries=>{
      entries.forEach(e=>{
        if (e.isIntersecting) e.target.classList.add('inview');
      });
    }, { threshold:0.15 });

    $$('.fade, .timeline-item').forEach(el => io.observe(el));
  } else {
    $$('.fade, .timeline-item').forEach(el => el.classList.add('inview'));
  }

  /* ---------- GALLERY LIGHTBOX ---------- */
  const gallery  = $('#galleryInner');
  const lightbox = $('#lightbox');
  const lbImg    = $('#lbImg');
  const lbClose  = $('#lbClose');

  gallery?.addEventListener('click', e=>{
    const img = e.target.closest('img');
    if (!img) return;

    lbImg.src = img.src;
    lightbox.style.display = 'flex';

    stopAutoScroll(false);
  });

  lbClose?.addEventListener('click', ()=> lightbox.style.display='none');
  lightbox?.addEventListener('click', e=>{
    if (e.target === lightbox) lightbox.style.display='none';
  });

  /* ---------- BOTTOM MENU ---------- */
  $('#bottomMenu')?.addEventListener('click', e=>{
    const item = e.target.closest('.bm-item');
    if (!item) return;

    stopAutoScroll(false);

    const to = item.getAttribute('data-to');
    if (to){
      const el = $(to);
      if (el) el.scrollIntoView({ behavior:'smooth' });
    }

    $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
    item.classList.add('bm-active');
  });

  /* ---------- AUTO SCROLL TOGGLE ---------- */
  const autoBtn = $('#autoScrollToggle');
  const autoI   = $('#autoI');

  autoBtn?.addEventListener('click', ()=>{
    if (autoScrollRunning){
      stopAutoScroll(true);
    } else {
      startAutoScroll();
      autoBtn.classList.add('bm-active');
      autoI.textContent = '⏸';
    }
  });

  /* ---------- MUSIC TOGGLE ---------- */
  const musicBtn = $('#musicToggle');
  const musicI   = $('#musicI');

  musicBtn?.addEventListener('click', ()=>{
    if (!bgmusic) return;
    if (bgmusic.paused){
      bgmusic.play().catch(()=>{});
    } else {
      bgmusic.pause();
    }
  });

  // audio-driven UI (ONLY SOURCE OF TRUTH)
  bgmusic?.addEventListener('play', ()=>{
    musicI.textContent = '♪';
    musicBtn.classList.add('bm-active');
  });

  bgmusic?.addEventListener('pause', ()=>{
    musicI.textContent = '♫';
    musicBtn.classList.remove('bm-active');
  });

  /* ---------- RSVP (FILE BASED) ---------- */
const rsvpForm = $('#rsvpForm');

rsvpForm?.addEventListener('submit', e=>{
  e.preventDefault();

  const name    = $('#r_name').value.trim();
  const phone   = $('#r_phone').value.trim();
  const attend  = $('#r_attend').value;
  const message = $('#r_message').value.trim();

  if (!name) return;

  const fd = new FormData();
  fd.append('name', name);
  fd.append('phone', phone);
  fd.append('attend', attend);
  fd.append('message', message);

  fetch('save-rsvp.php', {
    method: 'POST',
    body: fd
  })
  .then(r => r.json())
  .then(res => {
    if (res.status === 'ok'){
      rsvpForm.reset();
      loadLatestRsvp(); // ⬅️ langsung tampil
    }
  });
});
function loadLatestRsvp(){
  fetch('get-rsvp.php')
    .then(r => r.json())
    .then(d => {
      if (!d || !d.name) return;

      const wrap = document.querySelector('.rsvp-list');
      if (!wrap) return;

      const div = document.createElement('div');
      div.className = 'rsvp-item animate-in';
      div.innerHTML = `
        <b>${d.name}</b> — ${d.attend}
        ${d.message ? `<div class="small-muted">${d.message}</div>` : ''}
      `;

      wrap.prepend(div);
    });
}

  /* ---------- PARAM ?kpd= ---------- */
  const params = new URLSearchParams(window.location.search);
  const kpdVal = params.get('kpd');
  if (kpdVal){
    const kpd = $('#kpdName');
    if (kpd) kpd.textContent = kpdVal;
  }

  /* ---------- COUNTDOWN ---------- */
  document.querySelectorAll('.countdown').forEach(cd=>{
    const raw = cd.dataset.date;
    if (!raw) return;

    const targetTime = new Date(raw.replace(' ', 'T') + '+08:00').getTime();
    const dEl = cd.querySelector('.cd-days');
    const hEl = cd.querySelector('.cd-hours');
    const mEl = cd.querySelector('.cd-minutes');
    const sEl = cd.querySelector('.cd-seconds');

    function tick(){
      let diff = targetTime - Date.now();
      if (diff <= 0){
        dEl.textContent = hEl.textContent =
        mEl.textContent = sEl.textContent = '00';
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
