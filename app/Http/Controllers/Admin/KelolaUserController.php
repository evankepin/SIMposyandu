<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AkunUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaUserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;
        $users = AkunUser::where('role', '!=', 'admin')
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('name', 'like', "%$keyword%")
                             ->orWhere('email', 'like', "%$keyword%")
                             ->orWhere('nomor_wa', 'like', "%$keyword%")
                             ->orWhere('alamat', 'like', "%$keyword%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.kelolauser', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'role'      => 'required|in:kader,orangtua',
            'nomor_wa'  => 'nullable|string|max:20',
            'alamat'    => 'nullable|string|max:255',
            'password'  => 'required|string|min:6',
        ]);

        AkunUser::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'nomor_wa'  => $request->nomor_wa,
            'alamat'    => $request->alamat,
            'password'  => Hash::make($request->password),
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = AkunUser::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|in:kader,orangtua',
            'nomor_wa'  => 'nullable|string|max:20',
            'alamat'    => 'nullable|string|max:255',
            'password'  => 'nullable|string|min:6',
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'nomor_wa'  => $request->nomor_wa,
            'alamat'    => $request->alamat,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = AkunUser::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }
}
