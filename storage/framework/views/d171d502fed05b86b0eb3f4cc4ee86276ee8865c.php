<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-4">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Appointments')); ?></h6>
                </div>
                <div class="col-8">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
                        <a href="<?php echo e(route('appointment.create')); ?>" title="<?php echo e(__('sentence.New Appointment')); ?>"
                           class="btn rounded-0 btn-primary btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-plus"></i> <span
                                class="d-none d-lg-inline-block"><?php echo e(__('sentence.New Appointment')); ?></span>
                        </a>
                        <a href="<?php echo e(route('appointment.pending')); ?>" title="Salle d'attente"
                           class="btn rounded-0 btn-success btn-sm float-right ml-2 mb-1">
                            <i class="fa fa-hourglass"> </i><span class="d-none d-lg-inline-block">Salle d'attente</span></a>

                        <!-- Button for "Tous les rendez-vous" -->
                        <a href="<?php echo e(route('appointment.all')); ?>" title="Tous les rendez-vous"
                           class="btn rounded-0 btn-info btn-sm float-right ml-2  mb-1">
                            <i class="fa fa-calendar"></i> <span class="d-none d-lg-inline-block">Tous les rendez-vous</span>
                        </a>

                        <!-- Button for "Tous les rendez-vous de jour" -->
                        <a href="<?php echo e(route('appointment.day')); ?>" title="Tous les rendez-vous de jour"
                           class="btn rounded-0 btn-warning btn-sm float-right  mb-1">
                            <i class="fa fa-calendar"></i> <span class="d-none d-lg-inline-block">Rendez-vous d'aujourd'hui</span>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center md__screen">Num</th>
                        <th><?php echo e(__('sentence.Patient Name')); ?></th>
                        <th class="text-center sm__screen"><?php echo e(__('sentence.Reason for visit')); ?></th>
                        <th class="text-center"><?php echo e(__('sentence.Schedule Info')); ?></th>
                        <th class="text-center xxs__screen"><?php echo e(__('sentence.Status')); ?></th>
                        <th class="text-center xxs__screen"><?php echo e(__('sentence.Created at')); ?></th>
                        <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center md__screen"><?php echo e($appointment->id); ?></td>
                            <td><a href="<?php echo e(url('patient/view/' . $appointment->user_id)); ?>">
                                    <?php echo e($appointment->User->name); ?> </a></td>
                            <td class="text-center sm__screen"><label
                                    class="badge badge-primary-soft"><?php echo e($appointment->reason); ?></label></td>

                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    <i class="fas fa-calendar"></i> <?php echo e($appointment->date->format('d M Y')); ?>

                                </label>
                                <label class="badge badge-primary-soft">
                                    <i class="fa fa-clock"></i> <?php echo e($appointment->time_start); ?> -
                                    <?php echo e($appointment->time_end); ?>

                                </label>
                            </td>
                            <td class="text-center xxs__screen">
                                <?php if($appointment->visited == 0): ?>
                                    <label class="badge badge-warning-soft">
                                        <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Not Yet Visited')); ?>

                                    </label>
                                <?php elseif($appointment->visited == 1): ?>
                                    <label class="badge badge-primary-soft">
                                        <i class="fas fa-check"></i> Terminé
                                    </label>
                                <?php elseif($appointment->visited == 3): ?>
                                    <label class="badge badge-success-soft">
                                        <i class="fas fa-check"></i>Salle d'attente
                                    </label>
                                <?php elseif($appointment->visited == 4): ?>
                                    <label class="badge badge-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                                            <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                        </svg>Salle soin
                                    </label>
                                <?php else: ?>
                                    <label class="badge badge-danger-soft">
                                        <i class="fas fa-user-times"></i> <?php echo e(__('sentence.Cancelled')); ?>

                                    </label>
                                <?php endif; ?>
                            </td>
                            <td class="text-center xxs__screen"><?php echo e($appointment->created_at->format('d M Y H:i')); ?>

                            </td>
                            <td align="center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
                                    <a id="editAppointmentButton" data-rdv_id="<?php echo e($appointment->id); ?>"
                                       data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>"
                                       data-rdv_time_start="<?php echo e($appointment->time_start); ?>"
                                       data-rdv_time_end="<?php echo e($appointment->time_end); ?>"
                                       data-patient_name="<?php echo e($appointment->User->name); ?>"
                                       class="btn   btn-outline-success btn-circle btn-sm" data-toggle="modal"
                                       data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointment')): ?>
                                    <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                       data-target="#DeleteModal"
                                       data-link="<?php echo e(url('appointment/delete/' . $appointment->id)); ?>"><i
                                            class="fas fa-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" align="center"><br><br> <b class="text-muted">Vous n'avez pas de
                                    rendez-vous</b></td>
                        </tr>
                    <?php endif; ?>
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
                        <?php echo e(__('sentence.You are about to modify an appointment')); ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b><?php echo e(__('sentence.Patient')); ?> :</b> <span id="patient_name"></span></p>
                    <p><b><?php echo e(__('sentence.Date')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b><?php echo e(__('sentence.Time Slot')); ?> :</b> <label class="badge badge-primary-soft"
                                                                      id="rdv_time"></label></p>
                </div>
                <div class="modal-footer">
                    <a class="btn rounded-0  btn-primary text-white"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();"><?php echo e(__('sentence.Confirm Appointment')); ?></a>
                    <form id="rdv-form-confirm" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                          class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="btn rounded-0  btn-danger text-white"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();"><?php echo e(__('sentence.Cancel Appointment')); ?></a>
                    <form id="rdv-form-cancel" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                          class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="btn rounded-0  btn-primary  text-white" id="salle"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-salle').submit();">+Salle
                        d'attente</a>
                    <form id="rdv-form-salle" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                          class="d-none">
                        <input type="time" id="time" name="hours" class="form-control"
                               value="<?php echo e(now()->format('H:i')); ?>">
                        <input type="hidden" name="rdv_id" id="rdv_id3">
                        <input type="hidden" name="rdv_status" value="3">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="btn rounded-0  btn-primary  text-white" id="salle"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-soin').submit();">Salle de soin</a>
                    <form id="rdv-form-soin" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                          class="d-none">
                        <input type="time" id="time" name="hours" class="form-control"
                               value="<?php echo e(now()->format('H:i')); ?>">
                        <input type="hidden" name="rdv_id" id="rdv_id4">
                        <input type="hidden" name="rdv_status" value="4">
                        <?php echo csrf_field(); ?>
                    </form>
                    <button class="btn rounded-0  btn-secondary" type="button"
                            data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
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

    
    
    
    
    

    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/appointment/all.blade.php ENDPATH**/ ?>