<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JokiDesainSaja</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { scroll-behavior: smooth; }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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
        .delay-4 { transition-delay: 0.8s; }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.is-open {
            transform: translateX(0);
        }

        .portfolio-item, .social-link {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .portfolio-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(255, 255, 0, 0.2);
        }
        .social-link:hover {
            transform: translateY(-5px);
            color: #facc15; /* Tailwind yellow-400 */
        }
    </style>
</head>
<body class="antialiased text-gray-200">
    
    <header class="fixed top-0 left-0 w-full p-6 z-20 bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#home" class="text-xl font-bold tracking-wider z-30 text-yellow-400">JokiDesainSaja</a> 
            <nav class="hidden md:flex items-center gap-8 text-gray-400">
                <a href="#home" class="hover:text-yellow-400 transition-colors">Home</a>
                <a href="#about" class="hover:text-yellow-400 transition-colors">About</a>
                <a href="#services" class="hover:text-yellow-400 transition-colors">Layanan</a>
                <a href="#portfolio" class="hover:text-yellow-400 transition-colors">Portfolio</a>
                <a href="#contact" class="hover:text-yellow-400 transition-colors">Contact</a>
                <a href="#contact" class="hover:text-yellow-400 transition-colors">Login</a>
            </nav>
            <div class="md:hidden z-30">
                <button id="menu-btn" class="text-yellow-400 focus:outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg></button>
            </div>
        </div>
    </header>

    <div id="mobile-menu" class="mobile-menu fixed top-0 right-0 w-full max-w-sm h-full bg-gray-900 z-20 p-6">
        <div class="flex justify-between items-center mb-12">
            <a href="#home" class="text-xl font-bold tracking-wider text-yellow-400 menu-link">JokiDesainSaja</a> 
            <button id="close-btn" class="text-gray-400 hover:text-yellow-400 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    
        <nav class="flex flex-col items-start gap-6 text-xl">
            <a href="#home" class="hover:text-yellow-400 transition-colors menu-link">Home</a>
            <a href="#about" class="hover:text-yellow-400 transition-colors menu-link">About</a>
            <a href="#services" class="hover:text-yellow-400 transition-colors menu-link">Layanan</a>
            <a href="#portfolio" class="hover:text-yellow-400 transition-colors menu-link">Portfolio</a>
            <a href="#contact" class="hover:text-yellow-400 transition-colors menu-link">Contact</a>
            <a href="#contact" class="hover:text-yellow-400 transition-colors menu-link">Login</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:text-yellow-400 transition-colors menu-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-yellow-400 transition-colors menu-link">Log in</a>
                @endauth
            @endif
        </nav>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <section id="home" class="min-h-screen flex items-center justify-center text-center">
            <main>
                <h2 class="text-lg md:text-xl text-yellow-400 mb-4 mt-5 scroll-animate delay-1">
                    Solusi Profesional untuk Tugas Programming, Desain, & Penulisan
                </h2>
                <h1 class="text-5xl md:text-8xl font-bold leading-tight mb-8 scroll-animate delay-2">
                    Fokus pada Hal Penting, <br /> Serahkan Sisanya pada Kami
                </h1>
                <p class="max-w-2xl mx-auto text-gray-400 scroll-animate delay-3">
                    Tim kami siap membantu menyelesaikan tugas dan proyek Anda dengan cepat, efisien, dan hasil yang memuaskan.
                </p>
            </main>
        </section>
        <section id="services" class="py-20 md:py-32"><div class="max-w-6xl mx-auto text-center"><h2 class="text-4xl md:text-5xl font-bold mb-12 scroll-animate">Layanan Joki Kami</h2><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left"><div class="bg-gray-900/50 p-8 rounded-lg scroll-animate delay-1"><h3 class="text-2xl font-bold text-yellow-400 mb-4">Programming</h3><ul class="space-y-3 text-gray-400"><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Website Development</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Arduino Projects</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Web UI/UX Implementation</li></ul></div><div class="bg-gray-900/50 p-8 rounded-lg scroll-animate delay-2"><h3 class="text-2xl font-bold text-yellow-400 mb-4">Penulisan</h3><ul class="space-y-3 text-gray-400"><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Cek Plagiarisme Turnitin</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Jasa Parafrase</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Pembuatan Power Point Profesional</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Penulisan Artikel Ilmiah</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Analisis Data & Interpretasi</li></ul></div><div class="bg-gray-900/50 p-8 rounded-lg scroll-animate delay-3"><h3 class="text-2xl font-bold text-yellow-400 mb-4">Desain</h3><ul class="space-y-3 text-gray-400"><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Desain CAD (Autocad)</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Model 3D Sketchup</li><li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Jasa Desain Logo</li></ul></div></div></div></section>
        
        <section id="about" class="py-20 md:py-32"><div class="max-w-4xl mx-auto text-center"><h2 class="text-4xl md:text-5xl font-bold mb-6 scroll-animate">Tentang Kami</h2><p class="text-lg text-gray-400 leading-relaxed scroll-animate delay-1">Halo! Kami adalah tim desainer dan developer dari Palembang dengan hasrat untuk membangun solusi digital yang indah dan fungsional. Dengan pengalaman bertahun-tahun, kami fokus pada detail kecil yang membuat perbedaan besar dalam pengalaman pengguna. Kami percaya bahwa kolaborasi yang baik adalah kunci untuk menciptakan produk yang luar biasa, dan kami siap membantu mewujudkan ide-ide Anda menjadi realita digital.</p></div></section>
        
        <section id="portfolio" class="py-20 md:py-32"><div class="max-w-6xl mx-auto"><h2 class="text-4xl md:text-5xl font-bold text-center mb-12 scroll-animate">Portofolio Pilihan</h2><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-gray-900/50 p-6 rounded-lg scroll-animate delay-1 portfolio-item">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=E-commerce+Website" alt="Website E-commerce" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Website E-commerce Modern</h3>
                <p class="text-gray-500">Programming</p>
            </div>
            <div class="bg-gray-900/50 p-6 rounded-lg scroll-animate delay-2 portfolio-item">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Data+Analysis+Report" alt="Analisis Data Penjualan" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Laporan Analisis Data Komprehensif</h3>
                <p class="text-gray-500">Penulisan & Analisis</p>
            </div>
            <div class="bg-gray-900/50 p-6 rounded-lg scroll-animate delay-3 portfolio-item">
                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=Coffee+Shop+Logo" alt="Desain Logo Kopi" class="h-48 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl">Desain Logo Cafe Kopi Minimalis</h3>
                <p class="text-gray-500">Desain Grafis</p>
            </div>
        </div></div></section>
        
        <section id="contact" class="py-20 md:py-32"><div class="max-w-4xl mx-auto text-center"><h2 class="text-4xl md:text-5xl font-bold mb-6 scroll-animate">Hubungi Kami</h2><p class="text-lg text-gray-400 leading-relaxed mb-12 scroll-animate delay-1">Jangan ragu untuk menghubungi kami melalui media sosial di bawah ini untuk konsultasi atau pemesanan layanan.</p><div class="flex flex-wrap justify-center items-center gap-8"><a href="https://wa.me/6281234567890" target="_blank" class="text-gray-400 social-link scroll-animate delay-2" title="Admin 1"><svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.269.654 4.385 1.873 6.138l-.997 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.371-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.296-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg><span class="mt-2 text-xs">Admin 1</span></a><a href="https://wa.me/6281234567891" target="_blank" class="text-gray-400 social-link scroll-animate delay-3" title="Admin 2"><svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.269.654 4.385 1.873 6.138l-.997 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.371-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.296-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg><span class="mt-2 text-xs">Admin 2</span></a><a href="https://wa.me/6281234567892" target="_blank" class="text-gray-400 social-link scroll-animate delay-4" title="Admin 3"><svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.269.654 4.385 1.873 6.138l-.997 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.371-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.296-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg><span class="mt-2 text-xs">Admin 3</span></a><a href="https://instagram.com/username" target="_blank" class="text-gray-400 social-link scroll-animate delay-4"><svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.585-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.585.069-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44 1.441-.645 1.441-1.44c0-.795-.645-1.44-1.441-1.44z"/></svg><span class="mt-2 text-xs">Instagram</span></a></div></div></section>
    </div>

    <footer class="border-t border-gray-800 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-8 text-center text-gray-500">
            <p class="scroll-animate">
                &copy; {{ date('Y') }} JokiDesainSaja &bull; Designed by Jsuly
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Logika untuk Animasi Scroll ---
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            const targets = document.querySelectorAll('.scroll-animate');
            targets.forEach(target => observer.observe(target));
    
            // --- Logika untuk Menu Mobile ---
            const menuBtn = document.getElementById('menu-btn');
            const closeBtn = document.getElementById('close-btn'); // Tombol penutup baru
            const mobileMenu = document.getElementById('mobile-menu');
            const menuLinks = document.querySelectorAll('.menu-link');
    
            // Fungsi untuk membuka menu
            const openMenu = () => mobileMenu.classList.add('is-open');
            
            // Fungsi untuk menutup menu
            const closeMenu = () => mobileMenu.classList.remove('is-open');
    
            // Event listener
            menuBtn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            menuLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });
        });
    </script>
</body>
</html>