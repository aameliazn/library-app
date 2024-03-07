<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationBookCategory extends Model
{
    use HasFactory;

    protected $table = 'relation_book_categories';

    protected $fillable = [
        'bookId',
        'categoryId',
    ];
}
