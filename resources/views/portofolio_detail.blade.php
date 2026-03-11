<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $portfolio->title }} - JokiDesainSaja</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
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

        .thumbnail-active { 
            border-color: #facc15 !important; 
            opacity: 1 !important; 
            transform: scale(1.05);
        }

        .glass-card { 
            background: rgba(17, 24, 39, 0.5); 
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.05); 
        }

        .main-image-container {
            position: relative;
            width: 100%;
            padding-top: 66.67%;
            overflow: hidden;
            background-color: #0a0a0a;
            border-radius: 1rem;
        }

        .main-image-container img {
            position: absolute;
            top: 0; left: 0; bottom: 0; right: 0;
            width: 100%;
            height: 100%;
            object-fit: contain; 
            transition: opacity 0.3s ease;
        }

        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #facc15; border-radius: 10px; }
    </style>
</head>
<body class="antialiased text-gray-200">
    
    @include('partials.header')

    <main class="max-w-7xl mx-auto px-6 pt-40 pb-16">
        {{-- Tombol Kembali Cerdas --}}
        <div class="mb-8 scroll-animate">
            <button onclick="goBack()" class="flex items-center gap-2 text-gray-500 hover:text-yellow-400 transition-colors group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-bold uppercase tracking-widest text-xs">Kembali</span>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            {{-- SISI KIRI: Galeri Foto --}}
            <div class="lg:col-span-7 space-y-6 scroll-animate delay-1">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-yellow-400/10 rounded-2xl blur opacity-25"></div>
                    <div class="main-image-container border border-gray-800 shadow-2xl">
                        @if($portfolio->images->isNotEmpty())
                            <img id="activeView" src="{{ asset('storage/' . $portfolio->images->first()->image_path) }}" alt="{{ $portfolio->title }}">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center italic text-gray-600">Gambar tidak tersedia</div>
                        @endif
                    </div>
                </div>
                
                <div class="flex gap-4 overflow-x-auto py-2 custom-scrollbar">
                    @foreach($portfolio->images as $index => $img)
                        <div class="flex-shrink-0 w-24 h-16 bg-gray-900 rounded-lg overflow-hidden border-2 border-transparent transition-all">
                            <img src="{{ asset('storage/' . $img->image_path) }}" 
                                 onclick="changeImage(this)"
                                 class="w-full h-full object-cover cursor-pointer opacity-50 hover:opacity-100 transition-all {{ $index == 0 ? 'thumbnail-active' : '' }}">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- SISI KANAN: Detail Info --}}
            <div class="lg:col-span-5 space-y-8 scroll-animate delay-2">
                <div class="space-y-4">
                    <span class="text-yellow-400 text-sm font-bold tracking-widest uppercase">{{ $portfolio->category }}</span>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight text-white tracking-tighter">{{ $portfolio->title }}</h1>
                    <p class="text-gray-400 italic">{{ str_replace('-', ' ', ucfirst($portfolio->subcategory)) }}</p>
                </div>

                <div class="glass-card p-8 rounded-2xl space-y-6">
                    <div class="space-y-3">
                        <h3 class="text-lg font-bold text-yellow-400">Deskripsi Proyek</h3>
                        <div class="text-gray-400 leading-relaxed text-sm">
                            {!! nl2br(e($portfolio->description)) !!}
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-800 flex justify-between items-center text-xs">
                        <span class="text-gray-500 italic">Selesai pada: {{ $portfolio->created_at->format('d M Y') }}</span>
                        <span class="px-3 py-1 bg-gray-800 rounded-full text-yellow-400/80 font-bold uppercase tracking-tighter">{{ ucfirst($portfolio->category) }}</span>
                    </div>
                </div>

                {{-- Action Buttons: Melebar otomatis jika Live Preview kosong --}}
                <div class="grid {{ $portfolio->project_url ? 'grid-cols-1 sm:grid-cols-2' : 'grid-cols-1' }} gap-4">
                    @if($portfolio->project_url)
                        <a href="{{ $portfolio->project_url }}" target="_blank" 
                           class="bg-white text-gray-900 text-center font-bold py-4 rounded-xl hover:bg-yellow-400 transition-all shadow-lg uppercase tracking-tighter">
                            Live Preview
                        </a>
                    @endif
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $portfolio->user->profile->phone ?? $portfolio->user->profile->no_hp ?? '') }}" 
                       class="bg-yellow-400 text-gray-900 text-center font-bold py-4 rounded-xl hover:bg-yellow-500 transition-all shadow-lg uppercase tracking-tighter">
                        Hubungi Penjoki
                    </a>
                </div>

                {{-- Dikerjakan Oleh: Link ke CV Detail --}}
                <div class="p-6 rounded-2xl bg-gray-900/50 border border-gray-800 flex items-center gap-4 group">
                    <a href="{{ route('profile.detail', $portfolio->user->id) }}" class="flex-shrink-0 relative">
                        <div class="absolute -inset-1 bg-yellow-400 rounded-full blur opacity-0 group-hover:opacity-30 transition-opacity"></div>
                        @if($portfolio->user->profile && ($portfolio->user->profile->photo || $portfolio->user->profile->foto))
                             <img src="{{ asset('storage/' . ($portfolio->user->profile->photo ?? $portfolio->user->profile->foto)) }}" 
                                  class="relative w-14 h-14 rounded-full object-cover border-2 border-yellow-400 group-hover:scale-105 transition-transform">
                        @else
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($portfolio->user->name) }}&background=facc15&color=000" 
                                  class="relative w-14 h-14 rounded-full object-cover border-2 border-yellow-400 group-hover:scale-105 transition-transform">
                        @endif
                    </a>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Dikerjakan oleh:</p>
                        <a href="{{ route('profile.detail', $portfolio->user->id) }}" class="font-bold text-white text-lg hover:text-yellow-400 transition-colors">
                            {{ $portfolio->user->name }}
                        </a>
                    </div>
                    <a href="{{ route('profile.detail', $portfolio->user->id) }}" class="ml-auto text-gray-600 hover:text-yellow-400 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-gray-800 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-8 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} JokiDesainSaja &bull; Designed by Jsuly</p>
        </div>
    </footer>

    <script>
        // Fungsi Kembali ke riwayat sebelumnya
        function goBack() {
            if (document.referrer !== "" && document.referrer.includes(window.location.host)) {
                window.history.back();
            } else {
                window.location.href = "{{ route('portofolio') }}";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Animasi Scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.scroll-animate').forEach(t => observer.observe(t));
        });

        // Switcher Gambar Utama
        function changeImage(element) {
            const mainImg = document.getElementById('activeView');
            mainImg.style.opacity = '0';
            setTimeout(() => {
                mainImg.src = element.src;
                mainImg.style.opacity = '1';
            }, 200);

            document.querySelectorAll('.flex-shrink-0 img').forEach(img => {
                img.classList.remove('thumbnail-active');
            });
            element.classList.add('thumbnail-active');
        }
    </script>
</body>
</html>