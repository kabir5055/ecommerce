<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function manageUser()
    {
        return view('admin.user.manage-user',[
            'users' => User::all(),
        ]);
    }
    public function editUser($id)
    {
        $user = User::find($id);

        return view('admin.user.edit-user',[
            'user' => $user,
        ]);
    }
    public function updateUser(Request $request)
    {
        $user = User::find($request->user_id);

        $user->name = $request->name;
        $user->email = $request->email;
        if (Auth::user()->id == $user->id)
        {
            if ($request->password != null)
            {
                $user->password = $request->password;
            }
            else
            {
                $request->password = $user->password;
                $user->password = $request->password;
            }

        }
        else
        {
            $request->password = $user->password;
            $user->password = $request->password;
        }
        $user->save();
        return redirect(route('manage.user'));
    }
    public function deleteUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->delete();
        return back();
    }
}
