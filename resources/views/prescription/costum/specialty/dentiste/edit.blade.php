
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
                <div class="card shadow mb-4" style="position: fixed;">
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
                        <div class="form-group">
                            <div class="card-body text-center" style="padding: 0px;">
                                <img src="{{ asset('img/dent.png') }}" id="map-image" style="min-width: 350px; max-width: 350px; height: auto;" alt="" usemap="#map" />
                                <map name="map">
                                    <area shape="poly" coords="266, 272, 280, 276, 282, 295, 279, 302, 255, 305, 248, 295, 247, 282" onclick="('38')" title="38"/>
                                    <area shape="poly" coords="264, 306, 277, 308, 281, 324, 274, 340, 240, 336, 239, 315, 250, 306" onclick="('37')" title="37"/>
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
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Motif de consultation</h6>
                            </div>
                            <div class="col-2">
                                <button type="submit"
                                        class="btn rounded-0  btn-primary btn-sm float-right">Sauvegarde
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="motife">Motif de consultation</label>
                                <textarea class="form-control rounded-0 shadow-none " id="motife" name="motife" placeholder=""
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
                        <fieldset class="rapport_labels_template repeatable">
                            <div class="repeatable">
                            </div>
                            @foreach($prescription_rapport as $rapport)
                            <div class="form-row">
                                <div class="col-md-9">
                                    <br>
                                    <input type="text" name="value[]" class="form-control" value="{{$rapport->value}}" readonly>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <a href="{{ route('remove-rapport', ['id' => $rapport->id]) }}" class="btn rounded-0  btn-danger btn-sm text-white span-2"><i
                                            class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                                </div>
                                <label for="rapport">Rapport d'examen</label>
                                <textarea class="form-control rounded-0 shadow-none analyse" name="rapport[]" placeholder="">{{$rapport->rapport}}</textarea>
                                <input type="hidden" name="prescription_rapport_id[]" value="{{$rapport->id}}" >
                            </div>
                            @endforeach
                            <br>
                            <div class="add">
                                <a type="button" class="btn rounded-0 btn-sm btn-primary" align="center"><i
                                        class='fa fa-plus'></i> Ajouter rapport</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier actes</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" id="dent" name="dent" >
                                        <option value="">Sélectionnez Dent...</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                        <option value="46">46</option>
                                        <option value="47">47</option>
                                        <option value="48">48</option>
                                        <option value="49">49</option>
                                        <option value="50">50</option>
                                        <option value="51">51</option>
                                        <option value="52">52</option>
                                        <option value="53">53</option>
                                        <option value="54">54</option>
                                        <option value="55">55</option>
                                        <option value="56">56</option>
                                        <option value="57">57</option>
                                        <option value="58">58</option>
                                        <option value="59">59</option>
                                        <option value="60">60</option>
                                        <option value="61">61</option>
                                        <option value="62">62</option>
                                        <option value="63">63</option>
                                        <option value="64">64</option>
                                        <option value="65">65</option>
                                        <option value="66">66</option>
                                        <option value="67">67</option>
                                        <option value="68">68</option>
                                        <option value="69">69</option>
                                        <option value="70">70</option>
                                        <option value="71">71</option>
                                        <option value="72">72</option>
                                        <option value="73">73</option>
                                        <option value="74">74</option>
                                        <option value="75">75</option>
                                        <option value="76">76</option>
                                        <option value="77">77</option>
                                        <option value="78">78</option>
                                        <option value="79">79</option>
                                        <option value="80">80</option>
                                        <option value="81">81</option>
                                        <option value="82">82</option>
                                        <option value="83">83</option>
                                        <option value="84">84</option>
                                        <option value="85">85</option>
                                    </select>
                                </div>
                                <br>
                                <br>
                                <br>
                            <div class="col-md-10">
                                <select class="form-control" id="acte" name="acte">
                                    <option value="">Sélectionnez...</option>
                                    @foreach($actes as $act)
                                        <option value="{{ $act->id }}" data-acte-ref="{{$act->ref}}" data-acte-cout="{{$act->cout}}">{{ $act->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a type="button" id="addActe" class="btn btn-primary">
                                    Ajouter <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <br>
                            <table  id="acteTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Réf</th>
                                    <th class="text-center">Libellé</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Dent</th>
                                    <th class="text-center">Prix</th>
{{--                                    <th class="text-center">Num Séance</th>--}}
{{--                                    <th class="text-center">Remarque</th>--}}
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($consultationact as $acte)
                                    <tr>
                                        <td>{{ $acte->ref }}</td>
                                        <td>{{ $acte->name }}</td>
                                        <td><select name='status[]' class='form-control'>
                                                <option value="{{$acte->status}}">{{$acte->status}}</option>
                                                <option value='En cours'>En cours</option>
                                                <option value='Terminé'>Terminé</option>
                                            </select>
                                        </td>
                                        <td>{{ $acte->dent }}</td>
                                        <td><input type="number" name="prix[]" class="form-control" value="{{ $acte->prix }}"></td>
{{--                                        <td>{{ $acte->numseances }}</td>--}}
{{--                                        <td class="text-center">--}}
{{--                                            <a class="addObservationDB" data-toggle="modal" data-target="#observationModal"><i class="fas fa-book"></i></a>--}}
                                        </td><td><a href="{{ route('remove-acte', ['id' => $acte->id]) }}" class="btn"><i class='fas fa-trash'></i></a></td>
                                        <input type="hidden" name="prescription_consultation_id[]" id="prescription_id" value="{{$acte->prescription_id}}">
                                        <input type="hidden" name="act_id[]" id="act_id" value="{{$acte->id}}">
                                        <input type="hidden" name="consultation_act_id[]" id="consultation_act_id" value="{{$acte->id}}">
                                        <input type="hidden" name="observation[]" id="observation" value="{{$acte->observation}}">
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                <!-- Modal for displaying observation -->
                <div class="modal fade" id="observationModal" tabindex="-1" role="dialog" aria-labelledby="observationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="observationModalLabel">Observation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea id="observationText" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveObservation">Save</button>
                            </div>
                        </div>
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
                                                <select
                                                    class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-drug"
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
                                                        class="form-control rounded-0 shadow-none "
                                                        placeholder="{{ __('sentence.Advice_Comment') }}"
                                                        value="{{ $prescription_drug->drug_advice }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a type="button"
                                                    class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i
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
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
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
                                                class="form-control rounded-0 shoadow-none shadow-none rounded-0 test-select">
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
                                                class="form-control rounded-0 shoadow-none shadow-none rounded-0 analyse-select">
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
                                                    class="form-control rounded-0 shadow-none "
                                                    placeholder="{{ __('sentence.Description') }}"
                                                    value="{{ $prescription_test->description }}">
                                                <input type="hidden" name="prescription_test_id[]"
                                                    value="{{ $prescription_test->id }}">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm"
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
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Test') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
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
                                                class="form-control rounded-0 shoadow-none shadow-none rounded-0 radio-select">
                                                <option value="{{ $prescription_radio->radio_id }}">
                                                    {{ $prescription_radio->radio_name }} </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-9">
                                            <div class="form-group-custom">
                                                <input type="text" id="justif" name="justif[]"
                                                    class="form-control rounded-0 shadow-none "
                                                    placeholder="{{ __('sentence.Description') }}"
                                                    value="{{ $prescription_radio->justif }}">
                                                <input type="hidden" name="prescription_radio_id[]"
                                                    value="{{ $prescription_radio->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm"
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
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
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
                            <input type="number" class="form-control rounded-0 shadow-none " id="inputCertificat"
                                name="certificat" value="{{ $prescription->certificat }}"
                                placeholder="Les jours du repos" oninput="calculateDates()">
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
                            <textarea class="form-control rounded-0 shadow-none " id="bilan" name="bilan" placeholder=""
                                value="{{ $prescription->bilan }}">{{ $prescription->bilan }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">

                    <input type="submit" value="Sauvegarde" class="btn rounded-0  btn-primary mr-3 mb-4"
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
                <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-radio" name="radio_id[]" id="fai" tabindex="-1" aria-hidden="true" required>
                @foreach ($radios as $radio)
                <option value="{{ $radio->id }}">
                    {{ $radio->radio_name }}
                </option>
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

            </div>
            <br>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group-custom">
                        <input type="text" id="drug_advice" name="drug_advice[]" class="form-control rounded-0 shadow-none " placeholder="Remarque">
                    </div>
                </div>
                <div class="col-md-3">
                    <a type="button" class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i class="fa fa-trash  font-size-12"></i> {{ __('sentence.Remove') }}</a>
                </div>
                <div class="col-12">
                    <hr color="#a1f1d4">
                </div>
            </div>
        </section>
    </script>
    <script type="text/template" id="rapport_labels_template">
        <div class="form-row repeatable-item">
            <div class="col-md-9">
                <br>
                <input type="text" name="value[]" class="form-control" readonly>
            </div>
            <div class="col-md-3">
                <br>
                <a type="button" class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i
                        class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
            </div>
            <label for="rapport">Rapport d'examen</label>
            <textarea class="form-control rounded-0 shadow-none analyse" name="rapport[]" placeholder=""></textarea>
        </div>
    </script>
    <script type="text/template" id="test_labels">
        <div class="field-group row">
            <div class="form-group col-md-12" style="display: none;">
                <label for="test_id">Group d'analyse:</label>
                <select name="test_name[]" class="form-control rounded-0 shoadow-none shadow-none rounded-0 test-select">
                    <option value="">Select Group d'analyse</option>
                    @foreach ($tests as $test)
                        <option value="14">{{ $test->test_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="analyse_id">Analyse:</label>
                <select name="analyse_id[]"  class="form-control rounded-0 shoadow-none shadow-none rounded-0 analyse-select">
                    <option value="">Select Analyse</option>
                    @foreach($analyses as $analyse)
                        <option value="{{$analyse->id}}">{{$analyse->analyse_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-9">
                <div class="form-group-custom">
                    <input type="text" id="strength" name="description[]"  class="form-control rounded-0 shadow-none " placeholder="Remarque">
                </div>
            </div>
            <div class="col-md-3">
                <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm" align="center"><i class='fa fa-trash  font-size-12'></i> {{ __('sentence.Remove') }}</a>

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
    <script>
        $("#addActe").click(function () {
            var selectedActe = $("#acte option:selected");
            var selectedDent = $("#dent option:selected");
            if (selectedActe.val() !== "") {
                var ref = selectedActe.data("acte-ref");
                var libelle = selectedActe.text();
                var prix = selectedActe.data("acte-cout");
                var id = selectedActe.val();
                var dent = selectedDent.val();
                var numseances = '1';

                var newRow = "<tr><td>" + ref + "</td><td>" + libelle + "</td><td> <select name='status[]' class='form-control'><option value='En cours'>En cours</option><option value='Terminé'>Terminé</option></select> </td><td>" + dent + "</td><td><input type='text' class='form-control' name='prix[]' value='" + prix + "'></td><td><a class='addObservation'><i class='fas fa-book'></i></a> <button class='deleteActe'><i class='fas fa-trash'></i></button></td><input type='hidden' name='new_act_id[]' value='" + id + "'><input type='hidden' name='new_dent[]' value='" + dent + "'><input type='text' name='prix[]' value='" + prix + "'><input type='hidden' name='numseances' value='" + numseances + "'><input type='hidden' name='observations[]' value=''></tr>";
                $("#acteTable tbody").append(newRow);
            }
        });

        $(document).on("click", ".deleteActe", function () {
            var row = $(this).closest("tr");
            var ref = row.find("td:first").text();
            var libelle = row.find("td:nth-child(2)").text();
            row.remove();
            $("#acte").append('<option value="' + ref + '">' + libelle + '</option>');
        });

        // Add an observation pop-up when clicking the observation button
        $(document).on("click", ".addObservation", function (e) {
            e.preventDefault();
            var row = $(this).closest("tr");
            var observationInput = row.find("input[name='observations[]']");
            var modal = $('<div class="modal" tabindex="-1" role="dialog">');
            modal.html('<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Observation</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><input type="text" id="observationInput" class="form-control" placeholder="Observation"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button><button type="button" class="btn btn-primary" id="saveObservation">Save Observation</button></div></div></div></div>');

            var modalInput = modal.find('#observationInput');
            var saveButton = modal.find('#saveObservation');

            // Load the previously entered observations, if available
            var savedObservations = observationInput.val();
            modalInput.val(savedObservations);

            modal.modal('show');

            saveButton.click(function () {
                var enteredObservation = modalInput.val();
                observationInput.val(enteredObservation);
                modal.modal('hide');
            });
        });

        $("#acteTable").on("dblclick", "td.editable", function () {
            var cell = $(this);
            var oldValue = cell.text();
            var inputField = $("<input type='number' step='0.01' class='form-control' value='" + oldValue + "'>");
            cell.html(inputField);
            inputField.focus();
            inputField.blur(function () {
                var newValue = inputField.val();
                cell.html(newValue);
                var hiddenInput = cell.closest("tr").find("input[name='prix[]']");
                hiddenInput.val(newValue);
            });
        });
        $(document).on("click", ".addObservationDB", function (e) {
            e.preventDefault();
            var row = $(this).closest("tr");
            var observationInput = row.find("input[name='observation[]']");
            var savedObservations = observationInput.val();

            var modal = $('<div class="modal" tabindex="-1" role="dialog">');
            // ... rest of your code ...

            // Get the observation value from the current row
            var observationValue = observationInput.val();
            console.log(observationValue);
            if (observationValue !== undefined) {
                modalInput.val(observationValue);
            }

            modal.modal('show');

            var saveButton = modal.find('#saveObservationDB');

            saveButton.click(function () {
                var enteredObservation = modalInput.val();
                observationInput.val(enteredObservation);
                modal.modal('hide');
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            var currentObservationInput;

            $('.addObservationDB').click(function() {
                currentObservationInput = $(this).closest('tr').find('input#observation');
                var observationText = currentObservationInput.val();
                $('#observationText').val(observationText);
            });

            $('#saveObservation').click(function() {
                var updatedObservationText = $('#observationText').val();
                currentObservationInput.val(updatedObservationText);

                // Close the modal
                $('#observationModal').modal('hide');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Attach click event handler to all area elements
            $('map area').on('click', function () {
                // Get the coordinates of the clicked area
                var coords = $(this).attr('coords').split(',');

                // Create a div for the colored tooth
                var coloredTooth = $('<div class="colored-tooth"></div>');

                // Set the position and size of the colored tooth based on the clicked area
                coloredTooth.css({
                    left: coords[0] + 'px',
                    top: coords[1] + 'px',
                    width: (coords[2] - coords[0]) + 'px',
                    height: (coords[5] - coords[1]) + 'px'
                });

                // Append the colored tooth to the image container
                $('#map-image').append(coloredTooth);

                // Get the value from the 'onclick' attribute of the clicked area
                var areaValue = $(this).attr('onclick');
                // Extract the numeric value from the 'onclick' attribute (assuming it's a number)
                var numericValue = areaValue.match(/\d+/);


                // Update the input field with the numeric value
                $('#valuemap').val(numericValue);
            });
        });
    </script>
    <script>
        $(".rapport_labels_template .repeatable").repeatable({
            addTrigger: ".rapport_labels_template .add",
            deleteTrigger: ".rapport_labels_template #delete",
            template: "#rapport_labels_template",
            startWith: 1,
            max: 5,
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Counter for tracking the number of added tests
            var testCounter = 0;

            // Function to handle the area click event
            function handleAreaClick(event) {
                // Extract the value from the clicked area
                var areaValue = event.target.getAttribute('title');

                // Update the corresponding input field
                var inputField = document.querySelectorAll('input[name="value[]"]')[testCounter];
                if (inputField) {
                    inputField.value = areaValue;

                    // If there are more tests, increment the counter
                    if (testCounter < 4) {
                        testCounter++;

                        // Clone and append the template for a new test
                        var template = document.getElementById('rapport_labels_template').content.cloneNode(true);
                        document.getElementById('formContainer').appendChild(template);
                    }
                }
            }

            // Attach the click event to each area
            var areas = document.querySelectorAll('map area');
            areas.forEach(function (area) {
                area.addEventListener('click', handleAreaClick);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete', function () {
                // Find the parent .repeatable-item and remove it
                $(this).closest('.repeatable-item').remove();
            });
        });
    </script>

@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
