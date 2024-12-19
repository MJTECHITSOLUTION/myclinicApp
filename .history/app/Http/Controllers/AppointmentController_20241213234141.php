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

    	]);

    	$appointment = new Appointment();
		$appointment->user_id = $request->patient;
        $appointment->date = now()->addHour();
		$appointment->time_start = $request->rdv_time_start;
		$appointment->time_end = $request->rdv_time_end;
        $appointment->visited = 0;
        $appointment->reason = $request->reason;
		$appointment->save();


//        if($request->send_sms == 1){
//
//            $user = User::findOrFail($request->patient);
//            $phone = $user->Patient->phone;
//
//            Nexmo::message()->send([
//                'to'   => $phone,
//                'from' => '213794616181',
//                'text' => 'You have an appointment on '.$request->rdv_time_date.' at '.$request->rdv_time_start.' at Doctorino'
//            ]);
//
//        }

		return Redirect::route('appointment.all')->with('success', 'Rendez-vous créé avec succès !');

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
        return Redirect::route('appointment.all')->with('success', 'Rendez-vous supprimé avec succès !');

    }

    public function destroyWaiting($id){
        $waitingList = Waiting_list::findOrFail($id);

        $appointment = Appointment::findOrFail($waitingList->appointment_id);
        $appointment->visited = 1;
        // $appointment->hours = $waitingList->hours ?? $appointment->hours; 
        $waitingList->delete();
        $appointment->save();
        return Redirect::route('appointment.all')->with('success', 'Rendez-vous supprimé avec succès !');

    }

public function destroyWaitingList() {
    Waiting_list::truncate(); // Deletes all rows in the Waiting_list table
    return Redirect::route('appointment.all')->with('success', 'Toute la liste d\'attente a été supprimée avec succès !');
}



}
