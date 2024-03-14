<?php

namespace App\Models;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'userId',
        'bookId',
        'loan_date',
        'due_date',
        'status',
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
