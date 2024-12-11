@extends('layouts.master')
@section('title')
{{ __('sentence.New Prescription') }}
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphe</title>
</head>
<body>
<style>
    .point-marker {
        width: 10px;
        height: 10px;
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
{{--<form method="post" action="" onsubmit="return false;">--}}
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                        <select class="form-control multiselect-doctorino" name="user_id" id="user_id">
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
{{--                    <input type="submit" value="Modifier le graph" class="btn btn-success" align="right" style=";position: absolute; right: 30px; top: 8px;">--}}
                </div>
                <div class="card-body">
                    <fieldset class="drugs_labels">
                        <div class="chart-container">
                            @foreach($gras as $gra)
                                <img src="{{ asset('img/graph/' . $gra->image.".png") }}" id="chart-image" style="max-width: 1000px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);" />
                            @endforeach
                            @foreach($statistics as $statistic)
                                    <input type="hidden" name="graph_id" id="graph_id" value="{{$statistic->graph_id}}">
                                    <div class="point point-marker" style="left: {{ $statistic->x }}px; top: {{ $statistic->y }}px; background-color: red;" data-point-id="{{ $statistic->id }}">
{{--                                        <button class="small-round-button delete-btn" onclick="deletePoint({{$statistic->id}})">Delete</button>--}}
                                        <button class="delete-btn" data-point-id="{{ $statistic->id }}">effacer</button>
                                    </div>
                        @endforeach
                    </fieldset>
                </div>
                    <input type="hidden" name="x" id="x">
                    <input type="hidden" name="y" id="y">
            </div>
        </div>
    </div>
{{--</form>--}}

<script>
    $(document).ready(function() {
        $('#chart-image').click(function (event) {
            console.log('hey');
            var x = event.pageX - $(this).offset().left;
            var y = event.pageY - $(this).offset().top;


            var pointElement = $('<div class="point-marker"></div>');

            pointElement.css({
                left: x + 'px',
                top: y + 'px',
            })
            $('.chart-container').append(pointElement);

            $('#x').val(x);
            $('#y').val(y);
            var user_id = $('#user_id').val();
            var graph_id = $('#graph_id').val();
            console.log(graph_id);
            $.ajax({
                type: 'POST',
                url: '{{ route('point-save') }}',
                data: { x: x, y: y, user_id : user_id ,graph_id : graph_id, _token: '{{ csrf_token() }}' },
                success: function (data) {
                    alert("vous avez bien ajoute le point");
                },
                error: function (error) {
                    alert('Error occurred while saving the point.');
                }
            });
        });

    });
    $(document).on('click', '.point-marker', function() {
        $(this).remove();
        $('#x').val('');
        $('#y').val('');
    });
</script>
<script>
    $(document).on('click', '.delete-btn', function (event) {
        event.stopPropagation();
        var pointId = $(this).data('point-id');
        console.log(pointId);
        $.ajax({
            type: 'POST',
            url: '/delete-point',
            data: { pointId: pointId, _token: '{{ csrf_token() }}' },
            success: function (data) {
                $('.point[data-point-id="' + pointId + '"]').remove();
                alert(data.message);
            },
            error: function (error) {
                alert("Une erreur s'est produite lors de la suppression du point.");
            }
        });
    });
</script>

</body>
<style>

</style>
</html>

@endsection

@section('footer')

{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}

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
    .delete-btn {
        font-size: 8px;
        padding: 3px 8px;
        border: none;
        border-radius: 5px;
        background-color: #dc3545;
        color: white;
        cursor: pointer;
    }
</style>
@endsection

@section('header')
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
@endsection
