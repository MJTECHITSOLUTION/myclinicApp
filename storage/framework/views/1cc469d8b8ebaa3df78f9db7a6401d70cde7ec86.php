<?php $__env->startSection('title'); ?>
    Note d'honoraire
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('content'); ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Note d'honoraire</title>
    </head>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <body>
    
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mb-4" style="position: fixed;">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-10">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                        <select
                            class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-doctorino"
                            name="patient_id" id="PatientID" required disabled
                            oninvalid="this.setCustomValidity('Selectionner le patient SVP!')">
                            <option value=""><?php echo e($patient->name); ?></option>
                            <?php
                                $lastPatientId = Session::get('lastpatient'); // Retrieve the value of 'lastpatient' from the session
                            ?>

                                <option value="<?php echo e($patient->id); ?>"
                                        data-birthday="<?php echo e($patient->Patient->birthday ?? ''); ?>"
                                        data-gender="<?php echo e($patient->Patient->gender ?? ''); ?>"
                                        data-phone="<?php echo e($patient->Patient->phone ?? ''); ?>"
                                        data-address="<?php echo e($patient->Patient->address ?? ''); ?>"
                                        data-weight="<?php echo e($patient->Patient->weight ?? ''); ?>"
                                        data-height="<?php echo e($patient->Patient->height ?? ''); ?>"
                                        data-blood="<?php echo e($patient->Patient->blood ?? ''); ?>"
                                        data-cin="<?php echo e($patient->Patient->cin ?? ''); ?>"
                                        data-assurance="<?php echo e($patient->Patient->assurance ?? ''); ?>"
                                        <?php if($lastPatientId == $patient->id): ?> selected <?php endif; ?>>
                                    <!-- Check if current patient ID matches the lastpatient ID -->
                                    <?php echo e($patient->name); ?>

                                </option>
                        </select>
                        <?php echo e(csrf_field()); ?>

                    </div>
                    <div id="selected-patient-info">
                    </div>

                    <a href="<?php echo e(route('generate.pdf', ['patientId' => $patient->id, 'noteId' => $note->id])); ?>" class="btn btn-primary" target="_blank">Cnops Recto PDF</a>
                    <a href="<?php echo e(route('generat_everso.pdf', ['id' => $note->id])); ?>" class="btn btn-primary" target="_blank">Cnops Verso PDF</a>
                    <br><br>


                    <a href="<?php echo e(route('cnss.pdf', ['patientId' => $patient->id, 'noteId' => $note->id])); ?>" class="btn btn-primary" target="_blank">Cnss Recto PDF</a>
                    <a href="<?php echo e(route('cnss_verso.pdf', ['id' => $note->id])); ?>" class="btn btn-primary" target="_blank">Cnss Verso PDF</a>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Note d'honoraire</h6>
                    <button href="" class=" d-sm-inline-block btn btn-sm btn-info shadow-sm print_note"  align="right" style="position: absolute; right: 30px; top: 8px;" ><i
                            class="fas fa-print fa-sm text-white-50" ></i>
                        <span class="d-none d-md-inline-block">Imprimer</span>
                    </button>


                </div>
                <div class="card-body">
                    <table id="rapportTable" class="table">
                        <thead>
                        <tr>
                            <th>Nom Act</th>
                            <th>Code</th>
                            <th>Lettre Clé</th>
                            <th>Date</th>
                            <th>Dents</th>
                            <th>Montant</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $noteHonoraire; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($note->act_name); ?></td>
                                <td><?php echo e($note->code); ?></td>
                                <td><?php echo e($note->lettrecle); ?></td>
                                <td><?php echo e($note->date); ?></td>
                                <td><?php echo e($note->dent); ?></td>
                                <td><?php echo e($note->montant); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    <div id="print_note" style="display: none;">
        <div class="container">
            <br><br>
            <div class="row">
                <div class="col-6">
                    <p><?php echo e(App\Setting::get_option('title')); ?></p>
                    <p><?php echo e(App\Setting::get_option('address')); ?></p>
                    <p><?php echo e(App\Setting::get_option('ville')); ?></p>
                    <p>Tél : <?php echo e(App\Setting::get_option('phone')); ?></p>
                    <p>ICE: <?php echo e(App\Setting::get_option('ice')); ?></p>
                    <p>INP: <?php echo e(App\Setting::get_option('inp')); ?></p>
                    <p>IF: <?php echo e(App\Setting::get_option('if')); ?></p>
                </div>
                <div class="col-6 text-right">
                    <br><br>
                    <img src="<?php echo e(asset('img/rmiliBlack.png')); ?>" style="width: 100%; max-width: 400px; height: auto;">
                </div>
            </div>
        </div>

        <br><br>
        <h3>
            <div class="text-center">
                <b>Note d'Honoraire N': <?php echo e($note->ref); ?> </b>
            </div>
            <br></h3>
        <div class="row" style="margin-left: 50px;">
            <?php echo e($note->created_at->format('d-m-Y')); ?>

        </div>
        <br><br>
        <table class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
               id="dataTable" width="100%" cellspacing="0">
            <thead class="">
            <tr>
                <th class="text-center "><b>Nom de l'acte</b></th>
                <th class="text-center "><b>Code</b></th>
                <th class="text-center "><b>Lettre clé+Coeff</b></th>
                <th class="text-center "><b>Date</b></th>
                <th class="text-center "><b>Dent(s)</b></th>
                <th class="text-center "><b>Montant</b></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $noteHonoraire; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="table-row">
                    <td>
                        <?php echo e($act->act_name); ?>

                    </td>
                    <td><?php echo e($act->code); ?></td>
                    <td><?php echo e($act->lettrecle); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($act->date)->format('d-m-Y')); ?></td>
                    <td><?php echo e($act->dent); ?></td>
                    <td><?php echo e($act->montant); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="text-right"><strong>Total:</strong></td>
                <td><?php echo e($noteHonoraire->sum('montant')); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>
    </body>
    </html>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Define the event handler
            $('#PatientID').on('change', function () {
                var selectedOption = $(this).find(':selected');
                var birthday = selectedOption.data('birthday');
                var phone = selectedOption.data('phone');
                var address = selectedOption.data('address');
                var assurance = selectedOption.data('assurance');
                var height = selectedOption.data('height');
                var blood = selectedOption.data('blood');
                var cin = selectedOption.data('cin');

                var patientInfo = '';
                if (birthday) {
                    var age = calculateAgeWithMonths(birthday);
                    patientInfo += '<p><b><?php echo e(__('sentence.Birthday')); ?> :</b> ' + birthday + ' (' + age.years + ' A et  ' + age.months + ' M)</p>';
                }
                if (phone) {
                    patientInfo += '<p><b><?php echo e(__('sentence.Phone')); ?> :</b> ' + phone + '</p>';
                }
                if (address) {
                    patientInfo += '<p><b><?php echo e(__('sentence.Address')); ?> :</b> ' + address + '</p>';
                }

                if (height) {
                    patientInfo += '<p><b><?php echo e(__('sentence.Height')); ?> :</b> ' + height + ' cm</p>';
                }
                if (blood) {
                    patientInfo += '<p><b><?php echo e(__('sentence.Blood Group')); ?> :</b> ' + blood + '</p>';
                }
                if (cin) {
                    patientInfo += '<p><b>CIN : </b> ' + cin + '</p>';
                }
                if (assurance) {
                    patientInfo += '<p><b><?php echo e(__('sentence.assurance')); ?> :</b> ' + assurance + ' </p>';
                }
                $('#selected-patient-info').html(patientInfo);
            });
            // Trigger the change event when the page loads
            $('#PatientID').trigger('change');
            function calculateAgeWithMonths(birthday) {
                var today = new Date();
                var birthDate = new Date(birthday);
                var ageYears = today.getFullYear() - birthDate.getFullYear();
                var monthDifference = today.getMonth() - birthDate.getMonth();
                var dayDifference = today.getDate() - birthDate.getDate();
                if (dayDifference < 0) {
                    monthDifference--;
                }
                if (monthDifference < 0) {
                    ageYears--;
                    monthDifference = 12 + monthDifference;
                }
                return {
                    years: ageYears,
                    months: monthDifference
                };
            }
        });
    </script>
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('.multiselect-doctorino').select2();
        });
        $(document).ready(function () {
            $('#type').select2();
        });
    </script>
        <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        $(document).ready(function() {
            $(function() {
                $(document).on("click", '.print_note', function() {
                    printDiv('print_note')
                })
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/notehonoraire/view.blade.php ENDPATH**/ ?>