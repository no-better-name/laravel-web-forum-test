<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->chaperone();
    }

    public function users_voted(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comment_votes')->using(CommentVote::class)->as('vote')->withPivot('vote')->withTimestamps();
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
        return $this->hasMany(CommentVote::class)->chaperone();
    }
    public function upvotes(): HasMany
    {
        return $this->votes()->where('vote', '=', 'up');
    }
    public function downvotes(): HasMany
    {
        return $this->votes()->where('vote', '=', 'down');
    }

    protected $fillable = [
        'body',
    ];
}
