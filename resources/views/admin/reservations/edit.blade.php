@extends('layouts.app')

@section('content')
<h2>Modifier réservation</h2>

<div class="card">
<form method="POST" action="{{ route('admin.reservations.update',$reservation) }}">
@csrf @method('PUT')

<select name="statut">
<option value="en_attente">En attente</option>
<option value="acceptée">Acceptée</option>
<option value="refusée">Refusée</option>
</select>

<br><br>
<button class="btn btn-primary">Mettre à jour</button>
</form>
</div>
@endsection
