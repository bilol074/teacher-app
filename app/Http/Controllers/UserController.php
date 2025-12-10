<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        User::query()->updateOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'password' => Hash::make($request->password)]
        );

        return redirect()->route('users.index')
            ->with('success', 'User successfully created!');

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
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Agar yangi parol kiritilgan bo‘lsa — hash qilib saqlaymiz
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // 🔄 Eski rollarni o‘chirib, faqat yangi rolni qoldirish
        if ($request->filled('role')) {
            $user->syncRoles([$request->role]);
        } else {
            // Agar hech qanday rol tanlanmagan bo‘lsa, barcha rollarni olib tashlash
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User successfully deleted!');
    }

}
