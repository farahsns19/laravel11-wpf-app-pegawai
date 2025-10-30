@extends('layouts.app')

@section('title', 'Edit Gaji Pegawai')

@section('content')
<div class="container mt-5">
    <h2>Edit Gaji Pegawai</h2>
    <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih Pegawai -->
        <div class="mb-3">
            <label>Pegawai</label>
            <select name="employee_id" class="form-select" required>
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ $employee->id == $salary->employee_id ? 'selected' : '' }}>
                    {{ $employee->nama_lengkap }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Bulan -->
        <div class="mb-3">
            <label>Bulan</label>
            <input type="number" name="bulan" value="{{ $salary->bulan }}" class="form-control" min="1" max="12" required>
        </div>

        <!-- Tahun -->
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" value="{{ $salary->tahun }}" class="form-control" min="2000" max="2100" required>
        </div>

        <!-- Gaji Pokok -->
        <div class="mb-3">
            <label>Gaji Pokok</label>
            <input type="number" name="gaji_pokok" value="{{ $salary->gaji_pokok }}" class="form-control" required>
        </div>

        <!-- Tunjangan -->
        <div class="mb-3">
            <label>Tunjangan</label>
            <input type="number" name="tunjangan" value="{{ $salary->tunjangan }}" class="form-control" required>
        </div>

        <!-- Potongan -->
        <div class="mb-3">
            <label>Potongan</label>
            <input type="number" name="potongan" value="{{ $salary->potongan }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection