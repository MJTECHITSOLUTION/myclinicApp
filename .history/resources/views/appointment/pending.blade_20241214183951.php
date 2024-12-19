@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection

@section('content')
    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Salle d'attente </h6>
                    
                </div>
                <div class="col-8">
                    @can('create appointment')
                        <a href="{{ route('appointment.create') }}" title="{{ __('sentence.New Appointment') }}"
                           class="btn rounded-0 btn-primary btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-plus"></i> <span class="icon-text">{{ __('sentence.New Appointment') }}</span>
                        </a>
                        <a href="{{ route('appointment.pending') }}" title="Salle d'attente"
                           class="btn rounded-0 btn-success btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-hourglass"></i> <span class="icon-text">Salle d'attente</span>
                        </a>

                        <!-- Button for "Tous les rendez-vous de jour" -->
                        <a href="{{ route('appointment.day') }}" title="Tous les rendez-vous de jour"
                           class="btn rounded-0 btn-warning btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-calendar"></i> <span class="icon-text">Rendez-vous d'aujourd'hui</span>
                        </a>

                        <form action="{{ route('appointment.destroyWaitingList') }}" method="POST" class="float-right ml-2 mb-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les éléments de la liste d\'attente ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-0 btn-danger btn-sm" title="Supprimer toute la liste d'attente">
                                <i class="fa fa-trash"></i> <span class="icon-text">Supprimer toute la liste d'attente</span>
                            </button>
                        </form>

                    @endcan

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        {{--                        <th class="text-center">Num</th> --}}
                        <th>{{ __('sentence.Patient Name') }}</th>
                        {{-- <th class="text-center md__screen">{{ __('sentence.Reason for visit') }}</th> --}}
                        {{-- <th class="text-center">{{ __('sentence.Schedule Info') }}</th> --}}
                        {{-- <th class="text-center xxs__screen">{{ __('sentence.Status') }}</th> --}}
                        <th class="text-center">Numéro</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            {{--                            <td class="text-center">{{ $appointment->id }}</td> --}}
                            <td><a href="{{ url('patient/view/' . $appointment->user_id) }}">
                                    {{ $appointment->User->name }} </a></td>
                            {{-- <td class="text-center md__screen"><label
                                    class="badge badge-primary-soft">{{ $appointment->reason }}</label></td> --}}

                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    <i class="fas fa-calendar"></i> {{ $appointment->num }} 
                                </label>
                                <a href="#" onclick="printValue('{{ $appointment->num }}')" title="Imprimer" style="margin-left: 10px;">
                                    <i class="fas fa-print text-primary rounded-circle"></i>
                                </a>
                              
                              
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('appointment/delete/' . $appointment->id) }}" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>

                                <label class="switchA" style="margin-left: 10px;">
                                    <input type="checkbox" 
                                           onclick="toggleActive(this, {{ $appointment->id }});" 
                                           {{ $appointment->active ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                                
                                
                            </td>
                          
                            {{-- <td class="text-center xxs__screen"> --}}
                                {{-- @if ($appointment->visited == 0)
                                    <label class="badge badge-warning-soft">
                                        <i class="fas fa-hourglass-start"></i> {{ __('sentence.Not Yet Visited') }}
                                    </label>
                                @elseif($appointment->visited == 1)
                                    <label class="badge badge-primary-soft">
                                        <i class="fas fa-check"></i> Terminé
                                    </label> --}}
                                {{-- @if($appointment->visited == 3)
                                    <label class="badge badge-success-soft">
                                        <i class="fas fa-check"></i>Salle d'attente
                                    </label>
                                @elseif($appointment->visited == 4)
                                    <label class="badge badge-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                                            <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                        </svg>Salle soin
                                    </label> --}}
                                {{-- @else --}}
                                    {{-- <label class="badge badge-danger-soft">
                                        <i class="fas fa-user-times"></i> {{ __('sentence.Cancelled') }}
                                    </label> --}}
                                {{-- @endif --}}
                            {{-- </td> --}}
                            {{-- <td class="text-center">{{ $appointment->hours }}</td>
                            <td align="center">
                                @can('edit appointment')
                                    <a id="editAppointmentButton" data-rdv_id="{{ $appointment->id }}"
                                       data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                       data-rdv_time_start="{{ $appointment->time_start }}"
                                       data-rdv_time_end="{{ $appointment->time_end }}"
                                       data-patient_name="{{ $appointment->User->name }}"
                                       class="btn   btn-outline-success btn-circle btn-sm" data-toggle="modal"
                                       data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                                @endcan
                                @can('delete appointment')
                                    <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                       data-target="#DeleteModal"
                                       data-link="{{ url('appointment/delete/' . $appointment->id) }}"><i
                                            class="fas fa-trash"></i></a>
                                @endcan
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} " /> <br><br> <b
                                    class="text-muted">Vous n'avez pas de rendez-vous</b></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                {{--         <span class="float-right mt-3">{{ $appointments->links() }}</span> --}}
            </div>
        </div>
    </div>
    <!--EDIT Appointment Modal-->
    <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ __('sentence.You are about to modify an appointment') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                    <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft"
                                                                      id="rdv_time"></label></p>
                </div>
                <div class="modal-footer">
                    <a class="btn rounded-0  btn-primary text-white"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
                    <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST"
                          class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        @csrf
                    </form>
                    <a class="btn rounded-0  btn-danger text-white"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
                    <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST"
                          class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        @csrf
                    </form>
                    <a class="btn rounded-0  btn-success  text-white" id="salle"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-salle').submit();">+Salle
                        d'attente</a>
                    <form id="rdv-form-salle" action="{{ route('appointment.store_edit') }}" method="POST"
                          class="d-none">
                        <input type="time" id="time" name="hours" class="form-control"
                               value="{{ now()->format('H:i') }}">
                        <input type="hidden" name="rdv_id" id="rdv_id3">
                        <input type="hidden" name="rdv_status" value="3">
                        @csrf
                    </form>
                    <a class="btn rounded-0  btn-primary  text-white" id="salle"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-soin').submit();">Salle de soin</a>
                    <form id="rdv-form-soin" action="{{ route('appointment.store_edit') }}" method="POST"
                          class="d-none">
                        <input type="time" id="time" name="hours" class="form-control"
                               value="{{ now()->format('H:i') }}">
                        <input type="hidden" name="rdv_id" id="rdv_id4">
                        <input type="hidden" name="rdv_status" value="4">
                        @csrf
                    </form>
                    <button class="btn rounded-0  btn-secondary" type="button"
                            data-dismiss="modal">{{ __('sentence.Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Find the button element by its id
            var editAppointmentButton = document.getElementById('editAppointmentButton');

            // Find the "rdv_id3" input element
            var rdvId3Input = document.getElementById('rdv_id3');

            // Add a click event listener to the button
            editAppointmentButton.addEventListener('click', function(event) {
                // Prevent the default behavior (opening the modal in this case)
                event.preventDefault();

                // Get the value of the 'data-rdv_id' attribute from the button
                var rdvId = editAppointmentButton.getAttribute('data-rdv_id');

                // Set the value of the 'rdv_id3' input
                rdvId3Input.value = rdvId;
            });
        });
    </script>


    <style type="text/css">
        td>a {
            font-weight: 600;
            font-size: 15px;
        }
    </style>

    {{-- <script> --}}
    {{--    document.addEventListener("DOMContentLoaded", function() { --}}
    {{--        // Add a click event listener to the "Salle d'attente" button --}}
    {{--        var salleDAttenteButton = document.querySelector('.salle'); --}}
    {{--        var rdvId3Input = document.getElementById('rdv_id3'); --}}

    {{--        salleDAttenteButton.addEventListener('click', function() { --}}
    {{--            // Get the rdv_id from the clicked button's data attribute --}}
    {{--            var rdvId = salleDAttenteButton.getAttribute('data-rdv_id'); --}}

    {{--            // Set the rdv_id as the value of the rdv_id3 input field --}}
    {{--            rdvId3Input.value = rdvId; --}}
    {{--        }); --}}
    {{--    }); --}}
    {{-- </script> --}}
    {{-- <script> --}}
    {{--    $(document).ready(function() { --}}
    {{--        $('#rdv_id2').on('input', function() { --}}
    {{--            var rdvId2Value = $(this).val(); --}}
    {{--            $('#rdv_id3').val(rdvId2Value); --}}
    {{--        }); --}}
    {{--    }); --}}
    {{-- </script> --}}
    <script>
       
       function printValue(num) {
    const doctor = "{{ App\Setting::get_option('title') }}";
    const address = "{{ App\Setting::get_option('address') }}";
    const city = "{{ App\Setting::get_option('ville') }}";
    const phone = "{{ App\Setting::get_option('phone') }}";
    const logo = "{{ App\Setting::get_option('logo') }}";

    const printWindow = window.open('', '_blank', 'width=600,height=400');
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<style>img { max-width: 100%; height: auto; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<div style="text-align:center; max-width: 50%; margin: 0 auto;"><img src="{{ asset("img/logo-grey.png") }}" alt="Logo" style="width: 100%;" /></div>');
    printWindow.document.write('<div style="display:flex; flex-direction:column; justify-content:center; align-items:center; height:80vh;">');
    printWindow.document.write('<h3 style="text-align:center; margin:0;">Numéro</h3>');
    printWindow.document.write('<h1 style="text-align:center; font-size:xxx-large; margin:20px 0;">' + num + '</h1>');
    printWindow.document.write('</div>');
    printWindow.document.write('<footer style="position:fixed; bottom:20px; width:100%; font-size:small; text-align:center;">');
    printWindow.document.write('Docteur : ' + doctor + '<br>');
    printWindow.document.write('Adresse : ' + address + ', ' + city + ', ' + phone + '.</footer>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}


function toggleActive(checkbox, appointmentId) {
    // Get the parent label element for styling
    var label = checkbox.closest('.switchA');
    var isActive = checkbox.checked; // Get the current state of the checkbox
    var newStatus = isActive ? 1 : 0;

    // Optionally update the UI dynamically (e.g., change label style)
    label.classList.toggle('active', isActive);

    // Make an AJAX request to update the status in the database
    $.ajax({
        url: '/update-active-status/' + appointmentId,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            active: newStatus
        },
        success: function(response) {
            if (!response.success) {
                // Revert checkbox state if the update fails
                checkbox.checked = !isActive;
                label.classList.toggle('active', !isActive);
                alert('Failed to update the status.');
            }
        },
        error: function() {
            // Handle AJAX errors
            checkbox.checked = !isActive;
            label.classList.toggle('active', !isActive);
            alert('An error occurred. Please try again.');
        }
    });
}


</script>

<style>
    .icon-text {
        display: none;
    }
    .btn:hover .icon-text {
        display: inline;
        animation: fadeIn 0.3s;
    }
    .btn:hover i {
        display: none;
    }
    .btn:hover i {
        display: inline;
        animation: fadeIn 0.3s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

/*



</style>
@endsection

@section('footer')
@endsection
