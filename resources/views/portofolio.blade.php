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
        /* Style inline opsional jika belum masuk ke app.css */
        .portfolio-item {
            transition: all 0.4s ease;
            overflow: hidden;
            display: block;
        }
        .portfolio-item.is-hidden {
            display: none; 
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
    
    {{-- Memanggil Header yang sudah kita buat tadi --}}
    @include('partials.header')

    <main class="max-w-7xl mx-auto px-6 pt-40 pb-16">
        <section id="portfolio-header" class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-4 scroll-animate uppercase tracking-tighter">Proyek Kami</h1>
            <p class="max-w-2xl mx-auto text-gray-400 scroll-animate delay-1">
                Jelajahi portofolio lengkap kami. Gunakan filter di bawah untuk mencari proyek berdasarkan keahlian tertentu.
            </p>
        </section>

        {{-- FILTER BUTTONS --}}
        <div id="filter-buttons" class="flex flex-wrap justify-center gap-4 mb-12 scroll-animate delay-2">
            <button class="filter-btn active py-2 px-6 rounded-full font-semibold" data-filter="all">Semua</button>
            <button class="filter-btn py-2 px-6 rounded-full font-semibold" data-filter="programmer">Programming</button>
            <button class="filter-btn py-2 px-6 rounded-full font-semibold" data-filter="penulisan">Penulisan</button>
            <button class="filter-btn py-2 px-6 rounded-full font-semibold" data-filter="desain">Desain</button>
        </div>

        {{-- PORTFOLIO GRID --}}
        <div id="portfolio-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($portfolios as $item)
                <a href="{{ route('portofolio.detail', $item->slug) }}" class="portfolio-item bg-gray-900/50 p-6 rounded-lg scroll-animate" data-category="{{ $item->category }}">
                    <div class="aspect-video overflow-hidden rounded mb-4 shadow-lg">
                        @if($item->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=No+Preview" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <span class="text-xs font-bold text-yellow-400 uppercase tracking-widest">{{ $item->category }}</span>
                    <h3 class="font-bold text-xl mt-1 text-white">{{ $item->title }}</h3>
                    <p class="text-gray-500 text-sm mt-2">{{ Str::limit($item->description, 100) }}</p>
                </a>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500 italic">Belum ada karya yang dipublish.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="border-t border-gray-800 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-8 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} JokiDesainSaja &bull; Designed by Jsuly</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Animasi Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.scroll-animate').forEach(t => observer.observe(t));

        // 2. Filter Portofolio
        const filterButtons = document.querySelectorAll('.filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const filter = button.getAttribute('data-filter');

                portfolioItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        item.classList.remove('is-hidden');
                    } else {
                        item.classList.add('is-hidden');
                    }
                });
            });
        });

        // 3. Logika Menu Mobile (Mengambil ID dari header partial)
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuBtn && closeBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => mobileMenu.classList.add('is-open'));
            closeBtn.addEventListener('click', () => mobileMenu.classList.remove('is-open'));
            
            document.querySelectorAll('.menu-link').forEach(link => {
                link.addEventListener('click', () => mobileMenu.classList.remove('is-open'));
            });
        }
    });
    </script>
</body>
</html>