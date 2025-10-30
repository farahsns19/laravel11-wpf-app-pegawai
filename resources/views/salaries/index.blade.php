@extends('layouts.app')

@section('title', 'Daftar Gaji Pegawai')
@section('page-title', 'Manajemen Penggajian')
@section('page-subtitle', 'Rekap data gaji dan pengupahan pegawai')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Daftar Gaji Pegawai</h4>
        <p class="text-muted mb-0">Total <span class="fw-semibold">{{ $salaries->count() }}</span> data penggajian</p>
    </div>
    <a href="{{ route('salaries.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Tambah Gaji
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-professional alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($salaries->isNotEmpty())
<div class="table-responsive">
    <table class="table table-professional table-hover">
        <thead>
            <tr>
                <th width="60">No</th>
                <th>Pegawai</th>
                <th width="120">Periode</th>
                <th width="140" class="text-end">Gaji Pokok</th>
                <th width="140" class="text-end">Tunjangan</th>
                <th width="140" class="text-end">Potongan</th>
                <th width="160" class="text-end">Total Gaji</th>
                <th width="120" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $index => $salary)
            <tr>
                <td class="text-center">
                    <span class="fw-bold text-primary">{{ $index + 1 }}</span>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="employee-avatar-sm me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $salary->employee->nama_lengkap }}</h6>
                            <small class="text-muted">{{ $salary->employee->position->nama_jabatan ?? '-' }}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <strong>{{ $salary->bulan }}/{{ $salary->tahun }}</strong>
                </td>
                <td class="text-end">
                    <span class="salary-amount">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</span>
                </td>
                <td class="text-end">
                    <span class="allowance-amount">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</span>
                </td>
                <td class="text-end">
                    <span class="deduction-amount">Rp {{ number_format($salary->potongan, 0, ',', '.') }}</span>
                </td>
                <td class="text-end">
                    <span class="total-salary-amount">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</span>
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('salaries.edit', $salary->id) }}"
                            class="btn btn-action btn-edit"
                            title="Edit Gaji"
                            data-bs-toggle="tooltip">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('salaries.destroy', $salary->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-action btn-delete"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data gaji ini?')"
                                title="Hapus Gaji"
                                data-bs-toggle="tooltip">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($salaries->hasPages())
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="text-muted">
        Menampilkan <strong>{{ $salaries->firstItem() }}</strong> - <strong>{{ $salaries->lastItem() }}</strong>
        dari <strong>{{ $salaries->total() }}</strong> data
    </div>
    <nav>
        <ul class="pagination pagination-professional">
            {{ $salaries->links() }}
        </ul>
    </nav>
</div>
@endif

@else
<div class="empty-state">
    <div class="empty-icon">
        <i class="fas fa-money-bill-wave fa-4x"></i>
    </div>
    <h4 class="mt-3">Belum Ada Data Gaji</h4>
    <p class="text-muted mb-4">Mulai dengan menambahkan data gaji pertama</p>
    <a href="{{ route('salaries.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Tambah Gaji Pertama
    </a>
</div>
@endif

<style>
    .employee-avatar-sm {
        width: 40px;
        height: 40px;
        background: rgba(44, 85, 48, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
    }

    .salary-amount,
    .allowance-amount,
    .deduction-amount,
    .total-salary-amount {
        font-weight: 600;
        font-size: 0.9rem;
    }

    .salary-amount {
        color: var(--dark-color);
    }

    .allowance-amount {
        color: var(--success-color);
    }

    .deduction-amount {
        color: var(--danger-color);
    }

    .total-salary-amount {
        color: var(--primary-color);
        font-size: 1rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: 1px solid var(--neutral-light);
        background: white;
        color: var(--gray-color);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-edit:hover {
        background: var(--warning-color);
        color: white;
        border-color: var(--warning-color);
    }

    .btn-delete:hover {
        background: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }

    .empty-icon {
        color: var(--gray-color);
        opacity: 0.6;
        margin-bottom: 1.5rem;
    }

    /* Hover effect untuk table row */
    .table-professional tbody tr {
        transition: all 0.2s ease;
    }

    .table-professional tbody tr:hover {
        background: rgba(44, 85, 48, 0.04) !important;
    }

    /* Pagination styling */
    .pagination-professional .page-link {
        border: 1px solid var(--neutral-light);
        color: var(--dark-color);
        padding: 0.5rem 1rem;
    }

    .pagination-professional .page-item.active .page-link {
        background: var(--primary-color);
        border-color: var(--primary-color);
    }

    .pagination-professional .page-link:hover {
        background: rgba(44, 85, 48, 0.1);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection