<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encounters;
use App\Models\VisualAcuityFar;
use App\Models\Patients;
use DB;
use App\Models\Consulting;
use App\Models\ContinueConsulting;
use App\Models\Refraction;
use App\Models\Diagnosis;
use App\Models\Investigation;
use App\Models\Findings;

class EncountersController extends Controller
{
//     public function RetrieveAll()
//     {
//         // $encounters = Encounters::with('patients', 'continue_consulting', 'consulting.visualAcuityFarPresentingRight', 'consulting.visualAcuityFarPresentingLeft')->get();
//         $encounters = Encounters::select(
//             'patients.patientId',
//             'patients.firstName',
//             'patients.lastName',
//             'patients.gender',
//             'patients.bloodGroup',
//             'patients.occupation',
//             'encounters.encounterId',
//             'encounters.created_at',
//             'encounters.status',
            
//             'visual_acuity_far_right.name as visualAcuityFarPresentingRight', 
//             'visual_acuity_far_left.name as visualAcuityFarPresentingLeft',  
//             'visual_acuity_far__pinhole_right.name as visualAcuityFarPinholeRight',  
//             'visual_acuity_far__pinhole_left.name as visualAcuityFarPinholeLeft',  
//             'visual_acuity_far_best_corrected_right.name as visualAcuityFarBestCorrectedRight',  
//             'visual_acuity_far_best_corrected_left.name as visualAcuityFarBestCorrectedLeft',  
//             'visual_acuity_near_right.name as visualAcuityNearRight', 
//             'visual_acuity_near_left.name as visualAcuityNearLeft', 
            
//             'continue_consulting.intraOccularPressureRight',
//             'continue_consulting.intraOccularPressureLeft',
//             'continue_consulting.otherComplaintsRight',
//             'continue_consulting.otherComplaintsLeft',
//             'continue_consulting.detailedHistoryRight',
//             'continue_consulting.detailedHistoryLeft',
//             'continue_consulting.findingsRight',
//             'continue_consulting.findingsLeft',
//             'continue_consulting.eyelidRight',
//             'continue_consulting.eyelidLeft',
//             'continue_consulting.conjunctivaRight',
//             'continue_consulting.conjunctivaLeft',
//             'continue_consulting.corneaRight',
//             'continue_consulting.corneaLeft',
//             'continue_consulting.ACRight',
//             'continue_consulting.ACLeft',
//             'continue_consulting.irisRight',
//             'continue_consulting.irisLeft',
//             'continue_consulting.pupilRight',
//             'continue_consulting.pupilLeft',
//             'continue_consulting.lensRight',
//             'continue_consulting.lensLeft',
//             'continue_consulting.vitreousRight',
//             'continue_consulting.vitreousLeft',
//             'continue_consulting.retinaRight',
//             'continue_consulting.retinaLeft',
//             'continue_consulting.otherFindingsRight',
//             'continue_consulting.otherFindingsLeft',
//             'chief_complaint_right.name as chiefComplaintRight', 
//             'chief_complaint_left.name as chiefComplaintLeft', 
            
//             'refractions.nearAddRight', 
//             'refractions.nearAddLeft',  
//             'refractions.OCTRight',  
//             'refractions.OCTLeft',  
//             'refractions.FFARight',  
//             'refractions.FFALeft',  
//             'refractions.fundusPhotographyRight', 
//             'refractions.fundusPhotographyLeft', 
//             'refractions.pachymetryRight', 
//             'refractions.pachymetryLeft',  
//             'refractions.CUFTRight',  
//             'refractions.CUFTLeft',  
//             'refractions.CUFTKineticRight',  
//             'refractions.CUFTKineticLeft',  
//             'refractions.pupilRight as pupilDistanceRight', 
//             'refractions.pupilLeft as pupilDistanceLeft',
//             'refractions.refractionSphereRight', 
//             'refractions.refractionSphereLeft',  
//             'refractions.refractionCylinderRight',  
//             'refractions.refractionCylinderLeft',  
//             'refractions.refractionAxisRight',  
//             'refractions.refractionAxisLeft',  
//             'refractions.refractionPrismRight', 
//             'refractions.refractionPrismLeft',

//             'diagnosis_right.name as diagnosisRight', 
//             'diagnosis_left.name as diagnosisLeft',
            
//             'investigations.investigationsRequired',  
//             'investigations.externalInvestigationRequired', 
//             'investigations.investigationsDone',
//             'investigations.HBP', 
//             'investigations.diabetes',  
//             'investigations.pregnancy',  
//             'investigations.drugAllergy',  
//             'investigations.currentMedication',  
//             'uploaded_document_url.fileUrl as documentId',

//             'treatment.treatmentType',  
//             'treatment.dosage', 
//             'treatment.doseDuration',
//             'treatment.doseInterval', 
//             'treatment.time',  
//             'treatment.comment',  
//             'treatment.lensType',  
//             'treatment.costOfLens',
//             'treatment.costOfFrame'
         
//         )
//         ->leftjoin('patients', 'patients.patientId', '=', 'encounters.patientId')
//         ->leftjoin('consulting', 'consulting.consultingId', '=', 'encounters.consultingId')
//         ->leftjoin('continue_consulting', 'continue_consulting.continueConsultingId', '=', 'encounters.continueConsultingId')
//         ->leftjoin('refractions', 'refractions.refractionId', '=', 'encounters.refractionId')
//         ->leftjoin('diagnosis', 'diagnosis.diagnosisId', '=', 'encounters.diagnosisId')
//         ->leftjoin('investigations', 'investigations.investigationId', '=', 'encounters.investigationId')
//         ->leftjoin('treatment', 'treatment.treatmentId', '=', 'encounters.treatmentId')

//         ->leftJoin('visual_acuity_far as visual_acuity_far_right', 'visual_acuity_far_right.id', '=', 'consulting.visualAcuityFarPresentingRight')
//         ->leftJoin('visual_acuity_far as visual_acuity_far_left', 'visual_acuity_far_left.id', '=', 'consulting.visualAcuityFarPresentingLeft')
//         ->leftJoin('visual_acuity_far as visual_acuity_far__pinhole_right', 'visual_acuity_far__pinhole_right.id', '=', 'consulting.visualAcuityFarPinholeRight')
//         ->leftJoin('visual_acuity_far as visual_acuity_far__pinhole_left', 'visual_acuity_far__pinhole_left.id', '=', 'consulting.visualAcuityFarPinholeLeft')
//         ->leftJoin('visual_acuity_far as visual_acuity_far_best_corrected_right', 'visual_acuity_far_best_corrected_right.id', '=', 'consulting.visualAcuityFarBestCorrectedRight')
//         ->leftJoin('visual_acuity_far as visual_acuity_far_best_corrected_left', 'visual_acuity_far_best_corrected_left.id', '=', 'consulting.visualAcuityFarBestCorrectedLeft')
//         ->leftJoin('visual_acuity_near as visual_acuity_near_right', 'visual_acuity_near_right.id', '=', 'consulting.visualAcuityNearRight')
//         ->leftJoin('visual_acuity_near as visual_acuity_near_left', 'visual_acuity_near_left.id', '=', 'consulting.visualAcuityNearLeft')
        
//         ->leftJoin('chief_complaint as chief_complaint_right', 'chief_complaint_right.id', '=', 'continue_consulting.chiefComplaintRight')
//         ->leftJoin('chief_complaint as chief_complaint_left', 'chief_complaint_left.id', '=', 'continue_consulting.chiefComplaintLeft')
//         ->leftJoin('document_upload as uploaded_document_url', 'uploaded_document_url.documentId', '=', 'investigations.documentId')

        
// ->leftJoin('diagnosis_list as diagnosis_right', 'diagnosis_right.id', '=', 'diagnosis.diagnosisRight')
// ->leftJoin('diagnosis_list as diagnosis_left', 'diagnosis_left.id', '=', 'diagnosis.diagnosisLeft')
     

//         ->get();
        
//         return response()->json($encounters); 
       
//     }


     public function RetrieveAll()
     {
                    // $encounters = Encounters::query()
                    // // select('user_course_informations.course_id', 'user_course_informations.title')
                    // ->join('consulting', 'consulting.consultingId', '=', 'encounters.consultingId')
                    // // ->where('user_courses.user_id', '=', Auth::guard('web')->user()->id)
                    // // ->where('user_courses.website_id', '=', $this->userBs->id)
                    // ->get();
                   
                    //  $encounters = Patients::where('patientId', '=', '2147483647')->get();
                    return $encounters = Patients::whereHas('encounters') // Filters patients who have encounters
                    ->with([
                        'encounters.consulting.visualAcuityFarPresentingRight',
                        'encounters.consulting.visualAcuityFarPresentingLeft',
                            'encounters.consulting.visualAcuityFarPinholeRight',
                            'encounters.consulting.visualAcuityFarPinholeLeft',
                            'encounters.consulting.visualAcuityFarBestCorrectedRight',
                            'encounters.consulting.visualAcuityFarBestCorrectedLeft',
                            'encounters.consulting.visualAcuityNearRight',
                            'encounters.consulting.visualAcuityNearLeft',
                            'encounters.continueConsulting.chiefComplaintRight',
                            'encounters.continueConsulting.chiefComplaintLeft',
                            'encounters.refractions.sphereRight',
                            'encounters.refractions.sphereLeft',
                            'encounters.refractions.cylinderRight',
                            'encounters.refractions.cylinderLeft',
                            'encounters.refractions.axisRight',
                            'encounters.refractions.axisLeft',
                            'encounters.refractions.prismRight',
                            'encounters.refractions.prismLeft',
                            'encounters.sketches',
                            'encounters.diagnoses.diagnosisRightDetails',
                            'encounters.diagnoses.diagnosisLeftDetails',
                            'encounters.appointments',
                            'encounters.investigations',
                            'encounters.treatments',
                    ])
                    //  ->where('patientId', '=', '113')
                    ->get();
                
                         // 'encounters',
                        // 'encounters.continueConsulting',
                        // 'encounters.refractions',
                        // 'encounters.diagnoses',
                        // 'encounters.investigations',
                        // 'encounters.treatments',

                    // $encounters = Encounters::with([
                    //     'patients',
                    //     'consulting.visualAcuityFarPresentingRight',
                    //     'consulting.visualAcuityFarPresentingLeft',
                    //     'consulting.visualAcuityFarPinholeRight',
                    //     'consulting.visualAcuityFarPinholeLeft',
                    //     'consulting.visualAcuityFarBestCorrectedRight',
                    //     'consulting.visualAcuityFarBestCorrectedLeft',
                    //     'consulting.visualAcuityNearRight',
                    //     'consulting.visualAcuityNearLeft',
                    //     'continueConsulting.chiefComplaintRight',
                    //     'continueConsulting.chiefComplaintLeft',
                    //     'refractions.sphereRight',
                    //     'refractions.sphereLeft',
                    //     'refractions.cylinderRight',
                    //     'refractions.cylinderLeft',
                    //     'refractions.axisRight',
                    //     'refractions.axisLeft',
                    //     'refractions.prismRight',
                    //     'refractions.prismLeft',
                    //     'sketches',
                    //     'diagnoses.diagnosisRightDetails',
                    //     'diagnoses.diagnosisLeftDetails',
                    //     'appointments',
                    //     'investigations',
                    //     'treatments',
                    // ])->get();
                    
                    // return response()->json($encounters, 200);
                         
     }

   public function store(Request $request)
{
    try {
        // Validate incoming request data
        $validated = $request->validate([
            'patientId' => 'exists:patients,patientId',
            'visualAcuityFarPresentingRight' => 'nullable|string|max:1000',
            'visualAcuityFarPresentingLeft' => 'nullable|string|max:1000',
            'visualAcuityFarPinholeRight' => 'nullable|string|max:1000',
            'visualAcuityFarPinholeLeft' => 'nullable|string|max:1000',
            'visualAcuityFarBestCorrectedRight' => 'nullable|max:1000',
            'visualAcuityFarBestCorrectedLeft' => 'nullable|max:1000',
            'visualAcuityNearRight' => 'nullable|max:1000',
            'visualAcuityNearLeft' => 'nullable|string|max:1000',
            'chiefComplaintRight' => 'nullable',
            'chiefComplaintLeft' => 'nullable',
            'intraOccularPressureRight' => 'nullable|numeric',
            'intraOccularPressureLeft' => 'nullable|numeric',  
            'otherComplaintsRight' => 'nullable|string|max:1000',
            'otherComplaintsLeft' => 'nullable|string|max:1000',
            'detailedHistoryRight' => 'nullable|string|max:1000',
            'detailedHistoryLeft' => 'nullable|string|max:1000',
            'findingsRight' => 'nullable|string|max:1000',
            'findingsLeft' => 'nullable|string|max:1000',
            'eyelidRight' => 'nullable|string|max:1000',
            'eyelidLeft' => 'nullable|string|max:1000',
            'conjunctivaRight' => 'nullable|string|max:1000',
            'conjunctivaLeft' => 'nullable|string|max:1000',
            'corneaRight' => 'nullable|string|max:1000',
            'corneaLeft' => 'nullable|string|max:1000',
            'ACRight' => 'nullable|string|max:1000',
            'ACLeft' => 'nullable|string|max:1000',
            'irisRight' => 'nullable|string|max:1000',
            'irisLeft' => 'nullable|string|max:1000',
            'pupilRight' => 'nullable|string|max:1000',
            'pupilLeft' => 'nullable|string|max:1000',
            'lensRight' => 'nullable|string|max:1000',
            'lensLeft' => 'nullable|string|max:1000',
            'vitreousRight' => 'nullable|string|max:1000',
            'vitreousLeft' => 'nullable|string|max:1000',
            'retinaRight' => 'nullable|string|max:1000',
            'retinaLeft' => 'nullable|string|max:1000',
            'otherFindingsRight' => 'nullable|string|max:1000',
            'otherFindingsLeft' => 'nullable|string|max:1000',
            'nearAddRight' => 'nullable|string|max:1000',
            'nearAddLeft' => 'nullable|string|max:1000',
            'OCTRight' => 'nullable|string|max:1000',
            'OCTLeft' => 'nullable|string|max:1000',
            'FFARight' => 'nullable|string|max:1000',
            'FFALeft' => 'nullable|string|max:1000',
            'fundusPhotographyRight' => 'nullable|string|max:1000',
            'fundusPhotographyLeft' => 'nullable|string|max:1000',
            'pachymetryRight' => 'nullable|string|max:1000',
            'pachymetryLeft' => 'nullable|string|max:1000',
            'CUFTRight' => 'nullable|string|max:1000',
            'CUFTLeft' => 'nullable|string|max:1000',
            'CUFTKineticRight' => 'nullable|string|max:1000',
            'CUFTKineticLeft' => 'nullable|string|max:1000',
            'pupilDistanceRight' => 'nullable|string|max:1000',
            'pupilDistanceLeft' => 'nullable|string|max:1000',
            'refractionSphereRight' => 'nullable|string|max:1000',
            'refractionSphereLeft' => 'nullable|string|max:1000',
            'refractionCylinderRight' => 'nullable|string|max:1000',
            'refractionCylinderLeft' => 'nullable|string|max:1000',
            'refractionAxisRight' => 'nullable|string|max:1000',
            'refractionAxisLeft' => 'nullable|string|max:1000',
            'refractionPrismRight' => 'nullable|string|max:1000',
            'refractionPrismLeft' => 'nullable|string|max:1000',
            'diagnosisRight' => 'nullable',
            'diagnosisLeft' => 'nullable',
            'investigationsRequired' => 'nullable|string',
            'externalInvestigationRequired' => 'nullable|string',
            'investigationsDone' => 'nullable|string',
            'HBP' => 'nullable|boolean',
            'diabetes' => 'nullable|boolean',
            'pregnancy' => 'nullable|boolean',
            'drugAllergy' => 'nullable|boolean',
            'currentMedication' => 'nullable|string|max:1000',
            'documentId' => 'nullable|exists:document_upload,documentId',
            'treatmentType' => 'nullable|string|max:1000',
            'dosage' => 'nullable|string|max:1000',
            'doseDuration' => 'nullable|string|max:1000',
            'doseInterval' => 'nullable|string|max:1000',
            'time' => 'nullable|string|max:1000',
            'comment' => 'nullable|string|max:1000',
            'lensType' => 'nullable|string|max:1000',
            'costOfLens' => 'nullable|numeric',
            'costOfFrame' => 'nullable|numeric',
        ]);

        // Use only validated data for mass assignment
        $consultingData = [
            'patientId' => $validated['patientId'],
            // 'details' => $validated['details'],
        ];

        // Prepare data for ContinueConsulting
       

        $encounterData = [
            // 'patientId' => $request->input('patientId'),
            'patientId' => $validated['patientId'],
        ];
       // $encounter = Encounters::create(
        //     ['patientId' => $encounterData['patientId']]
        // );

        // Perform database operations in a transaction
        $result = DB::transaction(function () use ($validated, $consultingData, $encounterData) {
            $consulting = Consulting::create($consultingData);
            $continue_consulting = ContinueConsulting::create($consultingData);
            $diagnosis = Diagnosis::create($consultingData);
            $refractions = Refraction::create($consultingData);
            $encounter = Encounters::create([
                'patientId' => $encounterData['patientId'],
                'consultingId' => $consulting->consultingId,
                'continueConsultingId' => $continue_consulting->continueConsultingId,
                'diagnosisId' => $diagnosis->diagnosisId,
                'refractionsId' => $refractions->refractionsId, 
            ]);
            
            $consulting->update(['encounterId' => $encounter->encounterId]);
            $continue_consulting->update(['encounterId' => $encounter->encounterId]);
            $diagnosis->update(['encounterId' => $encounter->encounterId]);

            return compact('consulting', 'continue_consulting', 'diagnosis', 'encounter', 'refractions');
        });

        // Return JSON response
        return response()->json([
            'message' => 'Encounter records created and linked successfully.',
            'encounter' => $result['encounter'],
            'consulting' => $result['consulting'],
            'continue_consulting' => $result['continue_consulting'],
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to create records: ' . $e->getMessage(),
        ], 500);
    }
}
    
    
}
