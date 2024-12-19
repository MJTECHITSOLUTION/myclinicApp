@extends('layouts.master')

@section('title')
    Gérer les Notifications
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gérer les Notifications</h1>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulaire pour Créer ou Éditer --}}
        <form action="{{ route('notifies.storeOrUpdate') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="id" id="notify-id" value="">

            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" name="name" id="notify-name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="actif">Actif :</label>
                <select name="actif" id="notify-actif" class="form-control" required>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </form>

        <hr>

        {{-- Liste des Notifications --}}
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifies as $notify)
                    <tr>
                        <td>{{ $notify->id }}</td>
                        <td>{{ $notify->name }}</td>
                        <td>{{ $notify->actif ? 'Actif' : 'Inactif' }}</td>
                        <td>
                            {{-- Bouton Éditer --}}
                            <button class="btn btn-warning btn-sm" onclick="editNotify({{ $notify->id }}, '{{ $notify->name }}', {{ $notify->actif }})">
                                Éditer
                            </button>

                            {{-- Formulaire de Suppression --}}
                            <form action="{{ route('notifies.destroy', $notify->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Remplir le formulaire avec les données de notification pour l'édition
        function editNotify(id, name, actif) {
            document.getElementById('notify-id').value = id;
            document.getElementById('notify-name').value = name;
            document.getElementById('notify-actif').value = actif;
        }
    </script>
@endsection