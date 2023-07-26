@extends('page')
@section('content')
<form action="{{ isset($transaction) ? route('formUpdate', ['id' => $transaction->id]) : route('formPost') }}" method="post">
    @csrf
    @if (isset($transaction))
    @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Nom de l'opération *</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Facture d'électricité" value="{{ isset($transaction) ? $transaction->name : '' }}" required>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date *</label>
        <input type="date" class="form-control" name="date_transaction" id="date" value="{{ isset($transaction) ? $transaction->date_transaction : '' }}" required>
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Montant *</label>
        <div class="input-group">
            <input type="text" class="form-control" name="amount" id="amount" value="{{ isset($transaction) ? $transaction->amount : '' }}" required>
            <span class="input-group-text">€</span>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">{{ isset($transaction) ? 'Modifier' : 'Ajouter' }}</button>
    </div>
</form>
@endsection