<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {

        // $users = User::paginate(5);

        return view('admin.dashboard.index');
    }





}
