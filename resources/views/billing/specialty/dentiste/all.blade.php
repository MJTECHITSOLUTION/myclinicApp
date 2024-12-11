
@section('content')
    <!-- DataTables  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">List des Paiements</h6>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {{--                        <label for="PatientID" class="my__label">{{ __('sentence.Patient') }} :</label>--}}
                        <select class="form-control" name="user_id" id="PatientID">
                            <option value="">{{ __('sentence.Select Patient') }}</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                        {{ csrf_field() }}
                    </div>
                </div>
                <div class="col-6">
                    <form action="{{ route('billing.search') }}" method="GET" class="form-inline float-right">
                        <div class="form-group mx-2">
                            <label for="reference" class="sr-only">{{ __('Reference') }}</label>
                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Référence de la consultation">
                        </div>
                        <div class="form-group mx-2">&nbsp; Du:
                            <label for="start_date" class="sr-only">{{ __('Start Date') }}</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ date('Y-d-m') }}" placeholder="{{ __('Start Date') }}">
                        </div>
                        <div class="form-group mx-2">&nbsp; Ou:
                            <label for="end_date" class="sr-only">{{ __('End Date') }}</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="{{ __('End Date') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('sentence.Search') }}</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ __('sentence.Reference') }} Paiements </th>
                        <th>{{ __('sentence.Patient') }}</th>
                        <th>{{ __('sentence.Date') }}</th>
                        <th class="text-center">Montant - <font class="text-danger">(Rest à payé)
                            </font>
                        </th>
                        <th class="text-center">{{ __('sentence.Status') }}</th>
                        <th class="text-center">{{ __('sentence.Payment Method') }}</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>

                            <td>{{ $invoice->reference }}</td>
                            <td><a href="{{ url('patient/view/' . $invoice->user_id) }}"> {{ $invoice->User->name }}
                                </a></td>
                            <td>{{ $invoice->created_at->format('d M Y') }}</td>
                            @php
                                $paymentRecord = $sumPayments->where('billing_id', $invoice->id)->first();
                                $remainingPayment = optional($paymentRecord)->total_payment ?? 0;
                            @endphp
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-id="{{ $invoice->id }}" data-target="#paymentDetailsModal">
                                    @if($remainingPayment == 0)
                                        {{ $invoice->deposited_amount }}
                                    @else
                                        {{ $remainingPayment}}
                                    @endif / {{ $invoice->total_without_tax }}
                                    {{ App\Setting::get_option('currency') }}
                                    <span class="badge badge-danger-soft">
                                    {{ $invoice->due_amount - $remainingPayment }}
                                        {{ App\Setting::get_option('currency') }}
                                </span>
                                </a>
                            </td>

                            <td class="text-center">
                                @if($invoice->payment_status == 'Paid')
                                    <label class="badge badge-success-soft">
                                        <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                    </label>
                                @elseif ($remainingPayment == 0)

                                    <label class="badge badge-danger-soft">
                                        <i class="fas fa-hourglass-start"></i> {{ __('sentence.Unpaid') }}
                                    </label>
                                @elseif ($remainingPayment == $invoice->total_without_tax)
                                    <label class="badge badge-success-soft">
                                        <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                    </label>
                                @else
                                    <label class="badge badge-warning-soft">
                                        <i class="fas fa-hourglass-start"></i> {{ __('sentence.Partially Paid') }}
                                    </label>
                                @endif
                            </td>

                            @if($invoice->payment_mode == 'Chèque')
                                <td class="text-center">
                                    <label class="badge badge-primary-soft" data-invoice-id="{{ $invoice->id }}">
                                        <i class="fa fa-handshake"></i> {{ $invoice->payment_mode }}
                                    </label>
                                </td>
                            @else
                                <td class="text-center"><label class="badge badge-primary-soft"><i class="fa fa-handshake"></i> {{ $invoice->payment_mode }}</label></td>
                            @endif
                            <td class="text-center">
{{--                                @can('view invoice')--}}
{{--                                    <a href="{{ url('billing/view/' . $invoice->id) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>--}}
{{--                                @endcan--}}

                                {{-- Only show edit button if the invoice is not paid --}}
{{--                                @if ($remainingPayment == 0)--}}
{{--                                    @can('edit invoice')--}}
{{--                                        <a href="{{ url('billing/edit/' . $invoice->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>--}}
{{--                                    @endcan--}}
{{--                                @endif--}}



                                    @if(!($remainingPayment == $invoice->due_amount))
                                        @can('edit invoice')
                                            <a href="{{ url('billing/reglement/' . $invoice->id) }}" class="btn btn-outline-info btn-circle btn-sm"><i class="fas fa-dollar-sign my-custom-class" title="Règlement"></i></a>
                                        @endcan
                                    @endif
                                    @can('edit invoice')
                                        <a href="{{ url('prescription/view/' . $invoice->prescriptions_id) }}"
                                           class="btn btn-outline-dark btn-circle btn-sm"><i class="far fa-file-alt"
                                                                                             title="Consultation"></i></a>
                                    @endcan
                                @can('view invoice')
                                    @if($invoice->facture == 1)
                                        <a href="{{ url('/billing/false_facture/' . $invoice->id) }}" class="btn btn-outline-danger btn-circle btn-sm" ><svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
                                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                            </svg></a>
                                    @else
                                        <a href="{{ url('/billing/facture/' . $invoice->id) }}" class="btn btn-outline-success btn-circle btn-sm" ><svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
                                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                            </svg></a>
                                    @endif

                                @endcan
                                @can('delete invoice')
                                    <a data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('billing/delete/' . $invoice->id) }}" class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
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
{{--                //cheque modele--}}
                <div class="modal fade" id="chequeDetailsModal" tabindex="-1" role="dialog" aria-labelledby="chequeDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="chequeDetailsModalLabel">Détails</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Content will be filled by AJAX -->
                                <div id="chequeDetailsContent"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="float-right mt-3">{{ $invoices->links() }}</span>

            </div>
        </div>
    </div>
@endsection
@section('footer')
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

        //cheque
        $(document).ready(function() {
            $('.badge-primary-soft').on('click', function() {
                var invoiceId = $(this).data('invoice-id');

                $.ajax({
                    url: '/getChequeDetails',
                    type: 'GET',
                    data: { id: invoiceId },
                    success: function(response) {
                        var tableContent = '<table class="table table-bordered"><thead><tr><th>Référence</th><th>Date Encaissement</th><th>Montant</th><th>Nom Importer</th></tr></thead><tbody>';

                        response.forEach(function(cheque) {
                            tableContent += '<tr>';
                            tableContent += '<td>' + cheque.reference + '</td>';
                            tableContent += '<td>' + cheque.encaissementdate + '</td>';
                            tableContent += '<td>' + cheque.amount_cheque + '</td>';
                            tableContent += '<td>' + cheque.importer + '</td>';
                            tableContent += '</tr>';
                        });

                        tableContent += '</tbody></table>';

                        $('#chequeDetailsContent').html(tableContent);
                        $('#chequeDetailsModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });


    </script>

    {{--    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>--}}
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

@endsection
@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection



