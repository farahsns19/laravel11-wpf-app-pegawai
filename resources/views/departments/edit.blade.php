@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
<div class="container mt-5">
    <h2>Edit Departemen</h2>
    <form action="{{ route('departments.update', $department->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Departemen</label>
            <input type="text" name="nama_departemen" value="{{ $department->nama_departemen }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection