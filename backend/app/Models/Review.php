<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[

        'title',
        'text',
        'amount',
        'user_id',
        'bootcamp_id'
];
}
