<?php

namespace App\Http\Controllers;

use App\Act;
use App\Honoraire;
use App\Note;
use App\Prescription;
use App\Setting;
use App\User;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;

class NoteHonoraire extends Controller
{
    public function create()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $settings = Setting::where('id', 23)->get('option_value');

        $acts = Act::all();
        $prescriptions = Prescription::all();

        return view('notehonoraire.create', ['patients' => $patients, 'prescriptions' => $prescriptions,'settings' => $settings, 'acts' => $acts]);
    }

    public function store(Request $request)
    {
        // Modify validation to make fields nullable
$data = $request->validate([
    'act_name.*' => 'nullable|integer|exists:act,id', // This can be null
    'code.*' => 'nullable|string', // This can be null
    'lettrecle.*' => 'nullable|string', // This can be null
    'montant.*' => 'nullable|numeric', // This can be null
]);

// Create new Note record
$note = new Note;
$note->ref =  'N-' . rand(10000, 99999);
$note->user_id = $request->patient_id;
$note->save();

$noteHonoraireData = [];

// Populate note honoraire data
foreach ($data['act_name'] as $index => $act_id) {
    $noteHonoraireData[] = [
        'act_id' => $act_id,
        'not_id' => $note->id,
        'act_name' => $act_id ? Act::find($act_id)->name : null, // Handle nullable act_id
        'code' => $data['code'][$index] ?? null, // Handle nullable code
        'lettrecle' => $data['lettrecle'][$index] ?? null, // Handle nullable lettrecle
        'date' => $request->input('date.' . $index, null), // Can be null
        'dent' => $request->input('dents.' . $index, null), // Can be null
        'montant' => $data['montant'][$index] ?? null, // Handle nullable montant
        'created_at' => now(),
        'updated_at' => now(),
    ];
}

        Honoraire::insert($noteHonoraireData);

        return redirect()->route('notehonoraire.all')->with('success', 'Notes added successfully');
    }
    public function view($id)
    {
        $lastpatient = session('lastpatient');
        $settings = Setting::where('id', 23)->get('option_value');
        $notedate = Honoraire::select('created_at')->first();

        $note = Note::find($id);
        $patient = User::where('id', $note->user_id)->first();
        $acts = Act::all();
        $prescriptions = Prescription::all();
        $noteHonoraire = Note::join('notehonoraire', 'notehonoraire.not_id', '=', 'note.id')->where('note.id', $id)->get();
        return view('notehonoraire.view',['patient' => $patient, 'prescriptions' => $prescriptions,'settings' => $settings, 'acts' => $acts, 'noteHonoraire' => $noteHonoraire , 'notedate' => $notedate , 'note' => $note, 'id' => $id]);
    }
    public function all(){

        $notehonoraire = Note::join('users', 'users.id', '=', 'note.user_id')
            ->select('note.*', 'users.name')
            ->orderBy('note.created_at', 'desc')
            ->paginate(20);
        $patients = User::where('role', 'patient')->get();
        return view('notehonoraire.all',['notehonoraire' => $notehonoraire, 'patients' => $patients,]);
    }
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully');
    }

    public function generatePDF($patientId, $noteId)
    {

        //Recto page Cnops
        $patient = User::where('users.id', $patientId)->join('patients', 'patients.user_id', '=', 'users.id')->first();
        $name = $patient->name;
        $birthday = $patient->birthday;
        $phone = $patient->phone;
        $address = $patient->address;
        $assurance = $patient->assurance;
        $gender = $patient->gender;
        $cin = $patient->cin;

        $Note = Note::findOrFail($noteId);
        $date = new \DateTime($Note->created_at);
        $formattedDate = $date->format('d     m       Y');

        // Path to the existing PDF
        $pdfTemplatePath = public_path('templates/template.pdf');

        // Create a new instance of FPDI
        $pdf = new FPDI();

        $dynamicContent = Setting::get_option('inp');
        $ville = Setting::get_option('ville');
        // Set the source file
        $pdf->setSourceFile($pdfTemplatePath);

        // Import the first page of the existing PDF
        $tplIdx = $pdf->importPage(1);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplIdx);

        // Add a page with the same size as the original PDF
        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

        // Use the imported page as a template
        $pdf->useTemplate($tplIdx);

        // Set the font and position for adding text
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(9);

        // Add the user-specific information
        $pdf->SetXY(190, 95); // X and Y position on the page
        $pdf->Write(0, $name);

        $pdf->SetXY(200, 99); // Adjust Y position for the next line
        $date = new \DateTime($birthday);
        $formattedDateNissance = $date->format('d     m       Y');
        $pdf->Write(0, $formattedDateNissance);
        if($gender == 'Homme'){
            $pdf->SetXY(200, 109.5); // Adjust Y position for the next line
            $pdf->Write(0, 'X');
        }else{
            $pdf->SetXY(228, 109.5); // Adjust Y position for the next line
            $pdf->Write(0, 'X');
        }

        $pdf->SetXY(201, 104); // Adjust Y position for the next line
        $pdf->Write(0, $cin);

        $pdf->SetXY(202, 121); // Adjust Y position for the next line
        $pdf->Write(0, $dynamicContent );

        $pdf->SetXY(239, 164); // Adjust Y position for the next line
        $pdf->Write(0, $ville );
        $pdf->SetXY(233, 168); // Adjust Y position for the next line
        $pdf->Write(0, $formattedDate);

        // Output the PDF for download
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="user_details.pdf"');
    }
    public function versoPdf($id)
    {
        //verso pdf Cnops
        $Note = Note::findOrFail($id);
        $NoteHonoraire = Honoraire::where('not_id', $id)->get();

        // Path to the existing PDF
        $pdfTemplatePath = public_path('templates/template.pdf');

        // Create a new instance of FPDI
        $pdf = new FPDI();

        $dynamicContent = Setting::get_option('inp');
        $ville = Setting::get_option('ville');

        // Set the source file
        $pdf->setSourceFile($pdfTemplatePath);

        // Import the second page of the existing PDF
        $tplIdx = $pdf->importPage(2);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplIdx);

        // Add a page with the same size as the original PDF
        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

        // Use the imported page as a template
        $pdf->useTemplate($tplIdx);

        // Set the font and position for adding text
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(8);

        // Initial Y position for NoteHonoraire
        $initialY = 24.5;
        $incrementY = 6.5;

        // Add the user-specific information
        foreach ($NoteHonoraire as $note) {
            $pdf->SetXY(155, $initialY);
            $pdf->Write(0, $note->dent); // Assuming dent is a string
            $pdf->SetXY(170, $initialY);
            $pdf->Write(0, $note->code);
            $pdf->SetXY(181, $initialY);
            $pdf->Write(0, $note->date);
            $pdf->SetXY(202, $initialY);
            $pdf->Write(0, $note->lettrecle);
            $pdf->SetXY(230, $initialY);
            $pdf->Write(0, $note->montant);

            // Increment the Y position for the next row
            $initialY += $incrementY;
        }

        // Additional Y position for chosen teeth
//        $additionalY = $initialY + 10; // Adjust if needed
//
////         Loop through the NoteHonoraire
//        foreach ($NoteHonoraire as $note) {
//            // Handle the dent as a single string
//            $dent = $note->dent;
//            $code = $note->code;
//
//            // Set X and Y positions based on dent value
//            switch ($dent) {
//                case '11':
//                    $x = 209;
//                    $y = 108.5;
//                    $pdf->Text($x, $y, 'X');
//                case '12':
//                    $x = 209;
//                    $y = 108.5;
//                    $pdf->Text($x, $y, 'X');
//                    break;
//                default:
//                    $x = 155; // Default X position
//                    $y = $additionalY; // Default Y position
//                    break;
//            }
//
//
////            $pdf->SetXY($x, $y);
////            $pdf->Write(0, $dent);
////            $pdf->SetXY($x + 15, $y); // Adjust X position for code
////            $pdf->Write(0, $code);
//
//            // Increment the Y position for the next row
//            $additionalY += $incrementY;
//        }

        // Output the PDF for download
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="user_details.pdf"');
    }



    public function rectoCnss($patientId, $noteId)
    {

        //Recto page Cnss
        $patient = User::where('users.id', $patientId)->join('patients', 'patients.user_id', '=', 'users.id')->first();
        $name = $patient->name;
        $birthday = $patient->birthday;
        $phone = $patient->phone;
        $address = $patient->address;
        $assurance = $patient->assurance;
        $gender = $patient->gender;
        $cin = $patient->cin;

        $Note = Note::findOrFail($noteId);
        $date = new \DateTime($Note->created_at);
        $formattedDate = $date->format('d     m       Y');

        // Path to the existing PDF
        $pdfTemplatePath = public_path('templates/CNSS DENTAIRE.pdf');

        // Create a new instance of FPDI
        $pdf = new FPDI();

        $dynamicContent = Setting::get_option('inp');
        $ville = Setting::get_option('ville');
        // Set the source file
        $pdf->setSourceFile($pdfTemplatePath);

        // Import the first page of the existing PDF
        $tplIdx = $pdf->importPage(1);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplIdx);

        // Add a page with the same size as the original PDF
        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

        // Use the imported page as a template
        $pdf->useTemplate($tplIdx);

        // Set the font and position for adding text
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(9);

        // Add the user-specific information
        $pdf->SetXY(245, 96); // X and Y position on the page
        $pdf->Write(0, $name);

        $pdf->SetXY(272, 101); // Adjust Y position for the next line
        $date = new \DateTime($birthday);
        $formattedDateNissance = $date->format('d     m       Y');
        $pdf->Write(0, $formattedDateNissance);
        if($gender == 'Homme'){
            $pdf->SetXY(295, 115.5); // Adjust Y position for the next line
            $pdf->Write(0, 'X');
        }else{
            $pdf->SetXY(314.5, 115.5); // Adjust Y position for the next line
            $pdf->Write(0, 'X');
        }

        $pdf->SetXY(275, 108); // Adjust Y position for the next line
        $pdf->Write(0, $cin);

        $pdf->SetXY(225, 127); // Adjust Y position for the next line
        $pdf->Write(0, $dynamicContent );

        $pdf->SetXY(305, 185); // Adjust Y position for the next line
        $pdf->Write(0, $ville );
        $pdf->SetXY(301, 189); // Adjust Y position for the next line
        $pdf->Write(0, $formattedDate);

        // Output the PDF for download
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="user_details.pdf"');
    }

    public function cnssversoPdf($id)
    {

        //verso pdf Cnss
        $Note = Note::findOrFail($id);
        $NoteHonoraire = Honoraire::where('not_id', $id)->get();

        // Path to the existing PDF
        $pdfTemplatePath = public_path('templates/CNSS DENTAIRE.pdf');

        // Create a new instance of FPDI
        $pdf = new FPDI();

        $dynamicContent = Setting::get_option('inp');
        $ville = Setting::get_option('ville');

        // Set the source file
        $pdf->setSourceFile($pdfTemplatePath);

        // Import the second page of the existing PDF
        $tplIdx = $pdf->importPage(2);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplIdx);

        // Add a page with the same size as the original PDF
        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

        // Use the imported page as a template
        $pdf->useTemplate($tplIdx);

        // Set the font and position for adding text
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(8);

        // Initial Y position
        $initialY = 26.5;
        $incrementY = 6.5;

        foreach ($NoteHonoraire as $note) {
            $pdf->SetXY(210, $initialY);
            $pdf->Write(0, $note->dent);
            $pdf->SetXY(229, $initialY);
            $pdf->Write(0, $note->code);
            $pdf->SetXY(242, $initialY);
            $date = Carbon::parse($note->date);
            $pdf->Write(0, $date->format('d-m-Y'));
            $pdf->SetXY(265, $initialY);
            $pdf->Write(0, $note->lettrecle);
            $pdf->SetXY(298, $initialY);
            $pdf->Write(0, $note->montant);

            // Increment the Y position for the next row
            $initialY += $incrementY;
        }


        // Output the PDF for download
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="user_details.pdf"');
    }



}
