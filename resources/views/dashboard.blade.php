@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 id="typing-text">
            </h1>
            <p>Bergabunglah dengan kami untuk mengembangkan diri di dunia profesional.</p>
            <a href="{{ route('pendaftaran.form') }}" class="cta-button">Isi Form Sekarang</a>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="section-light">
        <h2>Tentang Kami</h2>
        <div class="konten-tentang">
            <img src="{{ asset('images/2.jpeg') }}" alt="" width="40%">
            <p>X-code atau dikenal juga Yogyafree lahir tanggal 5 Juni 2004 di Yogyakarta sebagai media pembelajaran hacking
                & keamanan komputer yang kemudian di bawah PT. Kode Keamanan Indonesia lalu akhirnya saat ini di bawah PT.
                Teknologi Server Indonesia.</p>
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
                        <p>Jadilah garda terdepan dalam melindungi sistem digital. Di divisi Cyber Security, kamu akan
                            belajar mengenali ancaman, menganalisis kerentanan, dan menjaga keamanan data dari serangan
                            siber.</p>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide program-slide">
                    <div class="image-section">
                        <h3>Programming</h3>
                        <img src="{{ asset('images/program2.png') }}" alt="Program 2">
                    </div>
                    <div class="desc-section">
                        <p>Tunjukkan kemampuan logikamu dengan membangun aplikasi dan sistem yang bermanfaat. Divisi
                            Programming akan membimbingmu mengembangkan software dari nol, mulai dari backend, frontend,
                            hingga pemrograman berbasis objek.</p>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide program-slide">
                    <div class="image-section">
                        <h3>Public Relation</h3>
                        <img src="{{ asset('images/program3.png') }}" alt="Program 3">
                    </div>
                    <div class="desc-section">
                        <p>Asah kemampuan komunikasi dan branding-mu. Di divisi Public Relation, kamu akan belajar membuat
                            konten kreatif, mengelola media sosial, dan menjaga citra positif XCode di mata publik.</p>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide program-slide">
                    <div class="image-section">
                        <h3>Designing</h3>
                        <img src="{{ asset('images/program4.png') }}" alt="Program 4">
                    </div>
                    <div class="desc-section">
                        <p>Buat tampilan yang memukau dan user-friendly. Divisi Designer akan mengasah skill-mu dalam desain
                            UI/UX, branding visual, serta mengolah ide menjadi karya digital yang profesional.</p>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="swiper-slide program-slide">
                    <div class="image-section">
                        <h3>IT Network & Hardware</h3>
                        <img src="{{ asset('images/program5.png') }}" alt="Program 5">
                    </div>
                    <div class="desc-section">
                        <p>Kenali lebih dalam dunia perangkat keras dan jaringan. Di divisi ini, kamu akan belajar mengelola
                            server, merakit komputer, hingga troubleshooting hardware secara langsung.</p>
                    </div>
                </div>

                <!-- Slide 6 -->
                <div class="swiper-slide program-slide">
                    <div class="image-section">
                        <h3>Network Engineering</h3>
                        <img src="{{ asset('images/program6.png') }}" alt="Program 6">
                    </div>
                    <div class="desc-section">
                        <p>Bangun dan kelola infrastruktur jaringan yang andal. Divisi Network Engineer akan membekalimu
                            dengan skill konfigurasi jaringan, manajemen bandwidth, dan monitoring sistem yang mendukung
                            kelancaran operasional IT.</p>
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
    <section id="kontak" class="contact-section">
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Typing Effect Personalized
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

        // Swiper Init
        const swiper = new Swiper('.program-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 1,
                }
            }
        });
    });
</script>

<!-- Floating FAQ Button -->
<div id="faqButton" onclick="openFaq()" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #e63946;
    color: white;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    cursor: pointer;
    z-index: 999;
    transition: background 0.3s;
">
    <i class="fas fa-question"></i>
</div>

<!-- FAQ Popup -->
<div id="faqPopup" style="
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 320px;
    max-height: 420px;
    background: white;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    padding: 15px;
    overflow-y: auto;
    z-index: 1000;
">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h4 style="margin: 0;">❓ FAQ</h4>
        <button onclick="closeFaq()" style="border: none; background: none; font-size: 22px; color: #e74c3c;">&times;</button>
    </div>
    <hr>
    @php
        $faqs = [
            ['q' => 'Bagaimana cara mendaftar?', 'a' => 'Silakan isi formulir pendaftaran dengan cara klik "Isi form sekarang".'],
            ['q' => 'Apakah pemagang masuk di akhir pekan?', 'a' => 'Tidak, pemagang hanya bekerja dari Senin sampai Jumat.'],
            ['q' => 'Bagaimana sistem jam kerja pemagang?', 'a' => 'Pemagang menggunakan sistem shift: pagi dan siang.'],
            ['q' => 'Jam kerja shift pagi mulai pukul berapa?', 'a' => 'Shift pagi dimulai pukul 08.00 hingga 12.00.'],
            ['q' => 'Jam kerja shift siang mulai pukul berapa?', 'a' => 'Shift siang dimulai pukul 12.00 hingga 16.00.']
        ];
    @endphp

    @foreach ($faqs as $faq)
        <div style="margin-bottom: 12px;">
            <strong style="color: #333;">{{ $faq['q'] }}</strong><br>
            <span style="color: #666;">{{ $faq['a'] }}</span>
        </div>
    @endforeach
</div>

<script>
    function openFaq() {
        document.getElementById('faqPopup').style.display = 'block';
    }

    function closeFaq() {
        document.getElementById('faqPopup').style.display = 'none';
    }

    // Tutup popup jika klik di luar
    window.addEventListener('click', function(e) {
        const popup = document.getElementById('faqPopup');
        const button = document.getElementById('faqButton');
        if (!popup.contains(e.target) && !button.contains(e.target)) {
            popup.style.display = 'none';
        }
    });
</script>


@endsection
