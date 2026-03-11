<header class="fixed top-0 left-0 w-full p-6 z-[100] bg-[#000000] border-b border-white/10 shadow-2xl">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="/" class="text-xl font-bold tracking-wider z-30 text-yellow-400 uppercase">JokiDesainSaja</a> 
        
        <nav class="hidden md:flex items-center gap-8 text-gray-400 font-medium">
            @if(Request::is('/'))
                {{-- Menu khusus Landing Page (Home) --}}
                <a href="#home" class="hover:text-yellow-400 transition-colors">Home</a>
                <a href="#services" class="hover:text-yellow-400 transition-colors">Layanan</a>
                <a href="#portfolio" class="hover:text-yellow-400 transition-colors">Portfolio</a>
                <a href="#contact" class="hover:text-yellow-400 transition-colors">Contact</a>
            @else
                {{-- Menu untuk halaman selain Home --}}
                <a href="/" class="hover:text-yellow-400 transition-colors">Home</a>
                <a href="{{ route('portofolio') }}" class="{{ Request::is('portofolio*') ? 'text-yellow-400 font-bold' : '' }} hover:text-yellow-400 transition-colors">Portfolio</a>
            @endif

            @auth
                <a href="{{ route('dashboard') }}" class="px-5 py-2 border border-yellow-400/50 rounded-full text-yellow-400 hover:bg-yellow-400 hover:text-black transition-all text-sm font-bold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-yellow-400 transition-colors">Login</a>
            @endauth
        </nav>

        {{-- Mobile Button --}}
        <div class="md:hidden z-30">
            <button id="menu-btn" class="text-yellow-400 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</header>

{{-- Mobile Menu --}}
<div id="mobile-menu" class="mobile-menu fixed top-0 right-0 w-full max-w-xs h-full bg-[#000000] z-[110] p-8 shadow-2xl border-l border-white/10">
    <div class="flex justify-between items-center mb-12">
        <span class="text-xl font-black text-yellow-400 tracking-tighter">MENU</span> 
        <button id="close-btn" class="text-gray-400 hover:text-yellow-400 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <nav class="flex flex-col items-start gap-8 text-2xl font-bold">
        <a href="/" class="menu-link hover:text-yellow-400 transition-colors text-white">Home</a>
        <a href="{{ route('portofolio') }}" class="menu-link hover:text-yellow-400 transition-colors text-white">Portfolio</a>
        @guest 
            <a href="{{ route('login') }}" class="menu-link hover:text-yellow-400 transition-colors text-white">Login</a> 
        @else
            <a href="{{ route('dashboard') }}" class="menu-link text-yellow-400">Dashboard</a>
        @endguest
    </nav>
</div>