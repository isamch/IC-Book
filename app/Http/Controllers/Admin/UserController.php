<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny');

        $users = User::paginate(5);

        return view('admin.users.index', compact('users'));
    }



    public function toggleStatus($id)
    {
        $this->authorize('toggle');

        $user = User::findOrFail($id);

        $user->status = !$user->status;

        $user->save();

        return redirect()->back()->with('success', 'The status of user ' . $user->first_name . ' has been updated successfully.');
    }



}
