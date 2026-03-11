<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JokiDesainSaja</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
</head>
<body class="antialiased text-gray-200">
    
    {{-- Memanggil Header Terpisah --}}
    @include('partials.header')

    <div class="max-w-7xl mx-auto px-6">
        {{-- Hero Section --}}
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

        {{-- Services Section --}}
        <section id="services" class="py-20 md:py-32">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-12 scroll-animate">Layanan Joki Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                    <div class="bg-gray-900/50 p-8 rounded-lg scroll-animate delay-1">
                        <h3 class="text-2xl font-bold text-yellow-400 mb-4">Programming</h3>
                        <ul class="space-y-3 text-gray-400">
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Website Development</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Arduino Projects</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Web UI/UX Implementation</li>
                        </ul>
                    </div>
                    <div class="bg-gray-900/50 p-8 rounded-lg scroll-animate delay-2">
                        <h3 class="text-2xl font-bold text-yellow-400 mb-4">Penulisan</h3>
                        <ul class="space-y-3 text-gray-400">
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Cek Plagiarisme Turnitin</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Jasa Parafrase</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Pembuatan Power Point Profesional</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Penulisan Artikel Ilmiah</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Analisis Data & Interpretasi</li>
                        </ul>
                    </div>
                    <div class="bg-gray-900/50 p-8 rounded-lg scroll-animate delay-3">
                        <h3 class="text-2xl font-bold text-yellow-400 mb-4">Desain</h3>
                        <ul class="space-y-3 text-gray-400">
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Desain CAD (Autocad)</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Model 3D Sketchup</li>
                            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Jasa Desain Logo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        {{-- About Section --}}
        <section id="about" class="py-20 md:py-32">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 scroll-animate">Tentang Kami</h2>
                <p class="text-lg text-gray-400 leading-relaxed scroll-animate delay-1">Halo! Kami adalah tim desainer dan developer dari Palembang dengan hasrat untuk membangun solusi digital yang indah dan fungsional. Dengan pengalaman bertahun-tahun, kami fokus pada detail kecil yang membuat perbedaan besar dalam pengalaman pengguna. Kami percaya bahwa kolaborasi yang baik adalah kunci untuk menciptakan produk yang luar biasa, dan kami siap membantu mewujudkan ide-ide Anda menjadi realita digital.</p>
            </div>
        </section>
        
        {{-- Portfolio Section (Dinamis) --}}
        <section id="portfolio" class="py-20 md:py-32">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-12 scroll-animate">Portofolio Pilihan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($portfolios as $index => $item)
                        <a href="{{ route('portofolio.detail', $item->slug) }}" class="bg-gray-900/50 p-6 rounded-lg scroll-animate delay-{{ $index + 1 }} portfolio-item">
                            @if($item->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->title }}" class="h-48 w-full object-cover rounded mb-4">
                            @else
                                <img src="https://via.placeholder.com/400x250/1f2937/d1d5db?text=No+Image" alt="No Image" class="h-48 w-full object-cover rounded mb-4">
                            @endif
                            <h3 class="font-bold text-xl text-white">{{ $item->title }}</h3>
                            <p class="text-gray-500">{{ ucfirst($item->category) }}</p>
                        </a>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Belum ada portofolio yang ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
                <div class="text-center mt-16 scroll-animate delay-4">
                    <a href="{{ route('portofolio') }}" class="inline-block bg-yellow-400 text-gray-900 font-bold py-3 px-8 rounded-lg transition-transform duration-300 hover:bg-yellow-500 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 focus:ring-offset-gray-900">
                        Lihat Semua Proyek
                    </a>
                </div>
            </div>
        </section>
        
        {{-- Contact Section (Hanya Role User) --}}
      <section id="contact" class="py-20 md:py-32">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6 scroll-animate uppercase tracking-tighter">Tim Profesional Kami</h2>
        <p class="text-lg text-gray-400 leading-relaxed mb-12 scroll-animate delay-1">Klik pada profil untuk melihat detail keahlian atau hubungi langsung via WhatsApp.</p>
        
        <div class="flex flex-wrap justify-center items-center gap-12">
            @forelse ($users as $index => $userRole)
                <div class="flex flex-col items-center scroll-animate delay-{{ $index + 1 }}">
                    {{-- Bungkus Foto dengan Link ke Profile Detail --}}
                    <a href="{{ route('profile.detail', $userRole->id) }}" class="relative group mb-4">
                        {{-- Efek Glow Kuning di Belakang Foto --}}
                        <div class="absolute -inset-1 bg-yellow-400 rounded-full blur opacity-10 group-hover:opacity-40 transition duration-500"></div>
                        
                        <div class="relative w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden border-2 border-yellow-400 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            {{-- LOGIKA GAMBAR --}}
                            @if($userRole->profile && ($userRole->profile->photo || $userRole->profile->foto))
                                <img src="{{ asset('storage/' . ($userRole->profile->photo ?? $userRole->profile->foto)) }}" 
                                     alt="{{ $userRole->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                {{-- Placeholder jika gambar kosong --}}
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                    <span class="text-4xl font-bold text-yellow-400">{{ substr($userRole->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Overlay "VIEW CV" saat Hover --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="bg-black/80 text-[10px] text-yellow-400 px-3 py-1.5 rounded-full font-black tracking-widest uppercase border border-yellow-400/50">VIEW CV</span>
                        </div>
                    </a>

                    {{-- Info Nama & Link WA --}}
                    <div class="text-center">
                        <h4 class="text-white font-bold text-lg mb-1 tracking-tight">{{ $userRole->name }}</h4>
                        <p class="text-gray-500 text-xs mb-3 uppercase tracking-widest">{{ $userRole->profile->job_title ?? 'Professional Talent' }}</p>
                        
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userRole->profile->phone ?? $userRole->profile->no_hp ?? '') }}" 
                           target="_blank" 
                           class="inline-flex items-center justify-center gap-2 text-green-500 hover:text-green-400 transition-colors group/wa">
                            <svg class="w-5 h-5 group-hover/wa:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.269.654 4.385 1.873 6.138l-.997 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.371-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.372c-.272.296-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            <span class="text-[10px] font-black tracking-[0.2em] uppercase">WhatsApp</span>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 italic">Belum ada tim profesional yang tersedia.</p>
            @endforelse
        </div>
    </div>
</section>
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
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            const targets = document.querySelectorAll('.scroll-animate');
            targets.forEach(target => observer.observe(target));
    
            // Logika Menu Mobile (mengambil ID dari header partial)
            const menuBtn = document.getElementById('menu-btn');
            const closeBtn = document.getElementById('close-btn'); 
            const mobileMenu = document.getElementById('mobile-menu');
            const menuLinks = document.querySelectorAll('.menu-link');
    
            if(menuBtn) {
                menuBtn.addEventListener('click', () => mobileMenu.classList.add('is-open'));
            }
            if(closeBtn) {
                closeBtn.addEventListener('click', () => mobileMenu.classList.remove('is-open'));
            }
            menuLinks.forEach(link => {
                link.addEventListener('click', () => mobileMenu.classList.remove('is-open'));
            });
        });
    </script>
</body>
</html>