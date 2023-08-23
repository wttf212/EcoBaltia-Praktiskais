<?php

namespace App\Models;

use App\Models\Scopes\FilterScope;
use Carbon\Carbon;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $title
 * @property int $total_pages
 * @property int $score
 * @property Carbon $published_at
 *
 * @mixin Book
 */
class Book extends Model
{
    /**
     * @var string
     */
    protected $table = 'books';

    /**
     * @var string[]
     */
    protected $appends = [
        'score',
        'purchaseCount',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new FilterScope());
    }

    public function getScoreAttribute(): int
    {
        return $this
            ->purchases()
            ->where('created_at', '>=', (new DateTimeImmutable())->sub(new DateInterval('P1M')))
            ->count();
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(BookPurchase::class);
    }

    public function getPurchaseCountAttribute(): int
    {
        return $this->purchases()->count();
    }

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
}
