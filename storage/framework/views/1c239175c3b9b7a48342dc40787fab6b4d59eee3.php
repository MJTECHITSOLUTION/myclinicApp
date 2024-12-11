
 <?php $__env->startSection('content'); ?>
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit Drug')); ?> "<?php echo e($drug->trade_name); ?>"
                     </h6>
                 </div>
                 <div class="card-body">
                     <form method="post" action="<?php echo e(route('drug.store_edit')); ?>">
                         <?php echo csrf_field(); ?>
                         <div class="form-group">
                             <label for="trade_name">Catégorie *</label>
                             <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-drugs_cat" name="drugs_cat" id="drugs_cat" required>
                                 <?php if($cat): ?>
                                     <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->categorie); ?></option>
                                 <?php else: ?>
                                     <option value="">Aucune catégorie</option>
                                 <?php endif; ?>
                                 <?php $__currentLoopData = $drugs_cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->categorie); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                             <label for="trade_name">Nom *</label>
                             <input type="hidden" name="drug_id" value="<?php echo e($drug->id); ?>">
                             <input type="text" class="form-control rounded-0 shadow-none" name="trade_name"
                                 id="trade_name" aria-describedby="TradeName" value="<?php echo e($drug->trade_name); ?>">
                             <?php echo e(csrf_field()); ?>

                         </div>
                         
                         
                         
                         
                         
                         <div class="form-group">
                             <label for="exampleInputPassword1">Note</label>
                             <input type="text" class="form-control rounded-0 shadow-none" name="note" id="Note" value="<?php echo e($drug->note); ?>">
                         </div>
                         <button type="submit" class="btn rounded-0  btn-primary "><?php echo e(__('sentence.Save')); ?></button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 <?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/drug/specialty/dentiste/edit.blade.php ENDPATH**/ ?>