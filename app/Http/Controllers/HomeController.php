<?php

namespace App\Http\Controllers;

use App\Mail\CodeSendMail;
use App\Models\Code;
use App\Models\StudentApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        if (Gate::allows('is-student', auth()->user())){
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

        }else {
            if (Gate::allows('is-teacher', auth()->user())) {
                $totalApps = StudentApplication::where('teacher_id', auth()->id())->count('id');
                $totalStudent = User::where('role_id', 1)->count('id');
                $totalRejected = StudentApplication::where('teacher_id', auth()->id())
                                                    ->where('status', 0)->count('id');
                $totalAccepted = StudentApplication::where('teacher_id', auth()->id())
                                                    ->where('status', 1)->count('id');
                return view('contents.dashboard.teacher',
                    ['totalApps' => $totalApps, 'totalStudent' => $totalStudent,
                    'totalRejected' => $totalRejected, 'totalAccepted' => $totalAccepted
                    ]
                );
            }else if (Gate::allows('is-managenent', auth()->user())) {
                $totalApps = StudentApplication::whereHas('app_role', function ($q) {
                    $q->where('user_id', auth()->id());
                })->count();
                $totalStudent = User::where('role_id', 1)->count('id');
                $totalRejected = StudentApplication::whereHas('app_role', function ($q) {
                    $q->where('user_id', auth()->id());
                })->where('status', 0)->count('id');
                $totalAccepted = StudentApplication::whereHas('app_role', function ($q) {
                    $q->where('user_id', auth()->id());
                })->where('status', 1)->count('id');
                return view('contents.dashboard.teacher',
                    ['totalApps' => $totalApps, 'totalStudent' => $totalStudent,
                    'totalRejected' => $totalRejected, 'totalAccepted' => $totalAccepted
                    ]
                );
            }else {
                $totalApps = StudentApplication::count('id');
                $totalStudent = User::where('role_id', 1)->count('id');
                $totalRejected = StudentApplication::where('status', 0)->count('id');
                $totalAccepted = StudentApplication::where('status', 1)->count('id');
                return view('contents.dashboard.teacher',
                    ['totalApps' => $totalApps, 'totalStudent' => $totalStudent,
                    'totalRejected' => $totalRejected, 'totalAccepted' => $totalAccepted
                    ]
                );
            }
        }

    }

    public function registerIndex () {
        return view('auth.register');
    }

    public function register (Request $request)
    {

        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'recaptcha'
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'phone' => $request->phone,
                'password'=> bcrypt($request->password),
                'role_id' => $request->role
            ]);
            // $details = [
            //     'code' => rand(5666, 9555),
            //     'user' =>$user
            // ];
            // Code::create(['user_id'=> $user->id, 'code' => $details['code']]);
            // Mail::to($user->email)->send(new CodeSendMail($details));
            $user_id = $user->id;
            DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return view('auth.login', compact('user_id'));
    }

    public function codeIndex() {
        return view('auth.code-to-login');
    }

    public function codeToLogin (Request $request) {
        $request->validate([
            'code' => 'required',
            'user_id' => 'required',
        ]);

        $code = Code::where('code', $request->code)->first();
        if ($code->code != $request->code) {
            return redirect()->back()->with('error', 'Invalid code');
        }

        $user = User::find($request->user_id);
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
