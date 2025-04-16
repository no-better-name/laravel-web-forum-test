<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->chaperone();
    }

    public function posts_voted(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_votes')->using(PostVote::class)->as('vote')->withPivot('vote')->withTimestamps();
    }
    public function posts_upvoted(): BelongsToMany
    {
        return $this->posts_voted()->wherePivot('vote', '=', 'up');
    }
    public function posts_downvoted(): BelongsToMany
    {
        return $this->posts_voted()->wherePivot('vote', '=', 'down');
    }

    public function post_votes(): HasMany
    {
        return $this->hasMany(PostVote::class)->chaperone();
    }
    public function post_upvotes(): BelongsToMany
    {
        return $this->post_votes()->where('vote', '=', 'up');
    }
    public function post_downvotes(): BelongsToMany
    {
        return $this->post_votes()->where('vote', '=', 'down');
    }

    public function comments_voted(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'comment_votes')->using(CommentVote::class)->as('vote')->withPivot('vote')->withTimestamps();
    }
    public function comments_upvoted(): BelongsToMany
    {
        return $this->comments_voted()->wherePivot('vote', '=', 'up');
    }
    public function comments_downvoted(): BelongsToMany
    {
        return $this->comments_voted()->wherePivot('vote', '=', 'down');
    }

    public function comment_votes(): HasMany
    {
        return $this->hasMany(CommentVote::class)->chaperone();
    }
    public function comment_upvotes(): BelongsToMany
    {
        return $this->comment_votes()->where('vote', '=', 'up');
    }
    public function comment_downvotes(): BelongsToMany
    {
        return $this->comment_votes()->where('vote', '=', 'down');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->chaperone();
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->chaperone();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
