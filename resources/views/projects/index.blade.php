@extends('layouts.index')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="color: #2d3748; font-weight: 600;">
                <i class="fas fa-project-diagram me-2" style="color: #667eea;"></i>
                Gestión de Proyectos
            </h2>
            <p class="text-muted mb-0">Administra y visualiza todos los proyectos del sistema</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn-create-new">
            <i class="fas fa-plus me-2"></i>
            Nuevo Proyecto
        </a>
    </div>

    @if($projects->count() > 0)
        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-1"></i> ID</th>
                        <th><i class="fas fa-project-diagram me-1"></i> Nombre</th>
                        <th><i class="fas fa-align-left me-1"></i> Descripción</th>
                        <th><i class="fas fa-user me-1"></i> Cliente</th>
                        <th><i class="fas fa-info-circle me-1"></i> Estado</th>
                        <th><i class="fas fa-calendar-alt me-1"></i> Fecha Inicio</th>
                        <th><i class="fas fa-calendar-check me-1"></i> Fecha Fin</th>
                        <th><i class="fas fa-cogs me-1"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td><span class="badge bg-primary">{{ $project->id }}</span></td>
                            <td class="fw-semibold">{{ $project->name }}</td>
                            <td>{{ Str::limit($project->description, 50, '...') }}</td>
                            <td>{{ $project->client->name }}</td>
                            <td>
                                @switch($project->status)
                                    @case('pending')
                                        <span class="badge bg-warning">Pendiente</span>
                                        @break
                                    @case('in_progress')
                                        <span class="badge bg-info">En Progreso</span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-success">Completado</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($project->status) }}</span>
                                @endswitch
                            </td>
                            <td>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') : 'No definida' }}</td>
                            <td>{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : 'No definida' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <h4>No hay proyectos registrados</h4>
            <p class="text-muted">Comienza agregando tu primer proyecto al sistema</p>
            <a href="{{ route('projects.create') }}" class="btn-create-new">
                <i class="fas fa-plus me-2"></i>
                Crear Primer Proyecto
            </a>
        </div>
    @endif
</div>

<style>
    .btn-create-new {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        display: inline-flex;
        align-items: center;
    }

    .btn-create-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .table-modern {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .table-modern thead th {
        background: linear-gradient(135deg, #f8f9ff, #e3e8ff);
        color: #4a5568;
        font-weight: 600;
        border: none;
        padding: 1rem;
        font-size: 0.875rem;
    }

    .table-modern tbody td {
        padding: 1rem;
        border: none;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .table-modern tbody tr:hover {
        background-color: #f7fafc;
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: #a0aec0;
    }

    .empty-state h4 {
        color: #4a5568;
        margin-bottom: 0.5rem;
    }

    .btn-group .btn {
        margin: 0 2px;
        border-radius: 8px;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
    }
</style>
@endsection
