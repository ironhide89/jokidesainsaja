{{-- Logo Ikon Saja (Teks Rocker Dihapus agar Simple) --}}
<div class="d-none d-lg-block mb-4 px-3 pt-2">
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
      
    </a>
</div>

<ul class="nav nav-pills flex-column flex-grow-1 mb-auto">
    {{-- Section Core --}}
    <li class="sidebar-heading text-muted small fw-bold mb-2 ps-3">CORE</li>
    <li class="nav-item mb-1">
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i> Dashboard
        </a>
    </li>

    {{-- Section Management --}}
    <li class="sidebar-heading text-muted small fw-bold mt-3 mb-2 ps-3">MANAGEMENT</li>
    
    <li class="nav-item mb-1">
        <a href="{{ route('admin.user_admin') }}" 
           class="nav-link {{ Route::is('admin.user_admin') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Kelola User
        </a>
    </li>

    <li class="nav-item mb-1">
        {{-- Route portofolio admin sementara dikosongkan sesuai kodemu --}}
        <a href="#" 
           class="nav-link {{ Route::is('admin.portfolios.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Kelola Portofolio
        </a>
    </li>
</ul>

{{-- Bagian Bawah (Logout) --}}
<div class="mt-auto pt-4 border-top border-secondary opacity-50 px-3 pb-4">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link text-decoration-none text-muted p-0 small w-100 text-start">
            <i class="bi bi-box-arrow-right me-1"></i> Logout Akun
        </button>
    </form>
</div>