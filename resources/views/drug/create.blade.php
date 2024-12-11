@extends('layouts.master')

@section('title')
    {{ __('sentence.Add Drug') }}
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['drug.custom.generalist_create', 'drug.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['drug.custom.pediatre_create', 'drug.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['drug.custom.ophtamologie_create', 'drug.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['drug.custom.dentiste_create', 'drug.specialty.dentiste.create'])
@endif
