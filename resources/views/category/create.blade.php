@extends('layouts.master')

@section('title')
    Ajouter un catégorie
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un catégorie</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('category.store') }}" method="POST">
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
    </div>
@endsection
