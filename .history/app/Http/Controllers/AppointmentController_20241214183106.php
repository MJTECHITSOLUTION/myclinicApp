<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Patient;
use App\Appointment;
use App\Waiting_list;
use App\Setting;
use Redirect;
use Nexmo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AppointmentController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }
    public function btncreate($id){
        $patient = User::findOrfail($id);
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        Session::put('genderPation', $patient->patient->gender);
    	$patients = User::where('role','patient')->get();
	    return view('appointment.create', ['patients' => $patients]);
    }

    public function create(){
    	$patients = User::where('role','patient')->get();
	    return view('appointment.create', ['patients' => $patients]);
    }

    public function checkslots($date){

    	return $this->getTimeSlot($date);
    }


    public function available_slot($date,$start,$end){
    	$check = Appointment::where('date',$date)->where('time_start', $start)->where('time_end', $end)->where('visited', '!=', '2')->count();
    	if($check == 0){
        	return 'available';
    	}else{
        	return 'unavailable';
    	}
    }


    public function getTimeSlot($date) {

        $day = date("l", strtotime($date));
        $day_from_morning = strtolower($day . '_from_morning');
        $day_to_morning = strtolower($day . '_to_morning');
        $day_from_evening = strtolower($day . '_from_evening');
        $day_to_evening = strtolower($day . '_to_evening');

        $start_morning = Setting::get_option($day_from_morning);
        $end_morning = Setting::get_option($day_to_morning);
        $start_evening = Setting::get_option($day_from_evening);
        $end_evening = Setting::get_option($day_to_evening);
        $interval = Setting::get_option('appointment_interval');

        $startM = new DateTime($start_morning);
        $endM = new DateTime($end_morning);
        $startE = new DateTime($start_evening);
        $endE = new DateTime($end_evening);
        $start_time_morning = $startM->format('H:i');
        $end_time_morning = $endM->format('H:i');
        $start_time_evening = $startE->format('H:i');
        $end_time_evening = $endE->format('H:i');

        $time = [];

        $i = 0;
        while (strtotime($start_time_morning) <= strtotime($end_time_morning)) {
            $start = $start_time_morning;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_morning)));
            $start_time_morning = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_morning)));
            $time[$i]['start'] = $start;
            $time[$i]['end'] = $end;
            $time[$i]['available'] = $this->available_slot($date, $start, $end);
            $i++;
        }

        while (strtotime($start_time_evening) <= strtotime($end_time_evening)) {
            $start = $start_time_evening;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_evening)));
            $start_time_evening = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_evening)));
            $time[$i]['start'] = $start;
            $time[$i]['end'] = $end;
            $time[$i]['available'] = $this->available_slot($date, $start, $end);
            $i++;
        }

        return $time;
    }


	public function store(Request $request){

		$validatedData = $request->validate([
        	'patient' => ['required','exists:users,id'],
            'rdv_time_date' => ['required'],
            'rdv_time_start' => ['required'],
            'rdv_time_end' => ['required'],
            'send_sms' => ['boolean'],
            // 'status' => ['required', 'numeric'], // Added validation for status
            // 'reason' => ['nullable', 'string'], // Added validation for reason
    	]);

    	$appointment = new Appointment();
		$appointment->user_id = $request->patient;
        $appointment->date = $request->rdv_time_date; // Use the provided date instead of now()->addHour()
		$appointment->time_start = $request->rdv_time_start;
		$appointment->time_end = $request->rdv_time_end;
        $appointment->visited = $request->status ?? 0;
        $appointment->reason = $request->reason;
		$appointment->save();

        if ($request->status == 3) {
            $lastNum = Waiting_list::max('num');
            $newNum = $lastNum ? $lastNum + 1 : 1;
            Waiting_list::create([
                'appointment_id' => $appointment->id, // Use the newly created appointment ID
                'user_id' => $appointment->user_id,
                'num' => $newNum,
                'status' => 'waiting', 
            ]);
        }

        return $request->status == 3 
            ? Redirect::route('appointment.pending')->with('success', 'Rendez-vous créé avec succès !')
            : Redirect::route('appointment.all')->with('success', 'Rendez-vous créé avec succès !');
	}

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'rdv_id' => ['required', 'exists:appointments,id'],
            'rdv_status' => ['required', 'numeric'],
        ]);

        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->visited = $request->rdv_status;
        $appointment->hours = $request->hours ?? $appointment->hours; 
        $appointment->save();

        if ($request->rdv_status == 3) {
            $lastNum = Waiting_list::max('num');
            $newNum = $lastNum ? $lastNum + 1 : 1;
            Waiting_list::create([
                'appointment_id' => $request->rdv_id,
                'user_id' => $appointment->user_id,
                'num' => $newNum,
                'status' => 'waiting', 
            ]);
        } else {
            Waiting_list::where('appointment_id', $request->rdv_id)->delete();
        }

        return Redirect::back()->with('success', 'Rendez-vous mis à jour avec succès !');
    }


    public function all()
    {
        $lastpatient = session('lastpatient');

        $appointments = Appointment::orderBy('id', 'DESC')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->paginate(10);

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function calendar(){

        $appointments = Appointment::orderBy('id','DESC')->paginate(10);
        return view('appointment.calendar', ['appointments' => $appointments]);
    }

    public function pending(){

        $appointments = Waiting_list::orderBy('num', 'ASC')->paginate(10);

        return view('appointment.pending', ['appointments' => $appointments]);
    }


    public function day(){

        $currentDate = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format
        $appointments = Appointment::whereDate('date', $currentDate)->orderBy('id','DESC')->paginate(10);

        return view('appointment.day', ['appointments' => $appointments]);

    }

    public function dayfilter(Request $request){
        $startDate = $request->input('datefilter');
//        $currentDate = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format
        $appointments = Appointment::whereDate('date', $startDate)->orderBy('id','DESC')->paginate(10);

        return view('appointment.dayfilter', ['appointments' => $appointments,'startDate'=>$startDate]);

    }



    public function destroy($id){

        Appointment::destroy($id);
        return Redirect::route('appointment.day')->with('success', 'Rendez-vous supprimé avec succès !');

    }

    public function destroyWaiting($id){
        $waitingList = Waiting_list::findOrFail($id);

        $appointment = Appointment::findOrFail($waitingList->appointment_id);
        $appointment->visited = 1;
        // $appointment->hours = $waitingList->hours ?? $appointment->hours; 
        $waitingList->delete();
        $appointment->save();
        return Redirect::route('appointment.day')->with('success', 'Rendez-vous supprimé avec succès !');

    }

public function destroyWaitingList() {
    
    try {
        DB::transaction(function () {
            // Fetch all data from `waiting_list`
            $waitingListData = DB::table('waiting_list')->get();

            if ($waitingListData) {
                // Convert data to an array for insertion, excluding the 'id' field
                $insertData = $waitingListData->map(function ($record) {
                    unset($record->id); // Remove the id field
                    return (array) $record;
                })->toArray();

                // Insert data into `waiting_list_archive`
                DB::table('waiting_list_archive')->insert($insertData);
            }

            // Truncate the `waiting_list` table
            DB::table('waiting_list')->truncate();
        });
        return redirect()->back()->with('success', 'Les données de la liste d\'attente ont été archivées et la table a été tronquée avec succès !');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'archivage de la liste d\'attente : ' . $e->getMessage());
    }
}

public function updateActiveStatus($id)
{

    dd
    $appointment = Appointment::findOrFail($id);
    $appointment->active = !$appointment->active; // Toggle the active status
    $appointment->save();

    return response()->json(['success' => true, 'active' => $appointment->active]);
}


}
