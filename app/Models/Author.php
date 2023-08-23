<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $full_name
 *
 * @mixin Author
 */
class Author extends Model
{
    protected $table = 'authors';

    /**
     * @var array<string>
     */
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_authors', 'author_id', 'book_id');
    }
}
