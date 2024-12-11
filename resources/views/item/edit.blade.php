@extends('layouts.master')

@section('title')
    Modifier un article
@endsection

@section('header')
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            width: inherit;
            /* Or auto */
            padding: 0 10px;
            /* To give a bit of padding on the left and right */
            border-bottom: none;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modifier un article
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('item.store_edit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $item->id }}" name="myid">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="" class="my__label">Nom d'article <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 shadow-none" name="name"
                                    id="name" aria-describedby="TradeName" value="{{ $item->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="my__label">
                                    Catégorie
                                </label>
                                <select name="category" id="category" class="form-control rounded-0 shadow-none">
                                    @foreach ($categorys as $category)
                                        @if ($category->id == $item->category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="" class="my__label">Marque </label>
                                <input type="text" class="form-control rounded-0 shadow-none" name="brand"
                                    id="brand" aria-describedby="TradeName" value="{{ $item->brand }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="my__label">Unit </label>
                                <select name="unit" id="unit" class="form-control rounded-0 shadow-none">
                                    <option value="Unité" {{ $item->unit == 'Unité' ? 'selected' : '' }}>Unité</option>
                                    <option value="Boite" {{ $item->unit == 'Boite' ? 'selected' : '' }}>Boite</option>
                                    <option value="Paquet" {{ $item->unit == 'Paquet' ? 'selected' : '' }}>Paquet</option>
                                    <option value="Bouteille" {{ $item->unit == 'Bouteille' ? 'selected' : '' }}>Bouteille
                                    </option>
                                    <option value="Sachet" {{ $item->unit == 'Sachet' ? 'selected' : '' }}>Sachet</option>
                                    <option value="Tube" {{ $item->unit == 'Tube' ? 'selected' : '' }}>Tube</option>
                                    <option value="Autre" {{ $item->unit == 'Autre' ? 'selected' : '' }}>Autre</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="alert_stock" class="my__label">Stock</label>
                                <input type="text" class="form-control rounded-0 shadow-none" name="stock"
                                    id="stock" value="{{ $item->stock }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alert_stock" class="my__label">Stock d’alerte</label>
                                <input type="text" class="form-control rounded-0 shadow-none" name="alert_stock"
                                    id="alert_stock" value="{{ $item->alert_stock }}">
                            </div>


                            <div class="form-group col-md-12">
                                <label for="inputState" class="my__label">Image article</label>
                                <br>
                                <label for="file-upload-item" class="custom-file-upload w-100">
                                    <i class="fa fa-cloud-upload"></i> Selectionner votre image article ...
                                </label>
                                <input type="file" class="form-control shadow-none" id="file-upload-item" name="item">
                            </div>



                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="" class="my__label">Prix d'achat <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 shadow-none" name="purchase_price"
                                    id="purchase_price" aria-describedby="TradeName" value="{{ $item->purchase_price }}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="my__label">Prix de vents </label>
                                <input type="text" class="form-control rounded-0 shadow-none" name="sale_price"
                                    id="sale_price" aria-describedby="TradeName" value="{{ $item->sale_price }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="" class="my__label">Date de production </label>
                                <input type="date" class="form-control rounded-0 shadow-none" name="production_date"
                                    id="production_date" aria-describedby="TradeName"
                                    value="{{ $item->production_date }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="my__label">date d'expiration</label>
                                <input type="date" class="form-control rounded-0 shadow-none" name="expiration_date"
                                    id="expiration_date" aria-describedby="TradeName"
                                    value="{{ $item->expiration_date }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary rounded-0" value="Suvegarder">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {

            $('#category').select2({
                selectionCssClass: 'my__input__class'
            });
            $('#unit').select2({
                selectionCssClass: 'my__input__class'
            });
        });
    </script>
@endsection
