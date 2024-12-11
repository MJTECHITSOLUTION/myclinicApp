<?php

namespace App\Http\Controllers;
use App\Billing;
use App\Billing_item;
use App\Patient;
use App\Payment;
use App\Prescription_drug;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\User;
use App\Rapport;
use App\Rapport_type;
use App\Prescription;
use App\analyse;
use App\Drug;
use App\Radio;
use App\Setting;
use App\Appointment;
use App\Assurance;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;


class RecordController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function all(){

        $patients = User::where('role', '=' ,'patient')->OrderBy('id','DESC')->paginate(10);
        return view('record.all', ['patients' => $patients]);

    }
    public function allC(){

        $patients = User::where('role', '=' ,'patient')->OrderBy('id','DESC')->paginate(10);
        return view('record.allC', ['patients' => $patients]);

    }
    public function allR(){

        $patients = User::where('role', '=' ,'patient')->OrderBy('id','DESC')->paginate(10);
        return view('record.allR', ['patients' => $patients]);

    }

    public function rdv(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $rdvs = Appointment::join('users', 'appointments.user_id', '=', 'users.id')
            ->whereBetween('appointments.created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->select('appointments.*', 'users.name as user_name')
            ->get();

        return view('record.rdv', compact('rdvs','startDate','endDate'));

    }

    public function allA(){
        $assurances = assurance::all();
        return view('record.allA', compact('assurances'));
    }
    public function allCA(){
        $assurances = assurance::all();
        return view('record.allCA', compact('assurances'));
    }

    public function consultationParAssurance(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $assuranceRequest = $request->input('assurance');
        $assurance = assurance::all();

        $assurances = Prescription::join('patients', 'prescriptions.user_id', '=', 'patients.user_id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->where('patients.assurance', '=', $assuranceRequest)
            ->whereBetween('prescriptions.created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->select('users.name as user_name','prescriptions.*','patients.*')
            ->get();


        return view('record.assuranceconsultation', compact('assurance', 'assurances','startDate','endDate','assuranceRequest'));
    }

    public function assurance(Request $request){
        $assuranceRequests = $request->input('assurance') ;
        $assurance = assurance::all();
        if (!is_array($assuranceRequests)) {
            // If only one option is selected, convert it to an array.
            $assuranceRequests = [$assuranceRequests];
        }

        // Use the "whereIn" method to search for records with selected "assurance" values.
        $assurances = Billing::join('users', 'billings.user_id', '=', 'users.id')
            ->join('patients', 'users.id', '=', 'patients.user_id')
            ->whereIn('assurance', $assuranceRequests)
            ->select('patients.*', 'users.*','billings.*','billings.id as billingid')
            ->get();
        return view('record.assurance',compact('assurances', 'assurance'  ,'assuranceRequests'));
    }

    public function consultation(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $prescriptions = Prescription::join('users', 'prescriptions.user_id', '=', 'users.id')
            ->leftJoin('prescription_drugs', 'prescriptions.id', '=', 'prescription_drugs.prescription_id')
            ->leftJoin('prescription_tests', 'prescriptions.id', '=', 'prescription_tests.prescription_id')
            ->leftJoin('prescription_radio', 'prescriptions.id', '=', 'prescription_radio.prescription_id')
            ->whereBetween('prescriptions.created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->selectRaw('
        prescriptions.*,
        users.name as user_name,
        COUNT(prescription_drugs.id) as drug_count,
        COUNT(prescription_tests.id) as analyse_count,
        COUNT(prescription_radio.id) as radio_count'
            )
            ->groupBy('prescriptions.id')
            ->get();


        return view('record.consultation', compact('prescriptions' , 'startDate', 'endDate'));

    }
    public function searchByDateRangePatient(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
//            ->join('assurance', 'patients.assurance_id', '=', 'assurance.id')
            ->whereBetween('patients.created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->select('patients.*', 'users.name as user_name')
            ->get();

        $countP = $patients->count();

        return view('record.search', compact('patients','countP' , 'endDate' , 'startDate' ));
    }
    public function payment(){

        return view('record.allP');

    }
    public function getPaymentsByDateRange(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $payments = Billing::join('users', 'billings.user_id','=','users.id')->whereBetween('billings.created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
            ->select('billings.*','users.name as user_name')->get();

        $restapaye = Billing::whereBetween('created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])->sum('total_without_tax');

        $total_payments_range = Billing::whereBetween('created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59'])->sum('total_without_tax');


        return view('record.payment', compact('payments','total_payments_range', 'startDate' , 'endDate' , 'restapaye'));
    }


}
