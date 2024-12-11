@extends('layouts.master')

@section('title')
    {{ __('sentence.All Prescriptions') }}
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_all', 'prescription.specialty.generalist.all'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_all', 'prescription.specialty.pediatre.all'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.ophtamologie_all', 'prescription.specialty.ophtamologie.all'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_all', 'prescription.specialty.dentiste.all'])
@endif
