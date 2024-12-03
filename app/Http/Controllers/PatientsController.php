<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patients;
use App\Models\Doctors;
class PatientsController extends Controller
{
    public function RetrieveAll()
    {
        $patients = Patients::with('doctor')->get();
        return response()->json($patients); 
    }

    public function searchPatient(Request $request)
    {
        $query = $request->query('queryParameter'); // Retrieve query parameter
        $patients = Patients::where('hospitalFileNumber', '=', "$query")
            ->orWhere('phoneNumber', '=', "$query")
            ->orWhere('email', '=', "$query")
            ->get();
        return response()->json($patients);
    }
    

    public function store(Request $request)
    {
        // Directly get the data from the request
        $data = $request->all();
    
        // Create a new user with the data (ensure that the fields are mass assignable in the model)
        $patients = Patients::create($data);
    
        // Return a response, typically JSON
        return response()->json([ $patients,
        ], 201); // HTTP status code 201: Created
    }
    
}
