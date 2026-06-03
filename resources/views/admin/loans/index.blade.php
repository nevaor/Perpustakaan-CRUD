@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Peminjaman</h4>
        <a href="{{ route('admin.loans.create') }}" class="btn btn-primary btn-sm">Tambah Peminjaman</a>
    </div>

    <div class="card-body">
        @if($loans->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->loan_date }}</td>
                            <td>{{ $loan->return_date ?? '-' }}</td>
                            <td>
                                @if($loan->status === 'dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @else
                                    <span class="badge bg-success">Dikembalikan</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.loans.edit', $loan->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.loans.destroy', $loan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus peminjaman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Belum ada data peminjaman.</p>
        @endif
    </div>
</div>
@endsection