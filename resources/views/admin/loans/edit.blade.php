@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Edit Peminjaman</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">User</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($loan->user_id == $user->id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Buku</label>
                <select name="book_id" class="form-control" required>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" @if($loan->book_id == $book->id) selected @endif>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
                @error('book_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="loan_date" class="form-control" value="{{ $loan->loan_date }}" required>
                @error('loan_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Kembali</label>
                <input type="date" name="return_date" class="form-control" value="{{ $loan->return_date }}">
                @error('return_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="dipinjam" @if($loan->status == 'dipinjam') selected @endif>Dipinjam</option>
                    <option value="dikembalikan" @if($loan->status == 'dikembalikan') selected @endif>Dikembalikan</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection