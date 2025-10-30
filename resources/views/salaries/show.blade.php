@extends('layouts.app')

@section('title', 'Detail Gaji Pegawai')

@section('content')
<div class="container mt-5">
    <h2>Detail Gaji Pegawai</h2>
    <div class="card p-3">
        <p><strong>Pegawai:</strong> {{ $salary->employee->nama_lengkap ?? '-' }}</p>
        <p><strong>Bulan/Tahun:</strong> {{ $salary->bulan }}/{{ $salary->tahun }}</p>
        <p><strong>Gaji Pokok:</strong> {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</p>
        <p><strong>Tunjangan:</strong> {{ number_format($salary->tunjangan, 0, ',', '.') }}</p>
        <p><strong>Potongan:</strong> {{ number_format($salary->potongan ?? 0, 0, ',', '.') }}</p>
        <p><strong>Total Gaji:</strong> {{ number_format($salary->total_gaji ?? ($salary->gaji_pokok + $salary->tunjangan), 0, ',', '.') }}</p>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection