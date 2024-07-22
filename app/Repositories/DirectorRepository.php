<?php
namespace App\Repositories;

use App\Interfaces\DirectorRepositoryInterface;
use App\Models\Director;

class DirectorRepository implements DirectorRepositoryInterface
{

    public function getAll()
    {
        return Director::all();
    }

    public function getById($id)
    {
        return Director::findOrFail($id);
    }
    public function store(array $data)
    {
        return Director::create($data);
    }
    public function update($data, $id)
    {
        $director = Director::findOrFail($id);
        $director->update($data);
        return $director;
    }
    public function delete($id)
    {
        return Director::destroy($id);
    }
}
