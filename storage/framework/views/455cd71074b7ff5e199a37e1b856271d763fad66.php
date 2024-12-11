<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['layouts.custom.generalist_edit', 'layouts.specialty.generalist.master'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['layouts.custom.pediatre_edit', 'layouts.specialty.pediatre.master'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['layouts.custom.ophtamologie_edit', 'layouts.specialty.ophtamologie.master'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['layouts.custom.dentiste_edit', 'layouts.specialty.dentiste.master'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/layouts/master.blade.php ENDPATH**/ ?>