<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
class UsersController extends Controller
{
    public function RetrieveAll()
    {
        $users = Users::all();
        return response()->json([
            'message' => 'Users retrieved successfully',
            'users' => $users,
        ]);
       
    }

    public function store(Request $request)
    {
        // Directly get the data from the request
        $data = $request->all();
    
        // Create a new user with the data (ensure that the fields are mass assignable in the model)
        $user = Users::create($data);
    
        // Return a response, typically JSON
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201); // HTTP status code 201: Created
    }
    
}
