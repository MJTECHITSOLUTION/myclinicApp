

<?php $__env->startSection('title'); ?>
    Gérer les Notifications
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gérer les Notifications</h1>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <form action="<?php echo e(route('notifies.storeOrUpdate')); ?>" method="POST" class="mb-4">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" id="notify-id" value="">

            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" name="name" id="notify-name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="actif">Actif :</label>
                <select name="actif" id="notify-actif" class="form-control" required>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </form>

        <hr>

        
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $notifies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($notify->id); ?></td>
                        <td><?php echo e($notify->name); ?></td>
                        <td><?php echo e($notify->actif ? 'Actif' : 'Inactif'); ?></td>
                        <td>
                            
                            <button class="btn btn-warning btn-sm" onclick="editNotify(<?php echo e($notify->id); ?>, '<?php echo e($notify->name); ?>', <?php echo e($notify->actif); ?>)">
                                Éditer
                            </button>

                            
                            <form action="<?php echo e(route('notifies.destroy', $notify->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <script>
        // Remplir le formulaire avec les données de notification pour l'édition
        function editNotify(id, name, actif) {
            document.getElementById('notify-id').value = id;
            document.getElementById('notify-name').value = name;
            document.getElementById('notify-actif').value = actif;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\myclinicApp\resources\views/notify/index.blade.php ENDPATH**/ ?>