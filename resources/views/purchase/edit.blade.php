@extends('layouts.master')

@section('title')
    Ajouter un achat
@endsection


@section('header')
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            width: inherit;
            /* Or auto */
            padding: 0 10px;
            /* To give a bit of padding on the left and right */
            border-bottom: none;
        }

        .my__text__thead {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un achat</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('purchase.store_edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="myid" value="{{ $purchase->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="my__label">Nom du fournisseur <span class="text-danger">*</span></label>
                                <select name="fournisseur" id="fournisseur"
                                    class="form-control rounded-0 shadow-none js-example-basic-single">
                                    @foreach ($fournisseurs as $fournisseur)
                                        @if ($fournisseur->id == old('fournisseur') || $fournisseur->id == $purchase->fournisseur_id)
                                            <option value="{{ $fournisseur->id }}" selected>
                                                {{ $fournisseur->name }}
                                            </option>
                                        @else
                                            <option value="{{ $fournisseur->id }}">
                                                {{ $fournisseur->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group  col-md-6">
                                <label for="inputPassword4" class="my__label">Date d'achat <span class="text-danger">*</span></label>
                                <input type="date" name="purchase_date" id="purchase_date"
                                    class="form-control rounded-0 shadow-none"
                                    value="{{ old('purchase_date') ?? $purchase->purchase_date }}">

                            </div>
                        </div>

                        <div class="form-row row d-flex justify-content-center">
                            <div class="col-8">
                                <label for="" class="my__label">Articles <span class="text-danger">*</span></label>
                                <select class="form-control rounded-0 multiselect-doctorino shadow-none" name="user_id"
                                    id="item" style="padding: 20px;">
                                    <option value="">Selectionner un items</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}" data-sale_price="{{ $item->sale_price }}"
                                            data-puchase_price="{{ $item->purchase_price }}"
                                            data-unit="{{ $item->unit }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="my__items__list">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                        cellspacing="0">
                                        <thead class="bg-gradient-primary text-light">
                                            <tr>
                                                <th class="my__text__thead text-center">Article</th>
                                                <th class="my__text__thead text-center">Unité</th>
                                                <th class="my__text__thead text-center">Prix d'achat</th>
                                                <th class="my__text__thead text-center">Quantité</th>
                                                <th class="my__text__thead text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class='tbody'>
                                            @foreach ($purchase->items as $purchaseItem)
                                                <tr data-item-id="{{ $purchaseItem->id }}">
                                                    <!-- Populate other columns based on the structure of your items table -->
                                                    <td width='40%' class="text-center">{{ $purchaseItem->name }}

                                                        <input type="hidden" name="item_id[]"
                                                            value="{{ $purchaseItem->id }}">
                                                    </td>
                                                    <td width='20%' class="text-center">{{ $purchaseItem->unit }}</td>
                                                    <td width='20%' class="text-center">
                                                        {{ $purchaseItem->purchase_price }}</td>

                                                    <td width='20%' class="text-center">
                                                        <input type="number" name="quantity[]"
                                                            class="form-control qty rounded-0 shadow-none text-center "
                                                            min="1" value="{{ $purchaseItem->pivot->quantity }}">

                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm rounded-circle shadow-none text-center"
                                                            onclick="deleteRow(this)">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <h5>Plus de détails</h5>
                                {{-- <p>Quantités totales : <span id="totalQuantity"></span></p> --}}


                                <div class="row g-3 mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="" class="col-form-label my__label">TVA : </label>
                                    </div>
                                    <div class="col-8   ">
                                        <input type="text" id="TVA" name="tva"
                                            class="form-control rounded-0 shadow-none"
                                            value="{{ old('tva') ?? $purchase->TVA }}">
                                    </div>
                                    <div class="col-auto">
                                        <span id="" class="form-text">
                                            %
                                        </span>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="" class="col-form-label my__label">Type de paiement:
                                        </label>
                                    </div>
                                    <div class="col-9">
                                        <select name="typePayment" id="typePayment"
                                            class="form-control rounded-0 shadow-none w-100">

                                            <option value="Espéce"
                                                {{ $purchase->type_pay == 'Espéce' ? 'selected' : '' }}>
                                                Espéce
                                            </option>
                                            <option value="Chéque" data-ref="true"
                                                {{ $purchase->type_pay == 'Chéque' ? 'selected' : '' }}>
                                                Chéque
                                            </option>
                                            <option value="Virement" data-ref="true"
                                                {{ $purchase->type_pay == 'Virement' ? 'selected' : '' }}>
                                                Virement
                                            </option>
                                            <option value="TPE" data-ref="true"
                                                {{ $purchase->type_pay == 'TPE' ? 'selected' : '' }}>
                                                TPE
                                            </option>

                                        </select>
                                    </div>

                                </div>




                            </div>
                            <div class="col-lg-6 col-md-12 mt-5">
                                <table class=" " width='100%'>
                                    <tr>
                                        <td class="text-right pr-4">
                                            Total
                                        </td>
                                        <td>:</td>
                                        <td class="text-center"><span id="total">0</span> DH</td>

                                    </tr>
                                    <tr>
                                        <td class="text-right pr-4">TVA</td>
                                        <td>:</td>
                                        <td class="text-center"><span id="tva">0</span> DH</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right pr-4">Somme final</td>
                                        <td>:</td>
                                        <td class="text-center"><span id="finalAmountt">0</span> DH
                                            <input type="hidden" name="finalAmount" id="finalAmount" value="0">
                                        </td>
                                </table>
                            </div>
                        </div>


                        <div class="row     ">

                            <div class="row col-6">
                                <div class="col-3">
                                    <label for="" class="col-form-label my__label">Remarque : </label>
                                </div>
                                <div class="col-9   ">
                                    <textarea name="note" class="form-control rounded-0 shadow-none"></textarea>
                                </div>
                            </div>

                        </div>


                        <div class="row mt-3">
                            <div class="form-row col-12  ">
                                <div class="form-group col-md-6">
                                    <label for="" class="my__label">Facture</label>
                                    <br>


                                    @empty(!$purchase->facture)
                                        <div class="row-form  d-flex align-items-center ">
                                            <input type="text" value="{{ $purchase->facture }}" disabled
                                                class="form-control shadow-none col-11 mr-2 rounded-0"
                                                style="margin-bottom: 7px">

                                            {{-- here should i delete the old one make a button to do this --}}
                                            <button class="btn btn-danger btn-sm ml-2 " type="submit" name='deleteFacture'>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    @else
                                        <label for="file-upload-facture" class="custom-file-upload w-100">
                                            <i class="fa fa-cloud-upload"></i> Selectionner votre facture ...
                                        </label>
                                        <input type="file" class="form-control shadow-none" id="file-upload-facture"
                                            name="facture">
                                    @endempty
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" class="my__label">Bon livraison</label>
                                    <br>
                                    @empty(!$purchase->bon_livraison)
                                        <div class="row-form  d-flex align-items-center ">
                                            <input type="text" value="{{ $purchase->bon_livraison }}" disabled
                                                class="form-control shadow-none col-11 mr-2 rounded-0"
                                                style="margin-bottom: 7px">

                                            {{-- here should i delete the old one make a button to do this --}}
                                            <button class="btn btn-danger btn-sm ml-2 " type="submit" name='deleteBon'>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    @else
                                        <label for="file-upload-bon_livraison" class="custom-file-upload w-100">
                                            <i class="fa fa-cloud-upload"></i> Selectionner votre bon livraison ...
                                        </label>
                                        <input type="file" class="form-control shadow-none" id="file-upload-bon_livraison"
                                            name="bon_livraison">
                                    @endempty
                                </div>
                            </div>
                        </div>

                        <input type="hidden" value="{{ $purchase->ref_pay }}" id="reff">

                        <input type="hidden" value="{{ $purchase->recu }}" id='recu_id'>




                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary rounded-0" value="Suvegarder">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#item').select2({
                selectionCssClass: 'my__input__class'
            });

            $('#fournisseur').select2({
                selectionCssClass: 'my__input__class'
            });


        });
    </script>
    <script type="text/javascript">
        // Event listener using jQuery

        $(document).ready(function() {
            const $item = $('#item');
            const $tbody = $('.tbody');
            const $totalQuantityDiv = $('#totalQuantity');
            let totalQuantity = 0;

            $item.on('change', function() {
                const selectedValue = $item.val();
                const existingItem = $tbody.children(`tr[data-item-id="${selectedValue}"]`);

                if (!existingItem.length) {
                    const $tr = $('<tr>', {
                        'data-item-id': selectedValue,
                        html: `
                        <td class='text-center width='40%'>${$item.find('option:selected').text()}
                            <input type="hidden" name="item_id[]" value="${selectedValue}">
                        </td>
                        <td class='text-center width='20%'>${$item.find('option:selected').data('unit')}</td>
                        <td class='text-center' width='20%'>${$item.find('option:selected').data('puchase_price')}</td>
                        <td>
                            <input type="number" name="quantity[]" min="1" class="form-control qty rounded-0 shadow-none text-center" value="1">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm rounded-circle shadow-none text-center" onclick="deleteRow(this)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    `,
                    });

                    totalQuantity += 1;
                    $tbody.append($tr);
                    updateTotalQuantity();
                }
            });

            $tbody.on('input', '.qty', function() {
                totalQuantity = $tbody.find('.qty').toArray().reduce((total, input) => {
                    return total + parseInt($(input).val(), 10) || 0;
                }, 0);

                updateTotalQuantity();
            });

            $(document).ready(function() {
                updateTotals();
                updateTotalQuantity();
            });

            $(document).on('click', '.btn-danger', function() {
                const $row = $(this).closest('tr');
                totalQuantity -= parseInt($row.find('.qty').val(), 10);
                $row.remove();
                updateTotalQuantity();
            });

            $('#TVA').on('input', updateTotals);

            function updateTotalQuantity() {
                $totalQuantityDiv.text(`${totalQuantity}`);
                updateTotals();
            }

            function updateTotals() {
                const totalAmount = $tbody.find('tr').toArray().reduce((total, row) => {
                    const quantity = parseInt($(row).find('.qty').val(), 10) || 0;
                    const purchasePrice = parseFloat($(row).find('td:nth-child(3)').text());
                    return total + quantity * purchasePrice;
                }, 0);

                const tvaValue = parseFloat($('#TVA').val()) || 0;
                const tvaAmount = (totalAmount * tvaValue) / 100;

                $('#total').text(` ${totalAmount.toFixed(2)}`);
                $('#tva').text(` ${tvaAmount.toFixed(2)}`);
                $('#finalAmountt').text(` ${(totalAmount + tvaAmount).toFixed(2)}`);
                $('#finalAmount').val(` ${(totalAmount + tvaAmount).toFixed(2)}`);
            }
        });




        document.addEventListener('DOMContentLoaded', (event) => {
            const typePayment = document.getElementById('typePayment');
            const reff = document.getElementById('reff');
            const bon_livraison_id = document.getElementById('bon_livraison_id');

            // Define a function to simulate the input event
            const simulateInputEvent = () => {
                const selectedValue = typePayment.value;
                const option = typePayment.options[typePayment.selectedIndex];

                // Remove any existing reference div
                const existingRefDiv = typePayment.closest('.row').nextElementSibling;
                if (existingRefDiv) {
                    existingRefDiv.remove();
                }

                // Add a new reference div if the selected option has a 'data-ref' attribute
                if (option.dataset.ref) {
                    const div = document.createElement('div');
                    div.classList.add('row', 'g-3', 'mb-2', 'align-items-center');
                    div.innerHTML = `
                <div class="col-3 ">
                    <label for="" class="col-form-label my__label">Référence ${selectedValue} : </label>
                </div>
                <div class="col-9 mb-2">
                    <input type="text" name="reference" class="form-control rounded-0 shadow-none"
                    value="${reff.value}">

                </div>

                ${recu_id.value ? `
                                                                                                                                                                                                                                                                            <div class="col-3">
                                                                                                                                                                                                                                                                                <label for="" class="my__label">Reçu ${selectedValue} : </label>
                                                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                                                                            <div class="row-form  d-flex align-items-center  col-9">
                                                                                                                                                                                                                                                                                                <input type="text" value="${recu_id.value}" disabled
                                                                                                                                                                                                                                                                                                    class="form-control shadow-none col-11 mr-2 rounded-0"
                                                                                                                                                                                                                                                                                                    style="margin-bottom: 7px">

                                                                                                                                                                                                                                                                                                <button class="btn btn-danger btn-sm ml-2 " type="submit"
                                                                                                                                                                                                                                                                                                    name='deleteRecu'>
                                                                                                                                                                                                                                                                                                    <i class="fa fa-trash"></i>
                                                                                                                                                                                                                                                                                                </button>



                                                                                                                                                                                                                                                                            ` : ` <div class="col-3">
                                                                                                                                                                                                                                                                                    <label for="" class="my__label">Reçu ${selectedValue} : </label>
                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                <br>
                                                                                                                                                                                                                                                                                <div class="col-9">
                                                                                                                                                                                                                                                                                    <label for="Recu" class="custom-file-upload w-100">
                                                                                                                                                                                                                                                                                        <i class="fa fa-cloud-upload"></i> Selectionner votre Reçu ...
                                                                                                                                                                                                                                                                                    </label>
                                                                                                                                                                                                                                                                                    <input type="file" class="form-control shadow-none" id="Recu" name="Recu">
                                                                                                                                                                                                                                                                                </div>`}

            `;

                    typePayment.closest('.row').after(div);
                }
            };

            // Attach the event listener
            typePayment.addEventListener('input', simulateInputEvent);

            // Simulate the input event to populate the page initially
            simulateInputEvent();
        });


        const typePayment = document.getElementById('typePayment');
        typePayment.addEventListener('input', () => {
            const selectedValue = typePayment.value;
            const option = typePayment.options[typePayment.selectedIndex];

            // Remove any existing reference div
            const existingRefDiv = typePayment.closest('.row').nextElementSibling;
            if (existingRefDiv) {
                existingRefDiv.remove();
            }

            // Add a new reference div if the selected option has a 'data-ref' attribute
            if (option.dataset.ref) {
                const div = document.createElement('div');
                div.classList.add('row', 'g-3', 'mb-2', 'align-items-center');
                div.innerHTML = `
            <div class="col-3 ">
                <label for="" class="col-form-label my__label">Référence ${selectedValue} : </label>
            </div>
            <div class="col-9 mb-2">
                <input type="text" name="reference" class="form-control rounded-0 shadow-none">
            </div>
            <div class="col-3">

            <label for="" class="my__label">Recu ${selectedValue} : </label></div>
                                    <br>
                                    <div class="col-9">
                                    <label for="Recu" class="custom-file-upload w-100">
                                        <i class="fa fa-cloud-upload"></i> Selectionner votre Recu ...
                                    </label>
                                    <input type="file" class="form-control shadow-none" id="Recu"
                                        name="Recu">
            </div>
        `;

                typePayment.closest('.row').after(div);
            }
        });
    </script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
