@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit assurance') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modifier Antécédents
                        </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('anticedents.store_edit') }}">
                        <div class="form-group">
                            <label for="assurance_name">Nom de antécédents *</label>
                            <input type="hidden" name="id" value="{{ $antecedents->id }}">
                            <input type="text" class="form-control" name="antecedents_name" id="antecedents_name"
                                aria-describedby="TradeName" value="{{ $antecedents->antecedents_name }}">
                            {{ csrf_field() }}
                        </div>
                        <button type="submit" class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
