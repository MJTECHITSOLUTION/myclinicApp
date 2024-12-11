@extends('layouts.master')

@section('title')
    Modifier service
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['payment.custom.generalist_create', 'payment.specialty.generalist.edit'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['payment.custom.pediatre_create', 'payment.specialty.pediatre.edit'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['payment.custom.ophtamologie_create', 'payment.specialty.ophtamologie.edit'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['payment.custom.dentiste_create', 'payment.specialty.dentiste.edit'])
@endif
