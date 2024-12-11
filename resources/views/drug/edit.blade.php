@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Drug') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['drug.custom.generalist_create', 'drug.specialty.generalist.edit'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['drug.custom.pediatre_create', 'drug.specialty.pediatre.edit'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['drug.custom.ophtamologie_create', 'drug.specialty.ophtamologie.edit'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['drug.custom.dentiste_create', 'drug.specialty.dentiste.edit'])
@endif
