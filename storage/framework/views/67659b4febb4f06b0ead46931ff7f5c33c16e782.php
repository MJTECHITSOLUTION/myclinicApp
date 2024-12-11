<?php $__env->startSection('title'); ?>
    Gabarit
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport</title>
</head>

<body>
<form method="post" action="<?php echo e(route('gabarit.store_patient')); ?>">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                        <select class="form-control multiselect-doctorino" name="user_id" id="PatientID" required
                                oninvalid="this.setCustomValidity('Selectionner le patient SVP!')">
                            <option value=""><?php echo e(__('sentence.Select Patient')); ?></option>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $lastPatientId = Session::get('lastpatient'); // Retrieve the value of 'lastpatient' from the session
                                    $croissance = $patient->croissance; // Assuming there is a one-to-one relationship between Patient and Croissance models
                                ?>
                                <option value="<?php echo e($patient->id); ?>"
                                        data-birthday="<?php echo e($patient->Patient->birthday ?? ''); ?>"
                                        data-gender="<?php echo e($patient->Patient->gender ?? ''); ?>"
                                        data-name="<?php echo e($patient->name ?? ''); ?>"
                                        data-phone="<?php echo e($patient->Patient->phone ?? ''); ?>"
                                        data-address="<?php echo e($patient->Patient->adress ?? ''); ?>"
                                        data-cin="<?php echo e($patient->Patient->cin ?? ''); ?>"
                                        data-x="<?php echo e($croissance ? $croissance->x : ''); ?>"
                                        data-y="<?php echo e($croissance ? $croissance->y : ''); ?>"
                                        <?php if($lastPatientId == $patient->id): ?> selected <?php endif; ?>>
                                    <?php echo e($patient->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php echo e(csrf_field()); ?>

                    </div>

                    <br>
                    <label for="type">Selectionner un gabarit</label>
                    <select class="form-control" id="type" name="template_name">

                        <?php $__currentLoopData = $gabarits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gabarit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($gabarit->name); ?>" data-text="<?php echo e($gabarit->text); ?>" <?php if($name == $gabarit->name): ?> selected <?php endif; ?>>
                                <?php echo e($gabarit->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>


                    <div id="selected-patient-info">
                        <!-- Placeholder for displaying the selected patient's information -->
                    </div>
                    <div class="form-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rapports</h6>

                    <input type="submit" value="Sauvegarde" class="btn btn-success" style="position: absolute; right: 30px; top: 8px;" align="right"/>


                </div>
                <div class="card-body">
                    <textarea id="summernote" name="text"></textarea>
                </div>

            </div>
        </div>
    </div>
</form>



</body>

</html>
<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });
        $(document).ready(function() {
            $('#type').select2();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


    <script>
        $(document).ready(function() {
            // Initialize Summernote with readOnly option
            $('#summernote').summernote({
                height: 500, // Set the desired height
                toolbar: false, // You can customize the toolbar if needed
                disableDragAndDrop: true, // To prevent dragging and dropping images
                dialogsInBody: true, // To display the dialogs in the body
            });

            // Handle change event on the select elements
            $('#type, #PatientID').change(function() {
                // Get the selected values from the selects
                var selectedGabarit = $('#type option:selected').data('text');
                var selectedPatient = $('#PatientID').val();

                var selectedOption = $('#PatientID option[value="' + selectedPatient + '"]');
                var name_patient = selectedOption.data('name');
                var date_J = new Date().toISOString().slice(0, 10);

                var adresse = selectedOption.data('address') || '';
                var phone = selectedOption.data('phone') || '';
                var cin = selectedOption.data('cin') || '';
                var birthday = selectedOption.data('birthday') || '';
                var today = new Date();
                var birthdate = new Date(birthday);
                var age = today.getFullYear() - birthdate.getFullYear();
                var medecin = '<?php echo e(App\Setting::get_option('title')); ?>';

                // Check if birthday has occurred this year
                if (today.getMonth() < birthdate.getMonth() || (today.getMonth() === birthdate.getMonth() && today.getDate() < birthdate.getDate())) {
                    age--;
                }


                    // Replace placeholders in the Gabarit with actual values
                var updatedGabarit = selectedGabarit.replace("{nom_patient}", name_patient)
                    .replace('{date_du_jour}', date_J)
                    .replace('{age}', age)
                    .replace('{adresse}', adresse)
                    .replace('{téléphone}', phone)
                    .replace('{cin}', cin)
                    .replace('{medecin}', medecin);

                // Update the Summernote content with the updated gabarit
                $('#summernote').summernote('code', updatedGabarit);
            });

            // Handle printing when the button is clicked
            $('#printButton').click(function() {
                // Get the HTML content of the Summernote editor
                var summernoteContent = $('#summernote').summernote('code');

                // Open a new window and print the content
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Print</title></head><body>' + summernoteContent + '</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        });
    </script>

    <!-- Include jQuery -->

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
                    patientInfo += '<p><b><?php echo e(__('sentence.Birthday')); ?> :</b> ' + birthday + ' (' + age.years + ' A, ' + age.months + ' M, ' + age.days + ' J)</p>';

                    // Update the age input field with the calculated age
                    $('#age').val(age.years + ' A, ' + age.months + ' M, ' + age.days + ' J');
                }
                if (phone) {
                    patientInfo += '<p><b><?php echo e(__('sentence.Phone')); ?> :</b> ' + phone + '</p>';
                }
                if (address) {
                    patientInfo += '<p><b><?php echo e(__('sentence.Address')); ?> :</b> ' + address + '</p>';
                }
                if (assurance) {
                    patientInfo += '<p><b><?php echo e(__('sentence.assurance')); ?> :</b> ' + assurance + ' </p>';
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
                    // Calculate the number of days in the previous month
                    var lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 0);
                    dayDifference += lastMonth.getDate();
                }

                if (monthDifference < 0) {
                    ageYears--;
                    monthDifference = 12 + monthDifference;
                }

                return {
                    years: ageYears,
                    months: monthDifference,
                    days: dayDifference
                };
            }
        });
    </script>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/gabarit/gabarit_view.blade.php ENDPATH**/ ?>