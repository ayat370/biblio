@extends('layouts.app')

@section('content')
<h2>Résultat de recherche</h2>

<div class="card">
    <a class="btn btn-primary" href="{{ route('livres.index') }}">← Retour</a>

    <br><br>

    @if($livres->count() == 0)
        <p>Aucun livre trouvé.</p>
    @else
    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Catégorie</th>
        </tr>

        @foreach($livres as $livre)
        <tr>
            <td>{{ $livre->titre }}</td>
            <td>{{ $livre->auteur->nom }}</td>
            <td>{{ $livre->categorie->nom }}</td>
        </tr>
        @endforeach
    </table>
    @endif
</div>
@endsection
