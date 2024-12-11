@extends('layouts.master')
@section('title')
    Modifier
    fiche founisseur
@endsection
@section('content')
    <form method="post" action="{{ route('fournisseur.store_edit') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="myid" value="{{ $fournisseur->id }}">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="m-0 font-weight-bold text-primary mb-3">
                                    Modifier
                                    fiche founisseur</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="my__label">{{ __('sentence.Full Name') }}<font
                                        color="red"> *</font></label>
                                <input type="text" class="form-control shadow-none  rounded-0" id="Name"
                                    name="name" value="{{ $fournisseur->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress" class="my__label">Email </label>
                                <input type="email" class="form-control shadow-none rounded-0" id="email"
                                    name="email" autocomplete="off" value="{{ $fournisseur->email }}">
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="inputCity" class="my__label">Phone</label>
                                <input type="text" class="form-control shadow-none rounded-0" id="phone"
                                    name="phone" autocomplete="off" value="{{ $fournisseur->phone }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="my__label">Mobile</label>
                                <input type="text" class="form-control shadow-none  rounded-0" id="Mobile"
                                    name="mobile" value="{{ $fournisseur->mobile }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4" class="my__label">Pays</label>
                                <input type="text" class="form-control shadow-none  rounded-0" id="Pays"
                                    name="pays" value="{{ $fournisseur->Pays }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress" class="my__label">Ville </label>
                                <input type="text" class="form-control shadow-none rounded-0" id="Ville"
                                    name="ville" autocomplete="off" value="{{ $fournisseur->Ville }}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="inputCity" class="my__label">Adresse</label>
                                <input type="text" class="form-control shadow-none rounded-0" id="Adresse"
                                    name="adresse" autocomplete="off" value="{{ $fournisseur->Adresse }}">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <input type="submit" value="Sauvegarder" class="btn rounded-0 btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </form>
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
