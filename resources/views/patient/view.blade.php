@extends('layouts.master')

@section('title')
    {{ $patient->name }}
@endsection
@if (env('APP_NAME') == 'GEN')
    @includeFirst(['patient.custom.generalist.view', 'patient.specialty.generalist.view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['patient.custom.pediatre.view', 'patient.specialty.pediatre.view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['patient.custom.ophtamologie.view', 'patient.specialty.ophtamologie.view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['patient.custom.dentiste.view', 'patient.specialty.dentiste.view'])
@endif
