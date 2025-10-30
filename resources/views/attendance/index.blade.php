@extends('layouts.app')

@section('title', 'Daftar Kehadiran')
@section('page-title', 'Manajemen Kehadiran')
@section('page-subtitle', 'Rekap data presensi dan absensi pegawai')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Daftar Kehadiran</h4>
        <p class="text-muted mb-0">Total <span class="fw-semibold">{{ $attendances->count() }}</span> catatan kehadiran</p>
    </div>
    <a href="{{ route('attendance.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Tambah Kehadiran
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-professional alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($attendances->isNotEmpty())
<div class="table-responsive">
    <table class="table table-professional table-hover">
        <thead>
            <tr>
                <th width="250">Pegawai</th>
                <th width="120">Tanggal</th>
                <th width="120">Jam Masuk</th>
                <th width="120">Jam Keluar</th>
                <th width="120">Status</th>
                <th width="150" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="employee-avatar-sm me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $attendance->employee->nama_lengkap }}</h6>
                            <small class="text-muted">{{ $attendance->employee->position->nama_jabatan ?? '-' }}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <strong>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</strong>
                </td>
                <td>
                    @if($attendance->waktu_masuk)
                    <span class="time-badge time-in">
                        <i class="fas fa-sign-in-alt me-1"></i>{{ $attendance->waktu_masuk }}
                    </span>
                    @else
                    <span class="time-badge time-missing">-</span>
                    @endif
                </td>
                <td>
                    @if($attendance->waktu_keluar)
                    <span class="time-badge time-out">
                        <i class="fas fa-sign-out-alt me-1"></i>{{ $attendance->waktu_keluar }}
                    </span>
                    @else
                    <span class="time-badge time-missing">-</span>
                    @endif
                </td>
                <td>
                    @if($attendance->status_absensi == 'hadir')
                    <span class="status-badge status-present">
                        <i class="fas fa-check me-1"></i>Hadir
                    </span>
                    @elseif($attendance->status_absensi == 'izin')
                    <span class="status-badge status-permit">
                        <i class="fas fa-envelope me-1"></i>Izin
                    </span>
                    @elseif($attendance->status_absensi == 'sakit')
                    <span class="status-badge status-sick">
                        <i class="fas fa-plus-square me-1"></i>Sakit
                    </span>
                    @else
                    <span class="status-badge status-absent">
                        <i class="fas fa-times me-1"></i>{{ ucfirst($attendance->status_absensi) }}
                    </span>
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('attendance.show', $attendance->id) }}"
                            class="btn btn-action btn-view"
                            title="Detail Kehadiran"
                            data-bs-toggle="tooltip">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('attendance.edit', $attendance->id) }}"
                            class="btn btn-action btn-edit"
                            title="Edit Kehadiran"
                            data-bs-toggle="tooltip">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('attendance.destroy', $attendance->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-action btn-delete"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data kehadiran ini?')"
                                title="Hapus Kehadiran"
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
@else
<div class="empty-state">
    <div class="empty-icon">
        <i class="fas fa-clipboard-list fa-4x"></i>
    </div>
    <h4 class="mt-3">Belum Ada Data Kehadiran</h4>
    <p class="text-muted mb-4">Mulai dengan menambahkan data kehadiran pertama</p>
    <a href="{{ route('attendance.create') }}" class="btn btn-primary-professional btn-professional">
        <i class="fas fa-plus-circle me-2"></i>Tambah Kehadiran Pertama
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

    .time-badge {
        padding: 6px 10px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
    }

    .time-in {
        background: rgba(56, 161, 105, 0.1);
        color: #22543d;
        border: 1px solid rgba(56, 161, 105, 0.2);
    }

    .time-out {
        background: rgba(245, 158, 11, 0.1);
        color: #744210;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .time-missing {
        background: rgba(107, 114, 128, 0.1);
        color: #374151;
        border: 1px solid rgba(107, 114, 128, 0.2);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
    }

    .status-present {
        background: rgba(56, 161, 105, 0.15);
        color: #22543d;
        border: 1px solid rgba(56, 161, 105, 0.3);
    }

    .status-permit {
        background: rgba(59, 130, 246, 0.15);
        color: #1e40af;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .status-sick {
        background: rgba(245, 158, 11, 0.15);
        color: #744210;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .status-absent {
        background: rgba(239, 68, 68, 0.15);
        color: #7f1d1d;
        border: 1px solid rgba(239, 68, 68, 0.3);
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

    /* Hover effect untuk table row */
    .table-professional tbody tr {
        transition: all 0.2s ease;
    }

    .table-professional tbody tr:hover {
        background: rgba(44, 85, 48, 0.04) !important;
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