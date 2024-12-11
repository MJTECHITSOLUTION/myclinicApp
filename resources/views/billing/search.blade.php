@extends('layouts.master')

@section('title')
    {{ __('sentence.Billing List') }}
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['billing.custom.generalist_search', 'billing.specialty.generalist.search'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['billing.custom.pediatre_search', 'billing.specialty.pediatre.search'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['billing.custom.pediatre_search', 'billing.specialty.ophtamologie.search'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['billing.custom.dentiste_search', 'billing.specialty.dentiste.search'])
@endif
