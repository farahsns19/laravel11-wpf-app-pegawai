@extends('layouts.app')

@section('title', 'Detail Kehadiran')

@section('content')
<div class="container mt-5">
    <h2>Detail Kehadiran</h2>
    <div class="card p-3">
        <p><strong>Pegawai:</strong> {{ $attendance->employee->nama_lengkap }}</p>
        <p><strong>Tanggal:</strong> {{ $attendance->tanggal }}</p>
        <p><strong>Jam Masuk:</strong> {{ $attendance->waktu_masuk }}</p>
        <p><strong>Jam Keluar:</strong> {{ $attendance->waktu_keluar }}</p>
        <p><strong>Status:</strong> {{ ucfirst($attendance->status_absensi) }}</p>
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection