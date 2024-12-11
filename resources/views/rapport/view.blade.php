@extends('layouts.master')
@section('title')
    {{ __('sentence.New Prescription') }}
@endsection



@if (env('APP_NAME') == 'GEN')
    @includeFirst(['rapport.custom.generalist_create', 'rapport.specialty.generalist.view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['rapport.custom.pediatre_create', 'rapport.specialty.pediatre.view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['rapport.custom.ophtamologie_create', 'rapport.specialty.ophtamologie.view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['rapport.custom.dentiste_create', 'rapport.specialty.dentiste.view'])
@endif
