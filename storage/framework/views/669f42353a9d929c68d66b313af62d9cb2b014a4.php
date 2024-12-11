
<?php $__env->startSection('content'); ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print invoice')): ?>
            <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_prescription"><i class="fas fa-print fa-sm text-white-50"></i> Print</button>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center" id="stylesheetd">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- ROW : Doctor informations -->
                    <div class="row">
                        <div class="col" >
                            <img src="<?php echo e(asset("img/logo-grey.png")); ?>" style="width: 50%;"><br><br>
                            <?php echo clean(App\Setting::get_option('header_left')); ?>

                        </div>
                        <div class="col-4">
                            <p>
                                <b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($billing->created_at->format('d-m-Y')); ?><br>
                                <b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($billing->reference); ?><br>
                                <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($billing->User->name); ?>

                            </p>
                        </div>
                    </div>
                    <!-- END ROW : Doctor informations -->
                    <!-- ROW : Drugs List -->
                    <div class="row justify-content-center">
                        <div class="col">
                            <h5 class="text-center mt-5" style="font-size: xx-large"><b><?php echo e(__('sentence.Invoice')); ?></b></h5>
                            <br><br>
                            <table class="table">
                                <tr style="background: #2e3f50; color: #fff;">
                                    <td>Act</td>
                                    <td>Prix</td>
                                    <td>Payé</td>
                                    <td>Rest à payer</td>
                                </tr>

                                <?php
                                    $totalPayer = 0;
                                    $totalRest = 0;
                                    $totalbilling = 0;
                                    $total_rest = 0;
                                ?>

                                <?php if(isset($actes)): ?>
                                    <?php $__currentLoopData = $actes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                                <?php
                                                // Get the sum of the payer column for the current consultation_act_idc
                                                $sumPayer = \App\Billing_item::where('consultation_act_id', $acte->consultation_act_idc)
                                                    ->sum('payer');
                                                ?>
                                            <td><?php echo e($acte->name); ?></td>
                                            <td><?php echo e($acte->prix); ?></td>
                                            <td><?php echo e($sumPayer); ?></td>

                                            <?php
                                                $totalPayer += $sumPayer;
                                                $restAPayer = $acte->prix - $sumPayer;
                                                $totalRest += $restAPayer;
                                            ?>

                                            <td><?php echo e($restAPayer); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <?php if(isset($billing_items) && count($billing_items) > 0): ?>
                                    <?php $__currentLoopData = $billing_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                                <?php
                                                // Check if there are any records with the given ref
//                                                $hasRecords = \App\Billing_item::where('ref', $billing_item->id)->exists();
                                                $hasRecords = !is_null($billing_item->ref);

                                                // If records are found, proceed with calculation
                                                if ($hasRecords) {
                                                    // Get the sum of the payer column for the current consultation_act_idc
                                                    $sumPayer = \App\Billing_item::where('ref', $billing_item->ref)->sum('payer');
                                                    $totalbilling += $sumPayer;
                                                    $restbilling = $billing_item->invoice_amount - $sumPayer;
                                                    $total_rest += $restbilling + $totalRest;
                                                } else {
                                                    $sumPayer = $billing_item->invoice_amount;
                                                    $totalbilling += $sumPayer;
                                                    $restbilling = 0;
                                                }
                                                ?>
                                            <td><?php echo e(isset($billing_item->invoice_title) ? $billing_item->invoice_title : 'N/A'); ?></td>
                                            <td><?php echo e(isset($billing_item->invoice_amount) ? $billing_item->invoice_amount . ' ' : 'N/A'); ?></td>
                                            <td><?php echo e($sumPayer); ?></td>
                                            <td><?php echo e($restbilling); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="4"></td>
                                    </tr>
                                <?php endif; ?>

                                <tr>
                                    <td style="font-weight: bold;">Total:</td>
                                    <td colspan="1" style="text-align: right; font-weight: bold;"></td>
                                    <td style="font-weight: bold;"><?php echo e($totalPayer + $totalbilling); ?> <?php echo e(App\Setting::get_option('currency')); ?></td>
                                    <td style="font-weight: bold;"><?php echo e($total_rest + $totalRest); ?> <?php echo e(App\Setting::get_option('currency')); ?></td>
                                </tr>



                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </table>

                        </div>
                    </div>
                    <div style="margin-bottom: 250px;"></div>

                    <!-- END ROW : Drugs List -->
                    <!-- ROW : Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                        </div>
                        <div class="col">
                            <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                        </div>
                    </div>
                    <!-- END ROW : Footer informations -->
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden invoice -->
    <div id="print_area" style="display: none;">
        <br><br><br><br><br><br><br>
        <br><br><br><br>
        <div class="row">
            
            
            
            
            
            

            <div class="col-4" style="font-size: x-large">
                <p class="text-left" style="position: relative ;left: 800px;"><b>Skhirat ,le :</b> <?php echo e($billing->created_at->format('d-m-Y')); ?>

                </p>
                
                <b style="position: relative; left: 50px;"><?php echo e(__('sentence.Patient Name')); ?> : <?php echo e($billing->User->name); ?></b>

            </div>
        </div>
        <!-- END ROW : Doctor informations -->
        <!-- ROW : Drugs List -->
        <div class="row justify-content-center">
            <div class="col">

                <h5 class="text-center mt-5" style="font-size: xxx-large"><b><?php echo e(__('sentence.Invoice')); ?></b></h5>
                <br><br>
                <table class="table" style="font-size: x-large; margin-left: 20px; margin-right: 20px;">
                    <tr style="background: #2e3f50; color: #fff;">
                        <td>Act</td>
                        <td>Prix</td>
                        <td>Payé</td>
                        <td>Rest à payer</td>
                    </tr>
                    <?php
                        $totalPayer = 0;
                        $totalRest = 0;
                        $total_payer = 0;
                        $totalbilling = 0;
                    ?>
                    <?php if(isset($actes)): ?>
                        <?php $__currentLoopData = $actes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                    <?php
                                    // Get the sum of the payer column for the current consultation_act_idc
                                    $sumPayer = \App\Billing_item::where('consultation_act_id', $acte->consultation_act_idc)
                                        ->sum('payer');
                                    ?>
                                <td><?php echo e($acte->name); ?></td>
                                <td><?php echo e($acte->prix); ?></td>
                                <td><?php echo e($sumPayer); ?></td>

                                <?php
                                    $totalPayer += $sumPayer;
                                    $restAPayer = $acte->prix - $sumPayer;
                                    $totalRest += $restAPayer;
                                ?>

                                <td><?php echo e($restAPayer); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if(isset($billing_items) && count($billing_items) > 0): ?>
                        <?php $__currentLoopData = $billing_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                    <?php
                                    // Check if there are any records with the given ref
//                                                $hasRecords = \App\Billing_item::where('ref', $billing_item->id)->exists();
                                    $hasRecords = !is_null($billing_item->ref);

                                    // If records are found, proceed with calculation
                                    if ($hasRecords) {
                                        // Get the sum of the payer column for the current consultation_act_idc
                                        $sumPayer = \App\Billing_item::where('ref', $billing_item->ref)->sum('payer');
                                        $totalbilling += $sumPayer;
                                    } else {
                                        $sumPayer = $billing_item->invoice_amount;
                                        $totalbilling += $sumPayer;
                                    }
                                    ?>
                                <td><?php echo e(isset($billing_item->invoice_title) ? $billing_item->invoice_title : 'N/A'); ?></td>
                                <td><?php echo e(isset($billing_item->invoice_amount) ? $billing_item->invoice_amount . ' ' : 'N/A'); ?></td>
                                <td><?php echo e($sumPayer); ?></td>
                                <td><?php echo e($restbilling); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                    <?php endif; ?>

                    <tr>
                        <td style="font-weight: bold;">Total:</td>
                        <td colspan="1" style="text-align: right; font-weight: bold;"></td>
                        <td style="font-weight: bold;"><?php echo e($totalPayer + $totalbilling); ?> <?php echo e(App\Setting::get_option('currency')); ?></td>
                        <td style="font-weight: bold;"><?php echo e($total_rest + $totalRest); ?> <?php echo e(App\Setting::get_option('currency')); ?></td>
                    </tr>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </table>
                <hr>
            </div>
        </div>

        <!-- END ROW : Drugs List -->
        <!-- ROW : Footer informations -->
        <footer class="footer-nassim" style="position: absolute; bottom: 0;">
            <hr>
            <div class="row">
                <div class="col-6">
                    <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                </div>
                <div class="col-6">
                    <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                </div>
            </div>
            <!-- END ROW : Footer informations -->
        </footer>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="<?php echo e(asset('css/print.css')); ?>" rel="stylesheet"  media="all">

    <style type="text/css">
        p, u, li {
            color: #444444 !important;
        }

    </style>
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
            $(document).on("click", '.print_prescription',function () {
                PrintPreview('print_area');
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
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/billing/specialty/ophtamologie/view.blade.php ENDPATH**/ ?>