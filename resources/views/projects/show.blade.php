@extends('layouts.index')

@section('content')
    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $project->id }}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {{ $project->name }}</li>
        <li class="list-group-item"><strong>Descripción:</strong> {{ $project->description }}</li>
        <li class="list-group-item"><strong>Cliente ID:</strong> {{ $project->client_id }}</li>
        <li class="list-group-item"><strong>Estado:</strong> {{ $project->status }}</li>
        <li class="list-group-item"><strong>Fecha de inicio:</strong> {{ $project->start_date }}</li>
        <li class="list-group-item"><strong>Fecha de fin:</strong> {{ $project->end_date }}</li>
    </ul>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Volver a la lista de proyectos</a>
@endsection
