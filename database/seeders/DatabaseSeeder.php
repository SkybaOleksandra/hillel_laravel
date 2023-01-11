<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $users=User::factory(10)->create();

         $categories=Category::factory(25)->create();

         $posts=Post::factory(100)->make()->each(function ($post) use ($users, $categories) {
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
        });

         $tags=Tag::factory(100)->create();

         $posts->each(function ($post) use ($tags) {
             $post->tags()->attach($tags->random(rand(5, 10))->pluck('id'));
         });

        $comments=Comment::factory(300)->make()->each(function ($comment) use ($posts) {
            $comment->commentable_id = $posts->random()->id;
            $comment->save();
        });
    }
}
