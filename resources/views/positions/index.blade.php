@extends('layouts.app')

@section('title', 'Daftar Jabatan')
@section('page-title', 'Manajemen Jabatan')
@section('page-subtitle', 'Struktur jabatan dan level gaji perusahaan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Daftar Jabatan</h4>
        <p class="text-muted mb-0">Total <span class="fw-semibold">{{ $positions->count() }}</span> jabatan terdaftar</p>
    </div>
    <a href="{{ route('positions.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Tambah Jabatan
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-professional alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($positions->isNotEmpty())
<div class="row">
    @foreach($positions as $position)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="position-card">
            <div class="position-header">
                <div class="position-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="position-info">
                    <h5 class="position-title">{{ $position->nama_jabatan }}</h5>
                    <span class="position-level-badge">
                        @if($position->gaji_pokok >= 10000000)
                        <i class="fas fa-crown me-1"></i>Executive
                        @elseif($position->gaji_pokok >= 5000000)
                        <i class="fas fa-chart-line me-1"></i>Manager
                        @else
                        <i class="fas fa-user-tie me-1"></i>Staff
                        @endif
                    </span>
                </div>
            </div>

            <div class="position-salary">
                <div class="salary-amount">
                    <i class="fas fa-money-bill-wave text-success me-2"></i>
                    <span class="salary-number">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</span>
                </div>
                <small class="text-muted">Gaji Pokok per Bulan</small>
            </div>

            <div class="position-actions">
                <a href="{{ route('positions.show', $position->id) }}"
                    class="btn btn-action btn-view"
                    title="Detail Jabatan"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('positions.edit', $position->id) }}"
                    class="btn btn-action btn-edit"
                    title="Edit Jabatan"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('positions.destroy', $position->id) }}"
                    method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-action btn-delete"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini? Pegawai dengan jabatan ini akan kehilangan referensi.')"
                        title="Hapus Jabatan"
                        data-bs-toggle="tooltip">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Alternative Table View -->
<!--
<div class="table-responsive">
    <table class="table table-professional table-hover">
        <thead>
            <tr>
                <th>Jabatan</th>
                <th class="text-center">Level</th>
                <th class="text-end">Gaji Pokok</th>
                <th width="140" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($positions as $position)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="position-icon-sm me-3">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $position->nama_jabatan }}</h6>
                            <small class="text-muted">Kode: POS{{ str_pad($position->id, 3, '0', STR_PAD_LEFT) }}</small>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    @if($position->gaji_pokok >= 10000000)
                        <span class="level-badge level-executive">
                            <i class="fas fa-crown me-1"></i>Executive
                        </span>
                    @elseif($position->gaji_pokok >= 5000000)
                        <span class="level-badge level-manager">
                            <i class="fas fa-chart-line me-1"></i>Manager
                        </span>
                    @else
                        <span class="level-badge level-staff">
                            <i class="fas fa-user-tie me-1"></i>Staff
                        </span>
                    @endif
                </td>
                <td class="text-end">
                    <div class="salary-display">
                        <strong class="text-success">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</strong>
                        <div class="text-muted small">per bulan</div>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('positions.show', $position->id) }}" 
                           class="btn btn-action btn-view" 
                           title="Detail"
                           data-bs-toggle="tooltip">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('positions.edit', $position->id) }}" 
                           class="btn btn-action btn-edit" 
                           title="Edit"
                           data-bs-toggle="tooltip">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('positions.destroy', $position->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-action btn-delete" 
                                    onclick="return confirm('Yakin hapus jabatan ini?')"
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
        <i class="fas fa-briefcase fa-4x"></i>
    </div>
    <h4 class="mt-3">Belum Ada Jabatan</h4>
    <p class="text-muted mb-4">Mulai dengan membuat jabatan pertama untuk organisasi Anda</p>
    <a href="{{ route('positions.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Buat Jabatan Pertama
    </a>
</div>
@endif

<style>
    .position-card {
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

    .position-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .position-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .position-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #d69e2e, #f6ad55);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    .position-info {
        flex: 1;
    }

    .position-title {
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }

    .position-level-badge {
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .position-level-badge:has(.fa-crown) {
        background: rgba(245, 158, 11, 0.15);
        color: #744210;
    }

    .position-level-badge:has(.fa-chart-line) {
        background: rgba(56, 161, 105, 0.15);
        color: #22543d;
    }

    .position-level-badge:has(.fa-user-tie) {
        background: rgba(66, 153, 225, 0.15);
        color: #2a4365;
    }

    .position-salary {
        text-align: center;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: rgba(56, 161, 105, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(56, 161, 105, 0.1);
    }

    .salary-amount {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .salary-number {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--success-color);
    }

    .position-actions {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: auto;
    }

    /* Table View Styles */
    .position-icon-sm {
        width: 40px;
        height: 40px;
        background: rgba(214, 158, 46, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d69e2e;
    }

    .level-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
    }

    .level-executive {
        background: rgba(245, 158, 11, 0.15);
        color: #744210;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .level-manager {
        background: rgba(56, 161, 105, 0.15);
        color: #22543d;
        border: 1px solid rgba(56, 161, 105, 0.2);
    }

    .level-staff {
        background: rgba(66, 153, 225, 0.15);
        color: #2a4365;
        border: 1px solid rgba(66, 153, 225, 0.2);
    }

    .salary-display {
        text-align: right;
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

    .empty-icon {
        color: var(--gray-color);
        opacity: 0.6;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .position-header {
            flex-direction: column;
            text-align: center;
        }

        .position-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .salary-amount {
            flex-direction: column;
            gap: 0.25rem;
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