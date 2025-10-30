@extends('layouts.app')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Tambah Jabatan Baru</h2>

    <form action="{{ route('positions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
