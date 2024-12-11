@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Drugs') }}</h6>
                </div>
                <div class="col-4">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="{{ route('drug.search') }}" method="post">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control bg-light border-0 small"
                                placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                            @csrf
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    @can('create drug')
                        <a href="{{ route('drug.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> {{ __('sentence.Add Drug') }}</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('sentence.Trade Name') }}</th>
                            {{--                  <th>{{ __('sentence.Generic Name') }}</th> --}}
                            {{--                  <th class="text-center">{{ __('sentence.Total Use') }}</th> --}}
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drugs as $drug)
                            <tr>
                                <td>{{ $drug->id }}</td>
                                <td>{{ $drug->trade_name }}</td>
                                {{--                  <td>{{ $drug->generic_name }}</td> --}}
                                {{--                  <td align="center">{{ __('sentence.In Prescription') }} : {{ $drug->Prescription->count() }} {{ __('sentence.time use') }}</td> --}}
                                <td class="text-center">
                                    @can('edit drug')
                                        <a href="{{ url('drug/edit/' . $drug->id) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="{{ url('drug/delete/' . $drug->id) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    {!! $drugs->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
