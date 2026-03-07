<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portofolio - JokiDesainSaja</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { scroll-behavior: smooth; }
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
            background-color: #000000;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .scroll-animate.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        .delay-1 { transition-delay: 0.2s; }
        .delay-2 { transition-delay: 0.4s; }
        .delay-3 { transition-delay: 0.6s; }
        
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.is-open {
            transform: translateX(0);
        }

        .portfolio-item {
            transition: transform 0.4s ease, opacity 0.4s ease, max-height 0.4s ease, padding 0.4s ease, margin 0.4s ease;
            overflow: hidden;
            max-height: 500px;
        }
        .portfolio-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(255, 255, 0, 0.2);
        }
        .portfolio-item.is-hidden {
            opacity: 0;
            transform: scale(0.95);
            max-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 0;
            margin-bottom: 0;
            pointer-events: none;
        }
        
        .filter-btn {
            transition: all 0.3s ease;
            border: 1px solid #4a5568;
        }
        .filter-btn.active, .filter-btn:hover {
            background-color: #facc15;
            color: #111827;
            border-color: #facc15;
        }
    </style>
</head>
<body class="antialiased text-gray-200">
    
    <header class="fixed top-0 left-0 w-full p-6 z-20 bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold tracking-wider z-30 text-yellow-400">JokiDesainSaja</a> 
            <nav class="hidden md:flex items-center gap-8 text-gray-400">
                <a href="/" class="hover:text-yellow-400 transition-colors">Home</a>
                <a href="{{ route('portofolio') }}" class="text-yellow-400 transition-colors">Portfolio</a>
                <a href="{{ route ('login') }}" class="hover:text-yellow-400 transition-colors">Login</a>
            </nav>
            <div class="md:hidden z-30">
                <button id="menu-btn" class="text-yellow-400 focus:outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg></button>
            </div>
        </div>
    </header>

    <div id="mobile-menu" class="mobile-menu fixed top-0 right-0 w-full max-w-sm h-full bg-gray-900 z-20 p-6">
        <div class="flex justify-between items-center mb-12">
            <a href="/" class="text-xl font-bold tracking-wider text-yellow-400 menu-link">JokiDesainSaja</a> 
            <button id="close-btn" class="text-gray-400 hover:text-yellow-400 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <nav class="flex flex-col items-start gap-6 text-xl">
            <a href="/" class="hover:text-yellow-400 transition-colors menu-link">Home</a>
            <a href="{{ route('portofolio') }}" class="hover:text-yellow-400 transition-colors menu-link">Portfolio</a>
            <a href="{{ route('login') }}" class="hover:text-yellow-400 transition-colors menu-link">Login</a>
        </nav>
    </div>

    <main class="max-w-7xl mx-auto px-6 pt-32 pb-16">
        <section id="portfolio-header" class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-4 scroll-animate">Proyek Kami</h1>
            <p class="max-w-2xl mx-auto text-gray-400 scroll-animate delay-1">
                Jelajahi beberapa proyek terbaik yang telah kami selesaikan di berbagai bidang.
            </p>
        </section>

        <div id="filter-buttons" class="flex flex-wrap justify-center gap-4 mb-12 scroll-animate delay-2">
            <button class="filter-btn active py-2 px-6 rounded-full font-semibold" data-filter="all">Semua</button>
            <button class="filter-btn py-2 px-6 rounded-full font-semibold" data-filter="programming">Programming</button>
            <button class="filter-btn py-2 px-6 rounded-full font-semibold" data-filter="penulisan">Penulisan</button>
            <button class="filter-btn py-2 px-6 rounded-full font-semibold" data-filter="desain">Desain</button>
        </div>

        <div id="portfolio-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="portfolio-item bg-gray-900/50 p-6 rounded-lg scroll-animate" data-category="programming">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Sistem+Informasi" alt="Sistem Informasi" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Sistem Informasi Akademik</h3>
                <p class="text-gray-500">Programming</p>
            </div>
            <div class="portfolio-item bg-gray-900/50 p-6 rounded-lg scroll-animate" data-category="desain">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Branding+Kit" alt="Branding Kit" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Desain Branding untuk Startup</h3>
                <p class="text-gray-500">Desain</p>
            </div>
            <div class="portfolio-item bg-gray-900/50 p-6 rounded-lg scroll-animate" data-category="penulisan">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Artikel+SEO" alt="Artikel SEO" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Penulisan Artikel SEO</h3>
                <p class="text-gray-500">Penulisan</p>
            </div>
            <div class="portfolio-item bg-gray-900/50 p-6 rounded-lg scroll-animate" data-category="programming">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Landing+Page" alt="Landing Page" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Implementasi UI/UX Landing Page</h3>
                <p class="text-gray-500">Programming</p>
            </div>
            <div class="portfolio-item bg-gray-900/50 p-6 rounded-lg scroll-animate" data-category="penulisan">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Parafrase+Jurnal" alt="Parafrase Jurnal" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Jasa Parafrase Jurnal Ilmiah</h3>
                <p class="text-gray-500">Penulisan</p>
            </div>
            <div class="portfolio-item bg-gray-900/50 p-6 rounded-lg scroll-animate" data-category="desain">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Model+3D" alt="Model 3D" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Model 3D Arsitektur Rumah</h3>
                <p class="text-gray-500">Desain</p>
            </div>
        </div>
    </main>

    <footer class="border-t border-gray-800 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-8 text-center text-gray-500">
            <p class="scroll-animate">
                &copy; {{ date('Y') }} JokiDesainSaja &bull; Designed by Jsuly
            </p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // -- Semua logika JavaScript digabung di sini --

        // 1. Logika Animasi Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });
        const targets = document.querySelectorAll('.scroll-animate');
        targets.forEach(target => observer.observe(target));

        // 2. Logika Filter Portofolio (DIPERBARUI DENGAN SORTING)
        const filterButtons = document.querySelectorAll('#filter-buttons .filter-btn');
        const portfolioGrid = document.getElementById('portfolio-grid');
        const portfolioItems = document.querySelectorAll('#portfolio-grid .portfolio-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const filter = button.getAttribute('data-filter');

                // === BAGIAN BARU: MENYUSUN ULANG ITEM ===
                // Ubah NodeList menjadi Array agar bisa di-sort
                const itemsArray = Array.from(portfolioItems);

                // Sortir array berdasarkan kategori yang dipilih
                itemsArray.sort((a, b) => {
                    const aCategory = a.getAttribute('data-category');
                    const bCategory = b.getAttribute('data-category');

                    // Jika filter "semua", jangan ubah urutan
                    if (filter === 'all') {
                        return 0;
                    }
                    // Jika item 'a' cocok dengan filter, pindahkan ke depan
                    if (aCategory === filter && bCategory !== filter) {
                        return -1;
                    }
                    // Jika item 'b' cocok dengan filter, pindahkan ke depan
                    if (aCategory !== filter && bCategory === filter) {
                        return 1;
                    }
                    // Jika keduanya sama (atau tidak cocok), pertahankan urutan asli
                    return 0;
                });

                // Terapkan urutan baru ke dalam grid
                itemsArray.forEach(item => {
                    portfolioGrid.appendChild(item);
                });
                
                // === BAGIAN ANIMASI FADE (SETELAH DISUSUN ULANG) ===
                portfolioItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.classList.remove('is-hidden');
                    } else {
                        item.classList.add('is-hidden');
                    }
                });
            });
        });

        // 3. Logika untuk Menu Mobile
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuLinks = document.querySelectorAll('.menu-link');
        
        const openMenu = () => mobileMenu.classList.add('is-open');
        const closeMenu = () => mobileMenu.classList.remove('is-open');
        
        if (menuBtn && closeBtn && mobileMenu) {
            menuBtn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            menuLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });
        }
    });
</script>
</body>
</html>