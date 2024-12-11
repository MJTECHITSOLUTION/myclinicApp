@extends('layouts.master')

@section('title')
    {{ $patient->name }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['analyse.custom.generalist_view', 'analyse.specialty.generalist.view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['analyse.custom.pediatre_view', 'analyse.specialty.pediatre.view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['analyse.custom.ophtamologie_view', 'analyse.specialty.ophtamologie.view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['analyse.custom.dentiste_view', 'analyse.specialty.dentiste.view'])
@endif
