<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV {{ $user->name }} - JokiDesainSaja</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        .glass-card { 
            background: rgba(17, 24, 39, 0.5); 
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.05); 
        }
    </style>
</head>
<body class="antialiased text-gray-200">
    
    @include('partials.header')

    <main class="max-w-7xl mx-auto px-6 pt-40 pb-20">
        
        {{-- SECTION 1: HEADER CV --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start mb-20">
            {{-- Foto Profil --}}
            <div class="flex justify-center lg:justify-start scroll-animate">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-yellow-400 rounded-full blur opacity-20 transition duration-500"></div>
                    @if($user->profile && $user->profile->photo)
                        <img src="{{ asset('storage/' . $user->profile->photo) }}" class="relative w-64 h-64 rounded-full object-cover border-4 border-black shadow-2xl">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=facc15&color=0f172a&size=250&bold=true" class="relative w-64 h-64 rounded-full border-4 border-black shadow-2xl">
                    @endif
                </div>
            </div>

            {{-- Nama & Bio Singkat --}}
            <div class="lg:col-span-2 space-y-6 scroll-animate delay-1">
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold text-white tracking-tighter">{{ $user->name }}</h1>
                    <p class="text-xl text-yellow-400 font-medium mt-2">{{ $user->profile->job_title ?? 'Professional Talent' }}</p>
                </div>

                <div class="flex flex-wrap gap-4 text-sm">
                    <div class="flex items-center gap-2 text-gray-400 bg-white/5 px-4 py-2 rounded-full border border-white/5">
                        <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $user->profile->location ?? 'Indonesia' }}
                    </div>
                    <div class="flex items-center gap-2 text-gray-400 bg-white/5 px-4 py-2 rounded-full border border-white/5">
                        <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7.5V5z"></path></svg>
                        {{ $user->profile->phone ?? 'Private' }}
                    </div>
                </div>

                <p class="text-gray-400 leading-relaxed text-lg italic">
                    "{{ $user->profile->about ?? 'Belum ada deskripsi profil.' }}"
                </p>

                <div class="pt-4">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->profile->phone ?? '') }}" 
                       class="inline-block bg-yellow-400 text-black font-extrabold px-10 py-4 rounded-2xl hover:bg-yellow-500 transition-all shadow-xl shadow-yellow-400/20 uppercase tracking-tighter">
                        Hubungi Sekarang
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            {{-- KOLOM KIRI: SKILLS & INFO --}}
            <div class="space-y-8 scroll-animate">
                <div class="glass-card p-8 rounded-[2.5rem]">
                    <h3 class="text-yellow-400 font-bold uppercase tracking-widest text-xs mb-6">Keahlian Teknis</h3>
                    <div class="flex flex-wrap gap-2">
                        @if($user->profile && $user->profile->skills)
                            @foreach($user->profile->skills as $skill)
                                <span class="bg-white/5 border border-white/10 text-gray-300 px-4 py-2 rounded-xl text-sm">{{ $skill }}</span>
                            @endforeach
                        @else
                            <p class="text-gray-600 italic text-sm">Belum ada skill yang ditambahkan.</p>
                        @endif
                    </div>
                </div>

                <div class="glass-card p-8 rounded-[2.5rem]">
                    <h3 class="text-yellow-400 font-bold uppercase tracking-widest text-xs mb-6">Statistik Joki</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Proyek Selesai</span>
                            <span class="text-white font-bold">{{ $user->portfolios?->count() ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Kepuasan</span>
                            <span class="text-white font-bold">100%</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: PENGALAMAN & PORTOFOLIO --}}
            <div class="lg:col-span-2 space-y-12 scroll-animate delay-1">
                
                {{-- Riwayat Pengalaman --}}
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                        <span class="w-8 h-8 bg-yellow-400 text-black rounded-lg flex items-center justify-center text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.827a2 2 0 00-2.788 0L2 8.225V18a2 2 0 002 2h3a2 2 0 002-2v-5a1 1 0 011-1h2a1 1 0 011 1v5a2 2 0 002 2h3a2 2 0 002-2V8.225l-5.606-5.398z"></path></svg>
                        </span>
                        Pengalaman & Pendidikan
                    </h2>
                    
                    <div class="space-y-4">
                        @if($user->profile && $user->profile->experience)
                            @foreach($user->profile->experience as $exp)
                                <div class="glass-card p-6 rounded-3xl border-l-4 border-l-yellow-400">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-white font-bold text-lg">{{ $exp['pos'] }}</h4>
                                        <span class="text-[10px] bg-yellow-400/10 text-yellow-400 px-3 py-1 rounded-full font-bold">{{ $exp['year'] }}</span>
                                    </div>
                                    <p class="text-gray-400 text-sm">{{ $exp['place'] }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 italic">Riwayat belum tersedia.</p>
                        @endif
                    </div>
                </div>

                {{-- Portofolio --}}
                <div class="space-y-6" id="projects">
                    <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                        <span class="w-8 h-8 bg-yellow-400 text-black rounded-lg flex items-center justify-center text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                        </span>
                        Portofolio Pilihan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse ($user->portfolios ?? [] as $item)
                            <a href="{{ route('portofolio.detail', $item->slug) }}" class="group glass-card p-4 rounded-[2rem] block">
                                <div class="aspect-video overflow-hidden rounded-2xl mb-4 bg-gray-900">
                                    @if($item->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @endif
                                </div>
                                <h3 class="font-bold text-white group-hover:text-yellow-400 transition-colors px-2">{{ $item->title }}</h3>
                                <p class="text-xs text-gray-500 px-2 mt-1 uppercase tracking-widest">{{ $item->category }}</p>
                            </a>
                        @empty
                            <p class="text-gray-600 italic col-span-full">Belum ada karya yang dipublish.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="border-t border-white/5 mt-20 py-10 text-center text-gray-600 text-sm">
        <p>&copy; {{ date('Y') }} JokiDesainSaja &bull; Professional Talent CV</p>
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
            document.querySelectorAll('.scroll-animate').forEach(t => observer.observe(t));

            // Mobile Menu Logic
            const menuBtn = document.getElementById('menu-btn');
            const closeBtn = document.getElementById('close-btn'); 
            const mobileMenu = document.getElementById('mobile-menu');
            if(menuBtn) menuBtn.addEventListener('click', () => mobileMenu.classList.add('is-open'));
            if(closeBtn) closeBtn.addEventListener('click', () => mobileMenu.classList.remove('is-open'));
        });
    </script>
</body>
</html>