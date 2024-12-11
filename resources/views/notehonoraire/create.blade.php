@extends('layouts.master')
@section('title')
    Note d'honoraire
    @endsection
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note d'honoraire</title>
</head>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
<form method="post" action="{{ route('notehonoraire.store') }}">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mb-4" style="position: fixed;">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-10">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                </div>
                <div class="card-body" >
                    <div class="form-group">
                        <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                        <select
                            class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-doctorino"
                            name="patient_id" id="PatientID" required
                            oninvalid="this.setCustomValidity('Selectionner le patient SVP!')">
                            <option value="">{{ __('sentence.Select Patient') }}</option>
                            @php
                                $lastPatientId = Session::get('lastpatient'); // Retrieve the value of 'lastpatient' from the session
                            @endphp

                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}"
                                        data-birthday="{{ $patient->Patient->birthday ?? '' }}"
                                        data-gender="{{ $patient->Patient->gender ?? '' }}"
                                        data-phone="{{ $patient->Patient->phone ?? '' }}"
                                        data-address="{{ $patient->Patient->address ?? '' }}"
                                        data-weight="{{ $patient->Patient->weight ?? '' }}"
                                        data-height="{{ $patient->Patient->height ?? '' }}"
                                        data-blood="{{ $patient->Patient->blood ?? '' }}"
                                        data-cin="{{ $patient->Patient->cin ?? '' }}"
                                        data-assurance="{{ $patient->Patient->assurance ?? '' }}"
                                        @if ($lastPatientId == $patient->id) selected @endif>
                                    <!-- Check if current patient ID matches the lastpatient ID -->
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                        {{ csrf_field() }}
                    </div>
                    <div id="selected-patient-info">
                    </div>
                    <div class="form-group">
                        <div class="card-body text-center" style="padding: 0px;">
                            <img src="{{ asset('img/dent.png') }}" id="map-image" style="min-width: 350px; max-width: 350px; height: auto;" alt="" usemap="#map" />
                            <map name="map">
                                <area shape="poly" coords="266, 272, 280, 276, 282, 295, 279, 302, 255, 305, 248, 295, 247, 282" onclick="('38')" title="38" />
                                <area shape="poly" coords="264, 306, 277, 308, 281, 324, 274, 340, 240, 336, 239, 315, 250, 306" onclick="('37')" title="37" />
                                <area shape="poly" coords="261, 381, 270, 372, 274, 355, 268, 340, 246, 340, 235, 345, 231, 368" onclick="('36')" title="36"/>
                                <area shape="poly" coords="249, 401, 255, 396, 256, 382, 244, 376, 231, 380, 227, 389" onclick="('35')" title="35"/>
                                <area shape="poly" coords="232, 401, 243, 403, 243, 416, 236, 425, 219, 419" onclick="('34')" title="34"/>
                                <area shape="poly" coords="209, 421, 224, 425, 231, 429, 229, 441, 216, 446, 202, 429" onclick="('33')" title="33" />
                                <area shape="poly" coords="190, 438, 198, 435, 207, 437, 209, 448, 198, 458, 185, 442, 187, 440" onclick="('32')" title="32"/>
                                <area shape="poly" coords="171, 448, 182, 445, 188, 448, 188, 458, 174, 463" onclick="('31')" title="31"/>
                                <area shape="poly" coords="152, 445, 164, 446, 166, 454, 166, 463, 146, 458" onclick="('41')" title="41"/>
                                <area shape="poly" coords="135, 435, 145, 435, 146, 442, 148, 451, 141, 456, 126, 453" onclick="('42')" title="42"/>
                                <area shape="poly" coords="123, 421, 132, 423, 132, 429, 128, 438, 123, 445, 105, 439" onclick="('43')" title="43"/>
                                <area shape="poly" coords="103, 400, 111, 401, 113, 409, 116, 417, 113, 426, 102, 425, 91, 417, 93, 409" onclick="('44')" title="44"  />
                                <area shape="poly" coords="96, 377, 104, 381, 107, 392, 98, 399, 93, 402, 80, 396, 79, 387" onclick="('45')" title="45"/>
                                <area shape="poly" coords="95, 339, 102, 348, 104, 359, 103, 372, 83, 380, 73, 380, 61, 359, 61, 348, 77, 343" onclick="('46')" title="46"/>
                                <area shape="poly" coords="83, 306, 94, 308, 98, 323, 97, 332, 89, 340, 67, 341, 59, 329, 57, 313" onclick="('47')" title="47"/>
                                <area shape="poly" coords="77, 271, 88, 278, 91, 292, 88, 301, 72, 307, 60, 304, 54, 294, 57, 276" onclick="('48')" title="48"/>
                                <area shape="poly" coords="77, 213, 90, 218, 92, 230, 85, 242, 70, 248, 55, 241, 54, 221, 61, 215" onclick="('18')" title="18"/>
                                <area shape="poly" coords="77, 178, 92, 185, 95, 198, 90, 210, 69, 212, 55, 207, 55, 190, 60, 182" onclick="('17')" title="17"/>
                                <area shape="poly" coords="94, 149, 100, 152, 99, 165, 95, 180, 67, 176, 58, 169, 61, 150, 71, 143" onclick="('16')" title="16"/>
                                <area shape="poly" coords="101, 125, 104, 133, 99, 144, 84, 145, 72, 137, 72, 121, 79, 119, 91, 119" onclick="('15')" title="15"/>
                                <area shape="poly" coords="113, 106, 112, 114, 100, 120, 87, 115, 82, 104, 93, 93" onclick="('14')" title="14"/>
                                <area shape="poly" coords="112, 69, 104, 72, 99, 76, 96, 84, 101, 90, 108, 96, 118, 97, 125, 89, 125, 84, 122, 74" onclick="('13')" title="13"/>
                                <area shape="poly" coords="135, 58, 123, 62, 120, 69, 127, 78, 137, 79, 143, 72, 144, 63" onclick="('12')" title="12"/>
                                <area shape="poly" coords="164, 65, 152, 67, 142, 59, 149, 50, 160, 45, 168, 60" onclick="('11')" title="11" />
                                <area shape="poly" coords="185, 68, 174, 63, 171, 54, 171, 45, 184, 46, 195, 50, 196, 62" onclick="('21')" title="21"/>
                                <area shape="poly" coords="195, 70, 208, 82, 218, 64, 207, 58, 199, 58" onclick="('22')" title="22"/>
                                <area shape="poly" coords="244, 85, 241, 74, 231, 70, 221, 70, 218, 78, 216, 88, 222, 96" onclick="('23')" title="23"/>
                                <area shape="poly" coords="257, 106, 253, 97, 245, 92, 234, 92, 230, 101, 229, 111, 233, 119, 252, 117" onclick="('24')" title="24"/>
                                <area shape="poly" coords="268, 133, 267, 122, 259, 117, 247, 118, 236, 128, 238, 139, 247, 144, 263, 142" onclick="('25')" title="25"/>
                                <area shape="poly" coords="276, 172, 280, 164, 279, 150, 270, 144, 257, 144, 242, 148, 240, 160, 240, 173, 243, 181" onclick="('26')" title="26"/>
                                <area shape="poly" coords="282, 205, 283, 187, 273, 178, 258, 179, 248, 185, 243, 200, 254, 213, 280, 210" onclick="('27')" title="27"/>
                                <area shape="poly" coords="283, 236, 280, 244, 261, 247, 246, 237, 249, 218, 267, 214, 279, 217" onclick="('28')" title="28"/>
                            </map>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Note d'honoraire</h6>
                    <input type="submit" value="Sauvegarde" class="btn btn-success" align="right" style="position: absolute; right: 30px; top: 8px;">
                    <button onclick="addRow(event)" class="btn btn-primary" style="position: absolute; right: 150px; top: 8px;">Ajoute</button>
                </div>
                <div class="card-body">
                    <table id="rapportTable" class="table">
                        <thead>
                        <tr>
                            <th>Nom Act</th>
                            <th>Code</th>
                            <th>Lettre Clé</th>
                            <th>Date</th>
                            <th>Dents</th>
                            <th>Montant</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Rows will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Define the event handler
            $('#PatientID').on('change', function () {
                var selectedOption = $(this).find(':selected');
                var birthday = selectedOption.data('birthday');
                var phone = selectedOption.data('phone');
                var address = selectedOption.data('address');
                var assurance = selectedOption.data('assurance');
                var height = selectedOption.data('height');
                var blood = selectedOption.data('blood');
                var cin = selectedOption.data('cin');

                var patientInfo = '';
                if (birthday) {
                    var age = calculateAgeWithMonths(birthday);
                    patientInfo += '<p><b>{{ __('sentence.Birthday') }} :</b> ' + birthday + ' (' + age.years + ' A et  ' + age.months + ' M)</p>';
                }
                if (phone) {
                    patientInfo += '<p><b>{{ __('sentence.Phone') }} :</b> ' + phone + '</p>';
                }
                if (address) {
                    patientInfo += '<p><b>{{ __('sentence.Address') }} :</b> ' + address + '</p>';
                }
                if (assurance) {
                    patientInfo += '<p><b>{{ __('sentence.assurance') }} :</b> ' + assurance + ' </p>';
                }
                if (height) {
                    patientInfo += '<p><b>{{ __('sentence.Height') }} :</b> ' + height + ' cm</p>';
                }
                if (blood) {
                    patientInfo += '<p><b>{{ __('sentence.Blood Group') }} :</b> ' + blood + '</p>';
                }
                if (cin) {
                    patientInfo += '<p><b>CIN : </b> ' + cin + '</p>';
                }
                $('#selected-patient-info').html(patientInfo);
            });

            // Trigger the change event when the page loads
            $('#PatientID').trigger('change');

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
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });
        $(document).ready(function() {
            $('#type').select2();
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
                })// Refresh the page
            });
        });
    </script>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
    <script>
        function addRow(event) {
            event.preventDefault();

            var table = document.getElementById("rapportTable");
            var rowCount = table.rows.length;

            // Check if the number of rows is greater than or equal to 9
            if (rowCount >= 9) {
                alert("Vous ne pouvez pas ajouter plus de 9 lignes.");
                return;
            }

            var row = table.insertRow(rowCount);

            // Get acts data from a hidden field or a JavaScript variable
            var acts = @json($acts);

            var cell1 = row.insertCell(0);
            var element1 = document.createElement("select");
            element1.name = "act_name[]";
            element1.className = "form-control";
            element1.onchange = function() {
                var selectedAct = acts.find(act => act.id == this.value);
                if (selectedAct) {
                    element2.value = selectedAct.ref;
                    element3.value = selectedAct.lettre;
                    element6.value = selectedAct.cout;
                }
            };

            acts.forEach(function(act) {
                var option = document.createElement("option");
                option.value = act.id;
                option.text = act.name;
                element1.appendChild(option);
            });
            cell1.appendChild(element1);

            var cell2 = row.insertCell(1);
            var element2 = document.createElement("input");
            element2.type = "text";
            element2.name = "code[]";
            element2.className = "form-control";
            element2.placeholder = "Code";
            cell2.appendChild(element2);

            var cell3 = row.insertCell(2);
            var element3 = document.createElement("input");
            element3.type = "text";
            element3.name = "lettrecle[]";
            element3.className = "form-control";
            element3.placeholder = "Lettre Clé";
            cell3.appendChild(element3);

            var cell4 = row.insertCell(3);
            var element4 = document.createElement("input");
            element4.type = "date";
            element4.name = "date[]";
            element4.className = "form-control";
            cell4.appendChild(element4);

            var cell5 = row.insertCell(4);
            var element5 = document.createElement("input");
            element5.type = "text";
            element5.name = "dents[]";
            element5.className = "form-control";
            element5.placeholder = "Dents";
            cell5.appendChild(element5);

            var cell6 = row.insertCell(5);
            var element6 = document.createElement("input");
            element6.type = "number";
            element6.name = "montant[]";
            element6.className = "form-control";
            element6.placeholder = "Montant";
            cell6.appendChild(element6);
        }
    </script>


@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
