@extends('layouts.master')
@section('title')
    {{ __('sentence.New Prescription') }}
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['rapport.custom.generalist_create', 'rapport.specialty.generalist.edit'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['rapport.custom.pediatre_create', 'rapport.specialty.pediatre.edit'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['rapport.custom.ophtamologie_create', 'rapport.specialty.ophtamologie.edit'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['rapport.custom.dentiste_create', 'rapport.specialty.dentiste.edit'])
@endif
