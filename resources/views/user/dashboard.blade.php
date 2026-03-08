@extends('user.layouts.user')

@section('title', 'Profil & CV Saya')

@section('content')
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        {{-- Sisi Kiri: Foto & Skill --}}
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body text-center">
                    @if($user->profile && $user->profile->photo)
                        <img src="{{ asset('storage/' . $user->profile->photo) }}" class="rounded-circle img-fluid mb-3 shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=facc15&color=0f172a&size=150&bold=true" class="rounded-circle img-fluid mb-3 shadow-sm">
                    @endif
                    
                    <h5 class="my-2 fw-bold text-white">{{ $user->name }}</h5>
                    <p class="text-warning mb-1 small fw-semibold">{{ $user->profile->job_title ?? 'Jabatan Belum Diatur' }}</p>
                    <p class="text-muted small"><i class="bi bi-geo-alt me-1"></i> {{ $user->profile->location ?? 'Lokasi Belum Diatur' }}</p>
                    
                    <button class="btn btn-warning btn-sm mt-2 w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#editPhotoModal">
                        <i class="bi bi-camera me-1"></i> Ganti Foto
                    </button>
                </div>
            </div>

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body text-white">
                    <h6 class="fw-bold mb-3 text-warning"><i class="bi bi-gear-fill me-2"></i> Keahlian</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @if($user->profile && $user->profile->skills)
                            @foreach($user->profile->skills as $skill)
                                <span class="badge bg-secondary opacity-75">{{ $skill }}</span>
                            @endforeach
                        @else
                            <span class="text-muted small italic">Belum ada keahlian ditambahkan.</span>
                        @endif
                    </div>
                    <hr class="opacity-10">
                    <button class="btn btn-outline-warning btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editSkillModal">Edit Keahlian</button>
                </div>
            </div>
        </div>

        {{-- Sisi Kanan: Detail Bio, Pengalaman, & Switch --}}
        <div class="col-lg-8">
            {{-- Section: Tentang Saya --}}
            <div class="card shadow-sm mb-4 text-white border-0">
                <div class="card-header bg-transparent border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center py-3">
                    <h6 class="mb-0 fw-bold text-warning">Tentang Saya</h6>
                    <button class="btn btn-sm btn-link text-warning p-0" data-bs-toggle="modal" data-bs-target="#editAboutModal">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </button>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-0">
                        {{ $user->profile->about ?? 'Ceritakan sedikit tentang diri Anda di sini...' }}
                    </p>
                </div>
            </div>

            {{-- Section: Pengalaman --}}
            <div class="card shadow-sm mb-4 text-white border-0">
                <div class="card-header bg-transparent border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center py-3">
                    <h6 class="mb-0 fw-bold text-warning">Pengalaman & Pendidikan</h6>
                    <button class="btn btn-sm btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#addExpModal">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush bg-transparent">
                        @if($user->profile && $user->profile->experience)
                            @foreach($user->profile->experience as $index => $exp)
                            <li class="list-group-item bg-transparent text-white d-flex justify-content-between align-items-start px-0 border-bottom border-secondary border-opacity-10 mb-2 pb-3">
                                <div class="me-auto">
                                    <div class="fw-bold text-white">{{ $exp['pos'] }}</div>
                                    <small class="text-muted d-block mt-1">{{ $exp['place'] }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-dark border border-secondary text-muted rounded-pill mb-2 d-block small">{{ $exp['year'] }}</span>
                                    {{-- Tombol Hapus Pemicu Modal --}}
                                    <button type="button" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" 
                                            data-bs-toggle="modal" data-bs-target="#deleteExpModal" data-index="{{ $index }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </li>
                            @endforeach
                        @else
                            <li class="list-group-item bg-transparent text-muted px-0 border-0 italic small text-center py-4">Belum ada riwayat pengalaman.</li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Switch: Publish Status --}}
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="alert alert-info border-0 shadow-sm d-flex justify-content-between align-items-center bg-opacity-10 mb-0" style="background-color: rgba(13, 202, 240, 0.05);">
                    <div>
                        <h6 class="alert-heading fw-bold mb-1 text-info">Tampilkan di Landing Page?</h6>
                        <p class="mb-0 small text-muted">Aktifkan agar profil Anda dapat dilihat oleh publik.</p>
                    </div>
                    <div class="form-check form-switch fs-4">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" 
                               onchange="this.form.submit()" {{ ($user->profile->is_published ?? true) ? 'checked' : '' }}>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: EDIT ABOUT & UTAMA --}}
    <div class="modal fade" id="editAboutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Edit Profil Dasar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-white-50">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Jabatan / Tagline</label>
                            <input type="text" name="job_title" class="form-control bg-dark border-secondary border-opacity-25 text-white" value="{{ $user->profile->job_title ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Lokasi</label>
                            <input type="text" name="location" class="form-control bg-dark border-secondary border-opacity-25 text-white" value="{{ $user->profile->location ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Telepon</label>
                            <input type="text" name="phone" class="form-control bg-dark border-secondary border-opacity-25 text-white" value="{{ $user->profile->phone ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Tentang Saya</label>
                            <textarea name="about" class="form-control bg-dark border-secondary border-opacity-25 text-white" rows="5">{{ $user->profile->about ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-warning px-4 fw-bold text-dark">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL: EDIT SKILLS --}}
    <div class="modal fade" id="editSkillModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Update Keahlian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.profile.skills') }}" method="POST">
                    @csrf
                    <div class="modal-body text-white-50">
                        <textarea name="skills" class="form-control bg-dark border-secondary border-opacity-25 text-white" rows="4" placeholder="Contoh: Laravel, AutoCAD, PHP">{{ $user->profile && $user->profile->skills ? implode(', ', $user->profile->skills) : '' }}</textarea>
                        <small class="text-muted mt-2 d-block small italic">Gunakan tanda koma ( , ) untuk memisahkan keahlian.</small>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-warning px-4 fw-bold text-dark">Update Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL: ADD EXPERIENCE --}}
    <div class="modal fade" id="addExpModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Tambah Pengalaman</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.profile.experience') }}" method="POST">
                    @csrf
                    <div class="modal-body text-white-50">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Tahun</label>
                            <input type="text" name="year" class="form-control bg-dark border-secondary border-opacity-25 text-white" placeholder="2021 - 2025" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Posisi / Jabatan</label>
                            <input type="text" name="pos" class="form-control bg-dark border-secondary border-opacity-25 text-white" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Tempat / Instansi</label>
                            <input type="text" name="place" class="form-control bg-dark border-secondary border-opacity-25 text-white" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning px-4 fw-bold text-dark text-uppercase">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL: DELETE EXPERIENCE --}}
    <div class="modal fade" id="deleteExpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-body text-center p-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-3 d-block"></i>
                    <h5 class="text-white fw-bold">Hapus Data?</h5>
                    <p class="text-muted small">Data ini akan dihapus permanen dari sistem.</p>
                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <button type="button" class="btn btn-sm btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        <form id="deleteExpForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-4 rounded-pill">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL: EDIT PHOTO --}}
    <div class="modal fade" id="editPhotoModal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Ganti Foto Profil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.profile.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-center">
                        <div class="mb-3">
                            <label class="form-label small text-muted d-block mb-3">Pilih foto format JPG, PNG, atau WebP (Maks. 2MB)</label>
                            <input type="file" name="photo" class="form-control bg-dark border-secondary border-opacity-25 text-white" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="button" class="btn btn-sm btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-warning px-3 fw-bold">Upload Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteExpModal = document.getElementById('deleteExpModal');
        if (deleteExpModal) {
            deleteExpModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const index = button.getAttribute('data-index');
                const form = deleteExpModal.querySelector('#deleteExpForm');
                // Sesuaikan base URL dengan prefix dashboard kamu
                form.action = `/user/profile/experience/${index}`;
            });
        }
    });
</script>
@endpush