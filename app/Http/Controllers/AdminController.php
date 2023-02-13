<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class AdminController extends Controller
{
    const DEFAULT_ROLE = 'user';

    public function __construct(private UserRepository $userRepository, private RoleRepository $roleRepository)
    { }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(AddUserRequest $request)
    {
        $user = $this->userRepository->createUser($request);
        $role = $this->roleRepository->findByName(self::DEFAULT_ROLE);
        $user->assignRole($role);
        return redirect('/admin/users')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {

        $this->userRepository->updateUser($id, $request);
        return redirect('/admin/users')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect('/admin/users')->with('success', 'User deleted successfully');
    }
}
