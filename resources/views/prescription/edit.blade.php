@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Prescription') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_edit', 'prescription.specialty.generalist.edit'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_edit', 'prescription.specialty.pediatre.edit'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.ophtamologie_edit', 'prescription.specialty.ophtamologie.edit'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_edit', 'prescription.specialty.dentiste.edit'])
@endif
