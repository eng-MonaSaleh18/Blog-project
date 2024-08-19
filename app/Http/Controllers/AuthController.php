<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function showForm(){
        return view('loginregister.showLogin');
    }
    
    public function login(Request $Request){
        $validation=$Request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt($validation)){
            $Request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors(['email' => 'Invalid validation']);
        
        
    }

    public function registerForm(){
        return view('loginregister.showRegister');
    }

    public function register(Request $Request){

        // dd($Request);
        
        $validated=$Request->validate([
            'name'=> 'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:4|confirmed',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:1024',
        ]);
        
        if ($Request->hasFile('image')) {
            $image = $Request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images') , $imageName  );
        }
        $user=User::create([
            'name' =>$Request['name'],
            'email' => $Request['email'],
            'password' =>Hash::make($Request['password']),
            'image' =>  $imageName 
        ]);
        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $Request){
        Auth::logout();
        $Request->session()->invalidate();
        $Request->session()->regenerateToken();
        return redirect('/');
    }
}
