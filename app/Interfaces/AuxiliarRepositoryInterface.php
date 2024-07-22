<?php
namespace App\Interfaces;

interface AuxiliarRepositoryInterface{

    public function getAll(); //recupera datos completos
    public function getById($id); //recupera un registro especifico
    public function store(array $data); //insertar registros
    public function update($data, $id); //actualizar registro
    public function delete($id); //eliminar un registro
}