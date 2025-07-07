<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Xcode</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Xcode</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#program">Program</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="#">Profil</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <!-- Hero Section -->
<section class="hero">
  <div class="hero-content">
    <h1 id="typing-text">
      <!-- Efek akan diketik di sini -->
      <span id="typed-output"></span>
    </h1>
    <p>Bergabunglah dengan kami untuk mengembangkan diri di dunia profesional.</p>
    <a href="{{ route('pendaftaran.form') }}" class="cta-button">Isi Form Sekarang</a>
  </div>
</section>

    <!-- Tentang -->
    <section id="tentang" class="section-light">
        <h2>Tentang Kami</h2>
        <p>X-code atau dikenal juga Yogyafree lahir tanggal 5 Juni 2004 di Yogyakarta sebagai media pembelajaran hacking & keamanan komputer yang kemudian di bawah PT. Kode Keamanan Indonesia lalu akhirnya saat ini di bawah PT. Teknologi Server Indonesia.</p>
    </section>

    <section id="program" class="section-dark">
  <h2>Program Unggulan</h2>
  <div class="swiper program-slider">
    <div class="swiper-wrapper">

      <!-- Slide 1 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Program 1</h3>
        <img src="/images/bgxcode.jpg" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Percobaan woyyy masih ada yang belum pasti. Kembangkan potensimu dengan program ini.</p>
      </div>
    </div>

      <!-- Slide 2 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Program 1</h3>
        <img src="/images/bgxcode.jpg" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Percobaan woyyy masih ada yang belum pasti. Kembangkan potensimu dengan program ini.</p>
      </div>
    </div>


      <!-- Slide 3 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Program 1</h3>
        <img src="/images/bgxcode.jpg" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Percobaan woyyy masih ada yang belum pasti. Kembangkan potensimu dengan program ini.</p>
      </div>
    </div>


      <!-- Slide 4 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Program 1</h3>
        <img src="/images/bgxcode.jpg" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Percobaan woyyy masih ada yang belum pasti. Kembangkan potensimu dengan program ini.</p>
      </div>
    </div>


      <!-- Slide 5 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Program 1</h3>
        <img src="/images/bgxcode.jpg" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Percobaan woyyy masih ada yang belum pasti. Kembangkan potensimu dengan program ini.</p>
      </div>
    </div>


      <!-- Slide 6 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Program 1</h3>
        <img src="/images/bgxcode.jpg" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Percobaan woyyy masih ada yang belum pasti. Kembangkan potensimu dengan program ini.</p>
      </div>
    </div>


    </div>

    <!-- Navigasi -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>

    <!-- Kontak -->
    <section id="kontak" class="section-light">
        <h2>Hubungi Kami</h2>
        <p>Email: hohohohoho.com | WA: 0858-5657-5366</p> 
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper('.program-slider', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    speed: 1000,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });

 document.addEventListener("DOMContentLoaded", function () {
    const username = "{{ Auth::user()->name }}";
    const el = document.getElementById("typing-text");
    
    const textBeforeName = "Raih Pengalaman Magang Terbaik, Hallo ";
    const highlightedName = `<span class="username-highlight">${username}</span>`;
    
    let i = 0;

    function typeWriter() {
        if (i < textBeforeName.length) {
            el.innerHTML = textBeforeName.substring(0, i + 1);
            i++;
            setTimeout(typeWriter, 80);
        } else {
            el.innerHTML = textBeforeName + highlightedName;
        }
    }

    typeWriter();
});
</script>
</body>
</html>
