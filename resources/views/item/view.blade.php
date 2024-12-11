@extends('layouts.master')

@section('title')
    L'articles N°{{ $item->id }}
@endsection

@section('header')
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"> L'articles N°{{ $item->id }}
                    </h6>
                </div>

                <div class="col-6">
                    @can('create drug')
                        <button type="button" class="btn btn-info btn-sm rounded-0 shadow-none float-right ml-2"
                            data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-plus fa-sm"></i>
                            Ajouter une nouvelle catégorie
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('category.create') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <label for="" class="my__label">Nom de catégorie</label>
                                            <input type="text" name="name" class="form-control rounded-0 shadow-none"
                                                placeholder="Nom de catégorie">
                                            <label for=""></label>
                                            <label for="" class="my__label">
                                                Description de catégorie
                                            </label>
                                            <textarea name="slug" id="slug" class="form-control rounded-0 shadow-none"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 shadow-none"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary btn-sm rounded-0 shadow-none">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endcan
                    @can('create drug')
                        <a href="{{ route('item.create') }}" class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i
                                class="fa fa-plus"></i>
                            ajouter un article</a>
                    @endcan
                </div>

            </div>
        </div>

        <div class="card-body">
            <div class=" w-75 m-auto shadow-sm">
                <div class="d-flex justify-content-center ">
                    <img src="{{ asset('uploads/images_Items/' . $item->item_image) }}" alt="img"
                        class="rounded-circle mb-3" width="250px" height="250px">
                </div>

                <div class="d-flex justify-content-center flex-column ">

                    <h4 class="text-center mb-4">{{ $item->name }}</h4>


                    <div class="w-100 d-flex  justify-content-start px-5">
                        <div class="col-6 d-flex  justify-content-center  ">
                            <div>
                                <p class="text-left">Catégorie : {{ $item->category->name }}</p>
                                <p class="text-left">Marque : {{ $item->brand }}</p>
                                <p class="text-left">Unité : {{ $item->unit }}</p>
                                <p class="text-left">production_date : {{ $item->production_date }}</p>
                                <p class="text-left">expiration_date : {{ $item->expiration_date }}</p>
                            </div>

                        </div>
                        <div class="col-6 d-flex  justify-content-center  ">
                            <div>
                                <p class="text-left">Prix d'achat : {{ $item->purchase_price }} DH</p>
                                <p class="text-left">Prix de vente : {{ $item->sale_price }} DH</p>
                                <p class="text-left">Stock : {{ $item->stock }}</p>
                                <p class="text-left">Stock d’alerte : {{ $item->alert_stock }}</p>
                                <p class="text-left">create-at : {{ $item->created_at }}</p>

                            </div>
                        </div>

                    </div>


                    <div class="action">
                        <div class="row px-5 my-4">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="{{ route('item.edit', $item->id) }}"
                                    class="btn btn-primary rounded-0 shadow-none btn-sm"><i class="fa fa-edit"></i>
                                    Modifier</a>
                                <a href="#" class="btn btn-danger ml-2 rounded-0 shadow-none btn-sm"
                                    data-toggle="modal" data-target="#DeleteModal"
                                    data-link="{{ route('item.destroy', ['id' => $item->id]) }}"><i
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
