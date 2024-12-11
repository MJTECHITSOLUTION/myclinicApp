@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection



@if (env('APP_NAME') == 'GEN')
    @includeFirst(['patient.custom.generalist_create', 'patient.specialty.generalist.search'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['patient.custom.pediatre_create', 'patient.specialty.pediatre.search'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['patient.custom.ophtamologie_create', 'patient.specialty.ophtamologie.search'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['patient.custom.dentiste_create', 'patient.specialty.dentiste.search'])
@endif
