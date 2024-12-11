@extends('layouts.master')
@section('title')
{{ __('sentence.New Prescription') }}
@endsection

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphe</title>
</head>
<body>
<form method="post" action="{{ route('graph.store') }}">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                        <select class="form-control multiselect-doctorino" name="user_id" id="PatientID" disabled>
                                <option value="{{ $patient->id }}">
                                    {{ $patient->name }}
                                </option>
                        </select>
                        {{ csrf_field() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.graph') }}</h6>
{{--                    @forelse($croissances as $croissance)--}}
{{--                    <a href="{{ url('graph/edit/'.$croissance->id.'?label='.$croissance->label.'&graph_id='.$croissance->graph_id) }}"--}}
{{--                       class="btn btn-primary"--}}
{{--                       style="position: absolute; right: 30px; top: 8px; text-decoration: none; color: white;">--}}
{{--                        Edit le Graph--}}
{{--                    </a>--}}
{{--                    @empty--}}
{{--                    @endforelse--}}
                </div>
                <div class="card-body">
                    <fieldset class="drugs_labels">
                        <div class="chart-container">
                            @foreach($gras as $gra)
                                <img src="{{ asset('img/graph/' . $gra->image.".png") }}" id="chart-image" style="max-width: 1000px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);" />
                            @endforeach
                            @foreach($statistics as $statistic)
                                @if(!is_null($statistic->x) && !is_null($statistic->y))
                                    <div class="point point-marker" style="left: {{ $statistic->x }}px; top: {{ $statistic->y }}px; background-color: red;" data-point-id="{{ $statistic->id }}"></div>
                        @endif
                        @endforeach
                    </fieldset>
                </div>
                <input type="hidden" name="x" id="x">
                <input type="hidden" name="y" id="y">
            </div>
        </div>
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>

@endsection

@section('footer')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .point-marker {
            width: 5px;
            height: 5px;
            background-color: red;
            border-radius: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
        }
        .chart-container {
            position: relative;
            max-width:1000px;
            max-height: 1000px;
        }
    </style>

@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
