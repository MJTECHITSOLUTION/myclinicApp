@extends('layouts.master')

@section('title')
    Famille acte
@endsection

@section('content')
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Famille acte</h6>
                    <div>
                        <button id="openFormButton" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                            <i class="fas fa-plus"></i> Ajouter nouveau
                        </button>
                        <!-- First additional button with orange color -->
                        <a type="button" href="{{ route('act.create_sous_category_act') }}" class="btn btn-info ml-2">
                            Catégorie Acte
                        </a>
                        <!-- Second additional button with orange color -->
                        <a type="button" href="{{ route('act.create_act') }}" class="btn btn-secondary ml-2">
                            Acte
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">Libellé</th>
                            <th class="text-center">Remarque</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category_act as $act)
                        <tr>
                            <td class="text-center">{{ $act->name }}</td>
                            <td class="text-center">{{ $act->ref }}</td>
                            <td class="text-center">
                                @can('edit drug')
                                    <button type="button" href="" class="btn btn-success btn-circle btn-sm editbtn" value="{{ $act->id }}"><i class="fa fa-edit"></i></button>
                                @endcan
                                @can('edit drug')
                                    <a href="{{ route('act.destroyfamily', ['id' => $act->id]) }}"
                                       class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                @endcan

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


    <!-- Modal for the form -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Famille acte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('familie.acte') }}">
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

{{--    editModel--}}
    <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('update-actf')}}">
                        @method('PUT')
                        <input type="hidden" name="acte_id" id="acte_id" value="" />
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Libellé<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ref" class="col-sm-3 col-form-label">Remarque</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ref" name="ref">
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
{{--    end editModel --}}
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
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
        $(document).ready(function () {
            $(".editbtn").click(function () {
                var actId = $(this).val();
                $("#editModel").modal("show");
                $.ajax({
                    type:'GET',
                    url:'/edit-family/'+actId,
                    success:function (response){
                        $('#name').val(response.acts.name);
                        $('#ref').val(response.acts.ref);
                        $('#acte_id').val(response.acts.id);
                    }
                })
            });
        });
        });
    </script>
@endsection
