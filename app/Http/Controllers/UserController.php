<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\service\MyPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class UserController extends Controller
{
    public function index(User $user, Request $request)
    {
        $orderBy = $request->has('order')? $request->order: "ASC";
        $userData = $user::where(function ($q) use($request){
            $q->where('name','LIKE', "%{$request->name}%");
            $q->where('email','LIKE', "%{$request->email}%");
            $q->where('mobile','LIKE', "%{$request->mobile}%");
            $q->where('address','LIKE', "%{$request->address}%");
        })
        ->orderBy($request->has('sortBy')? $request->sortBy: 'id', $orderBy)->get();
        
        $collection = new MyPagination($userData);
        if($userData->isEmpty())
        {
            return response()->json([
                "message" => "No such user exists"
            ]);
        }
        else{
            $page = count($userData) < 100 ? 25 : 100;
            $paginatedPage = $collection->paginate($page);
            return Response::json($paginatedPage, 200, array(), JSON_PRETTY_PRINT);
        }
    }
}