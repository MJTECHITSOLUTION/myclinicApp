

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add Drug') }}</h6>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#manageCategoriesModal">
                        Gérer les catégories
                    </button>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('drug.store') }}">
                        <div class="form-group">
                            <label for="exampleInputEmail">Catégorie *</label>
                            <select class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-drugs_cat" name="drugs_cat" id="drugs_cat" required>
                                <option value="">Sélectionner type</option>
                                @foreach($drugs_cat as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->categorie }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('sentence.Trade Name') }} *</label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="trade_name"
                                id="TradeName" aria-describedby="TradeName" required>
                            {{ csrf_field() }}
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">{{ __('sentence.Note') }}</label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="note" id="Note">
                        </div>
                        <button type="submit" class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="manageCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="manageCategoriesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageCategoriesModalLabel">Manage Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Category Form -->
                    <form id="addCategoryForm">
                        <div class="form-group">
                            <label for="categoryName">Nom de catégorie</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter une catégorie</button>
                    </form>
                    <hr>
                    <!-- Edit/Delete Category List -->
                    <ul class="list-group" id="categoryList">
                        @foreach($drugs_cat as $cat)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $cat->categorie }}</span>
                                <div>
                                    <button class="btn btn-sm btn-warning edit-category" data-id="{{ $cat->id }}" data-name="{{ $cat->categorie }}">Modifier</button>
                                    <button class="btn btn-sm btn-danger delete-category" data-id="{{ $cat->id }}">Supprimer</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Add Category
        $('#addCategoryForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/categories/add',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'categoryName': $('#categoryName').val()
                },
                success: function(data) {
                    $('#categoryList').append('<li class="list-group-item d-flex justify-content-between align-items-center"><span>' + data.name + '</span><div><button class="btn btn-sm btn-warning edit-category" data-id="' + data.id + '" data-name="' + data.name + '">Edit</button><button class="btn btn-sm btn-danger delete-category" data-id="' + data.id + '">Delete</button></div></li>');
                    $('#categoryName').val('');
                    location.reload();
                }
            });
        });

        // Edit Category
        $(document).on('click', '.edit-category', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var newName = prompt("Modifier le nom de la catégorie :", name);
            if (newName !== null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('categories.edit') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id,
                        'name': newName
                    },
                    success: function(data) {
                        if (data.success) {
                            $('button[data-id="' + id + '"]').closest('li').find('span').text(newName);
                            location.reload();
                        }
                    }
                });
            }
        });

        // Delete Category
        $(document).on('click', '.delete-category', function() {
            var id = $(this).data('id');
            if (confirm('Etes-vous sûr de vouloir supprimer cette catégorie ?')) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('categories.delete') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function(data) {
                        if (data.success) {
                            $('button[data-id="' + id + '"]').closest('li').remove();
                            location.reload();
                        }
                    }
                });
            }
        });
    });

</script>
