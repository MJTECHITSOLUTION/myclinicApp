@section('content')
    <form method="post" action="{{ route('patient.create') }}" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-primary">Créer fiche Patient</h6>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn rounded-0  btn-primary btn-sm float-right"
                                    style="margin-left: 15px;">{{ __('sentence.Save') }}</button>
                                <a href="{{ route('patient.all') }}"
                                    class="btn rounded-0  btn-info btn-sm float-right ">Tous les patinets</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Name"
                                    name="name" required>
                            </div>



                            <div class="form-group col-md-3">
                                <label for="inputAddress">{{ __('sentence.Birthday') }}<font color="red">*</font></label>
                                @php
                                    $yesterday = \Carbon\Carbon::now()->subDay()->toDateString();
                                @endphp
                                <input type="date" class="form-control rounded-0 shadow-none" id="Birthday" name="birthday" autocomplete="off" required value="{{ $yesterday }}">
                            </div>
                            

                            <div class="form-group col-md-3">
                                <label for="inputCity">{{ __('sentence.Gender') }}<font color="red">*</font></label>
                                <select class="form-control rounded-0 shadow-none" name="gender" id="Gender" required>
                                    <option value="">Sélecionner...</option>
                                    <option value="Homme">{{ __('sentence.Male') }}</option>
                                    <option value="Femme">{{ __('sentence.Female') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputdossier">Numéro de dossier physique</label>
                                <input type="text" class="form-control" name="numdossier" id="numdossier">
                            </div>
                        </div>


                        <h4 class="scheduler-border">Informations supplementaires</h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputZip">{{ __('sentence.Blood Group') }}</label>
                                <select class="form-control rounded-0 shadow-none" name="blood" id="Blood">
                                    <option value="Unknown">{{ __('sentence.Unknown') }}...</option>
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
                                <label for="inputArabic">Nom complet en arabe </label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Arabicname"
                                    name="nameArabic" lang="ar" dir="rtl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">{{ __('sentence.Image') }}</label>
                                <br>
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Sélectionner photo...
                                </label>
                                <input type="file" class="form-control rounded-0 w-100 shadow-none" id="file-upload"
                                    name="image">
                            </div>


                            {{--                        <div class="form-group col-md-4"> --}}
                            {{--                            <label for="inputAddress2">Nom et prénom du représentant légal </label> --}}
                            {{--                            <input type="text" class="form-control" id="nbenfant" name="nbenfant"> --}}
                            {{--                        </div> --}}
                            <div class="form-group col-md-4">
                                <label for="inputAddress">{{ __('sentence.Profession') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="profession"
                                    name="profession">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress">CIN</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="cin"
                                    name="cin">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Assurance </label>
                                <select class="form-control rounded-0 shadow-none" name="assurance" id="assurance">
                                    <option value="">Sélectionner Assurance</option>
                                    @foreach ($assurances as $assurance)
                                        <option value="{{ $assurance->assurance_name }}">
                                            {{ $assurance->assurance_name }}</option>
                                    @endforeach
                                </select>
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

                        <h4 class="scheduler-border">Adresse et contact</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('sentence.Address') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Address"
                                    name="adress">
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
                                <label for="inputAddress2">{{ __('sentence.Ville') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Ville"
                                    name="Ville">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ __('sentence.Pays') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Pays"
                                    name="Pays" value="Maroc">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">{{ __('sentence.Email Adress') }}</label>
                                <input type="email" class="form-control rounded-0 shadow-none" id="Email"
                                    name="email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">{{ __('sentence.Phone') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Phone"
                                    name="phone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">{{ __('sentence.fixe') }}</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="fixe"
                                    name="fixe">
                            </div>
                        </div>


                        <h4 class="scheduler-border">Observation</h4>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">{{ __('sentence.observation') }}</label>
                                <textarea class="form-control rounded-0 shadow-none" id="historiquemaladie" name="historiquemaladie"></textarea>
                            </div>
                        </div>

                        </h4>



                        <div class="row justify-content-end col-12">


                            <button type="submit"
                                class="btn rounded-0  btn-primary ccess">{{ __('sentence.Save') }}</button>

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
