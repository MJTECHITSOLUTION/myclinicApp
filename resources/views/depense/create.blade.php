@extends('layouts.master')

@section('title')
    Ajouter un Déposes
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter une Dépose</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('depense.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="" class="my__label">Libellé <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="label"
                                    id="label">
                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="" class="my__label">Montant <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="monton"
                                    id="monton">
                            </div>

                            <div class="form-group col-6">
                                <label for="" class="my__label">Type dépose <span
                                        class="text-danger"></span></label>
                                <select name="type_depenses" id="type_depenses"
                                    class='form-control rounded-0 w-100 shadow-none'>
                                    @foreach ($type_depenses as $type_depense)
                                        <option value="{{ $type_depense->name }}">{{ $type_depense->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="form-row">

                            <div class="form-group col-6">
                                <label for="" class="my__label">Tiers <span class="text-danger"></span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="created_by"
                                    id="created_by">
                            </div>

                            <div class="form-group col-6">
                                <label for="" class="my__label"> Référence <span class="text-danger"></span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="reference"
                                    id="reference">
                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="" class="my__label">Remarque <span class="text-danger"></span></label>
                                <textarea name="note" id="" class="form-control rounded-0 w-100 shadow-none"></textarea>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-0 shadow-none">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
