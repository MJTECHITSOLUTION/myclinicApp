@extends('layouts.master')

@section('title')
    {{ __('sentence.Add assurance') }}
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['assurance.custom.generalist_all', 'assurance.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['assurance.custom.pediatre_all', 'assurance.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['assurance.custom.pediatre_create', 'assurance.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['assurance.custom.dentiste_create', 'assurance.specialty.dentiste.create'])
@endif
