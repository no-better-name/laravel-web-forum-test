<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Section;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $moderator_count = fake()->numberBetween(1, 7);
        for ($i = 0; $i < $moderator_count; ++$i)
        {
            $lower_bound = intval($moderator_count <= 1);
            $upper_bound = 10 - $moderator_count;
            $section_count = fake()->numberBetween($lower_bound, $upper_bound);
            User::factory()
                ->moderator()
                ->has(
                    Section::factory()
                        ->count($section_count)
                )
                ->create();
        }

        $user_count = 50 + fake()->numberBetween(20, 50)*$moderator_count;
        User::factory()->count($user_count)->create();

        $post_count = 0;
        $parent_comment_count = 0;
        $reply_comment_count = 0;
        for ($i = 0; $i < User::all()->count(); ++$i)
        {
            $post_count += fake()->numberBetween(0, 10);
            $parent_comment_count += fake()->numberBetween(0, 50);
            $reply_comment_count += fake()->numberBetween(0, 250);
        }

        for ($i = 0; $i < $post_count; ++$i)
        {
            Post::factory()
                ->for(User::inRandomOrder()->first())
                ->for(Section::inRandomOrder()->first())
                ->create();
        }
        for ($i = 0; $i < $parent_comment_count; ++$i)
        {
            Comment::factory()
                ->for(User::inRandomOrder()->first())
                ->for(Post::inRandomOrder()->first())
                ->create();
        }
        for ($i = 0; $i < $reply_comment_count; ++$i)
        {
            while (!($random_post = Post::inRandomOrder()->first()) or !($random_comment = $random_post->comments()->inRandomOrder()->first())) { }
            Comment::factory()
                ->for(User::inRandomOrder()->first())
                ->for($random_post)
                ->for($random_comment)
                ->create();
        }

        $posts = Post::all()->shuffle();
        foreach ($posts as $post)
        {
            $post_upvote_count = fake()->numberBetween(0, User::all()->count());
            $post_downvote_count = fake()->numberBetween(0, User::all()->count() - $post_upvote_count);

            $users = User::all()->shuffle()->pluck('id');
            $upvote_user_ids = $users->slice(0, $post_upvote_count)->toArray();
            $downvote_user_ids = $users->slice($post_upvote_count, $post_downvote_count)->toArray();

            $post->votes()->attach(
                $upvote_user_ids, ['vote' => 'up']
            );
            $post->votes()->attach(
                $downvote_user_ids, ['vote' => 'down']
            );
        }

        $comments = Comment::all()->shuffle();
        foreach ($comments as $comment)
        {
            $comment_upvote_count = fake()->numberBetween(0, User::all()->count());
            $comment_downvote_count = fake()->numberBetween(0, User::all()->count() - $comment_upvote_count);

            $users = User::all()->shuffle()->pluck('id');
            $upvote_user_ids = $users->slice(0, $comment_upvote_count)->toArray();
            $downvote_user_ids = $users->slice($comment_upvote_count, $comment_downvote_count)->toArray();

            $comment->votes()->attach(
                $upvote_user_ids, ['vote' => 'up']
            );
            $comment->votes()->attach(
                $downvote_user_ids, ['vote' => 'down']
            );
        }
    }
}
