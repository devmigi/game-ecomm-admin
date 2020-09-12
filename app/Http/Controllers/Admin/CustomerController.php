<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display all Users
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $users = User::get();

        return view('admin.customers.all', ['users' => $users]);
    }

}
