<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Manufacturers;
class MedicinesController extends Controller
{
    public function RetrieveAll()
    {
        $medicines = Medicines::all();
        return response()->json($medicines);
       
    }

    public function manufacturers()
    {
        $manufacturers = Manufacturers::all();
        return response()->json($manufacturers);
       
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
    
        
        $medicines = Medicines::create($data);
    
       
        return response()->json($medicines, 201); 
    }
    
}
