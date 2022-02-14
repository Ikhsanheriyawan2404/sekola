<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('Superadmin') || $user->hasRole('Operator') ) {
            Alert::success('Selamat', 'Kamu berhasil login');
            return redirect()->route('admin.dashboard');
        } else if ($user->hasRole('Guru')) {
            Alert::success('Selamat', 'Kamu berhasil login');
            return redirect()->route('teacher.dashboard', $user->teacher->id);
        } else if ($user->hasRole('Siswa')) {
            Alert::success('Selamat', 'Kamu berhasil login');
            return redirect()->route('student.dashboard', $user->student->id);
        }
    }

    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Halaman Login'
        ]);
    }


}
