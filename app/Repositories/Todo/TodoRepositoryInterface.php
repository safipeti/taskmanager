<?php

namespace App\Repositories\Todo;

use App\Models\Todo;

interface TodoRepositoryInterface
{
    public function getAll($date);

    public function find($id);

    public function delete($id);

    public function create($details);

    public function update(Todo $todo, $details);

    public function setTaskDone($id);
}