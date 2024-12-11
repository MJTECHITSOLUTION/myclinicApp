@extends('layouts.master')
@section('title')
    Nouvelle Rapport
@endsection


@if (env('APP_NAME') == 'GEN')
    @includeFirst(['rapport.custom.generalist_create', 'rapport.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['rapport.custom.pediatre_create', 'rapport.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['rapport.custom.ophtamologie_create', 'rapport.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['rapport.custom.dentiste_create', 'rapport.specialty.dentiste.create'])
@endif
