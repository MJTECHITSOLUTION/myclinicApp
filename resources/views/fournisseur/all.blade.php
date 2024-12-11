@extends('layouts.master')

@section('title')
    Tous les fournisseurs
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les fournisseurs</h6>
                </div>
                <div class="col-6 ">
                    @can('add patient')
                        <a href="{{ route('fournisseur.create') }}" class="btn btn-primary btn-sm float-right "><i
                                class="fa fa-plus"></i> Ajouter</a>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form class="form-inline" action="{{ route('fournisseur.search') }}" method="post">
                        <div class="input-group w-100">
                            <input type="text" name="term" class="form-control bg-light border  small"
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
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}" id="dataTable"
                    width="100%" cellspacing="0">
                    <thead class="">
                        <tr>
                            <th class="sm__screen">ID</th>
                            <th>{{ __('sentence.Patient Name') }}</th>
                            <th class="text-center sm__screen">Téléphone</th>
                            <th class="text-center sm__screen">Ville</th>
                            <th>
                                <center>Actions</center>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fournisseurs as $fournisseur)
                            <tr>
                                <td> {{ $fournisseur->id }}</td>
                                <td>
                                    {{ $fournisseur->name }} </td>
                                <td class="text-center xxs__screen">{{ $fournisseur->phone }}</td>
                                <td class="text-center xxs__screen">{{ $fournisseur->Ville }}</td>

                                <td class="text-center">

                                    <a href="{{ route('fournisseur.view', ['id' => $fournisseur->id]) }}"
                                        class="btn btn-outline-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>

                                    @can('edit patient')
                                        <a href="{{ route('fournisseur.edit', ['id' => $fournisseur->id]) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete patient')
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ route('fournisseur.destroy', ['id' => $fournisseur->id]) }}"><i
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
                <div class="d-flex">
                    {!! $fournisseurs->links() !!}
                </div>
            </div>
        </div>


    </div>
@endsection
