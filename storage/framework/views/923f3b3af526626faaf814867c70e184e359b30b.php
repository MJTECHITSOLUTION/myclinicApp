<?php $__env->startSection('title'); ?>
    Reglement
<?php $__env->stopSection(); ?>




<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['billing.custom.generalist_reglement', 'billing.specialty.generalist.reglement'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_reglement', 'billing.specialty.pediatre.reglement'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['billing.custom.pediatre_reglement', 'billing.specialty.ophtamologie.reglement'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['billing.custom.dentiste_reglement', 'billing.specialty.dentiste.reglement'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/billing/reglement.blade.php ENDPATH**/ ?>