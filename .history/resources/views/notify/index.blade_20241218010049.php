@extends('layouts.master')

@section('title')
    Messages
@endsection

<!DOCTYPE html>
<html>
<head>
    <title>Gérer les Notifications</title>
</head>
<body>
    <h1>Gérer les Notifications</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- Formulaire pour Créer ou Éditer --}}
    <form action="{{ route('notifies.storeOrUpdate') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="notify-id" value="">

        <label for="name">Nom :</label>
        <input type="text" name="name" id="notify-name" required><br><br>

        <label for="actif">Actif :</label>
        <select name="actif" id="notify-actif" required>
            <option value="1">Actif</option>
            <option value="0">Inactif</option>
        </select><br><br>

        <button type="submit">Sauvegarder</button>
    </form>

    <hr>

    {{-- Liste des Notifications --}}
    <table border="1" cellpadding="10">
        <thead>
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
                        {{-- Edit Button --}}
                        <button onclick="editNotify({{ $notify->id }}, '{{ $notify->name }}', {{ $notify->actif }})">
                            Edit
                        </button>

                        {{-- Delete Form --}}
                        <form action="{{ route('notifies.destroy', $notify->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        // Fill the form with notify data for editing
        function editNotify(id, name, actif) {
            document.getElementById('notify-id').value = id;
            document.getElementById('notify-name').value = name;
            document.getElementById('notify-actif').value = actif;
        }
    </script>
</body>
</html>