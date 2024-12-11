@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All analyses') }}</h6>
                </div>
                <div class="col-4">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="{{ route('analyse.search') }}" method="post">
                        <div class="input-group">
                            <input type="text" name="term"
                                class="form-control rounded-0 shoadow-none shadow-none rounded-0 bg-light border-0 small"
                                placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                            @csrf
                            <div class="input-group-append">
                                <button class="btn rounded-0  btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    @can('create diagnostic analyse')
                        <a href="{{ route('analyse.create') }}" class="btn rounded-0  btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> {{ __('sentence.Add analyse') }}</a>
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
                            <th>{{ __('sentence.analyse Name') }}</th>
                            {{--                  <th>{{ __('sentence.test_id') }}</th> --}}
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($analyses as $analyse)
                            <tr>
                                {{--                  <td>{{ $analyse->id }}</td> --}}
                                <td>{{ $analyse->analyse_name }}</td>
                                {{--                   <td>{{$analyse->test_name}}</td> --}}
                                {{--                  <td> {{ $analyse->comment }} </td> --}}
                                {{--                  <td align="center">{{ __('sentence.In Prescription') }} : {{ $analyse->Prescription->count() }} {{ __('sentence.time use') }}</td> --}}
                                <td class="text-center">
                                    @can('edit diagnostic test')
                                        <a href="{{ url('analyse/edit/' . $analyse->id) }}"
                                            class="btn   btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete diagnostic test')
                                        <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ url('analyse/delete/' . $analyse->id) }}"><i
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
