<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return  view("users.users")->with("users" , $users);
    }

    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $bannedUserIds = $request->input('banned_users', []);

        User::query()->update(['is_banned' => false]); 

        if (!empty($bannedUserIds)) {
            User::whereIn('id', $bannedUserIds)->update(['is_banned' => true]);
        }

        return redirect()->back()->with('success', 'Status updated successfully');
    }
    

    
}
