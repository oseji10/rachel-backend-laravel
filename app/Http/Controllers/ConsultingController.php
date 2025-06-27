<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulting;
use App\Models\ContinueConsulting;
use App\Models\Encounters;
class ConsultingController extends Controller
{
    public function RetrieveAll()
    {
        $consulting = Consulting::with('encounters', 'patients')->get();
        return response()->json($consulting); 
       
    }

    public function store(Request $request)
    {
        // Retrieve all data from the request
        $data = $request->all();
    
    
        // Create a new consulting record
        $consulting = Consulting::create($data);
        $continue_consulting = ContinueConsulting::create($data);
    
        // $encounter = Encounters::create([
        //     'patientId' => $request->patientId,
        //     'continueConsultingId' => $continue_consulting->continueConsultingId, // Link the consultingId
        // ]);
        // Create a new encounter record and link the consultingId
       
        $encounter = Encounters::where('encounterId', $request->encounterId)->first();
    
        // if ($encounter) {
        //     // Update the Encounter with the continueConsultingId
        //     $encounter->update([
        //         'consultingId' => $consulting->consultingId, // Assuming id is the primary key of ContinueConsulting
        //     ]);
    
        // }
    
        // Return the newly created encounter and consulting as JSON response
        return response()->json([
            // 'encounterId' =>$encounter->encounterId
            'message' => 'Consulting created successfully',
            'consulting' => $consulting,
        ], 201);// HTTP status code 201: Created
    }
    
}
