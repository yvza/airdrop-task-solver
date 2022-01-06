<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKataKata extends Model
{
    use HasFactory;
    protected $table = 'list_kata_kata';
    protected $guarded = ['id'];
}
