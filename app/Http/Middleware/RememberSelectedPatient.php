<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patient;

class RememberSelectedPatient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $doctor = Auth::user(); // Get the authenticated doctor

        if ($doctor) {
            $selectedPatient = session('selected_patient_' . $doctor->id);

            if ($selectedPatient) {
                // Load the patient data from the database and make it available to the session
                $patient = Patient::find($selectedPatient);
                if ($patient) {
                    session(['selected_patient' => $patient]);
                }
            }
        }

        return $next($request);
    }
}
