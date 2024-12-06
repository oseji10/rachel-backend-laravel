<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
class MedicinesController extends Controller
{
    public function RetrieveAll()
    {
        $medicines = Medicines::all();
        return response()->json($medicines);
       
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
    
        
        $medicines = Medicines::create($data);
    
       
        return response()->json($medicines, 201); 
    }
    
}
