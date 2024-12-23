@extends('layouts.master')

@section('title')
    {{ __('sentence.Prescription Settings') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Prescription Settings') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('prescription_settings.store') }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">En-tête (gauche)</label>
                                <textarea class="form-control rounded-0 shadow-none " id="inputPassword4" name="header_left">{{ App\Setting::get_option('header_left') }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">En-tête (droite)</label>
                                <textarea class="form-control rounded-0 shadow-none " id="inputPassword4" name="header_right">{{ App\Setting::get_option('header_right') }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Pied de page (gauche)</label>
                                <textarea class="form-control rounded-0 shadow-none " id="inputPassword4" name="footer_left">{{ App\Setting::get_option('footer_left') }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Pied de page (droite)</label>
                                <textarea class="form-control rounded-0 shadow-none " id="inputPassword4" name="footer_right">{{ App\Setting::get_option('footer_right') }}</textarea>
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn rounded-0  btn-primary">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
@endsection

@section('footer')
@endsection
