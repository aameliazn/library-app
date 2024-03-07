<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use App\Models\RelationBookCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BookCategory::all();
        $auth = Auth::user();
        $books = Book::all();
        return view('dashboard', compact('categories', 'auth', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
        ])->Validate();

        BookCategory::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Berhasil menambahkan kategori buku');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'pub_year' => 'required',
        ])->Validate();

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'pub_year' => $request->pub_year,
        ]);

        RelationBookCategory::create([
            'bookId' => $book->id,
            'categoryId' => $request->category,
        ]);

        return back()->with('success', 'Berhasil menambahkan buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
