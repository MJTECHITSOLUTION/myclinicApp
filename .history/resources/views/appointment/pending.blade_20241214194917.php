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

                        <form action="{{ route('appointment.destroyWaitingList') }}" method="POST" class="float-right ml-2 mb-1" onsubmit="event.preventDefault(); Swal.fire({
                            title: 'Êtes-vous sûr?',
                            text: 'Voulez-vous vraiment supprimer tous les éléments de la liste d\'attente ?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oui, supprimer!',
                            cancelButtonText: 'Annuler'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                            }
                        });">
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
                <table class="table table-striped table-bordered" id="mytable" width="100%" cellspacing="0">
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
                            <td><a href="{{ url('patient/view/' . $appointment->user_id) }}">
                                    {{ $appointment->User->name }} </a></td>

                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    <i class="fas fa-calendar"></i> {{ $appointment->num }} 
                                </label>
                                @if($appointment->active)
                                    <a href="#" onclick="printValue('{{ $appointment->num }}')" title="Imprimer" style="margin-left: 10px;">
                                        <i class="fas fa-print text-primary rounded-circle"></i>
                                    </a>
                                @else
                                    <span title="Imprimer" style="margin-left: 10px; cursor: not-allowed;">
                                        <i class="fas fa-print text-secondary rounded-circle"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-circle btn-sm" onclick="showOptionsPopup('{{ $appointment->appointment_id }}')" title="Options">
                                    <i class="fas fa-cog"></i>
                                </button>

                                <div class="modal fade" id="optionsModal" tabindex="-1" role="dialog" aria-labelledby="optionsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="optionsModalLabel">Choisissez une option</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Que souhaitez-vous faire ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('rdv-form-soin').submit();">Salle de soin</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.getElementById('showPopupButton').addEventListener('click', function() {
                                        $('#optionsModal').modal('show');
                                    });
                                </script>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} " /> <br><br> <b
                                    class="text-muted">Vous n'avez pas de rendez-vous</b></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
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

<script src="sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
    <script>
        function showOptionsPopup(appointmentId) {
            // Logic to show options popup for the appointment
            Swal.fire({
                title: 'Options for Appointment',
                text: 'Choose an action for appointment ID: ' + appointmentId,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Anuller',
                cancelButtonText: 'Salle de soin',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Handle the action for cancelling the appointment
                    $.ajax({
                        url: '{{ route("appointment.update") }}', // Update with your route
                        type: 'POST',
                        data: {
                            rdv_id: appointmentId,
                            visited: 1, // Assuming 1 means cancelled
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function(response) {
                            // Handle success response
                            Swal.fire('Cancelled!', 'The appointment has been cancelled.', 'success');
                            // Optionally, refresh the page or update the UI
                        },
                        error: function(xhr) {
                            // Handle error response
                            Swal.fire('Error!', 'There was an error cancelling the appointment.', 'error');
                        }
                    });
                } else {
                    // Logic for Salle de soin can be added here if needed
                    document.getElementById('rdv-form-soin').submit();
                }
            });
        }
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
    //     jQuery(document).ready(function($) {
	// 	$("#mytable").DataTable({
	// 		"pageLength": 50 // Set the default number of rows per page
	// 	});
	// });
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
            if (response.success) {
                Swal.fire("Statut mis à jour avec succès.").then(() => {
                    location.reload(); // Refresh the page
                }); // Notify user of success
                
            } else {
                // Revert checkbox state if the update fails
                checkbox.checked = !isActive;
                label.classList.toggle('active', !isActive);
                alert('Échec de la mise à jour du statut.'); // Notify user of failure
            }
        },
        error: function() {
            // Handle AJAX errors
            checkbox.checked = !isActive;
            label.classList.toggle('active', !isActive);
            alert('Une erreur s\'est produite. Veuillez réessayer.'); // Notify user of error
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




/* Style the toggle switch container */
label {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}

/* Hide the default checkbox input */
label input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* Style the slider */
label .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc; /* Gray for inactive */
    transition: 0.4s;
    border-radius: 34px;
}

/* Style the slider knob (circle) */
label .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

/* Change background color when checked */
label input:checked + .slider {
    background-color: #4e73df; /* Blue for active */
}

/* Move the knob to the right when checked */
label input:checked + .slider:before {
    transform: translateX(24px);
}

/* Optional: Add a shadow for an active slider */
label .slider.round {
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}


</style>
@endsection

@section('footer')
@endsection
