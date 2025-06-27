<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Encounters;
use App\Models\Manufacturers;
use App\Models\Patients;
use App\Mail\AppointmentEmail;
use App\Mail\DoctorAppointmentEmail;
use App\Models\Doctors;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendSMSJob;

class AppointmentsController extends Controller
{

       
private function sendSMS($patientPhone, $smsMessage)
{
    $apiKey = env('SMSLIVEapiKey');
    $url = env('SMSLIVEurl');

    // Convert phone number to international format
    if (substr($patientPhone, 0, 1) === "0") {
        $patientPhone = "+234" . substr($patientPhone, 1);
    }
    Log::info("Phone number2: " . $patientPhone);
    try {
        $client = new Client([
            'verify' => false,
        ]);
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'mobileNumber' => $patientPhone,
                'messageText' => $smsMessage,
                'senderID' => env('SMSLIVESenderID'), // Replace with sender name (if required)
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;

    } catch (\Exception $e) {
        Log::error("SMS sending failed: " . $e->getMessage());
        return false;
    }
}

    public function RetrieveAll()
    {
        $appointments = Appointments::with('patients', 'encounters', 'doctors')
        ->orderBy('created_at', 'desc')
        ->get();
        return response()->json($appointments);
       
    }

    public function store(Request $request)
{
    $data = $request->all();

    // Create an appointment
    $appointments = Appointments::create($data);

    // Fetch patient details
    $patient = Patients::where('patientId', $appointments->patientId)->first();
    $patientEmail = $patient->email ?? null;
    $patientPhone = $patient->phoneNumber;
    $patientName = $patient->firstName . ' ' . $patient->lastName;
    $appointmentDate = $appointments->appointmentDate;
    $appointmentTime = $appointments->appointmentTime;

    // Fetch doctor details
    $doctor = Doctors::where('doctorId', $request->doctor)->first();
    $doctorEmail = $doctor->doctors->email ?? null;
    $doctorName = $doctor->doctorName;

    $messages = [];

    // Send email to patient if email exists
    if ($patientEmail) {
        Mail::to($patientEmail)->send(new AppointmentEmail($patientEmail, $patientName, $appointmentDate, $appointmentTime, $doctorName));
    } else {
        $messages[] = "Patient email is missing, email was not sent.";
    }

    // Send email to doctor if email exists
    if ($doctorEmail) {
        Mail::to($doctorEmail)->send(new DoctorAppointmentEmail($doctorEmail, $patientName, $appointmentDate, $appointmentTime, $doctorName));
    } else {
        $messages[] = "Doctor email is missing, email was not sent.";
    }

    if ($patientPhone){
        $smsMessage = "Hello $patientName, your appointment with Dr. $doctorName is scheduled for $appointmentDate at $appointmentTime. Please arrive 15 minutes early. Thank you!";
        // Queue::push(new SendSMSJob($patientPhone, $smsMessage));
        $job = new SendSMSJob($patientPhone, $smsMessage);
        $job->handle();

    }

    return response()->json([
        'appointment' => $appointments,
        'messages' => $messages,
    ], 201);
}



    public function createEncounterAppointment(Request $request)
    {
        // Retrieve all data from the request
        $data = $request->all();
        $appointment = Appointments::create($data);
        $encounter = Encounters::where('encounterId', $request->encounterId)->first();
    
        if ($encounter) {
            $encounter->update([
                'appointmentId' => $appointment->appointmentId, // Assuming id is the primary key of ContinueConsulting
            ]);
            
            $patient = Patient::where('patientId', $encounter->patientId)->first();
            $patientEmail = $patient->email;
            $patientName = $patient->firstname . ' ' . $patient->lastname;
            $appointmentDate = $appointment->appointmentDate;
            $appointmentTime = $appointment->appointmentTime;

            $doctor = Doctors::where('doctorId', $appointment->doctor)->first();
            $doctorName = $doctor->doctorName;
            Mail::to($patientEmail)->send(new AppointmentEmail($patientEmail, $patientName, $appointmentDate, $appointmentTime, $doctorName)); 

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
