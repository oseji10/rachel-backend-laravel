<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encounters;
class EncountersController extends Controller
{
    public function RetrieveAll()
    {
        $encounters = Encounters::with('patients', 'consulting', 'continue_consulting')->get();
        return response()->json($encounters); 
       
    }

    public function store(Request $request)
    {
        // Retrieve all data from the request
        $data = $request->all();
    
        // Validate incoming request data (optional but recommended)
        // $validated = $request->validate([
        //     'patientId' => 'required|integer', // Example fields, adjust based on your schema
        //     'details' => 'nullable|string',    // Example field for consulting
        // ]);
    
        // Create a new consulting record
        $consulting = Consulting::create($data);
    
        // Create a new encounter record and link the consultingId
        $encounter = Encounters::create([
            'patientId' => $validated['patientId'],
            'consultingId' => $consulting->consultingId, // Link the consultingId
        ]);
    
        // Update the consulting record with the encounterId
        $consulting->update([
            'encounterId' => $encounter->encounterId, // Link the encounterId
        ]);
    
        // Return the newly created encounter and consulting as JSON response
        return response()->json([
            'message' => 'Encounter and Consulting records created and linked successfully.',
            'encounter' => $encounter,
            'consulting' => $consulting,
        ], 201); // HTTP status code 201: Created
    }
    
    
}
