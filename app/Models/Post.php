<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users_voted(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_votes')->using(PostVote::class)->as('vote')->withPivot('vote')->withTimestamps();
    }
    public function users_upvoted(): BelongsToMany
    {
        return $this->users_voted()->wherePivot('vote', '=', 'up');
    }
    public function users_downvoted(): BelongsToMany
    {
        return $this->users_voted()->wherePivot('vote', '=', 'down');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PostVote::class)->chaperone();
    }
    public function upvotes(): HasMany
    {
        return $this->votes()->where('vote', '=', 'up');
    }
    public function downvotes(): HasMany
    {
        return $this->votes()->where('vote', '=', 'down');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->chaperone();
    }

    protected $fillable = [
        'title',
        'body',
    ];
}
