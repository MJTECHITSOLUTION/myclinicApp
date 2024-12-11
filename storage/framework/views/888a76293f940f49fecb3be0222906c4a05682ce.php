<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Billing List')); ?>

<?php $__env->stopSection(); ?>


<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['billing.custom.generalist_search', 'billing.specialty.generalist.search'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_search', 'billing.specialty.pediatre.search'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_search', 'billing.specialty.ophtamologie.search'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['billing.custom.dentiste_search', 'billing.specialty.dentiste.search'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/billing/search.blade.php ENDPATH**/ ?>