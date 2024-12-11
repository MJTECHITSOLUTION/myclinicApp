
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
                        class="d-none d-md-inline-block my__label ml-1">Voir le paiement</span></a>
            @else
                <a href="{{ url('billing/create') . '?p=' . $prescription->id . '&u=' . $prescription->user_id }}"
                    class="btn rounded-0 btn-dark" title="Nouvelle facture"> <i class="fa fa-plus"></i>
                    <span class="d-none d-md-inline-block my__label ml-1">Nouvelle
                        paiement</span></a>
            @endif
        </div>
        <br>


        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5><strong><u>Ordonnance </u></strong></h5>
                        <button href=""
                            class=" d-sm-inline-block btn btn-sm btn-info shadow-sm print_prescription"><i
                                class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-md-inline-block">Imprimer</span>
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
                                <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d-m-Y')}}
                                </p>
                                <p><b>{{ __('sentence.Reference') }} :</b>
                                    @if ($billingEntry)
                                        <a href="{{ route('billing.search', ['reference' => $prescription->reference]) }}">
                                            {{ $prescription->reference }}
                                        </a>
                                    @else
                                        {{ $prescription->reference }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <!-- ROW: Patient informations -->
                        <hr>
                        <div class="row">
                            <div class="col px-4">
                                <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                            </div>
                        </div>
                        <hr>
                        <strong><u>{{ __('sentence.medicament') }} </u></strong><br><br>
                        <!-- END ROW: Patient informations -->
                        @if (count($prescription_drugs) > 0)
                            <!-- ROW: Drugs List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <ul>
                                        @foreach ($prescription_drugs as $drug)
                                            <li>{{ $drug->Drug->trade_name }} {{ $drug->strength }}<br>
                                                {{ $drug->drug_advice }}</li>
                                            @if ($loop->last)
                                                <div style="margin-bottom: 40px;"></div>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (count($prescription_medicament) > 0)
                            <!-- ROW: Drugs List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <ul>
                                        @foreach ($prescription_medicament as $medicament)
                                            <li>{{ $medicament->medicament }}<br>
                                                {{ $medicament->drug_advice }}</li>
                                            @if ($loop->last)
                                                <div style="margin-bottom: 40px;"></div>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
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

        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5><strong><u>Actes </u></strong></h5>
{{--                        <button href=""--}}
{{--                                class=" d-sm-inline-block btn btn-sm btn-info shadow-sm print_prescription"><i--}}
{{--                                class="fas fa-print fa-sm text-white-50"></i>--}}
{{--                            <span class="d-none d-md-inline-block">Imprimer</span>--}}
{{--                        </button>--}}
                    </div>
                    <div class="card-body">
                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">
                                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d-m-Y')}}
                                </p>
                                <p><b>{{ __('sentence.Reference') }} :</b>
                                    @if ($billingEntry)
                                        <a href="{{ route('billing.search', ['reference' => $prescription->reference]) }}">
                                            {{ $prescription->reference }}
                                        </a>
                                    @else
                                        {{ $prescription->reference }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <!-- ROW: Patient informations -->
                        <hr>
                        <div class="row">
                            <div class="col px-4">
                                <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                            </div>
                        </div>
                        <hr>
                        <!-- END ROW: Patient informations -->
{{--                        @if (count($consultation_act) > 0)--}}
                            <!-- ROW: Drugs List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <br>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">ref</th>
                                                    <th class="text-center">Libellé</th>
                                                    <th class="text-center">Statut acte</th>
                                                    <th class="text-center">Dent</th>
                                                    <th class="text-center">Prix</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($consultation_act as $act)
                                                    <tr class="table-row">
                                                        <td>{{ $act->ref }}</td>
                                                        <td>
                                                            @if(isset($act->libelle_act))
                                                                {{ $act->libelle_act }}
                                                        @else
                                                            {{ $act->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $act->status }}
                                                        </td>
                                                        <td>
                                                            @if(isset($act->haut))
                                                                {{$act->haut}}-
                                                            @endif
                                                            @if(isset($act->gauche))
                                                                {{$act->gauche}}-
                                                            @endif
                                                            @if(isset($act->droite))
                                                                {{$act->droite}}-
                                                            @endif
                                                                @if(isset($act->bas))
                                                                    {{$act->bas}}-
                                                                @endif
                                                            {{ $act->dent }}
                                                        </td>
                                                        <td>{{ $act->prix }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                </div>
                            </div>
{{--                        @endif--}}
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
    @if (count($prescription_tests) > 0)
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <div id="print_analysee">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header  d-flex justify-content-between">
                        <h5><strong> <u>Analyses médicales </u></strong></h5>
                        <button href="" class=" d-sm-inline-block btn btn-sm btn-info shadow-sm print_analyse"><i
                                class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-md-inline-block">Imprimer</span>

                        </button>
                    </div>
                    <div class="card-body">


                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">
                                <p>{!! clean(App\Setting::get_option('header_left')) !!}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d-m-Y') }}
                                </p>
                                <p><b>{{ __('sentence.Reference') }} :</b> {{ $prescription->reference }}</p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <hr>
                        <!-- ROW: Patient informations -->
                        <div class="row">
                            <div class="col px-4
                            ">

                                <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}

                            </div>

                        </div>
                        <hr>
                        @if (count($prescription_tests) > 0)
                            <!-- ROW: Tests List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
                                    <ol>
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
                                                </div>
                                            @endif
                                        @endforeach
                                    </ol>
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


    @if (count($prescription_radios) > 0)
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <div id="print_radioo">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header  d-flex justify-content-between">
                        <h5><strong><u>Radio </u></strong></h5>

                        <button href="" class=" d-sm-inline-block btn btn-sm btn-info shadow-sm print_radio"><i
                                class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-md-inline-block">Imprimer</span>

                        </button>
                    </div>
                    <div class="card-body">


                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">
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
                        <hr>

                        <div class="row">
                            <div class="col mx-4">

                                <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}

                            </div>
                        </div>
                        <hr>


                        @if (count($prescription_radios) > 0)
                            <!-- ROW: Tests List -->
                            <div class="row justify-content-center">
                                <div class="col">
                                    <strong><u>Faire SVP </u></strong><br><br>
                                    <ol>
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
                                    </ol>
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
{{--    <div id="print_note_honoraire">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-10">--}}
{{--                <div class="card shadow mb-4">--}}
{{--                    <div class="card-header  d-flex justify-content-between">--}}
{{--                        <h5><strong><u>Note d'Honoraire</u></strong></h5>--}}

{{--                        <button href="" class=" d-sm-inline-block btn btn-sm btn-info shadow-sm print_note"><i--}}
{{--                                class="fas fa-print fa-sm text-white-50"></i>--}}
{{--                            <span class="d-none d-md-inline-block">Imprimer</span>--}}

{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="container">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-5">--}}
{{--                                    <p> {{ App\Setting::get_option('title') }}    </p>--}}
{{--                                    <p> {{ App\Setting::get_option('address') }}  </p>--}}
{{--                                    <p> {{ App\Setting::get_option('phone') }}    </p>--}}
{{--                                    <p> {{ App\Setting::get_option('ville') }}    </p>--}}
{{--                                    <p> {{ App\Setting::get_option('ice') }}    </p>--}}
{{--                                    <p> {{ App\Setting::get_option('inp') }}    </p>--}}
{{--                                    <p> {{ App\Setting::get_option('if') }}    </p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-7 text-right">--}}
{{--                                    <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" style="width: 300px; height: 200px;" >--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <br><br>--}}
{{--                        <h3>--}}
{{--                            <div class="text-center">--}}
{{--                                <b>Note d'Honoraire N': {{$prescription->note_honoraire}} </b>--}}
{{--                            </div><br></h3>--}}
{{--                        <div class="row" style="margin-left: 50px;">--}}
{{--                            {{ $prescription->created_at->format('d-m-Y') }}--}}
{{--                        </div>--}}
{{--                        <br><br>--}}
{{--                        <table class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"--}}
{{--                               id="dataTable" width="100%" cellspacing="0">--}}
{{--                            <thead class="">--}}
{{--                            <tr>--}}
{{--                                <th class="text-center "><b>Nom de l'acte</b></th>--}}
{{--                                <th class="text-center "><b>Code</b></th>--}}
{{--                                <th class="text-center "><b>Lettre clé+Coeff</b></th>--}}
{{--                                <th class="text-center "><b>Date</b></th>--}}
{{--                                <th class="text-center "><b>Dent(s)</b></th>--}}
{{--                                <th class="text-center "><b>Montant</b></th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($consultation_act as $act)--}}
{{--                                <tr class="table-row">--}}
{{--                                    <td>--}}
{{--                                        @if(isset($act->libelle_act))--}}
{{--                                            {{ $act->libelle_act }}--}}
{{--                                        @else--}}
{{--                                            {{ $act->name }}--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{ $act->ref }}</td>--}}
{{--                                    <td>{{ $act->lettre }}</td>--}}
{{--                                    <td>{{ \Carbon\Carbon::parse($act->date)->format('d-m-Y') }}</td>--}}
{{--                                    <td>{{ $act->dent }}</td>--}}
{{--                                    <td>{{ $act->prix }}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <td colspan="5" class="text-right"><strong>Total:</strong></td>--}}
{{--                                <td>{{ $totalPrice }}</td>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @empty(!$prescription->certificat)
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
        </div>
        <div id="print_certii">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <br><br>
                            <button href="" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm print_certi"
                                style="margin-left: 1150px; margin-top: -90px;"><i
                                    class="fas fa-print fa-sm text-white-50"></i>
                                Imprimer
                            </button>

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
        @if( (App\Setting::get_option('use_entete') === 'yes'))
            <div style="text-align: center;">
                <img src="{{ asset("uploads/" . App\Setting::get_option("imagerapport")) }}" style="max-width: 100%;"><br><br><br><br>
            </div>
        @else
            <br><br><br><br><br>
            <br><br><br><br><br><br><br><br>
        @endif
        <div class="row">
            <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                <p>
                    <b style="margin-right:10px ;">{{ $prescription->created_at->format('d-m-Y') }}</b>
                </p>
                <br><br><br>
                <b style="display: block;"> {{ $prescription->User->name }} </b>
            </div>
        </div>
        <br>
        <!-- END ROW: Patient informations -->
        @if (count($prescription_radios) > 0)
            <!-- ROW: Tests List -->
            <div class="row justify-content-center" style="font-size: xx-large">
                <div class="col">
                    <strong style="margin-left: 100px;"><u>Faire SVP : </u></strong><br><br>
                    <ol>
                        @foreach ($prescription_radios as $radio)
                            <li style="margin-left: 120px;">
                                @empty(!$radio->radio_name)
                                    {{ $radio->radio_name }}
                                @endempty
                            </li>
                            @empty(!$radio->justif)
                                <p style="margin-left: 170px;"> {!! nl2br(e($radio->justif)) !!} </p>
                            @endempty
                            <br>
                            @if ($loop->last)
                                <br>
                                <div>
                                    @if( (App\Setting::get_option('use_pied') === 'yes'))
                                        <img src="{{ asset("uploads/" . App\Setting::get_option("piedrapport")) }}" style="position: fixed; bottom: 0; left: 0; right: 0; margin: auto;max-width: 100%;" />
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </ol>
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
    <!-- Hidden prescription -->
    <div id="print_area" style="display: none;">
        <!-- ROW: Doctor informations -->
        @if( (App\Setting::get_option('use_entete') === 'yes'))
            <div style="text-align: center;">
                <img src="{{ asset("uploads/" . App\Setting::get_option("imagerapport")) }}" style="max-width: 100%;"><br><br><br><br>
            </div>
        @else
        <br><br><br><br><br>
        <br><br><br><br><br><br><br><br>
        @endif
        <div class="row">
            <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                <p>
                    <b style="margin-right:10px ;">{{ $prescription->created_at->format('d-m-Y') }}</b>
                </p>
                <br>
                <br> <br>
                <b style="display: block;"> {{ $prescription->User->name }} </b>
            </div>
        </div>
        <br>
        <!-- END ROW: Patient informations -->
            <!-- ROW: Drugs List -->
            <br>
            <br>
            <div class="row" style="font-size: xx-large ; margin-left: 25px; margin-right: 25px;">
                <div class="col">
                    <ol>
                        @foreach ($prescription_drugs as $drug)
                            <li>{{ $drug->Drug->trade_name }} {{ $drug->strength }}<br>
                                @isset($drug->drug_advice)
                                    <p style="font-size: xx-large; margin-left: 50px; margin-right: 15px;">
                                        {{ $drug->drug_advice }}
                                    </p>
                                @endisset
                            </li>
                        @endforeach
                            @foreach ($prescription_medicament as $medicament)
                                <li>{{ $medicament->medicament }}<br>
                                    {{ $medicament->drug_advice }}</li>
                                @if ($loop->last)
                                    <div style="margin-bottom: 40px;"></div>
                                @endif
                            @endforeach
                                @if (App\Setting::get_option('use_pied') === 'yes')
                                    <img src="{{ asset('uploads/' . App\Setting::get_option('piedrapport')) }}"
                                         style="position: fixed; bottom: 0; left: 0; right: 0; margin: auto; max-width: 100%;" />
                                @endif
                    </ol>

                </div>
            </div>


        <!-- END ROW: Footer informations -->
    </div>

    <div>
        <!-- Hidden prescription -->
        <div id="print_analyse" style="display: none;">
            <!-- ROW: Doctor informations -->
            @if( (App\Setting::get_option('use_entete') === 'yes'))
                <div style="text-align: center;">
                    <img src="{{ asset("uploads/" . App\Setting::get_option("imagerapport")) }}" style="max-width: 100%;"><br><br><br><br>
                </div>
            @else
                <br><br><br><br><br>
                <br><br><br><br><br><br><br><br>
            @endif
            <div class="row">
                <div class="col"
                    style="font-size: xx-large; margin-left: 25px; margin-right: 25px; text-align: center;">
                    <p>
                        <b style="margin-right:10px ;">{{ $prescription->created_at->format('d-m-Y') }}</b>
                    </p>
                    <br><br><br>
                    <b style="display: block;"> {{ $prescription->User->name }} </b>
                </div>
            </div>
            <br>

            <br>
            <br>
            @if (count($prescription_tests) > 0)
                <!-- ROW: Tests List -->
                 <div class="row justify-content-center">
                    <div class="col">
                        <strong><u style="font-size: xx-large; margin-left: 25px; margin-right: 25px;">Faire SVP
                                :</u> </strong><br><br>
                        <ol>
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
                        </ol>
                    </div>
                     @if( (App\Setting::get_option('use_pied') === 'yes'))
                         <img src="{{ asset("uploads/" . App\Setting::get_option("piedrapport")) }}" style="position: fixed; bottom: 0; left: 0; right: 0; margin: auto;max-width: 100%;" />
                     @endif
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
                            <br><br><br><br><br><br><br><br><br><br><br>
                            <h1 class="mt-400">CERTIFICAT MEDICAL</h1>
                        </div>
                    </div>
                    <br><br><br><br>
                    <div class="row mt-100" style="font-size: x-large">
                        <div class="col">
                            <p class="text-left">Je soussigne <strong>{{ App\Setting::get_option('title') }} </strong>
                            </p> <br>
                            <p class="text-left">Avoir examiné ce jour le(a) patient(e) :
                                <strong> {{ $prescription->User->name }}</strong>
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




{{--                    Note Honarire--}}
{{--                    <div id="print_note" style="display: none;">--}}
{{--                        <div class="container">--}}
{{--                            <br><br>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-6">--}}
{{--                                    <p>{{ App\Setting::get_option('title') }}</p>--}}
{{--                                    <p>{{ App\Setting::get_option('address') }}</p>--}}
{{--                                    <p>{{ App\Setting::get_option('ville') }}</p>--}}
{{--                                    <p>Tél : {{ App\Setting::get_option('phone') }}</p>--}}
{{--                                    <p>ICE: {{ App\Setting::get_option('ice') }}</p>--}}
{{--                                    <p>INP: {{ App\Setting::get_option('inp') }}</p>--}}
{{--                                    <p>IF: {{ App\Setting::get_option('if') }}</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-6 text-right">--}}
{{--                                    <br><br>--}}
{{--                                    <img src="{{ asset('img/rmiliBlack.png') }}" style="width: 100%; max-width: 400px; height: auto;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <br><br>--}}
{{--                        <h3>--}}
{{--                            <div class="text-center">--}}
{{--                                <b>Note d'Honoraire N': {{$prescription->note_honoraire}}  </b>--}}
{{--                            </div><br></h3>--}}
{{--                        <div class="row" style="margin-left: 50px;">--}}
{{--                            {{ $prescription->created_at->format('d-m-Y') }}--}}
{{--                        </div>--}}
{{--                        <br><br>--}}
{{--                        <table class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"--}}
{{--                               id="dataTable" width="100%" cellspacing="0">--}}
{{--                            <thead class="">--}}
{{--                            <tr>--}}
{{--                                <th class="text-center "><b>Nom de l'acte</b></th>--}}
{{--                                <th class="text-center "><b>Code</b></th>--}}
{{--                                <th class="text-center "><b>Lettre clé+Coeff</b></th>--}}
{{--                                <th class="text-center "><b>Date</b></th>--}}
{{--                                <th class="text-center "><b>Dent(s)</b></th>--}}
{{--                                <th class="text-center "><b>Montant</b></th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($consultation_act as $act)--}}
{{--                                <tr class="table-row">--}}
{{--                                    <td>--}}
{{--                                        @if(isset($act->libelle_act))--}}
{{--                                            {{ $act->libelle_act }}--}}
{{--                                        @else--}}
{{--                                            {{ $act->name }}--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{ $act->ref }}</td>--}}
{{--                                    <td>{{ $act->lettre }}</td>--}}
{{--                                    <td>{{ \Carbon\Carbon::parse($act->date)->format('d-m-Y') }}</td>--}}
{{--                                    <td>{{ $act->dent }}</td>--}}
{{--                                    <td>{{ $act->prix }}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <td colspan="5" class="text-right"><strong>Total:</strong></td>--}}
{{--                                <td>{{ $totalPrice }}</td>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}
{{--                    </div>--}}
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
                $(document).on("click", '.print_note', function() {
                    printDiv('print_note')
                })
            })
        });
    </script>
@endsection
