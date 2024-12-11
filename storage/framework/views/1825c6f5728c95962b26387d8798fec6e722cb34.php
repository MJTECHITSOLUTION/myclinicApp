
<?php $__env->startSection('content'); ?>
    <!-- DataTables  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.Billing List')); ?></h6>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        
                        <select class="form-control" name="user_id" id="PatientID">
                            <option value=""><?php echo e(__('sentence.Select Patient')); ?></option>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($patient->id); ?>">
                                    <?php echo e($patient->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php echo e(csrf_field()); ?>

                    </div>
                </div>
                <div class="col-6">
                    <form action="<?php echo e(route('billing.search')); ?>" method="GET" class="form-inline float-right">
                        <div class="form-group mx-2">
                            <label for="reference" class="sr-only"><?php echo e(__('Reference')); ?></label>
                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Référence de la consultation">
                        </div>
                        <div class="form-group mx-2">&nbsp; Du:
                            <label for="start_date" class="sr-only"><?php echo e(__('Start Date')); ?></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo e(date('Y-d-m')); ?>" placeholder="<?php echo e(__('Start Date')); ?>">
                        </div>
                        <div class="form-group mx-2">&nbsp; Ou:
                            <label for="end_date" class="sr-only"><?php echo e(__('End Date')); ?></label>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="<?php echo e(__('End Date')); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Search')); ?></button>
                    </form>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th><?php echo e(__('sentence.Reference')); ?> facture </th>
                        <th><?php echo e(__('sentence.Patient')); ?></th>
                        <th><?php echo e(__('sentence.Date')); ?></th>
                        <th class="text-center">Montant - <font class="text-danger">(Rest à payé)
                            </font>
                        </th>
                        <th class="text-center"><?php echo e(__('sentence.Status')); ?></th>
                        <th class="text-center"><?php echo e(__('sentence.Payment Method')); ?></th>
                        <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e($invoice->reference); ?></td>
                            <td><a href="<?php echo e(url('patient/view/' . $invoice->user_id)); ?>"> <?php echo e($invoice->User->name); ?>

                                </a></td>
                            <td><?php echo e($invoice->created_at->format('d M Y')); ?></td>
                            <?php
                                $paymentRecord = $sumPayments->where('billing_id', $invoice->id)->first();
                                $remainingPayment = optional($paymentRecord)->total_payment ?? 0;
                            ?>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-id="<?php echo e($invoice->id); ?>" data-target="#paymentDetailsModal">
                                    <?php if($remainingPayment == 0): ?>
                                        <?php echo e($invoice->deposited_amount); ?>

                                    <?php else: ?>
                                        <?php echo e($remainingPayment); ?>

                                    <?php endif; ?> / <?php echo e($invoice->total_without_tax); ?>

                                    <?php echo e(App\Setting::get_option('currency')); ?>

                                    <span class="badge badge-danger-soft">
                                    <?php echo e($invoice->due_amount - $remainingPayment); ?>

                                        <?php echo e(App\Setting::get_option('currency')); ?>

                                </span>
                                </a>
                            </td>

                            <td class="text-center">
                                <?php if($invoice->payment_status == 'Paid'): ?>
                                    <label class="badge badge-success-soft">
                                        <i class="fas fa-check"></i> <?php echo e(__('sentence.Paid')); ?>

                                    </label>
                                <?php elseif($remainingPayment == 0): ?>

                                    <label class="badge badge-danger-soft">
                                        <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Unpaid')); ?>

                                    </label>
                                <?php elseif($remainingPayment == $invoice->total_without_tax): ?>
                                    <label class="badge badge-success-soft">
                                        <i class="fas fa-check"></i> <?php echo e(__('sentence.Paid')); ?>

                                    </label>
                                <?php else: ?>
                                    <label class="badge badge-warning-soft">
                                        <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Partially Paid')); ?>

                                    </label>
                                <?php endif; ?>
                            </td>

                            <td class="text-center"><label class="badge badge-primary-soft"><i class="fa fa-handshake"></i> <?php echo e($invoice->payment_mode); ?></label></td>

                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view invoice')): ?>
                                    <a href="<?php echo e(url('billing/view/' . $invoice->id)); ?>" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                <?php endif; ?>

                                






                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                    <a data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('billing/delete/' . $invoice->id)); ?>" class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                <?php endif; ?>

                                <?php if(!($remainingPayment == $invoice->due_amount)): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                        <a href="<?php echo e(url('billing/reglement/' . $invoice->id)); ?>" class="btn btn-outline-info btn-circle btn-sm"><i class="fas fa-dollar-sign my-custom-class" title="Règlement"></i></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                    <a href="<?php echo e(url('prescription/view/' . $invoice->prescriptions_id)); ?>"
                                       class="btn btn-outline-dark btn-circle btn-sm"><i class="far fa-file-alt"
                                                                                         title="Consultation"></i></a>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentDetailsModalLabel">Détails de paiement</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="yourTableContainer"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="float-right mt-3"><?php echo e($invoices->links()); ?></span>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('#PatientID').select2();
        });
    </script>
    <script>
        // Function to refresh the input value
        function refreshInputValue(namePatient) {
            document.getElementById("patientNameInput").value = namePatient;
        }

        $(document).ready(function () {
            $('#PatientID').change(function () {
                var selectedPatientId = $(this).val();

                // Make an AJAX request to update the session variables
                $.ajax({
                    url: '/get-patient-data/' + selectedPatientId,
                    method: 'GET',
                    success: function (data) {
                        // Update the variables and page content
                        var namePatient = data.namePatient;
                        var lastPatientId = data.lastPatientId;
                        var imagePatient = data.imagePatient;
                        location.reload();

                        // Update your page elements with the new data
                        $('#namePatientElement').text(namePatient);
                        // Update other elements as needed

                        // Call the refreshInputValue function to update the input
                        refreshInputValue(namePatient);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('a[data-target="#paymentDetailsModal"]').click(function (e) {
                e.preventDefault();

                // Get the invoice id from the data attribute
                var invoiceId = $(this).data('id');

                // Make an AJAX request to fetch data
                $.ajax({
                    type: 'GET',
                    url: '/get-reg/' + invoiceId,
                    success: function (data) {
                        // Create and populate the table
                        createTable(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Function to create and populate the table
            function createTable(regData) {
                var table = $('<table>').addClass('table');
                var thead = $('<thead>').append($('<tr>').append('<th>Paiement</th>', '<th>Mode de paiement</th>', '<th>Créé à</th>', '<th>Supprimer</th>'));
                var tbody = $('<tbody>');

                // Loop through the data and create rows
                $.each(regData, function (index, reg) {
                    var createdAt = new Date(reg.created_at);
                    var formattedDate = createdAt.toLocaleDateString('fr-FR');

                    var row = $('<tr>').append(
                        $('<td>').text(reg.payment),
                        $('<td>').text(reg.payment_method),
                        $('<td>').text(formattedDate),
                        regData.length > 1 ? $('<td>').html('<i class="fas fa-trash delete" data-id="' + reg.id + '" style="cursor: pointer;"></i>') : ''
                    );

                    tbody.append(row);
                });

                table.append(thead, tbody);

                // Append the table to a container (e.g., a modal)
                $('#yourTableContainer').empty().append(table);
                // Event listener for delete icon click
                $('.delete').click(function (e) {
                    e.stopPropagation(); // Prevent the modal from being triggered

                    // Get the invoice id from the data attribute
                    var invoiceId = $(this).data('id');

                    // Make an AJAX request to delete the row
                    $.ajax({
                        type: 'GET',
                        url: '/delete-reg/' + invoiceId,
                        success: function (data) {
                            // Assuming the row is successfully deleted, you can update the table or take other actions
                            console.log('Row deleted successfully');
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<?php $__env->stopSection(); ?>


<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/billing/specialty/generalist/all.blade.php ENDPATH**/ ?>