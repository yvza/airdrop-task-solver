<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskResults extends Model
{
    use HasFactory;
    protected $table = 'task_results';
    protected $guarded = ['id'];
}
