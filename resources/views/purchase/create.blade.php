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

                    <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="my__label">Nom du fournisseur <span class="text-danger">*</span></label><br>
                                <select name="fournisseur" id="fournisseur"
                                    class="form-control rounded-0 shadow-none js-example-basic-single">
                                    @foreach ($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group  col-md-6">
                                <label for="inputPassword4" class="my__label">Date d'achat <span class="text-danger">*</span></label>
                                <input type="date" name="purchase_date" id="purchase_date"
                                    class="form-control rounded-0 shadow-none">
                            </div>
                        </div>

                        <div class="form-row row d-flex justify-content-center">
                            <div class="col-8">
                                <label for="" class="my__label">Articles <span class="text-danger">*</span></label>
                                <select class="form-control rounded-0 multiselect-doctorino shadow-none" name="user_id"
                                    id="item" required style="padding: 20px;">
                                    <option value=""> Selectionner un items </option>
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

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <h5>Plus de détails</h5>
                                <p>Quantités totales : <span id="totalQuantity"></span></p>


                                <div class="row g-3 mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="" class="col-form-label my__label">TVA : </label>
                                    </div>
                                    <div class="col-8   ">
                                        <input type="text" id="TVA" name="tva" value="20"
                                            class="form-control rounded-0 shadow-none">
                                    </div>
                                    <div class="col-auto">
                                        <span id="" class="form-text">
                                            %
                                        </span>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="" class="col-form-label my__label">Type de paiement: </label>
                                    </div>
                                    <div class="col-9">
                                        <select name="typePayment" id="typePayment"
                                            class="form-control rounded-0 shadow-none w-100">
                                            <option value="Espéece">Espéce</option>
                                            <option value="Chéque" data-ref="true">Chéque</option>
                                            <option value="Virement" data-ref="true">Virement</option>
                                            <option value="TPE" data-ref="true">TPE</option>
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

                        <div class="row">
                            <div class="form-row col-md-6 col-12">
                                <div class="col-3">
                                    <label for="" class=" my__label">Remarque : </label>
                                </div>
                                <div class="col-12   ">
                                    <textarea name="note" class="form-control rounded-0 shadow-none"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-row col-12  ">
                                <div class="form-group col-md-6">
                                    <label for="" class="my__label">Facture</label>
                                    <br>
                                    <label for="file-upload-facture" class="custom-file-upload w-100">
                                        <i class="fa fa-cloud-upload"></i> Selectionner votre facture ...
                                    </label>
                                    <input type="file" class="form-control shadow-none" id="file-upload-facture"
                                        name="facture">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" class="my__label">Bon livraison</label>
                                    <br>
                                    <label for="file-upload-bon-livraison" class="custom-file-upload w-100">
                                        <i class="fa fa-cloud-upload"></i> Selectionner votre bon livraison ...
                                    </label>
                                    <input type="file" class="form-control shadow-none" id="file-upload-bon-livraison"
                                        name="bon_livraison">
                                </div>
                            </div>
                        </div>




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
                width: '100%', // Adjust the width as needed
                placeholder: 'Search for an item',
                allowClear: true
            });

            $('#fournisseur').select2({
                selectionCssClass: 'my__input__class'
            });


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            const $item = $('#item');
            const $tbody = $('.tbody');
            const $totalQuantityDiv = $('#totalQuantity');
            const $tvaInput = $('#TVA');
            const $typePayment = $('#typePayment');

            // Initialize total quantity
            let totalQuantity = 0;

            $item.on('change', function() {
                const selectedValue = $item.val();

                // Check if the item with the same value already exists in the table
                const existingItem = $tbody.find(`tr[data-item-id="${selectedValue}"]`);

                if (!existingItem.length) {
                    const tr = $('<tr>').attr('data-item-id', selectedValue).html(`
                    <td class='text-center' width='40%'>${$item.find('option:selected').text()}
                        <input type="hidden" name="item_id[]" value="${selectedValue}">
                    </td>
                    <td class='text-center' width='20%'>${$item.find('option:selected').data('unit')}</td>
                    <td class='text-center' width='20%'>${$item.find('option:selected').data('puchase_price')}</td>
                    <td width='20%'>
                        <input type="number" name="quantity[]" min="1" class="form-control qty rounded-0 shadow-none text-center" value="1">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm rounded-circle shadow-none text-center" onclick="deleteRow(this)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                `);

                    // Update total quantity
                    totalQuantity += 1;

                    $tbody.append(tr);
                    updateTotalQuantity();
                }
            });

            $tbody.on('input', '.qty', function() {
                updateTotalQuantity();
            });

            $tvaInput.on('input', updateTotals);

            $typePayment.on('input', function() {
                const selectedValue = $typePayment.val();
                const option = $typePayment.find(':selected');

                const existingRefDiv = $typePayment.closest('.row').next();
                if (existingRefDiv.length) {
                    existingRefDiv.remove();
                }

                if (option.data('ref')) {
                    const div = $('<div>').addClass('row g-3 mb-2 align-items-center').html(`
                    <div class="col-3">
                        <label for="" class="col-form-label my__label">Référence ${selectedValue} : </label>
                    </div>
                    <div class="col-9 mb-2">
                        <input type="text" name="reference" class="form-control rounded-0 shadow-none">
                    </div>
                    <div class="col-3">
                        <label for="" class="my__label">Reçu ${selectedValue} : </label>
                    </div>
                    <br>
                    <div class="col-9">
                        <label for="Recu" class="custom-file-upload w-100">
                            <i class="fa fa-cloud-upload"></i> Selectionner votre Reçu ...
                        </label>
                        <input type="file" class="form-control shadow-none" id="Recu" name="Recu">
                    </div>
                `);

                    $typePayment.closest('.row').after(div);
                }
            });

            $(document).on('DOMContentLoaded', function() {
                const $purchaseDate = $('#purchase_date');
                const $fournisseur = $('#fournisseur');
                const $form = $('form');

                $item.on('click', function() {
                    if (!$purchaseDate.val()) {
                        alert('Veuillez d\'abord sélectionner une date.');
                    }
                });

                $form.on('submit', function(event) {
                    if (!$item.val()) {
                        alert('Veuillez sélectionner un article avant de soumettre le formulaire.');
                        event.preventDefault();
                    } else if (!$purchaseDate.val()) {
                        alert('Veuillez sélectionner une date avant de soumettre le formulaire.');
                        event.preventDefault();
                    } else if (!$fournisseur.val()) {
                        alert(
                            'Veuillez sélectionner un fournisseur avant de soumettre le formulaire.'
                            );
                        event.preventDefault();
                    }
                });
            });

            function updateTotalQuantity() {
                $totalQuantityDiv.text(`${totalQuantity}`);
                updateTotals();
            }

            function updateTotals() {
                const rows = $tbody.children();

                const totalAmount = rows.toArray().reduce(function(total, row) {
                    const quantity = parseInt($(row).find('.qty').val(), 10) || 0;
                    const purchasePrice = parseFloat($(row).find('td:nth-child(3)').text());
                    return total + quantity * purchasePrice;
                }, 0);

                const tvaValue = parseFloat($tvaInput.val()) || 0;
                const tvaAmount = (totalAmount * tvaValue) / 100;

                $('#total').text(` ${totalAmount.toFixed(2)}`);
                $('#tva').text(` ${tvaAmount.toFixed(2)}`);
                $('#finalAmountt').text(` ${(totalAmount + tvaAmount).toFixed(2)}`);
                $('#finalAmount').val(` ${(totalAmount + tvaAmount).toFixed(2)}`);
            }

            // Initialize Select2 for #fournisseur select
            $('#fournisseur').select2({
                selectionCssClass: 'my__input__class'
            });

            // Initialize Select2 for #item select
            $('#item').select2({
                width: '100%',
                placeholder: 'Search for an item',
                allowClear: true
            });
        });
    </script>
@endsection
