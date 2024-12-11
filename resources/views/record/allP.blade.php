@extends('layouts.master')

@section('title')
    Rapport paiement
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport paiement</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="{{ route('record.paiement') }}" method="post">
                        <div class="input-group w-100 ">
                            <!-- Start Date Input -->
                            <label><b>Date début : </b></label>
                            <input type="date" name="start_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date début" value="{{ date('Y-m-d') }}"  aria-label="Date début" aria-describedby="basic-addon2"  required>

                            <!-- End Date Input -->
                            <label style="margin-left: 40px;"><b>Date fin :</b></label>
                            <input type="date" name="end_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date fin" value="{{ date('Y-m-d') }}" aria-label="Date fin" aria-describedby="basic-addon2" style="margin-left: 10px;" required>

                            @csrf
                            <div class="input-group-append" style="margin-left: 10px;">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">Nom et prénom</th>
                        <th class="text-center sm__screen">Mode de paiement</th>
                        <th class="text-center xxs__screen">Statut de paiement</th>
                        <th class="text-center sm__screen">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                        @forelse($patients as $patient)--}}
                    {{--                            <tr>--}}
                    {{--                                --}}{{--                      <td>{{ $patient->id }}</td> --}}
                    {{--                                <td><a href="{{ url('patient/view/' . $patient->id) }}"> {{ $patient->name }} </a></td>--}}
                    {{--                                <td class="text-center"> {{ @\Carbon\Carbon::parse($patient->Patient->birthday)->age }}--}}
                    {{--                                </td>--}}
                    {{--                                <td class="text-center"> {{ @$patient->Patient->phone }} </td>--}}
                    {{--                                --}}{{--                      <td class="text-center"> {{ @$patient->Patient->blood }} </td> --}}
                    {{--                                <td class="text-center"><label--}}
                    {{--                                        class="badge badge-primary-soft">{{ $patient->created_at->format('d-m-Y') }}</label>--}}
                    {{--                                </td>--}}
                    {{--                                <td class="text-center"><label--}}
                    {{--                                        class="badge badge-primary-soft">{{ Collect($patient->Billings)->where('payment_status', 'Partially Paid')->sum('due_amount') }}--}}
                    {{--                                        {{ App\Setting::get_option('currency') }}</label></td>--}}
                    {{--                                <td class="text-center">--}}
                    {{--                                    @can('view patient')--}}
                    {{--                                        <a href="{{ route('prescription.view_for_user', ['id' => $patient->id]) }}"--}}
                    {{--                                            class="btn rounded-0  btn-outline-primary btn-sm"><i class="fa fa-eye"></i>--}}
                    {{--                                            Afficher</a>--}}
                    {{--                                    @endcan--}}
                    {{--                                </td>--}}
                    {{--                                <td class="text-center">--}}
                    {{--                                    @can('view patient')--}}
                    {{--                                        <a href="{{ route('patient.view', ['id' => $patient->id]) }}"--}}
                    {{--                                            class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>--}}
                    {{--                                    @endcan--}}
                    {{--                                    @can('edit patient')--}}
                    {{--                                        <a href="{{ route('patient.edit', ['id' => $patient->id]) }}"--}}
                    {{--                                            class="btn   btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>--}}
                    {{--                                    @endcan--}}
                    {{--                                    @can('delete patient')--}}
                    {{--                                        <a href="#" class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"--}}
                    {{--                                            data-target="#DeleteModal"--}}
                    {{--                                            data-link="{{ route('patient.destroy', ['id' => $patient->id]) }}"><i--}}
                    {{--                                                class="fas fa-trash"></i></a>--}}
                    {{--                                    @endcan--}}
                    {{--                                </td>--}}
                    {{--                            </tr>--}}
                    {{--                        @empty--}}
                    <tr>
                        <td colspan="9" align="center"> <br><br> <b
                                class="text-muted">Aucun paiement trouvé !</b>
                        </td>
                    </tr>
                    {{--                        @endforelse--}}

                    </tbody>
                </table>

                <div id="container"></div>

            </div>
        </div>
    </div>
@endsection
