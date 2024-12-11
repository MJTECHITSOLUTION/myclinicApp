

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Prescriptions') }}</h6>
                </div>
                <div class="col-8">
                    <form action="{{ route('prescription.search') }}" method="GET" class="form-inline float-right">
                        <div class="form-group mx-2">
                            <label for="start_date" class="sr-only">{{ __('Start Date') }}</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{$start_date}}" placeholder="{{ __('Start Date') }}">
                        </div>
                        <div class="form-group mx-2">
                            <label for="end_date" class="sr-only">{{ __('End Date') }}</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{$end_date}}" placeholder="{{ __('End Date') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Réf consultation</th>
                        {{--                            <th>Réf facture</th>--}}
                        <th>{{ __('sentence.Patient') }}</th>
                        <th class="text-center sm__screen">Date consultation</th>
                        <th class="text-center ">Prescription</th>
                        {{--                            <th class="text-center xxs__screen">Statut du paiement</th>--}}
                        <th class="text-center xxs__screen">Statut du Consultation</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($prescriptions as $prescription)
                        <tr>
                            <td>
                                @if ($referance[$prescription->id])
                                    <a href="{{ route('billing.search', ['reference' => $prescription->reference]) }}">
                                        {{ $prescription->reference }}
                                    </a>
                                @else
                                    {{ $prescription->reference }}
                                @endif
                            </td>
                            {{--                                <td>--}}
                            {{--                                    {{ $referance[$prescription->id] }}--}}
                            {{--                                </td>--}}
                            <td>
                                <a href="{{ url('patient/view/' . $prescription->user_id) }}">
                                    {{ $prescription->User->name }} </a>
                            </td>
                            <td class="text-center sm__screen">{{ $prescription->created_at->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    {{ count($prescription->Drug) }} Médicaments
                                </label>
                                <label class="badge badge-primary-soft">
                                    {{ count($prescription->Test) }} Analyse
                                </label>
                            </td>
                            {{--                                <td class="text-center xxs__screen">--}}
                            {{--                                    @if ($billingExists[$prescription->id])--}}
                            {{--                                        @if ($paymentStatus[$prescription->id] == 'Unpaid')--}}
                            {{--                                            <label class="badge badge-danger-soft">--}}
                            {{--                                                <i class="fas fa-hourglass-start"></i> {{ __('sentence.Unpaid') }}--}}
                            {{--                                            </label>--}}
                            {{--                                        @elseif($paymentStatus[$prescription->id] == 'Paid')--}}
                            {{--                                            <label class="badge badge-success-soft">--}}
                            {{--                                                <i class="fas fa-check"></i> {{ __('sentence.Paid') }}--}}
                            {{--                                            </label>--}}
                            {{--                                        @elseif($paymentStatus[$prescription->id] == 'Partially Paid')--}}
                            {{--                                            <label class="badge badge-warning-soft">--}}
                            {{--                                                <i class="fas fa-hourglass-start"></i> {{ __('sentence.Partially Paid') }}--}}
                            {{--                                            </label>--}}
                            {{--                                        @else--}}
                            {{--                                        @endif--}}
                            {{--                                        <!-- Handle case where no billing entry exists -->--}}
                            {{--                                    @endif--}}
                            {{--                                </td>--}}
                            <td class="text-center xxs__screen">
                                <label class="badge badge-primary-soft">
                                    @if (isset($consultation[$prescription->id]['en_cours']))
                                        {{ $consultation[$prescription->id]['en_cours'] }} En cours
                                    @endif
                                </label>
                                <label class="badge badge-primary-soft">
                                    @if (isset($consultation[$prescription->id]['termine']))
                                        {{ $consultation[$prescription->id]['termine'] }} Termine
                                    @endif
                                </label>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('prescription/view/' . $prescription->id . '?user_id=' . $prescription->user_id) }}"
                                   class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('prescription/edit/' . $prescription->id . '?user_id=' . $prescription->user_id) }}"
                                   class="btn   btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                   data-target="#DeleteModal"
                                   data-link="{{ url('prescription/delete/' . $prescription->id) }}"><i
                                        class="fas fa-trash"></i></a>
                                @if ($billingExists[$prescription->id])
                                    <!-- Display link for editing billing when billing exists -->
                                    <a href="{{ url('billing/view', ['billing_id' => $billingIds[$prescription->id]]) }}"
                                       class="btn   btn-outline-info btn-circle btn-sm">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>
                                @else
                                    <!-- Display link for creating billing when billing doesn't exist -->
                                    <a href="{{ url('billing/create') . '?p=' . $prescription->id . '&u=' . $prescription->user_id }}"
                                       class="btn   btn-outline-secondary active btn-circle btn-sm">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>
                                @endif

                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
                <span class="float-right mt-3">{{ $prescriptions->links() }}</span>

            </div>
        </div>
    </div>
@endsection
