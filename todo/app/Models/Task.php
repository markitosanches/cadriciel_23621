<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $table="my_task";
    // protected $primaryKey = "task_id";
    use HasFactory;

    protected $fillable = ['title', 'description', 'completed', 'due_date', 'user_id', 'category_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
