@section('content')
    <form method="post" action="{{ route('billing.store') }}">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="drug">{{ __('sentence.Select Patient') }}</label>
                            <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 select2"
                                    id="PatientID"
                                    tabindex="-1" name="patient_id" aria-hidden="true">
                                <option>{{ __('sentence.Select Patient') }}</option>
                                @php
                                    $lastPatientId = Session::get('lastpatient'); // Retrieve the value of 'lastpatient' from the session
                                @endphp
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}"
                                            @if ($user_id == $patient->id || $lastPatientId == $patient->id) selected @endif>
                                        {{ $patient->name }}</option>
                                @endforeach
                            </select>
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="DueAmount">Montant</label>
                            <input class="form-control rounded-0 shadow-none " type="number" name="due_amount"
                                   id="DueAmount" readonly>
                        </div>

                        <div class="form-group">
                            <label for="DepositedAmount">Montant à payé</label>
                            <input class="form-control rounded-0 shadow-none " type="number" name="payment"
                                   id="DepositedAmount" readonly>
                        </div>
                        <div class="form-group">
                            <label for="PaymentMode">{{ __('sentence.Payment Mode') }}</label>
                            <select class="form-control rounded-0 shadow-none" name="payment_mode" id="PaymentMode" onchange="handlePaymentModeChange()">
                                <option value="Espèces">{{ __('sentence.Cash') }}</option>
                                <option value="Chèque">{{ __('sentence.Cheque') }}</option>
                                <option value="TPE">{{ __('sentence.TPE') }}</option>
                            </select>
                        </div>
                        <div id="chequeDetails" style="display: none;">
                            <div class="form-group">
                                <label for="chequeNumber">Nombre de chèque</label>
                                <input type="number" class="form-control" id="chequeNumber" name="cheque_number">
                            </div>
                            <div class="form-group">
                                <label for="chequeAmount">Montant</label>
                                <input type="number" class="form-control" id="chequeAmount" name="cheque_amount" oninput="divideAmount()">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="showChequeModal()">Entrer les informations du chèque</button>
                        </div>
                        <div id="hiddenChequeInputs"></div>

                        <br>

                        <!-- Table to display cheque info -->
                        <table class="table" id="chequeTable" style="display: none;">
                            <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Date d'encaissement</th>
                                <th>Montant</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Cheque rows will be appended here -->
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="chequeModal" tabindex="-1" role="dialog" aria-labelledby="chequeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="chequeModalLabel">Informations du chèque</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="chequeInfo"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-primary" onclick="saveChequeInfo()">Sauvegarder</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <input class="form-control rounded-0 shadow-none " type="hidden" name="id_prescription"
                               id="id_prescription" value="{{ $prescription_id }}">

                        <div class="form-group" style="display: none;">
                            <label for="PaymentMode">{{ __('sentence.Payment Status') }}</label>
                            <select class="form-control rounded-0 shadow-none " name="payment_status">
                                <option value="Paid">{{ __('sentence.Paid') }}</option>
                                <option value="Partially Paid">{{ __('sentence.Partially Paid') }}</option>
                                <option value="Unpaid">{{ __('sentence.Unpaid') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{--                            <input type="submit" value="Créer une facture" class="btn btn-warning btn-block" align="center">--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Invoice Details') }}</h6>
                        <input type="submit" value="Enregistrer" class="btn btn-success">
                    </div>

                    <div class="card-body">
                        <fieldset class="billing_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn rounded-0  btn-primary btn-sm add text-white"
                                   align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Item') }}</a>
                            </div>
                        </fieldset>
                        <span class="float-right">Total : <b id="total_without_tax_income">0 </b>
                            {{ App\Setting::get_option('currency') }}</span><br>
                        {{--                        <span class="float-right">TVA : {{ App\Setting::get_option('vat') }} %</span><br>--}}
                        {{--                        <span class="float-right">Total incl. tax : <b id="total_income">0 </b>--}}
                        {{--                            {{ App\Setting::get_option('currency') }}</span>--}}
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Invoice Details') }}</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="act_labels">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">ref</th>
                                    <th class="text-center">Libellé</th>
                                    <th class="text-center">Statut acte</th>
                                    <th class="text-center">Dent</th>
                                    <th class="text-center">Prix</th>
                                    <th class="text-center">Payé</th>
                                    {{--                                 <th class="text-center">A payer</th>--}}
                                    <th class="text-center">Rest à payé</th>
                                    <th class="text-center">Historique</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($actes as $act)
                                    <tr class="table-row">
                                        <td>{{ $act->ref }}</td>
                                        <td> @if(isset($act->libelle_act))
                                                {{ $act->libelle_act }}
                                            @else
                                                {{ $act->name }}
                                            @endif
                                        </td>
                                        <td>{{ $act->status }}
                                            <input type="hidden" name="consultation_act_id[]"
                                                   value="{{ $act->consultation_act_idc }}">
                                        </td>
                                        <td>{{ $act->dent }}</td>
                                        <td>{{ $act->prix }}
                                            <input type="hidden" name="prix[]" class="prix" id="prix"
                                                   value="{{ $act->prix }}">
                                        </td>
                                        <td style="display: none;">
                                            <input type="text" class="form-control" data-row="{{ $loop->index }}"
                                                   name="payer_input[]" id="payer" value="{{ $act->payer ?? '0' }}"
                                                   readonly>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control payer-input" name="a_payer"
                                                   id="a_payer">
                                            <input type="hidden" class="form-control payer-input montant_facture"
                                                   name="payer[]">
                                            <br>
                                            <input type="hidden" class="form-control" name="" id="total">
                                        </td>
                                        <td class="rest-a-payer">
                                            <input type="text" class="form-control rest-a-payer-output"
                                                   name="rest_a_payer[]" id="rest_a_payer" value="0" readonly>
                                        </td>
                                        <td class="text-center">
                                            <a class='addObservation' data-toggle="modal" data-target="#billingModal"
                                               data-act-id="{{ $act->consultation_act_idc }}">
                                                <i class='fas fa-money-check-alt'></i>
                                            </a>
                                            {{--                                         <i class='fas fa-trash delete-icon' style='color:red; cursor:pointer;'></i>--}}
                                        </td>

                                    </tr>
                                @endforeach

                                @isset($deleted_actes)
                                    @foreach($deleted_actes as $act )
                                        <tr class="table-row">
                                            <td>{{ $act->ref }}/supprimé</td>
                                            <td>
                                                @if(isset($act->libelle_act))
                                                    {{ $act->libelle_act }}
                                                @else
                                                    {{ $act->name }}
                                                @endif
                                            </td>
                                            <td>{{ $act->status }}
                                                <input type="hidden" name="consultation_act_id[]"
                                                       value="{{ $act->consultation_act_idc }}">
                                            </td>
                                            <td>{{ $act->dent }}</td>
                                            <td>{{ $act->prix }} <input type="hidden" name="prix[]" class="prix"
                                                                        value="{{ $act->prix }}"></td>
                                            <td>
                                                <input type="text" class="form-control" data-row="{{ $loop->index }}"
                                                       name="payer_input[]" value="{{ $act->payer ?? '0' }}" readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control payer-input" name="a_payer"
                                                       data-row="{{ $loop->index }}">
                                                <input type="hidden" class="form-control payer-input montant_facture"
                                                       name="payer[]">
                                                <br>
                                                <input type="hidden" class="form-control" name="" id="total">
                                            </td>
                                            <td class="rest-a-payer">
                                                <input type="text" class="form-control rest-a-payer-output"
                                                       name="rest_a_payer[]" value="0" readonly>
                                            </td>
                                            <td class="text-center">
                                                <a class='addObservation' data-toggle="modal"
                                                   data-target="#billingModal"
                                                   data-act-id="{{ $act->consultation_act_idc }}">
                                                    <i class='fas fa-money-check-alt'></i>
                                                </a>
                                                <i class='fas fa-trash delete-icon'
                                                   style='color:red; cursor:pointer;'></i>
                                            </td>
                                        </tr>
                                    @endforeach

                                @endisset
                                </tbody>
                            </table>
                        </fieldset>
                        <span class="float-right" style="display: none;">Total : <b id="total_act_prix">0</b>
                            {{ App\Setting::get_option('currency') }}</span><br>
                        {{--                        <span class="float-right">Total : <b id="total_act">0</b>--}}
                        {{--                            {{ App\Setting::get_option('currency') }}</span><br>--}}
                        <span class="float-right" style="display: none;">Rest a payer : <b id="total_rest_a_payer">0</b>
                            {{ App\Setting::get_option('currency') }}</span><br>
                        {{--                        <span class="float-right">TVA : {{ App\Setting::get_option('vat') }} %</span><br>--}}
                        {{--                        <span class="float-right">Total incl. tax : <b id="total_income">0 </b>--}}
                        {{--                            {{ App\Setting::get_option('currency') }}</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </form>



    <div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="billingModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="billingModalLabel">Paiements</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/template" id="billing_labels">
        <div class="field-group row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="strength">Titre</label>
                    <select type="text" name="invoice_title[]" class="form-control invoice-title"
                            placeholder="{{ __('sentence.Invoice Title') }}" required>
                        <option value="">Sélectionner</option>
                        @foreach($payments as $payment)
                            <option value="{{$payment->name}}"
                                    data-price="{{$payment->price}}">{{$payment->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="amount">{{ __('sentence.Amount') }}</label>
                    <div class="input-group">
                        <input type="number" class="form-control invoice-amount"
                               placeholder="{{ __('sentence.Amount') }}" aria-label="Amount"
                               aria-describedby="basic-addon1" name="invoice_amount[]" value="" required>
                        <div class="input-group-append">
                            <span class="input-group-text"
                                  id="basic-addon1">{{ App\Setting::get_option('currency') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="new_payer">A payer</label>
                    <input type="number" class="form-control new_payer" placeholder="Payer" id="new_payer"
                           name="new_payer[]" required>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Move the "Remove" button code here -->
                <div class="form-group" style="margin-top: 35px;">
                    <a type="button" class="btn rounded-0 btn-danger btn-sm text-white span-2 delete"><i
                            class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                </div>
            </div>
        </div>
    </script>


    <script>
        $(document).ready(function () {
            // Function to validate "A payer" amount
            function validatePayerAmount() {
                let isValid = true;

                // Iterate over each row
                $('.field-group.row').each(function () {
                    let amount = parseFloat($(this).find('.invoice-amount').val());
                    let payer = parseFloat($(this).find('.new_payer').val());

                    // If payer is more than amount, show an error, reset the payer value, and set isValid to false
                    if (payer > amount) {
                        alert("Le montant 'A payer' ne peut pas être supérieur au montant 'Amount'. Il sera réinitialisé.");
                        $(this).find('.new_payer').val(amount);
                        isValid = false;
                        return false; // break the loop
                    }

                    // If payer is less than zero, show an error, reset the payer value, and set isValid to false
                    if (payer < 0) {
                        alert("Le montant 'A payer' ne peut pas être inférieur à zéro. Il sera réinitialisé.");
                        $(this).find('.new_payer').val(amount);
                        isValid = false;
                        return false; // break the loop
                    }
                });

                return isValid;
            }

            // Validate on form submission
            $('form').on('submit', function (e) {
                if (!validatePayerAmount()) {
                    e.preventDefault();
                }
            });

            // Validate when "A payer" field is changed
            $(document).on('change', '.new_payer', function () {
                validatePayerAmount();
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            function updateDueAmount() {
                var chequeAmount = $('#DueAmount').val();
                $('#chequeAmount').val(chequeAmount);
            }
            $('#chequeAmount').on('input', function() {
                var chequeAmount = $('#DueAmount').val();
                var dueAmount = $(this).val();

                if (parseFloat(dueAmount) > parseFloat(chequeAmount)) {
                    $(this).val(chequeAmount);
                }
            });

            $('#PaymentMode').on('change', function() {
                var selectedMode = $(this).val();
                if (selectedMode === 'Chèque') {
                    updateDueAmount();
                } else {
                    $('#DueAmount').val('');
                }
            });
        });

        function handlePaymentModeChange() {
            var paymentMode = document.getElementById('PaymentMode').value;
            var chequeDetails = document.getElementById('chequeDetails');
            if (paymentMode === 'Chèque') {
                chequeDetails.style.display = 'block';
            } else {
                chequeDetails.style.display = 'none';
            }
        }

        function divideAmount() {
            var chequeNumber = document.getElementById('chequeNumber').value;
            var chequeAmount = document.getElementById('chequeAmount').value;
            if (chequeNumber && chequeAmount) {
                var dividedAmount = chequeAmount / chequeNumber;
                // Display the divided amount or process it as needed
            }
        }

        function showChequeModal() {
            var chequeNumber = document.getElementById('chequeNumber').value;
            var chequeAmount = document.getElementById('chequeAmount').value;
            var chequeInfoContainer = document.getElementById('chequeInfo');

            // Start building the table HTML
            var tableHTML = `
        <table class="table">
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Nom d'importer</th>
                    <th>Date d'encaissement</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
    `;

            // Append the rows to the table
            for (var i = 0; i < chequeNumber; i++) {
                tableHTML += `
            <tr>
                <td>
                    <div class="form-group">
                        <label for="reference${i}" class="sr-only">Référence</label>
                        <input type="text" class="form-control" id="reference${i}" name="reference${i}" required>
                    </div>
                </td>
                <td>
                    <input type="text" class="form-control" id="nom_importer${i}" name="nom_importer${i}" required>
                </td>
                <td>
                    <input type="date" class="form-control" id="date_encaissement${i}" name="date_encaissement${i}">
                </td>
                <td>
                    <input type="number" class="form-control" id="montant${i}" name="montant${i}" value="${chequeAmount / chequeNumber}" readonly>
                </td>
            </tr>
        `;
            }

            // Close the table HTML
            tableHTML += `
            </tbody>
        </table>
    `;

            // Set the inner HTML of the container to the table HTML
            chequeInfoContainer.innerHTML = tableHTML;

            // Show the modal
            $('#chequeModal').modal('show');
        }



        function saveChequeInfo() {
            var chequeNumber = document.getElementById('chequeNumber').value;
            var chequeTable = document.getElementById('chequeTable');
            var chequeTableBody = chequeTable.getElementsByTagName('tbody')[0];
            var hiddenChequeInputs = document.getElementById('hiddenChequeInputs');

            chequeTableBody.innerHTML = '';
            hiddenChequeInputs.innerHTML = '';

            for (var i = 0; i < chequeNumber; i++) {
                var reference = document.getElementById(`reference${i}`).value;
                var nomImporter = document.getElementById(`nom_importer${i}`).value;
                var dateEncaissement = document.getElementById(`date_encaissement${i}`).value;
                var montant = document.getElementById(`montant${i}`).value;

                var newRow = chequeTableBody.insertRow();
                var refCell = newRow.insertCell(0);
                var dateCell = newRow.insertCell(1);
                var montantCell = newRow.insertCell(2);

                refCell.innerHTML = reference;
                dateCell.innerHTML = dateEncaissement;
                montantCell.innerHTML = montant;

                hiddenChequeInputs.innerHTML += `
            <input type="hidden" name="cheques[${i}][reference]" value="${reference}">
            <input type="hidden" name="cheques[${i}][nom_importer]" value="${nomImporter}">
            <input type="hidden" name="cheques[${i}][date_encaissement]" value="${dateEncaissement}">
            <input type="hidden" name="cheques[${i}][montant]" value="${montant}">
        `;
            }

            chequeTable.style.display = 'table';
            $('#chequeModal').modal('hide');
        }



    </script>
    <script type="text/javascript">
        $(".billing_labels .repeatable").repeatable({
            addTrigger: ".billing_labels .add",
            deleteTrigger: ".billing_labels .delete",
            template: "#billing_labels",
            startWith: 1,
            max: 5,
            afterAdd: function () {
                // Use class selectors to find elements relative to the added template
                $(".invoice-title").on("change", function () {
                    var selectedOption = $(this).find("option:selected");
                    var price = selectedOption.data("price");
                    // Find the corresponding input element within the same row
                    var priceInput = $(this).closest(".field-group.row").find(".invoice-amount");
                    var payer = $(this).closest(".field-group.row").find(".new_payer");
                    priceInput.val(price);
                    payer.val(price);
                });
            }
        });
        // document.getElementById('PaymentMode').addEventListener('change', function() {
        //     var chequeButton = document.getElementById('chequeButton');
        //     if (this.value === 'Chèque') {
        //         chequeButton.classList.remove('d-none');
        //     } else {
        //         chequeButton.classList.add('d-none');
        //     }
        // });
        //
        // document.getElementById('chequeButton').addEventListener('click', function(event) {
        //     event.preventDefault();
        // });
        //
        // document.getElementById('addChequeDetail').addEventListener('click', function() {
        //     var container = document.getElementById('chequeDetailsContainer');
        //     var newDetail = document.createElement('div');
        //     newDetail.classList.add('cheque-detail');
        //     newDetail.innerHTML = `
        //         <div class="form-group">
        //             <label for="chequeReference">Référence</label>
        //             <input type="text" class="form-control" name="cheque_reference[]">
        //         </div>
        //         <div class="form-group">
        //             <label for="chequeDate">Date</label>
        //             <input type="date" class="form-control" name="cheque_date[]">
        //         </div>
        //         <div class="form-group">
        //             <label for="chequeAmount">Montant</label>
        //             <input type="number" class="form-control" name="cheque_amount[]" step="0.01">
        //         </div>
        //         <div class="form-group d-flex justify-content-end">
        //             <button type="button" class="btn btn-danger remove-detail">Delete</button>
        //         </div>`;
        //     container.appendChild(newDetail);
        //     newDetail.querySelector('.remove-detail').addEventListener('click', function() {
        //         newDetail.remove();
        //     });
        // });
        //
        // document.getElementById('saveChequeDetails').addEventListener('click', function() {
        //     var chequeDetails = [];
        //     document.querySelectorAll('.cheque-detail').forEach(function(detail) {
        //         var reference = detail.querySelector('[name="cheque_reference[]"]').value;
        //         var date = detail.querySelector('[name="cheque_date[]"]').value;
        //         var amount = detail.querySelector('[name="cheque_amount[]"]').value;
        //         chequeDetails.push({ reference, date, amount });
        //     });
        //     document.getElementById('chequeDetails').value = JSON.stringify(chequeDetails);
        //     $('#chequeModal').modal('hide');
        // });
        //
        // document.querySelectorAll('.remove-detail').forEach(function(button) {
        //     button.addEventListener('click', function() {
        //         button.closest('.cheque-detail').remove();
        //     });
        // });
        </script>
        <script>
        $(document).ready(function () {
            // Iterate over each row
            $('.table-row').each(function () {
                var row = $(this);
                var payerInput = row.find('#payer');
                var prixInput = row.find('#prix');
                var aPayerInput = row.find('#a_payer');
                var montantFactureInput = row.find('.montant_facture'); // Added this line
                var inputTotal = row.find('#total');

                var payerValue = parseFloat(payerInput.val()) || 0;
                var prixValue = parseFloat(prixInput.val()) || 0;
                var newValue = parseInt(prixValue - payerValue, 10);

                var totalValue = parseInt(payerValue + newValue, 10);

                aPayerInput.val(newValue);
                montantFactureInput.val(newValue); // Added this line
                inputTotal.val(totalValue);
            });
        });
        $(document).ready(function () {
            $('.payer-input').on('input', function () {
                var row = $(this).closest('tr');  // Get the closest row
                var prix = parseFloat(row.find('.prix').val());
                var a_payer = parseFloat($(this).val());

                // Validate that "A payer" is not greater than "prix"
                if (a_payer > prix) {
                    alert('Le montant à payer ne peut pas être supérieur au prix.');
                    $(this).val(prix);
                }

                // Validate that "A payer" is not less than zero
                if (a_payer < 0) {
                    alert('Le montant à payer ne peut pas être inférieur à zéro.');
                    $(this).val(prix);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            setInterval(function () {
                // Calculate and update total_without_tax_income from billing_labels
                var totalPoints = 0;
                $('.billing_labels').each(function () {
                    $(this).find('input[aria-label="Amount"]').each(function () {
                        if ($(this).val() !== '') {
                            totalPoints += parseFloat($(this).val());
                        }
                    });
                    $('#total_without_tax_income').text(totalPoints);

                });

                // Calculate and update total_act_prix from act_labels
                var total_act_prix = 0;
                // Iterate through each row in the table
                $('.act_labels table tbody tr').each(function () {
                    // Get the price from the current row
                    var restAPayerInput = $(this).find('input[name="rest_a_payer[]"]');
                    var restAPayer = parseFloat(restAPayerInput.val());

                    // Add the rest_a_payer to the total_act_prix (check for NaN to avoid issues)
                    if (!isNaN(restAPayer)) {
                        total_act_prix += restAPayer;
                    }
                });

                var totalDueAmount = 0;

                $('.table-row').each(function () {
                    var row = $(this);

                    // Get the value from the #prix input
                    var prixInput = row.find('#prix');
                    var prixValue = parseFloat(prixInput.val()) || 0;

                    // Get the value from the .invoice-amount input
                    var invoiceAmountInput = row.find('.invoice-amount');
                    var invoiceAmountValue = parseFloat(invoiceAmountInput.val()) || 0;

                    // Add both values to totalDueAmount
                    totalDueAmount += prixValue + invoiceAmountValue;
                });

                // Add totalPoints and totalDueAmount
                var totalAmount = totalPoints + totalDueAmount;

                // Update the total DueAmount in the #DueAmount element
                $('#DueAmount').val(totalAmount.toFixed(2));

                // Add total_without_tax_income to total_act_prix
                total_act_prix += parseFloat($('#total_without_tax_income').text());

                // Update the total_act_prix in the #total_act_prix element
                $('#total_act_prix').text(total_act_prix.toFixed(2));

            }, 1000);
        });
    </script>

    <script>
        $(document).ready(function () {
            // Function to update deposited_amount input
            function updateDepositedAmount() {
                // Get all values from the a_payer inputs and multiply them
                var totalAPayerValue = 0;
                $('input[name="a_payer"]').each(function () {
                    var aValue = parseFloat($(this).val()) || 0;
                    totalAPayerValue += aValue;
                });

                // Add the values from the new_payer inputs
                $('.new_payer').each(function () {
                    var newPayerValue = parseFloat($(this).val()) || 0;
                    totalAPayerValue += newPayerValue;
                });

                // Set the total value to the deposited_amount input
                $('#DepositedAmount').val(totalAPayerValue);
            }

            // Set initial interval
            var updateInterval = setInterval(updateDepositedAmount, 1000);

            // Event listener for DepositedAmount focus
            $('#DepositedAmount').on('focus', function () {
                // Clear the interval when the input is focused
                clearInterval(updateInterval);
            });

            // // Event listener for DepositedAmount blur
            // $('#DepositedAmount').on('blur', function () {
            //     // Re-enable the interval when the input loses focus
            //     updateInterval = setInterval(updateDepositedAmount, 1000);
            // });
        });
    </script>



    <script>
        $(document).ready(function () {
            updateRestAPayer(); // Initial calculation

            // Listen for input changes in the 'payer-input' fields
            $('tbody').on('input', '.payer-input', function () {
                updateRestAPayer();
            });


            function updateRestAPayer() {
                // Iterate through each row in the table
                $('tbody tr').each(function () {
                    var rowIndex = $(this).index();

                    // Get the price from the current row
                    var priceText = $(this).find('td:eq(4)').text();
                    var price = parseFloat(priceText.replace(/[^\d.]/g, '')) || 0;

                    // Get the payer value from the current row
                    var payer = parseFloat($(this).find('.payer').val()) || 0;

                    // Get the payer-input value from the current row
                    var payerInput = parseFloat($(this).find('.payer-input').val()) || 0;

                    // Calculate the difference and update the rest_a_payer input
                    var restAPayer = price - payerInput;
                    // $(this).find('.rest-a-payer-output').val(restAPayer.toFixed(2));
                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            // Bind an input event to the payer and a_payer inputs
            $('tbody').on('input', '.payer-input, [name="payer[]"], [name="rest_a_payer[]"]', function () {
                // Get the current row
                var row = $(this).closest('tr');

                // Get values from the current row
                var payer = parseFloat(row.find('[id="payer"]').val()) || 0;
                var a_payer = parseFloat(row.find("[id=a_payer]").val()) || 0;
                var prix = parseFloat(row.find('[id="prix"]').val()) || 0;

                // Calculate the rest_a_payer value
                var rest_a_payer = prix - a_payer;
                var total = payer + a_payer;

                // Update the rest_a_payer input in the current row
                row.find('.rest-a-payer-output').val(rest_a_payer.toFixed(2));

                // Update the montant_facture input in the current row with the value of payer
                row.find('.montant_facture').val(a_payer);

                // Update the total input in the current row
                row.find('[id="total"]').val(total.toFixed(2));
            });
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
                })// Refresh the page
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.addObservation').click(function () {
                var actId = $(this).data('act-id');
                console.log(actId);

                // AJAX request
                $.ajax({
                    url: '/fetch/' + actId,
                    type: 'GET',
                    success: function (data) {
                        if (data.length === 0) {
                            // If no data, display a message
                            var modalBody = $('#billingModal .modal-body');
                            modalBody.html('<p>Pas de données disponibles.</p>');
                            $('#billingModal').modal('show');
                        } else {
                            // Extract payer value from the returned HTML
                            var payerValues = data.map(item => parseFloat(item.payer));
                            var date = data[0].created_at; // Assuming all data objects have the same date

                            // Update modal body with the payer values and differences
                            var modalBody = $('#billingModal .modal-body');
                            modalBody.empty(); // Clear existing content, if any

                            var currencySymbol = '{{ App\Setting::get_option('currency') }}';
                            var previousValue = 0; // Initialize the previous value

                            // Append each object in the data array to the modal body
                            for (var i = 0; i < data.length; i++) {
                                var currentValue = payerValues[i];

                                // Calculate the difference from the previous value
                                var difference = currentValue - previousValue;

                                // Update the previous value for the next iteration
                                previousValue = currentValue;

                                modalBody.append('<p>Payé: ' + difference + ' ' + currencySymbol + '</p>');
                                var formattedDate = new Date(data[i].created_at).toLocaleDateString('fr-FR', {
                                    year: 'numeric',
                                    month: 'numeric',
                                    day: 'numeric'
                                });
                                modalBody.append('<p>La date: ' + formattedDate + '</p>');
                                modalBody.append('<hr>');
                            }

                            // Open the modal
                            $('#billingModal').modal('show');
                        }
                    },
                    error: function (error) {
                        // Handle error
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <!-- Add this script to your HTML -->
    <script>
        $(document).ready(function () {
            // Delete icon click event
            $('.delete-icon').on('click', function () {
                // Get the parent row
                var row = $(this).closest('.table-row');

                // Remove the row
                row.remove();

                // Update calculations (you can reuse your existing code)
                updateCalculations();
            });

            // Function to update calculations
            function updateCalculations() {
                // Iterate over each row
                $('.table-row').each(function () {
                    var row = $(this);
                    var payerInput = row.find('#payer');
                    var prixInput = row.find('#prix');
                    var aPayerInput = row.find('#a_payer');
                    var montantFactureInput = row.find('.montant_facture');
                    var inputTotal = row.find('#total');

                    var payerValue = parseFloat(payerInput.val()) || 0;
                    var prixValue = parseFloat(prixInput.val()) || 0;
                    var newValue = parseInt(prixValue - payerValue, 10);

                    var totalValue = parseInt(payerValue + newValue, 10);

                    aPayerInput.val(newValue);
                    montantFactureInput.val(newValue);
                    inputTotal.val(totalValue);
                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            // Function to update payment status based on deposited and due amounts
            function updatePaymentStatus() {
                var depositedAmount = parseFloat($('#DepositedAmount').val()) || 0;
                var dueAmount = parseFloat($('#DueAmount').val()) || 0;
                var paymentStatusSelect = $('select[name="payment_status"]');

                if (depositedAmount === dueAmount) {
                    paymentStatusSelect.val('Paid');
                } else if (depositedAmount > 0 && depositedAmount < dueAmount) {
                    paymentStatusSelect.val('Partially Paid');
                } else {
                    paymentStatusSelect.val('Unpaid');
                }
            }

            // Attach change event listeners to DepositedAmount and DueAmount
            $('#DepositedAmount, #DueAmount').on('input', function () {
                updatePaymentStatus();
            });

            // Set interval to periodically update payment status
            var updateInterval = setInterval(updatePaymentStatus, 1000); // Adjust the interval duration as needed

            // Clear the interval when the document is unloaded to avoid memory leaks
            $(window).on('unload', function () {
                clearInterval(updateInterval);
            });

            // Initial update when the page loads
            updatePaymentStatus();
        });

    </script>






    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

@endsection
@section('header')
@endsection
