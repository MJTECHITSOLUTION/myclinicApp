@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tout les radios</h6>
                </div>
                <div class="col-4">

                    @can('create diagnostic analyse')
                        <a href="{{ route('radio.create') }}" class="btn btn-primary rounded-0 btn-sm float-right"><i
                                class="fa fa-plus"></i> Tout les radios</a>
                    @endcan
                </div>
                <div class="col-2">
                    @can('create drug')
                        <a href="{{ route('radio.create') }}" class="btn btn-primary rounded-0 btn-sm float-right"><i
                                class="fa fa-plus"></i> Ajoute Radio</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{--                  <th>ID</th> --}}
                            <th>Nome de la Radio</th>
                            {{--                  <th>{{ __('sentence.test_id') }}</th> --}}
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($radios as $radio)
                            <tr>
                                {{--                  <td>{{ $analyse->id }}</td> --}}
                                <td>{{ $radio->radio_name }}</td>
                                {{--                   <td>{{$analyse->test_name}}</td> --}}
                                {{--                  <td> {{ $analyse->comment }} </td> --}}
                                {{--                  <td align="center">{{ __('sentence.In Prescription') }} : {{ $analyse->Prescription->count() }} {{ __('sentence.time use') }}</td> --}}
                                <td class="text-center">
                                    @can('edit diagnostic test')
                                        <a href="{{ url('radio/edit/' . $radio->id) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete diagnostic test')
                                        <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="{{ url('radio/delete/' . $radio->id) }}"><i
                                                class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection