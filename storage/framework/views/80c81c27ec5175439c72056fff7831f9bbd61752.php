<?php $__env->startSection('title'); ?>
    Nouvelle Rapport
<?php $__env->stopSection(); ?>


<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['rapport.custom.generalist_create', 'rapport.specialty.generalist.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['rapport.custom.pediatre_create', 'rapport.specialty.pediatre.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['rapport.custom.ophtamologie_create', 'rapport.specialty.ophtamologie.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['rapport.custom.dentiste_create', 'rapport.specialty.dentiste.create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/rapport/create.blade.php ENDPATH**/ ?>