<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        $regularUser = User::factory()->create([
            'name'     => 'Regular User',
            'email'    => 'user@example.com',
            'password' => bcrypt('password'),
            'role'     => 'user',
        ]);

        $users = User::factory(4)->create();

        $allUsers = $users->push($admin)->push($regularUser);

        $allUsers->each(function ($user) use ($allUsers) {
            $posts = Post::factory(3)->create(['user_id' => $user->id]);

            $posts->each(function ($post) use ($allUsers) {
                Comment::factory(4)->create([
                    'post_id' => $post->id,
                    'user_id' => $allUsers->random()->id,
                ]);
            });
        });
    }
}
