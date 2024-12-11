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
        <form method="post" action="{{ route('gabarit.patient_update') }}">
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
                        </select>
                        <input type="hidden" name="id" value="{{$patient->id}}">
                        @endforeach

                        {{ csrf_field() }}
                    </div>

                    <br>
                    <label for="type">Nom de gabarit:</label>
                    <select class="form-control" id="type" name="template_name" disabled>
                        @foreach($gabarits_patients as $gabarit)
                            <option value="{{$gabarit->text}}">
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
{{--                    <button id="printButton" class="btn btn-success" style="position: absolute; right: 30px; top: 8px;"  align="right">Imprimer</button>--}}
                    <input type="submit" value="Sauvegarde" class="btn btn-success" style="position: absolute; right: 30px; top: 8px;" align="right"/>


                </div>
                <div class="card-body">
                    <textarea id="summernote" name="text"></textarea>
                </div>

            </div>
        </div>
    </div>
        </form>



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

                // Set the Summernote editor content with the selected text
                $('#summernote').summernote('code', selectedText);

                // Save the selected text to local storage
                localStorage.setItem('selectedText', selectedText);
            });

            // Trigger change event to set default content on page load
            $('#type').trigger('change');

            // Check if there is a selected text in local storage
            var storedSelectedText = localStorage.getItem('selectedText');
            if (storedSelectedText !== null) {
                // Set the Summernote editor content with the stored selected text
                $('#summernote').summernote('code', storedSelectedText);
            }

            // Handle printing when the button is clicked
            $('#printButton').click(function() {
                // Get the HTML content of the Summernote editor
                var summernoteContent = $('#summernote').summernote('code');

                // Open a new window and print the content
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Imprimer</title></head><body><br><br><br><br><br><br><br>' + summernoteContent + '</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        });


    </script>

    <!-- Include jQuery -->
    {{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}


@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
