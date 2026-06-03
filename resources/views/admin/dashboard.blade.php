@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h3>Dashboard Admin</h3>
        <p>Selamat datang, {{ Auth::user()->name }}.</p>

        <div class="alert alert-primary">
            Kamu login sebagai admin. Nanti di sini akan ada menu CRUD buku, kategori, user, dan peminjaman.
        </div>
    </div>
    <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Kelola Buku</a>
</div>
@endsection

