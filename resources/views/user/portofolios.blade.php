@extends('user.layouts.user')

@section('title', 'Kelola Portofolio')

@section('content')
    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-white fw-bold">Pengelola Portofolio</h1>
        <button type="button" class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Karya Baru
        </button>
    </div>

    <div class="row">
        @forelse ($portfolios as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-dark text-white overflow-hidden">
                    <div class="position-absolute top-0 end-0 m-2 z-index-10">
                        <span class="badge bg-warning text-dark shadow-sm">{{ ucfirst($item->category) }}</span>
                    </div>
                    
                    <div class="ratio ratio-16x9">
                        @if($item->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" class="card-img-top object-fit-cover" alt="{{ $item->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x250/1e293b/facc15?text=Tanpa+Gambar" class="card-img-top object-fit-cover">
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="card-title text-warning fw-bold mb-1">{{ $item->title }}</h5>
                        <p class="text-info small mb-2 opacity-75">{{ str_replace('-', ' ', ucfirst($item->subcategory)) }}</p>
                        <p class="card-text text-muted small">{{ Str::limit($item->description, 100) }}</p>
                        @if($item->project_url)
                            <span class="badge bg-success-subtle text-success border border-success-subtle small">Live Preview Available</span>
                        @endif
                    </div>

                    <div class="card-footer bg-transparent border-top border-secondary d-flex justify-content-between align-items-center py-3">
                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editPortfolioModal"
                                data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-category="{{ $item->category }}"
                                data-subcategory="{{ $item->subcategory }}"
                                data-description="{{ $item->description }}"
                                data-url="{{ $item->project_url }}"
                                data-images="{{ $item->images->toJson() }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deletePortfolioModal" 
                                data-id="{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="bg-dark p-5 rounded-4 border border-secondary border-opacity-10 shadow-sm">
                    <i class="bi bi-folder2-open display-1 text-muted opacity-25"></i>
                    <p class="text-muted mt-3 italic">Belum ada portofolio yang diupload.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- MODAL: TAMBAH --}}
    <div class="modal fade" id="addPortfolioModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Publish Karya Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.portofolio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-white-50">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Judul Karya</label>
                            <input type="text" name="title" class="form-control bg-dark border-secondary text-white shadow-none" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-warning">Kategori Utama</label>
                                <select name="category" class="form-select bg-dark border-secondary text-white mainCategorySelector shadow-none" required>
                                    <option value="">Pilih</option>
                                    <option value="programmer">Programmer</option>
                                    <option value="desain">Desain</option>
                                    <option value="penulisan">Penulisan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-warning">Jenis Layanan</label>
                                <select name="subcategory" class="form-select bg-dark border-secondary text-white subCategorySelector shadow-none" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Deskripsi</label>
                            <textarea name="description" class="form-control bg-dark border-secondary text-white shadow-none" rows="3" required></textarea>
                        </div>

                        {{-- URL LOGIC --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning d-block">Ada Link Preview?</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input urlToggle" type="radio" name="has_url" value="yes" id="urlYesAdd">
                                <label class="form-check-label text-white small" for="urlYesAdd">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input urlToggle" type="radio" name="has_url" value="no" id="urlNoAdd" checked>
                                <label class="form-check-label text-white small" for="urlNoAdd">Tidak Ada</label>
                            </div>
                        </div>
                        <div class="mb-3 d-none urlInputContainer">
                            <label class="form-label small fw-bold text-warning">Link URL</label>
                            <input type="url" name="project_url" class="form-control bg-dark border-secondary text-white shadow-none" placeholder="https://example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning">Upload Foto (Bisa pilih banyak)</label>
                            <input type="file" name="images[]" class="form-control bg-dark border-secondary text-white shadow-none" accept="image/*" multiple required>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-warning px-4 fw-bold shadow-sm">Publish Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL: EDIT --}}
    <div class="modal fade" id="editPortfolioModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Edit Karya</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editPortfolioForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-white-50">
                        <div class="mb-3">
                            <label class="small fw-bold text-warning">Judul Karya</label>
                            <input type="text" name="title" id="editTitle" class="form-control bg-dark border-secondary text-white shadow-none" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold text-warning">Kategori Utama</label>
                                <select name="category" id="editCategory" class="form-select bg-dark border-secondary text-white mainCategorySelector shadow-none" required>
                                    <option value="programmer">Programmer</option>
                                    <option value="desain">Desain</option>
                                    <option value="penulisan">Penulisan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold text-warning">Jenis Layanan</label>
                                <select name="subcategory" id="editSubcategory" class="form-select bg-dark border-secondary text-white subCategorySelector shadow-none" required>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-warning">Deskripsi</label>
                            <textarea name="description" id="editDescription" class="form-control bg-dark border-secondary text-white shadow-none" rows="3" required></textarea>
                        </div>

                        {{-- URL LOGIC EDIT --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-warning d-block">Ada Link Preview?</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input urlToggle" type="radio" name="has_url_edit" value="yes" id="urlYesEdit">
                                <label class="form-check-label text-white small" for="urlYesEdit">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input urlToggle" type="radio" name="has_url_edit" value="no" id="urlNoEdit">
                                <label class="form-check-label text-white small" for="urlNoEdit">Tidak Ada</label>
                            </div>
                        </div>
                        <div class="mb-3 d-none urlInputContainer">
                            <label class="small fw-bold text-warning">Link URL</label>
                            <input type="url" name="project_url" id="editUrl" class="form-control bg-dark border-secondary text-white shadow-none">
                        </div>
                        
                        <div class="mb-3">
                            <label class="small fw-bold text-warning mb-2 d-block">Foto Saat Ini</label>
                            <div id="editImagesPreview" class="d-flex flex-wrap gap-2 p-2 bg-black bg-opacity-25 rounded border border-secondary border-opacity-10 min-vh-10">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small fw-bold text-warning">Upload Foto Baru (Opsional)</label>
                            <input type="file" name="images[]" class="form-control bg-dark border-secondary text-white shadow-none" accept="image/*" multiple>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-warning px-4 fw-bold shadow-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL: KONFIRMASI HAPUS --}}
    <div class="modal fade" id="deletePortfolioModal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-body text-center p-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-3 d-block"></i>
                    <h5 class="text-white fw-bold">Hapus Karya?</h5>
                    <p class="text-muted small">Data ini akan dihapus permanen dari sistem.</p>
                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <button type="button" class="btn btn-sm btn-link text-muted text-decoration-none shadow-none" data-bs-dismiss="modal">Batal</button>
                        <form id="deletePortfolioForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-4 rounded-pill shadow-sm">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const subCategories = {
        programmer: ['Web Design', 'Kartu Undangan Digital', 'Aplikasi', 'Robotik'],
        desain: ['AutoCAD', 'Photoshop', 'Poster'],
        penulisan: ['Skripsi', 'Jurnal Ilmiah']
    };

    function populateSub(mainValue, targetElement, selectedSub = '') {
        targetElement.innerHTML = '<option value="">Pilih Jenis</option>';
        if (mainValue && subCategories[mainValue]) {
            subCategories[mainValue].forEach(item => {
                const val = item.toLowerCase().replace(/\s+/g, '-');
                const opt = document.createElement('option');
                opt.value = val;
                opt.innerHTML = item;
                if(val === selectedSub) opt.selected = true;
                targetElement.appendChild(opt);
            });
        }
    }

    // Toggle URL Input
    document.querySelectorAll('.urlToggle').forEach(radio => {
        radio.addEventListener('change', function() {
            const container = this.closest('form').querySelector('.urlInputContainer');
            const input = container.querySelector('input');
            if (this.value === 'yes') {
                container.classList.remove('d-none');
            } else {
                container.classList.add('d-none');
                input.value = ''; // Reset nilai jadi kosong jika memilih "Tidak Ada"
            }
        });
    });

    // Trigger perubahan subkategori
    document.querySelectorAll('.mainCategorySelector').forEach(select => {
        select.addEventListener('change', function() {
            const subSelect = this.closest('form').querySelector('.subCategorySelector');
            populateSub(this.value, subSelect);
        });
    });

    // Handle Logic Modal Edit
    const editModal = document.getElementById('editPortfolioModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        const previewContainer = document.getElementById('editImagesPreview');
        const urlInputContainer = this.querySelector('.urlInputContainer');
        const projectUrl = btn.getAttribute('data-url');
        
        previewContainer.innerHTML = '';
        
        document.getElementById('editPortfolioForm').action = `/user/portofolio/update/${btn.getAttribute('data-id')}`;
        document.getElementById('editTitle').value = btn.getAttribute('data-title');
        document.getElementById('editDescription').value = btn.getAttribute('data-description');
        document.getElementById('editUrl').value = projectUrl;
        
        // Handle URL Radio in Edit
        if (projectUrl && projectUrl !== 'null' && projectUrl !== '') {
            document.getElementById('urlYesEdit').checked = true;
            urlInputContainer.classList.remove('d-none');
        } else {
            document.getElementById('urlNoEdit').checked = true;
            urlInputContainer.classList.add('d-none');
            document.getElementById('editUrl').value = '';
        }

        const cat = btn.getAttribute('data-category');
        const sub = btn.getAttribute('data-subcategory');
        document.getElementById('editCategory').value = cat;
        populateSub(cat, document.getElementById('editSubcategory'), sub);

        const imagesData = btn.getAttribute('data-images');
        if (imagesData) {
            const images = JSON.parse(imagesData);
            if (images.length > 0) {
                images.forEach(img => {
                    previewContainer.innerHTML += `<img src="/storage/${img.image_path}" class="rounded object-fit-cover shadow-sm border border-secondary border-opacity-25" style="width: 70px; height: 70px;">`;
                });
            } else {
                previewContainer.innerHTML = '<small class="text-muted italic p-2">Tidak ada foto.</small>';
            }
        }
    });

    const deleteModal = document.getElementById('deletePortfolioModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        document.getElementById('deletePortfolioForm').action = `/user/portofolio/delete/${btn.getAttribute('data-id')}`;
    });
</script>
@endpush