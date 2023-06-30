<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.role-management', ['roles' => Role::all()]);
    }

    public function settings()
    {
        return view('dashboard.settings');
    }

    public function signals()
    {
        return view('dashboard.signals');
    }

    public function roleManagement()
    {
        return view('dashboard.role-management', ['roles' => Role::all()]);
    }

    public function users()
    {
        return view('dashboard.users', ['users' => User::all()]);
    }

    public function inbox()
    {
        return view('dashboard.inbox');
    }


    // TODO: refactor each into their sep controller
    public function update(Request $request, $id)
    {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        $data = array_filter($data, function ($value) {
            return strlen($value) !== 0;
        });

        User::whereId($id)->update($data);

        return redirect()->route('dashboard.users');
    }

    public function delete($id)
    {
        // if (Auth::user()->id == $id) {
        //     return redirect()->route('dashboard.users');
        // }

        // User::destroy($id);

        $u = User::find(2);

        $u->delete();

        return redirect()->route('dashboard.users');
    }
}
