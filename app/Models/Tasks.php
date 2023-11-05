<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'task_title','task_description','completed'
    ];
}
