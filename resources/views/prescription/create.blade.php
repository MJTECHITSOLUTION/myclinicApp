@extends('layouts.master')
@section('title')
    {{ __('sentence.New Prescription') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_create', 'prescription.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_create', 'prescription.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.ophtamologie_create', 'prescription.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_create', 'prescription.specialty.dentiste.create'])
@endif
