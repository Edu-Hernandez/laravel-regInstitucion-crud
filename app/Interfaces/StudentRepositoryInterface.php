<?php
namespace App\Interfaces;

interface StudentRepositoryInterface
{
    //traer a los metodos
    public function getAll(); //consultar o mostrar los datos
    public function getById($id); //consultar un student
    public function store(array $data); //agregar, de almacenar toda la data
    public function update($data, $id); //cambio de posicion
    public function delete($id);
}