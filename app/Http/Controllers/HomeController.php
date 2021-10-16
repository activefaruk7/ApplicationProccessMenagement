<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index()
    {
        if (Gate::allows('is-teacher', auth()->user())){
            $totalApps = StudentApplication::where('teacher_id', auth()->id())->count('id');
            $totalStudent = User::where('role', 'student')->count('id');
            $totalRejected = StudentApplication::where('teacher_id', auth()->id())
                                                ->where('status', 0)->count('id');
            $totalAccepted = StudentApplication::where('teacher_id', auth()->id())
                                                 ->where('status', 1)->count('id');
            return view('contents.dashboard.teacher',
                ['totalApps' => $totalApps, 'totalStudent' => $totalStudent,
                 'totalRejected' => $totalRejected, 'totalAccepted' => $totalAccepted
                ]
            );
        }else {
            $totalApps = StudentApplication::where('user_id', auth()->id())
                                             ->count('id');
            $totalRejected = StudentApplication::where('user_id', auth()->id())
                                             ->where('status', 0)->count('id');
            $totalAccepted = StudentApplication::where('user_id', auth()->id())
                                              ->where('status', 1)->count('id');
            $totalPanding = StudentApplication::where('user_id', auth()->id())
                                              ->where('status', 2)->count('id');
            return view('contents.dashboard.student',
                ['totalApps' => $totalApps, 'totalPanding' => $totalPanding,
                 'totalRejected' => $totalRejected, 'totalAccepted' => $totalAccepted
                    ]
        );

        }

    }

    public function registerIndex () {
        return view('auth.register');
    }

    public function register (Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role' => $request->role
        ]);

       auth()->login($user);
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}
