@extends('layouts.master')

@section('title')
    Tous les catégories
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les catégories</h6>
                </div>

                <div class="col-6">
                    @can('create drug')
                        <a href="{{ route('category.create') }}">
                            <button class="btn btn-info rounded-0 shadow-none btn-sm float-right ml-2"><i class="fa fa-plus"></i>
                                Ajouter un catégorie</button>
                        </a>
                    @endcan
                    @can('create drug')
                        <a href="{{ route('item.create') }}" class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i
                                class="fa fa-plus"></i>
                            Ajouter un article</a>
                    @endcan
                </div>
                <div class="col-12">
                    <div class="col-12">
                        <form class="  navbar-search" action="{{ route('item.search') }}" method="post">
                            <div class="input-group">
                                <input type="text" name="term"
                                    class="form-control rounded-0 bg-light  shadow-none border-1 small"
                                    placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                                @csrf
                                <div class="input-group-append">
                                    <button class="btn btn-primary rounded-0 " type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nom catégorie </th>
                            <th class="text-center">
                                Description
                            </th>

                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorys as $category)
                            <tr>
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">{{ $category->slug }}</td>
                                <td class="text-center">
                                    @can('edit drug')
                                        <a href="{{ route('category.edit', ['id' => $category->id]) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ route('category.destroy', ['id' => $category->id]) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center"><br><br> Aucun article trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Button trigger modal -->


                <div class="d-flex">
                    {!! $categorys->links() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
