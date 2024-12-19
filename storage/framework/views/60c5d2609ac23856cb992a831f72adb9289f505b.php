<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.New Appointment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-4">
                            <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.New Appointment')); ?></h6>
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

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="patient_name"><?php echo e(__('sentence.Patient')); ?> <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                                        - <a href="<?php echo e(route('patient.create')); ?>" class="text-muted">
                                            <button class="btn btn-warning btn-sm"><?php echo e(__('sentence.New Patient')); ?></button>
                                        </a>
                                    <?php endif; ?>
                                </label>

                                <select
                                    class="form-control rounded-0 shoadow-none shadow-none rounded-0 patient_name multiselect-doctorino"
                                    id="patient_name">
                                    <?php
                                        $lastPatientId = Session::get('lastpatient');
                                    ?>
                                    <option value="0"><?php echo e(__('sentence.Select Patient')); ?></option>
                                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($patient->id); ?>"
                                                <?php if($lastPatientId == $patient->id): ?> selected <?php endif; ?>><?php echo e($patient->name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rdvdate"><?php echo e(__('sentence.Date')); ?></label>
                                <input type="text"
                                       class="form-control rounded-0 shoadow-none shadow-none rounded-0 target"
                                       readonly="readonly" id="rdvdate">
                                <small id="emailHelp" class="form-text text-muted">Sélectionnez la date pour voir les plages
                                    horaires disponibles</small>

                            </div>
                            <div class="form-group">
                                <label for="reason"><?php echo e(__('sentence.Reason for visit')); ?></label>
                                <select class="form-control" id="reason" onchange="updateReason()">
                                    <option value="">Sélectionnez la raison de la visite</option>
                                    <option value="Première visite">Première visite</option>
                                    <option value="Consultation">Consultation</option>
                                    <option value="Contrôle">Contrôle</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Statut">Statut</label>
                                <select class="form-control" id="statut" onchange="updateStatus()">
                                    <option value="0"><?php echo e(__('sentence.Not Yet Visited')); ?></option>
                                    <option value="3">Salle d'attente</option>
                                </select>
                            </div>






                        </div>
                        <div class="col-md-8 col-sm-12">
                            <label for="date"><?php echo e(__('sentence.Available Times')); ?></label>
                            <hr>
                            <div class="row mb-2 myorders"></div>
                            <div class="alert alert-danger text-center" role="alert" id="help-block">
                                <img src="<?php echo e(asset('img/calendar.png')); ?>"><br>
                                <b><?php echo e(__('sentence.No date selected')); ?></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment Modal-->
    <div class="modal fade" id="RDVModalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('sentence.Are you sure of the date')); ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b><?php echo e(__('sentence.Patient')); ?> :</b> <span id="patient_name"></span></p>
                    <p><b><?php echo e(__('sentence.Date')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b><?php echo e(__('sentence.Time Slot')); ?> :</b> <label class="badge badge-primary-soft"
                                                                      id="rdv_time"></span></label></p>
                    <p><b><?php echo e(__('sentence.Reason for visit')); ?> :</b> <label class="badge badge-primary-soft"
                                                                             id="reason_for_visit"></span></label></p>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn rounded-0  btn-secondary" type="button"
                            data-dismiss="modal"><?php echo e(__('sentence.Cancel')); ?></button>
                    <a class="btn rounded-0  btn-primary text-white"
                       onclick="event.preventDefault();
               document.getElementById('rdv-form').submit();"><?php echo e(__('sentence.Save')); ?></a>
                    <form id="rdv-form" action="<?php echo e(route('appointment.store')); ?>" method="POST" class="d-none">
                        <input type="hidden" name="patient" id="patient_input">
                        <input type="hidden" name="rdv_time_date" id="rdv_date_input">
                        <input type="hidden" name="rdv_time_start" id="rdv_time_start_input">
                        <input type="hidden" name="rdv_time_end" id="rdv_time_end_input">
                        <input type="hidden" name="send_sms" id="send_sms">
                        <input type="hidden" name="reason" id="reason_for_visit_value">
                        <input type="text" name="status" id="status_input">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });
    </script>
    <script>
        function updateReason() {
            // Get the selected value from the dropdown
            var selectedReason = document.getElementById('reason').value;

            // Update the hidden input field
            document.getElementById('reason_for_visit_value').value = selectedReason;

            // Update the label text
            document.getElementById('reason_for_visit').innerText = selectedReason;
        }

        function updateStatus() {
            // Get the selected value from the dropdown
            console.log('test');
            var selectedstatus = document.getElementById('statut').value;

            // Update the hidden input field
            document.getElementById('status_input').value = selectedstatus;

            // Update the label text
            // document.getElementById('Statut_for_visit').innerText = selectedstatus;
        }
    </script>
    <style>
        .icon-text {
            display: none;
        }
        .btn:hover .icon-text {
            display: inline;
            animation: fadeIn 0.6s;
        }
        .btn:hover i {
            display: none;
        }
        .btn:hover i {
            display: inline;
            animation: fadeIn 0.6s;
        }
        @keyframes  fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\myclinicApp\resources\views/appointment/create.blade.php ENDPATH**/ ?>