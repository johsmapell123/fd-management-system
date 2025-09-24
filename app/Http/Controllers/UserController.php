<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        return view('users.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'department' => 'required|in:Production,QC,Warehouse,Admin',
            'position' => 'required|in:Staff,Manager,Admin',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function show(User $user)
    {
        if (Auth::user()->position !== 'Admin' && Auth::user()->id !== $user->id) {
            return redirect()->back()->with('error', 'Access denied.');
        }
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'department' => 'required|in:Production,QC,Warehouse,Admin',
            'position' => 'required|in:Staff,Manager,Admin',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->position !== 'Admin') {
            return redirect()->back()->with('error', 'Access denied.');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
