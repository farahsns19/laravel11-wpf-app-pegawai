@extends('layouts.app')

@section('title', 'Daftar Pegawai')
@section('page-title', 'Manajemen Pegawai')
@section('page-subtitle', 'Data seluruh karyawan perusahaan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Daftar Pegawai</h4>
        <p class="text-muted mb-0">Total <span class="fw-semibold">{{ $employees->total() }}</span> pegawai terdaftar</p>
    </div>
    <a href="{{ route('employees.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-user-plus me-2"></i>Tambah Pegawai Baru
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-professional alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($employees->isNotEmpty())
<div class="table-responsive">
    <table class="table table-professional table-hover">
        <thead>
            <tr>
                <th width="60" class="text-center">#</th>
                <th>Informasi Pegawai</th>
                <th>Kontak</th>
                <th>Tanggal Penting</th>
                <th>Status</th>
                <th>Departemen & Jabatan</th>
                <th width="140" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $employee)
            <tr>
                <td class="text-center">
                    <div class="employee-number">
                        <span class="fw-bold text-primary">{{ $index + 1 }}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="employee-avatar me-3">
                            <div class="avatar-circle">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-semibold">{{ $employee->nama_lengkap }}</h6>
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ Str::limit($employee->alamat, 25) }}
                            </small>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="contact-info">
                        <div class="mb-1">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <small>{{ Str::limit($employee->email, 20) }}</small>
                        </div>
                        <div>
                            <i class="fas fa-phone me-2 text-success"></i>
                            <small>{{ $employee->nomor_telepon ?? '-' }}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="date-info">
                        <div class="mb-1">
                            <small class="text-muted">Lahir:</small>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d/m/Y') }}</div>
                        </div>
                        <div>
                            <small class="text-muted">Masuk:</small>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if($employee->status == 'active')
                    <span class="status-badge status-active">
                        <i class="fas fa-circle me-1"></i>Aktif
                    </span>
                    @elseif($employee->status == 'inactive')
                    <span class="status-badge status-inactive">
                        <i class="fas fa-circle me-1"></i>Non-Aktif
                    </span>
                    @else
                    <span class="status-badge status-pending">
                        <i class="fas fa-circle me-1"></i>{{ ucfirst($employee->status) }}
                    </span>
                    @endif
                </td>
                <td>
                    <div class="department-info">
                        <div class="mb-1">
                            <span class="department-badge">
                                <i class="fas fa-building me-1"></i>
                                {{ $employee->department->nama_departemen ?? '-' }}
                            </span>
                        </div>
                        <div>
                            <span class="position-badge">
                                <i class="fas fa-briefcase me-1"></i>
                                {{ $employee->position->nama_jabatan ?? '-' }}
                            </span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('employees.show', $employee->id) }}"
                            class="btn btn-action btn-view"
                            title="Detail Pegawai"
                            data-bs-toggle="tooltip">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('employees.edit', $employee->id) }}"
                            class="btn btn-action btn-edit"
                            title="Edit Data"
                            data-bs-toggle="tooltip">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-action btn-delete"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')"
                                title="Hapus Data"
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

<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="text-muted">
        Menampilkan <strong>{{ $employees->firstItem() }}</strong> - <strong>{{ $employees->lastItem() }}</strong>
        dari <strong>{{ $employees->total() }}</strong> data pegawai
    </div>
    <nav>
        <ul class="pagination pagination-professional">
            {{ $employees->links() }}
        </ul>
    </nav>
</div>
@else
<div class="empty-state">
    <div class="empty-icon">
        <i class="fas fa-users fa-4x"></i>
    </div>
    <h4 class="mt-3">Belum Ada Data Pegawai</h4>
    <p class="text-muted mb-4">Mulai dengan menambahkan data pegawai pertama ke dalam sistem</p>
    <a href="{{ route('employees.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-user-plus me-2"></i>Tambah Pegawai Pertama
    </a>
</div>
@endif

<style>
    .employee-avatar .avatar-circle {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        box-shadow: 0 4px 8px rgba(44, 85, 48, 0.2);
    }

    .employee-number {
        background: rgba(44, 85, 48, 0.1);
        border-radius: 8px;
        padding: 8px;
        text-align: center;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .status-active {
        background: rgba(56, 161, 105, 0.15);
        color: #22543d;
        border: 1px solid rgba(56, 161, 105, 0.3);
    }

    .status-inactive {
        background: rgba(107, 114, 128, 0.15);
        color: #374151;
        border: 1px solid rgba(107, 114, 128, 0.3);
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #744210;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .department-badge,
    .position-badge {
        padding: 4px 8px;
        background: rgba(44, 85, 48, 0.08);
        border-radius: 6px;
        font-size: 0.75rem;
        color: var(--dark-color);
        display: inline-flex;
        align-items: center;
    }

    .department-badge i,
    .position-badge i {
        font-size: 0.7rem;
    }

    .contact-info,
    .date-info,
    .department-info {
        font-size: 0.85rem;
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
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-view:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
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

    .table> :not(caption)>*>* {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    /* Hover effect untuk table row */
    .table-professional tbody tr {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .table-professional tbody tr:hover {
        background: rgba(44, 85, 48, 0.04) !important;
        transform: translateX(4px);
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