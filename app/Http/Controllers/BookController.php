<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BookController extends Controller
{
    public function list(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $books = Book::query()
            ->with('authors')
            ->get()
            ->sortByDesc(function (Book $book) {
                return $book->score;
            });
        return view('books', compact('books'));
    }
}
