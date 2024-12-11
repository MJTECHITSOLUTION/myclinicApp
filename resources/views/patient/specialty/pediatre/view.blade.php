
@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow mb-4">
                <?php
                use Carbon\Carbon;

                function calculateAgeWithMonths($birthday) {
                    $today = Carbon::now();
                    $birthDate = Carbon::parse($birthday);

                    $age = $today->diff($birthDate);
                    $ageYears = $age->y;
                    $ageMonths = $age->m;

                    return "$ageYears ans et $ageMonths mois";
                }
                ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            @empty(!$patient->image)
                                <center><img src="{{ asset('uploads/'.$patient->image) }}" class="img-profile rounded-circle img-fluid" width="256" height="256"></center>
                            @else
                                @if($patient->Patient->gender == 'Homme' || $patient->Patient->gender == '')
                                    <center><img src="{{ asset('img/homme.png') }}" class="img-profile rounded-circle img-fluid" width="256" height="256"></center>
                                @endif
                                @if($patient->Patient->gender == 'Femme')
                                    <center><img src="{{ asset('img/femme.png') }}" class="img-profile rounded-circle img-fluid" width="256" height="256"></center>
                                @endif
                                @if($patient->Patient->gender == 'Enfant' || $patient->Patient->gender == 'Garçon')
                                    <center><img src="{{ asset('img/garson.png') }}" class="img-profile rounded-circle img-fluid" width="256" height="256"></center>
                                @endif
                                @if($patient->Patient->gender == 'Fille' || $patient->Patient->gender == 'Fille')
                                    <center><img src="{{ asset('img/fille.png') }}" class="img-profile rounded-circle img-fluid" width="256" height="256"></center>
                                @endif
                            @endempty
                            <h4 class="text-center mt-3"><b>{{ $patient->name }}</b> <label class="badge badge-primary-soft"> <a href="{{ url('patient/edit/'.$patient->id) }}" ><i class="fa fa-pen"></i></a></label></h4>
                            <hr>
                            @isset($patient->Patient->birthday)
                                <p><b>{{ __('sentence.Birthday') }} :</b> {{ $patient->Patient->birthday }} ({{ calculateAgeWithMonths($patient->Patient->birthday) }})</p>
                            @endisset

                            @isset($patient->Patient->gender)
                                <p><b>{{ __('sentence.Gender') }} :</b> {{ __($patient->Patient->gender) }}</p>
                            @endisset

                            @isset($patient->Patient->phone)
                                <p><b>{{ __('sentence.Phone') }} :</b> {{ $patient->Patient->phone }}</p>
                            @endisset

                            @isset($patient->Patient->adress)
                                <p><b>{{ __('sentence.Address') }} :</b> {{ $patient->Patient->adress }}</p>
                            @endisset
                            @isset($patient->Patient->weight)
                                <p><b>{{ __('sentence.Weight') }} :</b> {{ $patient->Patient->weight }} Kg</p>
                            @endisset

                            @isset($patient->Patient->height)
                                <p><b>{{ __('sentence.Height') }} :</b> {{ $patient->Patient->height }} cm</p>
                            @endisset

                            @isset($patient->Patient->assurance)
                                <p><b>{{ __('sentence.assurance') }} :</b> {{ $patient->Patient->assurance }}</p>
                            @endisset

                            @isset($patient->Patient->cin)
                                <p><b>CIN : </b> {{ $patient->Patient->cin }}</p>
                            @endisset
                            @isset($patient->Patient->numdossier)
                                <p><b>Numéro de dossier : </b> {{ $patient->Patient->numdossier }}</p>
                            @endisset

                        </div>
                        <div class="col-md-8 col-sm-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="Profile" aria-selected="true" >Dossiers Médicaux</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">{{ __('sentence.Health History') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="appointements-tab" data-toggle="tab" href="#appointements" role="tab" aria-controls="appointements" aria-selected="false">{{ __('sentence.Appointments') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions" role="tab" aria-controls="prescriptions" aria-selected="false">{{ __('sentence.Prescriptions') }}</a>
                                </li>
{{--                                <li class="nav-item" role="act">--}}
{{--                                    <a class="nav-link" id="action-tab" data-toggle="tab" href="#act" role="tab" aria-controls="act" aria-selected="false">List de actes</a>--}}
{{--                                </li>--}}


                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab" aria-controls="Billing" aria-selected="false">{{ __('sentence.Payment History') }}</a>
                                </li>
                                {{--                          <li class="nav-item" role="presentation">--}}
                                {{--                              <a class="nav-link" id="observation-tab" data-toggle="tab" href="#observation" role="tab" aria-controls="observation" aria-selected="false">{{ __('sentence.graph') }}</a>--}}
                                {{--                          </li>--}}
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="observation-tab" data-toggle="tab" href="#observation" role="tab" aria-controls="observation" aria-selected="false">Les rapport</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                    <div class="row">
                                        <div class="col">
                                            @can('edit patient')
                                                <button type="button" class="btn btn-primary btn-sm my-4 float-right" data-toggle="modal" data-target="#NewDocumentModel"><i class="fa fa-plus"></i> Ajouter nouveau</button>
                                            @endcan
                                        </div>
                                    </div>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th>Title</th>
                                            <th>Note</th>
                                            <th>Créé à</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($documents as $document)
                                            <tr>
                                                <td>
                                                    @if($document->document_type == "pdf")
                                                        <img src="{{ asset('img/pdf.jpg') }}" class="card-img-top" width="50" height="50">
                                                    @elseif($document->document_type == "docx")
                                                        <img src="{{ asset('img/docx.png') }}" class="card-img-top" width="50" height="50">
                                                    @else
                                                        <a class="example-image-link" href="{{ url('/uploads/'.$document->file) }}" data-lightbox="example-1">
                                                            <img src="{{ url('/uploads/'.$document->file) }}" class="card-img-top" width="50" height="50">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{{ $document->title }}</td>
                                                <td>{{ $document->note }}</td>
                                                <td>{{ $document->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('/uploads/'.$document->file) }}" class="btn btn-primary btn-sm" download>
                                                        <i class="fa fa-cloud-download-alt"></i> Télécharger
                                                    </a>
                                                    <button class="btn btn-success btn-sm" onclick="viewPDF('{{ asset('/uploads/'.$document->file) }}')">
                                                        <i class="fa fa-eye"></i> Afficher
                                                    </button>
                                                    @can('edit patient')
                                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('document/delete/'.$document->id) }}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <img src="{{ asset('img/not-found.svg') }}" width="200" /><br><br>
                                                    <b class="text-muted">Aucun document disponible</b>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="appointements" role="tabpanel" aria-labelledby="appointements-tab">
                                    <div class="row">
                                        <div class="col">
                                            @can('create appointment')
                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right" href="{{ route('appointment.create') }}"><i class="fa fa-plus"></i> {{ __('sentence.New Appointment') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td align="center">Num</td>
                                            <td align="center">{{ __('sentence.Date') }}</td>
                                            <td align="center">{{ __('sentence.Time Slot') }}</td>
                                            <td align="center">{{ __('sentence.Status') }}</td>
                                            <td align="center">{{ __('sentence.Actions') }}</td>
                                        </tr>
                                        @forelse($appointments as $appointment)
                                            <tr>
                                                <td align="center">{{ $appointment->id }} </td>
                                                <td align="center"><label class="badge badge-primary-soft"><i class="fas fa-calendar"></i> {{ $appointment->date->format('d M Y') }} </label></td>
                                                <td align="center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i> {{ $appointment->time_start }} - {{ $appointment->time_end }} </label></td>
                                                <td class="text-center">
                                                    @if ($appointment->visited == 0)
                                                        <label class="badge badge-warning-soft">
                                                            <i class="fas fa-hourglass-start"></i> {{ __('sentence.Not Yet Visited') }}
                                                        </label>
                                                    @elseif($appointment->visited == 1)
                                                        <label class="badge badge-primary-soft">
                                                            <i class="fas fa-check"></i> Terminé
                                                        </label>
                                                    @elseif($appointment->visited == 3)
                                                        <label class="badge badge-success-soft">
                                                            <i class="fas fa-check"></i>Salle d'attente
                                                        </label>
                                                    @else
                                                        <label class="badge badge-danger-soft">
                                                            <i class="fas fa-user-times"></i> {{ __('sentence.Cancelled') }}
                                                        </label>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    @can('edit appointment')
                                                        <a data-rdv_id="{{ $appointment->id }}" data-rdv_date="{{ $appointment->date->format('d M Y') }}" data-rdv_time_start="{{ $appointment->time_start }}" data-rdv_time_end="{{ $appointment->time_end }}" data-patient_name="{{ $appointment->User->name }}" class="btn btn-outline-success btn-circle btn-sm" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                                                    @endcan
                                                    @can('delete appointment')
                                                        <a href="{{ url('appointment/delete/'.$appointment->id) }}" class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" align="center"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b class="text-muted">{{ __('sentence.No appointment available') }}</b></td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="prescriptions" role="tabpanel" aria-labelledby="prescriptions-tab">
                                    <div class="row">
                                        <div class="col">
                                            @can('create prescription')
                                                <a class="btn btn-primary btn-sm my-4 float-right" href="{{ route('prescription.create')}}"><i class="fa fa-pen"></i> {{ __('sentence.Write New Prescription') }}</a>
                                            @endcan
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td align="center">{{ __('sentence.Reference') }}</td>
                                            <td class="text-center">{{ __('sentence.Content') }}</td>
                                            {{--                                            <td class="text-center">Statut du Consultation</td> <!-- Added column for Statut du Consultation -->--}}
                                            <td align="center">Créé à</td>
                                            <td align="center">{{ __('sentence.Actions') }}</td>
                                        </tr>
                                        @forelse($prescriptions as $prescription)
                                            <tr>
                                                <td align="center">{{ $prescription->reference }}</td>
                                                <td class="text-center">
                                                    <label class="badge badge-primary-soft">
                                                        {{ count($prescription->Drug) }} Médicaments
                                                    </label>
                                                    <label class="badge badge-primary-soft">
                                                        {{ count($prescription->Test) }} Analyse
                                                    </label>
                                                </td>
                                                {{--                                                <td class="text-center">--}}
                                                {{--                                                    @if (isset($consultation[$prescription->id]['En_cours']))--}}
                                                {{--                                                        En cours: {{ $consultation[$prescription->id]['En_cours'] }}<br>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                    @if (isset($consultation[$prescription->id]['Termine']))--}}
                                                {{--                                                        Termine : {{ $consultation[$prescription->id]['Termine'] }}--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                </td>--}}
                                                <td align="center">
                                                    <label class="badge badge-primary-soft">{{ $prescription->created_at }}</label>
                                                </td>
                                                <td align="center">
                                                    @can('view prescription')
                                                        <a href="{{ url('prescription/view/'.$prescription->id) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                                    @endcan
                                                    @can('edit prescription')
                                                        <a href="{{ url('prescription/edit/'.$prescription->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                    @endcan
                                                    @can('delete prescription')
                                                        <a href="{{ url('prescription/delete/'.$prescription->id) }}" class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" align="center">
                                                    <img src="{{ asset('img/not-found.svg') }}" width="200" />
                                                    <br><br>
                                                    <b class="text-muted">{{ __('sentence.No prescription available') }}</b>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>

                                </div>

                                <div class="tab-pane fade" id="act" role="tabpanel" aria-labelledby="act-tab">
                                    <div class="row">
                                        <div class="col">
                                            @can('create prescription')
                                                <a class="btn btn-primary btn-sm my-4 float-right" href="{{ route('prescription.create')}}"><i class="fa fa-pen"></i> {{ __('sentence.Write New Prescription') }}</a>
                                            @endcan
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>Act</td>
                                            <td class="text-center">Dent</td>
                                            <td class="text-center">Date de debut</td> <!-- Added column for Statut du Consultation -->
                                            <td align="center">Nombre de seance faites/N'seance</td>
                                            <td align="center">Status</td>
                                            <td align="center">Prix</td>
                                            <td align="centre">Action </td>
                                        </tr>
                                        @forelse($consultation as $act)
                                            <tr>
                                                <td>{{ $act->name }}</td>
                                                <td class="text-center">{{ $act->dent }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($act->act_created_at)->format('d-m-Y') }}
                                                </td>
                                                <td align="center">{{ $act->numseances }}/{{ $act->nums }}</td>
                                                <td align="center">{{ $act->status }}</td>
                                                <td align="center">{{ $act->prix }}</td>
                                                <td align="center">
                                                    <!-- Consultation Icon -->
                                                    <a id="consultationLink" href="{{ route('consultation.list', ['id' => $act->consultation_id]) }}" class="consultationLink" data-id="{{$act->consultation_id}}"  data-toggle="modal" data-target="#consultationModal" data-placement="top" title="Liste de consultation">
                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                    <a id="paiementLink" href="{{ route('paiement.list', ['id' => $act->consultation_id]) }}" class="paiementLink" data-toggle="modal" data-id="{{$act->consultation_id}}" data-target="#paiementModal" data-placement="top" title="Liste de paiement">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </a>
                                                    <a id="seancesLink" href="{{ route('seance.list', ['id' => $act->consultation_id]) }}" class="seancesLink" data-id="{{$act->consultation_id}}" data-toggle="modal" data-target="#seanceModal" data-placement="top" title="Liste de séance">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </table>
                                </div>

                                <div class="modal fade" id="consultationModal" tabindex="-1" role="dialog" aria-labelledby="consultationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="consultationModalLabel">Consultation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="paiementModal" tabindex="-1" role="dialog" aria-labelledby="paiementModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paiementModalLabel">Paiement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="seanceModal" tabindex="-1" role="dialog" aria-labelledby="seanceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="seanceModalLabel">Seance</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                    <div class="row">
                                        <div class="col">
                                            @can('create health history')
                                                <button type="button" class="btn btn-primary btn-sm my-4 float-right" data-toggle="modal" data-target="#MedicalHistoryModel"><i class="fa fa-plus"></i> Ajoute</button>
                                            @endcan
                                        </div>
                                    </div>
                                    @forelse($historys as $history)
                                        @if(isset($history->traitement))
                                            <div class="row mt-2">
                                                <div class="col">
                                                    @can('delete health history')
                                                        <span class="float-right"><i class="fa fa-trash"  data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('history/delete/'.$history->id) }}"></i></span>
                                                    @endcan
                                                    <textarea class="form-control alert alert-danger" name="traitement" id="myTextarea" rows="4" placeholder="" value="{{$history->traitement}}" readonly>{{$history->traitement}}</textarea>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <center><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b class="text-muted">Aucun antécédent médical n'a été trouvé</b></center>
                                    @endforelse


                                </div>



                                <div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
                                    {{--                                    <div class="row mt-4">--}}
                                    {{--                                        <div class="col-lg-4 mb-4">--}}
                                    {{--                                            <div class="card bg-primary text-white shadow">--}}
                                    {{--                                                <div class="card-body">--}}
                                    {{--                                                    {{ __('sentence.Total With Tax') }}--}}
                                    {{--                                                    <div class="text-white small">{{ Collect($invoices)->sum('deposited_amount') }} {{ App\Setting::get_option('currency') }}</div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="col-lg-4 mb-4">--}}
                                    {{--                                            <div class="card bg-success text-white shadow">--}}
                                    {{--                                                <div class="card-body">--}}
                                    {{--                                                    {{ __('sentence.Already Paid') }}--}}
                                    {{--                                                    <div class="text-white small">{{ Collect($invoices)->sum('deposited_amount') }} {{ App\Setting::get_option('currency') }}</div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="col-lg-4 mb-4">--}}
                                    {{--                                            <div class="card bg-danger text-white shadow">--}}
                                    {{--                                                <div class="card-body">--}}
                                    {{--                                                    {{ __('sentence.Due Balance') }}--}}
                                    {{--                                                    <div class="text-white small">{{ Collect($invoices)->where('payment_status','Partially Paid')->sum('due_amount') }} {{ App\Setting::get_option('currency') }}</div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            {{--                                            @can('create invoice')--}}
                                            {{--                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right" href="{{ route('billing.create') }}"><i class="fa fa-plus"></i> {{ __('sentence.Create Invoice') }}</a>--}}
                                            {{--                                            @endcan--}}
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <th>{{ __('sentence.Invoice') }}</th>
                                            <th class="text-center">{{ __('sentence.Date') }}</th>
                                            <th class="text-center">{{ __('sentence.Amount') }}</th>
                                            <th class="text-center">{{ __('sentence.Status') }}</th>
                                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                                        </tr>
                                        @forelse($invoices as $invoice)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('billing/view/'.$invoice->id) }}">{{ $invoice->reference }}</a>
                                                </td>
                                                <td class="text-center"><label
                                                        class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y') }}</label>
                                                </td>
                                                @php
                                                    $paymentRecord = $sumPayments->where('billing_id', $invoice->id)->first();
                                                    $remainingPayment = optional($paymentRecord)->total_payment ?? 0;
                                                @endphp
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-id="{{ $invoice->id }}"
                                                       data-target="#paymentDetailsModal">
                                                        @if($remainingPayment == 0)
                                                            {{ $invoice->deposited_amount }}
                                                        @else
                                                            {{ $remainingPayment}}
                                                        @endif / {{ $invoice->total_without_tax }}
                                                        {{ App\Setting::get_option('currency') }}
                                                        <span class="badge badge-danger-soft">
                                                            {{ $invoice->due_amount - $remainingPayment }}
                                                            {{ App\Setting::get_option('currency') }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if($invoice->payment_status == 'Paid')
                                                        <label class="badge badge-success-soft">
                                                            <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                                        </label>
                                                    @elseif ($remainingPayment == 0)

                                                        <label class="badge badge-danger-soft">
                                                            <i class="fas fa-hourglass-start"></i> {{ __('sentence.Unpaid') }}
                                                        </label>
                                                    @elseif ($remainingPayment == $invoice->total_without_tax)
                                                        <label class="badge badge-success-soft">
                                                            <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                                        </label>
                                                    @else
                                                        <label class="badge badge-warning-soft">
                                                            <i class="fas fa-hourglass-start"></i> {{ __('sentence.Partially Paid') }}
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @can('view invoice')
                                                        <a href="{{ url('billing/view/'.$invoice->id) }}"
                                                           class="btn btn-outline-success btn-circle btn-sm"><i
                                                                class="fa fa-eye"></i></a>
                                                    @endcan
                                                    @if ($remainingPayment == 0)
                                                        @can('edit invoice')
                                                            <a href="{{ url('billing/edit/' . $invoice->id) }}"
                                                               class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                    class="fas fa-pen"></i></a>
                                                        @endcan
                                                    @endif
                                                    @can('delete invoice')
                                                        <a href="{{ url('billing/delete/'.$invoice->id) }}"
                                                           class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                class="fas fa-trash"></i></a>
                                                    @endcan
                                                    @can('edit invoice')
                                                        <a href="{{ url('billing/reglement/' . $invoice->id) }}"
                                                           class="btn btn-outline-info btn-circle btn-sm"><i
                                                                class="fas fa-dollar-sign my-custom-class"
                                                                title="Règlement"></i></a>
                                                    @endcan

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                            </tr>
                                            <td colspan="6" align="center"><img src="{{ asset('img/not-found.svg') }}"
                                                                                width="200"/> <br><br> <b
                                                    class="text-muted">{{ __('sentence.No Invoices Available') }}</b>
                                            </td>
                                        @endforelse
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="observation" role="tabpanel" aria-labelledby="observation-tab">
                                    <div class="chart-container">
                                        <div class="row">
                                            <div class="col">
                                            </div>
                                        </div>
                                        <br>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                {{--                        <th>ID</th> --}}
                                                <th>{{ __('sentence.Patient') }}</th>
                                                <th class="text-center">Rapport</th>
                                                <th class="text-center sm__screen">Date de création</th>
                                                <th class="text-center">{{ __('sentence.Actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                @forelse($gabarits_patients as $gabarits_patient)
                                                    <td><a> {{ $gabarits_patient->user_name }} </a></td>
                                                    <td class="text-center">
                                                        <label class="badge badge-primary-soft">
                                                            {{ $gabarits_patient->template_name }}
                                                        </label>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $gabarits_patient->created_at->format('d-m-Y') }}
                                                        </label>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{ url('gabarit/view/' . $gabarits_patient->id ) }}"
                                                           class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ url('gabarit/edit/' . $gabarits_patient->id ) }}"
                                                           class="btn   btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                        <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                                           data-target="#DeleteModal"
                                                           data-link="{{ url('gabarit/delete/' . $gabarits_patient->id) }}"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                            </tr>
                                            @empty

                                            </tbody>
                                            @endforelse
                                            @forelse($rapport_types as $rapport_type)
                                                <td><a> {{ $rapport_type->name }} </a></td>
                                                <td class="text-center">
                                                    <label class="badge badge-primary-soft">
                                                        {{ $rapport_type->label }}
                                                        <input type="hidden" name="label" id="label"
                                                               value="{{ $rapport_type->rapport_label }}">
                                                    </label>
                                                    <label class="badge badge-primary-soft">
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <label class="badge badge-primary-soft">
                                                        {{ $rapport_type->created_at->format('d-m-Y') }}
                                                    </label>
                                                    <label class="badge badge-primary-soft">
                                                    </label>
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{ url('rapport/view/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id) }}"
                                                       class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ url('rapport/edit/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id) }}"
                                                       class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                    <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                                       data-target="#DeleteModal"
                                                       data-link="{{ url('rapport/delete/' . $rapport_type->id) }}"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                                </tr>
                                            @empty

                                                </tbody>
                                            @endforelse

                                        </table>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Modal-->
    <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.You are about to modify an appointment') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                    <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label></p>
                    <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft" id="rdv_time"></span></label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
                    <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
                    <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        @csrf
                    </form>
                    <a class="btn btn-danger text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
                    <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        @csrf
                    </form>
                    <a class="btn rounded-0  btn-primary  text-white" id="salle"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-salle').submit();">+Salle
                        d'attente</a>
                    <form id="rdv-form-salle" action="{{ route('appointment.store_edit') }}" method="POST"
                          class="d-none">
                        <input type="time" id="time" name="hours" class="form-control"
                               value="{{ now()->format('H:i') }}">
                        <input type="hidden" name="rdv_id" id="rdv_id3">
                        <input type="hidden" name="rdv_status" value="3">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Document Modal -->
    <div id="NewDocumentModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un fichier / une note</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{ route('document.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="title" placeholder="Title" required>
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                {{ csrf_field() }}
                            </div>
                            <div class="col">
                                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <textarea class="form-control" name="note" placeholder="Note"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
                        <button class="btn btn-primary text-white" type="submit">{{ __('sentence.Save') }}</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!--Document Modal -->
    <div id="MedicalHistoryModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouté antécédent </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{ route('history.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                {{--                <input type="text" class="form-control" name="title" placeholder="Antécédent" >--}}
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                {{ csrf_field() }}
                            </div>
                        </div>

                        {{--            <div class="row mt-2">--}}
                        {{--                <div class="col">--}}
                        {{--                    <select class="form-control" name="typeanti" >--}}
                        {{--                        <option value="">Type antécédent</option>--}}
                        {{--                        <option value="Médical">Médical</option>--}}
                        {{--                        <option value="Chirurgical">Chirurgical</option>--}}
                        {{--                        <option value="Familial">Familial</option>--}}
                        {{--                        <option value="Gynéco-Obstétrique">Gynéco-Obstétrique</option>--}}
                        {{--                        <option value="Toxique">Toxique</option>--}}
                        {{--                    </select>--}}
                        {{--                </div>--}}
                        {{--            </div>--}}
                        {{--            <div class="row mt-2">--}}
                        {{--                <div class="col">--}}
                        {{--                    <input type="text" class="form-control" name="periode" placeholder="Date">--}}
                        {{--                </div>--}}
                        {{--            </div>--}}
                        {{--            <div class="row mt-2">--}}
                        {{--              <div class="col">--}}
                        {{--                <textarea class="form-control" name="note" placeholder="Détails Antécédent" ></textarea>--}}
                        {{--              </div>--}}
                        {{--            </div>--}}
                        <div class="row mt-2">
                            <div class="col">
                                <textarea class="form-control" name="traitement" placeholder="Antécédent" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
                        <button class="btn btn-primary text-white" type="submit">{{ __('sentence.Save') }}</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Add Antecedent Modal -->
    <div class="modal fade" id="addAntecedentModal" tabindex="-1" role="dialog" aria-labelledby="addAntecedentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAntecedentModalLabel">Ajouter un nouvel antécédent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="antecedentsForm" method="post" action="{{ route('anticedents.store') }}">
                        <div class="form-group">
                                <label for="antecedents_name">Type de l'antécédent *</label>
                            <input type="text" class="form-control" name="antecedents_name" id="antecedents_name" aria-describedby="antecedents_name" required>
                            {{ csrf_field() }}
                        </div>
                        <button type="button" onclick="addAntecedent()" class="btn rounded-0 btn-primary">{{ __('sentence.Save') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentDetailsModalLabel">Détails de paiement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="yourTableContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('dashboard/css/lightbox.css') }}" />
@endsection
@section('footer')
    <script type="text/javascript" src="{{ asset('dashboard/js/lightbox.js') }}"></script>
    <script>
        function addAntecedent() {
            var formData = $('#antecedentsForm').serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('anticedents.store') }}',
                data: formData,
                success: function(response) {
                    // Handle the response as needed
                    console.log(response);

                    // Refresh the dropdown options
                    refreshDropdown();
                    $('#addAntecedentModal').modal('hide');

                    // For example, you can update the UI or show a success message
                    alert('Antécédent ajouté avec succès !');
                },
                error: function(error) {
                    // Handle errors if any
                    console.log(error);
                }
            });
        }

        function refreshDropdown() {
            // Fetch the updated list of antecedents and update the dropdown options
            $.get('{{ route('antecident.view') }}', function(data) {
                var dropdown = $('#typeAntiSelect');
                dropdown.empty();
                dropdown.append('<option value="">Type antécédent</option>');
                $.each(data, function(index, value) {
                    dropdown.append('<option value="' + value.antecedents_name + '">' + value.antecedents_name + '</option>');
                });
            });
        }
    </script>


    <script>
        function viewPDF(pdfUrl) {
            var width = 800; // Set the desired width of the popup window
            var height = 600; // Set the desired height of the popup window
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;

            window.open(
                pdfUrl,
                'PDF Viewer',
                'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left
            );
        }
    </script>
    <script>
        $(document).ready(function() {
            // Click event on the consultationLink
            $('.consultationLink').on('click', function(e) {
                e.preventDefault();

                // Get the act ID from the data attribute
                var actId = $(this).data('id');

                // Make an AJAX request to fetch consultation data
                $.ajax({
                    url: '/consultation/list/' + actId,
                    type: 'GET',
                    success: function(data) {
                        // Update the modal body with the consultation data
                        var modalBody = $('#consultationModal').find('.modal-body');

                        // Clear previous consultation data
                        modalBody.find('div').empty();

                        // Create a Bootstrap table
                        var table = $('<table class="table table-bordered"></table>');
                        var thead = $('<thead><tr><th>Dent</th><th>Prix</th><th>Status</th><th>Date</th></tr></thead>');
                        table.append(thead);

                        // Append new consultation data to the table
                        var tbody = $('<tbody></tbody>');
                        data.forEach(function(consultation) {
                            var formattedDate = new Date(consultation.created_at).toLocaleString();

                            var row = $('<tr><td>' + consultation.dent + '</td><td>' + consultation.prix + '</td><td>' + consultation.status + '</td><td>' + formattedDate + '</td></tr>');
                            tbody.append(row);
                        });
                        table.append(tbody);

                        // Append the table to the modal body
                        modalBody.find('div').append(table);

                        // Show the modal
                        $('#consultationModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Error fetching consultation data:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Click event on the paiement link
            $('.paiementLink').on('click', function(e) {
                e.preventDefault();

                // Get the consultation ID from the data attribute
                var consultationId = $(this).data('id');

                // Make an AJAX request to fetch paiement data and sumPayer
                $.ajax({
                    url: '/paiement/list/' + consultationId,
                    type: 'GET',
                    success: function(data) {
                        // Update the modal body with the paiement data and sumPayer
                        var modalBody = $('#paiementModal').find('.modal-body');
                        modalBody.empty();

                        // Create a Bootstrap table
                        var table = $('<table class="table table-bordered"></table>');
                        var thead = $('<thead><tr><th>#</th><th> Payer </th><th> Rest à payer </th><th> Date </th></tr></thead>');
                        table.append(thead);

                        // Initialize a variable to accumulate payer values
                        var accumulatedPayer = 0;

                        // Append new paiement data to the table
                        var tbody = $('<tbody></tbody>');
                        data.billing_act.forEach(function(paiement, index) {
                            var formattedDate = new Date(paiement.created_at).toLocaleString();
                            var counter = index + 1;

                            // Accumulate payer values
                            accumulatedPayer += paiement.payer;

                            // Calculate rest à payer
                            var rest = paiement.prix - accumulatedPayer;

                            // Check if rest is NaN and replace with 0
                            rest = isNaN(rest) ? 0 : rest;

                            var row = $('<tr><td>' + counter + '</td><td>' + paiement.payer + '</td><td>' + rest + '</td><td>' + formattedDate + '</td></tr>');
                            tbody.append(row);
                        });
                        table.append(tbody);

                        // Append the table to the modal body
                        modalBody.append(table);

                        // Show the modal
                        $('#paiementModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Error fetching paiement data:', error);
                    }
                });
            });
        });


    </script>


    <script>
        $(document).ready(function() {
            // Click event on the séance link
            $('.seancesLink').on('click', function(e) {
                e.preventDefault();

                // Get the consultation ID from the data attribute
                var seancesid = $(this).data('id');
                console.log(seancesid);

                // Make an AJAX request to fetch séance data
                $.ajax({
                    url: '/seance/list/' + seancesid,
                    type: 'GET',
                    success: function(data) {
                        // Update the modal body with the séance data
                        var modalBody = $('#seanceModal').find('.modal-body');
                        modalBody.empty();

                        // Create a Bootstrap table
                        var table = $('<table class="table table-bordered"></table>');
                        var thead = $('<thead><tr><th>Numéro de séance</th><th>Observation</th><th>Date</th></tr></thead>');
                        table.append(thead);

                        // Append new séance data to the table
                        var tbody = $('<tbody></tbody>');
                        data.forEach(function(seance) {
                            var formattedDate = new Date(seance.created_at).toLocaleString();
                            var row = $('<tr><td>' + seance.numseances + '</td><td>' + seance.observation + '</td><td>' + formattedDate + '</td></tr>');
                            tbody.append(row);
                        });
                        table.append(tbody);

                        // Append the table to the modal body
                        modalBody.append(table);

                        // Show the modal
                        $('#seanceModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Error fetching séance data:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('a[data-target="#paymentDetailsModal"]').click(function (e) {
                e.preventDefault();

                // Get the invoice id from the data attribute
                var invoiceId = $(this).data('id');

                // Make an AJAX request to fetch data
                $.ajax({
                    type: 'GET',
                    url: '/get-reg/' + invoiceId,
                    success: function (data) {
                        // Create and populate the table
                        createTable(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Function to create and populate the table
            function createTable(regData) {
                var table = $('<table>').addClass('table');
                var thead = $('<thead>').append($('<tr>').append('<th>Paiement</th>', '<th>Mode de paiement</th>', '<th>Créé à</th>', '<th>Supprimer</th>'));
                var tbody = $('<tbody>');

                // Loop through the data and create rows
                $.each(regData, function (index, reg) {
                    var createdAt = new Date(reg.created_at);
                    var formattedDate = createdAt.toLocaleDateString('fr-FR');

                    var row = $('<tr>').append(
                        $('<td>').text(reg.payment),
                        $('<td>').text(reg.payment_method),
                        $('<td>').text(formattedDate),
                        regData.length > 1 ? $('<td>').html('<i class="fas fa-trash delete" data-id="' + reg.id + '" style="cursor: pointer;"></i>') : ''
                    );

                    tbody.append(row);
                });

                table.append(thead, tbody);

                // Append the table to a container (e.g., a modal)
                $('#yourTableContainer').empty().append(table);
                // Event listener for delete icon click
                $('.delete').click(function (e) {
                    e.stopPropagation(); // Prevent the modal from being triggered

                    // Get the invoice id from the data attribute
                    var invoiceId = $(this).data('id');

                    // Make an AJAX request to delete the row
                    $.ajax({
                        type: 'GET',
                        url: '/delete-reg/' + invoiceId,
                        success: function (data) {
                            // Assuming the row is successfully deleted, you can update the table or take other actions
                            console.log('Row deleted successfully');
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            }
        });
    </script>



@endsection
