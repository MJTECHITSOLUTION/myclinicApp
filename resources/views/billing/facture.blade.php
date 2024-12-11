@extends('layouts.master')

@section('title')
    Facture
@endsection
@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_facture', 'prescription.specialty.generalist.facture'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_facture', 'prescription.specialty.pediatre.facture'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.ophtamologie_facture', 'prescription.specialty.ophtamologie.facture'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_facture', 'prescription.specialty.dentiste.facture'])
@endif
