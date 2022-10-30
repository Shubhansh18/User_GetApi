<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


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
        if($request->has('sortBy'))
        {
           $users = $userData->sortBy($request->sortBy)->all(); 
           echo(count($users));
           return Response::json($users, 200, array(), JSON_PRETTY_PRINT);
        }
        // echo(count($userData));
        return Response::json($userData, 200, array(), JSON_PRETTY_PRINT);
    }
}