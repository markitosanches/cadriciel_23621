<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100|exists:users',
            'password'=> 'min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)):
            return redirect()->back()->withErrors(trans('auth.password'))->withInput();
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        return redirect()->intended(route('task.index'))->withSuccess('Signed in');
    }



    public function destroy()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    
     public function forgot(){
        return view('user.forgot');
    }

    public function email(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $user = User::where('email', $request->email)->first();
        $userId = $user->id;
        $tempPassword = str::random(45);
        $user->temp_password = $tempPassword;
        $user->save();

        // $user->update([
        //     "temp_password" => $tempPassword
        // ]);

        $to_name = $user->name;
        $to_email = $user->email;
        $body  = "<a href='".route('auth.reset', [$userId, $tempPassword])."'>Reset Password</a>";

        Mail::send('user.email', ['name' => $to_name, 'body' => $body],
        function($message) use ($to_email){
            $message->to($to_email)->subject('Reset Password');
        });

        return redirect(route('login'))->withSuccess('Please check your email!');
    }

    public function reset(User $user, $token){
        if($user->temp_password === $token){
            return view('user.reset');
        }
        return redirect(route('auth.forgot'))->withErrors(trans('auth.failed'));
    }

    public function resetUpdate(User $user, $token, Request $request){
            if($user->temp_password === $token){
                $request->validate([
                    "password" => 'required|min:6|confirmed'
                ]);
                $user->password = Hash::make($request->password);
                $user->temp_password = NULL;
                $user->save();
                return redirect(route('login'))->withSuccess('Password changed!');
        }
        return redirect(route('auth.forgot'))->withErrors(trans('auth.failed'));
    }
}
