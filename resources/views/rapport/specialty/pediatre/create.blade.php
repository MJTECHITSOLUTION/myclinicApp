@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rapport</title>
    </head>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function initialize() {
            console.log('test');
            var selectElement = document.getElementById("PatientID");
            var inputElement = document.getElementById("child_health");
            var inputElement1 = document.getElementById("child_health1");
            var inputElement2 = document.getElementById("child_health2");

            // Get the selected option when the page loads
            var selectedOption = selectElement.options[selectElement.selectedIndex];

            // Check if the session variable 'lastpatient' is set
            var lastPatientId = "{{ Session::get('namePatient') }}";

            // Get the trimmed textContent from the selected option
            var selectedText = selectedOption.textContent.trim();

            // Check if 'lastPatientId' is not empty and is equal to the currently selected patient
            if (lastPatientId !== "" && lastPatientId === selectedOption.value) {
                // Do nothing because 'lastpatient' is set, and we don't want to override the input
            } else {
                // Update the input fields with the trimmed selected patient's name
                inputElement.value = selectedText;
                inputElement1.value = selectedText;
                inputElement2.value = selectedText;
            }

            // Add an event listener to the select element to update the input
            selectElement.addEventListener("change", function() {
                var selectedOption = selectElement.options[selectElement.selectedIndex];
                // Get the trimmed textContent from the selected option
                var selectedText = selectedOption.textContent.trim();
                inputElement.value = selectedText;
                inputElement1.value = selectedText;
                inputElement2.value = selectedText;
            });
        }
        window.onload = initialize;
    </script>



    <script>
        $(document).ready(function() {
            $("fieldset").hide();

            $("#type").change(function() {
                var selectedValue = $(this).val();

                $("fieldset").hide();

                if (selectedValue === "1") {
                    $("#fieldset1").show();
                } else if (selectedValue === "2") {
                    $("#fieldset2").show();
                } else if (selectedValue === "3") {
                    $("#fieldset3").show();
                } else if (selectedValue === "4") {
                    $("#fieldset4").show();
                }
            });
        });
    </script>



    <body>
        <form method="post" action="{{ route('rapport.store') }}">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="PatientID" class="my__label">{{ __('sentence.Patient') }} :</label>
                                <select class="form-control multiselect-doctorino rounded-0 shadow-none focus-none"
                                    name="user_id" id="PatientID" required
                                    oninvalid="this.setCustomValidity('Selectionner le patient SVP!')">
                                    <option value="">{{ __('sentence.Select Patient') }}</option>
                                    @foreach ($patients as $patient)
                                        @php
                                            $lastPatientId = Session::get('lastpatient'); // Retrieve the value of 'lastpatient' from the session
                                            $croissance = $patient->croissance; // Assuming there is a one-to-one relationship between Patient and Croissance models
                                        @endphp
                                        <option value="{{ $patient->id }}"
                                            data-birthday="{{ $patient->Patient->birthday ?? '' }}"
                                            data-gender="{{ $patient->Patient->gender ?? '' }}"
                                            data-phone="{{ $patient->Patient->phone ?? '' }}"
                                            data-address="{{ $patient->Patient->adress ?? '' }}"
                                            data-cin="{{ $patient->Patient->cin ?? '' }}"
                                            data-x="{{ $croissance ? $croissance->x : '' }}"
                                            data-y="{{ $croissance ? $croissance->y : '' }}"
                                            @if ($lastPatientId == $patient->id) selected @endif>
                                            {{ $patient->name }}
                                        </option>
                                    @endforeach
                                </select>
                                {{ csrf_field() }}
                            </div>
                            <label for="type">Type rapport:</label>
                            <select class="form-control" id="type" name="rapport_type_id">
                                <option value="">Select a type</option>
                                @foreach ($labels as $label)
                                    <option value="{{ $label->id }}">{{ $label->label }}</option>
                                @endforeach
                            </select>




                            <div id="selected-patient-info">
                                <!-- Placeholder for displaying the selected patient's information -->
                            </div>
                            <div class="form-group">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rapports</h6>
                            <input type="submit" value="Sauvegarde" class="btn btn-primary rounded-0" align="right"
                                style=";position: absolute; right: 30px; top: 8px;">
                        </div>
                        <div class="card-body">
                            <fieldset class="drugs_labels" id="fieldset1">
                                <div class="chart-container">
                                    <div class="form-group" id="print_area">
                                        <div class="form-group">
                                            @foreach ($settings as $setting)
                                                Je soussigne <b><label
                                                        value="{{ $setting->option_value }}">{{ $setting->option_value }}</label></b>
                                                <br><br> Que l'état de santé de l'enfant
                                                <input type="text" class="form-line rounded-0 shadow-none outline-none"
                                                    id="child_health" name="child"
                                                    style="width: 300px; border: none; font-weight:bold;"> <br><br>
                                                Nécessite un repos de <input type="number"
                                                    class="form-line  rounded-0 shadow-none" name="nb_jour" id="nb_jour"
                                                    style="width: 80px;">
                                                jours à partir du <input type="date"
                                                    class="form-line  rounded-0 shadow-none outline-none" id="start_date"
                                                    name="date_debut" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <br>
                            <fieldset id="fieldset2">
                                <div class="form-group">
                                    Je soussigne <b><label
                                            value="{{ $setting->option_value }}">{{ $setting->option_value }}</label></b><br><br>
                                    Que l'état de santé de l'enfant <input type="text" class="form-line"
                                        id="child_health2" name="child"
                                        style="width: 300px; border: none; font-weight:bold;"><br><br>
                                    Nécessite la présence de <input type="text" class="form-line" id="parent"
                                        name="tuteur" style="width: 800px;"> <br><br>
                                    Auprès de lui pendant <input type="number" class="form-line" name="nb_jour1"
                                        id="nb_jour1" style="width: 80px;"> Jours a partir du
                                    <input type="date" class="form-line" id="start_date" name="date_debut"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </fieldset>
                            <br>
                            <fieldset id="fieldset3">
                                <div class="form-group">
                                    Je soussigne <b><label
                                            value="{{ $setting->option_value }}">{{ $setting->option_value }}</label></b><br><br>
                                    Que <input type="text" class="form-line" id="child_health1" name="child"
                                        style="width: 300px; border: none; font-weight:bold;"> est en bonne santé
                                    et peut Intégrer la crèche sans aucun soucis
                                </div>
                            </fieldset>
                            <fieldset id="fieldset4">
                                <textarea id="summernote" name="text"></textarea>

                            </fieldset>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#PatientID').on('change', function() {
                    var selectedOption = $(this).find(':selected');
                    var birthday = selectedOption.data('birthday');
                    var phone = selectedOption.data('phone');
                    var address = selectedOption.data('address');
                    var weight = selectedOption.data('weight');
                    var height = selectedOption.data('height');
                    var blood = selectedOption.data('blood');
                    var gender = selectedOption.data('gender');
                    var cin = selectedOption.data('cin');
                    var patientInfo = '';
                    if (birthday) {
                        var age = calculateAgeWithMonths(birthday);
                        patientInfo += '<p><b>{{ __('sentence.Birthday') }} :</b> ' + birthday + ' (' + age
                            .years + ' ans et ' + age.months + ' mois)</p>';
                    }
                    if (phone) {
                        patientInfo += '<p><b>{{ __('sentence.Phone') }} :</b> ' + phone + '</p>';
                    }
                    if (address) {
                        patientInfo += '<p><b>{{ __('sentence.Address') }} :</b> ' + address + '</p>';
                    }
                    if (blood) {
                        patientInfo += '<p><b>{{ __('sentence.Blood Group') }} :</b> ' + blood + '</p>';
                    }
                    if (gender) {
                        patientInfo += '<p><b>{{ __('sentence.gender') }} :</b> ' + gender + '</p>';
                    }
                    if (cin) {
                        patientInfo += '<p><b>CIN : </b> ' + cin + '</p>';
                    }
                    $('#selected-patient-info').html(patientInfo);
                    $('#child_health').val(selectedOption.text().trim());
                    $('#child_health1').val(selectedOption.text().trim());
                    $('#child_health2').val(selectedOption.text().trim());

                });

                function calculateAgeWithMonths(birthday) {
                    var today = new Date();
                    var birthDate = new Date(birthday);
                    var ageYears = today.getFullYear() - birthDate.getFullYear();
                    var monthDifference = today.getMonth() - birthDate.getMonth();
                    var dayDifference = today.getDate() - birthDate.getDate();

                    if (dayDifference < 0) {
                        monthDifference--;
                    }

                    if (monthDifference < 0) {
                        ageYears--;
                        monthDifference = 12 + monthDifference;
                    }

                    return {
                        years: ageYears,
                        months: monthDifference
                    };
                }

            });
        </script>

    </body>

    </html>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2({
                selectionCssClass: 'my__input__class'
            });
        });
        $(document).ready(function() {
            $('#type').select2({
                selectionCssClass: 'my__input__class'

            });
        });
    </script>
    <script>
        // Function to refresh the input value
        function refreshInputValue(namePatient) {
            document.getElementById("patientNameInput").value = namePatient;
        }
        $(document).ready(function() {
            $('#PatientID').change(function() {
                var selectedPatientId = $(this).val();
                // Make an AJAX request to update the session variables
                $.ajax({
                    url: '/get-patient-data/' + selectedPatientId,
                    method: 'GET',
                    success: function(data) {
                        // Update the variables and page content
                        var namePatient = data.namePatient;
                        var lastPatientId = data.lastPatientId;
                        var imagePatient = data.imagePatient;
                        location.reload();
                        // Update your page elements with the new data
                        $('#namePatientElement').text(namePatient);
                        // Update other elements as needed

                        // Call the refreshInputValue function to update the input
                        refreshInputValue(namePatient);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                }) // Refresh the page
            });
        });
    </script>
    {{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize Summernote
            $('#summernote').summernote({
                tabsize: 2,
                height: 400
            });

        });
    </script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
