<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Http\Resources\CategoryResource;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category'];

    public function tasks(){
        return $this->hasMany(Task::class);
    } 

    protected function category(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value)
        );
    }

    static public function  categories() {
        $category = CategoryResource::collection(self::all())->resolve();
        // Sort by the calculated 'type' value
        $sorted = collect($category)->sortBy('category')->values();
        return $sorted->all(); // Return as plain array
    }

}
