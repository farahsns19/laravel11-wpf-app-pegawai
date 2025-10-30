@extends('layouts.app')

@section('title', 'Tambah Gaji Pegawai')

@section('content')
<div class="container mt-5">
    <h2>Tambah Gaji Pegawai</h2>
    <form action="{{ route('salaries.store') }}" method="POST">
        @csrf

        <!-- Pilih Pegawai -->
        <div class="mb-3">
            <label for="employee_id" class="form-label">Pegawai</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bulan -->
        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="number" name="bulan" id="bulan" class="form-control" required min="1" max="12" placeholder="1-12">
        </div>

        <!-- Tahun -->
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="form-control" required min="2000" max="2100" placeholder="2025">
        </div>

        <!-- Gaji Pokok -->
        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" required>
        </div>

        <!-- Tunjangan -->
        <div class="mb-3">
            <label for="tunjangan" class="form-label">Tunjangan</label>
            <input type="number" name="tunjangan" id="tunjangan" class="form-control" required value="0">
        </div>

        <!-- Potongan (Opsional) -->
        <div class="mb-3">
            <label for="potongan" class="form-label">Potongan</label>
            <input type="number" name="potongan" id="potongan" class="form-control" value="0">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection