<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Drugs')); ?>

<?php $__env->stopSection(); ?>

<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['drug.custom.generalist_create', 'drug.specialty.generalist.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['drug.custom.pediatre_create', 'drug.specialty.pediatre.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['drug.custom.ophtamologie_create', 'drug.specialty.ophtamologie.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['drug.custom.dentiste_create', 'drug.specialty.dentiste.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/drug/all.blade.php ENDPATH**/ ?>