@extends('user.layouts.user')

@section('title', 'Kelola Portofolio')

@section('content')
    @php
        // Data Dummy dengan Kategori Tambahan
        $portfolios = collect([
            (object) [
                'id' => 1,
                'title' => 'Sistem Inventaris Gudang',
                'category' => 'Programmer',
                'subcategory' => 'Aplikasi',
                'description' => 'Aplikasi web base untuk manajemen stok barang.',
                'image' => null,
                'link' => '#',
                'created_at' => now()->subDays(1)
            ],
            (object) [
                'id' => 2,
                'title' => 'Desain Rumah Tipe 45',
                'category' => 'Desain',
                'subcategory' => 'AutoCAD',
                'description' => 'Rancangan denah dan tampak depan menggunakan AutoCAD.',
                'image' => null,
                'link' => '#',
                'created_at' => now()->subDays(3)
            ],
            (object) [
                'id' => 3,
                'title' => 'Analisis Algoritma Sorting',
                'category' => 'Penulisan',
                'subcategory' => 'Jurnal Ilmiah',
                'description' => 'Penulisan jurnal mengenai efisiensi waktu algoritma.',
                'image' => null,
                'link' => '#',
                'created_at' => now()->subDays(7)
            ]
        ]);
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Pengelola Portofolio</h1>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Karya Baru
        </button>
    </div>

    <div class="row">
        @forelse ($portfolios as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-dark text-white">
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-warning text-dark">{{ $item->category }}</span>
                    </div>
                    
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="Preview">
                    @else
                        <img src="https://via.placeholder.com/400x250/333/facc15?text={{ $item->subcategory }}" class="card-img-top" alt="Placeholder">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-warning mb-1">{{ $item->title }}</h5>
                        <p class="text-info small mb-2">{{ $item->subcategory }}</p>
                        <p class="card-text text-muted small">{{ Str::limit($item->description, 80) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top border-secondary d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                        <a href="{{ $item->link }}" target="_blank" class="btn btn-sm btn-outline-info">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada portofolio yang diupload.</p>
            </div>
        @endforelse
    </div>

    {{-- Modal Tambah Portofolio --}}
    <div class="modal fade" id="addPortfolioModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Form Upload Portofolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-dark">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Karya</label>
                        <input type="text" class="form-control" placeholder="Contoh: Web Design E-Commerce">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kategori Utama</label>
                            <select class="form-select" id="mainCategory">
                                <option value="">Pilih Kategori</option>
                                <option value="programmer">Programmer</option>
                                <option value="desain">Desain</option>
                                <option value="penulisan">Penulisan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Layanan</label>
                            <select class="form-select" id="subCategory">
                                <option value="">Pilih Jenis</option>
                                {{-- Akan diisi lewat JavaScript sesuai kategori utama --}}
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Singkat</label>
                        <textarea class="form-control" rows="3" placeholder="Ceritakan sedikit tentang proyek ini..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Demo/Hasil (URL)</label>
                        <input type="url" class="form-control" placeholder="https://github.com/..." >
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar Preview (Upload Foto)</label>
                        <input type="file" class="form-control">
                        <div class="form-text">Foto ini akan tampil di halaman depan website.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning px-4">Publish Karya</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Logika dinamis untuk pilihan sub-kategori
    const subCategories = {
        programmer: ['Web Design', 'Kartu Undangan Digital', 'Aplikasi', 'Robotik'],
        desain: ['AutoCAD', 'Photoshop', 'Poster'],
        penulisan: ['Skripsi', 'Jurnal Ilmiah']
    };

    document.getElementById('mainCategory').addEventListener('change', function() {
        const selected = this.value;
        const subSelect = document.getElementById('subCategory');
        
        // Kosongkan pilihan lama
        subSelect.innerHTML = '<option value="">Pilih Jenis</option>';

        if (selected && subCategories[selected]) {
            subCategories[selected].forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.toLowerCase().replace(/\s+/g, '-');
                opt.innerHTML = item;
                subSelect.appendChild(opt);
            });
        }
    });
</script>
@endpush