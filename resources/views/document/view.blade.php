@extends('layouts.master')

@section('title')
    {{ __('sentence.All documents') }}
@endsection

@section('content')

    <div class="container">
        <iframe
            src="{{ asset('/uploads/'.$document->file) }}"
            width="100%"
            height="800"
        ></iframe>
    </div>
@endsection
