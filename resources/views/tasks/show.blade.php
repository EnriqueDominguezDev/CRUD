@extends('layouts.index')

@section('content')
<div class="content-card">
    <div class="detail-header">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="detail-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="ms-3">
                    <h2 class="mb-1">{{ $task->title }}</h2>
                    <p class="text-muted mb-0">Detalles de la tarea</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn-action btn-edit">
                    <i class="fas fa-edit me-2"></i>
                    Editar
                </a>
                <a href="{{ route('tasks.index') }}" class="btn-action btn-back">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>

    <div class="detail-content">
        <div class="row">
            <div class="col-md-8">
                <div class="detail-section">
                    <h5 class="section-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Información General
                    </h5>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label class="detail-label">
                                <i class="fas fa-hashtag me-2"></i>ID
                            </label>
                            <div class="detail-value">
                                <span class="badge bg-primary">#{{ $task->id }}</span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <label class="detail-label">
                                <i class="fas fa-tag me-2"></i>Título
                            </label>
                            <div class="detail-value">
                                {{ $task->title }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <label class="detail-label">
                                <i class="fas fa-project-diagram me-2"></i>Proyecto
                            </label>
                            <div class="detail-value">
                                <span class="badge bg-info">{{ $task->project->name }}</span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <label class="detail-label">
                                <i class="fas fa-exclamation-circle me-2"></i>Prioridad
                            </label>
                            <div class="detail-value">
                                @switch($task->priority)
                                    @case('low')
                                        <span class="badge bg-success">
                                            <i class="fas fa-arrow-down me-1"></i>Baja
                                        </span>
                                        @break
                                    @case('medium')
                                        <span class="badge bg-warning">
                                            <i class="fas fa-minus me-1"></i>Media
                                        </span>
                                        @break
                                    @case('high')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-arrow-up me-1"></i>Alta
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($task->priority) }}</span>
                                @endswitch
                            </div>
                        </div>

                        <div class="detail-item">
                            <label class="detail-label">
                                <i class="fas fa-check-circle me-2"></i>Estado
                            </label>
                            <div class="detail-value">
                                @switch($task->status)
                                    @case('todo')
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-clock me-1"></i>Por Hacer
                                        </span>
                                        @break
                                    @case('in_progress')
                                        <span class="badge bg-primary">
                                            <i class="fas fa-spinner me-1"></i>En Progreso
                                        </span>
                                        @break
                                    @case('done')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Completado
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                                @endswitch
                            </div>
                        </div>

                        <div class="detail-item">
                            <label class="detail-label">
                                <i class="fas fa-calendar-alt me-2"></i>Fecha de Vencimiento
                            </label>
                            <div class="detail-value">
                                @if($task->due_date)
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                                    <small class="text-muted ms-2">
                                        ({{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }})
                                    </small>
                                @else
                                    <span class="text-muted">No definida</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($task->description)
                <div class="detail-section">
                    <h5 class="section-title">
                        <i class="fas fa-align-left me-2"></i>
                        Descripción
                    </h5>
                    <div class="description-content">
                        {{ $task->description }}
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="detail-section">
                    <h5 class="section-title">
                        <i class="fas fa-clock me-2"></i>
                        Timestamps
                    </h5>
                    <div class="timestamp-item">
                        <label class="timestamp-label">Creado</label>
                        <div class="timestamp-value">
                            {{ $task->created_at->format('d/m/Y H:i') }}
                            <small class="text-muted d-block">{{ $task->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="timestamp-item">
                        <label class="timestamp-label">Actualizado</label>
                        <div class="timestamp-value">
                            {{ $task->updated_at->format('d/m/Y H:i') }}
                            <small class="text-muted d-block">{{ $task->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h5 class="section-title">
                        <i class="fas fa-cogs me-2"></i>
                        Acciones
                    </h5>
                    <div class="actions-list">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="action-item">
                            <i class="fas fa-edit me-2"></i>
                            Editar Tarea
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline w-100" onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-item delete-action">
                                <i class="fas fa-trash me-2"></i>
                                Eliminar Tarea
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .detail-header {
        background: linear-gradient(135deg, #f8f9ff, #e3e8ff);
        padding: 2rem;
        border-radius: 16px 16px 0 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .detail-content {
        padding: 2rem;
        background: white;
        border-radius: 0 0 16px 16px;
    }

    .detail-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
    }

    .section-title {
        color: #4a5568;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
    }

    .detail-grid {
        display: grid;
        gap: 1rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #718096;
        margin: 0;
        display: flex;
        align-items: center;
        min-width: 140px;
    }

    .detail-value {
        color: #2d3748;
        font-weight: 500;
        text-align: right;
        flex: 1;
    }

    .description-content {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        line-height: 1.6;
        color: #4a5568;
    }

    .timestamp-item {
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .timestamp-item:last-child {
        border-bottom: none;
    }

    .timestamp-label {
        font-weight: 600;
        color: #718096;
        font-size: 0.875rem;
    }

    .timestamp-value {
        color: #2d3748;
        font-weight: 500;
        margin-top: 0.25rem;
    }

    .btn-action {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        border: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-back {
        background: white;
        color: #718096;
        border: 2px solid #e2e8f0;
    }

    .btn-back:hover {
        background-color: #f7fafc;
        border-color: #cbd5e0;
        color: #4a5568;
        text-decoration: none;
    }

    .actions-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .action-item {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        color: #4a5568;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .action-item:hover {
        background-color: #f7fafc;
        border-color: #cbd5e0;
        color: #2d3748;
        text-decoration: none;
    }

    .delete-action {
        color: #e53e3e;
        border-color: #fed7d7;
    }

    .delete-action:hover {
        background-color: #fed7d7;
        border-color: #e53e3e;
        color: #c53030;
    }

    .content-card {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .detail-header .d-flex {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start !important;
        }

        .detail-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .detail-value {
            text-align: left;
        }

        .detail-label {
            min-width: auto;
        }
    }
</style>
@endsection
