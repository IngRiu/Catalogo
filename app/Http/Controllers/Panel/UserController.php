<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // dd(User::all());
        return view('Users.index')->with([
            'users'=>User::all(),
        ]);
    }

    public function toggleAdmin(User $user)
    {
        if ($user->isAdmin()) {
            $user->admin_since = null;
        }else{
            $user->admin_since = now();
        }
        $user->save();
        return redirect()
            ->route('users.index')
            ->withSuccess("Admin status for user {$user->id} was toggled.");
    }
}
