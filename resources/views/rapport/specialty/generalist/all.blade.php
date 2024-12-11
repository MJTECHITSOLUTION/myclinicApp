@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport</h6>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        {{--                        <label for="PatientID" class="my__label">{{ __('sentence.Patient') }} :</label>--}}
                        <select class="form-control" name="user_id" id="PatientID">
                            <option value="">{{ __('sentence.Select Patient') }}</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                        {{ csrf_field() }}
                    </div>
                </div>
                <div class="col-4">
                    <a href="{{ route('rapport.create') }}" class="btn rounded-0  btn-primary btn-sm float-right"><i
                            class="fa fa-plus"></i> Nouvelle Rapport</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{--                        <th>ID</th> --}}
                            <th>{{ __('sentence.Patient') }}</th>
                            <th class="text-center">Rapport</th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse($rapport_types as $rapport_type)
                                <td><a> {{ $rapport_type->name }} </a></td>
                                <td class="text-center">
                                    <label class="badge badge-primary-soft">
                                        {{ $rapport_type->label }}
                                        <input type="hidden" name="label" id="label"
                                            value="{{ $rapport_type->label }}">
                                    </label>
                                    <label class="badge badge-primary-soft">
                                    </label>
                                </td>

                                <td class="text-center">
                                    <a href="{{ url('rapport/view/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id) }}"
                                        class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('rapport/edit/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id) }}"
                                        class="btn   btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                    <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-link="{{ url('rapport/delete/' . $rapport_type->id) }}"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center"><img src="{{ asset('img/not-found.svg') }}"
                                    width="200" /> <br><br> <b class="text-muted">Aucun Rapport trouvé</b></td>
                        </tr>
                    </tbody>
                    @endforelse

                </table>


            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('#PatientID').select2();
        });
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

@endsection
@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
