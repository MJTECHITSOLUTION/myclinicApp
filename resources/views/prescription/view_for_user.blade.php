@extends('layouts.master')

@section('title')
    {{ __('sentence.All Prescriptions') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_edit', 'prescription.specialty.generalist.view_for_user'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_edit', 'prescription.specialty.pediatre.view_for_user'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.ophtamologie_edit','prescription.specialty.ophtamologie.view_for_user'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_edit','prescription.specialty.dentiste.view_for_user'])
@endif
