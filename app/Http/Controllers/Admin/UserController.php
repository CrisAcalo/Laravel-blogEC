<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // name, email, password, password_confirmation
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $data['password'] = bcrypt($data['password']);

            User::create($data);

            return redirect()->route('admin.users.index')->with('success', 'Usuario creado con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al crear el usuario: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        try {
            User::findOrFail($id)->update($data);

            return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar el usuario: ' . $th->getMessage());
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        // password, password_confirmation, old_password

        $data = $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!\Hash::check($data['old_password'], $user->password)) {
            return redirect()->back()->with('error', 'La contraseña actual no coincide');
        }

        try {
            $user->update([
                'password' => bcrypt($data['password']),
            ]);

            return redirect()->route('admin.users.index')->with('success', 'Contraseña actualizada con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar la contraseña: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $posts = $user->posts;

            if($posts->count() > 0) {
                return redirect()->back()->with('error', 'No se puede eliminar el usuario, tiene posts asociados');
            }

            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al eliminar el usuario: ' . $th->getMessage());
        }
    }
}
