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
                } else if (selectedValue === "5") {
                    $("#fieldset5").show();
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
                                <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                                <select class="form-control multiselect-doctorino" name="user_id" id="PatientID" required
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
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="patient_title"> </label>
                                    <select class="form-control" id="patient_title" name="patient_title">
                                        <option value="Mr">Mr</option>
                                        <option value="Mlle">Mlle</option>
                                        <option value="Mme">Mme</option>
                                        <option value="L'enfant">L'enfant</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <label for="type">Select a Type:</label>
                            <select class="form-control" id="type" name="rapport_type_id">
                                <option value="">Select a type</option>
                                    <option value="1">Biométrie</option>
                                    <option value="2">A fair svp</option>
                                    <option value="4">Libre</option>
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
                            <input type="submit" value="Sauvegarde" class="btn btn-success" align="right"
                                style=";position: absolute; right: 30px; top: 8px;">
                        </div>
                        <div class="card-body">
                            <fieldset class="drugs_labels" style="border: 1px solid #333; padding: 10px;" id="fieldset1">
                                <div class="chart-container">
                                    <div class="form-group" id="print_area">
                                        <div class="form-group">
                                            @foreach ($settings as $setting)
                                                <div class="text-center">
                                                    <input type="text" class="form-line text-center" id="child_health"
                                                        name="child"
                                                        style="width: 300px; border: none; font-weight: bold;">
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <input type="text" name="ophtalinput1" value="Echo"> +
                                                    <input type="text" name="ophtalinput2" value="Biometrie">
                                                </div>
                                                <br>
                                                <div style=" position: relative; left: 60%;">
                                                    <input type="number" class="form-line" name="nb_jour" id="nb_jour"
                                                        style="width: 120px;" value="300">DH
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <br>
                            <fieldset style="border: 1px solid #333; padding: 10px; border-radius: 10px; margin: 10px 0;"
                                id="fieldset2">
                                <div style="text-align: center; padding: 10px;">
                                    <input type="text" class="form-line text-center" id="child_health1" name="child"
                                        style="width: 300px; border: none; font-weight: bold;"><br><br>
                                    <strong>Faire SVP :</strong>
                                    <ul style="list-style-type: none; padding: 0;">
                                        <li>
                                            <input type="checkbox" name="ophtalinput3" value="Bilan orthoptique"
                                                id="ophtalinput3">
                                            <label for="ophtalinput3">Bilan orthoptique</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="ophtalinput4" value="OCT maculaire papillaire"
                                                id="ophtalinput4">
                                            <label for="ophtalinput4">OCT maculaire papillaire</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="ophtalinput5"
                                                value="Angiographie à la fluorescéine" id="ophtalinput5">
                                            <label for="ophtalinput5">Angiographie à la fluorescéine</label>
                                        </li>
                                    </ul>
                                </div>
                            </fieldset>

                            <br>
                            {{--                        <fieldset style="border: 1px solid #333; padding: 10px;" id="fieldset3"> --}}
                            {{--                            <div class="form-group"> --}}
                            {{--                                Je soussigne <b><label --}}
                            {{--                                        value="{{$setting->option_value}}">{{$setting->option_value}}</label></b><br><br> --}}
                            {{--                                Que <input type="text" class="form-line" id="child_health1" name="child" --}}
                            {{--                                           style="width: 300px; border: none; font-weight:bold;"> est en bonne santé --}}
                            {{--                                et peut Intégrer la crèche sans aucun soucis --}}
                            {{--                            </div> --}}
                            {{--                        </fieldset> --}}
                            <fieldset id="fieldset4">
                                <textarea id="editor" name="libre"></textarea>
                                <script src="{{ asset('dashboard/js/http_cdn.tiny.cloud_1_no-api-key_tinymce_6_tinymce.js') }}" type="text/javascript">
                                </script>
                                <script>
                                    tinymce.init({
                                        selector: "#editor"
                                    });
                                </script>
                            </fieldset>

                            {{--                        <fieldset style="border: 1px solid #333; padding: 10px;" id="fieldset5"> --}}
                            {{--                            <div class="form-group"> --}}
                            {{--                                <h1 style="text-align: center;">شهادة طبية خاصة بإبرام عقد الزواج</h1> --}}
                            {{--                                <p style="text-align: right;"><input type="text" name="name_medcien" id="name_medcien" --}}
                            {{--                                                                     value="{{ App\Setting::get_option('nomearabic') }}" --}}
                            {{--                                                                     lang="ar" dir="rtl" --}}
                            {{--                                                                     style="width: 100px; border: none; font-weight:bold;">أنا --}}
                            {{--                                    الموقع أسفله الدكتور(ة) </p> --}}
                            {{--                                <p style="text-align: right;">اشهد أنني فحصت يومه <input type="text" name="verifie" --}}
                            {{--                                                                                         id="verifie" lang="ar" --}}
                            {{--                                                                                         dir="rtl" --}}
                            {{--                                                                                         style="width: 345px;"> بطلب منه --}}
                            {{--                                    / منها</p> --}}
                            {{--                                <p style="text-align: right;"><input type="text" name="patient_mariage" --}}
                            {{--                                                                     id="patient_mariage" lang="ar" dir="rtl" --}}
                            {{--                                                                     style="width: 435px;"> السيد (ة)</p> --}}
                            {{--                                <p style="text-align: right;"><input type="text" name="patient_cin" id="patient_cin" --}}
                            {{--                                                                     lang="ar" dir="rtl" style="width: 300px;"> رقم --}}
                            {{--                                    البطاقة الوطنية (إن وجدة)</p> --}}
                            {{--                                <p style="text-align: right;">وتبين بعد الفحص السريري أن المعني (ة) بالأمر لا تظهر عليه --}}
                            {{--                                    (ا) أية علامة لمرض ما</p> --}}
                            {{--                                <h4 style="text-align: right">استنتاجات الطبيب</h4> --}}
                            {{--                                <textarea name="conclusion" id="" lang="ar" dir="rtl" rows="5" --}}
                            {{--                                          class="form-control"></textarea> --}}
                            {{--                                <b><p style="text-align: right;">وسلمت هذه الشهادة للمعني بالأمر للإدلاء بها قصد --}}
                            {{--                                        الزواج</p></b> --}}
                            {{--                            </div> --}}
                            {{--                        </fieldset> --}}
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
                    $('input[name="patient_cin"]').val(cin);

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
        {{--    <script> --}}
        {{--        $(document).ready(function() { --}}
        {{--            $("#printButton").click(function() { --}}
        {{--                var ordinanceText = $("#ordinanceText").text(); --}}
        {{--                var printWindow = window.open('', '', 'width=600,height=600'); --}}
        {{--                printWindow.document.open(); --}}
        {{--                printWindow.document.write('<html><head><title>Print</title></head><body>'); --}}
        {{--                printWindow.document.write('<p>' + ordinanceText + '</p>'); --}}
        {{--                printWindow.document.write('</body></html>'); --}}
        {{--                printWindow.document.close(); --}}
        {{--                printWindow.print(); --}}
        {{--                printWindow.close(); --}}
        {{--            }); --}}
        {{--        }); --}}
        {{--    </script> --}}


    </body>

    </html>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
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
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
