<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow mb-4">
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <?php if(empty(!$patient->image)): ?>
                                <center><img src="<?php echo e(asset('uploads/'.$patient->image)); ?>"
                                             class="img-profile rounded-circle img-fluid" width="256" height="256">
                                </center>
                            <?php else: ?>
                                <?php if($patient->Patient->gender == 'Homme' || $patient->Patient->gender == ''): ?>
                                    <center><img src="<?php echo e(asset('img/homme.png')); ?>"
                                                 class="img-profile rounded-circle img-fluid" width="256" height="256">
                                    </center>
                                <?php endif; ?>
                                <?php if($patient->Patient->gender == 'Femme' || $patient->Patient->gender == 'Female'): ?>
                                    <center><img src="<?php echo e(asset('img/femme.png')); ?>"
                                                 class="img-profile rounded-circle img-fluid" width="256" height="256">
                                    </center>
                                <?php endif; ?>
                                <?php if($patient->Patient->gender == 'Enfant' || $patient->Patient->gender == 'Garçon'): ?>
                                    <center><img src="<?php echo e(asset('img/garson.png')); ?>"
                                                 class="img-profile rounded-circle img-fluid" width="256" height="256">
                                    </center>
                                <?php endif; ?>
                                <?php if($patient->Patient->gender == 'Fille' || $patient->Patient->gender == 'Fille'): ?>
                                    <center><img src="<?php echo e(asset('img/fille.png')); ?>"
                                                 class="img-profile rounded-circle img-fluid" width="256" height="256">
                                    </center>
                                <?php endif; ?>
                            <?php endif; ?>
                            <h4 class="text-center mt-3"><b><?php echo e($patient->name); ?></b> <label
                                    class="badge badge-primary-soft"> <a href="<?php echo e(url('patient/edit/'.$patient->id)); ?>"><i
                                            class="fa fa-pen"></i></a></label></h4>
                            <hr>
                            <?php if(isset($patient->Patient->birthday)): ?>
                                <p><b><?php echo e(__('sentence.Birthday')); ?> :</b> <?php echo e($patient->Patient->birthday); ?>

                                    (<?php echo e(calculateAgeWithMonths($patient->Patient->birthday)); ?>)</p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->gender)): ?>
                                <p><b><?php echo e(__('sentence.Gender')); ?> :</b> <?php echo e(__($patient->Patient->gender)); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->phone)): ?>
                                <p><b><?php echo e(__('sentence.Phone')); ?> :</b> <?php echo e($patient->Patient->phone); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->adress)): ?>
                                <p><b><?php echo e(__('sentence.Address')); ?> :</b> <?php echo e($patient->Patient->adress); ?></p>
                            <?php endif; ?>
                            <?php if(isset($patient->Patient->weight)): ?>
                                <p><b><?php echo e(__('sentence.Weight')); ?> :</b> <?php echo e($patient->Patient->weight); ?> Kg</p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->height)): ?>
                                <p><b><?php echo e(__('sentence.Height')); ?> :</b> <?php echo e($patient->Patient->height); ?> cm</p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->assurance)): ?>
                                <p><b><?php echo e(__('sentence.assurance')); ?> :</b> <?php echo e($patient->Patient->assurance); ?></p>
                            <?php endif; ?>

                            <?php if(isset($patient->Patient->cin)): ?>
                                <p><b>CIN : </b> <?php echo e($patient->Patient->cin); ?></p>
                            <?php endif; ?>
                            <?php if(isset($patient->Patient->numdossier)): ?>
                                <p><b>Numéro de dossier : </b> <?php echo e($patient->Patient->numdossier); ?></p>
                            <?php endif; ?>

                        </div>
                        <div class="col-md-8 col-sm-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                       role="tab" aria-controls="Profile" aria-selected="true">Dossiers Médicaux</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents"
                                       role="tab" aria-controls="documents"
                                       aria-selected="false"><?php echo e(__('sentence.Health History')); ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="appointements-tab" data-toggle="tab" href="#appointements"
                                       role="tab" aria-controls="appointements"
                                       aria-selected="false"><?php echo e(__('sentence.Appointments')); ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions"
                                       role="tab" aria-controls="prescriptions"
                                       aria-selected="false"><?php echo e(__('sentence.Prescriptions')); ?></a>
                                </li>
                                
                                
                                


                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab"
                                       aria-controls="Billing"
                                       aria-selected="false"><?php echo e(__('sentence.Payment History')); ?></a>
                                </li>
                                
                                
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="observation-tab" data-toggle="tab" href="#observation" role="tab" aria-controls="observation" aria-selected="false">Les rapport</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                     aria-labelledby="profile-tab">

                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                                <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                        data-toggle="modal" data-target="#NewDocumentModel"><i
                                                        class="fa fa-plus"></i> Ajouter nouveau
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th>Title</th>
                                            <th>Note</th>
                                            <th>Créé à</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <?php if($document->document_type == "pdf"): ?>
                                                        <img src="<?php echo e(asset('img/pdf.jpg')); ?>" class="card-img-top"
                                                             width="50" height="50">
                                                    <?php elseif($document->document_type == "docx"): ?>
                                                        <img src="<?php echo e(asset('img/docx.png')); ?>" class="card-img-top"
                                                             width="50" height="50">
                                                    <?php else: ?>
                                                        <a class="example-image-link"
                                                           href="<?php echo e(url('/uploads/'.$document->file)); ?>"
                                                           data-lightbox="example-1">
                                                            <img src="<?php echo e(url('/uploads/'.$document->file)); ?>"
                                                                 class="card-img-top" width="50" height="50">
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($document->title); ?></td>
                                                <td><?php echo e($document->note); ?></td>
                                                <td><?php echo e($document->created_at); ?></td>
                                                <td>
                                                    <a href="<?php echo e(url('/uploads/'.$document->file)); ?>"
                                                       class="btn btn-primary btn-sm" download>
                                                        <i class="fa fa-cloud-download-alt"></i> Télécharger
                                                    </a>
                                                    <button class="btn btn-success btn-sm"
                                                            onclick="viewPDF('<?php echo e(asset('/uploads/'.$document->file)); ?>')">
                                                        <i class="fa fa-eye"></i> Afficher
                                                    </button>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                           data-target="#DeleteModal"
                                                           data-link="<?php echo e(url('document/delete/'.$document->id)); ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200"/><br><br>
                                                    <b class="text-muted">Aucun document disponible</b>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="appointements" role="tabpanel"
                                     aria-labelledby="appointements-tab">
                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                   href="<?php echo e(route('appointment.create')); ?>"><i
                                                        class="fa fa-plus"></i> <?php echo e(__('sentence.New Appointment')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td align="center">Num</td>
                                            <td align="center"><?php echo e(__('sentence.Date')); ?></td>
                                            <td align="center"><?php echo e(__('sentence.Time Slot')); ?></td>
                                            <td align="center"><?php echo e(__('sentence.Status')); ?></td>
                                            <td align="center"><?php echo e(__('sentence.Actions')); ?></td>
                                        </tr>
                                        <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td align="center"><?php echo e($appointment->id); ?> </td>
                                                <td align="center"><label class="badge badge-primary-soft"><i
                                                            class="fas fa-calendar"></i> <?php echo e($appointment->date->format('d M Y')); ?>

                                                    </label></td>
                                                <td align="center"><label class="badge badge-primary-soft"><i
                                                            class="fa fa-clock"></i> <?php echo e($appointment->time_start); ?>

                                                        - <?php echo e($appointment->time_end); ?> </label></td>
                                                <td class="text-center">
                                                    <?php if($appointment->visited == 0): ?>
                                                        <label class="badge badge-warning-soft">
                                                            <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Not Yet Visited')); ?>

                                                        </label>
                                                    <?php elseif($appointment->visited == 1): ?>
                                                        <label class="badge badge-primary-soft">
                                                            <i class="fas fa-check"></i> Terminé
                                                        </label>
                                                    <?php elseif($appointment->visited == 3): ?>
                                                        <label class="badge badge-success-soft">
                                                            <i class="fas fa-check"></i>Salle d'attente
                                                        </label>
                                                    <?php else: ?>
                                                        <label class="badge badge-danger-soft">
                                                            <i class="fas fa-user-times"></i> <?php echo e(__('sentence.Cancelled')); ?>

                                                        </label>
                                                    <?php endif; ?>
                                                </td>
                                                <td align="center">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
                                                        <a data-rdv_id="<?php echo e($appointment->id); ?>"
                                                           data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>"
                                                           data-rdv_time_start="<?php echo e($appointment->time_start); ?>"
                                                           data-rdv_time_end="<?php echo e($appointment->time_end); ?>"
                                                           data-patient_name="<?php echo e($appointment->User->name); ?>"
                                                           class="btn btn-outline-success btn-circle btn-sm"
                                                           data-toggle="modal" data-target="#EDITRDVModal"><i
                                                                class="fas fa-check"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointment')): ?>
                                                        <a href="<?php echo e(url('appointment/delete/'.$appointment->id)); ?>"
                                                           class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                class="fas fa-trash"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="5" align="center"><img
                                                        src="<?php echo e(asset('img/not-found.svg')); ?>" width="200"/> <br><br> <b
                                                        class="text-muted"><?php echo e(__('sentence.No appointment available')); ?></b>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="prescriptions" role="tabpanel"
                                     aria-labelledby="prescriptions-tab">
                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
                                                <a class="btn btn-primary btn-sm my-4 float-right"
                                                   href="<?php echo e(route('prescription.create')); ?>"><i
                                                        class="fa fa-pen"></i> <?php echo e(__('sentence.Write New Prescription')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td align="center"><?php echo e(__('sentence.Reference')); ?></td>
                                            <td class="text-center"><?php echo e(__('sentence.Content')); ?></td>
                                            
                                            <td align="center">Créé à</td>
                                            <td align="center"><?php echo e(__('sentence.Actions')); ?></td>
                                        </tr>
                                        <?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td align="center"><?php echo e($prescription->reference); ?></td>
                                                <td class="text-center">
                                                    <label class="badge badge-primary-soft">
                                                        <?php echo e(count($prescription->Drug)); ?> Médicaments
                                                    </label>
                                                    <label class="badge badge-primary-soft">
                                                        <?php echo e(count($prescription->Test)); ?> Analyse
                                                    </label>
                                                </td>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                <td align="center">
                                                    <label
                                                        class="badge badge-primary-soft"><?php echo e($prescription->created_at); ?></label>
                                                </td>
                                                <td align="center">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prescription')): ?>
                                                        <a href="<?php echo e(url('prescription/view/'.$prescription->id)); ?>"
                                                           class="btn btn-outline-success btn-circle btn-sm"><i
                                                                class="fa fa-eye"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit prescription')): ?>
                                                        <a href="<?php echo e(url('prescription/edit/'.$prescription->id)); ?>"
                                                           class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                class="fas fa-pen"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete prescription')): ?>
                                                        <a href="<?php echo e(url('prescription/delete/'.$prescription->id)); ?>"
                                                           class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                class="fas fa-trash"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="5" align="center">
                                                    <img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200"/>
                                                    <br><br>
                                                    <b class="text-muted"><?php echo e(__('sentence.No prescription available')); ?></b>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>

                                </div>

                                <div class="tab-pane fade" id="act" role="tabpanel" aria-labelledby="act-tab">
                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
                                                <a class="btn btn-primary btn-sm my-4 float-right"
                                                   href="<?php echo e(route('prescription.create')); ?>"><i
                                                        class="fa fa-pen"></i> <?php echo e(__('sentence.Write New Prescription')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>Act</td>
                                            <td class="text-center">Dent</td>
                                            <td class="text-center">Date de debut</td>
                                            <!-- Added column for Statut du Consultation -->
                                            <td align="center">Nombre de seance faites/N'seance</td>
                                            <td align="center">Status</td>
                                            <td align="center">Prix</td>
                                            <td align="centre">Action</td>
                                        </tr>
                                        <?php $__empty_1 = true; $__currentLoopData = $consultation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($act->name); ?></td>
                                                <td class="text-center"><?php echo e($act->dent); ?></td>
                                                <td class="text-center">
                                                    <?php echo e(\Carbon\Carbon::parse($act->act_created_at)->format('d-m-Y')); ?>

                                                </td>
                                                <td align="center"><?php echo e($act->numseances); ?>/<?php echo e($act->nums); ?></td>
                                                <td align="center"><?php echo e($act->status); ?></td>
                                                <td align="center"><?php echo e($act->prix); ?></td>
                                                <td align="center">
                                                    <!-- Consultation Icon -->
                                                    <a id="consultationLink"
                                                       href="<?php echo e(route('consultation.list', ['id' => $act->consultation_id])); ?>"
                                                       class="consultationLink" data-id="<?php echo e($act->consultation_id); ?>"
                                                       data-toggle="modal" data-target="#consultationModal"
                                                       data-placement="top" title="Liste de consultation">
                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                    <a id="paiementLink"
                                                       href="<?php echo e(route('paiement.list', ['id' => $act->consultation_id])); ?>"
                                                       class="paiementLink" data-toggle="modal"
                                                       data-id="<?php echo e($act->consultation_id); ?>" data-target="#paiementModal"
                                                       data-placement="top" title="Liste de paiement">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </a>
                                                    <a id="seancesLink"
                                                       href="<?php echo e(route('seance.list', ['id' => $act->consultation_id])); ?>"
                                                       class="seancesLink" data-id="<?php echo e($act->consultation_id); ?>"
                                                       data-toggle="modal" data-target="#seanceModal"
                                                       data-placement="top" title="Liste de séance">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    </table>
                                </div>

                                <div class="modal fade" id="consultationModal" tabindex="-1" role="dialog"
                                     aria-labelledby="consultationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="consultationModalLabel">Consultation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="paiementModal" tabindex="-1" role="dialog"
                                     aria-labelledby="paiementModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paiementModalLabel">Paiement</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="seanceModal" tabindex="-1" role="dialog"
                                     aria-labelledby="seanceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="seanceModalLabel">Seance</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="documents" role="tabpanel"
                                     aria-labelledby="documents-tab">
                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create health history')): ?>
                                                <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                        data-toggle="modal" data-target="#MedicalHistoryModel"><i
                                                        class="fa fa-plus"></i> Ajoute
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php $__empty_1 = true; $__currentLoopData = $historys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="alert alert-danger">
                                            <p class="text-danger font-size-12">
                                                <?php echo clean($history->title); ?> - <?php echo e($history->created_at); ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete health history')): ?>
                                                    <span class="float-right"><i class="fa fa-trash" data-toggle="modal"
                                                                                 data-target="#DeleteModal"
                                                                                 data-link="<?php echo e(url('history/delete/'.$history->id)); ?>"></i></span>
                                                <?php endif; ?>
                                            </p>
                                            <ul>
                                                <?php if(isset($history->typeanti)): ?>
                                                    <li>
                                                        Type : <?php echo e($history->typeanti); ?>

                                                    </li>
                                                <?php endif; ?>
                                                <?php if(isset($history-> traitement)): ?>
                                                    <li>
                                                        Date - Durée : <?php echo e($history->traitement); ?>

                                                    </li>
                                                <?php endif; ?>
                                                <?php if(isset($history->periode)): ?>
                                                    <li>
                                                        Médicament / traitement : <?php echo e($history->periode); ?>

                                                    </li>
                                                <?php endif; ?>
                                                <?php if(isset($history->note)): ?>
                                                    <li>
                                                        Détail : <?php echo clean($history->note); ?>

                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <center><img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200"/> <br><br> <b
                                                class="text-muted">Aucun antécédent médical n'a été trouvé</b></center>
                                    <?php endif; ?>


                                </div>


                                <div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="row">
                                        <div class="col">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right" href="<?php echo e(route('billing.create')); ?>"><i class="fa fa-plus"></i> <?php echo e(__('sentence.Create Invoice')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <th><?php echo e(__('sentence.Invoice')); ?></th>
                                            <th class="text-center"><?php echo e(__('sentence.Date')); ?></th>
                                            <th class="text-center"><?php echo e(__('sentence.Amount')); ?></th>
                                            <th class="text-center"><?php echo e(__('sentence.Status')); ?></th>
                                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                                        </tr>
                                        <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(url('billing/view/'.$invoice->id)); ?>"><?php echo e($invoice->reference); ?></a>
                                                </td>
                                                <td class="text-center"><label
                                                        class="badge badge-primary-soft"><?php echo e($invoice->created_at->format('d M Y')); ?></label>
                                                </td>
                                                <?php
                                                    $paymentRecord = $sumPayments->where('billing_id', $invoice->id)->first();
                                                    $remainingPayment = optional($paymentRecord)->total_payment ?? 0;
                                                ?>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-id="<?php echo e($invoice->id); ?>"
                                                       data-target="#paymentDetailsModal">
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
                                                <td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view invoice')): ?>
                                                        <a href="<?php echo e(url('billing/view/'.$invoice->id)); ?>"
                                                           class="btn btn-outline-success btn-circle btn-sm"><i
                                                                class="fa fa-eye"></i></a>
                                                    <?php endif; ?>







                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                                        <a href="<?php echo e(url('billing/delete/'.$invoice->id)); ?>"
                                                           class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                class="fas fa-trash"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                                        <a href="<?php echo e(url('billing/reglement/' . $invoice->id)); ?>"
                                                           class="btn btn-outline-info btn-circle btn-sm"><i
                                                                class="fas fa-dollar-sign my-custom-class"
                                                                title="Règlement"></i></a>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                            </tr>
                                            <td colspan="6" align="center"><img src="<?php echo e(asset('img/not-found.svg')); ?>"
                                                                                width="200"/> <br><br> <b
                                                    class="text-muted"><?php echo e(__('sentence.No Invoices Available')); ?></b>
                                            </td>
                                        <?php endif; ?>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="observation" role="tabpanel"
                                     aria-labelledby="observation-tab">
                                    <div class="chart-container">
                                        <div class="row">
                                            <div class="col">
                                            </div>
                                        </div>
                                        <br>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                
                                                <th><?php echo e(__('sentence.Patient')); ?></th>
                                                <th class="text-center">Rapport</th>
                                                <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php $__empty_1 = true; $__currentLoopData = $gabarits_patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gabarits_patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <td><a> <?php echo e($gabarits_patient->user_name); ?> </a></td>
                                                    <td class="text-center">
                                                        <label class="badge badge-primary-soft">
                                                            <?php echo e($gabarits_patient->template_name); ?>

                                                        </label>
                                                        <label class="badge badge-primary-soft">
                                                        </label>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="<?php echo e(url('gabarit/view/' . $gabarits_patient->id )); ?>"
                                                           class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                                        <a href="<?php echo e(url('gabarit/edit/' . $gabarits_patient->id )); ?>"
                                                           class="btn   btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                        <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                                           data-target="#DeleteModal"
                                                           data-link="<?php echo e(url('gabarit/delete/' . $gabarits_patient->id)); ?>"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="5" class="text-center"><img src="<?php echo e(asset('img/not-found.svg')); ?>"
                                                                                             width="200" /> <br><br> <b class="text-muted">Aucun Rapport trouvé</b></td>
                                                </tr>
                                            </tbody>
                                            <?php endif; ?>
                                            <?php $__empty_1 = true; $__currentLoopData = $rapport_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rapport_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <td><a> <?php echo e($rapport_type->name); ?> </a></td>
                                                <td class="text-center">
                                                    <label class="badge badge-primary-soft">
                                                        <?php echo e($rapport_type->label); ?>

                                                        <input type="hidden" name="label" id="label"
                                                               value="<?php echo e($rapport_type->rapport_label); ?>">
                                                    </label>
                                                    <label class="badge badge-primary-soft">
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <label class="badge badge-primary-soft">
                                                        <?php echo e($rapport_type->created_at->format('d-m-Y')); ?>

                                                    </label>
                                                    <label class="badge badge-primary-soft">
                                                    </label>
                                                </td>

                                                <td class="text-center">
                                                    <a href="<?php echo e(url('rapport/view/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id)); ?>"
                                                       class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php echo e(url('rapport/edit/' . $rapport_type->id . '?label=' . $rapport_type->label . '&user_id=' . $rapport_type->user_id)); ?>"
                                                       class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                    <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                                       data-target="#DeleteModal"
                                                       data-link="<?php echo e(url('rapport/delete/' . $rapport_type->id)); ?>"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                                    </tbody>
                                            <?php endif; ?>

                                        </table>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Modal-->
    <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel"><?php echo e(__('sentence.You are about to modify an appointment')); ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b><?php echo e(__('sentence.Patient')); ?> :</b> <span id="patient_name"></span></p>
                    <p><b><?php echo e(__('sentence.Date')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b><?php echo e(__('sentence.Time Slot')); ?> :</b> <label class="badge badge-primary-soft"
                                                                      id="rdv_time"></span></label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                            data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                    <a class="btn btn-primary text-white"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();"><?php echo e(__('sentence.Confirm Appointment')); ?></a>
                    <form id="rdv-form-confirm" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                          class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="btn btn-danger text-white"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();"><?php echo e(__('sentence.Cancel Appointment')); ?></a>
                    <form id="rdv-form-cancel" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                          class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="btn rounded-0  btn-primary  text-white" id="salle"
                       onclick="event.preventDefault(); document.getElementById('rdv-form-salle').submit();">+Salle
                        d'attente</a>
                    <form id="rdv-form-salle" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                          class="d-none">
                        <input type="time" id="time" name="hours" class="form-control"
                               value="<?php echo e(now()->format('H:i')); ?>">
                        <input type="hidden" name="rdv_id" id="rdv_id3">
                        <input type="hidden" name="rdv_status" value="3">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Document Modal -->
    <div id="NewDocumentModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un fichier / une note</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="<?php echo e(route('document.store')); ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="title" placeholder="Title" required>
                                <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
                                <?php echo e(csrf_field()); ?>

                            </div>
                            <div class="col">
                                <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1"
                                       required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <textarea class="form-control" name="note" placeholder="Note"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"
                                data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                        <button class="btn btn-primary text-white" type="submit"><?php echo e(__('sentence.Save')); ?></button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!--Document Modal -->
    <div id="MedicalHistoryModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouté antécédent </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="<?php echo e(route('history.store')); ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" class="form-control" name="title">
                                <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-10">
                                <label>Type:</label>
                                <select id="typeAntiSelect" class="form-control" name="typeanti">
                                    <option value="">Type antécédent</option>
                                    <?php $__currentLoopData = $antecident; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($anti->antecedents_name); ?>"><?php echo e($anti->antecedents_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <br>
                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                        data-target="#addAntecedentModal">
                                    <i class="fa fa-plus"></i> Ajoute
                                </button>
                            </div>
                        </div>
                        <div class="row mt-2">

                            <div class="col">
                                <label>Détail</label>
                                <textarea class="form-control" name="note" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label>Médicament / traitement</label>
                                <input type="text" class="form-control" name="periode" placeholder="">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label> Date - Durée</label>
                                <textarea class="form-control" name="traitement" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"
                                data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                        <button class="btn btn-primary text-white" type="submit"><?php echo e(__('sentence.Save')); ?></button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Add Antecedent Modal -->
    <div class="modal fade" id="addAntecedentModal" tabindex="-1" role="dialog"
         aria-labelledby="addAntecedentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAntecedentModalLabel">Ajouter un nouvel antécédent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="antecedentsForm" method="post" action="<?php echo e(route('anticedents.store')); ?>">
                        <div class="form-group">
                            <label for="antecedents_name">Antécédents name *</label>
                            <input type="text" class="form-control" name="antecedents_name" id="antecedents_name"
                                   aria-describedby="antecedents_name" required>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <button type="button" onclick="addAntecedent()"
                                class="btn rounded-0 btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/lightbox.css')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('dashboard/js/lightbox.js')); ?>"></script>
    <script>
        function addAntecedent() {
            var formData = $('#antecedentsForm').serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('anticedents.store')); ?>',
                data: formData,
                success: function (response) {
                    // Handle the response as needed
                    console.log(response);

                    // Refresh the dropdown options
                    refreshDropdown();
                    $('#addAntecedentModal').modal('hide');

                    // For example, you can update the UI or show a success message
                    alert('Antécédent ajouté avec succès !');
                },
                error: function (error) {
                    // Handle errors if any
                    console.log(error);
                }
            });
        }

        function refreshDropdown() {
            // Fetch the updated list of antecedents and update the dropdown options
            $.get('<?php echo e(route('antecident.view')); ?>', function (data) {
                var dropdown = $('#typeAntiSelect');
                dropdown.empty();
                dropdown.append('<option value="">Type antécédent</option>');
                $.each(data, function (index, value) {
                    dropdown.append('<option value="' + value.antecedents_name + '">' + value.antecedents_name + '</option>');
                });
            });
        }
    </script>


    <script>
        function viewPDF(pdfUrl) {
            var width = 800; // Set the desired width of the popup window
            var height = 600; // Set the desired height of the popup window
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;

            window.open(
                pdfUrl,
                'PDF Viewer',
                'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left
            );
        }
    </script>
    <script>
        $(document).ready(function () {
            // Click event on the consultationLink
            $('.consultationLink').on('click', function (e) {
                e.preventDefault();

                // Get the act ID from the data attribute
                var actId = $(this).data('id');

                // Make an AJAX request to fetch consultation data
                $.ajax({
                    url: '/consultation/list/' + actId,
                    type: 'GET',
                    success: function (data) {
                        // Update the modal body with the consultation data
                        var modalBody = $('#consultationModal').find('.modal-body');

                        // Clear previous consultation data
                        modalBody.find('div').empty();

                        // Create a Bootstrap table
                        var table = $('<table class="table table-bordered"></table>');
                        var thead = $('<thead><tr><th>Dent</th><th>Prix</th><th>Status</th><th>Date</th></tr></thead>');
                        table.append(thead);

                        // Append new consultation data to the table
                        var tbody = $('<tbody></tbody>');
                        data.forEach(function (consultation) {
                            var formattedDate = new Date(consultation.created_at).toLocaleString();

                            var row = $('<tr><td>' + consultation.dent + '</td><td>' + consultation.prix + '</td><td>' + consultation.status + '</td><td>' + formattedDate + '</td></tr>');
                            tbody.append(row);
                        });
                        table.append(tbody);

                        // Append the table to the modal body
                        modalBody.find('div').append(table);

                        // Show the modal
                        $('#consultationModal').modal('show');
                    },
                    error: function (error) {
                        console.error('Error fetching consultation data:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Click event on the paiement link
            $('.paiementLink').on('click', function (e) {
                e.preventDefault();

                // Get the consultation ID from the data attribute
                var consultationId = $(this).data('id');

                // Make an AJAX request to fetch paiement data and sumPayer
                $.ajax({
                    url: '/paiement/list/' + consultationId,
                    type: 'GET',
                    success: function (data) {
                        // Update the modal body with the paiement data and sumPayer
                        var modalBody = $('#paiementModal').find('.modal-body');
                        modalBody.empty();

                        // Create a Bootstrap table
                        var table = $('<table class="table table-bordered"></table>');
                        var thead = $('<thead><tr><th>#</th><th> Payer </th><th> Rest à payer </th><th> Date </th></tr></thead>');
                        table.append(thead);

                        // Initialize a variable to accumulate payer values
                        var accumulatedPayer = 0;

                        // Append new paiement data to the table
                        var tbody = $('<tbody></tbody>');
                        data.billing_act.forEach(function (paiement, index) {
                            var formattedDate = new Date(paiement.created_at).toLocaleString();
                            var counter = index + 1;

                            // Accumulate payer values
                            accumulatedPayer += paiement.payer;

                            // Calculate rest à payer
                            var rest = paiement.prix - accumulatedPayer;

                            // Check if rest is NaN and replace with 0
                            rest = isNaN(rest) ? 0 : rest;

                            var row = $('<tr><td>' + counter + '</td><td>' + paiement.payer + '</td><td>' + rest + '</td><td>' + formattedDate + '</td></tr>');
                            tbody.append(row);
                        });
                        table.append(tbody);

                        // Append the table to the modal body
                        modalBody.append(table);

                        // Show the modal
                        $('#paiementModal').modal('show');
                    },
                    error: function (error) {
                        console.error('Error fetching paiement data:', error);
                    }
                });
            });
        });


    </script>


    <script>
        $(document).ready(function () {
            // Click event on the séance link
            $('.seancesLink').on('click', function (e) {
                e.preventDefault();

                // Get the consultation ID from the data attribute
                var seancesid = $(this).data('id');
                console.log(seancesid);

                // Make an AJAX request to fetch séance data
                $.ajax({
                    url: '/seance/list/' + seancesid,
                    type: 'GET',
                    success: function (data) {
                        // Update the modal body with the séance data
                        var modalBody = $('#seanceModal').find('.modal-body');
                        modalBody.empty();

                        // Create a Bootstrap table
                        var table = $('<table class="table table-bordered"></table>');
                        var thead = $('<thead><tr><th>Numéro de séance</th><th>Observation</th><th>Date</th></tr></thead>');
                        table.append(thead);

                        // Append new séance data to the table
                        var tbody = $('<tbody></tbody>');
                        data.forEach(function (seance) {
                            var formattedDate = new Date(seance.created_at).toLocaleString();
                            var row = $('<tr><td>' + seance.numseances + '</td><td>' + seance.observation + '</td><td>' + formattedDate + '</td></tr>');
                            tbody.append(row);
                        });
                        table.append(tbody);

                        // Append the table to the modal body
                        modalBody.append(table);

                        // Show the modal
                        $('#seanceModal').modal('show');
                    },
                    error: function (error) {
                        console.error('Error fetching séance data:', error);
                    }
                });
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
  
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
  
      var pusher = new Pusher('71bad976fa94a78527b6', {
        cluster: 'eu'
      });
  
      var channel = pusher.subscribe('notify-channel');
channel.bind('form-submit', function(data) {
  alert(JSON.stringify(data)); // Updated to match the actual structure
});


    </script>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\MYCLINIC-PEDIATRE\resources\views/patient/specialty/generalist/view.blade.php ENDPATH**/ ?>