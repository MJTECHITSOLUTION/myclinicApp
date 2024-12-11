@extends('layouts.master')

@section('title')
    Tous les articles
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les articles</h6>
                </div>

                <div class="col-6">
                    @can('create drug')
                        <button type="button" class="btn btn-info btn-sm rounded-0 shadow-none float-right ml-2"
                            data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-plus fa-sm"></i>
                            Ajouter une nouvelle catégorie
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('category.create') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <label for="" class="my__label">Nom de catégorie</label>
                                            <input type="text" name="name" class="form-control rounded-0 shadow-none"
                                                placeholder="Nom de catégorie">
                                            <label for=""></label>
                                            <label for="" class="my__label">
                                                Description de catégorie
                                            </label>
                                            <textarea name="slug" id="slug" class="form-control rounded-0 shadow-none"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 shadow-none"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary btn-sm rounded-0 shadow-none">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endcan
                    @can('create drug')
                        <a href="{{ route('item.create') }}" class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i
                                class="fa fa-plus"></i>
                            ajouter un article</a>
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
                            <th>
                                Image
                            </th>
                            <th>Nom </th>
                            <th>Category</th>
                            <th>Marque</th>
                            <th>Unit</th>
                            <th>Prix d'achat</th>
                            <th>
                                Prix de vente
                            </th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('uploads/images_Items/' . $item->item_image) }}" alt=""
                                        width="50px" height="50px">
                                <td class="text-center">
                                    <a
                                        href="
                                    @can('view drug')
                                        {{ route('item.view', ['id' => $item->id]) }}
                                    @endcan
                                    ">
                                        {{ $item->name }}
                                    </a>

                                </td>
                                <td class="text-center">{{ $item->category->name }}</td>
                                <td class="text-center">{{ $item->brand }}</td>
                                <td class="text-center">{{ $item->unit }}</td>
                                <td class="text-center">{{ number_format($item->purchase_price, 2, ',', ' ') }}</td>
                                <td class="text-center">{{ number_format($item->sale_price, 2, ',', ' ') }}</td>
                                <td class="text-center">
                                    @can('view drug')
                                        <a href="{{ route('item.view', ['id' => $item->id]) }}"
                                            class="btn btn-outline-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    @endcan

                                    @can('edit drug')
                                        <a href="{{ route('item.edit', ['id' => $item->id]) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ route('item.destroy', ['id' => $item->id]) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center"><br><br> Aucun article trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Button trigger modal -->


                <div class="d-flex">
                    {!! $items->links() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
