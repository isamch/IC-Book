<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService as AdminUserService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(AdminUserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        return view('admin.users.view', compact('user'));
    }

    public function toggleStatus($id)
    {
        $user = $this->userService->toggleStatus($id);

        return redirect()->back()->with('success', 'The status of user ' . $user->first_name . ' has been updated successfully.');
    }
}
