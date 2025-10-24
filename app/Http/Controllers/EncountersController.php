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
use App\Models\Sketch;
use App\Models\Treatment;

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
                            'encounters.diagnosis.diagnosisRightDetails',
                            'encounters.diagnosis.diagnosisLeftDetails',
                            'encounters.appointments',
                            'encounters.investigations',
                            'encounters.treatments',
                            'encounters.findings',
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
            'patientId' => 'required|exists:patients,patientId',

            // Consulting fields
            'visualAcuityFarPresentingRight' => 'nullable|max:1000',
            'visualAcuityFarPresentingLeft' => 'nullable|max:1000',
            'visualAcuityFarPinholeRight' => 'nullable|max:1000',
            'visualAcuityFarPinholeLeft' => 'nullable|max:1000',
            'visualAcuityFarBestCorrectedRight' => 'nullable|max:1000',
            'visualAcuityFarBestCorrectedLeft' => 'nullable|max:1000',
            'visualAcuityNearRight' => 'nullable|max:1000',
            'visualAcuityNearLeft' => 'nullable|max:1000',

            // ContinueConsulting fields
            'chiefComplaintRight' => 'nullable',
            'chiefComplaintLeft' => 'nullable',
            'intraOccularPressureRight' => 'nullable',
            'intraOccularPressureLeft' => 'nullable',
            'otherComplaintsRight' => 'nullable|max:1000',
            'otherComplaintsLeft' => 'nullable|max:1000',
            'detailedHistoryRight' => 'nullable|max:1000',
            'detailedHistoryLeft' => 'nullable|max:1000',
            'findingsRight' => 'nullable|max:1000',
            'findingsLeft' => 'nullable|max:1000',
            'eyelidRight' => 'nullable|max:1000',
            'eyelidLeft' => 'nullable|max:1000',
            'conjunctivaRight' => 'nullable|max:1000',
            'conjunctivaLeft' => 'nullable|max:1000',
            'corneaRight' => 'nullable|max:1000',
            'corneaLeft' => 'nullable|max:1000',
            'ACRight' => 'nullable|max:1000',
            'ACLeft' => 'nullable|max:1000',
            'irisRight' => 'nullable|max:1000',
            'irisLeft' => 'nullable|max:1000',
            'pupilRight' => 'nullable|max:1000',
            'pupilLeft' => 'nullable|max:1000',
            'lensRight' => 'nullable|max:1000',
            'lensLeft' => 'nullable|max:1000',
            'vitreousRight' => 'nullable|max:1000',
            'vitreousLeft' => 'nullable|max:1000',
            'retinaRight' => 'nullable|max:1000',
            'retinaLeft' => 'nullable|max:1000',
            'otherFindingsRight' => 'nullable|max:1000',
            'otherFindingsLeft' => 'nullable|max:1000',

            // Investigations fields
            'investigationsRequired' => 'nullable',
            'externalInvestigationRequired' => 'nullable',
            'investigationsDone' => 'nullable',
            'HBP' => 'nullable',
            'diabetes' => 'nullable',
            'pregnancy' => 'nullable',
            'drugAllergy' => 'nullable',
            'currentMedication' => 'nullable|max:1000',
            'documentId' => 'nullable|exists:document_upload,documentId',

            // Refraction fields
            'nearAddRight' => 'nullable|max:1000',
            'nearAddLeft' => 'nullable|max:1000',
            'refractionSphereRight' => 'nullable|max:1000',
            'refractionSphereLeft' => 'nullable|max:1000',
            'refractionCylinderRight' => 'nullable|max:1000',
            'refractionCylinderLeft' => 'nullable|max:1000',
            'refractionAxisRight' => 'nullable|max:1000',
            'refractionAxisLeft' => 'nullable|max:1000',
            'refractionPrismRight' => 'nullable|max:1000',
            'refractionPrismLeft' => 'nullable|max:1000',
            'lensType' => 'nullable|max:1000',
            'costOfLens' => 'nullable|numeric',
            'costOfFrame' => 'nullable|numeric',
            'pd' => 'nullable|max:1000',
            'bridge' => 'nullable|max:1000',
            'temple' => 'nullable|max:1000',
            'eyeSize' => 'nullable|max:1000',
            'decentration' => 'nullable|max:1000',
            'segmentMeasurement' => 'nullable|max:1000',
            'frameType' => 'nullable|max:1000',
            'frameColor' => 'nullable|max:1000',
            'lensColor' => 'nullable|max:1000',
            'lensCost' => 'nullable|numeric',
            'surfacing' => 'nullable|max:1000',
            'others' => 'nullable|max:1000',

            //Findings fields
            'OCTRight' => 'nullable|max:1000',
            'OCTLeft' => 'nullable|max:1000',
            'FFARight' => 'nullable|max:1000',
            'FFALeft' => 'nullable|max:1000',
            'fundusPhotographyRight' => 'nullable|max:1000',
            'fundusPhotographyLeft' => 'nullable|max:1000',
            'pachymetryRight' => 'nullable|max:1000',
            'pachymetryLeft' => 'nullable|max:1000',
            'CVFTRight' => 'nullable|max:1000',
            'CVFTLeft' => 'nullable|max:1000',
            'CVFTKineticRight' => 'nullable|max:1000',
            'CVFTKineticLeft' => 'nullable|max:1000',

            // Diagnosis fields
            'overallDiagnosisRight' => 'nullable',
            'overallDiagnosisLeft' => 'nullable',

            // Sketch fields
            'rightEyeFront' => 'nullable|string',
            'rightEyeBack' => 'nullable|string',
            'leftEyeFront' => 'nullable|string',
            'leftEyeBack' => 'nullable|string',

            // Treatments (arrays of objects)
            'eyeDrops' => 'nullable|array',
            'eyeDrops.*.medicine' => 'nullable|string',
            'eyeDrops.*.dosage' => 'nullable|string',
            'eyeDrops.*.doseDuration' => 'nullable|string',
            'eyeDrops.*.doseInterval' => 'nullable|string',
            'eyeDrops.*.comment' => 'nullable|string',

            'tablets' => 'nullable|array',
            'tablets.*.medicine' => 'nullable|string',
            'tablets.*.dosage' => 'nullable|string',
            'tablets.*.doseDuration' => 'nullable|string',
            'tablets.*.doseInterval' => 'nullable|string',
            'tablets.*.comment' => 'nullable|string',

            'ointments' => 'nullable|array',
            'ointments.*.medicine' => 'nullable|string',
            'ointments.*.dosage' => 'nullable|string',
            'ointments.*.doseDuration' => 'nullable|string',
            'ointments.*.doseInterval' => 'nullable|string',
            'ointments.*.comment' => 'nullable|string',
        ]);

        $result = DB::transaction(function () use ($validated, $request) {
             $treatmentId = random_int(1000000000, 9999999999);
            // Create child records (without encounterId yet)
            $consulting = Consulting::create([
                'patientId' => $validated['patientId'],
                'visualAcuityFarPresentingRight' => $validated['visualAcuityFarPresentingRight'] ?? null,
                'visualAcuityFarPresentingLeft' => $validated['visualAcuityFarPresentingLeft'] ?? null,
                'visualAcuityFarPinholeRight' => $validated['visualAcuityFarPinholeRight'] ?? null,
                'visualAcuityFarPinholeLeft' => $validated['visualAcuityFarPinholeLeft'] ?? null,
                'visualAcuityFarBestCorrectedRight' => $validated['visualAcuityFarBestCorrectedRight'] ?? null,
                'visualAcuityFarBestCorrectedLeft' => $validated['visualAcuityFarBestCorrectedLeft'] ?? null,
                'visualAcuityNearRight' => $validated['visualAcuityNearRight'] ?? null,
                'visualAcuityNearLeft' => $validated['visualAcuityNearLeft'] ?? null,
            ]);

            $continueConsulting = ContinueConsulting::create([
                'patientId' => $validated['patientId'],
                'chiefComplaintRight' => $validated['chiefComplaintRight'] ?? null,
                'chiefComplaintLeft' => $validated['chiefComplaintLeft'] ?? null,
                'intraOccularPressureRight' => $validated['intraOccularPressureRight'] ?? null,
                'intraOccularPressureLeft' => $validated['intraOccularPressureLeft'] ?? null,
                'otherComplaintsRight' => $validated['otherComplaintsRight'] ?? null,
                'otherComplaintsLeft' => $validated['otherComplaintsLeft'] ?? null,
                'detailedHistoryRight' => $validated['detailedHistoryRight'] ?? null,
                'detailedHistoryLeft' => $validated['detailedHistoryLeft'] ?? null,
                'findingsRight' => $validated['findingsRight'] ?? null,
                'findingsLeft' => $validated['findingsLeft'] ?? null,
                'eyelidRight' => $validated['eyelidRight'] ?? null,
                'eyelidLeft' => $validated['eyelidLeft'] ?? null,
                'conjunctivaRight' => $validated['conjunctivaRight'] ?? null,
                'conjunctivaLeft' => $validated['conjunctivaLeft'] ?? null,
                'corneaRight' => $validated['corneaRight'] ?? null,
                'corneaLeft' => $validated['corneaLeft'] ?? null,
                'ACRight' => $validated['ACRight'] ?? null,
                'ACLeft' => $validated['ACLeft'] ?? null,
                'irisRight' => $validated['irisRight'] ?? null,
                'irisLeft' => $validated['irisLeft'] ?? null,
                'pupilRight' => $validated['pupilRight'] ?? null,
                'pupilLeft' => $validated['pupilLeft'] ?? null,
                'lensRight' => $validated['lensRight'] ?? null,
                'lensLeft' => $validated['lensLeft'] ?? null,
                'vitreousRight' => $validated['vitreousRight'] ?? null,
                'vitreousLeft' => $validated['vitreousLeft'] ?? null,
                'retinaRight' => $validated['retinaRight'] ?? null,
                'retinaLeft' => $validated['retinaLeft'] ?? null,
                'otherFindingsRight' => $validated['otherFindingsRight'] ?? null,
                'otherFindingsLeft' => $validated['otherFindingsLeft'] ?? null,
            ]);


            $findings = Findings::create([
                'patientId' => $validated['patientId'],
                'OCTRight' => $validated['OCTRight'] ?? null,
                'OCTLeft' => $validated['OCTLeft'] ?? null,
                'FFARight' => $validated['FFARight'] ?? null,
                'FFALeft' => $validated['FFALeft'] ?? null,
                'fundusPhotographyRight' => $validated['fundusPhotographyRight'] ?? null,
                'fundusPhotographyLeft' => $validated['fundusPhotographyLeft'] ?? null,
                'pachymetryRight' => $validated['pachymetryRight'] ?? null,
                'pachymetryLeft' => $validated['pachymetryLeft'] ?? null,
                'CUFTRight' => $validated['CVFTRight'] ?? null,
                'CUFTLeft' => $validated['CVFTLeft'] ?? null,
                'CUFTKineticRight' => $validated['CVFTKineticRight'] ?? null,
                'CUFTKineticLeft' => $validated['CVFTKineticLeft']
            ]);

            $investigations = Investigation::create([
                'patientId' => $validated['patientId'],
                'investigationsRequired' => $validated['investigationsRequired'] ?? null,
                'externalInvestigationRequired' => $validated['externalInvestigationRequired'] ?? null,
                'investigationsDone' => $validated['investigationsDone'] ?? null,
                'HBP' => $validated['HBP'] ?? null,
                'diabetes' => $validated['diabetes'] ?? null,
                'pregnancy' => $validated['pregnancy'] ?? null,
                'drugAllergy' => $validated['drugAllergy'] ?? null,
                'currentMedication' => $validated['currentMedication'] ?? null,
                'documentId' => $validated['documentId'] ?? null,
            ]);

            $refraction = Refraction::create([
                'patientId' => $validated['patientId'],
                'nearAddRight' => $validated['nearAddRight'] ?? null,
                'nearAddLeft' => $validated['nearAddLeft'] ?? null,
                'refractionSphereRight' => $validated['refractionSphereRight'] ?? null,
                'refractionSphereLeft' => $validated['refractionSphereLeft'] ?? null,
                'refractionCylinderRight' => $validated['refractionCylinderRight'] ?? null,
                'refractionCylinderLeft' => $validated['refractionCylinderLeft'] ?? null,
                'refractionAxisRight' => $validated['refractionAxisRight'] ?? null,
                'refractionAxisLeft' => $validated['refractionAxisLeft'] ?? null,
                'refractionPrismRight' => $validated['refractionPrismRight'] ?? null,
                'refractionPrismLeft' => $validated['refractionPrismLeft'] ?? null,
                'lensType' => $validated['lensType'] ?? null,
                'costOfLens' => $validated['costOfLens'] ?? null,
                'costOfFrame' => $validated['costOfFrame'] ?? null,
                'pd' => $validated['pd'] ?? null,
                'bridge' => $validated['bridge'] ?? null,
                'temple' => $validated['temple'] ?? null,
                'eyeSize' => $validated['eyeSize'] ?? null,
                'decentration' => $validated['decentration'] ?? null,
                'segmentMeasurement' => $validated['segmentMeasurement'] ?? null,
                'frameType' => $validated['frameType'] ?? null,
                'frameColor' => $validated['frameColor'] ?? null,
                'lensColor' => $validated['lensColor'] ?? null,
                'lensCost' => $validated['lensCost'] ?? null,
                'surfacing' => $validated['surfacing'] ?? null,
                'others' => $validated['others'] ?? null,
            ]);

            $diagnosis = Diagnosis::create([
                // 'patientId' => $validated['patientId'],
                // 'overallDiagnosisRight' => $validated['overallDiagnosisRight'] ?? null,
                // 'overallDiagnosisLeft' => $validated['overallDiagnosisLeft'] ?? null,
                 'patientId' => $validated['patientId'],
            'diagnosisRight' => $validated['diagnosisRight'] ?? null,
            'diagnosisLeft' => $validated['diagnosisLeft'] ?? null,
            'problemsRight' => $validated['problemsRight'] ?? null,
            'problemsLeft' => $validated['problemsLeft'] ?? null,
            ]);

            $sketch = Sketch::create([
                'patientId' => $validated['patientId'],
                'rightEyeFront' => $validated['rightEyeFront'] ?? null,
                'rightEyeBack' => $validated['rightEyeBack'] ?? null,
                'leftEyeFront' => $validated['leftEyeFront'] ?? null,
                'leftEyeBack' => $validated['leftEyeBack'] ?? null,
            ]);

      

            // Create encounter
            $encounter = Encounters::create([
                'patientId'            => $validated['patientId'],
                'consultingId'         => $consulting->consultingId,
                'continueConsultingId' => $continueConsulting->continueConsultingId,
                'investigationId'      => $investigations->investigationId,
                'refractionId'         => $refraction->refractionId,
                'diagnosisId'          => $diagnosis->diagnosisId,
                'sketchId'             => $sketch->sketchId,
                'treatmentId'          => $treatmentId,
                'findingId'          => $findings->findingId,
            ]);

                  // Save treatments (multiple rows)
            $treatments = [];
            foreach (['eyeDrops' => 'Eye Drop', 'tablets' => 'Tablet', 'ointments' => 'Ointment'] as $key => $type) {
                if ($request->has($key)) {
                    foreach ($request->$key as $row) {
                        $treatments[] = Treatment::create([
                            'patientId'     => $validated['patientId'],
                            'treatmentType' => $type,
                            'medicine'      => $row['medicine'] ?? null,
                            'dosage'        => $row['dosage'] ?? null,
                            'doseDuration'  => $row['doseDuration'] ?? null,
                            'doseInterval'  => $row['doseInterval'] ?? null,
                            'comment'       => $row['comment'] ?? null,
                            'treatmentId'   => $treatmentId, // 🔹 all treatments share this
                            'encounterId'   => $encounter->encounterId,
                        ]);
                    }
                }
            }

            // Link child records
            $consulting->update(['encounterId' => $encounter->encounterId]);
            $continueConsulting->update(['encounterId' => $encounter->encounterId]);
            $investigations->update(['encounterId' => $encounter->encounterId]);
            $refraction->update(['encounterId' => $encounter->encounterId]);
            $diagnosis->update(['encounterId' => $encounter->encounterId]);
            $sketch->update(['encounterId' => $encounter->encounterId]);
            $findings->update(['encounterId' => $encounter->encounterId]);

            // foreach ($treatments as $treatment) {
            //     $treatment->update(['encounterId' => $encounter->encounterId]);
            // }

            return compact(
                'consulting',
                'continueConsulting',
                'investigations',
                'refraction',
                'diagnosis',
                'sketch',
                'treatments',
                'encounter',
                'findings'
            );
        });

        return response()->json([
            'message' => 'Encounter records created and linked successfully.',
            'data' => $result,
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to create records: ' . $e->getMessage(),
        ], 500);
    }
}

    
    
}
