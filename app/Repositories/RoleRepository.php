<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;


class RoleRepository extends BaseRepository
{

    protected $model;
    public function __construct(Role $model){
        parent::__construct($model);
    }

    
    public function getAll()
    {
        return $this->fetchAll();
    }


    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
