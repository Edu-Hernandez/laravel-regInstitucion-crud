<?php
namespace App\Interfaces;

interface DirectorRepositoryInterface{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update($data, $id);
    public function delete($id);
}