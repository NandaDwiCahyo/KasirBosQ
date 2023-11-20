<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $users = User::where('is_admin', '==', '0')->get();
        return view('user', compact('users'));
    }

    function destroy(string $name)
    {
        $user = User::find($name);

        $user->delete();

        return redirect('/user');
    }
}
