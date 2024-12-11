@extends('layouts.master')

@section('title')
    {{ __('sentence.Billing List') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['billing.custom.generalist_edit', 'billing.specialty.generalist.all'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['billing.custom.pediatre_edit', 'billing.specialty.pediatre.all'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['billing.custom.pediatre_create', 'billing.specialty.ophtamologie.all'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['billing.custom.dentiste_create', 'billing.specialty.dentiste.all'])
@endif
