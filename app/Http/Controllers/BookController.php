<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Danh sách sách
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Form tạo
    public function create()
    {
        return view('books.create');
    }

    // Lưu sách
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Thêm sách thành công!');
    }

    // Chi tiết sách
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Form chỉnh sửa
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Cập nhật sách
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|min:3',
            'author' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa sách
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Đã xóa sách!');
    }
}

