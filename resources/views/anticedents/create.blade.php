@extends('layouts.master')

@section('title')
    Antécédents
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Antécédents</h6>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('anticedents.store') }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Antécédents name *</label>
                            <input type="text" class="form-control" name="antecedents_name" id="antecedents_name"
                                aria-describedby="antecedents_name" required>
                            {{ csrf_field() }}
                        </div>
                        <button type="submit" class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
