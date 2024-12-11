@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Invoice') }}
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['billing.custom.generalist_edit', 'billing.specialty.generalist.edit'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['billing.custom.pediatre_edit', 'billing.specialty.pediatre.edit'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['billing.custom.pediatre_create', 'billing.specialty.ophtamologie.edit'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['billing.custom.dentiste_create', 'billing.specialty.dentiste.edit'])
@endif
