<?php

namespace Tests\Unit;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    private $token;
    private Author $author;

    protected function setUp(): void
    {
        parent::setUp();

        $this->author = Author::first() ?? Author::factory()->create();

        $user = User::where('email', $email = 'test@test.com')->first();
        if (!$user) {
            $user = User::factory()->create(compact('email'));
        }

        $response = $this->post(route('auth.login'), [
            'email' => $email,
            'password' => 12345678
        ]);

        $this->token = $response->json()['token'];
    }

    public function testCreateBook()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->postJson(route('books.store'), [
            'title' => $title = fake()->sentence(3),
            'description' => $description = fake()->text(10),
            'publish_date' => '2022-10-01',
            'author_id' => $this->author->id
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json()['success'] ?? false);
        // ensure the book was created
        $book = Book::orderBy('id', 'desc')->first();
        $this->assertNotEmpty($book);
        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals($title, $book->title);
        $this->assertEquals($description, $book->description);
        $this->assertEquals(Carbon::parse('2022-10-01'), $book->publish_date);
        $this->assertEquals($this->author->id, $book->author_id);
    }

    public function testGetAllBooks()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->getJson(route('books.index'));

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json());
    }

    public function testUpdateBook()
    {
        $book = Book::orderBy('id', 'desc')->first() ?? Book::factory()->create();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->patchJson(
            route('books.update', $book),
            [
                'title' => $title = $book->title . ' - Updated'
            ]
        );

        $response->assertStatus(200);
        $this->assertTrue($response->json()['success'] ?? false);
        $book->fresh();
        $this->assertEquals($book->title . ' - Updated', $title);
    }

    public function testDeleteBook()
    {
        $book = Book::orderBy('id', 'desc')->first() ?? Book::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->deleteJson(route('books.destroy', $book));

        $response->assertStatus(200);
        $this->assertTrue($response->json()['success'] ?? false);
        $book = $book->fresh();
        $this->assertNull($book);
    }
}
