@section('content')
    <?php
    use Carbon\Carbon;

    function calculateAgeWithMonths($birthday)
    {
        $today = Carbon::now();
        $birthDate = Carbon::parse($birthday);

        $age = $today->diff($birthDate);
        $ageYears = $age->y;
        $ageMonths = $age->m;

        return "$ageYears ans et $ageMonths mois";
    }
    ?>
    <form method="post" action="{{ route('prescription.update') }}">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                            <option value="{{ $prescription->user_id }}">{{ $prescription->User->name }} -
                                ({{ calculateAgeWithMonths($prescription->User->Patient->birthday) }})</option>
                            <input type="hidden" name="patient_id" value="{{ $prescription->user_id }}">
                            <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
                            {{ csrf_field() }}
                        </div>
                        {{--                        <div class="form-group text-center"> --}}
                        {{--                            <img src="{{ asset('img/patient-icon.png') }}" class="img-profile rounded-circle img-fluid"> --}}
                        {{--                        </div> --}}
                        <div class="form-group">
                            {{--                            <input type="submit" value="{{ __('sentence.Edit Prescription') }}" class="btn btn-warning btn-block" align="center"> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Motif de consultation</h6>
                            </div>
                            <div class="col-2">
                                <button type="submit"
                                    class="btn btn-primary  rounded-0 shadow-none btn-sm float-right">Enregistre
                                    tout</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="age">Age</label>
                                <input type="text" class="form-control  rounded-0 shadow-none" id="age"
                                    name="age" placeholder="" value="{{ $prescription->age }}">
                            </div>
                            <div class="form-group col-md-9">
                                <label for="motife">Motif de consultation</label>
                                <textarea class="form-control rounded-0 shadow-none" id="motife" name="motife" placeholder=""
                                    value="{{ $prescription->motife }}">{{ $prescription->motife }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Constantes</h6>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Constantes</h6>
                        </div>
                        <div class="card-body">
                            <fieldset class="certificate">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputPoid">Poid</label>
                                            <input type="hidden" name="user_id" value="{{ $prescription->user_id }}">
                                            <input type="hidden" name="reference" value="{{ $prescription->reference }}">
                                            <input type="text" class="form-control" id="inputPoid" name="poid" placeholder="" style="width: 11rem;" value="{{ $prescription->poid}}">
                                            <small id="poidHelp" class="form-text text-muted">Weight in kilograms</small>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputTaille">Taille</label>
                                            <input type="text" class="form-control" id="inputTaille" name="taille" placeholder="" style="width: 11rem;" value="{{ $prescription->taille}}" >
                                            <small id="tailleHelp" class="form-text text-muted">Height in centimeters</small>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputPC">Périmètre crânien</label>
                                            <input type="text" class="form-control" id="inputPC" name="pc" placeholder="" style="width: 11rem;" value="{{$prescription->pc}}">
                                            <small id="padHelp" class="form-text text-muted">Périmètre crânien en cm </small>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputsa">Saturation en oxygène</label>
                                            <input type="text" class="form-control" id="inputsa" name="sa" placeholder="" style="width: 11rem;" value="{{ $prescription->sa }}">
                                            <small id="tempHelp" class="form-text text-muted">Saturation en oxygène</small>
                                        </div>
                                        {{--                                    <div class="form-group col-md-3">--}}
                                        {{--                                        <label for="inputPAS">PAS</label>--}}
                                        {{--                                        <input type="number" class="form-control" id="inputPAS" name="pas" placeholder="" style="width: 11rem;" value="{{ $prescription->pas}}">--}}
                                        {{--                                        <small id="pasHelp" class="form-text text-muted">Systolic blood pressure in mmHg</small>--}}

                                        {{--                                    </div>--}}
                                        <div class="form-group col-md-3">
                                            <label for="inputPAD">TA</label>
                                            <input type="text" class="form-control" id="inputPAD" name="pad" placeholder="" style="width: 11rem;" value="{{ $prescription->pad}}">
                                            <small id="padHelp" class="form-text text-muted">Diastolic blood pressure in mmHg</small>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPouls">Fréquence cardiaque</label>
                                            <input type="text" class="form-control" id="inputPouls" name="pouls" placeholder="" style="width: 11rem;" value="{{ $prescription->pouls}}">
                                            <small id="poulsHelp" class="form-text text-muted">Fréquence cardiaque en battements par minute</small>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputfr">Fréquence respiratoire</label>
                                            <input type="text" class="form-control" id="inputfr" name="fr" placeholder="" style="width: 11rem;" value="{{$prescription->fr}}">
                                            <small id="poulsHelp" class="form-text text-muted">Fréquence respiratoire</small>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputTemp">température</label>
                                            <input type="text" class="form-control" id="inputTemp" name="temp" placeholder="" style="width: 11rem;" value="{{ $prescription->temp}}">
                                            <small id="tempHelp" class="form-text text-muted">Température en °C</small>
                                        </div>

                                    </div>
                                    <label for="motife">Rapport d'examen</label>
                                    <textarea class="form-control" id="rapport" name="rapport" rows="15" placeholder="" value="{{$prescription->rapport}}">{{$prescription->rapport}}</textarea>
                                </form>
                            </fieldset>
                        </div>
                    </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Drugs list') }}</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable">
                                @foreach ($prescription_drugs as $prescription_drug)
                                    <section class="field-group">
                                        <div class="row">
                                            {{--                                            <div class="col-md-2"> --}}
                                            {{--                                                <div class="form-group-custom"> --}}
                                            {{--                                                    <input type="text" class="form-control" name="type[]" id="task_{?}" placeholder="{{ __('sentence.Type') }}" class="ui-autocomplete-input" autocomplete="off" value="{{ $prescription_drug->type }}"> --}}
                                            {{--                                                    <label class="control-label"></label><i class="bar"></i> --}}
                                            {{--                                                    <input type="hidden" name="prescription_drug_id[]" value="{{ $prescription_drug->id }}"> --}}
                                            {{--                                                </div> --}}
                                            {{--                                            </div> --}}
                                            <div class="form-group col-md-12">
                                                <select class="form-control multiselect-drug" name="trade_name[]"
                                                    id="drug" tabindex="-1" aria-hidden="true" required>
                                                    <option value="{{ $prescription_drug->drug_id }}">
                                                        {{ $prescription_drug->Drug->trade_name }}</option>
                                                    @foreach ($drugs as $drug)
                                                        <option value="{{ $drug->id }}">{{ $drug->trade_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{--                                            <div class="col-md-4"> --}}
                                            {{--                                                <div class="form-group-custom"> --}}
                                            {{--                                                    <input type="text" id="strength" name="strength[]"  class="form-control" placeholder="Mg/Ml" value="{{ $prescription_drug->strength }}"> --}}
                                            {{--                                                </div> --}}
                                            {{--                                            </div> --}}
                                        </div>

                                        {{--                                        <div class="row"> --}}

                                        {{--                                            <div class="col-md-6"> --}}
                                        {{--                                                <div class="form-group-custom"> --}}
                                        {{--                                                    <input type="text" id="dose" name="dose[]" class="form-control" placeholder="{{ __('sentence.Dose') }}" value="{{ $prescription_drug->dose }}"> --}}
                                        {{--                                                    <label class="control-label"></label><i class="bar"></i> --}}

                                        {{--                                                </div> --}}
                                        {{--                                            </div> --}}
                                        {{--                                            <div class="col-md-6"> --}}
                                        {{--                                                <div class="form-group-custom"> --}}
                                        {{--                                                    <input type="text" id="duration" name="duration[]" class="form-control" placeholder="{{ __('sentence.Duration') }}" value="{{ $prescription_drug->duration }}"> --}}
                                        {{--                                                </div> --}}
                                        {{--                                            </div> --}}
                                        {{--                                        </div> --}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group-custom">
                                                    <textarea class="form-control" id="drug_advice" name="drug_advice[]"
                                                        class="form-controlx rounded-0 shadow-none"
                                                        placeholder="{{ __('sentence.Advice_Comment') }}"
                                                              value="{{ $prescription_drug->drug_advice }}">{{ $prescription_drug->drug_advice }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <a type="button"
                                                   class="btn btn-danger  rounded-0 shadow-none btn-sm text-white span-2 delete"><i
                                                        class="fa fa-trash font-size-12"></i>
                                                    {{ __('sentence.Remove') }}</a>
                                                <hr color="red">
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm  rounded-0 shadow-none btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Drug') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Tests list') }}</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable">
                                @foreach ($prescription_tests as $prescription_test)
                                    <div class="field-group row">
                                        <div class="form-group col-md-12" style="display: none;">
                                            <label for="test_id">Group d'analyse:</label>
                                            <select name="test_name[]" class="form-control test-select">
                                                <option value="{{ $prescription_test->test_id }}">
                                                    {{ $prescription_test->Test->test_name }} </option>
                                                @foreach ($tests as $test)
                                                    <option value="{{ $test->id }}">{{ $test->test_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="analyse_id">Analyse:</label>
                                            <select name="analyse_id[]" class="form-control analyse-select">
                                                @foreach ($analyses as $analysis)
                                                    <option value="{{ $analysis->id }}"
                                                        {{ old('analyse_id', $prescription_test->analyse_id) == $analysis->id ? 'selected' : '' }}>
                                                        {{ $analysis->analyse_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-9">
                                            <div class="form-group-custom">
                                                <input type="text" id="strength" name="description[]"
                                                    class="form-control  rounded-0 shadow-none"
                                                    placeholder="{{ __('sentence.Description') }}"
                                                    value="{{ $prescription_test->description }}">
                                                <input type="hidden" name="prescription_test_id[]"
                                                    value="{{ $prescription_test->id }}">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button"
                                                class="btn btn-danger  rounded-0 shadow-none delete text-white btn-sm"
                                                align="center"><i class="fa fa-trash font-size-12"></i>
                                                {{ __('sentence.Remove') }}</a>

                                        </div>
                                        <div class="col-12">
                                            <hr color="#a1f1d4">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary  rounded-0 shadow-none add text-white"
                                    align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Test') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Faire SVP</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="fai_labels">
                            <div class="repeatable">
                                @foreach ($prescription_radio as $radio)
                                    <div class="field-group row">
                                        <div class="form-group col-md-12">
                                            <label>Faire SVP</label>
                                            <input type="text" name="radio[]" id="fai"
                                                class="form-control  rounded-0 shadow-none" value="{{ $radio->radio }}">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group-custom">
                                                <input type="hidden" name="prescription_radio_id[]"
                                                    value="{{ $radio->id }}">

                                                <textarea type="text" name="justif[]" class="form-control" rows="3" placeholder="Justificatif"
                                                    value="{{ $radio->justif }}">{{ $radio->justif }}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-3">
                                            <a type="button"
                                                class="btn btn-danger  rounded-0 shadow-none delete text-white btn-sm"
                                                align="center">
                                                <i class="fa fa-plus"></i> {{ __('sentence.Remove') }}
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <hr color="#a1f1d4">
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary  rounded-0 shadow-none add text-white"
                                    align="center"><i class='fa fa-plus'></i>Ajouter </a>
                            </div>
                        </fieldset>
                    </div>

                </div>




                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Remarque générale</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="bilan">Remarque</label>
                            <textarea class="form-control rounded-0 shadow-none" id="bilan" name="bilan" placeholder=""
                                value="{{ $prescription->bilan }}">{{ $prescription->bilan }}</textarea>
                        </div>
                    </div>
                </div>
                {{--                <div class="card shadow mb-4"> --}}
                {{--                    <div class="card-header py-3"> --}}
                {{--                        <h6 class="m-0 font-weight-bold text-primary">Certification</h6> --}}
                {{--                    </div> --}}
                {{--                    <div class="card-body"> --}}
                {{--                        <div class="form-group"> --}}
                {{--                            <label for="inputCertificat">Les jours</label> --}}
                {{--                            <input type="number" class="form-control" id="inputCertificat" name="certificat" value="{{$prescription->certificat}}" placeholder="Les jours du repos" oninput="calculateDates()"> --}}
                {{--                            <small id="certificatHelp" class="form-text text-muted">Entre les jours du repos.</small> --}}
                {{--                            <label for="inputdated">La date de début</label> --}}
                {{--                            <input type="date" class="form-control" id="dated" name="dated" value="{{ date('Y-m-d') }}" oninput="calculateDates()"> --}}
                {{--                            <label for="inputdatef">La date de Fin</label> --}}
                {{--                            <input type="date" class="form-control" id="datef" name="datef"> --}}
                {{--                        </div> --}}
                {{--                    </div> --}}
                {{--                </div> --}}
                <div class="col-12 d-flex justify-content-end">
                    <input type="submit" value="Enregistrer" class="btn btn-primary  rounded-0 shadow-none mb-4"
                        align="center">
                </div>

            </div>
        </div>
    </form>
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
            $('.multiselect-drug').select2({
                selectionCssClass: 'my__input__class'
            });
        });
    </script>

    <script>
        $(".fai_labels .repeatable").repeatable({
            addTrigger: ".fai_labels .add",
            deleteTrigger: ".fai_labels .delete",
            template: "#fai_labels",
            startWith: 1,
            max: 5,
        });
        $(".test_labels .repeatable").repeatable({
            addTrigger: ".test_labels .add",
            deleteTrigger: ".test_labels .delete",
            template: "#test_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.analyse').select2({
                    selectionCssClass: 'my__input__class'
                });
            }
        });
    </script>

    <script type="text/template" id="fai_labels">
        <div class="field-group row">
            <div class="form-group col-md-12">
                <label>Faire SVP</label>
                <input type="text" name="radio[]" id="fai" class="form-control">
            </div>
            <div class="col-md-9">
                <div class="form-group-custom">
                    <textarea type="text" name="justif[]" class="form-control rounded-0 shadow-none" rows="3" placeholder="Justificatif"></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-3">
                <a type="button" class="btn btn-danger  rounded-0 shadow-none delete text-white btn-sm" align="center">
                    <i class="fa fa-plus"></i> {{ __('sentence.Remove') }}
                </a>
            </div>
            <div class="col-12">
                <hr color="#a1f1d4">
            </div>
        </div>
    </script>

    <script type="text/template" id="drugs_labels">
        <section class="field-group">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-12">
                    <select class="form-control multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                        <option value="">{{ __('sentence.Select Drug') }}...</option>
                        @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}">{{ $drug->trade_name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <br>

            <div class="row">
                <div class="col-md-9">
                    <div class="form-group-custom">
                        <input type="text" id="drug_advice" name="drug_advice[]" class="form-control rounded-0 shadow-none" placeholder="Remarque">
                    </div>
                </div>
                <div class="col-md-3">
                    <a type="button" class="btn btn-danger  rounded-0 shadow-none btn-sm text-white span-2 delete"><i class="fa fa-trash  font-size-12"></i> {{ __('sentence.Remove') }}</a>
                </div>
                <div class="col-12">
                    <hr color="#a1f1d4">
                </div>
            </div>
        </section>


    </script>
    <script type="text/template" id="test_labels">
        <div class="field-group row">
            <div class="form-group col-md-12" style="display: none;">
                <label for="test_id">Group d'analyse:</label>
                <select name="test_name[]" class="form-control test-select">
                    <option value="">Select Group d'analyse</option>
                    @foreach ($tests as $test)
                        <option value="14">{{ $test->test_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="analyse_id">Analyse:</label>
                <select name="analyse_id[]"  class="form-control analyse-select">
                    <option value="">Select Analyse</option>
                    @foreach($analyses as $analyse)
                        <option value="{{$analyse->id}}">{{$analyse->analyse_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-9">
                <div class="form-group-custom">
                    <input type="text" id="strength" name="description[]"  class="form-control" placeholder="Remarque">
                </div>
            </div>
            <div class="col-md-3">
                <a type="button" class="btn btn-danger  rounded-0 shadow-none delete text-white btn-sm" align="center"><i class='fa fa-trash  font-size-12'></i> {{ __('sentence.Remove') }}</a>

            </div>
            <div class="col-12">
                <hr color="#a1f1d4">
            </div>
        </div>
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
        $(document).on('change', '.test-select', function() {
            var testId = $(this).val();
            var currentAnalyseSelect = $(this).closest('.field-group').find('.analyse-select');
            if (testId) {
                $.ajax({
                    url: '/getAnalyses/' + testId,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        analyse_id: currentAnalyseSelect.val() // Pass the selected value(s) directly
                    },
                    success: function(data) {
                        currentAnalyseSelect.prop('disabled', false).html('');
                        $.each(data, function(key, value) {
                            currentAnalyseSelect.append('<option value="' + value.id + '">' +
                                value.analyse_name + '</option>');
                        });
                    }
                });
            } else {
                currentAnalyseSelect.prop('disabled', true).html('<option value="">Select Analyse</option>');
            }
        });
    </script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection