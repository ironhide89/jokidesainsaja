@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-white">Dashboard Overview</h1>
        <span class="text-muted small">{{ date('l, d F Y') }}</span>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card h-100 border-0 shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1">Total User</p>
                            <h2 class="fw-bold mb-0 text-warning">124</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                            <i class="bi bi-people-fill text-warning fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <i class="bi bi-arrow-up text-success me-1"></i> 12% dari bulan lalu
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card h-100 border-0 shadow-sm border-start border-info border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1">Total Portofolio</p>
                            <h2 class="fw-bold mb-0 text-info">382</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-3">
                            <i class="bi bi-images text-info fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <i class="bi bi-arrow-up text-success me-1"></i> 5% dari minggu lalu
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header d-flex justify-content-between align-items-center py-3">
                    <h6 class="mb-0 fw-bold">Tren Pertumbuhan (Dummy)</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Tahun Ini
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="trendChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold">Distribusi Kategori</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Line Chart untuk Tren (User vs Portofolio)
        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'User Baru',
                    data: [10, 25, 45, 30, 60, 85],
                    borderColor: '#facc15',
                    backgroundColor: 'rgba(250, 204, 21, 0.1)',
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Portofolio Baru',
                    data: [40, 65, 55, 90, 120, 150],
                    borderColor: '#0dcaf0',
                    backgroundColor: 'rgba(13, 202, 240, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { color: '#94a3b8' } }
                },
                scales: {
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                }
            }
        });

        // 2. Pie Chart untuk Kategori
        const ctxCat = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCat, {
            type: 'doughnut',
            data: {
                labels: ['Programmer', 'Desain', 'Penulisan'],
                datasets: [{
                    data: [45, 35, 20],
                    backgroundColor: ['#facc15', '#0dcaf0', '#6366f1'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom', labels: { color: '#94a3b8', padding: 20 } }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endpush