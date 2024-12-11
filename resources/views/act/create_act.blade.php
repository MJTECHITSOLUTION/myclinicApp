@extends('layouts.master')

@section('title')
        Acte
@endsection

@section('content')

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Acte</h6>
                    <div>
                        <button id="openFormButton" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                            <i class="fas fa-plus"></i> Ajouter nouveau
                        </button>
                        <!-- First additional button with orange color -->
                        <a type="button" href="{{ route('act.create_sous_category_act') }}" class="btn btn-info ml-2">
                            Catégorie Acte
                        </a>
                        <!-- Second additional button with orange color -->
                        <a type="button" href="{{ route('act.create_category_act') }}" class="btn btn-secondary ml-2">
                            Famille acte
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <form class="form-inline navbar-search" action="{{ route('act.search') }}" method="post">
                            @csrf <!-- Add a CSRF token for security -->
                            <div class="form-group">
                                <select id="category_act1" name="term1" class="form-control">
                                    <option value="">Famille...</option>
                                    @foreach($category_act as $act)
                                        <option value="{{ $act->id }}">{{ $act->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="sous_category1" name="term" class="form-control">
                                    <option value="">Catégorie...</option>
                                </select>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">Libellé</th>
                            <th class="text-center">Référence</th>
                            <th class="text-center">Lettre clé+Coeff</th>
                            <th class="text-center">Famille</th>
                            <th class="text-center">Catégorie</th>
                            <th class="text-center">Prix</th>
                            <th class="text-center">Nombre de séance</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($actes as $acte)
                            <tr>
                            <td class="text-center">{{ $acte->name }}</td>
                            <td class="text-center">{{ $acte->ref }}</td>
                            <td class="text-center">{{ $acte->lettre }}</td>
                            <td class="text-center">
                                @if (!empty($acte->category_act_id))
                                        <?php $category = DB::table('category_act')->where('id', $acte->category_act_id)->value('name'); ?>
                                    {{ $category ?? '' }}
                                @else
                                    {{ $act->category_act_id }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($acte->sous_category_act_id))
                                        <?php $sous_category = DB::table('sous_category_act')->where('id', $acte->sous_category_act_id)->value('name'); ?>
                                    {{ $sous_category ?? '' }}
                                @else
                                    {{ $acte->sous_category_act_id }}
                                @endif
                            </td>
                            <td class="text-center">{{ $acte->cout }}</td>
                            <td class="text-center">{{ $acte->nums }}</td>
                            <td class="text-center">
                                @can('edit drug')

                                    <a href="#" class="btn btn-success btn-circle btn-sm edit-acte" data-acte-id="{{ $acte->id }}" data-acte-name="{{ $acte->name }}" data-acte-ref="{{$acte->ref}}" data-acte-cout="{{$acte->cout}}" data-acte-Lettre="{{$acte->lettre}}" data-acte-nums="{{$acte->nums}}"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('edit drug')
                                        <a href="{{ route('act.destroy', ['id' => $acte->id]) }}"
                                           class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                    @endcan
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span class="float-right mt-3">{{ $actes->links() }}</span>
                </div>
            </div>



    <!-- Modal for the form -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Creer un nouvel acte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('create.acte') }}">
                        <div class="form-group row">
                            <label for="SelectCategoryAct" class="col-sm-3 col-form-label">Famille Acte<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <select id="category_act" name="category_act_id" class="form-control">
                                    <option value="">Sélectionnez...</option>
                                    @foreach($category_act as $act)
                                        <option value="{{ $act->id }}">{{ $act->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="SelectSousCategoryAct" class="col-sm-3 col-form-label">Catégorie Acte<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <select id="sous_category" name="sous_category_act_id" class="form-control">
                                    <option value="">Sélectionnez...</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Libellé<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="name">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail4" class="col-sm-3 col-form-label">Référence</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail4" name="ref">
                                {{ csrf_field() }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lettre" class="col-sm-3 col-form-label">Lettre clé+Coeff</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lettre" name="lettre">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail5" class="col-sm-3 col-form-label">Prix</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail5" name="cout">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail6" class="col-sm-3 col-form-label">Nombre de séance</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail6" name="nums">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit"
                                        class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--edit --}}
    <!-- Modal for editing an entry (without select elements) -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="{{ route('update.acte') }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" id="editActeId" name="id">
                        <div class="form-group row">
                            <label for="editName" class="col-sm-3 col-form-label">Libellé<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editName" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editRef" class="col-sm-3 col-form-label">Référence</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editRef" name="ref">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lettre" class="col-sm-3 col-form-label">Lettre clé+Coeff</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lettre" name="lettre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editCout" class="col-sm-3 col-form-label">Prix</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editCout" name="cout">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail6" class="col-sm-3 col-form-label">Nombre de séance</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editnums" name="nums">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn rounded-0 btn-primary">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--end edit--}}
@endsection

@section('footer')
    <!-- Include necessary scripts and styles for modal and select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <!-- JavaScript for opening the modal and initializing select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#openFormButton').click(function() {
                $('#formModal').modal('show');
            });
        });
        $(document).ready(function() {
            // Listen for changes in the first select menu
            $('#category_act').change(function() {
                var categoryActId = $(this).val();
                // Make an AJAX request to fetch the associated sous_category_act
                $.ajax({
                    url: '/create_sous_category_act/' + categoryActId,
                    type: 'GET',
                    success: function(data) {
                        // Clear the options in the second select menu
                        $('#sous_category').empty();
                        // Add the new options based on the AJAX response
                        $('#sous_category').append($('<option value="">Selectionnez...</option>'));
                        $.each(data, function(key, value) {
                            $('#sous_category').append($('<option value="' + key + '">' + value + '</option>'));
                        });
                    }
                });
            });
        });

        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $(document).ready(function() {
            // Edit button click event
            $(".edit-acte").click(function () {
                var acteId = $(this).data("acte-id");
                var acteName = $(this).data("acte-name"); // Replace with your actual data attribute
                var acteRef = $(this).data("acte-ref");   // Replace with your actual data attribute
                var acteLettre = $(this).data("acte-Lettre");   // Replace with your actual data attribute
                var acteCout = $(this).data("acte-cout"); // Replace with your actual data attribute
                var nums = $(this).data("acte-nums"); // Replace with your actual data attribute

                console.log(acteLettre);
                // Populate the edit modal fields
                $("#editActeId").val(acteId);
                $("#editName").val(acteName);
                $("#editRef").val(acteRef);
                $("#editCout").val(acteCout);
                $("#editnums").val(nums);
                $("#lettre").val(acteLettre);

                // Show the edit modal
                $("#editModal").modal("show");
            });
        });
        });

    </script>

    <script>
        $(document).ready(function() {
            // Listen for changes in the first select menu
            $('#category_act1').change(function() {
                var categoryActId = $(this).val();
                // Make an AJAX request to fetch the associated sous_category_act
                $.ajax({
                    url: '/create_sous_category_act/' + categoryActId,
                    type: 'GET',
                    success: function(data) {
                        // Clear the options in the second select menu
                        $('#sous_category1').empty();
                        // Add the new options based on the AJAX response
                        $('#sous_category1').append($('<option value="">Catégorie...</option>'));
                        $.each(data, function(key, value) {
                            $('#sous_category1').append($('<option value="' + key + '">' + value + '</option>'));
                        });
                    }
                });
            });
        });
    </script>
@endsection
