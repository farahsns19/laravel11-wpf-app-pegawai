@extends('layouts.app')

@section('title', 'Tambah Departemen')

@section('content')
<div class="container mt-5">
    <h2>Tambah Departemen</h2>
    <form action="{{ route('departments.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Departemen</label>
            <input type="text" name="nama_departemen" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection