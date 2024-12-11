@extends('layouts.master')

@section('title')
    {{ __('sentence.Doctorino Settings') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Doctorino Settings') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('doctorino_settings.store') }}" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="system_name" class="col-sm-3 col-form-label">{{ __('sentence.System Name') }}
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="system_name"
                                    name="system_name" value="{{ App\Setting::get_option('system_name') }}" required>
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Title" class="col-sm-3 col-form-label">{{ __('sentence.Title') }}</label>
                            <div class="col-sm-9">
                                <input type="title" class="form-control rounded-0 shadow-none " id="Title"
                                    name="title" value="{{ App\Setting::get_option('title') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ville" class="col-sm-3 col-form-label">Arabic nome</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="nomearabic"
                                    name="nomearabic" lang="ar" dir="rtl"
                                    value="{{ App\Setting::get_option('nomearabic') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label">{{ __('sentence.Logo') }}</label>
                            <div class="col-sm-9">
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Sélectionnez le logo à importer
                                </label>
                                <input type="file" class="form-control rounded-0 shadow-none " id="file-upload"
                                    name="logo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label">En-tête de page</label>
                            <div class="col-sm-9">
                                <label for="file-rapport" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Sélectionnez en-tête de page à importer
                                </label>
                                <input type="file" class="form-control rounded-0 shadow-none " id="file-rapport" name="imagerapport">

                                <label for="use-header" class="ml-3 mr-2">Utiliser l'en-tête de page:</label>
                                <input type="radio" id="use-header-yes" name="use_entete" value="yes" {{ (App\Setting::get_option('use_entete') === 'yes') ? 'checked' : '' }}>
                                <label for="use-header-yes" class="mr-2">Oui</label>
                                <input type="radio" id="use-header-no" name="use_entete" value="no" {{ (App\Setting::get_option('use_entete') === 'no') ? 'checked' : '' }}>
                                <label for="use-header-no">Non</label>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label">Pied de page</label>
                            <div class="col-sm-9">
                                <label for="pied-rapport" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Sélectionnez Pied de page à importer
                                </label>
                                <input type="file" class="form-control rounded-0 shadow-none " id="pied-rapport"
                                    name="piedrapport">
                                <label for="use-header" class="ml-3 mr-2">Utiliser pied de page:</label>
                                <input type="radio" id="use-header" name="use_pied" value="yes" {{ (App\Setting::get_option('use_pied') === 'yes') ? 'checked' : '' }}>
                                <label for="use-header" class="mr-2">Oui</label>
                                <input type="radio" id="use-header" name="use_pied" value="no" {{ (App\Setting::get_option('use_pied') === 'no') ? 'checked' : '' }}>
                                <label for="use-header">Non</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Address" class="col-sm-3 col-form-label">{{ __('sentence.Address') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="Address"
                                    name="address" value="{{ App\Setting::get_option('address') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ville" class="col-sm-3 col-form-label">Ville</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="ville"
                                    name="ville" value="{{ App\Setting::get_option('ville') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ice" class="col-sm-3 col-form-label">ICE</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none" id="ice"
                                       name="ice" value="{{ App\Setting::get_option('ice') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inp" class="col-sm-3 col-form-label">INP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none" id="inp"
                                       name="inp" value="{{ App\Setting::get_option('inp') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="if" class="col-sm-3 col-form-label">IF</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none" id="if"
                                       name="if" value="{{ App\Setting::get_option('if') }}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Phone" class="col-sm-3 col-form-label">{{ __('sentence.Phone') }} </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="Phone"
                                    name="phone" value="{{ App\Setting::get_option('phone') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hospital_email"
                                class="col-sm-3 col-form-label">{{ __('sentence.Hospital Email') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="hospital_email"
                                    name="hospital_email" value="{{ App\Setting::get_option('hospital_email') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Currency" class="col-sm-3 col-form-label">{{ __('sentence.Currency') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="Currency"
                                    name="currency" value="{{ App\Setting::get_option('currency') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Currency" class="col-sm-3 col-form-label">{{ __('sentence.VAT') }}</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control rounded-0 shadow-none " id="Currency"
                                    name="vat" value="{{ App\Setting::get_option('vat') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Currency" class="col-sm-3 col-form-label">Montant consultation</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control rounded-0 shadow-none " id="montant"
                                    name="montant" value="{{ App\Setting::get_option('montant') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Language" class="col-sm-3 col-form-label">{{ __('sentence.Language') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control rounded-0 shadow-none " name="language" id="Language"
                                    required>
                                    <option value="{{ App\Setting::get_option('language') }}">
                                        {{ $language[App\Setting::get_option('language')] }}</option>
                                    <option value="en">English</option>
                                    <option value="fr">French</option>
                                    <option value="ar">Arabic</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="appointment_interval"
                                class="col-sm-3 col-form-label">{{ __('sentence.Appointment Interval') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control rounded-0 shadow-none " name="appointment_interval"
                                    id="appointment_interval" required>
                                    <option value="{{ App\Setting::get_option('appointment_interval') }}">
                                        {{ App\Setting::get_option('appointment_interval') }} mn</option>
                                    <option value="10">10 mn</option>
                                    <option value="15">15 mn</option>
                                    <option value="20">20 mn</option>
                                    <option value="25">25 mn</option>
                                    <option value="30">30 mn</option>
                                    <option value="35">35 mn</option>
                                    <option value="40">40 mn</option>
                                    <option value="45">45 mn</option>
                                    <option value="50">50 mn</option>
                                    <option value="55">55 mn</option>
                                    <option value="60">60 mn</option>
                                </select>
                                <small id="emailHelp"
                                    class="form-text text-muted">{{ __('sentence.Modifying the interval will distort the dates of the appointments') }}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Monday"
                                class="col-sm-4 col-md-3 col-form-label">{{ __('sentence.Monday') }}</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Monday"
                                    name="monday_from_morning" value="{{ App\Setting::get_option('monday_from_morning') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Monday"
                                    name="monday_to_morning" value="{{ App\Setting::get_option('monday_to_morning') }}">
                            </div>
                            <div>
                                <hr class="vertical-line">
                            </div>
{{--                            duplicated form group--}}
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Monday"
                                       name="monday_from_evening" value="{{ App\Setting::get_option('monday_from_evening') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Monday"
                                       name="monday_to_evening" value="{{ App\Setting::get_option('monday_to_evening') }}">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="Tuesday"
                                class="col-sm-4 col-md-3 col-form-label">{{ __('sentence.Tuesday') }}</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Tuesday"
                                    name="tuesday_from_morning" value="{{ App\Setting::get_option('tuesday_from_morning') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Tuesday"
                                    name="tuesday_to_morning" value="{{ App\Setting::get_option('tuesday_to_morning') }}">
                            </div>

                            <div>
                                <hr class="vertical-line">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Tuesday"
                                       name="tuesday_from_evening" value="{{ App\Setting::get_option('tuesday_from_evening') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Tuesday"
                                       name="tuesday_to_evening" value="{{ App\Setting::get_option('tuesday_to_evening') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Wednseday"
                                class="col-sm-4 col-md-3 col-form-label">{{ __('sentence.Wednseday') }}</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Wednseday"
                                    name="wednesday_from_morning" value="{{ App\Setting::get_option('wednesday_from_morning') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Wednseday"
                                    name="wednesday_to_morning" value="{{ App\Setting::get_option('wednesday_to_morning') }}">
                            </div>

                            <div>
                                <hr class="vertical-line">
                            </div>

                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Wednseday"
                                       name="wednesday_from_evening" value="{{ App\Setting::get_option('wednesday_from_evening') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Wednseday"
                                       name="wednesday_to_evening" value="{{ App\Setting::get_option('wednesday_to_evening') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Thurday"
                                class="col-sm-4 col-md-3 col-form-label">{{ __('sentence.Thurday') }}</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Thurday"
                                    name="thursday_from_morning" value="{{ App\Setting::get_option('thursday_from_morning') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Thurday"
                                    name="thursday_to_morning" value="{{ App\Setting::get_option('thursday_to_morning') }}">
                            </div>

                            <div>
                                <hr class="vertical-line">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Thurday"
                                       name="thursday_from_evening" value="{{ App\Setting::get_option('thursday_from_evening') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Thurday"
                                       name="thursday_to_evening" value="{{ App\Setting::get_option('thursday_to_evening') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Friday"
                                class="col-sm-4 col-md-3 col-form-label">{{ __('sentence.Friday') }}</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Friday"
                                    name="friday_from_morning" value="{{ App\Setting::get_option('friday_from_morning') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Friday"
                                    name="friday_to_morning" value="{{ App\Setting::get_option('friday_to_morning') }}">
                            </div>
                            <div>
                                <hr class="vertical-line">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Friday"
                                       name="friday_from_evening" value="{{ App\Setting::get_option('friday_from_evening') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Friday"
                                       name="friday_to_evening" value="{{ App\Setting::get_option('friday_to_evening') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Saturday"
                                   class="col-sm-4 col-md-3 col-form-label">{{ __('sentence.Saturday') }}</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Saturday"
                                       name="saturday_from_morning" value="{{ App\Setting::get_option('saturday_from_morning') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Saturday"
                                       name="saturday_to_morning" value="{{ App\Setting::get_option('saturday_to_morning') }}">
                            </div>
                            <div>
                                <hr class="vertical-line">
                            </div>
{{--                            evining--}}
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Saturday"
                                       name="saturday_from_evening" value="{{ App\Setting::get_option('saturday_from_evening') }}">
                            </div>
                            <div class="col-sm-4 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none " id="Saturday"
                                       name="saturday_to_evening" value="{{ App\Setting::get_option('saturday_to_evening') }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <!-- Original form group -->
                            <label for="Sunday" class="col-sm-4 col-md-3 col-form-label">{{ __('sentence.Sunday') }}</label>
                            <div class="col-sm-2 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none" id="Sunday" name="sunday_from_morning" value="{{ App\Setting::get_option('sunday_from_morning') }}">
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none" id="Sunday" name="sunday_to_morning" value="{{ App\Setting::get_option('sunday_to_morning') }}">
                            </div>


                            <div>
                                <hr class="vertical-line">
                            </div>
                            <!-- Duplicated form group -->
                            <div class="col-sm-2 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none" id="Sunday" name="sunday_from_evening" value="{{ App\Setting::get_option('sunday_from_evening') }}">
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <input type="time" class="form-control rounded-0 shadow-none" id="Sunday" name="sunday_to_evening" value="{{ App\Setting::get_option('sunday_to_evening') }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit"
                                    class="btn rounded-0  btn-primary">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
        .vertical-line {
            border-right: 1px solid #000; /* Adjust thickness and color as needed */
            height: 140%;
            margin-bottom: 10px;
        }

    </style>
@endsection

@section('footer')
@endsection
