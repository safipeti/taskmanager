<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use App\Repositories\Todo\TodoRepositoryInterface;

class TodoController extends Controller
{

    protected $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function index()
    {
       $date = request()->due_date ? date(request()->due_date) : date('Y-m-d');


       $todos = $this->todoRepository->getAll($date);

       return response()->json($todos, 201);
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = $this->todoRepository->create($request->all());

        return response()->json($todo, 201);
    }

    public function show(Todo $todo)
    {
        return $this->todoRepository->find($todo->id);
    }

    public function update(StoreTodoRequest $request, Todo $todo)
    {
        return $this->todoRepository->update($todo, $request->all());
    }

    public function destroy(Todo $todo)
    {
        return $this->todoRepository->delete(58);
        return $this->todoRepository->delete($todo->id);
    }
}
