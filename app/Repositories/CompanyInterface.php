<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

interface CompanyInterface extends RepositoryInterface
{
    public function listCompany();
    public function createCompany(array $data);
    public function updateCompany(array $data, $id);
    public function deleteCompany($id);
    public function findCompanyById($id);
}
