@extends('admin.layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-white fw-bold">Kelola Pengguna</h1>
            <p class="text-muted small mb-0">Manajemen akun administrator dan pengguna website.</p>
        </div>
        <button type="button" class="btn btn-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah User Baru
        </button>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0"> {{-- P-0 agar tabel menempel ke pinggir card --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="color: #cbd5e1;">
                    <thead style="background-color: rgba(255,255,255,0.02);">
                        <tr>
                            <th scope="col" class="ps-4 py-3 text-uppercase small fw-bold" style="color: var(--accent-color);">No</th>
                            <th scope="col" class="py-3 text-uppercase small fw-bold" style="color: var(--accent-color);">Nama</th>
                            <th scope="col" class="py-3 text-uppercase small fw-bold" style="color: var(--accent-color);">Email</th>
                            <th scope="col" class="py-3 text-uppercase small fw-bold" style="color: var(--accent-color);">Role</th>
                            <th scope="col" class="py-3 text-uppercase small fw-bold" style="color: var(--accent-color);">Bergabung</th>
                            <th scope="col" class="py-3 text-center text-uppercase small fw-bold" style="color: var(--accent-color);">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-bottom border-secondary border-opacity-10">
                                <td class="ps-4">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td class="fw-medium text-white">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 'admin')
                                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3">Admin</span>
                                    @else
                                        <span class="badge rounded-pill bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3">User</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-center pe-4">
                                    <button type="button" class="btn btn-sm btn-outline-info border-0 edit-btn"
                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}" data-role="{{ $user->role }}" title="Edit">
                                        <i class="bi bi-pencil-square fs-6"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-danger border-0 delete-btn"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="{{ $user->id }}" title="Hapus">
                                        <i class="bi bi-trash3 fs-6"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted italic">Tidak ada data user tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-transparent border-top border-secondary border-opacity-10 py-3">
            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Tambah User Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body text-white-50">
                        <div class="mb-3">
                            <label class="form-label small">Nama Lengkap</label>
                            <input type="text" class="form-control bg-dark border-secondary border-opacity-25 text-white" name="name" placeholder="Masukkan nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Alamat Email</label>
                            <input type="email" class="form-control bg-dark border-secondary border-opacity-25 text-white" name="email" placeholder="email@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Password</label>
                            <input type="password" class="form-control bg-dark border-secondary border-opacity-25 text-white" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Peran (Role)</label>
                            <select class="form-select bg-dark border-secondary border-opacity-25 text-white" name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning px-4">Simpan User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-header border-bottom border-secondary border-opacity-10">
                    <h5 class="modal-title text-white fw-bold">Edit Detail User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-white-50">
                        <div class="mb-3">
                            <label class="form-label small">Nama Lengkap</label>
                            <input type="text" class="form-control bg-dark border-secondary border-opacity-25 text-white" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Alamat Email</label>
                            <input type="email" class="form-control bg-dark border-secondary border-opacity-25 text-white" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Ganti Password (Opsional)</label>
                            <input type="password" class="form-control bg-dark border-secondary border-opacity-25 text-white" name="password" placeholder="Kosongkan jika tidak diubah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Peran (Role)</label>
                            <select class="form-select bg-dark border-secondary border-opacity-25 text-white" id="editRole" name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content border-0 shadow-lg" style="background-color: #1e293b;">
                <div class="modal-body text-center p-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-3 d-block"></i>
                    <h5 class="text-white fw-bold">Hapus User?</h5>
                    <p class="text-muted small">Data ini akan dihapus permanen dari sistem.</p>
                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <button type="button" class="btn btn-sm btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        <form id="deleteUserForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Modal Edit logic
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const modalForm = this.querySelector('#editUserForm');
            modalForm.action = `/admin/users/${button.getAttribute('data-id')}`;
            this.querySelector('#editName').value = button.getAttribute('data-name');
            this.querySelector('#editEmail').value = button.getAttribute('data-email');
            this.querySelector('#editRole').value = button.getAttribute('data-role');
        });

        // Modal Delete logic
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            this.querySelector('#deleteUserForm').action = `/admin/users/${button.getAttribute('data-id')}`;
        });
    });
</script>
@endpush