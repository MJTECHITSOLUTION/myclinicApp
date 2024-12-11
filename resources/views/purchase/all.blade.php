@extends('layouts.master')

@section('title')
    Tous les achats
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les achats</h6>
                </div>

                <div class="col-6">

                    @can('create drug')
                        <a href="{{ route('purchase.create') }}"
                            class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i class="fa fa-plus"></i>
                            Ajouter un achat</a>
                    @endcan
                </div>
                <div class="col-12">
                    <div class="col-12">
                        <form class="  navbar-search" action="{{ route('item.search') }}" method="post">
                            <div class="input-group">
                                <input type="text" name="term"
                                    class="form-control rounded-0 bg-light  shadow-none border-1 small"
                                    placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                                @csrf
                                <div class="input-group-append">
                                    <button class="btn btn-primary rounded-0 " type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Date d'achat </th>
                            <th class="text-center">
                                TVA
                            </th>
                            <th class="text-center">
                                Total
                            </th>
                            <th class="text-center">Status d'achat</th>

                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchases as $purchase)
                            <tr>
                                <td class="text-center">{{ $purchase->id }}</td>
                                <td class="text-center">{{ $purchase->purchase_date }}</td>
                                <td class="text-center">

                                    @if ($purchase->TVA == '')
                                        <span class="badge badge-info">0 %</span>
                                    @else
                                        <span class="badge badge-info">{{ $purchase->TVA }} %</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $purchase->total_price }}</td>
                                <td class="text-center ">
                                    <form id="purchaseForm" action="{{ route('purchase.status', ['id' => $purchase->id]) }}"
                                        method="post">
                                        @csrf
                                        <select name="purchase_status" class="form-control" onchange="submitForm()">
                                            <option value="0" {{ $purchase->purchase_status == 0 ? 'selected' : '' }}>
                                                En cours</option>
                                            <option value="1" {{ $purchase->purchase_status == 1 ? 'selected' : '' }}>
                                                Envoyé
                                            </option>
                                            <option value="2" {{ $purchase->purchase_status == 2 ? 'selected' : '' }}>
                                                Payé
                                            </option>
                                            <option value="3" {{ $purchase->purchase_status == 3 ? 'selected' : '' }}>
                                                Non payé
                                            </option>
                                            <option value="4" {{ $purchase->purchase_status == 4 ? 'selected' : '' }}>
                                                Livré
                                            </option>


                                        </select>
                                    </form>
                                </td>
                                <td class="text-center">
                                    @can('view drug')
                                        <a href="{{ route('purchase.view', ['id' => $purchase->id]) }}"
                                            class="btn btn-info btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('edit drug')
                                        <a href="{{ route('purchase.edit', ['id' => $purchase->id]) }}"
                                            class="btn btn-success btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a href="
                                            {{ route('purchase.destroy', ['id' => $purchase->id]) }}"
                                            class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                    @endcan

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center"><br><br> Aucun article trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Button trigger modal -->


                <div class="d-flex">
                    {!! $purchases->links() !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    <script>
        function submitForm() {
            document.getElementById('purchaseForm').submit();
        }
    </script>
@endsection
