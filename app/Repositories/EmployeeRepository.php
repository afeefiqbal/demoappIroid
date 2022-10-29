<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Repositories\EmployeeInterface;

class EmployeeRepository extends BaseRepository implements EmployeeInterface
{
    public function getModel()
    {
        
        return  Employee::class;
    }
    public function listEmployee(){
        return Employee::get();
    }
    public function createEmployee(array $data){
     $Employee = new Employee();
        return $Employee->create($data);
    }
    public function updateEmployee(array $data, $id){
        $Employee = $this->findEmployeeById($id);
        return $Employee->update($data);
    }
    public function deleteEmployee($id){
        $Employee = $this->findEmployeeById($id);
        return $Employee->delete();
    }
    public function findEmployeeById($id){
        $Employee = new Employee();
        return $Employee->findOrFail($id);
    }
}
