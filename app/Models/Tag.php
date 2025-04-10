<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    const UPDATED_AT = null;

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag_relations');
    }

    protected $fillable = [
        'tag',
    ];
}
