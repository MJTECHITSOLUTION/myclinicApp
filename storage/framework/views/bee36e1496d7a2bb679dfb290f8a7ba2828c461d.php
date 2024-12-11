<?php $__env->startSection('title'); ?>
    Template rapport
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Modèle rapport</h6>
                </div>
                <div class="col-4">
                    <a href="<?php echo e(route('gabarit.gabarit')); ?>" class="btn btn-primary rounded-0 btn-sm float-right"><i
                            class="fa fa-plus"></i> Ajouter Modèle rapport</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mx-auto" style="width: 80%;">
                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">Modèle rapport</th>
                        <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $gabarits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gabarit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center">
                                <label class="badge badge-primary-soft">
                                    <?php echo e($gabarit->name); ?>

                                </label>
                            </td>

                            <td class="text-center">
                                <a href="<?php echo e(url('gabarit/gabarit_view/' . $gabarit->name)); ?>" class="btn btn-outline-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="<?php echo e(url('gabarit/gabarit_edit/' . $gabarit->id)); ?>" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('gabarit/gabarit_delete/' . $gabarit->id)); ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="2" class="text-center">
                                <img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" />
                                <br><br>
                                <b class="text-muted">Aucun Rapport trouvé</b>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/gabarit/gabarit_all.blade.php ENDPATH**/ ?>