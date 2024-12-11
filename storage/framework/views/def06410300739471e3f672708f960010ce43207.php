<?php $__env->startSection('title'); ?>
    Nouvelle Rapport
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
<form method="post" action="<?php echo e(route('gabarit.store_gabarit')); ?>">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nouveau modèle</h6>
                    <input type="submit" value="Sauvegarde" class="btn btn-success" align="right"
                           style=";position: absolute; right: 30px; top: 8px;">
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <fieldset id="fieldset4">
                            <label for=""><b>Le nom du modèle rapport </b></label>
                            <input type="text" class="form-control" name="name" required>
                            <br>
                            <textarea id="summernote" name="text"></textarea>

                        </fieldset>
                        <?php echo e(csrf_field()); ?>

                    </div>

                    <div class="form-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Variables</h6>
                </div>
                <div class="card-body">
                    <?php $__currentLoopData = $varibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $var): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="badge badge-primary-soft summernote-button" data-value="<?php echo e($var->code); ?>">
                            <?php echo e($var->name); ?>

                        </button>

                        <br><br>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize Summernote
            $('#summernote').summernote({
                tabsize: 2,
                height: 400
            });

            // Button click event handler
            $('.summernote-button').click(function () {
                // Get the existing content in Summernote
                var existingContent = $('#summernote').summernote('code');

                // Get the value from the clicked button
                var buttonValue = $(this).data('value');

                // Trim any leading and trailing whitespaces
                buttonValue = buttonValue.trim();

                // Remove any trailing line breaks at the end of the content
                existingContent = existingContent.replace(/(<br>)|(<div><br><\/div>)|(<p><br><\/p>)$/i, '');

                // Append the button value to the existing content
                var newContent = existingContent + buttonValue;

                // Set the Summernote content to the updated value
                $('#summernote').summernote('code', newContent);
            });
        });
    </script>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/gabarit/gabarit.blade.php ENDPATH**/ ?>