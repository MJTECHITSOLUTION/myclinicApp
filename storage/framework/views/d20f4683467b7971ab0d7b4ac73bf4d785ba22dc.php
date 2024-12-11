<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Billing List')); ?>

<?php $__env->stopSection(); ?>

<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['billing.custom.generalist_edit', 'billing.specialty.generalist.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_edit', 'billing.specialty.pediatre.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_create', 'billing.specialty.ophtamologie.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['billing.custom.dentiste_create', 'billing.specialty.dentiste.all'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/billing/all.blade.php ENDPATH**/ ?>