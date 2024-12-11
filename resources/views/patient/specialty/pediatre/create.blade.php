@section('content')
    <form method="post" action="{{ route('patient.create') }}" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="m-0 font-weight-bold text-primary mb-3">Créer fiche Patient</h6>
                            </div>
                            <div class="col-sm-7   ">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('patient.all') }}"
                                        class="btn btn-info btn-sm float-right my__btn mr-2  rounded-0">Tous les
                                        patinets</a>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm float-right my__btn   rounded-0">{{ __('sentence.Save') }}</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4" class="my__label">{{ __('sentence.Full Name') }}<font
                                        color="red"> *</font></label>
                                <input type="text" class="form-control shadow-none  rounded-0" id="Name"
                                    name="name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress" class="my__label">{{ __('sentence.Birthday') }}<font
                                        color="red"> *</font></label>
                                <input type="date" class="form-control shadow-none rounded-0" id="Birthday"
                                    name="birthday" autocomplete="off">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputCity" class="my__label">{{ __('sentence.Gender') }}<font color="red"> *
                                    </font></label>
                                <select class="form-control shadow-none rounded-0" name="gender" id="Gender">
                                    <option value="Garçon">Garçon</option>
                                    <option value="Fille">Fille</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <div class="form-row">
                            {{--                  <div class="form-group col-md-6"> --}}
                            {{--                     <label for="inputAddress2">{{ __('sentence.Patient Weight') }}</label> --}}
                            {{--                     <input type="text" class="form-control" id="Weight" name="weight"> --}}
                            {{--                  </div> --}}
                            {{--                  <div class="form-group col-md-6"> --}}
                            {{--                     <label for="inputAddress">{{ __('sentence.Patient Height') }}<font color="red">*</font></label> --}}
                            {{--                     <input type="text" class="form-control" id="height" name="height"> --}}
                            {{--                  </div> --}}

                        </div>

                        <div class="mb-4">
                            <h3 class="underline display-6">Informations supplementaires</h3>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-4">
                                    <label for="inputZip" class="my__label">{{ __('sentence.Blood Group') }} de
                                        l'enfant</label>
                                    <select class="form-control shadow-none my__field__input rounded-0" name="blood"
                                        id="Blood">
                                        <option value="Unknown">{{ __('sentence.Unknown') }}</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState" class="my__label">{{ __('sentence.Image') }}</label>
                                    <br>
                                    <label for="file-upload" class="custom-file-upload w-100">
                                        <i class="fa fa-cloud-upload"></i> Selectionner l'image de l'enfant ...
                                    </label>
                                    <input type="file" class="form-control shadow-none" id="file-upload" name="image">
                                </div>
                                <div class="form-group col-md-4">

                                </div>


                                <div class="form-group col-md-4">
                                    <label for="inputAddress2" class="my__label">Nom et prénom du tuteur
                                    </label>
                                    <input type="text" class="form-control shadow-none my__field__input rounded-0"
                                        id="nbenfant" name="nbenfant">
                                </div>
                                {{--                        <div class="form-group col-md-3"> --}}
                                {{--                            <label for="inputAddress">{{ __('sentence.Profession') }}</label> --}}
                                {{--                            <input type="text" class="form-control" id="profession" name="profession"> --}}

                                {{--                        </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="inputAddress" class="my__label">CIN</label>
                                    <input type="text" class="form-control shadow-none my__field__input rounded-0"
                                        id="cin" name="cin">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip" class="my__label">Assurance </label>
                                    <select class="form-control shadow-none my__field__input rounded-0" name="assurance"
                                        id="assurance">
                                        <option value="">Sélectionner Assurance</option>
                                    @foreach ($assurances as $assurance)
                                            <option value="{{ $assurance->assurance_name }}">
                                                {{ $assurance->assurance_name }}</option>
                                        @endforeach
                                    </select>
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
                            {{--                    </div><br><br> --}}

                        </div>
                        <hr>

                        <div class="mb-4">
                            <h3 class=" display-6">Adresse et contact</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2" class="my__label">{{ __('sentence.Address') }}</label>
                                    <input type="text" class="form-control shadow-none my__field__input rounded-0"
                                        id="Address" name="adress">
                                </div>
                                {{--                        <div class="form-group col-md-3"> --}}
                                {{--                            <label for="inputAddress2">{{ __('sentence.Province') }}</label> --}}
                                {{--                            <input type="text" class="form-control" id="Province" name="Province"> --}}
                                {{--                            </div> --}}
                                {{--                        <div class="form-group col-md-3"> --}}
                                {{--                            <label for="inputAddress2">{{ __('sentence.Code postal') }}</label> --}}
                                {{--                            <input type="text" class="form-control" id="postal" name="postal"> --}}
                                {{--                        </div> --}}
                                <div class="form-group col-md-3">
                                    <label for="inputAddress2" class="my__label"> {{ __('sentence.Ville') }}</label>
                                    <input type="text" class="form-control shadow-none my__field__input rounded-0"
                                        id="Ville" name="Ville">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputAddress2" class="my__label">{{ __('sentence.Pays') }}</label>
                                    <input type="text" class="form-control shadow-none my__field__input rounded-0"
                                        id="Pays" name="Pays" value="Maroc">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4"
                                        class="my__label">{{ __('sentence.Email Adress') }}</label>
                                    <input type="email" class="form-control shadow-none my__field__input rounded-0"
                                        id="Email" name="email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputAddress2" class="my__label">{{ __('sentence.Phone') }}</label>
                                    <input type="text" class="form-control shadow-none my__field__input rounded-0"
                                        id="Phone" name="phone">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputAddress2" class="my__label">{{ __('sentence.fixe') }}</label>
                                    <input type="text" class="form-control shadow-none my__field__input rounded-0"
                                        id="fixe" name="fixe">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="mb-4">
                            <h3 class=" display-6">Observation</h3>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputAddress2" class="my__label">{{ __('sentence.observation') }}</label>
                                    <textarea class="form-control shadow-none my__field__input rounded-0" id="historiquemaladie"
                                        name="historiquemaladie"></textarea>
                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <div class="d-flex justify-content-end col-12">
                                <button type="submit"
                                    class="btn btn-primary  rounded-0">{{ __('sentence.Save') }}</button>
                            </div>


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
