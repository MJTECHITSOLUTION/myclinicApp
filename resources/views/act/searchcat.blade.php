@extends('layouts.master')

@section('title')
    Catégorie Acte
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Catégorie acte</h6>
            <div>
                <button id="openFormButton" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                    <i class="fas fa-plus"></i> Ajouter nouveau
                </button>
                <!-- First additional button with orange color -->
                <a type="button" href="{{ route('act.create_category_act') }}" class="btn btn-info ml-2">
                    Famille acte
                </a>
                <!-- Second additional button with orange color -->
                <a type="button" href="{{ route('act.create_act') }}" class="btn btn-secondary ml-2">
                    Acte
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Search bar in the center -->
            <div class="d-flex justify-content-end">
                <form class="form-inline navbar-search" action="{{ route('cat.search') }}" method="post">
                    @csrf <!-- Add a CSRF token for security -->
                    <div class="form-group">
                        <select id="sous_category" name="term" class="form-control ">
                            <option value="">Recherche...</option>
                            @foreach($category_act as $act)
                                <option value="{{ $act->id }}">{{ $act->name }}</option>
                            @endforeach
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
                    <th class="text-center">Name</th>
                    <th class="text-center">Remarque</th>
                    <th class="text-center">Famille</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sous_category_act as $act)
                    <tr>
                        <td class="text-center">{{ $act->name }}</td>
                        <td class="text-center">{{ $act->ref }}</td>
                        <td class="text-center">
                            @if (!empty($act->category_act_id))
                                    <?php $category = DB::table('category_act')->where('id', $act->category_act_id)->value('name'); ?>
                                {{ $category ?? '' }}
                            @else
                                {{ $act->category_act_id }}
                            @endif
                        </td>
                        <td class="text-center">
                            @can('edit drug')
                                <button type="button" class="btn btn-success btn-circle btn-sm editbtn"
                                        value="{{ $act->id }}"
                                        data-name="{{ $act->name }}"
                                        data-ref="{{ $act->ref }}"
                                        data-category_act_id = "{{$act->category_act_id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            @endcan
                            @can('edit drug')
                                <a href="{{ route('act.destroysouscategory', ['id' => $act->id]) }}"
                                   class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            @endcan

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <span class="float-right mt-3">{{ $sous_category_act->links() }}</span>
        </div>
    </div>



    <!-- Modal for the form -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Ajoute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('category.acte') }}">
                        <div class="form-group row">
                            <label for="SelectAct" class="col-sm-3 col-form-label">Famille acte<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <select id="sous_category" name="category_act_id" class="form-control ">
                                    <option value="">Sélectionnez...</option>
                                    @foreach($category_act as $act)
                                        <option value="{{ $act->id }}">{{ $act->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Libellé<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="name">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Remarque</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="ref">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for editing an entry -->
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
                    <form id="editForm" method="post" action="{{url('update-actg')}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" id="editActeId" name="id">
                        <div class="form-group row">
                            <label for="SelectAct" class="col-sm-3 col-form-label">Famille acte<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <select id="sous_category" name="category_act_id" class="form-control" required>
                                    <option value="">Sélectionnez...</option>
                                    @foreach($category_act as $act)
                                        <option value="{{ $act->id }}">{{ $act->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editName" class="col-sm-3 col-form-label">Libellé<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editName" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editRef" class="col-sm-3 col-form-label">Remarque</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editRef" name="ref">
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

@endsection

@section('footer')
    <!-- Include necessary scripts and styles for modal and select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <!-- JavaScript for opening the modal and initializing select2 -->
    <script>
        $(document).ready(function () {
            $('#sous_category').select2();
        });
        $(document).ready(function() {
            $('.select2').select2();
            $('#openFormButton').click(function() {
                $('#formModal').modal('show');
            });
        });
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $(document).ready(function() {
                $(".editbtn").click(function () {
                    var actId = $(this).val();
                    var actName = $(this).data("name");
                    var actRef = $(this).data("ref");
                    var id_cat = $(this).data("category_act_id");

                    $("#editActeId").val(actId);
                    $("#editName").val(actName);
                    $("#editRef").val(actRef);
                    $("#sous_category").val(id_cat);

                    $("#editModal").modal("show");
                });
            });
        });
    </script>

@endsection
