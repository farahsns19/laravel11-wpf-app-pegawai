@extends('layouts.app')

@section('title', 'Tambah Kehadiran')

@section('content')
<div class="container mt-5">
    <h2>Tambah Kehadiran</h2>
    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Pegawai</label>
            <select name="karyawan_id" class="form-select" required>
                <option value="">Pilih Pegawai</option>
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jam Masuk</label>
            <input type="time" name="waktu_masuk" class="form-control">
        </div>
        <div class="mb-3">
            <label>Jam Keluar</label>
            <input type="time" name="waktu_keluar" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_absensi" class="form-select" required>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection