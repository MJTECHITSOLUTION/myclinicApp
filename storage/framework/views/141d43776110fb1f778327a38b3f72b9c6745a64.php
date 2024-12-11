<?php $__env->startSection('content'); ?>
    <?php
    use Carbon\Carbon;

    function calculateAgeWithMonths($birthday)
    {
        $today = Carbon::now();
        $birthDate = Carbon::parse($birthday);

        $age = $today->diff($birthDate);
        $ageYears = $age->y;
        $ageMonths = $age->m;

        return "$ageYears ans et $ageMonths mois";
    }
    ?>
    <form method="post" action="<?php echo e(route('prescription.update')); ?>">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                            <option value="<?php echo e($prescription->user_id); ?>"><?php echo e($prescription->User->name); ?> -
                                (<?php echo e(calculateAgeWithMonths($prescription->User->Patient->birthday)); ?>)</option>
                            <input type="hidden" name="patient_id" value="<?php echo e($prescription->user_id); ?>">
                            <input type="hidden" name="prescription_id" value="<?php echo e($prescription->id); ?>">
                            <?php echo e(csrf_field()); ?>

                        </div>
                        
                        
                        
                        <div class="form-group">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row justify-content-end">

                    <input type="submit" value="Sauvegarde" class="btn rounded-0  btn-primary mr-3 mb-2" align="center">
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Motif de consultation</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            
                            
                            
                            
                            <div class="form-group col-md-12">
                                <label for="motife">Motif de consultation</label>
                                <textarea class="form-control rounded-0 shadow-none " id="motife" name="motife" placeholder=""
                                    value="<?php echo e($prescription->motife); ?>"><?php echo e($prescription->motife); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Constantes</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="certificate">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputPoid">Poid</label>
                                        <input type="hidden" name="user_id" value="<?php echo e($prescription->user_id); ?>">
                                        <input type="hidden" name="reference" value="<?php echo e($prescription->reference); ?>">
                                        <input type="text" class="form-control rounded-0 shadow-none w-100"
                                            id="inputPoid" name="poid" placeholder="" style="width: 11rem;"
                                            value="<?php echo e($prescription->poid); ?>">
                                        <small id="poidHelp" class="form-text text-muted">Weight in kilograms</small>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputTaille">Taille</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100"
                                            id="inputTaille" name="taille" placeholder="" style="width: 11rem;"
                                            value="<?php echo e($prescription->taille); ?>">
                                        <small id="tailleHelp" class="form-text text-muted">Height in centimeters</small>

                                    </div>

                                    
                                    
                                    
                                    
                                    









































                                    <div class="form-group col-md-4">
                                        <label for="inputTemp">température</label>
                                        <input type="text" class="form-control rounded-0 shadow-none w-100"
                                            id="inputTemp" name="temp" placeholder="" style="width: 11rem;"
                                            value="<?php echo e($prescription->temp); ?>">
                                        <small id="tempHelp" class="form-text text-muted">Température en °C</small>
                                    </div>

                                </div>
                                <label for="motife">Rapport d'examen</label>
                                <textarea class="form-control rounded-0 shadow-none " id="rapport" name="rapport" rows="5" placeholder=""
                                    value="<?php echo e($prescription->rapport); ?>"><?php echo e($prescription->rapport); ?></textarea>
                            </form>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Drugs list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable">
                                <?php $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription_drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <section class="field-group">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <select
                                                    class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-drug"
                                                    name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true"
                                                    required>
                                                    <option value="<?php echo e($prescription_drug->drug_id); ?>">
                                                        <?php echo e($prescription_drug->Drug->trade_name); ?></option>
                                                    <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->trade_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group-custom">
                                                    <input type="text" id="drug_advice" name="drug_advice[]"
                                                        class="form-control rounded-0 shadow-none "
                                                        placeholder="<?php echo e(__('sentence.Advice_Comment')); ?>"
                                                        value="<?php echo e($prescription_drug->drug_advice); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a type="button"
                                                    class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i
                                                        class="fa fa-trash font-size-12"></i>
                                                    <?php echo e(__('sentence.Remove')); ?></a>
                                            </div>
                                            <div class="col-12">
                                                <hr color="red">
                                            </div>
                                        </div>
                                    </section>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Add Drug')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Tests list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable">
                                <?php $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription_test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="field-group row">
                                        <div class="form-group col-md-12" style="display: none;">
                                            <label for="test_id">Group d'analyse:</label>
                                            <select name="test_name[]"
                                                class="form-control rounded-0 shoadow-none shadow-none rounded-0 test-select">
                                                <option value="<?php echo e($prescription_test->test_id); ?>">
                                                    <?php echo e($prescription_test->Test->test_name); ?> </option>
                                                <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($test->id); ?>"><?php echo e($test->test_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="analyse_id">Analyse:</label>
                                            <select name="analyse_id[]"
                                                class="form-control rounded-0 shoadow-none shadow-none rounded-0 analyse-select">
                                                <?php $__currentLoopData = $analyses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analysis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($analysis->id); ?>"
                                                        <?php echo e(old('analyse_id', $prescription_test->analyse_id) == $analysis->id ? 'selected' : ''); ?>>
                                                        <?php echo e($analysis->analyse_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-9">
                                            <div class="form-group-custom">
                                                <input type="text" id="strength" name="description[]"
                                                    class="form-control rounded-0 shadow-none "
                                                    placeholder="<?php echo e(__('sentence.Description')); ?>"
                                                    value="<?php echo e($prescription_test->description); ?>">
                                                <input type="hidden" name="prescription_test_id[]"
                                                    value="<?php echo e($prescription_test->id); ?>">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm"
                                                align="center"><i class="fa fa-trash font-size-12"></i>
                                                <?php echo e(__('sentence.Remove')); ?></a>

                                        </div>
                                        <div class="col-12">
                                            <hr color="#a1f1d4">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Add Test')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>


                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Radio</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="fai_labels">
                            <div class="repeatable">
                                <?php $__currentLoopData = $prescription_radios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription_radio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="field-group row">
                                        <div class="form-group col-md-12">
                                            <label for="radio">radio</label>
                                            <select name="radio_id[]"
                                                class="form-control rounded-0 shoadow-none shadow-none rounded-0 radio-select">
                                                <option value="<?php echo e($prescription_radio->radio_id); ?>">
                                                    <?php echo e($prescription_radio->radio_name); ?> </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-9">
                                            <div class="form-group-custom">
                                                <input type="text" id="justif" name="justif[]"
                                                    class="form-control rounded-0 shadow-none "
                                                    placeholder="<?php echo e(__('sentence.Description')); ?>"
                                                    value="<?php echo e($prescription_radio->justif); ?>">
                                                <input type="hidden" name="prescription_radio_id[]"
                                                    value="<?php echo e($prescription_radio->id); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm"
                                                align="center"><i class="fa fa-trash font-size-12"></i>
                                                <?php echo e(__('sentence.Remove')); ?></a>

                                        </div>
                                        <div class="col-12">
                                            <hr color="#a1f1d4">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn rounded-0  btn-sm btn-primary add text-white"
                                    align="center"><i class='fa fa-plus'></i> Ajoute Radio</a>
                            </div>
                        </fieldset>
                    </div>
                </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Certification</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputCertificat">Les jours</label>
                            <input type="number" class="form-control rounded-0 shadow-none " id="inputCertificat"
                                name="certificat" value="<?php echo e($prescription->certificat); ?>"
                                placeholder="Les jours du repos" oninput="calculateDates()">
                            <small id="certificatHelp" class="form-text text-muted">Entre les jours du repos.</small>
                            <label for="inputdated">La date de début</label>
                            <input type="date" class="form-control rounded-0 shadow-none " id="dated"
                                name="dated" value="<?php echo e(date('Y-m-d')); ?>" oninput="calculateDates()">
                            <label for="inputdatef">La date de Fin</label>
                            <input type="date" class="form-control rounded-0 shadow-none " id="datef"
                                name="datef">
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Remarque générale</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="bilan">Remarque</label>
                            <textarea class="form-control rounded-0 shadow-none " id="bilan" name="bilan" placeholder=""
                                value="<?php echo e($prescription->bilan); ?>"><?php echo e($prescription->bilan); ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">

                    <input type="submit" value="Sauvegarde" class="btn rounded-0  btn-primary mr-3 mb-4"
                        align="center">
                </div>

            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });

        $(document).ready(function() {
            $('.multiselect-drug').select2();
        });

        $(document).ready(function() {
            $('.analyse-select').select2();
        });

        $(document).ready(function() {
            $('.radio-select').select2();
        });
    </script>

    <script>
        $(".fai_labels .repeatable").repeatable({
            addTrigger: ".fai_labels .add",
            deleteTrigger: ".fai_labels .delete",
            template: "#fai_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.multiselect-radio').select2();
            }
        });
        $(".test_labels .repeatable").repeatable({
            addTrigger: ".test_labels .add",
            deleteTrigger: ".test_labels .delete",
            template: "#test_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.analyse-select').select2();
            }
        });
    </script>

    <script type="text/template" id="fai_labels">
        <div class="field-group row">
            <div class="form-group col-md-12">
                <label>Radios </label>
                <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-radio"
                        name="radio_id_new[]" id="fai" tabindex="-1" aria-hidden="true" required>
                    <?php $__currentLoopData = $radios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $radio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($radio->id); ?>">
                            <?php echo e($radio->radio_name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-9">
                <div class="form-group-custom">
                    <textarea type="text" name="justif_new[]" class="form-control rounded-0 shadow-none " rows="3"
                              placeholder="Justificatif"></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-3">
                <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm" align="center">
                    <i class="fa fa-plus"></i> <?php echo e(__('sentence.Remove')); ?>

                </a>
            </div>
            <div class="col-12">
                <hr color="#a1f1d4">
            </div>
        </div>
    </script>

    <script type="text/template" id="drugs_labels">
        <section class="field-group">
            <div class="row">
                <div class="col-md-2">
                    
                    
                    
                    
                </div>
                <div class="col-md-12">
                    <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                        <option value=""><?php echo e(__('sentence.Select Drug')); ?>...</option>
                        <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->trade_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                
                
                
                
            </div>
            <br>















            <div class="row">
                <div class="col-md-9">
                    <div class="form-group-custom">
                        <input type="text" id="drug_advice" name="drug_advice[]" class="form-control rounded-0 shadow-none " placeholder="Remarque">
                    </div>
                </div>
                <div class="col-md-3">
                    <a type="button" class="btn rounded-0  btn-danger btn-sm text-white span-2 delete"><i class="fa fa-trash  font-size-12"></i> <?php echo e(__('sentence.Remove')); ?></a>
                </div>
                <div class="col-12">
                    <hr color="#a1f1d4">
                </div>
            </div>
        </section>


    </script>
    <script type="text/template" id="test_labels">
        <div class="field-group row">
            <div class="form-group col-md-12" style="display: none;">
                <label for="test_id">Group d'analyse:</label>
                <select name="test_name[]" class="form-control rounded-0 shoadow-none shadow-none rounded-0 test-select">
                    <option value="">Select Group d'analyse</option>
                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="14"><?php echo e($test->test_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="analyse_id">Analyse:</label>
                <select name="analyse_id[]"  class="form-control rounded-0 shoadow-none shadow-none rounded-0 analyse-select">
                    <option value="">Select Analyse</option>
                    <?php $__currentLoopData = $analyses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analyse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($analyse->id); ?>"><?php echo e($analyse->analyse_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group col-md-9">
                <div class="form-group-custom">
                    <input type="text" id="strength" name="description[]"  class="form-control rounded-0 shadow-none " placeholder="Remarque">
                </div>
            </div>
            <div class="col-md-3">
                <a type="button" class="btn rounded-0  btn-danger delete text-white btn-sm" align="center"><i class='fa fa-trash  font-size-12'></i> <?php echo e(__('sentence.Remove')); ?></a>

            </div>
            <div class="col-12">
                <hr color="#a1f1d4">
            </div>
        </div>
    </script>
    <script>
        function calculateDates() {
            const daysInput = document.getElementById('inputCertificat');
            const startDateInput = document.getElementById('dated');
            const endDateInput = document.getElementById('datef');

            const days = parseInt(daysInput.value, 10);
            const startDate = new Date(startDateInput.value);

            if (!isNaN(days) && startDate instanceof Date && !isNaN(startDate)) {
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + days - 1); // Subtract 1 day
                endDateInput.value = endDate.toISOString().split('T')[0];
            } else {
                endDateInput.value = '';
            }
        }
    </script>

    <script>
        $(document).on('change', '.test-select', function() {
            var testId = $(this).val();
            var currentAnalyseSelect = $(this).closest('.field-group').find('.analyse-select');
            if (testId) {
                $.ajax({
                    url: '/getAnalyses/' + testId,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        analyse_id: currentAnalyseSelect.val() // Pass the selected value(s) directly
                    },
                    success: function(data) {
                        currentAnalyseSelect.prop('disabled', false).html('');
                        $.each(data, function(key, value) {
                            currentAnalyseSelect.append('<option value="' + value.id + '">' +
                                value.analyse_name + '</option>');
                        });
                    }
                });
            } else {
                currentAnalyseSelect.prop('disabled', true).html('<option value="">Select Analyse</option>');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/prescription/specialty/generalist/edit.blade.php ENDPATH**/ ?>