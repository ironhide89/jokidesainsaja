@extends('user.layouts.user')

@section('title', 'Profil & CV Saya')

@section('content')
    @php
        // Data Dummy Profil (Akan digantikan data dari database nanti)
        $user = (object) [
            'name' => 'Rakha Racahyo',
            'job_title' => 'Fullstack Developer & Airport Technical Specialist',
            'email' => 'anas@example.com',
            'phone' => '+62 812-xxxx-xxxx',
            'about' => 'Lulusan D4 Teknologi Rekayasa Bandar Udara yang memiliki minat tinggi di bidang coding dan manajemen infrastruktur. Berpengalaman dalam menangani aspek kelistrikan dan mekanikal bandara.',
            'skills' => ['Laravel', 'Tailwind CSS', 'AutoCAD', 'Electrical Engineering', 'Mechanical Maintenance'],
            'experience' => [
                ['year' => '2025 - Sekarang', 'pos' => 'CPNS Pengevaluasi Penerbangan', 'place' => 'UPBU Wamena'],
                ['year' => '2021 - 2025', 'pos' => 'Mahasiswa Teknologi Rekayasa', 'place' => 'Poltekbang Palembang']
            ]
        ];
    @endphp

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/150" class="rounded-circle img-fluid mb-3" style="width: 150px;">
                    <h5 class="my-2">{{ $user->name }}</h5>
                    <p class="text-muted mb-1">{{ $user->job_title }}</p>
                    <p class="text-muted font-size-sm">Bandar Lampung / Wamena</p>
                    <button class="btn btn-warning btn-sm mt-2">Ganti Foto</button>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3"><i class="bi bi-gear-fill me-2"></i> Keahlian</h6>
                    @foreach($user->skills as $skill)
                        <span class="badge bg-secondary mb-2">{{ $skill }}</span>
                    @endforeach
                    <hr>
                    <button class="btn btn-outline-warning btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editSkillModal">Edit Keahlian</button>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Tentang Saya</h6>
                    <button class="btn btn-sm btn-link text-warning" data-bs-toggle="modal" data-bs-target="#editAboutModal"><i class="bi bi-pencil-square"></i></button>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ $user->about }}</p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Pengalaman Kerja & Pendidikan</h6>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#addExpModal"><i class="bi bi-plus"></i> Tambah</button>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($user->experience as $exp)
                        <li class="list-group-item d-flex justify-content-between align-items-start px-0 border-0 mb-3">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ $exp['pos'] }}</div>
                                <small class="text-muted">{{ $exp['place'] }}</small>
                            </div>
                            <span class="badge bg-light text-dark rounded-pill">{{ $exp['year'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="alert alert-info border-0 shadow-sm d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="alert-heading fw-bold mb-1">Tampilkan di Landing Page?</h6>
                    <p class="mb-0 small">Aktifkan agar portofolio dan profil Anda muncul secara publik.</p>
                </div>
                <div class="form-check form-switch fs-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="publishSwitch" checked>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAboutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Edit Deskripsi Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-dark">
                    <textarea class="form-control" rows="5">{{ $user->about }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
@endsection