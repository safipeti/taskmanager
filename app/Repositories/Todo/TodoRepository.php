<?php

namespace App\Repositories\Todo;

use App\Repositories\Todo\TodoRepositoryInterface;
use App\Models\Todo;

class TodoRepository implements TodoRepositoryInterface 
{

    public $todo;

    public function __construct(Todo $todo)
    {   
        $this->todo = $todo;
    }

    public function getAll()
    {
        return $this->todo->with('subTodos')->where('parent_id', null)->get();
    }


    public function find($id)
    {
        return $this->todo->find($id);
    }


    public function delete($id)
    {
        return $this->todo->delete($id);
    }


}