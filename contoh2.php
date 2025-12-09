<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

/* COVER */
#cover{position:fixed;inset:0;display:flex;justify-content:center;align-items:center;background:#fff;z-index:9999;transition:opacity .6s ease;}
.cover-bg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.95;z-index:-2}
.cover-content{background:var(--glass);backdrop-filter:blur(6px);padding:36px 22px;border-radius:16px;text-align:center;width:92%;max-width:380px;box-shadow:0 12px 40px rgba(0,0,0,0.12)}
.cover-content .title{font-family:'Playfair Display',serif;font-size:30px;margin:6px 0}
.open-btn{background:var(--accent);color:#fff;border:0;padding:10px 22px;border-radius:10px;font-size:15px;cursor:pointer}

/* PAGE */
#page{display:none}
section{position:relative;width:100%;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px 18px;flex-direction:column;text-align:center}
.hero{overflow:hidden}
.hero h1{font-family:'Playfair Display',serif;font-size:44px;margin:6px 0}
.hero small{display:block;color:var(--muted);letter-spacing:1px}

/* TIMELINE ZIGZAG */
.timeline-container{max-width:800px;margin:0 auto;position:relative;padding:40px 0}
.timeline{position:relative;padding:20px 0}
.timeline::before{content:'';position:absolute;top:0;bottom:0;left:50%;width:4px;background:var(--accent);transform:translateX(-50%)}
.timeline-item{position:relative;width:50%;padding:20px 40px;box-sizing:border-box;margin-bottom:40px}
.timeline-item.left{left:0;text-align:right;}
.timeline-item.right{left:50%;text-align:left;}
.timeline-item .timeline-dot{position:absolute;top:20px;width:20px;height:20px;background:#fff;border:4px solid var(--accent);border-radius:50%;z-index:2;left:50%;transform:translateX(-50%);}
.timeline-item .timeline-content{padding:10px 20px;background:#fff;border-radius:8px;display:inline-block;max-width:250px;box-shadow:0 4px 10px rgba(0,0,0,0.1);}
.timeline-item.left .timeline-content{margin-right:20px;}
.timeline-item.right .timeline-content{margin-left:20px;}

/* GALLERY */
.gallery{display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:8px}
.gallery img{width:100%;height:120px;object-fit:cover;border-radius:8px;cursor:pointer}

/* RSVP */
form.rsvp{display:flex;flex-direction:column;gap:10px}
input,textarea,select{padding:10px;border-radius:8px;border:1px solid #e6e3e1}
button.btn-submit{background:var(--accent);color:#fff;padding:10px;border-radius:10px;border:0;cursor:pointer}
.rsvp-list{margin-top:12px}
.small-muted{font-size:13px;color:var(--muted)}

/* BOTTOM MENU */
.bottom-menu{position:fixed;left:50%;transform:translateX(-50%);bottom:18px;background:#fff;padding:10px 14px;border-radius:16px;display:flex;gap:12px;align-items:center;box-shadow:0 8px 30px rgba(0,0,0,0.12);z-index:999}
.bm-item{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;cursor:pointer}
.bm-item i{font-size:18px}
.bm-active{background:linear-gradient(180deg,var(--accent),#4e3528);color:#fff}

/* BACKGROUND ANIMATED NATURE */
.bg-animated-nature{position:fixed;top:0;left:0;width:100%;height:100%;overflow:hidden;z-index:-1;pointer-events:none}
.animate-leaf{position:absolute;animation:leafSway linear infinite;}
</style>
</head>
<body>

<!-- COVER -->
<div id="cover">
  <div class="cover-bg"><img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=1200&q=60" alt="bg"></div>
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
  <source src="https://cdn.pixabay.com/download/audio/2025/05/22/audio_6790595d16.mp3?filename=wedding-wedding-music-345462.mp3" type="audio/mpeg">
</audio>

<!-- BACKGROUND -->
<div class="bg-animated-nature">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/leaf.webp" class="animate-leaf" style="top:10%; left:5%; width:120px; animation-duration:4s;">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/orchied.webp" class="animate-leaf" style="top:20%; left:30%; width:160px; animation-duration:6s;">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tulip.webp" class="animate-leaf" style="bottom:5%; right:10%; width:140px; animation-duration:5s;">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tree-3.webp" class="animate-leaf" style="top:0; left:50%; width:200px; animation-duration:8s;">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/bird.webp" style="top:25%; left:40%; width:80px;">
</div>

<!-- PAGE -->
<div id="page">
  <section id="hero" class="hero">
    <small class="small-muted">The Wedding Of</small>
    <h1>Justin & Sisca</h1>
    <p class="small-muted">Sabtu, 20 Desember 2025 • 10.00 WIB</p>
  </section>

  <section id="mempelai">
    <div class="card fade">
      <h3 class="section-title">Mempelai</h3>
      <p>Informasi singkat tentang mempelai dan keluarga.</p>
    </div>
  </section>

  <section id="acara">
    <div class="card fade">
      <h3 class="section-title">Acara</h3>
      <p>Akad: 09.00 WIB • Resepsi: 11.00 - 14.00 WIB</p>
    </div>
  </section>

  <section id="timeline">
    <div class="timeline-container">
      <h3 class="section-title">Susunan Acara</h3>
      <div class="timeline">
        <div class="timeline-item left"><div class="timeline-dot"></div><div class="timeline-content"><h4>08.30 — Kedatangan Tamu</h4></div></div>
        <div class="timeline-item right"><div class="timeline-dot"></div><div class="timeline-content"><h4>09.00 — Akad Nikah</h4></div></div>
        <div class="timeline-item left"><div class="timeline-dot"></div><div class="timeline-content"><h4>10.30 — Sesi Foto Keluarga</h4></div></div>
        <div class="timeline-item right"><div class="timeline-dot"></div><div class="timeline-content"><h4>11.00 — Resepsi Dibuka</h4></div></div>
      </div>
    </div>
  </section>

  <section id="gallery">
    <div class="card fade">
      <h3 class="section-title">Galeri</h3>
      <div class="gallery" id="galleryInner">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=60" alt="g1">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&w=900&q=60" alt="g2">
      </div>
    </div>
  </section>

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
      </form>
      <div class="rsvp-list" id="rsvpList"></div>
    </div>
  </section>
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
const $ = s=>document.querySelector(s);
const $$ = s=>document.querySelectorAll(s);
let _autoRaf=null,_autoSpeed=0.6;
function startAutoScroll(){if(_autoRaf) return; function step(){const max=document.documentElement.scrollHeight-window.innerHeight;if(window.scrollY>=max-1){stopAutoScroll();return;} window.scrollBy(0,_autoSpeed); _autoRaf=requestAnimationFrame(step);} _autoRaf=requestAnimationFrame(step);}
function stopAutoScroll(){if(_autoRaf){cancelAnimationFrame(_autoRaf); _autoRaf=null;}}
function stopAutoOnUser(){window.addEventListener('wheel', ()=>stopAutoScroll(), {passive:true});window.addEventListener('mousedown', ()=>stopAutoScroll());window.addEventListener('touchstart', ()=>stopAutoScroll(), {passive:true});window.addEventListener('touchmove', ()=>stopAutoScroll(), {passive:true});}

document.addEventListener('DOMContentLoaded', ()=>{
  const cover = $('#cover');
  const page = $('#page');
  const bgmusic = $('#bgmusic');
  const openBtn = $('#openInvite');
  openBtn?.addEventListener('click', ()=>{
    if(cover) cover.style.opacity='0';
    setTimeout(()=>{
      if(cover) cover.style.display='none';
      if(page) page.style.display='block';
      if(bgmusic){ bgmusic.play().catch(()=>console.log('Autoplay diblokir')); }
      setTimeout(()=>{ const hero = $('#hero'); if(hero){ hero.scrollIntoView({behavior:'smooth'}); setTimeout(()=>startAutoScroll(),700);} },80);
    },600);
  });
  stopAutoOnUser();

  const bottomMenu = $('#bottomMenu');
  bottomMenu?.addEventListener('click', e=>{
    const item=e.target.closest('.bm-item'); if(!item) return;
    const to=item.getAttribute('data-to'); if(to){ const el=document.querySelector(to); if(el) el.scrollIntoView({behavior:'smooth'});}
    $$('.bm-item').forEach(b=>b.classList.remove('bm-active')); item.classList.add('bm-active');
  });

  const autoBtn = $('#autoScrollToggle'); const autoI = $('#autoI'); let autoScroll=false;
  autoBtn?.addEventListener('click', ()=>{
    autoScroll=!autoScroll; if(autoScroll){startAutoScroll(); autoI.textContent='⏸'; autoBtn.classList.add('bm-active');}
    else{stopAutoScroll(); autoI.textContent='⤓'; autoBtn.classList.remove('bm-active');}
  });

  const musicBtn = $('#musicToggle'); const musicI = $('#musicI');
  musicBtn?.addEventListener('click', ()=>{
    if(!bgmusic) return;
    if(bgmusic.paused){ bgmusic.play().catch(()=>{}); musicI.textContent='♪'; musicBtn.classList.add('bm-active');}
    else{bgmusic.pause(); musicI.textContent='♫'; musicBtn.classList.remove('bm-active');}
  });

  const rsvpForm = $('#rsvpForm'); const rsvpList = $('#rsvpList');
  function escapeHtml(s){ return (s||'').toString().replace(/&/g,'&amp;').replace(/</g,'&lt;'); }
  function loadRsvp(){ if(!rsvpList) return; const data=JSON.parse(localStorage.getItem('rsvps')||'[]'); rsvpList.innerHTML=data.map(d=>`<div style="padding:8px;border-bottom:1px solid #eee"><b>${escapeHtml(d.name)}</b> — ${escapeHtml(d.attend)}<div class="small-muted">${escapeHtml(d.phone||'')} ${escapeHtml(d.message||'')}</div></div>`).join(''); }
  if(rsvpForm){ rsvpForm.addEventListener('submit', e=>{e.preventDefault(); const name=$('#r_name').value.trim(); const phone=$('#r_phone').value.trim(); const attend=$('#r_attend').value; const message=$('#r_message').value.trim(); if(!name) return alert('Isi nama'); const arr=JSON.parse(localStorage.getItem('rsvps')||'[]'); const item={name,phone,attend,message,created:(new Date()).toISOString()}; arr.push(item); localStorage.setItem('rsvps',JSON.stringify(arr)); loadRsvp(); alert('Terima kasih, konfirmasi Anda tersimpan.'); rsvpForm.reset(); }); loadRsvp();}
});
</script>

</body>
</html>
