<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user, Request $request)
    {
        $userData = $user->where(function ($query) use ($request) {
            if($request->has('name')){
                $query->where('name','LIKE', "%{$request->name}%");
            }
            if($request->has('email')){
                $query->where('email','LIKE', "%{$request->email}%");
            }
            if($request->has('mobile')){
                $query->where('mobile','LIKE', "%{$request->mobile}%");
            }
            if($request->has('address')){
                $query->where('address','LIKE', "%{$request->address}%");
            }
        })->get();
        if($userData->isEmpty())
        {
            return response()->json([
                "message" => "No such user exists"
            ]);
        }
        return response()->json([
            $userData
        ]);
    }
}
