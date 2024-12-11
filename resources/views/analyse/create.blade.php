@extends('layouts.master')

@section('title')
    {{ __('sentence.Add analyse') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['analyse.custom.generalist_create', 'analyse.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['analyse.custom.pediatre_create', 'analyse.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['analyse.custom.ophtamologie_create', 'analyse.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['analyse.custom.dentiste_create', 'analyse.specialty.dentiste.create'])
@endif
