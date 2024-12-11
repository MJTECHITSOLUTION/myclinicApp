<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Create Invoice')); ?>

<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['billing.custom.generalist_edit', 'billing.specialty.generalist.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_edit', 'billing.specialty.pediatre.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_create', 'billing.specialty.ophtamologie.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['billing.custom.dentiste_create', 'billing.specialty.dentiste.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/billing/create.blade.php ENDPATH**/ ?>