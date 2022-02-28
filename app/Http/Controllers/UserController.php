<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Student};
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-show', ['only' => ['editUser']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $users = User::latest()->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('role', function(User $user) {
                    foreach ($user->getRoleNames() as $role) {
                        return '<button class="btn btn-sm btn-primary">' . $role . '</button>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn =
                        '<div class="d-flex justify-content-between">

                            <a href="javascript:void(0)" data-id="' . $row->id . '" id="user_details" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>


                           <a href=" ' . route('users.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>


                           <form action=" ' . route('users.destroy', $row->id) . '" method="POST">
                               <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah yakin ingin menghapus ini?\')"><i class="fas fa-trash"></i></button>
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                           </form>
                        </div>';

                    return $btn;
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }

        return view('users.index', [
            'title' => 'Pengguna'
        ]);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

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

    public function editUser(User $user)
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

    // public function resetPassword(User $user)
    // {
    //     $user->update([
    //         'password' => $user->student->nisn
    //     ]);
    // }

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
        toast('Data pengguna berhasil dihapus!','success');
        return back()->with('succes', 'Pengguna berhasil dihapus');
    }

}
