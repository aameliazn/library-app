<?php

namespace App\Models;

use App\Models\Loan;
use App\Models\User;
use App\Models\PrivateCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'pub_year',
    ];

    public function loan()
    {
        return $this->hasMany(Loan::class, 'bookId');
    }

    public function privateCollection()
    {
        return $this->hasMany(PrivateCollection::class, 'bookId');
    }

    public function isLoanedByUser(User $user)
    {
        return $this->loan->where('userId', $user->id);
    }
}
