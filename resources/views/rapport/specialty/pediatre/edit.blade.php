@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rapport</title>
    </head>

    <body>
        <form method="post" action="{{ route('rapport.update') }}">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                                <select class="form-control multiselect-doctorino" name="user_id" id="PatientID">
                                    <option value="{{ $patient->id }}">{{ $patient->name }}
                                    </option>
                                </select>
                                {{ csrf_field() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="submit" value="Enregistrer" class="btn btn-success"
                        style="position: relative; left: 900px; margin-bottom: 20px;" align="center">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rapport</h6>
                        </div>
                        <br>
                        <div id="print_ropos">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h3
                                                        style="text-align: center; position: absolute; top: 35%; left: 50%; transform: translate(-50%, -50%);">
                                                        Rapport (Ropos)</h3>
                                                    <br>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center" style="margin-top: 100px;">
                                                <div class="col">
                                                    @foreach ($settings as $setting)
                                                        Je soussigne <strong>{{ $setting->option_value }}</strong> <br><br>
                                                    @endforeach
                                                    @foreach ($rapports as $rapport)
                                                        <input type="hidden" name="id" value="{{ $rapport->id }}">
                                                        Que l'état de santé de l'enfant <strong><input type="text"
                                                                class="form-line" id="child_health2" name="child"
                                                                value="{{ $rapport->child }}"></strong> <br> <br>
                                                        Nécessite un repos de <b><input type="number" class="form-line"
                                                                id="rest_days" name="nb_jour"
                                                                value="{{ $rapport->nb_jour }}"></b> jours
                                                        à partir du <b><input type="date" class="form-line"
                                                                id="start_date" name="date_debut"
                                                                value="{{ $rapport->date_debut }}"></b>
                                                    @endforeach
                                                    <strong><u> </u></strong><br><br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div style="margin-bottom: 40px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="print_presence_tutours">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h3
                                                        style="text-align: center; position: absolute; top: 35%; left: 50%; transform: translate(-50%, -50%);">
                                                        Rapport (tuteur)</h3>
                                                    <br>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center" style="margin-top: 100px;">
                                                <div class="col">
                                                    @foreach ($settings as $setting)
                                                        Je soussigne <strong>{{ $setting->option_value }}</strong> <br><br>
                                                    @endforeach
                                                    @foreach ($rapports as $rapport)
                                                        Que l'état de santé de l'enfant <strong><input type="text"
                                                                class="form-line" id="child_health2" name="child"
                                                                value="{{ $rapport->child }}"></strong><br> <br>
                                                        Nécessite la presance de <b><input type="text" class="form-line"
                                                                id="parent" name="tuteur" style="width: 400px;"
                                                                value="{{ $rapport->tuteur }}"></b> <br> <br> Aupres de lui
                                                        pendant <b><input type="number" class="form-line" name="nb_jour1"
                                                                id="nb_jour1" style="width: 80px;"
                                                                value="{{ $rapport->nb_jour1 }}"> </b> jours
                                                        à partir du <b><input type="date" class="form-line"
                                                                id="start_date" name="date_debut"
                                                                value="{{ $rapport->date_debut }}"></b>
                                                    @endforeach
                                                    <div style="margin-bottom: 40px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="print_ecole">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h3
                                                        style="text-align: center; position: absolute; top: 35%; left: 50%; transform: translate(-50%, -50%);">
                                                        Rapport (ecole)</h3>
                                                    <br>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center" style="margin-top: 100px;">
                                                <div class="col">
                                                    @foreach ($settings as $setting)
                                                        Je soussigne <strong>{{ $setting->option_value }}</strong> <br><br>
                                                    @endforeach
                                                    @foreach ($rapports as $rapport)
                                                        Que <strong><input type="text" class="form-line"
                                                                id="child_health2" name="child"
                                                                value="{{ $rapport->child }}"></strong> est en bonne santé
                                                        et peut Intégrer la crèche sans aucun soucis
                                                    @endforeach
                                                    <br><br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div style="margin-bottom: 40px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="print_libre">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h3
                                                        style="text-align: center; position: absolute; top: 35%; left: 50%; transform: translate(-50%, -50%);">
                                                        Rapport (libre)</h3>
                                                    <br>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center" style="margin-top: 20px;">
                                                <div class="col">
                                                    @foreach ($rapports as $rapport)
                                                        <textarea id="editor" name="libre" value="{{ $rapport->libre }}">{{ $rapport->libre }}</textarea>
                                                        <script src="{{ asset('dashboard/js/http_cdn.tiny.cloud_1_no-api-key_tinymce_6_tinymce.js') }}" type="text/javascript">
                                                        </script>
                                                        <script>
                                                            tinymce.init({
                                                                selector: "#editor"
                                                            });
                                                        </script>
                                                    @endforeach

                                                    <div style="margin-bottom: 10px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="print_ordanance_libre" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card-body">
                                        <!-- ROW: Doctor informations -->
                                        <div class="row">
                                            <div class="col text-center"><br><br><br><br><br><br>
                                                <br><br><br><br><br><br>
                                            </div>
                                        </div><br><br><br><br>
                                        <div class="row mt-100" style="font-size: x-large">
                                            <div class="col">
                                                @foreach ($rapports as $rapport)
                                                    <b style="font-size: xx-large"> {!! nl2br(e($rapport->libre)) !!}</b>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="print_ordanance_ecole" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card-body">
                                        <!-- ROW: Doctor informations -->
                                        <div class="row">
                                            <div class="col text-center"><br><br><br><br><br><br>
                                                <br><br><br><br><br><br>
                                            </div>
                                        </div><br><br><br><br><br><br><br><br>
                                        <div class="row mt-100" style="font-size: x-large">
                                            <div class="col" style="font-size: xx-large">
                                                @foreach ($settings as $setting)
                                                    <p> Je soussigne <strong>{{ $setting->option_value }}</strong> </p>
                                                @endforeach
                                                @foreach ($rapports as $rapport)
                                                    <p> Que <strong>{{ $rapport->child }}</strong> est en bonne santé
                                                        et peut intègrer la crèche sans aucun soucis </p>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="print_ordanance_tuteur" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card-body">
                                        <!-- ROW: Doctor informations -->
                                        <div class="row">
                                            <div class="col text-center"><br><br><br><br><br><br>
                                                <br><br><br><br><br><br>
                                            </div>
                                        </div><br><br><br><br>
                                        <div class="row mt-100" style="font-size: x-large">
                                            <div class="col" style="font-size: xx-large">
                                                @foreach ($settings as $setting)
                                                    Je soussigne <strong>{{ $setting->option_value }}</strong> <br><br>
                                                @endforeach
                                                @foreach ($rapports as $rapport)
                                                    <p>Que l'état de santé de l'enfant
                                                        <strong>{{ $rapport->child }}</strong>
                                                    </p>
                                                    <p> Nécessite la presance de sa <b>{{ $rapport->tuteur }}</b> </p>
                                                    Auprès de lui pendant <b> {{ $rapport->nb_jour }}</b> jours
                                                    à partir du <b>{{ $rapport->date_debut }}</b>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="print_ordanance_ropos" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="card-body">
                                        <!-- ROW: Doctor informations -->
                                        <div class="row">
                                            <div class="col text-center"><br><br><br><br><br><br>
                                                <br><br><br><br><br><br>
                                            </div>
                                        </div><br><br><br><br><br><br><br><br>
                                        <div class="row mt-100" style="font-size: x-large">
                                            <div class="col" style="font-size: xx-large">
                                                @foreach ($settings as $setting)
                                                    Je soussigne <strong>{{ $setting->option_value }}</strong> <br><br>
                                                @endforeach
                                                Que l'état de santé de l'enfant <strong>{{ $rapport->child }}</strong> <br>
                                                <br>
                                                Nécessite un repos de <b>{{ $rapport->nb_jour }}</b> jours
                                                à partir du <b>{{ $rapport->date_debut }}</b>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </body>

    </html>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var labelValue = "{{ $label }}";

        function showDivForLabel() {
            var divRopos = document.getElementById('print_ropos');
            var divPresenceTutours = document.getElementById('print_presence_tutours');
            var divEcole = document.getElementById('print_ecole');
            var divLibre = document.getElementById('print_libre');

            divRopos.style.display = 'none';
            divPresenceTutours.style.display = 'none';
            divEcole.style.display = 'none';
            divLibre.style.display = 'none';

            if (labelValue === 'Repos') {
                divRopos.style.display = 'block';
            } else if (labelValue === 'Présence tuteur') {
                divPresenceTutours.style.display = 'block';
            } else if (labelValue === 'Ecole') {
                divEcole.style.display = 'block';
            } else if (labelValue === 'Libre') {
                divLibre.style.display = 'block';
            }
        }
        window.onload = showDivForLabel;
    </script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
