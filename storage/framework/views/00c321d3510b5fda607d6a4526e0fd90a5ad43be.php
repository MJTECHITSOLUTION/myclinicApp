

<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Archive du <?php echo e(\Carbon\Carbon::parse($date)->locale('fr')->translatedFormat('d F Y')); ?> </h6>
                    
                </div>
                <div class="col-8">
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
                        <a href="<?php echo e(route('appointment.create')); ?>" title="<?php echo e(__('sentence.New Appointment')); ?>"
                           class="btn rounded-0 btn-primary btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-plus"></i> <span class="icon-text"><?php echo e(__('sentence.New Appointment')); ?></span>
                        </a>
                        <a href="<?php echo e(route('appointment.pending')); ?>" title="Salle d'attente"
                           class="btn rounded-0 btn-success btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-hourglass"></i> <span class="icon-text">Salle d'attente</span>
                        </a>

                        <!-- Button for "Tous les rendez-vous de jour" -->
                        <a href="<?php echo e(route('appointment.day')); ?>" title="Tous les rendez-vous de jour"
                           class="btn rounded-0 btn-warning btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-calendar"></i> <span class="icon-text">Rendez-vous d'aujourd'hui</span>
                        </a>

                        
                    <?php endif; ?>
                    <form action="<?php echo e(route('appointment.searchByDate')); ?>" method="GET" class="float-right ml-2 mb-1 d-flex align-items-center">
                        <input type="date" name="date" class="form-control form-control-sm d-inline-block" value="<?php echo e($date); ?>" required>
                        <button type="submit" class="btn btn-info btn-sm ml-2" title="Rechercher par date">
                            <i class="fa fa-search"></i>
                        </button>
                        <span class="icon-text ml-2">Rechercher</span>
                    </form>
                   

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="mytable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        
                        <th><?php echo e(__('sentence.Patient Name')); ?></th>
                        
                        
                        
                        <th class="text-center">Numéro</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(url('patient/view/' . $appointment->user_id)); ?>">
                                    <?php echo e($appointment->User->name); ?> </a></td>

                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    <i class="fas fa-calendar"></i> <?php echo e($appointment->num); ?> 
                                </label>
                                
                                    <span title="Imprimer" style="margin-left: 10px; cursor: not-allowed;">
                                        <i class="fas fa-print text-secondary rounded-circle"></i>
                                    </span>
                            </td>
                            
                            
                                
                                
                                
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" align="center"><img src="<?php echo e(asset('img/rest.png')); ?> " /> <br><br> <b
                                    class="text-muted">Vous n'avez pas de rendez-vous</b></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--EDIT Appointment Modal-->
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>

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
                        url: '<?php echo e(route("appointment.updateWaiting")); ?>', // Update with your route
                        type: 'POST',
                        data: {
                            rdv_id: appointmentId,
                            visited: 1, // Assuming 1 means cancelled
                            _token: '<?php echo e(csrf_token()); ?>' // CSRF token for security
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

    $(document).ready(function () {
        // Attach a click event listener to all elements with the class editAppointmentButton
        $(document).on('click', '.editAppointmentButton', function () {
            // Get the waiting_list_id value from the button's data attribute
            const waitingListId = $(this).data('waiting_list_id');
            
            // Set the value to all input fields with the name 'wating_list_id'
            $('input[name="wating_list_id"]').val(waitingListId);
        });
    });
    </script>


    <style type="text/css">
        td>a {
            font-weight: 600;
            font-size: 15px;
        }
    </style>

    
    
    
    
    

    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    <script>


       
       function printValue(num) {
    const doctor = "<?php echo e(App\Setting::get_option('title')); ?>";
    const address = "<?php echo e(App\Setting::get_option('address')); ?>";
    const city = "<?php echo e(App\Setting::get_option('ville')); ?>";
    const phone = "<?php echo e(App\Setting::get_option('phone')); ?>";
    const logo = "<?php echo e(App\Setting::get_option('logo')); ?>";

    const printWindow = window.open('', '_blank', 'width=600,height=400');
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<style>img { max-width: 100%; height: auto; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<div style="text-align:center; max-width: 50%; margin: 0 auto;"><img src="<?php echo e(asset("img/logo-grey.png")); ?>" alt="Logo" style="width: 100%;" /></div>');
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
            _token: '<?php echo e(csrf_token()); ?>',
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
    @keyframes  fadeIn {
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\myclinicApp\resources\views/appointment/archive.blade.php ENDPATH**/ ?>