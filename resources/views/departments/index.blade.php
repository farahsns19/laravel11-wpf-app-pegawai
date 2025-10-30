@extends('layouts.app')

@section('title', 'Daftar Departemen')
@section('page-title', 'Manajemen Departemen')
@section('page-subtitle', 'Struktur organisasi dan divisi perusahaan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Daftar Departemen</h4>
        <p class="text-muted mb-0">Total <span class="fw-semibold">{{ $departments->count() }}</span> departemen terdaftar</p>
    </div>
    <a href="{{ route('departments.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Tambah Departemen
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-professional alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($departments->isNotEmpty())
<div class="row">
    @foreach($departments as $index => $department)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="department-card">
            <div class="department-header">
                <div class="department-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="department-info">
                    <h5 class="department-name">{{ $department->nama_departemen }}</h5>
                    <span class="department-badge">Departemen</span>
                </div>
            </div>

            <div class="department-actions">
                <a href="{{ route('departments.show', $department->id) }}"
                    class="btn btn-action btn-view"
                    title="Detail Departemen"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('departments.edit', $department->id) }}"
                    class="btn btn-action btn-edit"
                    title="Edit Departemen"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('departments.destroy', $department->id) }}"
                    method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-action btn-delete"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus departemen ini? Semua data terkait akan terpengaruh.')"
                        title="Hapus Departemen"
                        data-bs-toggle="tooltip">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                <a href="{{ route('employees.index', ['department' => $department->id]) }}"
                    class="btn btn-action btn-info"
                    title="Lihat Pegawai"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-list"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Alternative Table View (Uncomment if preferred) -->
<!--
<div class="table-responsive">
    <table class="table table-professional table-hover">
        <thead>
            <tr>
                <th width="60" class="text-center">#</th>
                <th>Nama Departemen</th>
                <th width="160" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $index => $department)
            <tr>
                <td class="text-center">
                    <div class="department-number">
                        <span class="fw-bold text-primary">{{ $index + 1 }}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="department-icon-sm me-3">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $department->nama_departemen }}</h6>
                            <small class="text-muted">Kode: DEP{{ str_pad($department->id, 3, '0', STR_PAD_LEFT) }}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('departments.show', $department->id) }}" 
                           class="btn btn-action btn-view" 
                           title="Detail"
                           data-bs-toggle="tooltip">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('departments.edit', $department->id) }}" 
                           class="btn btn-action btn-edit" 
                           title="Edit"
                           data-bs-toggle="tooltip">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('employees.index', ['department' => $department->id]) }}" 
                           class="btn btn-action btn-info" 
                           title="Lihat Pegawai"
                           data-bs-toggle="tooltip">
                            <i class="fas fa-list"></i>
                        </a>
                        <form action="{{ route('departments.destroy', $department->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-action btn-delete" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus departemen ini?')"
                                    title="Hapus"
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
-->
@else
<div class="empty-state">
    <div class="empty-icon">
        <i class="fas fa-building fa-4x"></i>
    </div>
    <h4 class="mt-3">Belum Ada Departemen</h4>
    <p class="text-muted mb-4">Mulai dengan membuat departemen pertama untuk organisasi Anda</p>
    <a href="{{ route('departments.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Buat Departemen Pertama
    </a>
</div>
@endif

<style>
    .department-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--neutral-light);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .department-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .department-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .department-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    .department-info {
        flex: 1;
    }

    .department-name {
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }

    .department-badge {
        background: rgba(44, 85, 48, 0.1);
        color: var(--primary-color);
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .department-actions {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: auto;
    }

    /* Table View Styles */
    .department-number {
        background: rgba(44, 85, 48, 0.1);
        border-radius: 8px;
        padding: 8px;
        text-align: center;
    }

    .department-icon-sm {
        width: 40px;
        height: 40px;
        background: rgba(44, 85, 48, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
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

    .btn-info:hover {
        background: var(--accent-color);
        color: white;
        border-color: var(--accent-color);
    }

    .empty-icon {
        color: var(--gray-color);
        opacity: 0.6;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .department-header {
            flex-direction: column;
            text-align: center;
        }

        .department-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
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