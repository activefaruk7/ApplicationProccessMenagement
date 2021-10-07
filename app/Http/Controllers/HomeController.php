<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        return view('contents.dashboard.index');
    }

    public function login(Request $request){
        if( Auth::user()== Auth::user()){

            return redirect()->route('home');
        }else{
            return redirect()->route('login');
        }
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
            'password'=> $request->password
        ]);

       // auth()->login($user);
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}
