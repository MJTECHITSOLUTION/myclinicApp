
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Patients') }}</h6>
                </div>
                <div class="col-6 ">
                    @can('add patient')
                        <a href="{{ route('patient.create') }}" class="btn btn-primary rounded-0 rounded-0 btn-sm float-right "><i
                                class="fa fa-plus"></i> Ajouter</a>
                    @endcan
                </div>
                <!-- <div class="col-4">
                                      @can('add patient')
                    <a href="{{ route('patient.create') }}" class="btn btn-primary rounded-0 btn-sm float-right "><i class="fa fa-plus"></i></a>
    @endcan
                </div> -->



                {{--                <div class="col-12"> --}}
                {{--                   --}}
                {{--                </div> --}}
            </div>

            <div class="row   ">
                <div class="col-12">
                    <form class="form-inline" action="{{ route('patient.search') }}" method="post">
                        <div class="input-group w-100">
                            <input type="text" name="term" class="form-control bg-light border  small"
                                   placeholder="Rechercher par (CIN,Téléphone,Nom,Prénom)" aria-label="Search" aria-describedby="basic-addon2">
                            @csrf
                            <div class="input-group-append">
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
                <table class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                       id="dataTable" width="100%" cellspacing="0">
                    <thead class="">
                    <tr>
                        {{--                        <th class="sm__screen">ID</th>--}}
                        <th>{{ __('sentence.Patient Name') }}</th>
                        <th class="text-center sm__screen">{{ __('sentence.Age') }}</th>
                        <th class="text-center xxs__screen">{{ __('sentence.Phone') }}</th>
                        {{--                        <th class="text-center sm__screen">{{ __('sentence.Blood Group') }}</th>--}}
                        <th class="text-center md__screen">{{ __('sentence.Date') }} de création</th>
                        {{--                        <th class="text-center  xs__screen">{{ __('sentence.Due Balance') }}</th>--}}
                        <th class="text-center">Afficher</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            {{--                            <td class="sm__screen">{{ $patient->id }}</td>--}}
                            <td><a href="{{ url('patient/view/' . $patient->id) }}"> {{ $patient->name }} </a></td>
                            <td class="text-center sm__screen">
                                {{ @\Carbon\Carbon::parse($patient->birthday)->age }} </td>
                            <td class="text-center xxs__screen"> {{ @$patient->phone }} </td>
                            {{--                            <td class="text-center sm__screen"> {{ @$patient->blood }} </td>--}}
                            <td class="text-center  md__screen"><label
                                    class="badge badge-primary-soft ">{{ $patient->created_at->format('d M Y H:i') }}</label>
                            </td>
                            {{--                            <td class="text-center xs__screen"><label--}}
                            {{--                                    class="badge badge-primary-soft">{{ Collect($patient->Billings)->where('payment_status', 'Partially Paid')->sum('due_amount') }}--}}
                            {{--                                    {{ App\Setting::get_option('currency') }}</label>--}}
                            {{--                            </td>--}}
                            <td class="text-center">
                                @can('view patient')
                                    <a href="{{ route('prescription.view_for_user', ['id' => $patient->id]) }}"
                                       class="btn rounded-0  btn-outline-primary btn-sm"></i>
                                        Consultation</a>
                                @endcan

                                @can('view patient')
                                    <a href="{{ route('billing.showall', ['id' => $patient->id]) }}"
                                       class="btn rounded-0  btn-outline-primary btn-sm"></i>
                                        Paiment</a>
                                @endcan
                            </td>
                            <td class="text-center">
                                @can('view patient')
                                    <a href="{{ route('patient.view', ['id' => $patient->id]) }}"
                                       class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                @endcan
                                @can('edit patient')
                                    <a href="{{ route('patient.edit', ['id' => $patient->id]) }}"
                                       class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                @endcan
                                @can('delete patient')
                                    <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                       data-target="#DeleteModal"
                                       data-link="{{ route('patient.destroy', ['id' => $patient->id]) }}"><i
                                            class="fas fa-trash"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" align="center"><img src="{{ asset('img/rest.png') }} " /> <br><br> <b
                                    class="text-muted">Aucun patient trouvé !</b>
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>

                <div id="container"></div>
                <span class="float-right mt-3">{{ $patients->links() }}</span>

            </div>
        </div>
    </div>
@endsection
