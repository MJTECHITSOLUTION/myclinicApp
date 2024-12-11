<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport patient</h6>
                </div>
                <div class="col-6 text-right">
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="<?php echo e(route('record.search')); ?>" method="post">
                        <div class="input-group w-100 ">
                            <!-- Start Date Input -->
                            <label><b>Date début : </b></label>
                            <input type="date" name="start_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date début" value="<?php echo e($startDate); ?>" aria-label="Date début"
                                   aria-describedby="basic-addon2" required>

                            <!-- End Date Input -->
                            <label style="margin-left: 40px;"><b>Date fin :</b></label>
                            <input type="date" name="end_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date fin" value="<?php echo e($endDate); ?>" aria-label="Date fin"
                                   aria-describedby="basic-addon2" style="margin-left: 10px;" required>

                            <?php echo csrf_field(); ?>
                            <div class="input-group-append" style="margin-left: 10px;">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="text-right">
                        <button href="" class="d-sm-inline-block btn btn-sm btn-info shadow-sm print_patient">
                            <i class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-md-inline-block">Imprimer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-right">

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                       id="dataTable" width="100%" cellspacing="0">
                    <thead class="">
                    <tr>
                        <th class="text-center">Nom et prénom</th>
                        <th class="text-center sm__screen"><?php echo e(__('sentence.Age')); ?></th>
                        <th class="text-center xxs__screen"><?php echo e(__('sentence.Phone')); ?></th>
                        <th class="text-center sm__screen"><?php echo e(__('sentence.Blood Group')); ?></th>
                        <th class="text-center md__screen"><?php echo e(__('sentence.Date')); ?></th>
                        <th class="text-center sm__screen">Genre</th>
                        <th class="text-center">Assurance</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(url('patient/view/' . $patient->id)); ?>"> <?php echo e($patient->user_name); ?> </a></td>
                            <td class="text-center sm__screen">
                                <?php echo e(@\Carbon\Carbon::parse($patient->birthday)->age); ?> </td>
                            <td class="text-center xxs__screen"> <?php echo e(@$patient->phone); ?> </td>
                            <td class="text-center sm__screen"> <?php echo e(@$patient->blood); ?> </td>
                            <td class="text-center  md__screen"><label
                                    class="badge badge-primary-soft "><?php echo e($patient->created_at->format('d M Y H:i')); ?></label>
                            </td>


                            <td class="text-center sm__screen ">
                                <?php if($patient->gender === 'Female'): ?>
                                    Femme
                                <?php elseif($patient->gender === 'Male'): ?>
                                    Homme
                                <?php else: ?>
                                    <?php echo e($patient->gender); ?>

                                <?php endif; ?>
                            </td>
                            <td class="text-center sm__screen">
                                <?php if(!empty($patient->assurance_id)): ?>
                                        <?php $assurance = DB::table('assurance')->where('id', $patient->assurance_id)->value('assurance_name'); ?>
                                    <?php echo e($assurance ?? ''); ?>

                                <?php else: ?>
                                    <?php echo e($patient->assurance); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" align="center"><img src="<?php echo e(asset('img/rest.png')); ?> "/> <br><br> <b
                                    class="text-muted">Aucun patient trouvé !</b>
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
                <div style="display: none" id="print_patient_div">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p><strong>Nom:</strong> <?php echo e(App\Setting::get_option('title')); ?></p>
                                        <p><strong>Adresse:</strong> <?php echo e(App\Setting::get_option('address')); ?></p>
                                        <p><strong>Téléphone:</strong><?php echo e(App\Setting::get_option('phone')); ?> </p>
                                        <p><strong>Ville:</strong> <?php echo e(App\Setting::get_option('ville')); ?></p>
                                    </div>
                                    <div class="col-md-7 text-right">

                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <h3>
                            <div class="text-center">
                            <b>Nouveaux patients <br> du <?php echo e(\Carbon\Carbon::parse($startDate)->format('d-m-Y')); ?> ou <?php echo e(\Carbon\Carbon::parse($endDate)->format('d-m-Y')); ?> </b>
                            </div><br></h3>
                            <table
                                class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                                id="dataTable" width="100%" cellspacing="0">
                                <thead class="">
                                <tr>

                                    <th class="text-center"> <b>Nome et prénom</b></th>
                                    <th class="text-center xxs__screen"><b><?php echo e(__('sentence.Phone')); ?></b></th>
                                    <th class="text-center md__screen"><b><?php echo e(__('sentence.Date')); ?></b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="text-center">
                                             <?php echo e($patient->user_name); ?>

                                        </td>
                                        <td class="text-center xxs__screen"> <?php echo e(@$patient->phone); ?> </td>
                                        <td class="text-center  md__screen"><label
                                                ><?php echo e($patient->created_at->format('d-m-Y')); ?></label>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript">
        function PrintPreview(divName) {

            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }


        $(function(){
            $(document).on("click", '.print_patient',function () {
                PrintPreview('print_patient_div');
                /*
                $('#print_area').printThis({
                 importCSS: true,
                        importStyle: true,//thrown in for extra measure
                 loadCSS: "<?php echo e(asset('dashboard/css/sb-admin-2.min.css')); ?>",
         pageTitle: "xxx",
         copyTagClasses: true,
          base: true,
          printContainer: true,
          removeInline: false,
        });
        */

            });
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/record/search.blade.php ENDPATH**/ ?>