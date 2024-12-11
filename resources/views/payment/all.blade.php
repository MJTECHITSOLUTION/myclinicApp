@extends('layouts.master')

@section('title')
    Les paiements
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['payment.custom.generalist_create', 'payment.specialty.generalist.all'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['payment.custom.pediatre_create', 'payment.specialty.pediatre.all'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['payment.custom.ophtamologie_create', 'payment.specialty.ophtamologie.all'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['payment.custom.dentiste_create', 'payment.specialty.dentiste.all'])
@endif
