@extends('layouts.master')

@section('title')
    Tous les Déposes
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les Déposes</h6>
                </div>

                <div class="col-6">

                </div>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nom déposes </th>
                            <th class="text-center">
                                Type déposes
                            </th>
                            <th class="text-center">
                                monton
                            </th>
                            <th class="text-center">
                                Tries
                            </th>


                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($depenses as $depense)
                            <tr>
                                <td class="text-center">{{ $depense->label }}</td>
                                <td class="text-center">{{ $depense->type_depenses }}</td>
                                <td class="text-center">{{ $depense->monton }}</td>
                                <td class="text-center">{{ $depense->created_by }}</td>

                                <td class="text-center">
                                    @can('edit drug')
                                        <a href="{{ route('depense.edit', ['id' => $depense->id]) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ route('depense.destroy', ['id' => $depense->id]) }}"><i
                                                class="fas fa-trash"></i></a>
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
                    {!! $depenses->links() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
