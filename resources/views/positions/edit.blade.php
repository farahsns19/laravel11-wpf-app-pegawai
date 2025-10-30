@extends('layouts.app')

@section('title', 'Edit Jabatan')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Edit Jabatan</h1>

    <form action="{{ route('positions.update', $position->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Jabatan</label>
            <input type="text" name="nama_jabatan" value="{{ $position->nama_jabatan }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gaji Pokok</label>
            <input type="number" name="gaji_pokok" value="{{ $position->gaji_pokok }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

@endsection