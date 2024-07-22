<?php
namespace App\Repositories;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface
{

    public function getAll()
    {
        return Student::all();
    }
    public function getById($id)
    {
        return Student::findOrFail($id);
    }
    public function store(array $data)
    {
        return Student::create($data);
    }
    public function update($data, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($data);
        return $student;
    }
    public function delete($id)
    {
        //$student = Student::findOrFail($id);
        //$student->delete();
        //return $student;
        return Student::destroy($id);
    }
}
