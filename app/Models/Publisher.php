<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $id
 * @property string $name
 *
 * @mixin Publisher
 */
class Publisher extends Model
{
    protected $table = 'publishers';

    /**
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function book(): HasOne
    {
        return $this->hasOne(Book::class);
    }
}
