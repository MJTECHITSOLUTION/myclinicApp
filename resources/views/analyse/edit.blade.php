@extends('layouts.master')

@section('title')
    {{ __('sentence.edit analyse') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['analyse.custom.generalist_edit', 'analyse.specialty.generalist.edit'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['analyse.custom.pediatre_edit', 'analyse.specialty.pediatre.edit'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['analyse.custom.ophtamologie_edit', 'analyse.specialty.ophtamologie.edit'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['analyse.custom.dentiste_edit', 'analyse.specialty.dentiste.edit'])
@endif
