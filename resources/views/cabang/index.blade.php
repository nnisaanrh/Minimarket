<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cabang') }}
        </h2>
    </x-slot>

<div class="container">
    <h1>Daftar Cabang</h1>
    <a href="{{ route('cabang.create') }}" class="btn btn-primary mb-3">Tambah Cabang</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cabangs as $no->$cabang)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $cabang->name }}</td>
                <td>{{ $cabang->alamat }}</td>
                <td>{{ $cabang->kota }}</td>
                <td>
                    <a href="{{ route('cabang.edit', $cabang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('cabang.destroy', $cabang->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus cabang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
=
