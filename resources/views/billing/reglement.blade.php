@extends('layouts.master')

@section('title')
    Reglement
@endsection




@if (env('APP_NAME') == 'GEN')
    @includeFirst(['billing.custom.generalist_reglement', 'billing.specialty.generalist.reglement'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['billing.custom.pediatre_reglement', 'billing.specialty.pediatre.reglement'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['billing.custom.pediatre_reglement', 'billing.specialty.ophtamologie.reglement'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['billing.custom.dentiste_reglement', 'billing.specialty.dentiste.reglement'])
@endif
