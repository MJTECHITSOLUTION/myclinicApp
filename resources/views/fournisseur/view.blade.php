@extends('layouts.master')

@section('title')
    Le fournisseur N°{{ $fournisseur->id }}
@endsection

@section('header')
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"> Le fournisseur N°{{ $fournisseur->id }}
                    </h6>
                </div>

                <div class="col-6">

                    @can('create drug')
                        <a href="{{ route('fournisseur.create') }}"
                            class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i class="fa fa-plus"></i>
                            Ajouter un fournisseur</a>
                    @endcan
                </div>

            </div>
        </div>


        <div class="card-body">
            <div class=" w-75 m-auto shadow-sm">


                <div class="d-flex justify-content-center flex-column ">

                    <h4 class="text-center mb-4">{{ $fournisseur->name }}</h4>


                    <div class="w-100 d-flex  justify-content-start px-5">
                        <div class="col-6 d-flex  justify-content-center  ">
                            <div>

                                <p class="text-left">Email : {{ $fournisseur->email }}</p>
                                <p class="text-left">Téléphone : {{ $fournisseur->phone }}</p>
                                <p class="text-left">Mobile : {{ $fournisseur->mobile }}</p>

                            </div>

                        </div>
                        <div class="col-6 d-flex  justify-content-center  ">
                            <div>
                                <p class="text-left">Addresse : {{ $fournisseur->Adresse }} </p>
                                <p class="text-left">Ville : {{ $fournisseur->Ville }} </p>
                                <p class="text-left">Pay : {{ $fournisseur->Pays }}</p>


                            </div>
                        </div>

                    </div>


                    <div class="action">
                        <div class="row px-5 my-4">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="{{ route('fournisseur.edit', $fournisseur->id) }}"
                                    class="btn btn-primary rounded-0 shadow-none btn-sm"><i class="fa fa-edit"></i>
                                    Modifier</a>
                                <a href="#" class="btn btn-danger ml-2 rounded-0 shadow-none btn-sm"
                                    data-toggle="modal" data-target="#DeleteModal"
                                    data-link="{{ route('fournisseur.destroy', ['id' => $fournisseur->id]) }}"><i
                                        class="fas fa-trash"></i>
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
