<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>


<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['patient.custom.generalist_create', 'patient.specialty.generalist.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['patient.custom.pediatre_create', 'patient.specialty.pediatre.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['patient.custom.ophtamologie_create', 'patient.specialty.ophtamologie.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['patient.custom.dentiste_create', 'patient.specialty.dentiste.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/patient/all.blade.php ENDPATH**/ ?>