@extends('layouts.master')
@section('title')
    Gabarit
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapports</h6>
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        {{--                        <th>ID</th> --}}
                        <th>{{ __('sentence.Patient') }}</th>
                        <th class="text-center">Rapport</th>
                        <th class="text-center sm__screen">Date de création</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @forelse($gabarits_patients as $gabarits_patient)
                            <td><a> {{ $gabarits_patient->user_name }} </a></td>
                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    {{ $gabarits_patient->template_name }}
                                </label>
                                <label class="badge badge-primary-soft">
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    {{ $gabarits_patient->created_at->format('d-m-Y') }}
                                </label>
                                <label class="badge badge-primary-soft">
                                </label>
                            </td>

                            <td class="text-center">
                                <a href="{{ url('gabarit/view/' . $gabarits_patient->id ) }}"
                                   class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('gabarit/edit/' . $gabarits_patient->id ) }}"
                                   class="btn   btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                   data-target="#DeleteModal"
                                   data-link="{{ url('gabarit/delete/' . $gabarits_patient->id) }}"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                    </tr>
                    @empty

                    </tbody>
                    @endforelse
                    @forelse($rapport_types as $rapport_type)
                        <td><a> {{ $rapport_type->name }} </a></td>
                        <td class="text-center">
                            <label class="badge badge-primary-soft">
                                {{ $rapport_type->label }}
                                <input type="hidden" name="label" id="label"
                                       value="{{ $rapport_type->label }}">
                            </label>
                            <label class="badge badge-primary-soft">
                            </label>
                        </td>
                        <td class="text-center">
                            <label class="badge badge-primary-soft">
                                {{ $rapport_type->created_at->format('d-m-Y') }}
                            </label>
                            <label class="badge badge-primary-soft">
                            </label>
                        </td>

                        <td class="text-center">
                            <a href="{{ url('rapport/view/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id) }}"
                               class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="{{ url('rapport/edit/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id) }}"
                               class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                            <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                               data-target="#DeleteModal"
                               data-link="{{ url('rapport/delete/' . $rapport_type->id) }}"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                        </tr>
                    @empty

                        </tbody>
                    @endforelse

                </table>


            </div>
        </div>
    </div>
@endsection
