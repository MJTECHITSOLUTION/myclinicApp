@extends('layouts.master')

@section('title')
    {{ __('sentence.All Prescriptions') }}
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_search', 'prescription.specialty.generalist.search'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_search', 'prescription.specialty.pediatre.search'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.pediatre_search', 'prescription.specialty.ophtamologie.search'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_search', 'prescription.specialty.dentiste.search'])
@endif
