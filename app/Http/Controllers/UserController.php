<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // ambil semua user
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'position' => 'required|in:Admin,Manager,Staff',
            'department' => 'nullable|string|max:50',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->position = $request->position;

        if ($request->position === 'Staff') {
            $user->department = $request->department;
        } else {
            $user->department = null;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Hapus user
    // definisikan method destroy untuk menghapus user berdasarkan ID

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // hapus user permanen
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'position' => 'required|in:Admin,Manager,Staff',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->position = $request->position;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->position === 'Staff') {
            $user->department = $request->department;
        } else {
            $user->department = null;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }
}
