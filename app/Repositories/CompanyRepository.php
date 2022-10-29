<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\BaseRepository;
use App\Repositories\CompanyInterface;

class CompanyRepository extends BaseRepository implements CompanyInterface
{
    public function getModel()
    {
        
        return  Company::class;
    }
    public function listCompany(){
        return Company::get();
    }
    public function createCompany(array $data){
     $company = new Company();
        return $company->create($data);
    }
    public function updateCompany(array $data, $id){
        $company = $this->findCompanyById($id);
        return $company->update($data);
    }
    public function deleteCompany($id){
        $company = $this->findCompanyById($id);
        return $company->delete();
    }
    public function findCompanyById($id){
        $company = new Company();
        return $company->findOrFail($id);
    }
}
