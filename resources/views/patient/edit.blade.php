@extends('layouts.master')
@section('title')
    {{ __('sentence.Edit Patient') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['patient.custom.generalist_create', 'patient.specialty.generalist.edit'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['patient.custom.pediatre_create', 'patient.specialty.pediatre.edit'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['patient.custom.ophtamologie_create', 'patient.specialty.ophtamologie.edit'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['patient.custom.dentiste_create', 'patient.specialty.dentiste.edit'])
@endif
