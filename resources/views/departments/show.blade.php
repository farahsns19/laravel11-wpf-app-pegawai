@extends('layouts.app')

@section('title', 'Detail Departemen')

@section('content')
<div class="container mt-5">
    <h2>Detail Departemen</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>Nama Departemen</th>
            <td>{{ $department->nama_departemen }}</td>
        </tr>
    </table>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection