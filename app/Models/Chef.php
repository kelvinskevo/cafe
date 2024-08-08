<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'image',
        'facebook', 'twitter', 'google_plus'
    ];

    protected $dates = ['deleted_at'];
}
