<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Prescriptions')); ?>

<?php $__env->stopSection(); ?>


<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['prescription.custom.generalist_all', 'prescription.specialty.generalist.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['prescription.custom.pediatre_all', 'prescription.specialty.pediatre.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['prescription.custom.ophtamologie_all', 'prescription.specialty.ophtamologie.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['prescription.custom.dentiste_all', 'prescription.specialty.dentiste.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/prescription/all.blade.php ENDPATH**/ ?>