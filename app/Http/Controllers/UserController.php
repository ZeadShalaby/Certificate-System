<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\Verifymail;
use App\Events\verifyEvent;
use App\Traits\CertficateTrait;
use Illuminate\Support\Str;
use App\Http\Requests\RequestLogin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RequestRegister;

class UserController extends Controller
{

    use CertficateTrait;
    // ?todo login page
    function loginIndex()
    {
        return view('Auth.login');
    }

    // ?todo Register page
    function registerIndex()
    {
        return view('Auth.register');
    }

    // ?todo verify Email
    public function verfiy(User $user)
    {
        try {
            event(new verifyEvent($user));
            Auth::login($user);
            return redirect()->route('excel.index');

        } catch (\Exception $ex) {
            return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
        }
    }


    // ?todo Login Users
    public function login(RequestLogin $request)
    {
        try {
            $user = User::where('name', $request->name)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('excel.index');
            } else {
                return back()->withInput()->withErrors(['password' => 'Invalid credentials']);
            }
        } catch (\Exception $ex) {
            return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    // public function login(RequestLogin $request)
    // {
    //     try {
    //         if (Auth::attempt($request->only('email', 'password'))) {
    //             return redirect()->route('excel.index');
    //         } else {
    //             return back()->withInput()->withErrors(['password' => 'Invalid credentials']);
    //         }
    //     } catch (\Exception $ex) {
    //         return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
    //     }

    // }


    // ? register
    public function register(RequestRegister $request)
    {
        //? Extract the name from the email using regex
        preg_match('/^[^@]+/', $request->email, $matches);
        $nameFromEmail = $matches[0];
        $uniqueName = Str::slug($nameFromEmail) . '_' . strtoupper(Str::random(3));
        $request['name'] = $uniqueName;
        $user = User::create($request->all());
        // ?todo Send mail -> user to verify it
        Mail::to('zeadshalaby1@gmail.com')->send(new Verifymail($user));
        $this->successNotification('Please check your email to verify your account');
        return redirect()->route('excel.index');
    }

    // ?todo logout in account
    function logout()
    {
        Auth::logout();
        return redirect()->route('loginindex');
    }


}
