@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<div class="container mt-5">
    <h2>Edit Data Pegawai</h2>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ old('email', $employee->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control"
                value="{{ old('nomor_telepon', $employee->nomor_telepon) }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $employee->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control"
                value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $employee->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <!-- Edit Departemen -->
        <div class="mb-3">
            <label for="departemen_id" class="form-label">Departemen</label>
            <select name="departemen_id" id="departemen_id" class="form-select" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}"
                    {{ old('departemen_id', $employee->departemen_id) == $department->id ? 'selected' : '' }}>
                    {{ $department->nama_departemen }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Edit Jabatan -->
        <div class="mb-3">
            <label for="jabatan_id" class="form-label">Jabatan</label>
            <select name="jabatan_id" id="jabatan_id" class="form-select" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($positions as $position)
                <option value="{{ $position->id }}"
                    {{ old('jabatan_id', $employee->jabatan_id) == $position->id ? 'selected' : '' }}>
                    {{ $position->nama_jabatan }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection