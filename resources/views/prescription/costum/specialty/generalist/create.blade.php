<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#PatientID').on('change', function() {
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
                patientInfo += '<p><b>{{ __('sentence.Birthday') }} :</b> ' + birthday + ' (' + age
                    .years + ' A et  ' + age.months + ' M)</p>';
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
            {{-- if (height) { --}}
            {{--    patientInfo += '<p><b>{{ __('sentence.Height') }} :</b> ' + height + ' cm</p>'; --}}
            {{-- } --}}
            {{-- if (blood) { --}}
            {{--    patientInfo += '<p><b>{{ __('sentence.Blood Group') }} :</b> ' + blood + '</p>'; --}}
            {{-- } --}}
            if (cin) {
                patientInfo += '<p><b>CIN : </b> ' + cin + '</p>';
            }
            $('#selected-patient-info').html(patientInfo);
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

@section('content')
    <form method="post" action="{{ route('prescription.store') }}">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                            <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-doctorino"
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
                            {{--                  <input type="submit" value="Créer la consultation" class="btn rounded-0  btn-warning btn-block" align="center"> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Créer consultation</h6>
                            </div>
                            <div class="col-2">
                                <button type="submit"
                                    class="btn rounded-0  btn-primary btn-sm float-right">Sauvegarde</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="motife">Motif de consultation</label>
                                <textarea class="form-control rounded-0 shadow-none " id="motife" name="motife" placeholder=""></textarea>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Examen clinique</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="certificate">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPoid">Poids</label>
                                        <input type="text"class="form-control rounded-0 shadow-none  w-100"
                                            id="inputPoid" name="poid" placeholder="" style="width: 11rem;">
                                        <small id="poidHelp" class="form-text text-muted">Poids en kilogrammes</small>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputTaille">Taille</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100 "
                                            id="inputTaille" name="taille" placeholder="" style="width: 11rem;">
                                        <small id="tailleHelp" class="form-text text-muted">Hauteur en centimètres</small>
                                    </div>
                                    {{--                              <div class="form-group col-md-3"> --}}
                                    {{--                                  <label for="inputPC">Périmètre crânien</label> --}}
                                    {{--                                  <input type="text" class="form-control rounded-0 shadow-none " id="inputPC" name="pc" placeholder="" style="width: 11rem;"> --}}
                                    {{--                                  <small id="padHelp" class="form-text text-muted">Périmètre crânien en cm </small> --}}
                                    {{--                              </div> --}}
                                    <div class="form-group col-md-6">
                                        <label for="inputsa">Saturation en oxygène</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100 "
                                            id="inputsa" name="sa" placeholder="" style="width: 11rem;">
                                        <small id="tempHelp" class="form-text text-muted">Saturation en oxygène</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPAS">PAS</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100 "
                                            id="inputPAS" name="pas" placeholder="" style="width: 11rem;">
                                        <small id="pasHelp" class="form-text text-muted">Pression artérielle systolique en
                                            mmHg</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPAD">TA</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100 "
                                            id="inputPAD" name="pad" placeholder="" style="width: 11rem;">
                                        <small id="padHelp" class="form-text text-muted">Pression artérielle diastolique
                                            en mmHg</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPouls">Fréquence cardiaque</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100 "
                                            id="inputPouls" name="pouls" placeholder="" style="width: 11rem;">
                                        <small id="poulsHelp" class="form-text text-muted">Fréquence cardiaque en
                                            battements par minute</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputfr">Fréquence respiratoire</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100 "
                                            id="inputfr" name="fr" placeholder="" style="width: 11rem;">
                                        <small id="poulsHelp" class="form-text text-muted">Fréquence respiratoire</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputTemp">Température</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100 "
                                            id="inputTemp" name="temp" placeholder="" style="width: 11rem;">
                                        <small id="tempHelp" class="form-text text-muted">Température en °C</small>
                                    </div>

                                    <label for="rapport">Rapport d'examen</label>
                                    <textarea class="form-control rounded-0 shadow-none " id="rapport" name="rapport" rows="5" placeholder=""></textarea>

                            </form>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter ordonnance</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Drug') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter analyses médicals</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Test') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Radios </h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="fai_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i>Ajouter </a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter certificat médical</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputCertificat">Nombre des jours</label>
                            <input type="number" class="form-control rounded-0 shadow-none " id="inputCertificat"
                                name="certificat" placeholder="Les jours du repos" oninput="calculateDates()">
                            <small id="certificatHelp" class="form-text text-muted">Entre les jours du repos.</small>
                            <label for="inputdated">La date de début</label>
                            <input type="date" class="form-control rounded-0 shadow-none " id="dated"
                                name="dated" value="{{ date('Y-m-d') }}" oninput="calculateDates()">
                            <label for="inputdatef">La date de Fin</label>
                            <input type="date" class="form-control rounded-0 shadow-none " id="datef"
                                name="datef">
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Remarque générale</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="bilan">Remarque</label>
                            <textarea class="form-control rounded-0 shadow-none " id="bilan" name="bilan" placeholder=""></textarea>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn rounded-0  btn-primary btn-sm float-right">Sauvegarde</button>





            </div>
        </div>
    </form>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });
    </script>


    <script type="text/template" id="drugs_labels">
<section class="field-group">
                     <div class="row">
                         <div class="col-md-2">
                         </div>
                         <div class="col-md-12">
                             <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                               <option value="">{{ __('sentence.Select Drug') }}...</option>
                               @foreach($drugs as $drug)
                                   <option value="{{ $drug->id }}">{{ $drug->trade_name }}</option>
                               @endforeach
                             </select>
                         </div>
{{--                             <div class="col-md-4">--}}
{{--                                 <div class="form-group-custom">--}}
{{--                                     <input type="text" id="strength" name="strength[]"  class="form-control rounded-0 shadow-none " placeholder="Mg/Ml">--}}
{{--                                 </div>--}}
{{--                             </div>--}}
                     </div>
                        <br>
{{--                         <div class="row">--}}
{{--                             <div class="col-md-6">--}}
{{--                                 <div class="form-group-custom">--}}
{{--                                     <input type="text" id="dose" name="dose[]" class="form-control rounded-0 shadow-none " placeholder="Nombre de fois par jour">--}}
{{--                                     <label class="control-label"></label><i class="bar"></i>--}}

{{--                                 </div>--}}
{{--                             </div>--}}
{{--                             <div class="col-md-6">--}}
{{--                                 <div class="form-group-custom">--}}
{{--                                     <input type="text" id="duration" name="duration[]" class="form-control rounded-0 shadow-none " placeholder="Nombre de jour">--}}
{{--                                 </div>--}}
{{--                             </div>--}}
{{--                         </div>--}}
                     <div class="row">
                         <div class="col-md-9">
                             <div class="form-group-custom">
                                 <input type="text" id="drug_advice" name="drug_advice[]" class="form-control rounded-0 shadow-none " placeholder="Remarque">
                             </div>
                         </div>
                          <div class="col-md-3">
                                <a type="button" class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                           </div>
                           <div class="col-12">
                                <hr color="#a1f1d4">
                          </div>
                     </div>
             </section>

</script>
    <script>
        $(".fai_labels .repeatable").repeatable({
            addTrigger: ".fai_labels .add",
            deleteTrigger: ".fai_labels .delete",
            template: "#fai_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.fai').select2();
            }
        });
        $(".test_labels .repeatable").repeatable({
            addTrigger: ".test_labels .add",
            deleteTrigger: ".test_labels .delete",
            template: "#test_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.analyse').select2();
            }
        });
    </script>
    <script type="text/template" id="test_labels">
<div class="field-group row">
{{--        <div class="form-group col-md-12">--}}
{{--            <label for="test_id">Group d'analyse:</label>--}}
{{--            <select name="test_name[]" class="form-control rounded-0 shoadow-none shadow-none rounded-0 test-select">--}}
{{--                <option value="">Select Group d'analyse</option>--}}
{{--                @foreach ($tests as $test)--}}
{{--                    <option value="{{ $test->id }}">{{ $test->test_name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
    <div class="form-group col-md-12">
        <label for="analyse_id">Analyse:</label>
        <select name="analyse_id[]" id="analyse" class="form-control rounded-0 shoadow-none shadow-none rounded-0 analyse">
            <option value="">Sélectionnez Analyse</option>
            @foreach($analyses as $analyse)
                <option value="{{$analyse->id}}">{{$analyse->analyse_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-9">
        <div class="form-group-custom">
            <input type="text" name="description[]" class="form-control rounded-0 shadow-none " placeholder="{{ __('sentence.Description') }}">
        </div>
    </div>
    <br>
    <div class="col-md-3">
        <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm" align="center">
            <i class="fa fa-plus"></i> {{ __('sentence.Remove') }}
        </a>
    </div>
    <div class="col-12">
        <hr color="#a1f1d4">
    </div>
</div>
</script>

    <script type="text/template" id="fai_labels">
<div class="field-group row">
    <div class="form-group col-md-12">
        <label>Radios </label>

        <select type="text" name="radio_id[]" id="fai" class="form-control rounded-0 shoadow-none shadow-none rounded-0 fai">
            <option value="">Sélectionnez un Radio</option>
            @foreach($radios as $radio)
                <option value="{{$radio->id}}">{{$radio->radio_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-9">
        <div class="form-group-custom">
            <textarea type="text" name="justif[]" class="form-control rounded-0 shadow-none " rows="3" placeholder="Justificatif"></textarea>
        </div>
    </div>
    <br>
    <br>
    <div class="col-md-3">
        <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm" align="center">
            <i class="fa fa-plus"></i> {{ __('sentence.Remove') }}
        </a>
    </div>
    <div class="col-12">
        <hr color="#a1f1d4">
    </div>
</div>
</script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
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




    <script>
        function calculateDates() {
            const daysInput = document.getElementById('inputCertificat');
            const startDateInput = document.getElementById('dated');
            const endDateInput = document.getElementById('datef');

            const days = parseInt(daysInput.value, 10);
            const startDate = new Date(startDateInput.value);

            if (!isNaN(days) && startDate instanceof Date && !isNaN(startDate)) {
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + days - 1); // Subtract 1 day
                endDateInput.value = endDate.toISOString().split('T')[0];
            } else {
                endDateInput.value = '';
            }
        }
    </script>


    <script>
        < script src = "https://code.jquery.com/jquery-3.6.0.min.js" >
    </script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
