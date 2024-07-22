<?php
namespace App\Repositories;

use App\Interfaces\ProfesorRepositoryInterface;
use App\Models\Profesor;

class ProfesorRepository implements ProfesorRepositoryInterface{

    public function getAll()
    {
        return Profesor::all();
    }

    public function getById($id)
    {
        return Profesor::findOrFail($id);
    }
    public function store(array $data)
    {
        return Profesor::create($data);
    }
    public function update($data, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->update($data);
        return $profesor;
    }

    public function delete($id)
    {
        return Profesor::destroy($id);
    }
}