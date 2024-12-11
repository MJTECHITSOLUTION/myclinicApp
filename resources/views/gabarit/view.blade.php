@extends('layouts.master')
@section('title')
    Gabarit
    @endsection
    @section('content')
        <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rapport</title>
    </head>

    <body>
{{--    <form method="post" action="{{ route('gabarit.store_patient') }}">--}}
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control multiselect-doctorino" name="user_id" id="PatientID" disabled>
                                @foreach($gabarits_patients as $patient)
                                    <option value="">
                                        {{ $patient->user_name }}
                                    </option>
                                @endforeach
                            </select>

                            {{ csrf_field() }}
                        </div>

                        <br>
                        <label for="type">Type rapport </label>
                        <select class="form-control" id="type" name="template_name" disabled>
                            @foreach($gabarits_patients as $gabarit)
                                <option value="{{$gabarit->text}}" data-created-date="{{$gabarit->created_at->format('d-m-Y')}}">
                                    {{$gabarit->template_name}}
                                </option>
                            @endforeach
                        </select>



                        <div class="form-group">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Rapports</h6>
                        <button id="printButton" class="btn btn-success" style="position: absolute; right: 30px; top: 8px;"  align="right">Imprimer</button>
{{--                        <input type="submit" value="Sauvegarde" class="btn btn-success" style="position: absolute; right: 30px; top: 8px;" align="right"/>--}}
                    </div>
                    <div class="card-body">
                        <textarea id="summernote" name="text"></textarea>
                    </div>

                </div>
            </div>
        </div>
{{--    </form>--}}



    </body>

    </html>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote with readOnly option
            $('#summernote').summernote({
                height: 500,
                toolbar: false,
                disableDragAndDrop: true,
                dialogsInBody: true,
            });

            // Handle dropdown change event
            $('#type').change(function() {
                // Get the selected option's value
                var selectedText = $(this).val();

                // Get the selected option's created_at value
                var createdDate = $(this).find(':selected').data('created-date');

                // Set the Summernote editor content with the selected text
                $('#summernote').summernote('code', selectedText);

                // Save the selected text and created date to local storage
                localStorage.setItem('selectedText', selectedText);
                localStorage.setItem('createdDate', createdDate);
            });

            // Trigger change event to set default content on page load
            $('#type').trigger('change');

            // Check if there is a selected text in local storage
            var storedSelectedText = localStorage.getItem('selectedText');
            var storedCreatedDate = localStorage.getItem('createdDate');
            if (storedSelectedText !== null && storedCreatedDate !== null) {
                // Set the Summernote editor content with the stored selected text
                $('#summernote').summernote('code', storedSelectedText);
            }

            // Handle printing when the button is clicked
            $('#printButton').click(function() {
                // Get the HTML content of the Summernote editor
                var summernoteContent = $('#summernote').summernote('code');

                // Get the stored created date
                var storedCreatedDate = localStorage.getItem('createdDate');

                // Open a new window and print the content
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('@if( (App\Setting::get_option('use_entete') === 'yes')) '+'@if (!empty(App\Setting::get_option("imagerapport")))'+
                    '<img src="{{ asset("uploads/" . App\Setting::get_option("imagerapport")) }}" class="img-fluid" alt="Logo" style="max-width: 100%"><br><br>'+
                    '@endif'+'@else<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>@endif'+
                    '<div class="col" style="font-size: large; margin-left: 25px; margin-right: 25px;">' +
                    '<p style="float: right;">{{ App\Setting::get_option("ville") }} ,{{ __("sentence.On") }} : ' + storedCreatedDate + '</p>' +
                    '</div><br><br><br>' +
                    summernoteContent +
                    '');
                printWindow.document.write('@if( (App\Setting::get_option('use_pied') === 'yes'))'+'<img src="{{ asset("uploads/" . App\Setting::get_option("piedrapport")) }}" style="position: fixed; bottom: 0; left: 0; right: 0; margin: auto;max-width: 100%;" />'+'@endif');
                printWindow.document.close();
                printWindow.print();

            });
        });
    </script>

@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

