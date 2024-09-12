<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'publish_date',
        'author_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'publish_date' => 'date:Y-m-d',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Book to Author relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Author,Book>
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
