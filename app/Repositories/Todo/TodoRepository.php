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

    public function getAll($date)
    {
        return $this->todo->with('subTodos')
        ->where('parent_id', null)
        ->where('due_date', $date)
        ->orderBy('created_at', 'DESC')
        ->get();
    }


    public function find($id)
    {
        return $this->todo->find($id);
    }

    public function create($details)
    {
        return Todo::create($details);
    }

    public function update(Todo $todo, $details)
    {
        return $todo->update($details);
    }

    public function setTaskDone($id) 
    {
        $todo = Todo::find($id);
        $todo->done = true;
        $todo->save();
        return $todo;
    }


    public function delete($id)
    {
        return $this->todo->destroy($id);
    }

}