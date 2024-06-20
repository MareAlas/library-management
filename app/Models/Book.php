<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'isbn', 
        'description',
        'published_year'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
