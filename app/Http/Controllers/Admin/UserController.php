<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {

        $users = User::paginate(5);

        return view('admin.users.index', compact('users'));
    }


    public function show($id)
    {

        $user = User::findOrFail($id);


        return view('admin.users.view', compact('user'));
    }

    public function toggleStatus($id)
    {

        $user = User::findOrFail($id);

        $user->status = !$user->status;

        $user->save();

        return redirect()->back()->with('success', 'The status of user ' . $user->first_name . ' has been updated successfully.');
    }



}
