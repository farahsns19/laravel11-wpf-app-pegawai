@extends('layouts.app')

@section('title', 'Edit Kehadiran')

@section('content')
<div class="container mt-5">
    <h2>Edit Kehadiran</h2>
    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Pegawai</label>
            <select name="karyawan_id" class="form-select" required>
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ $employee->id == $attendance->karyawan_id ? 'selected' : '' }}>
                    {{ $employee->nama_lengkap }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $attendance->tanggal }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Masuk</label>
            <input type="time" name="waktu_masuk" value="{{ $attendance->waktu_masuk }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jam Keluar</label>
            <input type="time" name="waktu_keluar" value="{{ $attendance->waktu_keluar }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status_absensi" class="form-select" required>
                @foreach (['hadir', 'izin', 'sakit', 'alpha'] as $status)
                <option value="{{ $status }}" {{ $attendance->status_absensi == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection