<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $title
 * @property int $total_pages
 * @property Carbon $published_at
 *
 * @mixin Book
 */
class Book extends Model
{
    protected $table = 'books';

    /**
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'book_id', 'author_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genres', 'book_id', 'genre_id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(BookPurchase::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {

        //
    }
}
