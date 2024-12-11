@extends('layouts.master')

@section('title')
    {{ __('sentence.All Drugs') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['drug.custom.generalist_create', 'drug.specialty.generalist.all'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['drug.custom.pediatre_create', 'drug.specialty.pediatre.all'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['drug.custom.ophtamologie_create', 'drug.specialty.ophtamologie.all'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['drug.custom.dentiste_create', 'drug.specialty.dentiste.all'])
@endif
