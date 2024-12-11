<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){
        $payments = Payment::all();
        return view('payment.create',['payments' => $payments]);
    }
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $payment = new Payment();

        $payment->name = $request->name;
        $payment->price = $request->price;

        $payment->save();

        return Redirect::route('payment.all')->with('success', __('créé avec succès'));

    }
    public function all(){
        $payments = Payment::all();

        return view('payment.all', ['payments' => $payments]);
    }
    public function edit($id){
        $payment = Payment::find($id);
        return view('payment.edit',['payment' => $payment]);
    }
    public function store_edit(Request $request)
    {

        $payment = Payment::find($request->payment_id);

        if (!$payment) {
            return Redirect::route('payment.all')->with('error', __('pas trouvé'));
        }
        $payment->name = $request->name;
        $payment->price = $request->price;
        $payment->save();
        return Redirect::route('payment.all')->with('success', __('Modifié avec succès'));
    }
    public function destroy($id){

        Payment::destroy($id);
        return Redirect::route('payment.all')->with('success', __('Supprimé avec succès'));

    }
    public function search(Request $request){

        $term = $request->term;

        $payments = Payment::where('name','LIKE','%' . $term . '%')->OrderBy('id','asc')->paginate(10);


        return view('payment.all', ['payments' => $payments]);
    }

}
