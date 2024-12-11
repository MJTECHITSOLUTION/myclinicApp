@extends('layouts.master')

@section('title')
    {{ __('sentence.All analyses') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['analyse.custom.generalist_all', 'analyse.specialty.generalist.all'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['analyse.custom.pediatre_all', 'analyse.specialty.pediatre.all'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['analyse.custom.ophtamologie_all', 'analyse.specialty.ophtamologie.all'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['analyse.custom.dentiste_all', 'analyse.specialty.dentiste.all'])
@endif
