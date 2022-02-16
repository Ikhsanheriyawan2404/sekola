<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['show']]);
        $this->middleware('permission:user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('users.index', [
            'users' => User::all(),
            'breadcrumbs' => ['User', 'Tambah Pengguna'],
            'title' => 'Pengguna'
        ]);
    }

    // public function show(User $user)
    // {
    //     return response()->json($user);
    // }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', [
            'title' => 'Tambah',
            'roles' => $roles,
        ]);

    }

    protected function store(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'],),
            'address' => $request['address'],
        ]);

        $user->assignRole($request['roles']);
        toast('Data pengguna berhasil dibuat!','success');
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return view('users.show', [
                'title' => 'Profil saya',
                'user' => $user,
                'student' => Student::where('id', $user->id),
            ]);
        } else {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }

    public function editPassword(User $user)
    {
        request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make(request('password')),
        ]);

        toast('Password user berhasil diubah!', 'success');
        return redirect()->back();
    }

    public function edit(User $user)
    {
        return view('users.edit',[
            'title' => 'Edit Pengguna',
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(User $user)
    {
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'roles' => 'required'
        ]);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'address' => request('address'),
        ]);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole(request('roles'));
        toast('Data pelanggan berhasil diubah!','success');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        toast('Data barang berhasil dihapus!','success');
        return back()->with('succes', 'Pengguna berhasil dihapus');
    }

}
