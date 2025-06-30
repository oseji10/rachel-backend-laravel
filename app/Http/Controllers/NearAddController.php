<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NearAdd;
class NearAddController extends Controller
{
    public function retrieveAll()
    {
        $near_add = NearAdd::all();
        return response()->json($near_add);
       
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            '*.name' => 'required|string|max:255', 
        ]);
    
        
        $near_add = [];
        foreach ($validated as $data) {
            $near_add[] = NearAdd::create($data);
        }
    
        return response()->json($near_add, 201);
    }
    
    
}
