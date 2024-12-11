<?php $__env->startSection('title'); ?>
    Note d'honoraire
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Note d'honoraire</h6>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        








                        <?php echo e(csrf_field()); ?>

                    </div>
                </div>
                <div class="col-4">
                    <a href="<?php echo e(route('notehonoraire.create')); ?>" class="btn rounded-0  btn-primary btn-sm float-right"><i
                            class="fa fa-plus"></i> Nouvelle Note d'honoraire</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        
                        <th><?php echo e(__('sentence.Patient')); ?></th>
                        <th class="text-center">Date</th>
                        <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $__empty_1 = true; $__currentLoopData = $notehonoraire; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <td><a> <?php echo e($note->name); ?> </a></td>
                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    <?php echo e(\Carbon\Carbon::parse($note->created_at)->locale('fr')->isoFormat('LLLL')); ?>

                                    <input type="hidden" name="label" id="label"
                                           value="<?php echo e($note->date); ?>">
                                </label>
                                <label class="badge badge-primary-soft">
                                </label>
                            </td>

                            <td class="text-center">
                                <a href="<?php echo e(url('notehonoraire/view/' . $note->id )); ?>"
                                   class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>


                                <form action="<?php echo e(route('note.destroy', $note->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center"><img src="<?php echo e(asset('img/not-found.svg')); ?>"
                                                                     width="200" /> <br><br> <b class="text-muted">Aucun Rapport trouvé</b></td>
                        </tr>
                    </tbody>
                    <?php endif; ?>

                </table>


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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/notehonoraire/all.blade.php ENDPATH**/ ?>