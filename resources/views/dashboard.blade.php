<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>MagangXcode</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
    <!-- Kiri: Logo -->
    <div class="logo">MagangXcode</div>

    <!-- Tengah: Menu Navigasi -->
    <ul class="nav-links" style="position: absolute; left: 50%; transform: translateX(-50%);">
        <li><a href="#">Home</a></li>
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#program">Program</a></li>
        <li><a href="#kontak">Kontak</a></li>
    </ul>

    <!-- Kanan: Ikon Profil & Logout -->
    <div style="display: flex; align-items: center; gap: 20px;">
        <!-- Profil -->
        <a href="{{ route('profil') }}" class="profil-icon" title="Profil">
          <i class="fas fa-user-circle fa-2x"></i>
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn" title="Logout">
                <i class="fas fa-sign-out-alt fa-lg"></i>
            </button>
        </form>
    </div>
    <div class="mobile-only">
    <div class="hamburger" id="hamburger">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <div class="side-menu" id="sideMenu">
    <span class="close-btn" id="closeBtn">&times;</span>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#tentang">Tentang</a></li>
      <li><a href="#program">Program</a></li>
      <li><a href="#kontak">Kontak</a></li>
      <li><a href="{{ route('profil') }}">Profil</a></li>
      <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
  </div>

  <div class="overlay" id="overlay"></div>
    </div>
    </div>
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
        <div class="konten-tentang">
          <img src="{{ asset('images/hero2.png') }}" alt="" width="40%"> 
          <p>X-code atau dikenal juga Yogyafree lahir tanggal 5 Juni 2004 di Yogyakarta sebagai media pembelajaran hacking & keamanan komputer yang kemudian di bawah PT. Kode Keamanan Indonesia lalu akhirnya saat ini di bawah PT. Teknologi Server Indonesia.</p>
        </div>
    </section>

    <section id="program" class="section-dark">
  <h2>Program Unggulan</h2>
  <div class="swiper program-slider">
    <div class="swiper-wrapper">

      <!-- Slide 1 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Cyber Security</h3>
        <img src="{{ asset('images/program1.png') }}" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Jadilah garda terdepan dalam melindungi sistem digital. Di divisi Cyber Security, kamu akan belajar mengenali ancaman, menganalisis kerentanan, dan menjaga keamanan data dari serangan siber.</p>
      </div>
    </div>

      <!-- Slide 2 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Programming</h3>
        <img src="{{ asset('images/program2.png') }}" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Tunjukkan kemampuan logikamu dengan membangun aplikasi dan sistem yang bermanfaat. Divisi Programming akan membimbingmu mengembangkan software dari nol, mulai dari backend, frontend, hingga pemrograman berbasis objek.</p>
      </div>
    </div>


      <!-- Slide 3 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Public Relation</h3>
        <img src="{{ asset('images/program3.png') }}" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Asah kemampuan komunikasi dan branding-mu. Di divisi Public Relation, kamu akan belajar membuat konten kreatif, mengelola media sosial, dan menjaga citra positif XCode di mata publik.</p>
      </div>
    </div>


      <!-- Slide 4 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Designing</h3>
        <img src="{{ asset('images/program4.png') }}" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Buat tampilan yang memukau dan user-friendly. Divisi Designer akan mengasah skill-mu dalam desain UI/UX, branding visual, serta mengolah ide menjadi karya digital yang profesional.</p>
      </div>
    </div>


      <!-- Slide 5 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>IT Network & Hardware</h3>
        <img src="{{ asset('images/program5.png') }}" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Kenali lebih dalam dunia perangkat keras dan jaringan. Di divisi ini, kamu akan belajar mengelola server, merakit komputer, hingga troubleshooting hardware secara langsung.</p>
      </div>
    </div>


      <!-- Slide 6 -->
    <div class="swiper-slide program-slide">
      <div class="image-section">
        <h3>Network Engineering</h3>
        <img src="{{ asset('images/program6.png') }}" alt="Program 1">
      </div>
      <div class="desc-section">
        <p>Bangun dan kelola infrastruktur jaringan yang andal. Divisi Network Engineer akan membekalimu dengan skill konfigurasi jaringan, manajemen bandwidth, dan monitoring sistem yang mendukung kelancaran operasional IT.</p>
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
    <section class="contact-section">
    <h2>Kontak</h2>
    <p>Untuk informasi lebih lanjut, hubungi kami melalui:</p>

    <div class="contact-cards">
      <!-- Email Card -->
      <a href="mailto:xcodetrainning@gmail.com" class="card email-card">
        <i class="fa-regular icon fa-envelope" style="color: #ff4013;"></i>
        <div class="card-text">
          <h4>Email</h4>
          <p>Email Admin Xcode</p>
        </div>
      </a>

      <!-- WhatsApp Card -->
      <a href="https://wa.me/62895420754477" class="card whatsapp-card">
        <i class="fas fa-phone icon whatsapp-icon"></i>
        <div class="card-text">
          <h4>WhatsApp</h4>
          <p>WhatsApp Admin Xcode</p>
        </div>
      </a>
    </div>
  </section>

  <footer class="footer">
    <p>© 2025 XCODE Internships. All rights reserved.</p>
  </footer>


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
    
    const textBeforeName = "Raih Pengalaman Magang Terbaik, Hello ";
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

    const hamburger = document.getElementById('hamburger');
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('overlay');
    const closeBtn = document.getElementById('closeBtn');

    hamburger.addEventListener('click', () => {
      sideMenu.classList.add('open');
      overlay.classList.add('show');
    });

    closeBtn.addEventListener('click', () => {
      sideMenu.classList.remove('open');
      overlay.classList.remove('show');
    });

    overlay.addEventListener('click', () => {
      sideMenu.classList.remove('open');
      overlay.classList.remove('show');
    });
});
</script>
</body>
</html>
