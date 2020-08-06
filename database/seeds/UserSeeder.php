<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            factory(App\PostCategory::class, 1)->create(['user_id' => $user->id])->each(function ($category) {
                $category->posts()->saveMany(factory(App\Post::class, 5)->create(['category_id' => $category->id, 'user_id' => $category->user->id]));
            });
        });
    }

}


