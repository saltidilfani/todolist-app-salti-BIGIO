<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $table = 'todolists';

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'is_done',
        'user_id'
    ];

    
    protected $casts = [
        'deadline' => 'date',
    ];
}