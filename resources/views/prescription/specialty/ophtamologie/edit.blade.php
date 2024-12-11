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
                <div class="">

                </div>
                <div class="card shadow mb-4 ">

                    <div class="card-header py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Motif de consultation</h6>

                            <div>
                                <input type="submit" value="Sauvegarde" class="btn btn-primary rounded-0 rounded-0"
                                    align="center">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            {{--                            <div class="form-group col-md-3"> --}}
                            {{--                                <label for="age">Age</label> --}}
                            {{--                                <input type="text" class="form-control rounded-0 shadow-none" id="age" name="age" placeholder="" value="{{$prescription->age}}"> --}}
                            {{--                            </div> --}}
                            <div class="form-group col-md-12">
                                <label for="motife">Motif de consultation</label>
                                <textarea class="form-control rounded-0 shadow-none" id="motife" name="motife" placeholder=""
                                    value="{{ $prescription->motife }}">{{ $prescription->motife }}</textarea>
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
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>AV(vision de loin)</strong>
                                                <td>
                                                    <label for="table1_input1">Sans correction</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_od_s" name="av_vl_od_s" placeholder="OD"
                                                            {{ $prescription->av_vl_od_s }}
                                                            value="{{ $prescription->av_vl_od_s }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_og_s" name="av_vl_og_s" placeholder="OG"
                                                            value="{{ $prescription->av_vl_og_s }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table1_input2">Avec correction</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_od_a" name="av_vl_od_a" placeholder="OD"
                                                            value="{{ $prescription->av_vl_od_a }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_og_a" name="av_vl_og_a" placeholder="OG"
                                                            value="{{ $prescription->av_vl_og_a }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>AV(vision de près)</strong>
                                                <td>
                                                    <label for="table2_select1">OD</label>
                                                    <select class="form-control rounded-0 shadow-none" id="av_vp_od"
                                                        name="av_vp_od">
                                                        <option value="{{ $prescription->av_vp_od }}">
                                                            {{ $prescription->av_vp_od }}</option>
                                                        <option value="P1">P1</option>
                                                        <option value="P2">P2</option>
                                                        <option value="P3">P3</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_select2">OG</label>
                                                    <select class="form-control rounded-0 shadow-none" id="av_vp_og"
                                                        name="av_vp_og">
                                                        <option value="{{ $prescription->av_vp_og }}">
                                                            {{ $prescription->av_vp_og }}</option>
                                                        <option value="P1">P1</option>
                                                        <option value="P2">P2</option>
                                                        <option value="P3">P3</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Annexes</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="annex_od" name="annex_od" placeholder="OD"
                                                            value="{{ $prescription->annex_od }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="annex_og" name="annex_og" placeholder="OG"
                                                            value="{{ $prescription->annex_og }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>SA(segment antérieur)</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="sa_od" name="sa_od" placeholder="OD"
                                                            value="{{ $prescription->sa_od }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="sa_og" name="sa_og" placeholder="OG"
                                                            value="{{ $prescription->sa_og }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>FO(fond d'oeil)</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="fo_od" name="fo_od" placeholder="OD"
                                                            value="{{ $prescription->fo_od }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="fo_og" name="fo_og" placeholder="OG"
                                                            value="{{ $prescription->fo_og }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>TO(tonus oculaire)</strong>
                                                <td>
                                                    <label for="table1_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="to_od" name="to_od" placeholder="OD"
                                                            value="{{ $prescription->to_od }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table1_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="to_og" name="to_og" placeholder="OG"
                                                            value="{{ $prescription->to_og }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Réfraction</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="ref_od" name="ref_od" placeholder="OD"
                                                            value="{{ $prescription->ref_od }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="ref_og" name="ref_og" placeholder="OG"
                                                            value="{{ $prescription->ref_og }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Addition</strong>
                                                <td>
                                                    <div class="input-group">
                                                        <textarea name="addition" class="form-control rounded-0 shadow-none" id="" cols="60" rows="6"
                                                            value="{{ $prescription->addition }}">{{ $prescription->addition }}</textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="patient_title">Patient </label>
                                        <select class="form-control rounded-0 shadow-none" id="patient_title"
                                            name="patient_title">
                                            <option value="{{ $prescription->patient_title }}">
                                                {{ $prescription->patient_title }}</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mme">Mme</option>
                                            <option value="Mlle">Mlle</option>
                                            <option value="L'enfant">L'enfant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Verres</strong>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_ar"
                                                            id="verreAR" value="AR"
                                                            {{ $prescription->verre_ar == 'AR' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="verreAR">AR</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_lb"
                                                            id="verreLB" value="LB"
                                                            {{ $prescription->verre_lb == 'LB' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="verreLB">LB</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_uv"
                                                            id="verreUV" value="UV"
                                                            {{ $prescription->verre_uv == 'UV' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="verreUV">UV</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_pro"
                                                            id="verrePRO" value="PRO"
                                                            {{ $prescription->verre_pro == 'PRO' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="verrePRO">PRO</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_phog"
                                                            id="phoPRO" value="PhoG"
                                                            {{ $prescription->verre_phog == 'PhoG' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="phoPRO">PhoG</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                                <!-- <div class="form-group col-md-3">
                                                                                                                                                            <label for="inputPoid">Poid</label>
                                                                                                                                                            <input type="hidden" name="user_id" value="">
                                                                                                                                                            <input type="hidden" name="reference" value="">
                                                                                                                                                            <input type="text" class="form-control rounded-0 shadow-none" id="inputPoid" name="poid" placeholder="" style="width: 11rem;" value="">
                                                                                                                                                            <small id="poidHelp" class="form-text text-muted">Weight in kilograms</small>

                                                                                                                                                        </div>
                                                                                                                                                        <div class="form-group col-md-3">
                                                                                                                                                            <label for="inputTaille">Taille</label>
                                                                                                                                                            <input type="text" class="form-control rounded-0 shadow-none" id="inputTaille" name="taille" placeholder="" style="width: 11rem;" value="" >
                                                                                                                                                            <small id="tailleHelp" class="form-text text-muted">Height in centimeters</small>

                                                                                                                                                        </div>

                                                                                                                    {{--                                    <div class="form-group col-md-3"> --}}
                                                                                                                                                    {{--                                        <label for="inputPC">Périmètre crânien</label> --}}
                                                                                                                                                    {{--                                        <input type="text" class="form-control rounded-0 shadow-none" id="inputPC" name="pc" placeholder="" style="width: 11rem;" value=""> --}}
                                                                                                                                                    {{--                                        <small id="padHelp" class="form-text text-muted">Périmètre crânien en cm </small> --}}
                                                                                                                                                    {{--                                    </div> --}}
                                                                                                                                                    <div class="form-group col-md-3">
                                                                                                                                                        <label for="inputsa">Saturation en oxygène</label>
                                                                                                                                                        <input type="text" class="form-control rounded-0 shadow-none" id="inputsa" name="sa" placeholder="" style="width: 11rem;" value="">
                                                                                                                                                        <small id="tempHelp" class="form-text text-muted">Saturation en oxygène</small>
                                                                                                                                                    </div>
                                                                                                                                                    <div class="form-group col-md-3">
                                                                                                                                                        <label for="inputPAS">PAS</label>
                                                                                                                                                        <input type="number" class="form-control rounded-0 shadow-none" id="inputPAS" name="pas" placeholder="" style="width: 11rem;" value="">
                                                                                                                                                        <small id="pasHelp" class="form-text text-muted">Systolic blood pressure in mmHg</small>

                                                                                                                                                    </div>
                                                                                                                                                    <div class="form-group col-md-3">
                                                                                                                                                        <label for="inputPAD">TA</label>
                                                                                                                                                        <input type="text" class="form-control rounded-0 shadow-none" id="inputPAD" name="pad" placeholder="" style="width: 11rem;" value="">
                                                                                                                                                        <small id="padHelp" class="form-text text-muted">Diastolic blood pressure in mmHg</small>

                                                                                                                                                    </div>
                                                                                                                                                    <div class="form-group col-md-3">
                                                                                                                                                        <label for="inputPouls">Fréquence cardiaque</label>
                                                                                                                                                        <input type="text" class="form-control rounded-0 shadow-none" id="inputPouls" name="pouls" placeholder="" style="width: 11rem;" value="">
                                                                                                                                                        <small id="poulsHelp" class="form-text text-muted">Fréquence cardiaque en battements par minute</small>
                                                                                                                                                    </div>

                                                                                                                                                    <div class="form-group col-md-3">
                                                                                                                                                        <label for="inputfr">Fréquence respiratoire</label>
                                                                                                                                                        <input type="text" class="form-control rounded-0 shadow-none" id="inputfr" name="fr" placeholder="" style="width: 11rem;" value="">
                                                                                                                                                        <small id="poulsHelp" class="form-text text-muted">Fréquence respiratoire</small>
                                                                                                                                                    </div>
                                                                                                                                                    <div class="form-group col-md-3">
                                                                                                                                                        <label for="inputTemp">température</label>
                                                                                                                                                        <input type="text" class="form-control rounded-0 shadow-none" id="inputTemp" name="temp" placeholder="" style="width: 11rem;" value="">
                                                                                                                                                        <small id="tempHelp" class="form-text text-muted">Température en °C</small>
                                                                                                                                                    </div>

                                                                                                                                                </div> -->
                                <label for="motife">Commentaire</label>
                                <textarea class="form-control rounded-0 shadow-none" id="rapport" name="rapport" rows="3" placeholder=""
                                    value="{{ $prescription->rapport }}">{{ $prescription->rapport }}</textarea>
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
                                            <div class="form-group col-md-12">
                                                <select class="form-control rounded-0 shadow-none multiselect-drug"
                                                    name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true"
                                                    required>
                                                    <option value="{{ $prescription_drug->drug_id }}">
                                                        {{ $prescription_drug->Drug->trade_name }}</option>
                                                    @foreach ($drugs as $drug)
                                                        <option value="{{ $drug->id }}">{{ $drug->trade_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group-custom">
                                                    <input type="text" id="drug_advice" name="drug_advice[]"
                                                        class="form-control rounded-0 shadow-none"
                                                        placeholder="{{ __('sentence.Advice_Comment') }}"
                                                        value="{{ $prescription_drug->drug_advice }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a type="button"
                                                    class="btn btn-danger btn-sm rounded-0 text-white span-2 delete"><i
                                                        class="fa fa-trash font-size-12"></i>
                                                    {{ __('sentence.Remove') }}</a>
                                            </div>
                                            <div class="col-12">
                                                <hr color="red">
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary rounded-0 rounded-0 add text-white"
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
                                            <select name="test_name[]"
                                                class="form-control rounded-0 shadow-none test-select">
                                                <option value="{{ $prescription_test->test_id }}">
                                                    {{ $prescription_test->Test->test_name }} </option>
                                                @foreach ($tests as $test)
                                                    <option value="{{ $test->id }}">{{ $test->test_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="analyse_id">Analyse:</label>
                                            <select name="analyse_id[]"
                                                class="form-control rounded-0 shadow-none analyse-select">
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
                                                    class="form-control rounded-0 shadow-none"
                                                    placeholder="{{ __('sentence.Description') }}"
                                                    value="{{ $prescription_test->description }}">
                                                <input type="hidden" name="prescription_test_id[]"
                                                    value="{{ $prescription_test->id }}">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn btn-danger rounded-0 delete text-white btn-sm"
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
                                <a type="button" class="btn btn-sm btn-primary rounded-0 rounded-0 add text-white"
                                    align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Test') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>


                {{--                <div class="card shadow mb-4"> --}}
                {{--                    <div class="card-header py-3"> --}}
                {{--                        <h6 class="m-0 font-weight-bold text-primary">Radios </h6> --}}
                {{--                    </div> --}}
                {{--                    <div class="card-body"> --}}
                {{--                        <fieldset class="fai_labels"> --}}
                {{--                            <div class="repeatable"> --}}
                {{--                            <div class="field-group row"> --}}
                {{--                                @foreach ($prescription_radios as $prescription_radio) --}}
                {{--                                <div class="form-group col-md-12"> --}}
                {{--                                    <label>Radios </label> --}}
                {{--                                    <select class="form-control rounded-0 shadow-none multiselect-radio" name="radio[]" id="fai" tabindex="-1" aria-hidden="true" required> --}}
                {{--                                            <option value="{{$prescription_radio->id}}">{{$prescription_radio->radio}}</option> --}}
                {{--                                    @endforeach --}}
                {{--                                            @foreach ($listradio as $list) --}}
                {{--                                                <option value="{{ $list->id }}">{{ $list->radio_name }}</option> --}}
                {{--                                            @endforeach --}}
                {{--                                    </select> --}}
                {{--                                </div> --}}
                {{--                                <div class="col-md-9"> --}}
                {{--                                    <div class="form-group-custom"> --}}
                {{--                                        @foreach ($selectradios as $select) --}}
                {{--                                        <input type="hidden" name="prescription_radio_id[]" value="{{ $select->id }}"> --}}
                {{--                                        <textarea type="text" name="justif[]" class="form-control rounded-0 shadow-none" rows="2" placeholder="" value="{{$select->justif}}">{{$select->justif}}</textarea> --}}
                {{--                                        @endforeach --}}
                {{--                                    </div> --}}
                {{--                                </div> --}}
                {{--                                </div> --}}
                {{--                                <br> --}}
                {{--                                <div class="col-md-3"> --}}
                {{--                                    <a type="button" class="btn btn-danger delete text-white btn-sm" align="center"> --}}
                {{--                                        <i class="fa fa-plus"></i> {{ __('sentence.Remove') }} --}}
                {{--                                    </a> --}}
                {{--                                </div> --}}
                {{--                                <div class="col-12"> --}}
                {{--                                    <hr color="#a1f1d4"> --}}
                {{--                                </div> --}}

                {{--                            </div> --}}
                {{--                            <div class="form-group"> --}}
                {{--                                <a type="button" class="btn btn-sm btn-primary rounded-0 add text-white" align="center"><i class='fa fa-plus'></i>Ajouter</a> --}}
                {{--                            </div> --}}
                {{--                        </fieldset> --}}
                {{--                    </div> --}}
                {{--                </div> --}}

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Radio</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="fai_labels">
                            <div class="repeatable">
                                @foreach ($prescription_radios as $prescription_radio)
                                    <div class="field-group row">
                                        <div class="form-group col-md-12">
                                            <label for="radio">radio</label>
                                            <select name="radio_id[]"
                                                class="form-control rounded-0 shadow-none radio-select">
                                                <option value="{{ $prescription_radio->radio_id }}">
                                                    {{ $prescription_radio->radio_name }} </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-9">
                                            <div class="form-group-custom">
                                                <input type="text" id="justif" name="justif[]"
                                                    class="form-control rounded-0 shadow-none"
                                                    placeholder="{{ __('sentence.Description') }}"
                                                    value="{{ $prescription_radio->justif }}">
                                                <input type="hidden" name="prescription_radio_id[]"
                                                    value="{{ $prescription_radio->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn btn-danger rounded-0 delete text-white btn-sm"
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
                                <a type="button" class="btn btn-sm btn-primary rounded-0 rounded-0 add text-white"
                                    align="center"><i class='fa fa-plus'></i> Ajoute Radio</a>
                            </div>
                        </fieldset>
                    </div>
                </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Certification</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputCertificat">Les jours</label>
                            <input type="number" class="form-control rounded-0 shadow-none" id="inputCertificat"
                                name="certificat" value="{{ $prescription->certificat }}"
                                placeholder="Les jours du repos" oninput="calculateDates()">
                            <small id="certificatHelp" class="form-text text-muted">Entre les jours du repos.</small>
                            <label for="inputdated">La date de début</label>
                            <input type="date" class="form-control rounded-0 shadow-none" id="dated"
                                name="dated" value="{{ date('Y-m-d') }}" oninput="calculateDates()">
                            <label for="inputdatef">La date de Fin</label>
                            <input type="date" class="form-control rounded-0 shadow-none" id="datef"
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
                            <textarea class="form-control rounded-0 shadow-none" id="bilan" name="bilan" placeholder=""
                                value="{{ $prescription->bilan }}">{{ $prescription->bilan }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end mb-4">

                    <input type="submit" value="Sauvegarde" class="btn btn-primary rounded-0 rounded-0" align="center">
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
            $('.multiselect-doctorino').select2();
        });

        $(document).ready(function() {
            $('.multiselect-drug').select2();
        });

        $(document).ready(function() {
            $('.analyse-select').select2();
        });

        $(document).ready(function() {
            $('.radio-select').select2();
        });
    </script>

    <script>
        $(".fai_labels .repeatable").repeatable({
            addTrigger: ".fai_labels .add",
            deleteTrigger: ".fai_labels .delete",
            template: "#fai_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.multiselect-radio').select2();
            }
        });
        $(".test_labels .repeatable").repeatable({
            addTrigger: ".test_labels .add",
            deleteTrigger: ".test_labels .delete",
            template: "#test_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.analyse-select').select2();
            }
        });
    </script>

    <script type="text/template" id="fai_labels">
        <div class="field-group row">
            <div class="form-group col-md-12">
                <label>Radios </label>
                <select class="form-control rounded-0 shadow-none multiselect-radio" name="radio_id[]" id="fai" tabindex="-1" aria-hidden="true" required>
                @foreach ($radios as $radio)
                <option value="{{ $radio->id }}">
                    {{ $radio->radio_name }}
                </option>
                @endforeach
                </select>
            </div>
            <div class="col-md-9">
                <div class="form-group-custom">
                    <textarea type="text" name="justif[]" class="form-control rounded-0 shadow-none" rows="3" placeholder="Justificatif"></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-3">
                <a type="button" class="btn btn-danger delete text-white rounded-0 btn-sm" align="center">
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
                    {{--                    <div class="form-group-custom">--}}
                    {{--                        <input type="text" class="form-control rounded-0 shadow-none" name="type[]" id="task_{?}" placeholder="{{ __('sentence.Type') }}" class="ui-autocomplete-input" autocomplete="off">--}}
                    {{--                        <label class="control-label"></label><i class="bar"></i>--}}
                    {{--                    </div>--}}
                </div>
                <div class="col-md-12">
                    <select class="form-control rounded-0 shadow-none multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                        <option value="">{{ __('sentence.Select Drug') }}...</option>
                        @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}">{{ $drug->trade_name }}</option>
                        @endforeach
                    </select>
                </div>
                {{--                <div class="col-md-4">--}}
                {{--                    <div class="form-group-custom">--}}
                {{--                        <input type="text" id="strength" name="strength[]"  class="form-control rounded-0 shadow-none" placeholder="Mg/Ml">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <br>
{{--            <div class="row">--}}

{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group-custom">--}}
{{--                        <input type="text" id="dose" name="dose[]" class="form-control rounded-0 shadow-none" placeholder="Nombre de fois par jour">--}}
{{--                        <label class="control-label"></label><i class="bar"></i>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group-custom">--}}
{{--                        <input type="text" id="duration" name="duration[]" class="form-control rounded-0 shadow-none" placeholder="Nombre de jour">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group-custom">
                        <input type="text" id="drug_advice" name="drug_advice[]" class="form-control rounded-0 shadow-none" placeholder="Remarque">
                    </div>
                </div>
                <div class="col-md-3">
                    <a type="button" class="btn btn-danger rounded-0 btn-sm text-white span-2 delete"><i class="fa fa-trash  font-size-12"></i> {{ __('sentence.Remove') }}</a>
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
                <select name="test_name[]" class="form-control rounded-0 shadow-none test-select">
                    <option value="">Select Group d'analyse</option>
                    @foreach ($tests as $test)
                        <option value="14">{{ $test->test_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="analyse_id">Analyse:</label>
                <select name="analyse_id[]"  class="form-control rounded-0 shadow-none analyse-select">
                    <option value="">Select Analyse</option>
                    @foreach($analyses as $analyse)
                        <option value="{{$analyse->id}}">{{$analyse->analyse_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-9">
                <div class="form-group-custom">
                    <input type="text" id="strength" name="description[]"  class="form-control rounded-0 shadow-none" placeholder="Remarque">
                </div>
            </div>
            <div class="col-md-3">
                <a type="button" class="btn btn-danger rounded-0 delete text-white btn-sm" align="center"><i class='fa fa-trash  font-size-12'></i> {{ __('sentence.Remove') }}</a>

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
