<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $name
 *
 * @mixin Genre
 */
class Genre extends Model
{
    protected $table = 'genres';

    /**
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_genres', 'genre_id', 'book_id');
    }
}
