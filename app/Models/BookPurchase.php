<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property int $book_id
 *
 * @mixin BookPurchase
 */
class BookPurchase extends Model
{
    protected $table = 'book_purchases';

    /**
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
