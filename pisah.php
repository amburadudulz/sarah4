<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Wedding Invitation - Justin & Sisca</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
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

<!-- BACKGROUND ORNAMENTS -->
<div class="bg-animated-nature">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/bird.webp">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tree-2.webp">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tree-1.webp">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tree-3.webp">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/leaf.webp">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/orchied.webp">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tulip.webp">
</div>

<!-- PAGE -->
<div id="page">
  <!-- HERO -->
  <section id="hero" class="hero">
    <div class="parallax">
      <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=60" class="layer-a">
      <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=60" class="layer-b">
    </div>
    <div class="inner">
      <small class="small-muted">The Wedding Of</small>
      <h1>Justin & Sisca</h1>
      <p class="small-muted">Sabtu, 20 Desember 2025 • 10.00 WIB</p>
    </div>
  </section>

  <!-- MEMPELAI -->
  <section id="mempelai">
    <div class="card fade">
      <h3 class="section-title">Mempelai</h3>
      <p>Informasi singkat tentang mempelai dan keluarga.</p>
    </div>
  </section>

  <!-- ACARA -->
  <section id="acara">
    <div class="card fade">
      <h3 class="section-title">Acara</h3>
      <p>Akad: 09.00 WIB • Resepsi: 11.00 - 14.00 WIB</p>
    </div>
  </section>

  <!-- TIMELINE -->
  <section id="timeline">
    <div class="card fade">
      <h3 class="section-title">Susunan Acara</h3>
      <ul style="list-style:none;padding:0;margin:0;line-height:1.8">
        <li>• 08.30 — Kedatangan Tamu</li>
        <li>• 09.00 — Akad Nikah</li>
        <li>• 10.30 — Sesi Foto Keluarga</li>
        <li>• 11.00 — Resepsi Dibuka</li>
        <li>• 12.00 — Ramah Tamah</li>
        <li>• 14.00 — Acara Selesai</li>
      </ul>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery">
    <div class="card fade">
      <h3 class="section-title">Galeri</h3>
      <div class="gallery" id="galleryInner">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=60" alt="g1">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&w=900&q=60" alt="g2">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&w=900&q=60" alt="g3">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&w=900&q=60" alt="g4">
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
// Helpers
const $ = s=>document.querySelector(s);
const $$ = s=>document.querySelectorAll(s);

// Auto-scroll
let _autoRaf=null;
let _autoSpeed=0.6;
function startAutoScroll(){if(_autoRaf)return;function step(){const max=document.documentElement.scrollHeight-window.innerHeight;if(window.scrollY>=max-1){stopAutoScroll();return;}window.scrollBy(0,_autoSpeed);_autoRaf=requestAnimationFrame(step);} _autoRaf=requestAnimationFrame(step);}
function stopAutoScroll(){if(_autoRaf){cancelAnimationFrame(_autoRaf);_autoRaf=null;}}

// DOMContentLoaded
document.addEventListener('DOMContentLoaded',()=>{

  const cover=$('#cover');
  const page=$('#page');
  const bgmusic=$('#bgmusic');
  const openBtn=$('#openInvite');

  // Cover open
  openBtn?.addEventListener('click',()=>{
    if(cover)cover.style.opacity='0';
    setTimeout(()=>{
      if(cover)cover.style.display='none';
      if(page)page.style.display='block';
      if(bgmusic){const p=bgmusic.play();if(p&&p.catch)p.catch(()=>{});}
      setTimeout(()=>{
        const hero=$('#hero');
        if(hero){
          hero.scrollIntoView({behavior:'smooth'});
          setTimeout(()=>{
            startAutoScroll();
            const autoBtn=$('#autoScrollToggle');
            const autoI=$('#autoI');
            if(autoBtn&&autoI){autoBtn.classList.add('bm-active');autoI.textContent='⏸';}
          },750);
        }else{window.scrollTo({top:0,behavior:'smooth'});setTimeout(()=>startAutoScroll(),500);}
      },80);
    },600);
  });

  // Parallax
  window.addEventListener('scroll',()=>{
    const sc=window.scrollY;
    const la=document.querySelector('.layer-a');
    const lb=document.querySelector('.layer-b');
    if(la)la.style.transform=`translateY(${sc*0.14}px)`;
    if(lb)lb.style.transform=`translateY(${sc*0.22}px)`;
  });

  // Fade-in
  const io=new IntersectionObserver((entries)=>{
    entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('inview');});
  },{threshold:0.15});
  $$('.fade').forEach(el=>io.observe(el));

  // Gallery lightbox
  const gallery=$('#galleryInner');
  const lightbox=$('#lightbox');
  const lbImg=$('#lbImg');
  const lbClose=$('#lbClose');
  if(gallery){
    gallery.addEventListener('click',e=>{
      const img=e.target.closest('img');if(!img)return;
      if(lbImg)lbImg.src=img.src;
      if(lightbox)lightbox.style.display='flex';
      stopAutoScroll();
      const autoBtn=$('#autoScrollToggle');
      const autoI=$('#autoI');
      if(autoBtn&&autoI){autoBtn.classList.remove('bm-active');autoI.textContent='⤓';}
    });
  }
  lbClose?.addEventListener('click',()=>{if(lightbox)lightbox.style.display='none';});
  lightbox?.addEventListener('click',(e)=>{if(e.target===lightbox)lightbox.style.display='none';});

  // Bottom menu navigation
  const bottomMenu=$('#bottomMenu');
  bottomMenu?.addEventListener('click',(e)=>{
    const item=e.target.closest('.bm-item');if(!item)return;
    const to=item.getAttribute('data-to');
    if(to){const el=document.querySelector(to);if(el)el.scrollIntoView({behavior:'smooth'});}
    $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
    item.classList.add('bm-active');
  });

  // Auto-scroll toggle
  let autoScroll=false;
  const autoBtn=$('#autoScrollToggle');
  const autoI=$('#autoI');
  autoBtn?.addEventListener('click',()=>{
    autoScroll=!autoScroll;
    if(autoScroll){startAutoScroll();if(autoI)autoI.textContent='⏸';autoBtn.classList.add('bm-active');}
    else{stopAutoScroll();if(autoI)autoI.textContent='⤓';autoBtn.classList.remove('bm-active');}
  });

  // Music toggle
  const musicBtn=$('#musicToggle');
  const musicI=$('#musicI');
  musicBtn?.addEventListener('click',()=>{
    if(!bgmusic)return;
    if(bgmusic.paused){bgmusic.play().catch(()=>{});musicI.textContent='♪';musicBtn.classList.add('bm-active');}
    else{bgmusic.pause();musicI.textContent='♫';musicBtn.classList.remove('bm-active');}
  });

  // RSVP localStorage
  const rsvpForm=$('#rsvpForm');
  const rsvpList=$('#rsvpList');
  function escapeHtml(s){return(s||'').toString().replace(/&/g,'&amp;').replace(/</g,'&lt;');}
  function loadRsvp(){if(!rsvpList)return;const data=JSON.parse(localStorage.getItem('rsvps')||'[]');rsvpList.innerHTML=data.map(d=>`<div style="padding:8px;border-bottom:1px solid #eee"><b>${escapeHtml(d.name)}</b> — ${escapeHtml(d.attend)}<div class="small-muted">${escapeHtml(d.phone||'')} ${escapeHtml(d.message||'')}</div></div>`).join('');}
  if(rsvpForm){
    rsvpForm.addEventListener('submit',e=>{
      e.preventDefault();
      const name=$('#r_name').value.trim();
      const phone=$('#r_phone').value.trim();
      const attend=$('#r_attend').value;
      const message=$('#r_message').value.trim();
      if(!name)return alert('Isi nama');
      const arr=JSON.parse(localStorage.getItem('rsvps')||'[]');
      arr.push({name,phone,attend,message,created:(new Date()).toISOString()});
      localStorage.setItem('rsvps',JSON.stringify(arr));
      loadRsvp();
      alert('Terima kasih, konfirmasi Anda tersimpan.');
      rsvpForm.reset();
    });
    loadRsvp();
  }

  // Initial menu & kpd param
  $$('.bm-item').forEach(b=>b.classList.remove('bm-active'));
  const homeBtn=document.querySelector('.bm-item[data-to="#hero"]');
  if(homeBtn)homeBtn.classList.add('bm-active');
  const params=new URLSearchParams(location.search);
  if(params.get('kpd')){$('#kpdName').textContent=params.get('kpd');}

  // Randomize background ornaments: scale 2-4x, random pos, random tempo
  document.querySelectorAll('.bg-animated-nature img').forEach(img=>{
    const scale=(Math.random()*2+2).toFixed(2);
    img.style.transform=`translate(-50%,-50%) scale(${scale})`;
    img.style.left=`${Math.random()*90}%`;
    img.style.top=`${Math.random()*80}%`;
    const duration=(Math.random()*11 + 4).toFixed(2)+'s';
    img.style.animationDuration=duration;
  });
});
</script>

</body>
</html>
