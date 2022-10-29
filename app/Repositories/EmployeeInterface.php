<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

interface EmployeeInterface extends RepositoryInterface
{
    public function listEmployee();
    public function createEmployee(array $data);
    public function updateEmployee(array $data, $id);
    public function deleteEmployee($id);
    public function findEmployeeById($id);

}
