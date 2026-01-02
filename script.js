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

// stop autoscroll on user interaction
['wheel','touchstart','mousedown'].forEach(evt=>{
  window.addEventListener(evt, ()=>{
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
    cover && (cover.style.opacity = '0');

    setTimeout(()=>{
      cover && (cover.style.display = 'none');
      page && (page.style.display = 'block');
      bgmusic && bgmusic.play().catch(()=>{});

      $('#hero')?.scrollIntoView({ behavior:'smooth' });

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
    $('.layer-a') && ($('.layer-a').style.transform = `translateY(${sc * 0.14}px)`);
    $('.layer-b') && ($('.layer-b').style.transform = `translateY(${sc * 0.22}px)`);
  });

  /* ---------- FADE IN ---------- */
  if ('IntersectionObserver' in window){
    const io = new IntersectionObserver(entries=>{
      entries.forEach(e=>{
        if (e.isIntersecting) e.target.classList.add('inview');
      });
    }, { threshold:0.15 });
    $$('.fade, .timeline-item').forEach(el=>io.observe(el));
  } else {
    $$('.fade, .timeline-item').forEach(el=>el.classList.add('inview'));
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
    to && $(to)?.scrollIntoView({ behavior:'smooth' });

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
    bgmusic.paused ? bgmusic.play().catch(()=>{}) : bgmusic.pause();
  });

  bgmusic?.addEventListener('play', ()=>{
    musicI.textContent = '♪';
    musicBtn.classList.add('bm-active');
  });

  bgmusic?.addEventListener('pause', ()=>{
    musicI.textContent = '♫';
    musicBtn.classList.remove('bm-active');
  });

  /* ---------- RSVP SUBMIT ---------- */
  const rsvpForm = $('#rsvpForm');

  rsvpForm?.addEventListener('submit', e=>{
    e.preventDefault();

    const fd = new FormData(rsvpForm);

    fetch('save-rsvp.php', { method:'POST', body:fd })
      .then(r=>r.json())
      .then(res=>{
        if (res.status === 'ok'){
          rsvpForm.reset();
          loadLatestRsvp();
        }
      });
  });

  function loadLatestRsvp(){
    fetch('get-rsvp.php')
      .then(r=>r.json())
      .then(d=>{
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
  const params = new URLSearchParams(location.search);
  params.get('kpd') && ($('#kpdName').textContent = params.get('kpd'));

  /* ---------- COUNTDOWN ---------- */
  document.querySelectorAll('.countdown').forEach(cd=>{
    const target = new Date(cd.dataset.date.replace(' ', 'T') + '+08:00').getTime();
    const d = cd.querySelector('.cd-days');
    const h = cd.querySelector('.cd-hours');
    const m = cd.querySelector('.cd-minutes');
    const s = cd.querySelector('.cd-seconds');

    const tick = ()=>{
      let diff = target - Date.now();
      if (diff <= 0){
        d.textContent = h.textContent = m.textContent = s.textContent = '00';
        return;
      }
      d.textContent = Math.floor(diff / 86400000);
      h.textContent = String(Math.floor(diff / 3600000 % 24)).padStart(2,'0');
      m.textContent = String(Math.floor(diff / 60000 % 60)).padStart(2,'0');
      s.textContent = String(Math.floor(diff / 1000 % 60)).padStart(2,'0');
    };
    tick();
    setInterval(tick, 1000);
  });

  /* ---------- COPY NOMOR REKENING (FINAL AMAN) ---------- */
  document.querySelectorAll('.copy-rek').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const num = btn.closest('.rek-wrap')?.querySelector('.rek-number')?.dataset.rek;
      if (!num) return;

      const ta = document.createElement('textarea');
      ta.value = num;
      ta.style.position = 'fixed';
      ta.style.left = '-9999px';
      document.body.appendChild(ta);
      ta.select();
      document.execCommand('copy');
      document.body.removeChild(ta);

      const old = btn.textContent;
      btn.textContent = 'Tersalin';
      btn.classList.add('copied');
      setTimeout(()=>{
        btn.textContent = old;
        btn.classList.remove('copied');
      }, 1200);
    });
  });

});
