

<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['auth.custom.generalist_login', 'auth.specialty.generalist.login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['auth.custom.pediatre_login', 'auth.specialty.pediatre.login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['auth.custom.pediatre_login', 'auth.specialty.ophtamologie.login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['auth.custom.dentiste_login', 'auth.specialty.dentiste.login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/auth/login.blade.php ENDPATH**/ ?>