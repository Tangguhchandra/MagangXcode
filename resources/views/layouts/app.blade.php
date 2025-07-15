<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aplikasi Magang') }}</title>

    <!-- Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Dashboard Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- AOS Animate On Scroll -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <style>
        .fade-bg {
            opacity: 0;
            animation: fadeInBg 1.5s ease-in-out forwards;
        }

        @keyframes fadeInBg {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Ensure proper spacing for fixed navbar */
        body {
            padding-top: 80px;
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
        }
    </style>

</head>

<body class="fade-bg font-sans leading-normal tracking-wide">
    {{-- Include Navbar Component --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    {{-- JavaScript --}}
    <script>
        AOS.init();

        // Navbar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburger');
            const sideMenu = document.getElementById('sideMenu');
            const overlay = document.getElementById('overlay');
            const closeBtn = document.getElementById('closeBtn');

            // Check if elements exist before adding event listeners
            if (hamburger && sideMenu && overlay && closeBtn) {
                // Open menu
                hamburger.addEventListener('click', () => {
                    hamburger.classList.add('active');
                    sideMenu.classList.add('open');
                    overlay.classList.add('show');
                    document.body.style.overflow = 'hidden';
                });

                // Close menu via close button
                closeBtn.addEventListener('click', () => {
                    closeMenu();
                });

                // Close menu via overlay
                overlay.addEventListener('click', () => {
                    closeMenu();
                });

                // Close menu function
                function closeMenu() {
                    hamburger.classList.remove('active');
                    sideMenu.classList.remove('open');
                    overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }

                // Close menu on escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && sideMenu.classList.contains('open')) {
                        closeMenu();
                    }
                });

                // Smooth scrolling for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                            // Close mobile menu if open
                            if (sideMenu.classList.contains('open')) {
                                closeMenu();
                            }
                        }
                    });
                });
            }

            // Navbar scroll effect
            let lastScrollTop = 0;
            const navbar = document.querySelector('.navbar');
            const mobileNavbar = document.querySelector('.mobile-navbar');

            window.addEventListener('scroll', () => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 50) {
                    if (navbar) navbar.style.background = 'rgba(0, 0, 0, 0.95)';
                    if (mobileNavbar) mobileNavbar.style.background = 'rgba(0, 0, 0, 0.95)';
                } else {
                    if (navbar) navbar.style.background = 'rgba(0, 0, 0, 0.9)';
                    if (mobileNavbar) mobileNavbar.style.background = 'rgba(0, 0, 0, 0.9)';
                }

                lastScrollTop = scrollTop;
            });
        });
    </script>
</body>

</html>
