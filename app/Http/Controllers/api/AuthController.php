<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6|confirmed',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:1024',
        ]);
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images') , $imageName  );
        }
        $user=User::create([
            'name' =>$request['name'],
            'email' => $request['email'],
            'password' =>Hash::make($request['password']),
            'image' =>  $imageName 
        ]);
        return response()->json([
            "message" => "user created" 
        ] , 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $data=$request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:6|confirmed',
        ]);
        $user = User::where('email' , $data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password )){
            return response()->json([
                "message" => "Error in your email or password"
            ] , 401);
        }
        $token = $user->createToken($user->name . "-authToken")->plainTextToken;
        return response()->json([
            "token" => $token
        ] , 200);
    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "message" => "logged out"
        ]);
    }

    
}
