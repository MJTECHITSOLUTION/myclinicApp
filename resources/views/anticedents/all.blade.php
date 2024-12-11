@extends('layouts.master')

@section('title')
    Toutes Antécédents
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Antécédents</h6>
                </div>
                <div class="col-4">
                        <a href="{{ route('anticedents.create') }}" class="btn   btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Ajoutez Antécédents</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
{{--                            <th>ID</th>--}}
                            <th>Antécédents</th>
                            {{--                  <th>{{ __('sentence.Generic Name') }}</th> --}}
                            {{--                  <th class="text-center">{{ __('sentence.Total Use') }}</th> --}}
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anticedents as $anticedent)
                            <tr>
{{--                                <td>{{ $anticedent->id }}</td>--}}
                                <td>{{ $anticedent->antecedents_name }}</td>
                                {{--                  <td>{{ $assurance->generic_name }}</td> --}}
                                {{--                  <td align="center">{{ __('sentence.In Prescription') }} : {{ $assurance->Prescription->count() }} {{ __('sentence.time use') }}</td> --}}
                                <td class="text-center">
                                    @can('edit drug')
                                        <a href="{{ url('anticedents/edit/' . $anticedent->id) }}"
                                            class="btn   btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a class="btn rounded-0  btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ url('anticedents/delete/' . $anticedent->id) }}"><i
                                                class="fas fa-trash"></i></a>
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
