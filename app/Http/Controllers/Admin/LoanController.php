<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book'])->latest()->get();
        return view('admin.loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::all();
        $books = Book::all();
        return view('admin.loans.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        Loan::create($request->all());

        return redirect()->route('admin.loans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $loan = Loan::findOrFail($id);
        $users = User::all();
        $books = Book::all();
        return view('admin.loans.edit', compact('loan', 'users', 'books'));
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        $loan->update($request->all());

        return redirect()->route('admin.loans.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect()->route('admin.loans.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }
}