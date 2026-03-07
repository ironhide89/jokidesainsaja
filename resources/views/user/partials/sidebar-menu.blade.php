{{-- Logo Ikon (Teks Rocker Dihapus) --}}
<div class="d-none d-lg-block mb-4 px-3">
    <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center text-decoration-none">
       
    </a>
</div>

<ul class="nav nav-pills flex-column mb-auto">
    {{-- Menu Utama --}}
    <li class="sidebar-heading text-muted small fw-bold mb-2 ps-3">UTAMA</li>
    <li class="nav-item mb-1">
        <a href="{{ route('user.dashboard') }}" 
           class="nav-link {{ Route::is('user.dashboard') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Dashboard / Profil
        </a>
    </li>

    {{-- Menu Management --}}
    <li class="sidebar-heading text-muted small fw-bold mt-3 mb-2 ps-3">MANAGEMENT</li>
    <li class="nav-item mb-1">
        <a href="{{ route('user.portofolios_user') }}" 
           class="nav-link {{ Route::is('user.portofolios_user') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Kelola Portofolio
        </a>
    </li>
</ul>

{{-- Bagian Bawah --}}
<div class="mt-auto pt-4 border-top border-secondary opacity-50 px-3">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link text-decoration-none text-muted p-0 small">
            <i class="bi bi-box-arrow-right me-1"></i> Logout Akun
        </button>
    </form>
</div>