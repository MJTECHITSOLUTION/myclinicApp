@extends('layouts.master')
@section('title')
    {{ __('sentence.View Prescription') }}
@endsection
@section('content')
    @if (!empty($prescription))
        <div class=" col-11 d-flex justify-content-end">
            <a href="{{ url('prescription/edit/' . $prescription->id) }}" class="btn rounded-0 btn-success"
                style="margin-right:20px;" title="Modifier"><i class="fa fa-edit"></i><span
                    class="d-none d-md-inline-block my__label ml-1">
                    Modifier</span></a>
            <a href="{{ route('prescription.create') }}" class="btn rounded-0 btn-primary" style="margin-right:20px;"
                title=" {{ __('sentence.New Prescription') }}"><i class="fa fa-plus"></i><span
                    class="d-none d-md-inline-block my__label ml-1">
                    {{ __('sentence.New Prescription') }}</span></a>
            <a href="{{ route('prescription.all') }}" class="btn rounded-0 btn-warning" style="margin-right:20px;"
                title="{{ __('sentence.All Prescriptions') }}"><i class="fa fa-calendar"></i><span
                    class="d-none d-md-inline-block my__label ml-1">
                    {{ __('sentence.All Prescriptions') }}</span></a>
            @if (!empty($billingEntry))
{{--                <a href="{{ url('billing/edit/' . $billingEntry->id) }}" class="btn rounded-0 btn-outline-info"--}}
{{--                    style="margin-right:20px;" title=" Modifier facture"> <i class="fa fa-Modifier"></i><span--}}
{{--                        class="d-none d-md-inline-block my__label ml-1">--}}
{{--                        Modifier--}}
{{--                        facture</span></a>--}}
                <a href="{{ url('billing/view/' . $billingEntry->id) }}" class="btn rounded-0 btn-outline-secondary"
                    style="margin-right:20px;" title="Imprimer facture"> <span
                        class="d-none d-md-inline-block my__label ml-1"> Imprimer
                        facture</span></a>
            @else
                <a href="{{ url('billing/create') . '?p=' . $prescription->id . '&u=' . $prescription->user_id }}"
                    class="btn rounded-0 btn-dark" title="Nouvelle facture"> <i class="fa fa-plus"></i>
                    <span class="d-none d-md-inline-block my__label ml-1">Nouvelle
                        facture</span></a>
            @endif
        </div>
        <br>

        @if (count($prescription_drugs) > 0)
            <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5><strong><u>Ordonnance </u></strong></h5>
                        <button href=""
                            class=" d-sm-inline-block btn btn-sm rounded-0 my-btn   rounded-0 btn-info shadow-sm print_prescription"><i
                                class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-sm-inline-block">Imprimer</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">
                                {{--                            @if (!empty(App\Setting::get_option('logo'))) --}}
                                {{--                                <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" alt="Logo"><br><br> --}}
                                {{--                            @endif --}}
                                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d-m-Y') }}
                                </p>
                                <p><b>{{ __('sentence.Reference') }} :</b> {{ $prescription->reference }}</p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <!-- ROW: Patient informations -->
                        <div class="row">
                            <div class="col">
                                <p>
                                    <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                                </p>
                                <hr>
                            </div>
                        </div>
                        <!-- END ROW: Patient informations -->
                        @if (count($prescription_drugs) > 0)
                            <!-- ROW: Drugs List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <strong><u>{{ __('sentence.medicament') }} </u></strong><br><br>
                                    @foreach ($prescription_drugs as $drug)
                                        <li>{{ $drug->Drug->trade_name }} {{ $drug->strength }}<br>
                                            {{ $drug->drug_advice }}</li>
                                        @if ($loop->last)
                                            <div style="margin-bottom: 40px;"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        {{--                    @if (count($prescription_tests) > 0) --}}
                        {{--                        <!-- ROW: Tests List --> --}}
                        {{--                        <div class="row justify-content-center"> --}}
                        {{--                            <div class="col"> --}}
                        {{--                                <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br> --}}
                        {{--                                @foreach ($prescription_tests as $test) --}}
                        {{--                                    <li>{{ $test->Test->test_name }} @empty(!$test->analyse_name) - {{ $test->analyse_name }} @endempty</li> --}}
                        {{--                                    @empty(!$test->description)  <p>Remarques : {{ $test->description }} </p> @endempty --}}
                        {{--                                    <br> --}}
                        {{--                                    @if ($loop->last) --}}
                        {{--                                        <br> --}}
                        {{--                                        <br> --}}
                        {{--                                        <div style="margin-bottom: 40px;"> --}}
                        {{--                                            <b>{{ __('sentence.observation') }} :</b> {{ $prescription->observation }} --}}
                        {{--                                            @isset($prescription->observation) --}}
                        {{--                                            @endisset --}}
                        {{--                                        </div> --}}
                        {{--                                        <hr> --}}
                        {{--                                    @endif --}}
                        {{--                                @endforeach --}}
                    </div>

                </div>

                {{-- OBSERVATION --}}

                <!-- END ROW: Tests List -->
                {{--                    @endif --}}
                @if (!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
                    <!-- ROW: Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                        </div>
                        <div class="col">
                            <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                        </div>
                    </div>
                    <!-- END ROW: Footer informations -->
                @elseif(empty(App\Setting::get_option('footer_left')))
                    <!-- ROW: Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                        </div>
                    </div>
                    <!-- END ROW: Footer informations -->
                @elseif(empty(App\Setting::get_option('footer_right')))
                    <!-- ROW: Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                        </div>
                    </div>
                    <!-- END ROW: Footer informations -->
                @else
                @endif
            </div>
        </div>
    @endif
    @endif
    @if (count($prescription_tests) > 0)
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <div id="print_analysee">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5><strong> <u>Analyses médicales </u></strong></h5>
                        <button href=""
                            class=" d-sm-inline-block btn  rounded-0 btn-sm btn-info shadow-sm print_analyse"><i
                                class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-sm-inline-block">Imprimer</span>
                        </button>
                    </div>
                    <div class="card-body">


                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">
                                {{--                                @if (!empty(App\Setting::get_option('logo'))) --}}
                                {{--                                    <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" alt="Logo"><br><br> --}}
                                {{--                                @endif --}}
                                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d-m-Y') }}
                                </p>
                                <p><b>{{ __('sentence.Reference') }} :</b> {{ $prescription->reference }}</p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <!-- ROW: Patient informations -->
                        <div class="row">
                            <div class="col">
                                <hr>
                                <p>
                                    <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                                </p>
                                <hr>
                            </div>
                        </div>

                        @if (count($prescription_tests) > 0)
                            <!-- ROW: Tests List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
                                    @foreach ($prescription_tests as $test)
                                        <li>
                                            @empty(!$test->analyse_name)
                                                {{ $test->analyse_name }}
                                            @endempty
                                        </li>
                                        @empty(!$test->description)
                                            <p> {{ $test->description }} </p>
                                        @endempty
                                        <br>
                                        @if ($loop->last)
                                            <br>
                                            <br>
                                            <div style="margin-bottom: 40px;">
                                                {{--                                            <b>{{ __('sentence.observation') }} :</b> {{ $prescription->observation }} --}}
                                                {{--                                            @isset($prescription->observation) --}}
                                                {{--                                            @endisset --}}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>

                            {{-- OBSERVATION --}}

                            <!-- END ROW: Tests List -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div id="print_ophtalmologie">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5><strong><u>Examen clinique </u></strong></h5>
                        <button href=""
                            class=" d-sm-inline-block btn  rounded-0 btn-sm btn-info shadow-sm print_ophtal"><i
                                class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-sm-inline-block">Imprimer</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">
                            </div>
                            <div class="col-md-3">
                                <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d-m-Y') }}
                                </p>
                                <p><b>{{ __('sentence.Reference') }} :</b> {{ $prescription->reference }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <hr>
                                <p>
                                    <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                                </p>
                                <hr>
                            </div>
                        </div>
                        <!-- ROW: Tests List -->
                        <p><b>AV(vision de loin)</b></p>
                        <ul>
                            <li>Sans correction :
                                <ul>
                                    <li> OD: {{ $prescription->av_vl_od_s }}/10</li>
                                    <li> OG: {{ $prescription->av_vl_og_s }}/10</li>
                                </ul>
                            </li>
                            <li>Avec correction :
                                <ul>
                                    <li>OD: {{ $prescription->av_vl_od_a }}/10</li>
                                    <li> OG: {{ $prescription->av_vl_og_a }}/10</li>
                                </ul>
                            </li>
                        </ul>
                        <p><b>AV(vision de près)</b></p>
                        <ul>
                            <li>OD: {{ $prescription->av_vp_od }} </li>
                            <li> OG: {{ $prescription->av_vp_og }}</li>
                        </ul>

                        <p><b>SA(segment antérieur)</b></p>
                        <ul>
                            <li>OD: {{ $prescription->sa_od }} </li>
                            <li> OG: {{ $prescription->sa_og }}</li>
                        </ul>

                        <p><b>TO(tonus oculaire)</b></p>
                        <ul>
                            <li>OD: {{ $prescription->to_od }} </li>
                            <li> OG: {{ $prescription->to_og }}</li>
                        </ul>

                        <p><b>FO(fond d'oeil)</b></p>
                        <ul>
                            <li>OD: {{ $prescription->fo_od }} </li>
                            <li> OG: {{ $prescription->fo_og }}</li>
                        </ul>

                        <p><b>Réfraction</b></p>
                        <ul>
                            <li>OD: {{ $prescription->ref_od }} </li>
                            <li> OG: {{ $prescription->ref_og }}</li>
                        </ul>



                        <p><b>Annexes</b></p>
                        <ul>
                            <li>OD: {{ $prescription->annex_od }}</li>
                            <li> OG: {{ $prescription->annex_og }}</li>
                        </ul>
                        <br>
                        <ul><b> Verres + monture</b></ul>
                        @isset($prescription->verre_ar)
                            <li>{{ $prescription->verre_ar }}</li>
                        @endisset
                        @isset($prescription->verre_lb)
                            <li>{{ $prescription->verre_lb }}</li>
                        @endisset
                        @isset($prescription->verre_uv)
                            <li>{{ $prescription->verre_uv }}</li>
                        @endisset
                        @isset($prescription->verre_pro)
                            <li>{{ $prescription->verre_pro }}</li>
                        @endisset
                        @isset($prescription->verre_phog)
                            <li>{{ $prescription->verre_phog }}</li>
                        @endisset
                        <br>
                        <br>
                        <p><b>Commentaire</b></p>
                        <textarea class="form-control" id="rapport" name="rapport" rows="5" placeholder=""
                            value="{{ $prescription->rapport }}" readonly>{{ $prescription->rapport }}</textarea>

                        {{-- OBSERVATION --}}

                        <!-- END ROW: Tests List -->
                    </div>
                </div>
            </div>
        </div>
    </div>









    @if (count($prescription_radios) > 0)

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <div id="print_radioo">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5><strong><u>Radio </u></strong></h5>

                        <button href=""
                            class=" d-sm-inline-block btn btn-sm rounded-0 btn-info shadow-sm print_radio"><i
                                class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-sm-inline-block">Imprimer</span>
                        </button>
                    </div>
                    <div class="card-body">


                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">
                                {{--                                @if (!empty(App\Setting::get_option('logo'))) --}}
                                {{--                                    <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" alt="Logo"><br><br> --}}
                                {{--                                @endif --}}
                                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d-m-Y') }}
                                </p>
                                <p><b>{{ __('sentence.Reference') }} :</b> {{ $prescription->reference }}</p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <!-- ROW: Patient informations -->
                        <div class="row">
                            <div class="col">
                                <hr>
                                <p>
                                    <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                                </p>
                                <hr>
                            </div>
                        </div>

                        @if (count($prescription_radios) > 0)
                            <!-- ROW: Tests List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <strong><u>Faire SVP </u></strong><br><br>
                                    @foreach ($prescription_radios as $radio)
                                        <li>
                                            @empty(!$radio->radio_name)
                                                {{ $radio->radio_name }}
                                            @endempty
                                        </li>
                                        @empty(!$radio->justif)
                                            <p> {!! nl2br(e($radio->justif)) !!} </p>
                                        @endempty
                                        <br>
                                        @if ($loop->last)
                                            <br>
                                            <br>
                                            <div style="margin-bottom: 40px;">
                                                {{--                                            <b>{{ __('sentence.observation') }} :</b> {{ $prescription->observation }} --}}
                                                {{--                                            @isset($prescription->observation) --}}
                                                {{--                                            @endisset --}}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>

                            {{-- OBSERVATION --}}

                            <!-- END ROW: Tests List -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @empty(!$prescription->certificat)
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
        </div>
        <div id="print_certii">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-end">


                            <button href=""
                                class=" d-sm-inline-block btn btn-sm rounded-0 btn-info shadow-sm print_certi"><i
                                    class="fas fa-print fa-sm text-white-50"></i> <span
                                    class="d-none d-sm-inline-block">Imprimer</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <br><br>


                            <!-- ROW: Doctor informations -->
                            <div class="row">
                                <div class="col text-center"><br><br>
                                    <h2 class="mt-400">CERTIFICAT MEDICAL</h2>
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="row mt-400">
                                <div class="col">
                                    <p class="text-left">Je soussigne
                                        <strong>{{ App\Setting::get_option('title') }} </strong>
                                    </p> <br>
                                    <p class="text-left">Avoir examiné ce jour le(a) patient(e) :
                                        <strong> {{ $prescription->User->name }}</strong>
                                    </p> <br>
                                    @isset($prescription->User->Patient->cin)
                                        <p class="text-left">Mr,Mme : <strong> {{ $prescription->User->name }}</strong>
                                            porteur cin <strong>{{ $prescription->User->Patient->cin }}</strong></p><br>
                                    @endisset
                                    <p class="text-left">Et que son état de santé nécessite un repos de
                                        <strong>{{ $prescription->certificat }} </strong>jour(s).
                                    </p> <br>
                                    @if ($prescription->certificat == 1)
                                        <p class="text-left">Le :
                                            <strong>{{ \Carbon\Carbon::parse($prescription->dated)->format('d-m-Y') }}
                                            </strong>
                                            sauf complication(s)
                                        </p>
                                    @endif
                                    @if ($prescription->certificat != 1)
                                        <p class="text-left">A partir du :
                                            <strong>{{ \Carbon\Carbon::parse($prescription->dated)->format('d-m-Y') }}
                                            </strong>
                                            au
                                            <strong>
                                                {{ \Carbon\Carbon::parse($prescription->datef)->format('d-m-Y') }}</strong>
                                            sauf complication(s)
                                        </p>
                                    @endif
                                    <br>
                                    Certificat médical remis a l'intéressé pour faire servir et valoir ce que de droit
                                    <br><br><br>
                                    <p class="text-right" style="margin-right: 200px">Fait à
                                        <strong>{{ App\Setting::get_option('ville') }} </strong>
                                        Le {{ $prescription->created_at->format('d-m-Y') }}
                                    </p> <br><br>
                                    <p class="text-right" style="margin-right: 100px"> Signature et cachet: </p>
                                    <br><br><br><br><br><br>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endempty

    <div id="print_radio" style="display: none;">
        <!-- ROW: Doctor informations -->
        <div class="row">
            <div class="col-9">
                @if (!empty(App\Setting::get_option('logo')))
                    {{--                         <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" alt="Logo"><br><br> --}}
                @endif
                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
            </div>

        </div>
        <!-- END ROW: Doctor informations -->
        <!-- ROW: Patient informations -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br><br><br><br><br>


        <div class="row">
            <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                <br>
                <p>
                    <b style="float: right;">
                        {{ $prescription->created_at->format('d-m-Y') }}</b>
                </p>
                <br> <br>
                <b style="display: block;">{{ $prescription->patient_title }} {{ $prescription->User->name }} </b>
            </div>
        </div>
        <br>

        <!-- END ROW: Patient informations -->
        @if (count($prescription_radios) > 0)
            <!-- ROW: Tests List -->
            <div class="row justify-content-center" style="font-size: xx-large">
                <div class="col">
                    <strong style="margin-left: 100px;"><u>Faire SVP : </u></strong><br><br>
                    @foreach ($prescription_radios as $radio)
                        <b>
                            <li style="margin-left: 120px;">
                                @empty(!$radio->radio_name)
                                    {{ $radio->radio_name }}
                                @endempty
                            </li>
                        </b>
                        @empty(!$radio->justif)
                            <p style="margin-left: 170px;"> {!! nl2br(e($radio->justif)) !!} </p>
                        @endempty
                        <br>
                        @if ($loop->last)
                            <br>
                            <div style="margin-bottom: 40px;">
                                {{--                                            <b>{{ __('sentence.observation') }} :</b> {{ $prescription->observation }} --}}
                                {{--                                            @isset($prescription->observation) --}}
                                {{--                                            @endisset --}}
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>

            {{-- OBSERVATION --}}

            <!-- END ROW: Tests List -->
        @endif


        @if (!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
            <!-- ROW: Footer informations -->
            <div class="row">
                <div class="col">
                    <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                </div>
                <div class="col">
                    <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                </div>
            </div>
            <!-- END ROW: Footer informations -->
        @elseif(empty(App\Setting::get_option('footer_left')))
            <!-- ROW: Footer informations -->
            <div class="row">
                <div class="col">
                    <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                </div>
            </div>
            <!-- END ROW: Footer informations -->
        @elseif(empty(App\Setting::get_option('footer_right')))
            <!-- ROW: Footer informations -->
            <div class="row">
                <div class="col">
                    <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                </div>
            </div>
            <!-- END ROW: Footer informations -->
        @else
        @endif
    </div>

    </div>
    </div>

    </div>
    </div>



    <div id="print_ophtal" style="display: none;">
        <!-- ROW: Doctor informations -->
        <div class="row">
            <div class="col-9">
                @if (!empty(App\Setting::get_option('logo')))
                    {{--                         <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" alt="Logo"><br><br> --}}
                @endif
                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
            </div>

        </div>
        <!-- END ROW: Doctor informations -->
        <!-- ROW: Patient informations -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br><br><br><br><br>


        <div class="row">
            <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                <br>
                <p>
                    <b style="float: right;">
                        {{ $prescription->created_at->format('d-m-Y') }}</b>
                </p>
                <br> <br>
                <b style="display: block;">{{ $prescription->patient_title }} {{ $prescription->User->name }} </b>
            </div>
        </div>
        <br>

        <!-- END ROW: Patient informations -->
        <!-- ROW: Tests List -->
        <div class="row justify-content-center" style="font-size: xx-large">
            <div class="col" style="margin-left: 100px;">
                <br><br>
                <b> Verres + monture :</b>
                @isset($prescription->verre_ar)
                    {{ $prescription->verre_ar }}
                @endisset
                @isset($prescription->verre_lb)
                    -{{ $prescription->verre_lb }}-
                @endisset
                @isset($prescription->verre_uv)
                    {{ $prescription->verre_uv }}-
                @endisset
                @isset($prescription->verre_pro)
                    {{ $prescription->verre_pro }}-
                @endisset
                @isset($prescription->verre_phog)
                    {{ $prescription->verre_phog }}
                @endisset
                <br><br>
                @isset($prescription->ref_od)
                    <strong>VL : </strong>
                    <ul>
                        <li>OD: {{ $prescription->ref_od }} </li>
                        <li> OG: {{ $prescription->ref_og }}</li>
                    </ul>
                @endisset
                <br>
                @isset($prescription->addition)
                    <b>VP : Addition </b> {{ $prescription->addition }}
                @endisset
            </div>

        </div>

        @if (!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
            <!-- ROW: Footer informations -->
            <div class="row">
                <div class="col">
                    <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                </div>
                <div class="col">
                    <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                </div>
            </div>
            <!-- END ROW: Footer informations -->
        @elseif(empty(App\Setting::get_option('footer_left')))
            <!-- ROW: Footer informations -->
            <div class="row">
                <div class="col">
                    <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                </div>
            </div>
            <!-- END ROW: Footer informations -->
        @elseif(empty(App\Setting::get_option('footer_right')))
            <!-- ROW: Footer informations -->
            <div class="row">
                <div class="col">
                    <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                </div>
            </div>
            <!-- END ROW: Footer informations -->
        @else
        @endif
    </div>

    </div>
    </div>

    </div>
    </div>


    <!-- Hidden prescription -->
    <div id="print_area" style="display: none;">
        <!-- ROW: Doctor informations -->
        <div class="row">
            <div class="col-9">
                @if (!empty(App\Setting::get_option('logo')))
                    {{--                         <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" alt="Logo"><br><br> --}}
                @endif
                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
            </div>

        </div>
        <!-- END ROW: Doctor informations -->
        <!-- ROW: Patient informations -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br><br><br><br><br>
        <div class="row">
            <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                <br>
                <p>
                    <b style="float: right;">
                        {{ $prescription->created_at->format('d-m-Y') }}</b>
                </p>
                <br> <br>
                <b style="display: block;">{{ $prescription->patient_title }} {{ $prescription->User->name }} </b>
            </div>
        </div>
        <br>
        <!-- END ROW: Patient informations -->
        @if (count($prescription_drugs) > 0)
            <!-- ROW: Drugs List -->
            <br>
            <br>
            <div class="row" style="font-size: xx-large ; margin-left: 25px; margin-right: 25px;">
                <div class="col">
                    @foreach ($prescription_drugs as $drug)
                        <li>{{ $drug->Drug->trade_name }} {{ $drug->strength }}<br>
                            @isset($drug->drug_advice)
                                <strong>
                                    <p style="font-size: xx-large; margin-left: 120px; margin-right: 25px;">
                                        {{ $drug->drug_advice }}</p>
                                </strong>
                            </li>
                        @endisset
                        @if ($loop->last)
                            <div style="margin-bottom: 30px;"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        {{--        @if (count($prescription_tests) > 0) --}}
        {{--            <!-- ROW: Tests List --> --}}
        {{--            <div class="row justify-content-center"> --}}
        {{--                <div class="col"> --}}
        {{--                    <strong><u>{{ __('sentence.Test to do') }}</u></strong><br><br> --}}
        {{--                    @foreach ($prescription_tests as $test) --}}
        {{--                        <li>{{ $test->Test->test_name }} @empty(!$test->analyse_name) - {{ $test->analyse_name }} @endempty</li> --}}
        {{--                        @empty(!$test->description) --}}
        {{--                            <p>Remarques : {{ $test->description }}</p> --}}
        {{--                        @endempty --}}
        {{--                        <br> --}}
        {{--                        @if ($loop->last) --}}
        {{--                            <br> --}}
        {{--                            <br> --}}
        {{--                            <div style="margin-bottom: 40px;"> --}}
        {{--                                <b>{{ __('sentence.observation') }} :</b> {{ $prescription->observation }} --}}
        {{--                                @isset($prescription->observation) --}}
        {{--                                @endisset --}}
        {{--                            </div> --}}
        {{--                            <hr> --}}
        {{--                        @endif --}}
        {{--                    @endforeach --}}
        {{--                    <hr> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--            <!-- END ROW: Tests List --> --}}
        {{--        @endif --}}
        <!-- ROW: Footer informations -->
        <footer style="position: absolute; bottom: 0;">
            @if (!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
                <!-- ROW: Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                    </div>
                    <div class="col">
                        <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                    </div>
                </div>
                <!-- END ROW: Footer informations -->
            @elseif(empty(App\Setting::get_option('footer_left')))
                <!-- ROW: Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                    </div>
                </div>
                <!-- END ROW: Footer informations -->
            @elseif(empty(App\Setting::get_option('footer_right')))
                <!-- ROW: Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                    </div>
                </div>
                <!-- END ROW: Footer informations -->
            @else
            @endif
        </footer>
        <!-- END ROW: Footer informations -->
    </div>

    <div>
        <!-- Hidden prescription -->
        <div id="print_analyse" style="display: none;">
            <!-- ROW: Doctor informations -->
            <div class="row">
                <div class="col-9">
                    @if (!empty(App\Setting::get_option('logo')))
                        {{--                         <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" alt="Logo"><br><br> --}}
                    @endif
                    <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
                </div>

            </div>
            <!-- END ROW: Doctor informations -->
            <!-- ROW: Patient informations -->
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br><br><br><br><br>

            <div class="row">
                <div class="col"
                    style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                    <br>
                    <p>
                        <b style="float: right;">
                            {{ $prescription->created_at->format('d-m-Y') }}</b>
                    </p>
                    <br> <br>
                    <b style="display: block;">{{ $prescription->patient_title }} {{ $prescription->User->name }} </b>
                </div>
            </div>
            <br>
            <!-- END ROW: Patient informations -->
            {{--             @if (count($prescription_drugs) > 0) --}}
            {{--                 <!-- ROW: Drugs List --> --}}
            {{--                 <br> --}}
            {{--                 <br> --}}
            {{--                 <div class="row" style="font-size: xx-large;"> --}}
            {{--                     <div class="col"> --}}
            {{--                         @foreach ($prescription_drugs as $drug) --}}
            {{--                             <li>{{ $drug->Drug->trade_name }} {{ $drug->strength }} -<strong> {{ $drug->dose }}  fois par Jour(s) pendnat  {{ $drug->duration }} Jour(s) </strong> <br><br><strong>Remarques : </strong>{{ $drug->drug_advice }}</li> --}}
            {{--                             @if ($loop->last) --}}
            {{--                                 <div style="margin-bottom: 30px;"></div> --}}
            {{--                                 <hr> --}}
            {{--                             @endif --}}
            {{--                         @endforeach --}}
            {{--                     </div> --}}
            {{--                 </div> --}}
            {{--             @endif --}}
            <br>
            <br>
            @if (count($prescription_tests) > 0)
                <!-- ROW: Tests List -->
                <div class="row justify-content-center">
                    <div class="col">
                        <strong><u style="font-size: xx-large; margin-left: 25px; margin-right: 25px;">Faire SVP
                                :</u></strong><br><br>
                        @foreach ($prescription_tests as $test)
                            <li style="font-size: xx-large; margin-left: 50px;">
                                @empty(!$test->analyse_name)
                                    {{ $test->analyse_name }}
                                @endempty
                            </li>
                            @empty(!$test->description)
                                <p style="font-size: xx-large; margin-left: 180px; margin-right: 25px;">
                                    {{ $test->description }}
                                </p>
                            @endempty
                            <br>
                        @endforeach
                    </div>
                </div>
                <!-- END ROW: Tests List -->
            @endif
            <!-- ROW: Footer informations -->
            <footer style="position: absolute; bottom: 0;">
                @if (!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
                    <!-- ROW: Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                        </div>
                        <div class="col">
                            <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                        </div>
                    </div>
                    <!-- END ROW: Footer informations -->
                @elseif(empty(App\Setting::get_option('footer_left')))
                    <!-- ROW: Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                        </div>
                    </div>
                    <!-- END ROW: Footer informations -->
                @elseif(empty(App\Setting::get_option('footer_right')))
                    <!-- ROW: Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                        </div>
                    </div>
                    <!-- END ROW: Footer informations -->
                @else
                @endif
            </footer>
            <!-- END ROW: Footer informations -->
        </div>
    </div>
    <div id="print_certi" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card-body">
                    <!-- ROW: Doctor informations -->
                    <div class="row">
                        <div class="col text-center"><br><br><br><br><br><br>
                            <br><br><br><br><br>
                            <div class="col"
                                style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                                <br>
                                <p>
                                    <b style="float: right;">
                                        {{ $prescription->created_at->format('d-m-Y') }}</b>
                                </p>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br><br><br>
                            <h1 class="mt-400">CERTIFICAT MEDICAL</h1>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="row mt-100" style="font-size: x-large">
                        <div class="col">
                            <p class="text-left">Je soussigne <strong>{{ App\Setting::get_option('title') }} </strong>
                            </p> <br>
                            <p class="text-left">Avoir examiné ce jour le(a) patient(e) :
                                <strong>{{ $prescription->patient_title }} {{ $prescription->User->name }}</strong>
                            </p> <br>
                            @isset($prescription->User->Patient->cin)
                                <p class="text-left">Mr,Mme : <strong> {{ $prescription->User->name }}</strong> porteur
                                    cin <strong>{{ $prescription->User->Patient->cin }}</strong></p><br>
                            @endisset
                            <p class="text-left">Et que son état de santé nécessite un repos de
                                <strong>{{ $prescription->certificat }} </strong>jour(s).
                            </p> <br>
                            @if ($prescription->certificat == 1)
                                <p class="text-left">Le :
                                    <strong>{{ \Carbon\Carbon::parse($prescription->dated)->format('d-m-Y') }} </strong>
                                    sauf complication(s)
                                </p>
                            @endif
                            @if ($prescription->certificat != 1)
                                <p class="text-left">A partir du :
                                    <strong>{{ \Carbon\Carbon::parse($prescription->dated)->format('d-m-Y') }} </strong>
                                    au
                                    <strong> {{ \Carbon\Carbon::parse($prescription->datef)->format('d-m-Y') }}</strong>
                                    sauf complication(s)
                                </p>
                            @endif
                            <br>
                            Certificat médical remis a l'intéressé pour faire servir et valoir ce que de droit
                            <br><br><br><br>
                            <p class="text-right" style="margin-right: 200px">Fait à
                                <strong>{{ App\Setting::get_option('ville') }}</strong>
                                Le {{ $prescription->created_at->format('d-m-Y') }}
                            </p> <br><br>
                            <p class="text-right" style="margin-right: 60px"> Signature et cachet: </p>
                            <br><br><br><br><br><br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('header')
    <style type="text/css">
        p,
        u,
        li {
            color: #444444 !important;
        }
    </style>
@endsection
@section('footer')
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        $(function() {
            $(document).on('click', '.print_analyse', function() {
                printDiv('print_analyse');
            })
        })
        $(function() {
            $(document).on("click", '.print_prescription', function() {
                printDiv('print_area');
            });
            $(function() {
                $(document).on("click", '.print_certi', function() {
                    printDiv('print_certi')
                })
            })
            $(function() {
                $(document).on("click", '.print_radio', function() {
                    printDiv('print_radio')
                })
            })

            $(function() {
                $(document).on("click", '.print_ophtal', function() {
                    printDiv('print_ophtal')
                })
            })
        });
    </script>
@endsection