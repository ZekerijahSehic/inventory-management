<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository
{

    protected $model;
    public function __construct(User $model){
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->fetchAll();
    }


    public function find(int $id)
    {
        return $this->findById($id);
    }


    public function createUser($request)
    {
        $data = $request->all();
        $user = $this->create($data);
        return $user->refresh();
    }


    public function updateUser(int $id, Request $request)
    {
        $user = $this->findById($id);
        $user->update($request->all());
        $role = $request->role;
        $user->syncRoles($role);
    }


    public function deleteUser(int $id)
    {
        $this->delete($id);
    }
}
