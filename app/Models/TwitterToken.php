<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterToken extends Model
{
    use HasFactory;
    protected $table = 'twitter_token';
    protected $guarded = ['id'];
}
