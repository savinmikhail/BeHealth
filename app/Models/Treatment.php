<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
        'kit_id',
        'name',
        'dose',
        'comment',
        'status',
    ];

//    public function getUserId()
//    {
//        return $this->user_id;
//    }

//    public function children()
//    {
//        return $this->hasMany(Comment::class, 'parent_id', 'id');
//    }
}
