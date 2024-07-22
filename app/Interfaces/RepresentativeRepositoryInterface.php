<?php
namespace App\Interfaces;

//esta clase contiene la firma de metodos que cualquier clase interfaz debe proporcionar
interface RepresentativeRepositoryInterface{
    //definicion de los metodos 

    public function getAll(); //recupera todos los registros de profesores almacenados 
    public function getById($id); //recupera solo un profesor expecifico con el id
    public function store(array $data); //crea registros
    public function update($data, $id); //actualizar
    public function delete($id);
}