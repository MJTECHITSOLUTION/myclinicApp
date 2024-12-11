
<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Prescriptions')); ?></h6>
                </div>
                <div class="col-3">
                    <div class="form-group">

                        <select class="form-control" name="user_id" id="PatientID">
                            <option value=""><?php echo e(__('sentence.Select Patient')); ?></option>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($patient->id); ?>">
                                    <?php echo e($patient->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php echo e(csrf_field()); ?>

                    </div>
                </div>
                <div class="col-6">
                    <form action="<?php echo e(route('prescription.search')); ?>" method="GET" class="form-inline float-right">
                        <div class="form-group mx-2">&nbsp; Du:
                            <label for="start_date" class="sr-only"><?php echo e(__('Start Date')); ?></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo e(date('Y-m-d')); ?>" placeholder="<?php echo e(__('Start Date')); ?>">
                        </div>
                        <div class="form-group mx-2">&nbsp; Ou:
                            <label for="end_date" class="sr-only"><?php echo e(__('End Date')); ?></label>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="<?php echo e(__('End Date')); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Search')); ?></button>
                    </form>
                </div>
                
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Réf consultation</th>
                        
                        <th><?php echo e(__('sentence.Patient')); ?></th>
                        <th class="text-center sm__screen">Date consultation</th>
                        <th class="text-center ">Prescription</th>
                        
                        
                        <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($referance[$prescription->id]): ?>
                                    <a href="<?php echo e(route('billing.search', ['reference' => $prescription->reference])); ?>">
                                        <?php echo e($prescription->reference); ?>

                                    </a>
                                <?php else: ?>
                                    <?php echo e($prescription->reference); ?>

                                <?php endif; ?>
                            </td>
                            
                            
                            
                            <td>
                                <a href="<?php echo e(url('patient/view/' . $prescription->user_id)); ?>">
                                    <?php echo e($prescription->User->name); ?> </a>
                            </td>
                            <td class="text-center sm__screen"><?php echo e($prescription->created_at->format('d-m-Y')); ?></td>
                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    <?php echo e(count($prescription->Drug)); ?> Médicaments
                                </label>
                                <label class="badge badge-primary-soft">
                                    <?php echo e(count($prescription->Test)); ?> Analyse
                                </label>
                            </td>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <td class="text-center">
                                <a href="<?php echo e(url('prescription/view/' . $prescription->id . '?user_id=' . $prescription->user_id)); ?>"
                                   class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo e(url('prescription/edit/' . $prescription->id . '?user_id=' . $prescription->user_id)); ?>"
                                   class="btn   btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                   data-target="#DeleteModal"
                                   data-link="<?php echo e(url('prescription/delete/' . $prescription->id)); ?>"><i
                                        class="fas fa-trash"></i></a>
                                <?php if($billingExists[$prescription->id]): ?>
                                    <!-- Display link for editing billing when billing exists -->
                                    <a href="<?php echo e(url('billing/view', ['billing_id' => $billingIds[$prescription->id]])); ?>"
                                       class="btn   btn-outline-info btn-circle btn-sm">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>
                                <?php else: ?>
                                    <!-- Display link for creating billing when billing doesn't exist -->
                                    <a href="<?php echo e(url('billing/create') . '?p=' . $prescription->id . '&u=' . $prescription->user_id); ?>"
                                       class="btn   btn-outline-secondary active btn-circle btn-sm">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>
                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <span class="float-right mt-3"><?php echo e($prescriptions->links()); ?></span>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/prescription/specialty/generalist/all.blade.php ENDPATH**/ ?>