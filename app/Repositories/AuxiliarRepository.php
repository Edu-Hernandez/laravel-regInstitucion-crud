<?php
namespace App\Repositories;

use App\Interfaces\AuxiliarRepositoryInterface;
use App\Models\Auxiliar;

class AuxiliarRepository implements AuxiliarRepositoryInterface{
    
    public function getAll()
    {
        return Auxiliar::all(); //retorna todos los registros
    }

    public function getById($id)
    {
        return Auxiliar::findOrFail($id);
    }

    public function store(array $data)
    {
        return Auxiliar::create($data);
    }

    public function update($data, $id)
    {
        $auxiliar = Auxiliar::findOrFail($id);
        $auxiliar->update($data);
        return $auxiliar;
    }

    public function delete($id)
    {
        return Auxiliar::destroy($id);
    }
}