<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['parent_id', 'name', 'description', 'due_date', 'done'];

    public function taskTodo()
    {
        return $this->hasOne(Todo::class, 'id', 'parent_id');
    }

    public function subTodos()
    {
        return $this->hasMany(Todo::class, 'parent_id', 'id');
    }
}
