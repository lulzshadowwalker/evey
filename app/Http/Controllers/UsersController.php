<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(User::with('roles')->get());
        }

        return view('dashboard.users', ['users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regCon = new RegisterController();

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'regex:/^0[7][789][0-9]{7}$/'],
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('images', 'public');
        }

        event(new Registered($user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'avatar' => data_get($data, 'avatar'),
        ])));

        $user->roles()->attach(Role::USER);

        if ($request->hasFile('documents')) {
            foreach ($data['documents'] as $doc) {
                $path = $doc->store('documents', 'public');
                $title = $doc->getClientOriginalName();
                DocumentsController::add($user, $title, $path);
            }
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('images', 'public');
        }


        if ($request->hasFile('documents')) {
            foreach ($data['documents'] as $doc) {
                $path = $doc->store('documents', 'public');
                $title = $doc->getClientOriginalName();
                DocumentsController::add($user, $title, $path);
            }
        }

        $data = array_filter($data, function ($value) {
            return $value !== null && $value !== '';
        });

        $user->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect()->back();
    }

    public function show($id)
    {
        $user = User::with('roles')->find($id);
        return $user ? response()->json($user) : response()->json(['message', 'user not found'], 404);
    }
}
