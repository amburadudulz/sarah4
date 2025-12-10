// ---------- Helpers ----------
const $ = (s, root=document) => root.querySelector(s);
const $$ = (s, root=document) => Array.from((root||document).querySelectorAll(s));

// Right-panel autoscroll variables
let _raf = null;
let _autoActive = false;
let _autoSpeed = 0.6;

// elements
const cover = $('#cover');
const openInvite = $('#openInvite');
const bgmusic = $('#bgmusic');
const leftPanel = document.querySelector('.split-left');
const rightPanel = document.querySelector('.split-right') || document.getElementById('page');
const autoBtn = $('#autoScrollToggle');
const autoI = $('#autoI');
const musicToggle = $('#musicToggle');
const musicI = $('#musicI');
const bottomMenu = $('#bottomMenu');

// start/stop autoscroll (operates on rightPanel.scrollTop)
function startAutoScroll(){
  if(_raf) return;
  _autoActive = true;
  function step(){
    const max = rightPanel.scrollHeight - rightPanel.clientHeight;
    if(Math.ceil(rightPanel.scrollTop) >= max - 1){ stopAutoScroll(); return; }
    rightPanel.scrollTop += _autoSpeed;
    _raf = requestAnimationFrame(step);
  }
  _raf = requestAnimationFrame(step);
}
function stopAutoScroll(){
  if(_raf){ cancelAnimationFrame(_raf); _raf = null; }
  _autoActive = false;
  if(autoBtn) autoBtn.classList.remove('bm-active');
  if(autoI) autoI.textContent = '⤓';
}

// stop autoscroll on user interaction with rightPanel
function attachStopOnUser(){
  if(!rightPanel) return;
  const stop = () => { if(_autoActive) stopAutoScroll(); };
  ['wheel','touchstart','pointerdown','mousedown'].forEach(ev => rightPanel.addEventListener(ev, stop, {passive:true}));
}
attachStopOnUser();

// scoped IntersectionObserver for rightPanel content
function setupObserver(){
  if(!rightPanel) return;
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(e.isIntersecting) e.target.classList.add('inview');
    });
  }, { root: rightPanel, threshold: 0.15 });
  $$('.fade', rightPanel).forEach(el => io.observe(el));
  $$('.timeline-item', rightPanel).forEach(el => io.observe(el));
}
document.addEventListener('DOMContentLoaded', setupObserver);

// parallax: translate images inside rightPanel based on rightPanel.scrollTop
if(rightPanel){
  rightPanel.addEventListener('scroll', ()=>{
    const sc = rightPanel.scrollTop;
    const la = rightPanel.querySelector('.layer-a');
    const lb = rightPanel.querySelector('.layer-b');
    if(la) la.style.transform = `translateY(${sc * 0.14}px)`;
    if(lb) lb.style.transform = `translateY(${sc * 0.22}px)`;
  }, {passive:true});
}

// open cover: hide cover, play music, start autoscroll on desktop widths
openInvite?.addEventListener('click', ()=>{
  if(cover) cover.style.opacity = '0';
  if(bgmusic) bgmusic.play().catch(()=>{});
  setTimeout(()=>{
    if(cover) cover.style.display = 'none';
    if(rightPanel){
      rightPanel.scrollTop = 0;
      if(window.innerWidth >= 900){ setTimeout(()=>{ startAutoScroll(); if(autoBtn) autoBtn.classList.add('bm-active'); if(autoI) autoI.textContent='⏸'; }, 650); }
    }
  }, 500);
});

// bottom menu navigation (scroll inside rightPanel)
if(bottomMenu && rightPanel){
  bottomMenu.addEventListener('click', (ev)=>{
    const item = ev.target.closest('.bm-item');
    if(!item) return;
    if(item.id === 'autoScrollToggle' || item.id === 'musicToggle') return;
    const to = item.getAttribute('data-to');
    if(!to) return;
    const el = rightPanel.querySelector(to);
    if(!el) return;
    if(_autoActive) stopAutoScroll();
    rightPanel.scrollTo({ top: el.offsetTop, behavior: 'smooth' });
    $$('.bm-item', bottomMenu).forEach(b => b.classList.remove('bm-active'));
    item.classList.add('bm-active');
  });
}

// auto toggle
autoBtn?.addEventListener('click', ()=>{
  if(_autoActive) stopAutoScroll();
  else { startAutoScroll(); autoBtn.classList.add('bm-active'); if(autoI) autoI.textContent='⏸'; }
});

// music toggle
musicToggle?.addEventListener('click', ()=>{
  if(!bgmusic) return;
  if(bgmusic.paused){ bgmusic.play().catch(()=>{}); musicToggle.classList.add('bm-active'); if(musicI) musicI.textContent='♫'; }
  else { bgmusic.pause(); musicToggle.classList.remove('bm-active'); if(musicI) musicI.textContent='♪'; }
});

// gallery lightbox
const lightbox = document.getElementById('lightbox');
const lbImg = document.getElementById('lbImg');
const lbClose = document.getElementById('lbClose');
rightPanel?.addEventListener('click', (e)=>{
  const img = e.target.closest('#galleryInner img, .gallery img');
  if(!img) return;
  if(lbImg) lbImg.src = img.src;
  if(lightbox) lightbox.style.display = 'flex';
  if(_autoActive) stopAutoScroll();
});
lbClose?.addEventListener('click', ()=>{ if(lightbox) lightbox.style.display = 'none'; });
lightbox?.addEventListener('click', (e)=>{ if(e.target === lightbox) lightbox.style.display = 'none'; });
document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape' && lightbox && lightbox.style.display === 'flex') lightbox.style.display = 'none'; });

// RSVP + paging (localStorage)
const RSVPS_KEY = 'rsvps_split';
const rsvpForm = document.getElementById('rsvpForm');
const rsvpList = document.getElementById('rsvpList');
const ITEMS_PER_PAGE = 3;
let currentPage = 1;
function escapeHtml(s){ return (s||'').toString().replace(/&/g,'&amp;').replace(/</g,'&lt;'); }
function loadRsvp(page=1){
  if(!rsvpList) return;
  const data = JSON.parse(localStorage.getItem(RSVPS_KEY) || '[]');
  const start = (page-1)*ITEMS_PER_PAGE;
  const paged = data.slice(start, start+ITEMS_PER_PAGE);
  rsvpList.innerHTML = paged.map(d=>`
    <div style="padding:8px;border-bottom:1px solid #eee"><b>${escapeHtml(d.name)}</b> — ${escapeHtml(d.attend)}
      <div class="small-muted">${escapeHtml(d.phone||'')} ${escapeHtml(d.message||'')}</div>
    </div>
  `).join('');
  if(data.length > ITEMS_PER_PAGE){
    let pagination = '<div style="margin-top:8px;text-align:center;">';
    const totalPages = Math.ceil(data.length/ITEMS_PER_PAGE);
    for(let i=1;i<=totalPages;i++){
      pagination += `<button class="page-btn" data-page="${i}" style="margin:0 2px;padding:2px 6px;border-radius:4px;border:1px solid #ccc;background:${i===page?'var(--accent)':'#fff'};color:${i===page?'#fff':'#000'};cursor:pointer;">${i}</button>`;
    }
    pagination += '</div>';
    rsvpList.innerHTML += pagination;
    rsvpList.querySelectorAll('.page-btn').forEach(btn=>{
      btn.addEventListener('click', ()=>{
        currentPage = parseInt(btn.dataset.page);
        loadRsvp(currentPage);
      });
    });
  }
}
if(rsvpForm){
  rsvpForm.addEventListener('submit', (e)=>{
    e.preventDefault();
    const name = document.getElementById('r_name').value.trim();
    const phone = document.getElementById('r_phone').value.trim();
    const attend = document.getElementById('r_attend').value;
    const message = document.getElementById('r_message').value.trim();
    if(!name){ alert('Isi nama'); return; }
    const arr = JSON.parse(localStorage.getItem(RSVPS_KEY) || '[]');
    arr.push({ name, phone, attend, message, created: new Date().toISOString() });
    localStorage.setItem(RSVPS_KEY, JSON.stringify(arr));
    currentPage = Math.ceil(arr.length/ITEMS_PER_PAGE);
    loadRsvp(currentPage);
    alert('Terima kasih, konfirmasi Anda tersimpan.');
    rsvpForm.reset();
  });
  loadRsvp();
}

// Update bottom menu active state on rightPanel scroll
function updateActive(){
  if(!rightPanel || !bottomMenu) return;
  const items = Array.from(bottomMenu.querySelectorAll('.bm-item[data-to]'));
  const pos = rightPanel.scrollTop;
  let current = null;
  items.forEach(it=>{
    const sel = it.getAttribute('data-to');
    const el = rightPanel.querySelector(sel);
    if(!el) return;
    if(pos >= el.offsetTop - 40) current = it;
  });
  items.forEach(i=>i.classList.remove('bm-active'));
  if(current) current.classList.add('bm-active');
}
rightPanel?.addEventListener('scroll', ()=>{ updateActive(); }, {passive:true});
setTimeout(updateActive, 500);

// Preload left image
(function preload(url){ const i = new Image(); i.src = url; })('https://indoinvite.com/nikah/template/elegan-nature/tree-3.webp');

/* ----------------- Simple Snow (left panel) ----------------- */
let _snowRaf = null;
function startSnow(){
  if(!leftPanel) return;
  if(window.innerWidth < 900) return;
  const canvas = document.getElementById('snowCanvas');
  if(!canvas) return;
  const ctx = canvas.getContext('2d');
  let w = canvas.width = leftPanel.clientWidth;
  let h = canvas.height = leftPanel.clientHeight;
  const flakes = [];
  const MAX = 50; // moderate
  for(let i=0;i<MAX;i++){
    flakes.push({
      x: Math.random()*w,
      y: Math.random()*h,
      r: 1 + Math.random()*3,
      vx: -0.2 + Math.random()*0.4,
      vy: 0.3 + Math.random()*0.7,
      a: Math.random()*Math.PI*2
    });
  }
  function resize(){ w = canvas.width = leftPanel.clientWidth; h = canvas.height = leftPanel.clientHeight; }
  window.addEventListener('resize', resize);
  function draw(){
    ctx.clearRect(0,0,w,h);
    ctx.fillStyle = 'rgba(255,255,255,0.85)';
    ctx.beginPath();
    for(const f of flakes){
      ctx.moveTo(f.x,f.y);
      ctx.arc(f.x,f.y,f.r,0,Math.PI*2);
    }
    ctx.fill();
    update();
  }
  function update(){
    for(const f of flakes){
      f.x += f.vx + Math.sin(f.a)*0.2;
      f.y += f.vy;
      f.a += 0.01;
      if(f.y > h + 10){ f.y = -10; f.x = Math.random()*w; }
      if(f.x > w + 10) f.x = -10;
      if(f.x < -10) f.x = w + 10;
    }
    _snowRaf = requestAnimationFrame(draw);
  }
  draw();
}
function stopSnow(){ if(_snowRaf){ cancelAnimationFrame(_snowRaf); _snowRaf = null; } }
window.addEventListener('load', ()=>{ startSnow(); });
window.addEventListener('resize', ()=>{ if(window.innerWidth < 900) stopSnow(); else startSnow(); });
