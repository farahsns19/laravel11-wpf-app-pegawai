@extends('layouts.app')

@section('title', 'Detail Jabatan')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detail Jabatan</h1>

    <table class="table table-bordered">
        <tr>
            <th>Nama Jabatan</th>
            <td>{{ $position->nama_jabatan }}</td>
        </tr>
        <tr>
            <th>Gaji Pokok</th>
            <td>{{ $position->gaji_pokok }}</td>
        </tr>
    </table>

    <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection