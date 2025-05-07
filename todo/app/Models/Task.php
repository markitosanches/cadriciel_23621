<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $table="my_task";
    // protected $primaryKey = "task_id";
    use HasFactory;

    protected $fillable = ['title', 'description', 'completed', 'due_date', 'user_id'];
}
