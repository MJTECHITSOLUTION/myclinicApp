<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('prescription.store')); ?>" id="form_id">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
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
                            <select class="form-control rounded-0 shadow-none multiselect-doctorino" name="patient_id"
                                id="PatientID" required oninvalid="this.setCustomValidity('Selectionner le patient SVP!')">
                                <option value=""><?php echo e(__('sentence.Select Patient')); ?></option>
                                <?php
                                    $lastPatientId = Session::get('lastpatient');
                                ?>

                                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div id="selected-patient-info">

                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#PatientID').on('change', function() {
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
                                        patientInfo += '<p><b><?php echo e(__('sentence.Birthday')); ?> :</b> ' + birthday + ' (' + age
                                            .years + ' A et  ' + age.months + ' M)</p>';
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
                                    
                                    
                                    
                                    
                                    
                                    
                                    if (cin) {
                                        patientInfo += '<p><b>CIN : </b> ' + cin + '</p>';
                                    }
                                    $('#selected-patient-info').html(patientInfo);
                                });

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

                        <div class="form-group">
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">Créer consultation</h6>
                            </div>
                            <div class="col-2">
                                <button type="submit"
                                    class="btn rounded-0 btn-primary rounded-0 btn-sm float-right">Sauvegarde</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="motife">Motif de consultation</label>
                                <textarea class="form-control rounded-0 shadow-none" id="motife" name="motife" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Examen clinique</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="certificate">
                            <form>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>AV(vision de loin)</strong>
                                                <td>
                                                    <label for="table1_input1">Sans correction</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_od_s" name="av_vl_od_s" placeholder="OD">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_og_s" name="av_vl_og_s" placeholder="OG">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table1_input2">Avec correction</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_od_a" name="av_vl_od_a" placeholder="OD">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="av_vl_og_a" name="av_vl_og_a" placeholder="OG">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">/10</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>AV(vision de près)</strong>
                                                <td>
                                                    <label for="table2_select1">OD</label>
                                                    <select class="form-control rounded-0 shadow-none" id="av_vp_od"
                                                        name="av_vp_od">
                                                        <option value="">Sélectionner</option>
                                                        <option value="P1">P1</option>
                                                        <option value="P2">P2</option>
                                                        <option value="P3">P3</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_select2">OG</label>
                                                    <select class="form-control rounded-0 shadow-none" id="av_vp_og"
                                                        name="av_vp_og">
                                                        <option value="">Sélectionner</option>
                                                        <option value="P1">P1</option>
                                                        <option value="P2">P2</option>
                                                        <option value="P3">P3</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Annexes</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="annex_od" name="annex_od" placeholder="OD">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="annex_og" name="annex_og" placeholder="OG">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>SA(segment antérieur)</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="sa_od" name="sa_od" placeholder="OD">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="sa_og" name="sa_og" placeholder="OG">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>FO(fond d'oeil)</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="fo_od" name="fo_od" placeholder="OD">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="fo_og" name="fo_og" placeholder="OG">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>TO(tonus oculaire)</strong>
                                                <td>
                                                    <label for="table1_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="to_od" name="to_od" placeholder="OD">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table1_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="to_og" name="to_og" placeholder="OG">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Réfraction</strong>
                                                <td>
                                                    <label for="table2_input1">OD</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="fo_od" name="ref_od" placeholder="OD">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="table2_input2">OG</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 shadow-none"
                                                            id="fo_og" name="ref_og" placeholder="OG">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Addition</strong>
                                                <td>
                                                    <div class="input-group">
                                                        <textarea name="addition" class="form-control rounded-0 shadow-none" id="" cols="60" rows="6"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="patient_title">Patient </label>
                                        <select class="form-control rounded-0 shadow-none" id="patient_title"
                                            name="patient_title">
                                            <option value="Mr">Mr</option>
                                            <option value="Mlle">Mlle</option>
                                            <option value="Mme">Mme</option>
                                            <option value="L'enfant">L'enfant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <strong>Verres</strong>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_ar"
                                                            id="verreAR" value="AR">
                                                        <label class="form-check-label" for="verreAR">AR</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_lb"
                                                            id="verreLB" value="LB">
                                                        <label class="form-check-label" for="verreLB">LB</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_uv"
                                                            id="verreUV" value="UV">
                                                        <label class="form-check-label" for="verreUV">UV</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_pro"
                                                            id="verrePRO" value="PRO">
                                                        <label class="form-check-label" for="verrePRO">PRO</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="verre_phog"
                                                            id="phoPRO" value="PhoG">
                                                        <label class="form-check-label" for="phoPRO">PhoG</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-md-3">
                                                                                <label for="inputPoid">Poid</label>
                                                                                <input type="hidden" name="user_id" value="">
                                                                                <input type="hidden" name="reference" value="">
                                                                                <input type="text" class="form-control rounded-0 shadow-none" id="inputPoid" name="poid" placeholder="" style="width: 11rem;" value="">
                                                                                <small id="poidHelp" class="form-text text-muted">Weight in kilograms</small>

                                                                            </div>
                                                                            <div class="form-group col-md-3">
                                                                                <label for="inputTaille">Taille</label>
                                                                                <input type="text" class="form-control rounded-0 shadow-none" id="inputTaille" name="taille" placeholder="" style="width: 11rem;" value="" >
                                                                                <small id="tailleHelp" class="form-text text-muted">Height in centimeters</small>

                                                                            </div>

                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputsa">Saturation en oxygène</label>
                                                                            <input type="text" class="form-control rounded-0 shadow-none" id="inputsa" name="sa" placeholder="" style="width: 11rem;" value="">
                                                                            <small id="tempHelp" class="form-text text-muted">Saturation en oxygène</small>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputPAS">PAS</label>
                                                                            <input type="number" class="form-control rounded-0 shadow-none" id="inputPAS" name="pas" placeholder="" style="width: 11rem;" value="">
                                                                            <small id="pasHelp" class="form-text text-muted">Systolic blood pressure in mmHg</small>

                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputPAD">TA</label>
                                                                            <input type="text" class="form-control rounded-0 shadow-none" id="inputPAD" name="pad" placeholder="" style="width: 11rem;" value="">
                                                                            <small id="padHelp" class="form-text text-muted">Diastolic blood pressure in mmHg</small>

                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputPouls">Fréquence cardiaque</label>
                                                                            <input type="text" class="form-control rounded-0 shadow-none" id="inputPouls" name="pouls" placeholder="" style="width: 11rem;" value="">
                                                                            <small id="poulsHelp" class="form-text text-muted">Fréquence cardiaque en battements par minute</small>
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputfr">Fréquence respiratoire</label>
                                                                            <input type="text" class="form-control rounded-0 shadow-none" id="inputfr" name="fr" placeholder="" style="width: 11rem;" value="">
                                                                            <small id="poulsHelp" class="form-text text-muted">Fréquence respiratoire</small>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputTemp">température</label>
                                                                            <input type="text" class="form-control rounded-0 shadow-none" id="inputTemp" name="temp" placeholder="" style="width: 11rem;" value="">
                                                                            <small id="tempHelp" class="form-text text-muted">Température en °C</small>
                                                                        </div>

                                                                    </div> -->
                                <label for="motife">Commentaire</label>
                                <textarea class="form-control rounded-0 shadow-none" id="rapport" name="rapport" rows="3" placeholder=""
                                    value=""></textarea>
                            </form>
                        </fieldset>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter ordonnance</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button"
                                    class="btn rounded-0 btn-sm rounded-0 btn-primary rounded-0 add text-white"
                                    align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Add Drug')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter analyses médicals</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button"
                                    class="btn rounded-0 btn-sm rounded-0 btn-primary rounded-0 add text-white"
                                    align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Add Test')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Radios </h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="fai_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button"
                                    class="btn rounded-0 btn-sm rounded-0 btn-primary rounded-0 add text-white"
                                    align="center"><i class='fa fa-plus'></i>Ajouter </a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter certificat médical</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputCertificat">Nombre des jours</label>
                            <input type="number" class="form-control rounded-0 shadow-none" id="inputCertificat"
                                name="certificat" placeholder="Les jours du repos" oninput="calculateDates()">
                            <small id="certificatHelp" class="form-text text-muted">Entre les jours du repos.</small>
                            <label for="inputdated">La date de début</label>
                            <input type="date" class="form-control rounded-0 shadow-none" id="dated"
                                name="dated" value="<?php echo e(date('Y-m-d')); ?>" oninput="calculateDates()">
                            <label for="inputdatef">La date de Fin</label>
                            <input type="date" class="form-control rounded-0 shadow-none" id="datef"
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
                            <textarea class="form-control rounded-0 shadow-none" id="bilan" name="bilan" placeholder=""></textarea>
                        </div>
                    </div>
                </div>


                <button type="submit"
                    class="btn rounded-0 rounded-0 btn-primary rounded-0 btn-sm float-right">Sauvegarde</button>


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
    </script>

    
    
    

    
    
    
    
    
    

    
    
    
    
    

    <script type="text/template" id="drugs_labels">
        <section class="field-group">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-12">
                    <select class="form-control rounded-0 shadow-none multiselect-drug" name="trade_name[]" id="drug" tabindex="-1"
                            aria-hidden="true" required>
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
                        <input type="text" id="drug_advice" name="drug_advice[]" class="form-control rounded-0 shadow-none"
                               placeholder="Remarque">
                    </div>
                </div>
                <div class="col-md-3">
                    <a type="button" class="btn rounded-0 rounded-0 btn-danger btn-sm text-white span-2 delete"><i
                            class="fa fa-times-circle"></i> <?php echo e(__('sentence.Remove')); ?></a>
                </div>
                <div class="col-12">
                    <hr color="#a1f1d4">
                </div>
            </div>
        </section>

    </script>
    <script>
        $(".fai_labels .repeatable").repeatable({
            addTrigger: ".fai_labels .add",
            deleteTrigger: ".fai_labels .delete",
            template: "#fai_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.fai').select2();
            }
        });
        $(".test_labels .repeatable").repeatable({
            addTrigger: ".test_labels .add",
            deleteTrigger: ".test_labels .delete",
            template: "#test_labels",
            startWith: 1,
            max: 5,
            afterAdd: function() {
                $('.analyse').select2();
            }
        });
    </script>
    <script type="text/template" id="test_labels">
        <div class="field-group row">
            
            
            
            
            
            
            
            
            
            <div class="form-group col-md-12">
                <label for="analyse_id">Analyse:</label>
                <select name="analyse_id[]" id="analyse" class="form-control rounded-0 shadow-none analyse">
                    <option value="">Sélectionnez Analyse</option>
                    <?php $__currentLoopData = $analyses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analyse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($analyse->id); ?>"><?php echo e($analyse->analyse_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-9">
                <div class="form-group-custom">
                    <input type="text" name="description[]" class="form-control rounded-0 shadow-none"
                           placeholder="<?php echo e(__('sentence.Description')); ?>">
                </div>
            </div>
            <br>
            <div class="col-md-3">
                <a type="button" class="btn rounded-0 rounded-0 btn-danger delete text-white btn-sm" align="center">
                    <i class="fa fa-plus"></i> <?php echo e(__('sentence.Remove')); ?>

                </a>
            </div>
            <div class="col-12">
                <hr color="#a1f1d4">
            </div>
        </div>
    </script>

    <script type="text/template" id="fai_labels">
        <div class="field-group row">
            <div class="form-group col-md-12">
                <label>Radios </label>

                <select type="text" name="radio_id[]" id="fai" class="form-control rounded-0 shadow-none fai">
                    <option value="">Sélectionnez un Radio</option>
                    <?php $__currentLoopData = $radios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $radio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($radio->id); ?>"><?php echo e($radio->radio_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-9">
                <div class="form-group-custom">
                    <textarea type="text" name="justif[]" class="form-control rounded-0 shadow-none" rows="3"
                              placeholder="Justificatif"></textarea>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-3">
                <a type="button" class="btn rounded-0 rounded-0 btn-danger delete text-white btn-sm" align="center">
                    <i class="fa fa-plus"></i> <?php echo e(__('sentence.Remove')); ?>

                </a>
            </div>
            <div class="col-12">
                <hr color="#a1f1d4">
            </div>
        </div>
    </script>

    <script>
        // Function to refresh the input value
        function refreshInputValue(namePatient) {
            document.getElementById("patientNameInput").value = namePatient;
        }

        $(document).ready(function() {
            $('#PatientID').change(function() {
                var selectedPatientId = $(this).val();

                // Make an AJAX request to update the session variables
                $.ajax({
                    url: '/get-patient-data/' + selectedPatientId,
                    method: 'GET',
                    success: function(data) {
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
                    error: function(error) {
                        console.log(error);
                    }
                }) // Refresh the page
            });
        });
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
        < script src = "https://code.jquery.com/jquery-3.6.0.min.js" >
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/prescription/specialty/ophtamologie/create.blade.php ENDPATH**/ ?>