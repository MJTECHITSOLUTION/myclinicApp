@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tout les services</h6>
                </div>
                <div class="col-4">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="{{ route('payment.search') }}" method="post">
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

                    @can('create diagnostic analyse')
                        <a href="{{ route('payment.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> Tout les services</a>
                    @endcan
                </div>
                <div class="col-2">
                    @can('create drug')
                        <a href="{{ route('payment.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> Ajoute service</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome du service</th>
                            <th>Prix</th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->price }}</td>
                                <td class="text-center">
                                    @can('edit diagnostic test')
                                        <a href="{{ url('payment/edit/' . $payment->id) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete diagnostic test')
                                        <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="{{ url('payment/delete/' . $payment->id) }}"><i
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
