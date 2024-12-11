@extends('layouts.master')

@section('title')
    {{ $patient->name }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['radio.custom.generalist_create', 'radio.specialty.generalist.view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['radio.custom.pediatre_create', 'radio.specialty.pediatre.view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['radio.custom.ophtamologie_create', 'radio.specialty.ophtamologie.view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['radio.custom.dentiste_create', 'radio.specialty.dentiste.view'])
@endif
