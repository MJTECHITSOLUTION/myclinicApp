@extends('layouts.master')

@section('title')
    {{ $patient->name }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['payment.custom.generalist_create', 'payment.specialty.generalist.view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['payment.custom.pediatre_create', 'payment.specialty.pediatre.view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['payment.custom.ophtamologie_create', 'payment.specialty.ophtamologie.view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['payment.custom.dentiste_create', 'payment.specialty.dentiste.view'])
@endif
