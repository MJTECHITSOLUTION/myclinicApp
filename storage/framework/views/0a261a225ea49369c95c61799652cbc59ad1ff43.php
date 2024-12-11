<?php $__env->startSection('title'); ?>
    Gabarit
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('content'); ?>
        <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rapport</title>
    </head>

    <body>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control multiselect-doctorino" name="user_id" id="PatientID" disabled>
                                <?php $__currentLoopData = $gabarits_patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="">
                                        <?php echo e($patient->user_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <?php echo e(csrf_field()); ?>

                        </div>

                        <br>
                        <label for="type">Type rapport </label>
                        <select class="form-control" id="type" name="template_name" disabled>
                            <?php $__currentLoopData = $gabarits_patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gabarit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($gabarit->text); ?>" data-created-date="<?php echo e($gabarit->created_at->format('d-m-Y')); ?>">
                                    <?php echo e($gabarit->template_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>



                        <div class="form-group">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Rapports</h6>
                        <button id="printButton" class="btn btn-success" style="position: absolute; right: 30px; top: 8px;"  align="right">Imprimer</button>

                    </div>
                    <div class="card-body">
                        <textarea id="summernote" name="text"></textarea>
                    </div>

                </div>
            </div>
        </div>




    </body>

    </html>
<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote with readOnly option
            $('#summernote').summernote({
                height: 500,
                toolbar: false,
                disableDragAndDrop: true,
                dialogsInBody: true,
            });

            // Handle dropdown change event
            $('#type').change(function() {
                // Get the selected option's value
                var selectedText = $(this).val();

                // Get the selected option's created_at value
                var createdDate = $(this).find(':selected').data('created-date');

                // Set the Summernote editor content with the selected text
                $('#summernote').summernote('code', selectedText);

                // Save the selected text and created date to local storage
                localStorage.setItem('selectedText', selectedText);
                localStorage.setItem('createdDate', createdDate);
            });

            // Trigger change event to set default content on page load
            $('#type').trigger('change');

            // Check if there is a selected text in local storage
            var storedSelectedText = localStorage.getItem('selectedText');
            var storedCreatedDate = localStorage.getItem('createdDate');
            if (storedSelectedText !== null && storedCreatedDate !== null) {
                // Set the Summernote editor content with the stored selected text
                $('#summernote').summernote('code', storedSelectedText);
            }

            // Handle printing when the button is clicked
            $('#printButton').click(function() {
                // Get the HTML content of the Summernote editor
                var summernoteContent = $('#summernote').summernote('code');

                // Get the stored created date
                var storedCreatedDate = localStorage.getItem('createdDate');

                // Open a new window and print the content
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<?php if( (App\Setting::get_option('use_entete') === 'yes')): ?> '+'<?php if(!empty(App\Setting::get_option("imagerapport"))): ?>'+
                    '<img src="<?php echo e(asset("uploads/" . App\Setting::get_option("imagerapport"))); ?>" class="img-fluid" alt="Logo" style="max-width: 100%"><br><br>'+
                    '<?php endif; ?>'+'<?php else: ?><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><?php endif; ?>'+
                    '<div class="col" style="font-size: large; margin-left: 25px; margin-right: 25px;">' +
                    '<p style="float: right;"><?php echo e(App\Setting::get_option("ville")); ?> ,<?php echo e(__("sentence.On")); ?> : ' + storedCreatedDate + '</p>' +
                    '</div><br><br><br>' +
                    summernoteContent +
                    '');
                printWindow.document.write('<?php if( (App\Setting::get_option('use_pied') === 'yes')): ?>'+'<img src="<?php echo e(asset("uploads/" . App\Setting::get_option("piedrapport"))); ?>" style="position: fixed; bottom: 0; left: 0; right: 0; margin: auto;max-width: 100%;" />'+'<?php endif; ?>');
                printWindow.document.close();
                printWindow.print();

            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/gabarit/view.blade.php ENDPATH**/ ?>