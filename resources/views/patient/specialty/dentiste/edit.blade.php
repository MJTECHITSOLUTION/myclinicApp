
@section('content')
    <form method="post" action="{{ route('patient.store_edit') }}" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">

                        <div class="row">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-primary">Modifier fiche patient</h6>
                            </div>
                            <div class="col-4">
                                @can('view patient')
                                    <button type="submit" class="btn rounded-0  btn-primary btn-sm float-right"
                                        style="margin-left: 15px;">{{ __('sentence.Save') }}</button>
                                    <a href="{{ route('patient.view', ['id' => $patient->id]) }}"
                                        class="btn rounded-0  btn-primary btn-sm float-right ">Afichier dossier patient</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Name"
                                    name="name" value="{{ $patient->name }}">
                                <input type="hidden" class="form-control rounded-0 shadow-none " name="user_id"
                                    value="{{ $patient->id }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputAddress">{{ __('sentence.Birthday') }}<font color="red">*</font></label>
                                <input type="date" class="form-control rounded-0 shadow-none " id="Birthday"
                                    name="birthday" autocomplete="off" value="{{ $patient->Patient->birthday }}">
                            </div>


                            <div class="form-group col-md-3">
                                <label for="inputCity">{{ __('sentence.Gender') }}<font color="red">*</font></label>
                                <select class="form-control rounded-0 shadow-none " name="gender" id="Gender">
                                    <option value="{{ $patient->Patient->gender }}" selected="selected">
                                        {{ $patient->Patient->gender }}</option>
                                    <option value="Homme">{{ __('sentence.Male') }}</option>
                                    <option value="Femme">{{ __('sentence.Female') }}</option>
                                    <option value="Enfant">Enfant</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputdossier">Numéro de dossier physique</label>
                                <input type="text" class="form-control" name="numdossier" id="numdossier" value="{{$patient->Patient->numdossier}}">
                            </div>
                        </div>
                        <div class="form-row">
                            {{--                    <div class="form-group col-md-6"> --}}
                            {{--                        <label for="inputAddress2">{{ __('sentence.Patient Weight') }}</label> --}}
                            {{--                        <input type="text" class="form-control rounded-0 shadow-none " id="Weight" name="weight" value="{{ $patient->Patient->weight }}"> --}}
                            {{--                    </div> --}}
                            {{--                    <div class="form-group col-md-6"> --}}
                            {{--                        <label for="inputAddress">{{ __('sentence.Patient Height') }}<font color="red">*</font></label> --}}
                            {{--                        <input type="text" class="form-control rounded-0 shadow-none " id="height" name="height" value="{{ $patient->Patient->height }}"> --}}
                            {{--                    </div> --}}

                        </div>

                        <h4 class="scheduler-border">Informations supplementaires</h4>
                        <div class="form-row">
{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="inputZip">{{ __('sentence.Blood Group') }}</label>--}}
{{--                                <select class="form-control rounded-0 shadow-none " name="blood" id="Blood">--}}
{{--                                    <option value="{{ $patient->Patient->blood }}" selected="selected">--}}
{{--                                        {{ $patient->Patient->blood }}</option>--}}
{{--                                    <option value="Unknown">{{ __('sentence.Unknown') }}</option>--}}
{{--                                    <option value="A+">A+</option>--}}
{{--                                    <option value="A-">A-</option>--}}
{{--                                    <option value="B+">B+</option>--}}
{{--                                    <option value="B-">B-</option>--}}
{{--                                    <option value="O+">O+</option>--}}
{{--                                    <option value="O-">O-</option>--}}
{{--                                    <option value="AB+">AB+</option>--}}
{{--                                    <option value="AB-">AB-</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-4">--}}
{{--                                <label for="inputArabic"> Arabic Nom </label>--}}
{{--                                <input type="text" class="form-control rounded-0 shadow-none " id="Arabicname"--}}
{{--                                    name="nameArabic" lang="ar" dir="rtl"--}}
{{--                                    value="{{ $patient->Patient->nameArabic }}">--}}
{{--                            </div>--}}


                            {{--                        <div class="form-group col-md-4"> --}}
                            {{--                            <label for="inputAddress2">Nom et prénom du représentant légal </label> --}}
                            {{--                            <input type="text" class="form-control rounded-0 shadow-none " id="nbenfant" name="nbenfant" value="{{ $patient->Patient->nbenfant }}"> --}}
                            {{--                        </div> --}}
                            <div class="form-group col-md-4">
                                <label for="inputAddress">{{ __('sentence.Profession') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="profession"
                                    name="profession" value="{{ $patient->Patient->profession }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress">CIN</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="cin"
                                    name="cin" autocomplete="off" value="{{ $patient->Patient->cin }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Assurance</label>
                                <select class="form-control rounded-0 shadow-none " name="assurance" id="assurance">
                                    <option value="{{ $patient->Patient->assurance }}">
                                        {{ $patient->Patient->assurance }}</option>
                                    @foreach ($assurances as $assurance)
                                        <option value="{{ $assurance->assurance_name }}">
                                            {{ $assurance->assurance_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">{{ __('sentence.Image') }}</label>
                                <br>
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Sélectionner photo...
                                </label>
                                <input type="file" class="form-control rounded-0 shadow-none " id="file-upload"
                                       name="image">
                            </div>
                        </div>
                        {{--                    <div><label>Situation familiale</label></div> --}}

                        {{--                    <div class="form-check form-check-inline"> --}}
                        {{--                        <input class="form-check-input" type="radio" name="Situation" id="Situation1" value="Celibataire"> --}}
                        {{--                        <label class="form-check-label" for="inlineRadio1">Célibataire</label> --}}
                        {{--                    </div> --}}
                        {{--                    <div class="form-check form-check-inline"> --}}
                        {{--                        <input class="form-check-input" type="radio" name="Situation" id="Situation2" value="Marie"> --}}
                        {{--                        <label class="form-check-label" for="inlineRadio2">Marié(e)</label> --}}
                        {{--                    </div> --}}
                        {{--                    <div class="form-check form-check-inline"> --}}
                        {{--                        <input class="form-check-input" type="radio" name="Situation" id="Situation3" value="Divorce" > --}}
                        {{--                        <label class="form-check-label" for="inlineRadio3">Divorcé(e)</label> --}}
                        {{--                    </div> --}}
                        {{--                    <div class="form-check form-check-inline"> --}}
                        {{--                        <input class="form-check-input" type="radio" name="Situation" id="Situation4" value="veuve" > --}}
                        {{--                        <label class="form-check-label" for="inlineRadio3">veuve/veuf</label> --}}
                        {{--                    </div> --}}
                        <br>

                        <h4 class="scheduler-border">Adresse et contact</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('sentence.Address') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Address"
                                    name="adress" value="{{ $patient->Patient->adress }}">
                            </div>

                            {{--                        <div class="form-group col-md-3"> --}}
                            {{--                            <label for="inputAddress2">{{ __('sentence.Province') }}</label> --}}
                            {{--                            <input type="text" class="form-control rounded-0 shadow-none " id="Province" name="Province" value="{{ $patient->Patient->province }}"> --}}
                            {{--                        </div> --}}
                            {{--                        <div class="form-group col-md-3"> --}}
                            {{--                            <label for="inputAddress2">{{ __('sentence.Code postal') }}</label> --}}
                            {{--                            <input type="text" class="form-control rounded-0 shadow-none " id="postal" name="postal" value="{{ $patient->Patient->postal }}"> --}}
                            {{--                        </div> --}}
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ __('sentence.Ville') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Ville"
                                    name="Ville" value="{{ $patient->Patient->ville }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ __('sentence.Pays') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Pays"
                                    name="Pays" value="Maroc" value="{{ $patient->Patient->pays }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">{{ __('sentence.Email Adress') }}</label>
                                <input type="email" class="form-control rounded-0 shadow-none " id="Email"
                                    name="email" value="{{ $patient->email }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputAddress2">{{ __('sentence.Phone') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Phone"
                                    name="phone" value="{{ $patient->Patient->phone }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">{{ __('sentence.fixe') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="fixe"
                                    name="fixe" value="{{ $patient->Patient->fixe }}">
                            </div>
                        </div>

                        <h4 class="scheduler-border">Observation</h4>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Observation</label>
                                <textarea class="form-control rounded-0 shadow-none " id="historiquemaladie" name="historiquemaladie"> {{ $patient->Patient->historiquemaladie }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row col-12 d-flex justify-content-end">
                            <button type="submit" class="btn rounded-0  btn-primary">{{ __('sentence.Save') }}</button>

                        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
@endsection
@section('header')
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            width: inherit;
            /* Or auto */
            padding: 0 10px;
            /* To give a bit of padding on the left and right */
            border-bottom: none;
        }
    </style>
@endsection
@section('footer')
@endsection
