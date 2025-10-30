@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
<div class="container mt-5">
    <h2>Detail Pegawai</h2>

    <div class="card p-3 mb-3">
        <table class="table table-borderless">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $employee->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $employee->nomor_telepon }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $employee->tanggal_lahir }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $employee->alamat }}</td>
            </tr>
            <tr>
                <th>Tanggal Masuk</th>
                <td>{{ $employee->tanggal_masuk }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($employee->status) }}</td>
            </tr>
            <tr>
                <th>Departemen</th>
                <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection