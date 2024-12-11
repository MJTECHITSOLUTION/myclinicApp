
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
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
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Créer consultation</h6>
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
                                <textarea class="form-control rounded-0 shadow-none " id="motife" name="motife"
                                          placeholder=""></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Examen clinique</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="rapport_labels_template">
                            <div class="repeatable">
                            </div>

                            <div class="form-group">
                                <a type="button" class="btn rounded-0 btn-sm btn-primary add text-white"
                                   align="center"><i class='fa fa-plus'></i> Ajouter rapport</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter acte</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" id="dent" name="dent">
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
                                        <option value="">Sélectionnez Acte...</option>
                                        @foreach($actes as $act)
                                            <option value="{{ $act->id }}" data-acte-ref="{{$act->ref}}"
                                                    data-acte-cout="{{$act->cout}}"
                                                    data-acte-nums="{{$act->nums}}">{{ $act->name }}</option>
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
                            <table id="acteTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Réf</th>
                                    <th class="text-center">Libellé</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Dent</th>
                                    <th class="text-center">Prix</th>
                                    <th class="text-center">Num Séance</th>
                                    <th class="text-center">Remarque</th>
                                    <th class="text-center" style="width: 150px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Actes will be added here -->
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
                <div class="modal fade" id="historyModal" tabindex="-1" role="dialog"
                     aria-labelledby="historyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="historyModalLabel">Informations sur l'historique</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tr>
                                        <th>Réf :</th>
                                        <td><span class="acte-ref"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Libellé :</th>
                                        <td><span class="acte-libelle"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Num Séance :</th>
                                        <td><span class="acte-numseances"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Prix :</th>
                                        <td><span class="acte-prix"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Dent :</th>
                                        <td><span class="acte-dent"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Statut :</th>
                                        <td><span class="acte-statut"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
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
                            <textarea class="form-control rounded-0 shadow-none " id="bilan" name="bilan"
                                      placeholder=""></textarea>
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
        $(document).ready(function () {
            $('.multiselect-doctorino').select2();
        });
    </script>
    <script type="text/template" id="drugs_labels">
        <section class="field-group">
            <div class="field-group row">
                <div class="col-md-2">
                </div>
                <div class="col-md-12">
                    <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-drug"
                            name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                        <option value="">{{ __('sentence.Select Drug') }}...</option>
                        @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}"
                                    data-remarque="{{$drug->note}}">{{ $drug->trade_name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <br>
                <div class="col-md-9">
                    <div class="form-group-custom">
                        <input type="text" id="drug_advice" name="drug_advice[]"
                               class="form-control rounded-0 shadow-none " placeholder="Remarque">
                    </div>
                </div>
                <div class="col-md-3">
                    <a type="button" class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i
                            class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
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
            afterAdd: function () {
                $('.fai').select2();
            }
        });
        $(".test_labels .repeatable").repeatable({
            addTrigger: ".test_labels .add",
            deleteTrigger: ".test_labels .delete",
            template: "#test_labels",
            startWith: 1,
            max: 5,
            afterAdd: function () {
                $('.analyse').select2();
            }
        });
        $(".rapport_labels_template .repeatable").repeatable({
            addTrigger: ".rapport_labels_template .add",
            deleteTrigger: ".rapport_labels_template .delete",
            template: "#rapport_labels_template",
            startWith: 1,
            max: 5,
        });

    </script>
    <script type="text/template" id="test_labels">
        <div class="field-group row">
            <div class="form-group col-md-12">
                <label for="analyse_id">Analyse:</label>
                <select name="analyse_id[]" id="analyse"
                        class="form-control rounded-0 shoadow-none shadow-none rounded-0 analyse">
                    <option value="">Sélectionnez Analyse</option>
                    @foreach($analyses as $analyse)
                        <option value="{{$analyse->id}}">{{$analyse->analyse_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-9">
                <div class="form-group-custom">
                    <input type="text" name="description[]" class="form-control rounded-0 shadow-none "
                           placeholder="{{ __('sentence.Description') }}">
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
    <script type="text/template" id="rapport_labels_template">
        <div class="form-row repeatable-item">
            <div class="col-md-9">
                <br>
                <input type="number" name="value[]" class="form-control" readonly>
            </div>
            <div class="col-md-3">
                <br>
                <a type="button" class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i
                        class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
            </div>

            <label for="rapport">Rapport d'examen</label>
            <textarea class="form-control rounded-0 shadow-none analyse" name="rap[]" placeholder=""></textarea>
        </div>
    </script>

    <script type="text/template" id="fai_labels">
        <div class="field-group row">
            <div class="form-group col-md-12">
                <label>Radios </label>
                <select type="text" name="radio_id[]" id="fai"
                        class="form-control rounded-0 shoadow-none shadow-none rounded-0 fai">
                    <option value="">Sélectionnez un Radio</option>
                    @foreach($radios as $radio)
                        <option value="{{$radio->id}}">{{$radio->radio_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-9">
                <div class="form-group-custom">
                    <textarea type="text" name="justif[]" class="form-control rounded-0 shadow-none " rows="3"
                              placeholder="Justificatif"></textarea>
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
        <!-- Add the Bootstrap modal for the history information -->
    </script>

    <script>
        // Function to refresh the input value
        function refreshInputValue(namePatient) {
            document.getElementById("patientNameInput").value = namePatient;
        }

        $(document).ready(function () {
            $('#PatientID').change(function () {
                var selectedPatientId = $(this).val();

                // Make an AJAX request to update the session variables
                $.ajax({
                    url: '/get-patient-data/' + selectedPatientId,
                    method: 'GET',
                    success: function (data) {
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
                    error: function (error) {
                        console.log(error);
                    }
                })
            });
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
                var nums = selectedActe.data("acte-nums");
                var numseances = '1';

                console.log(nums);
                var newRow = "<tr><td>" + ref + "</td><td>" + libelle + "</td><td> <select name='status[]' class='form-control'><option value='En cours'>En cours</option><option value='Terminé'>Terminé</option></select> </td><td>" + dent + "</td><td class='editable'>" + prix + "</td><td>" + numseances + "/" + nums + "</td><td><a class='addObservation'><i class='fas fa-book'></i></a></td><td><button class='deleteActe'><i class='fas fa-trash'></i></button></td><input type='hidden' name='act_id[]' value='" + id + "'><input type='hidden' name='dent[]' value='" + dent + "'><input type='hidden' name='prix[]' value='" + prix + "'><input type='hidden' name='numseancess[]' value='" + numseances + "'><input type='hidden' name='observationss[]' value=''></tr>";
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
            var observationInput = row.find("input[name='observationss[]']");
            var modal = $('<div class="modal" tabindex="-1" role="dialog">');
            modal.html('<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Observation</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><textarea type="text" id="observationInput" class="form-control" rows="5" placeholder="Observation"></textarea></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button><button type="button" class="btn btn-primary" id="saveObservation">Enregistrer</button></div></div></div></div>');

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
    </script>


    <!-- Include this script in your HTML file -->

    <script>
        $(document).ready(function () {
            var rowObservations = {};

            $.ajax({
                url: '{{ route('prescription.data') }}',
                method: 'GET',
                dataType: 'json',
                success: function (consultation) {
                    console.log(consultation);
                    if (consultation && consultation.length > 0) {
                        var uniqueActs = {};// Keep track of unique acts and their latest seances

                        $.each(consultation, function (index, acte) {
                            var testacte = {};
                            var actId = acte.act_id;
                            testacte = acte.act_id;

                            // Check if this act has not been encountered before or has a higher seances value
                            if (!(actId in uniqueActs) || acte.numseances > uniqueActs[actId].numseances) {
                                uniqueActs[actId] = acte;
                            }
                        });

                        var tbody = $('#acteTable tbody');

                        // Iterate through the unique acts and add them to the table
                        for (var actId in uniqueActs) {
                            var acte = uniqueActs[actId];
                            var row = $('<tr>');
                            row.append($('<td>').text(acte.ref));
                            row.append($('<td>').text(acte.name));

                            // Create a select dropdown for "status"
                            var statusSelect = $('<select name="old_status[]" class="form-control status-select">');
                            statusSelect.append($('<option>').val('En cours').text('En cours'));
                            statusSelect.append($('<option>').val('Terminé').text('Terminé'));
                            statusSelect.val(acte.status); // Set the selected value
                            row.append($('<td>').append(statusSelect));
                            row.append($('<td>').text(acte.dent));

                            // Create a hidden input Consultation_act_id
                            var inputConsultation_act_id = $('<input type="hidden" name="consultation_act_id[]">');
                            inputConsultation_act_id.val(acte.consultation_act_id);
                            row.append(inputConsultation_act_id);

                            // Create an input field for "prix"
                            var prixInput = $('<input type="text" name="" class="form-control prix-input" readonly>');
                            prixInput.val(acte.prix); // Set the initial value
                            row.append($('<td>').append(prixInput));
                            var nums = parseInt(acte.nums);

                            row.append($('<td>').text(parseInt(acte.numseances) + 1 + "/" + nums));

                            var newNumSeances = parseInt(acte.numseances) + 1;
                            var numseancs = $('<input type="hidden" name="numseances[]">');
                            numseancs.val(newNumSeances);
                            row.append(numseancs);

                            var observationInput = $('<input type="hidden" name="observations[]" class="form-control observation-input" value=""/>');
                            row.append(observationInput);

                            // Add the code for observation here
                            var actionobservation = $('<td>');
                            var observation = $('<a class="btn" href="#">').html('<i class="fas fa-book"></i>');

                            // Add a click event to the observation icon
                            observation.click(function (e) {
                                e.preventDefault();

                                // Get the observation input for the current row
                                var observationInput = $(this).closest('tr').find('.observation-input');

                                // Load the previously entered observation for the current row
                                observationInput.val(rowObservations[acte.act_id] || '');

                                // Create a Bootstrap Modal
                                var modal = $('<div class="modal" tabindex="-1" role="dialog">');
                                modal.html('<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Observation</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><textarea type="text" id="observationInput" class="form-control" rows="5" placeholder="Observation"></textarea></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button><button type="button" class="btn btn-primary" id="saveObservation">Enregistrer</button></div></div></div></div>');

                                var modalInput = modal.find('#observationInput');
                                var saveButton = modal.find('#saveObservation');

                                // Show the modal
                                modal.modal('show');

                                saveButton.click(function () {
                                    var enteredObservation = modalInput.val();
                                    observationInput.val(enteredObservation); // Update the observation input
                                    rowObservations[acte.act_id] = enteredObservation; // Store the observation for this row
                                    modal.modal('hide');
                                });
                            });

                            var actionCell = $('<td>');
                            var deleteLink = $('<a class="btn" href="#">').html('<i class="fas fa-trash"></i>');
                            // Add a click event to the deleteLink
                            deleteLink.click(function (e) {
                                e.preventDefault();
                                $(this).closest('tr').remove();
                            });
                            // actionCell.append(deleteLink);

                            // Create a clickable "history" icon element
                            var historyIcon = $('<a class="btn history-icon" href="#" data-act-id="' + acte.act_id + '">').html('<i class="fa fa-eye"></i>');
                            actionCell.append(historyIcon);

                            // Add a click event handler for the history icon
                            historyIcon.click(function (e) {
                                e.preventDefault();

                                // Get the act_id from the clicked historyIcon's data attribute
                                var clickedActId = $(this).data('act-id');

                                // Find all the "acte" entries with the same act_id
                                var matchingActes = consultation.filter(function (acte) {
                                    return acte.act_id === clickedActId;
                                });

                                // Create an empty container to hold the modal content
                                var modalContentContainer = $('<div>');

                                // Iterate through the matchingActes array and add each entry to the modal content
                                $.each(matchingActes, function (index, acte) {
                                    var entryContainer = $('<div class="overflow-auto">');

                                    entryContainer.append('<p><b>Num Séance :</b> ' + acte.numseances + '</p>');
                                    entryContainer.append('<p><b>Statut :</b> ' + acte.status + '</p>');
                                    entryContainer.append('<p><b>Observation :</b> ' + acte.observation + '</p>');

                                    // Add a separator (horizontal line) between entries
                                    if (index < matchingActes.length - 1) {
                                        entryContainer.append('<hr>');
                                    }

                                    // Append the entry container to the modal content container
                                    modalContentContainer.append(entryContainer);
                                });

                                // Set the modal's content and show it
                                $('#historyModal .modal-body').html(modalContentContainer);
                                $('#historyModal').modal('show');
                            });

                            // Append cells to the row
                            actionobservation.append(observation);
                            row.append(actionobservation);
                            row.append(actionCell);
                            actionCell.append(deleteLink);

                            // Button to display total paye in a popup
                            var totalPayeButton = $('<button class="btn btn-sm" data-consultation-act-id="' + acte.consultation_act_id + '"><i class="fas fa-dollar-sign"></i></button>');
                            actionCell.append(totalPayeButton);

                            tbody.append(row);
                        }

                        // Set up click event for total paye button
                        $('#acteTable').on('click', 'button[data-consultation-act-id]', function (e) {
                            e.preventDefault();

                            var consultationActId = $(this).data('consultation-act-id');

                            // Make an AJAX request to get the total paye for the current consultation_act_id
                            $.ajax({
                                url: '{{ route('getBillingInfo') }}',
                                method: 'GET',
                                data: { consultation_act_id: consultationActId },
                                dataType: 'json',
                                success: function (billingInfo) {
                                    if (billingInfo && billingInfo.totalPaye) {
                                        // Create a Bootstrap Modal
                                        var modal = $('<div class="modal" tabindex="-1" role="dialog">');
                                        modal.html('<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Paiement</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p><b>Paiement total:</b> ' + billingInfo.totalPaye + 'DH</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button></div></div></div></div>');

                                        // Show the modal
                                        modal.modal('show');
                                    }
                                },
                                error: function () {
                                    console.error('Error fetching billing info for consultation_act_id: ' + consultationActId);
                                }
                            });
                        });
                    }
                },
                error: function () {
                    console.error('Error fetching prescription data');
                }
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
        $(document).ready(function () {
            // Attach click event handler to all area elements
            $('map area').on('click', function () {
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
                        var template = document.getElementById('rapport_labels_template');
                        var newTest = document.importNode(template.content, true);
                        document.getElementById('formContainer').appendChild(newTest);
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
        // jQuery code to handle the delete functionality
        $(document).ready(function () {
            // Attach a click event handler to the "Remove" button
            $(document).on('click', '.delete', function () {
                // Find the parent .repeatable-item and remove it
                $(this).closest('.repeatable-item').remove();
            });
        });
    </script>




@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
