<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово присваивать.
     * Это защита от нежелательного изменения полей.
     */
    protected $fillable = [
        'title',
        'author',
        'year',
        'category',
        'description',
        'price',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user')->withPivot('type', 'expires_at')->withTimestamps();
    }
}