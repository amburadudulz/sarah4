<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split Invitation</title>

    <!-- CSS di folder yang sama -->
    <link rel="stylesheet" href="split.css">
</head>

<body>

<div id="split-wrapper">

    <!-- ================= PANEL KIRI ================= -->
    <aside id="left-panel">

        <!-- Background foto statis -->
        <div class="left-bg">
            <img src="img/cover.jpg" alt="">
        </div>

        <!-- Nature leaf left -->
        <div class="nature-left">
            <img src="img/tree-1.webp" class="leaf-floating" style="top:20%; left:10%; width:160%;">
            <img src="img/tree-2.webp" class="leaf-floating" style="top:40%; left:-5%; width:150%;">
            <img src="img/tree-3.webp" class="leaf-floating" style="bottom:15%; left:20%; width:170%;">
        </div>

        <!-- Salju kiri -->
        <div id="snow-left"></div>

        <!-- Teks mempelai -->
        <div class="left-title">
            <h1 class="animate-title">Fulan & Fulanah</h1>
            <p class="animate-sub">Wedding Invitation</p>
        </div>

    </aside>

    <!-- ================= PANEL KANAN ================= -->
    <main id="right-panel">

        <!-- Nature leaf + bird kanan -->
        <div class="nature-right">
            <img src="img/tree-1.webp" class="leaf-floating" style="top:15%; left:50%; width:170%;">
            <img src="img/tree-2.webp" class="leaf-floating" style="top:35%; right:0%; width:150%;">
            <img src="img/bird.webp" data-bird class="bird-moving">
        </div>

        <!-- KONTEN -->
        <section class="section hero">
            <h2 class="fade">The Wedding Of</h2>
            <h1 class="fade big">Fulan & Fulanah</h1>
            <p class="fade">12 • 11 • 2025</p>
        </section>

        <section class="section story fade">
            <h2>Our Story</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lorem nec velit posuere...</p>
        </section>

        <section class="section gallery fade">
            <h2>Gallery</h2>
            <div class="gallery-grid">
                <img src="img/g1.jpg">
                <img src="img/g2.jpg">
                <img src="img/g3.jpg">
                <img src="img/g4.jpg">
            </div>
        </section>

        <section class="section rsvp fade">
            <h2>RSVP</h2>
            <form>
                <input type="text" placeholder="Nama" required>
                <select>
                    <option>Hadir</option>
                    <option>Tidak Hadir</option>
                </select>
                <button type="submit">Kirim</button>
            </form>
        </section>

        <footer class="section fade">
            <p>© 2025 Fulan & Fulanah</p>
        </footer>

    </main>

</div>

<!-- JS di folder yang sama -->
<script src="split.js"></script>
</body>
</html>
