<?php

namespace App\Repositories\Todo;

interface TodoRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function delete($id);
}