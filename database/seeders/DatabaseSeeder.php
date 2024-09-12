<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create a dummy user, default password is 12345678
        $user = User::where('email', $email = 'test@example.com')->first();
        if (!$user) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => $email,
            ]);
        }

        // create dummy authors and books
        Author::factory(10)
            ->create()
            ->each(function ($author) {
                $author->books()->createMany(Book::factory(5)->make()->toArray());
            });
    }
}
