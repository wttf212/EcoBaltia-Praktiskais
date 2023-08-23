<?php

use App\Http\Controllers\BookController;
use App\Models\BookPurchase;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Can filter by adding query params: filter[author]=xxx and/or filter[title]=xxx and/or filter[top]=10
 * This should be in api.php, but at this point there is no use of it. Wanted to grab data from
 */
Route::get('books', [BookController::class, 'list'])->name('books');

/**
 * Should be POST etc... but for simplicity sake its like this.
 */
Route::get('books/{bookId}/purchase', function (int $bookId) {
    $purchase = new BookPurchase();
    $purchase->book_id = $bookId;
    $purchase->save();
    return redirect()->back();
})->name('purchase');
