@extends('layouts.master')
@section('title')
    {{ __('sentence.View Prescription') }}
@endsection
@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_edit', 'prescription.specialty.generalist.view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_edit', 'prescription.specialty.pediatre.view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.ophtamologie_edit', 'prescription.specialty.ophtamologie.view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_edit', 'prescription.specialty.dentiste.view'])
@endif
