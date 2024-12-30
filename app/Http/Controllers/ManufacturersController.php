<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Manufacturers;
class ManufacturersController extends Controller
{
   

    public function RetrieveAll()
    {
        $manufacturers = Manufacturers::all();
        return response()->json($manufacturers);
       
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
    
        
        $manufacturers = Manufacturers::create($data);
    
       
        return response()->json($manufacturers, 201); 
    }
    
}
