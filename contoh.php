<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Wedding Invitation - Justin & Sisca</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<style>
  :root{
    --accent:#6b4b3a;
    --muted:#6b6b6b;
    --glass: rgba(255,255,255,0.55);
  }
  *{box-sizing:border-box}
  body,html{margin:0;padding:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial;height:100%;color:#222;background:#f6f4f3;scroll-behavior:smooth}

  /* ---------- COVER ---------- */
  #cover{position:fixed;inset:0;display:flex;justify-content:center;align-items:center;background:#fff;z-index:9999;transition:opacity .6s ease;}
  .cover-bg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.95;z-index:-2}
  .ornament{position:absolute;z-index:-1;opacity:.9;pointer-events:none}
  .orn-left{left:0;bottom:0;width:42%}
  .orn-right{right:0;top:0;width:42%}
  .cover-content{background:var(--glass);backdrop-filter:blur(6px);padding:36px 22px;border-radius:16px;text-align:center;width:92%;max-width:380px;box-shadow:0 12px 40px rgba(0,0,0,0.12)}
  .cover-content p{margin:0 0 8px}
  .cover-content .title{font-family:'Playfair Display',serif;font-size:30px;margin:6px 0}
  .open-btn{background:var(--accent);color:#fff;border:0;padding:10px 22px;border-radius:10px;font-size:15px;cursor:pointer}

  /* ---------- PAGE & HERO PARALLAX ---------- */
  #page{display:none}
  section{position:relative;width:100%;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px 18px}
  .hero{overflow:hidden}
  .parallax{position:absolute;inset:0;pointer-events:none}
  .parallax img{position:absolute;width:120%;max-width:none;transform:translate3d(0,0,0);}
  .layer-a{left:-10%;top:-10%;opacity:.95}
  .layer-b{right:-10%;bottom:-10%;opacity:.95}
  .hero .inner{position:relative;z-index:2;text-align:center}
  .hero small{display:block;color:var(--muted);letter-spacing:1px}
  .hero h1{font-family:'Playfair Display',serif;font-size:44px;margin:6px 0}

  /* ---------- FLOATING BOTTOM MENU ---------- */
  .bottom-menu{position:fixed;left:50%;transform:translateX(-50%);bottom:18px;background:#fff;padding:10px 14px;border-radius:16px;display:flex;gap:12px;align-items:center;box-shadow:0 8px 30px rgba(0,0,0,0.12);z-index:999}
  .bm-item{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;cursor:pointer}
  .bm-item i{font-size:18px}
  .bm-active{background:linear-gradient(180deg,var(--accent),#4e3528);color:#fff}

  /* ---------- SECTIONS & FADE-IN ---------- */
  .card{background:#fff;border-radius:12px;padding:22px;max-width:760px;width:100%;box-shadow:0 6px 30px rgba(0,0,0,0.06)}
  .section-title{font-family:'Playfair Display',serif;font-size:26px;margin-bottom:8px}
  .fade{opacity:0;transform:translateY(18px);transition:all .6s ease}
  .fade.inview{opacity:1;transform:translateY(0)}

  /* ---------- GALLERY & LIGHTBOX ---------- */
  .gallery{display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:8px}
  .gallery img{width:100%;height:120px;object-fit:cover;border-radius:8px;cursor:pointer}
  .lightbox{position:fixed;inset:0;background:rgba(0,0,0,0.85);display:flex;align-items:center;justify-content:center;padding:20px;z-index:2000;display:none}
  .lightbox img{max-width:92%;max-height:92%;border-radius:8px}
  .lightbox .close{position:absolute;top:18px;right:18px;color:#fff;font-size:22px;cursor:pointer}

  /* ---------- RSVP ---------- */
  form.rsvp{display:flex;flex-direction:column;gap:10px}
  input,textarea,select{padding:10px;border-radius:8px;border:1px solid #e6e3e1}
  button.btn-submit{background:var(--accent);color:#fff;padding:10px;border-radius:10px;border:0;cursor:pointer}
  .rsvp-list{margin-top:12px}
  .small-muted{font-size:13px;color:var(--muted)}

  /* Responsive tweaks */
  @media (max-width:780px){
    .cover-content{padding:28px 18px}
    .hero h1{font-size:34px}
    .bottom-menu{gap:8px;padding:8px}
  }
</style>
</head>
<body>

<!-- COVER -->
<div id="cover">
  <div class="cover-bg"><img src="index_files/bg-1.webp" alt="bg"></div>
  <div class="ornament orn-left"><img src="index_files/branch.webp" alt""></div>
  <div class="ornament orn-right"><img src="index_files/branch.webp" alt""></div>

  <div class="cover-content">
    <p class="small-muted">Happy Wedding</p>
    <h2 class="title">Justin & Sisca</h2>
    <p class="small-muted">Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara kami.</p>
    <p style="margin:10px 0">Kepada: <strong id="kpdName">Bapak Budi</strong></p>
    <button class="open-btn" id="openInvite">📩 Buka Undangan</button>
  </div>
</div>

<!-- AUDIO -->
<audio id="bgmusic" loop preload="auto">
  <source src="index_files/music.mp3" type="audio/mpeg">
</audio>

<!-- PAGE -->
<div id="page">
  <!-- HERO -->
  <section class="hero">
    <div class="parallax">
      <img src="index_files/tree-1.webp" class="layer-a" style="transform:translateY(0)">
      <img src="index_files/tree-3.webp" class="layer-b" style="transform:translateY(0)">
    </div>
    <div class="inner">
      <small class="small-muted">The Wedding Of</small>
      <h1>Justin & Sisca</h1>
      <p class="small-muted">Sabtu, 20 Desember 2025 • 10.00 WIB</p>
    </div>
  </section>

  <!-- MEMPELAI -->
  <section>
    <div class="card fade">
      <h3 class="section-title">Mempelai</h3>
      <p>Informasi singkat tentang mempelai dan keluarga.</p>
    </div>
  </section>

  <!-- ACARA -->
  <section>
    <div class="card fade">
      <h3 class="section-title">Acara</h3>
      <p>Akad: 09.00 WIB • Resepsi: 11.00 - 14.00 WIB</p>
    </div>
  </section>

  <!-- GALLERY -->
  <section>
    <div class="card fade">
      <h3 class="section-title">Galeri</h3>
      <div class="gallery" id="gallery">
        <img src="index_files/g1.webp" alt="g1">
        <img src="index_files/g2.webp" alt="g2">
        <img src="index_files/g3.webp" alt="g3">
        <img src="index_files/g4.webp" alt="g4">
      </div>
    </div>
  </section>

  <!-- RSVP -->
  <section>
    <div class="card fade">
      <h3 class="section-title">Konfirmasi Kehadiran (RSVP)</h3>
      <form id="rsvpForm" class="rsvp">
        <input id="r_name" type="text" placeholder="Nama" required>
        <input id="r_phone" type="text" placeholder="No. HP (opsional)">
        <select id="r_attend">
          <option value="hadir">Hadir</option>
          <option value="tidak">Tidak Hadir</option>
        </select>
        <textarea id="r_message" rows="3" placeholder="Pesan / Doa (opsional)"></textarea>
        <button class="btn-submit" type="submit">Kirim Konfirmasi</button>
        <p class="small-muted">(Data tersimpan secara lokal. Untuk menyimpan ke server, aktifkan endpoint backend)</p>
      </form>

      <div class="rsvp-list" id="rsvpList"></div>
    </div>
  </section>

</div>

<!-- LIGHTBOX -->
<div id="lightbox" class="lightbox">
  <div class="close" id="lbClose">✕</div>
  <img id="lbImg" src="" alt="">
</div>

<!-- BOTTOM MENU -->
<div class="bottom-menu" id="bottomMenu">
  <div class="bm-item bm-active" data-to="#hero" title="Beranda"><i>🏠</i></div>
  <div class="bm-item" data-to="#mempelai" title="Mempelai"><i>👥</i></div>
  <div class="bm-item" data-to="#acara" title="Acara"><i>📅</i></div>
  <div class="bm-item" data-to="#gallery" title="Galeri"><i>🖼️</i></div>
  <div class="bm-item" id="autoScrollToggle" title="Auto Scroll"><i id="autoI">⤓</i></div>
  <div class="bm-item" id="musicToggle" title="Music"><i id="musicI">♪</i></div>
</div>

<script>
// ---------- Helpers ----------
const $ = s => document.querySelector(s);
const $$ = s => document.querySelectorAll(s);

// ---------- Open cover & play music ----------
const cover = $('#cover');
const page = $('#page');
const bgmusic = $('#bgmusic');
const openBtn = $('#openInvite');
openBtn.addEventListener('click', ()=>{
  cover.style.opacity='0';
  setTimeout(()=>{cover.style.display='none'; page.style.display='block';},600);
  // play music if available; some browsers require user gesture (we have the click)
  bgmusic.play().catch(()=>{});
});

// ---------- Parallax effect on scroll ----------
window.addEventListener('scroll', ()=>{
  const sc = window.scrollY;
  const la = document.querySelector('.layer-a');
  const lb = document.querySelector('.layer-b');
  if(la) la.style.transform = `translateY(${sc*0.14}px)`;
  if(lb) lb.style.transform = `translateY(${sc*0.22}px)`;
});

// ---------- Fade-in on scroll (IntersectionObserver) ----------
const io = new IntersectionObserver((entries)=>{
  entries.forEach(e=>{ if(e.isIntersecting) e.target.classList.add('inview'); });
},{threshold:0.15});
$$('.fade').forEach(el=>io.observe(el));

// ---------- Gallery lightbox ----------
const gallery = $('#gallery');
const lightbox = $('#lightbox');
const lbImg = $('#lbImg');
const lbClose = $('#lbClose');
if(gallery){
  gallery.addEventListener('click', e=>{
    const img = e.target.closest('img'); if(!img) return;
    lbImg.src = img.src; lightbox.style.display='flex';
  });
  lbClose.addEventListener('click', ()=> lightbox.style.display='none');
  lightbox.addEventListener('click', (e)=>{ if(e.target===lightbox) lightbox.style.display='none' });
}

// ---------- Bottom menu navigation ----------
document.getElementById('bottomMenu').addEventListener('click', (e)=>{
  const item = e.target.closest('.bm-item'); if(!item) return;
  // music toggle
  if(item.id === 'musicToggle' || item.id === 'musicToggle'){
    // handled later
  }
  const to = item.getAttribute('data-to');
  if(to){
    const el = document.querySelector(to);
    if(el) el.scrollIntoView({behavior:'smooth'});
    $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
    item.classList.add('bm-active');
  }
});

// ---------- Auto-scroll feature ----------
let autoScroll = false; // off by default
let autoInterval = null;
const autoBtn = $('#autoScrollToggle');
const autoI = $('#autoI');
autoBtn.addEventListener('click', ()=>{
  autoScroll = !autoScroll;
  if(autoScroll){
    autoI.textContent = '⏸';
    autoInterval = setInterval(()=>{ window.scrollBy({top:1,behavior:'smooth'}); }, 60);
  } else {
    autoI.textContent = '⤓';
    clearInterval(autoInterval);
  }
});

// ---------- Music toggle ----------
const musicBtn = $('#musicToggle');
const musicI = $('#musicI');
musicBtn.addEventListener('click', ()=>{
  if(bgmusic.paused){ bgmusic.play(); musicI.textContent='♪'; musicBtn.classList.add('bm-active'); }
  else { bgmusic.pause(); musicI.textContent='♫'; musicBtn.classList.remove('bm-active'); }
});

// ---------- RSVP (localStorage) ----------
const rsvpForm = $('#rsvpForm');
const rsvpList = $('#rsvpList');
function loadRsvp(){
  const data = JSON.parse(localStorage.getItem('rsvps')||'[]');
  rsvpList.innerHTML = data.map(d=>`<div style="padding:8px;border-bottom:1px solid #eee"><b>${escapeHtml(d.name)}</b> — ${escapeHtml(d.attend)}<div class="small-muted">${escapeHtml(d.phone||'')} ${escapeHtml(d.message||'')}</div></div>`).join('');
}
function escapeHtml(s){ return (s||'').toString().replace(/&/g,'&amp;').replace(/</g,'&lt;'); }
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
    loadRsvp();
    alert('Terima kasih, konfirmasi Anda tersimpan.');
    rsvpForm.reset();

    // If you want to send to backend (PHP + SQLite), uncomment and adapt below:
    /*
    fetch('/api/rsvp.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(item)})
      .then(r=>r.json()).then(x=>console.log(x)).catch(err=>console.error(err));
    */
  });
  loadRsvp();
}

// ---------- Initialize: show hero in bottom-menu active ----------
document.addEventListener('DOMContentLoaded', ()=>{
  // set initial active
  $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
  document.querySelector('.bm-item[data-to="#hero"]').classList.add('bm-active');

  // read query param kpd
  const params = new URLSearchParams(location.search);
  if(params.get('kpd')) $('#kpdName').textContent = params.get('kpd');
});

</script>
</body>
</html>