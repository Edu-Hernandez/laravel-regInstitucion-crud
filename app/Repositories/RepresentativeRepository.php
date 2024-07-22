<?php
namespace App\Repositories;

use App\Interfaces\RepresentativeRepositoryInterface;
use App\Models\Representative;

class RepresentativeRepository implements RepresentativeRepositoryInterface{

    public function getAll()
    {
        return Representative::all(); //muestra todos los datos
    }

    public function getById($id)
    {
        return Representative::findOrFail($id);  //muestra un registro especifico
    }
    public function store(array $data)
    {
        return Representative::create($data);  //se encarga de registrar
    }
    public function update($data, $id)
    {
        $representative = Representative::findOrFail($id);
        $representative->update($data);
        return $representative;                       // se encarga de actualizar
    }

    public function delete($id)
    {
        return Representative::destroy($id);     //se encarga de eliminar
    }
}