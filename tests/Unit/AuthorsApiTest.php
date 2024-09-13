<?php

namespace Tests\Unit;

use App\Models\Author;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class AuthorsApiTest extends TestCase
{
    private $token;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::where('email', $email = 'test@test.com')->first();
        if (!$user) {
            $user = User::factory()->create(compact('email'));
        }

        $response = $this->post(route('auth.login'), [
            'email' => $email,
            'password' => 12345678
        ]);

        $this->token = $response->json()['token'] ?? '';
    }

    public function testCreateAuthor()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->postJson(route('authors.store'), [
            'name' => $name = fake()->name(),
            'bio' => fake()->sentence(),
            'birth_date' => '2000-01-01',
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json()['success'] ?? false);
        // ensure the book was created
        $author = Author::where('name', $name)->first();
        $this->assertNotEmpty($author);
        $this->assertInstanceOf(Author::class, $author);
        $this->assertEquals($name, $author->name);
        $this->assertEquals(Carbon::parse('2000-01-01'), $author->birth_date);
    }

    public function testGetAllAuthors()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->getJson(route('authors.index'));

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json());
    }

    public function testUpdateAuthor()
    {
        $author = Author::orderBy('id', 'desc')->first() ?? Author::factory()->create();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->patchJson(
            route('authors.update', $author),
            [
                'name' => ($name = fake()->name()),
            ]
        );

        $response->assertStatus(200);
        $this->assertTrue($response->json()['success'] ?? false);
        $author = $author->fresh();
        $this->assertEquals($author->name, $name);
    }

    public function testDeleteAuthor()
    {
        $author = Author::orderBy('id', 'desc')->first() ?? Author::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->deleteJson(route('authors.destroy', $author));

        $response->assertStatus(200);
        $this->assertTrue($response->json()['success'] ?? false);
        $author = Author::find($author->id);
        $this->assertNull($author);
    }
}
