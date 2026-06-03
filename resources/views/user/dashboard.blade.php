@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h3>Dashboard User</h3>
        <p>Selamat datang, {{ Auth::user()->name }}.</p>

        <div class="alert alert-success">
            Kamu login sebagai user. Nanti di sini user bisa melihat buku dan melakukan peminjaman.
        </div>
    </div>
</div>
@endsection