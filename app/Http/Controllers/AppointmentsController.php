<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Manufacturers;
class AppointmentsController extends Controller
{
    public function RetrieveAll()
    {
        $appointments = Appointments::with('patients', 'encounters', 'doctors')->get();
        return response()->json($appointments);
       
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
    
        
        $appointments = Appointments::create($data);
    
       
        return response()->json($appointments, 201); 
    }
    
}
