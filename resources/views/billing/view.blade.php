@extends('layouts.master')

@section('title')
    Afficher la facturation
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['billing.custom.generalist_edit', 'billing.specialty.generalist.view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['billing.custom.pediatre_edit', 'billing.specialty.pediatre.view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['billing.custom.pediatre_create', 'billing.specialty.ophtamologie.view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['billing.custom.dentiste_create', 'billing.specialty.dentiste.view'])
@endif
