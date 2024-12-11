@extends('layouts.master')

@section('title')
    Tous une TVA
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les types dépenses</h6>
                </div>

                <div class="col-6">
                    @can('create drug')
                        <a href="{{ route('type_depose.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i>
                            Ajouter une type dépense</a>
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
                            <th>Libellé</th>
                            <th>Note</th>

                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($type_deposes as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->note }}</td>
                                <td>
                                    @can('edit drug')
                                        <a href="{{ url('type_depose/edit/' . $item->id) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ url('type_depose/delete/' . $item->id) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    {!! $type_deposes->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
