<?php
// ===============================
// INDEX.PHP – UNDANGAN PERNIKAHAN
// Tanggal disesuaikan: Minggu, 11 Januari 2026
// Countdown: 11 Januari 2026 08:00 WITA
// ===============================
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Undangan Pernikahan | Maisaroh & Aditya</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ================= COVER ================= -->
<div id="cover">
  <div class="cover-bg">
    <img src="foto/sarah-2.jpeg" alt="Cover">
  </div>
  <div class="cover-content">
    <p class="small-muted">Undangan Pernikahan</p>
    <h2 class="title">Maisaroh & Aditya</h2>
    <p class="small-muted">
      Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i
      untuk menghadiri acara pernikahan kami.
    </p>
    <p>Kepada Yth:<br><strong id="kpdName">Tamu Undangan</strong></p>
    <button class="open-btn" id="openInvite">Buka Undangan</button>
  </div>
</div>

<!-- ================= AUDIO ================= -->
<audio id="bgmusic" loop preload="auto">
  <source src="https://cdn.pixabay.com/download/audio/2025/05/22/audio_6790595d16.mp3?filename=wedding-wedding-music-345462.mp3" type="audio/mpeg">
</audio>

<!-- ================= BACKGROUND DECOR ================= -->
<div class="bg-animated-nature">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tree-1.webp" class="animate-leaf" style="top:20%; left:30%; width:140%;">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/tree-2.webp" class="animate-leaf" style="bottom:5%; right:10%; width:150%;">
  <img src="https://indoinvite.com/nikah/template/elegan-nature/bird.webp" data-anim="bird-move" style="top:25%; left:40%; width:180px;">
</div>

<!-- ================= PAGE ================= -->
<div id="page">

  <!-- HERO -->
  <section id="hero" class="hero">
    <div class="parallax">
      <img src="foto/sarah-1.jpeg" class="layer-a">
      <img src="foto/sarah-3.jpeg" class="layer-b">
    </div>
    <div class="inner">
      <small class="small-muted">The Wedding Of</small>
      <h1>Maisaroh & Aditya</h1>
      <p class="small-muted">Minggu, 11 Januari 2026 • 08.00 WITA</p>

      <!-- COUNTDOWN -->
      <div class="countdown" data-date="2026-01-11 08:00">
  <div class="cd-box">
    <span class="cd-days">0</span>
    <small>Hari</small>
  </div>
  <div class="cd-box">
    <span class="cd-hours">00</span>
    <small>Jam</small>
  </div>
  <div class="cd-box">
    <span class="cd-minutes">00</span>
    <small>Menit</small>
  </div>
  <div class="cd-box">
    <span class="cd-seconds">00</span>
    <small>Detik</small>
  </div>
</div>

      <p class="akad-info">Akad Nikah • Minggu, 11 Januari 2026 • 08.00 WITA</p>
    </div>
  </section>

  <!-- MEMPELAI -->
  <section id="mempelai">
    <div class="card fade">
      <h3 class="section-title">Mempelai</h3>
      <div class="mempelai-grid">
        <div class="mempelai-item">
          <img src="foto/pria.jpeg" alt="Mempelai Pria">
          <h4>Aditya Hermawan</h4>
          <p>Putra Ketiga dari<br>Bapak Bambang Purwo Sutrisno & Ibu Heri Ningsih</p>
        </div>
        <div class="mempelai-item">
          <img src="foto/wanita.jpeg" alt="Mempelai Wanita">
          <h4>Maisaroh, S.E</h4>
          <p>Putri Kedua dari<br>Bapak H. Jarliani & Ibu Hj. Syaripah</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ACARA -->
  <section id="acara">
    <div class="card fade">
      <h3 class="section-title">Waktu & Tempat</h3>
      <p><strong>Akad Nikah</strong><br>08.00 WITA</p>
      <p><strong>Resepsi</strong><br>11.00 – 17.00 WITA</p>
      <p>Jl. Patimura, RT.003<br>Samarinda Seberang<br>(Samping ATM Mandiri Patimura)</p>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery">
    <div class="card fade">
      <h3 class="section-title">Galeri</h3>
      <div class="gallery" id="galleryInner">
        <img src="foto/sarah-1.jpeg" alt="">
        <img src="foto/sarah-2.jpeg" alt="">
        <img src="foto/sarah-3.jpeg" alt="">
        <img src="foto/sarah-4.jpeg" alt="">
        <img src="foto/sarah-5.jpeg" alt="">
        <img src="foto/sarah-6.jpeg" alt="">
      </div>
    </div>
  </section>

  <!-- HADIAH / KADO -->
  <section id="hadiah">
    <div class="card fade">
      <h3 class="section-title">Hadiah / Kado</h3>
      <p>Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun apabila berkenan memberikan tanda kasih, dapat melalui:</p>
      <div class="bank-info">
        <div class="bank-item">
          <strong>Bank BCA</strong>
          A/N: <em>Maisaroh</em><br>
          No. Rek: 1234567890
        </div>
        <div class="bank-item">
          <strong>Bank Mandiri</strong>
          A/N: <em>Aditya Hermawan</em><br>
          No. Rek: 0987654321
        </div>
      </div>
      <span class="small-muted">Terima kasih atas doa dan kebaikan hati Anda.</span>
    </div>
  </section>

  <!-- RSVP -->
  <section id="rsvp">
    <div class="card fade">
      <h3 class="section-title">Konfirmasi Kehadiran</h3>
      <form id="rsvpForm" class="rsvp">
        <input id="r_name" type="text" placeholder="Nama" required>
        <input id="r_phone" type="text" placeholder="No. HP (opsional)">
        <select id="r_attend">
          <option value="Hadir">Hadir</option>
          <option value="Tidak Hadir">Tidak Hadir</option>
        </select>
        <textarea id="r_message" rows="3" placeholder="Pesan / Doa"></textarea>
        <button class="btn-submit" type="submit">Kirim</button>
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
  <div class="bm-item bm-active" data-to="#hero"><i>🏠</i></div>
  <div class="bm-item" data-to="#mempelai"><i>👥</i></div>
  <div class="bm-item" data-to="#acara"><i>📅</i></div>
  <div class="bm-item" data-to="#gallery"><i>🖼️</i></div>
  <div class="bm-item" id="autoScrollToggle"><i id="autoI">⤓</i></div>
  <div class="bm-item" id="musicToggle"><i id="musicI">♪</i></div>
</div>

<!-- JS -->
<script src="script.js"></script>
</body>
</html>
