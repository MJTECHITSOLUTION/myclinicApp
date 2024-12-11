@extends('layouts.master')

@section('title')
    Ajoute Radio
@endsection

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['radio.custom.generalist_create', 'radio.specialty.generalist.create'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['radio.custom.pediatre_create', 'radio.specialty.pediatre.create'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['radio.custom.ophtamologie_create', 'radio.specialty.ophtamologie.create'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['radio.custom.dentiste_create', 'radio.specialty.dentiste.create'])
@endif
