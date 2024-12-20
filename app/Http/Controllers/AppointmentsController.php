<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Encounters;
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


    public function createEncounterAppointment(Request $request)
    {
        // Retrieve all data from the request
        $data = $request->all();
    
        // Create a new Appointments record
        $appointment = Appointments::create($data);
    
        
        $encounter = Encounters::where('encounterId', $request->encounterId)->first();
    
        if ($encounter) {
            $encounter->update([
                'appointmentId' => $appointment->appointmentId, // Assuming id is the primary key of ContinueConsulting
            ]);
    
        }
    
        return response()->json(['encounterId' =>$encounter->encounterId], 201);// HTTP status code 201: Created
    }
    

    // Update appointment 
    public function updateAppointment(Request $request, $appointmentId)
{
    $appointment = Appointments::find($appointmentId);
    if (!$appointment) {
        return response()->json([
            'error' => 'Appointment not found',
        ], 404);
    }
    $data = $request->all();
    $appointment->update($data);
    return response()->json([
        'message' => 'Appointment updated successfully',
        'data' => $appointment,
    ], 200); 
}


// Delete appointment
    public function deleteAppointment($appointmentId){
        $appointment = Appointments::find($appointmentId);
if ($appointment) {
    $appointment->delete();
}
return response()->json($appointment, 201);
    }
}
