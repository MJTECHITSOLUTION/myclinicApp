@extends('layouts.master')

@section('title')
    Ajouter un Déposes
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un Déposes</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('depense.store_edit') }}" method="POST">
                        @csrf

                        <input type="hidden"value="{{ $depense->id }}" name="myid">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="" class="my__label">Libellé <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="label"
                                    id="label" value="{{ $depense->label }}">

                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="" class="my__label">Montant <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="monton"
                                    id="monton" value="{{ $depense->monton }}">

                            </div>

                            <div class="form-group col-6">
                                <label for="" class="my__label">Type dépose <span
                                        class="text-danger"></span></label>
                                <select type="text" class="form-control rounded-0 w-100 shadow-none" name="type_depenses"
                                    id="type_depenses" value="{{ $depense->type_depenses }}">


                                    @foreach ($type_depenses as $type_depense)
                                        @if ($type_depense->name == $depense->type_depenses)
                                            <option value="{{ $type_depense->name }}" selected>{{ $type_depense->name }}
                                            </option>
                                        @else
                                            <option value="{{ $type_depense->name }}">{{ $type_depense->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="" class="my__label">Tiers <span class="text-danger"></span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="created_by"
                                    id="created_by" value="{{ $depense->created_by }}">

                            </div>
                            <div class="form-group col-6">
                                <label for="" class="my__label"> Référence <span class="text-danger"></span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="reference"
                                    id="reference" value="{{ $depense->reference }}">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="" class="my__label">Remarque <span class="text-danger"></span></label>
                                <textarea name="note" id="" class="form-control rounded-0 w-100 shadow-none">{{ $depense->note }}
                                </textarea>
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
