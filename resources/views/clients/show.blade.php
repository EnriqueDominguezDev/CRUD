@extends('layouts.index')

@section('content')
    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $client->id }}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {{ $client->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $client->email }}</li>
        <li class="list-group-item"><strong>Teléfono:</strong> {{ $client->phone }}</li>
        <li class="list-group-item"><strong>Dirección:</strong> {{ $client->adress }}</li>
    </ul>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Volver a la lista de clientes</a>
@endsection
