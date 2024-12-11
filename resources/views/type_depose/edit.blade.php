@extends('layouts.master')

@section('title')
    Modifier
    une TVA
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Modifier
                        une type dépense</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('type_depose.store_edit', ['id' => $type_depose->id]) }}">
                        @csrf

                        <input type="hidden"value="{{ $type_depose->id }}" name="myid">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="my__label">Libellé <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="name" id="name"
                                value="{{ $type_depose->name }}">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1" class="my__label">value <span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="note" id="note"
                                value="{{ $type_depose->note }}">

                        </div>


                        <div class="col-md-12 d-flex justify-content-end">

                            <button type="submit" class="btn btn-primary rounded-0 ">{{ __('sentence.Save') }}</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
