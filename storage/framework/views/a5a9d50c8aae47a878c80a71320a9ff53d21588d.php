

<?php $__env->startSection('content'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-2">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Drugs')); ?></h6>
                </div>

                <div class="col-6">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                        <a href="<?php echo e(route('drug.create')); ?>" class="btn rounded-0  btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> <?php echo e(__('sentence.Add Drug')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form class=" d-block form-inline mr-auto navbar-search" action="<?php echo e(route('drug.search')); ?>"
                        method="post">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control  rounded-0 bg-light border-0 small"
                                placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                            <?php echo csrf_field(); ?>
                            <div class="input-group-append">
                                <button class="btn rounded-0  btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('sentence.Trade Name')); ?></th>
                            
                            
                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($drug->id); ?></td>
                                <td><?php echo e($drug->trade_name); ?></td>
                                
                                
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
                                        <a href="<?php echo e(url('drug/edit/' . $drug->id)); ?>"
                                            class="btn rounded-0  btn-outline-warning btn-circle btn-sm"><i
                                                class="fa fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete drug')): ?>
                                        <a class="btn rounded-0  btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="<?php echo e(url('drug/delete/' . $drug->id)); ?>"><i
                                                class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="d-flex">
                    <?php echo $drugs->links(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/drug/specialty/dentiste/all.blade.php ENDPATH**/ ?>