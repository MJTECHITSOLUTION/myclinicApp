@extends('layouts.master')

@section('title')
    {{ __('sentence.Create Invoice') }}
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['billing.custom.generalist_edit', 'billing.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['billing.custom.pediatre_edit', 'billing.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['billing.custom.pediatre_create', 'billing.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['billing.custom.dentiste_create', 'billing.specialty.dentiste.create'])
@endif
