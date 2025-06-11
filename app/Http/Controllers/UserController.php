<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule; // Tambahkan ini untuk Rule::unique

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('admin.users.list-users', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user) // Laravel akan otomatis menemukan user berdasarkan ID di URL
    {
        return view('admin.users.edit-user', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'teknisi', 'user'])], // Validasi role
            // Tambahkan validasi lain jika ada kolom yang bisa diupdate
        ]);

        $user->update($request->all()); // Update semua data yang divalidasi

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Pastikan admin tidak bisa menghapus dirinya sendiri jika itu akun admin satu-satunya
        if (auth()->user()->id === $user->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}