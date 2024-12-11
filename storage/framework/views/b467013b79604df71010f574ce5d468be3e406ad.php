

<?php $__env->startSection('title'); ?>
    Tous les Déposes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les Déposes</h6>
                </div>

                <div class="col-6">

                </div>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nom déposes </th>
                            <th class="text-center">
                                Type déposes
                            </th>
                            <th class="text-center">
                                monton
                            </th>
                            <th class="text-center">
                                Tries
                            </th>


                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $depenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center"><?php echo e($depense->label); ?></td>
                                <td class="text-center"><?php echo e($depense->type_depenses); ?></td>
                                <td class="text-center"><?php echo e($depense->monton); ?></td>
                                <td class="text-center"><?php echo e($depense->created_by); ?></td>

                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
                                        <a href="<?php echo e(route('depense.edit', ['id' => $depense->id])); ?>"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete drug')): ?>
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="<?php echo e(route('depense.destroy', ['id' => $depense->id])); ?>"><i
                                                class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center"><br><br> Aucun article trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- Button trigger modal -->


                <div class="d-flex">
                    <?php echo $depenses->links(); ?>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/depense/all.blade.php ENDPATH**/ ?>