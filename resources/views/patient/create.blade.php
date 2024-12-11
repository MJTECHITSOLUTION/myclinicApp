@extends('layouts.master')
@section('title')
    {{ __('sentence.New Patient') }}
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['patient.custom.generalist_create', 'patient.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['patient.custom.pediatre_create', 'patient.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['patient.custom.ophtamologie_create', 'patient.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['patient.custom.dentiste_create', 'patient.specialty.dentiste.create'])
@endif
