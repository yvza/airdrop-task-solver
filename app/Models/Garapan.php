<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garapan extends Model
{
    use HasFactory;
    protected $table = 'garapan';
    protected $guarded = ['id'];
}
