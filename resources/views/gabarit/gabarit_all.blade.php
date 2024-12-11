@extends('layouts.master')
@section('title')
    Template rapport
@endsection


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Modèle rapport</h6>
                </div>
                <div class="col-4">
                    <a href="{{ route('gabarit.gabarit') }}" class="btn btn-primary rounded-0 btn-sm float-right"><i
                            class="fa fa-plus"></i> Ajouter Modèle rapport</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mx-auto" style="width: 80%;">
                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">Modèle rapport</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($gabarits as $gabarit)
                        <tr>
                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    {{ $gabarit->name }}
                                </label>
                            </td>

                            <td class="text-center">
                                <a href="{{ url('gabarit/gabarit_view/' . $gabarit->name) }}" class="btn btn-outline-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ url('gabarit/gabarit_edit/' . $gabarit->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('gabarit/gabarit_delete/' . $gabarit->id) }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">
                                <img src="{{ asset('img/not-found.svg') }}" width="200" />
                                <br><br>
                                <b class="text-muted">Aucun Rapport trouvé</b>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
