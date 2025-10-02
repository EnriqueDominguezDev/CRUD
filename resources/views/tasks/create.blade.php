@extends('layouts.index')

@section('content')
<div class="content-card">
    <div class="form-header">
        <div class="d-flex align-items-center mb-4">
            <div class="form-icon">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="ms-3">
                <h2 class="mb-1">Nueva Tarea</h2>
                <p class="text-muted mb-0">Crea una nueva tarea en el sistema</p>
            </div>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('tasks.store') }}" method="POST" class="modern-form">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title" class="form-label">
                            <i class="fas fa-tag me-2"></i>Título de la Tarea
                        </label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Ingresa el título de la tarea"
                               required>
                        @error('title')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="priority" class="form-label">
                            <i class="fas fa-exclamation-circle me-2"></i>Prioridad
                        </label>
                        <select class="form-select @error('priority') is-invalid @enderror"
                                id="priority"
                                name="priority"
                                required>
                            <option value="">Seleccionar prioridad</option>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Baja</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Media</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Alta</option>
                        </select>
                        @error('priority')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">
                    <i class="fas fa-align-left me-2"></i>Descripción
                </label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description"
                          name="description"
                          rows="4"
                          placeholder="Describe los detalles de la tarea...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="project_id" class="form-label">
                            <i class="fas fa-project-diagram me-2"></i>Proyecto
                        </label>
                        <select class="form-select @error('project_id') is-invalid @enderror"
                                id="project_id"
                                name="project_id"
                                required>
                            <option value="">Seleccionar proyecto</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status" class="form-label">
                            <i class="fas fa-info-circle me-2"></i>Estado
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror"
                                id="status"
                                name="status"
                                required>
                            <option value="">Seleccionar estado</option>
                            <option value="todo" {{ old('status') == 'todo' ? 'selected' : '' }}>Por Hacer</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Completado</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="due_date" class="form-label">
                    <i class="fas fa-calendar-alt me-2"></i>Fecha de Vencimiento
                </label>
                <input type="date"
                       class="form-control @error('due_date') is-invalid @enderror"
                       id="due_date"
                       name="due_date"
                       value="{{ old('due_date') }}">
                @error('due_date')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-2"></i>
                    Crear Tarea
                </button>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">
                    <i class="fas fa-times me-2"></i>
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .form-header {
        background: linear-gradient(135deg, #f8f9ff, #e3e8ff);
        padding: 2rem;
        border-radius: 16px 16px 0 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-icon {
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

    .form-container {
        padding: 2rem;
        background: white;
        border-radius: 0 0 16px 16px;
    }

    .modern-form .form-group {
        margin-bottom: 1.5rem;
    }

    .modern-form .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    .modern-form .form-control,
    .modern-form .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }

    .modern-form .form-control:focus,
    .modern-form .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background-color: white;
        outline: none;
    }

    .modern-form .form-control.is-invalid,
    .modern-form .form-select.is-invalid {
        border-color: #e53e3e;
        background-color: #fed7d7;
    }

    .modern-form .invalid-feedback {
        display: block;
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    .form-actions {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 12px 32px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: white;
        color: #718096;
        padding: 12px 32px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background-color: #f7fafc;
        border-color: #cbd5e0;
        color: #4a5568;
        text-decoration: none;
    }

    .content-card {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .row {
        margin-bottom: 0;
    }

    .row .col-md-6,
    .row .col-md-4,
    .row .col-md-8 {
        padding-bottom: 0;
    }

    @media (max-width: 768px) {
        .form-actions {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
