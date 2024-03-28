<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCollection extends Model
{
    use HasFactory;

    protected $table = 'private_collections';

    protected $fillable = [
        'userId',
        'bookId',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookId');
    }
}
