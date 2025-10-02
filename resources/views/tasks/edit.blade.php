@extends('layouts.index')

@section('content')
<div class="content-card" style="margin-left: 0; position: relative; z-index: 1;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="color: #2d3748; font-weight: 600;">
                <i class="fas fa-edit me-2" style="color: #667eea;"></i>
                Editar Tarea
            </h2>
            <p class="text-muted mb-0">Modifica la información de la tarea seleccionada</p>
        </div>
        <a href="{{ route('tasks.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>
            Volver a la Lista
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="form-modern" novalidate>
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="title" class="form-label">
                        <i class="fas fa-tag me-1"></i>
                        Título de la Tarea <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control modern-input @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title', $task->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">El título es obligatorio.</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="priority" class="form-label">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Prioridad <span class="required">*</span>
                    </label>
                    <select class="form-control modern-input @error('priority') is-invalid @enderror"
                            id="priority" name="priority" required>
                        <option value="">Seleccionar prioridad...</option>
                        <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Baja</option>
                        <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Media</option>
                        <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Alta</option>
                    </select>
                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">La prioridad es obligatoria.</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">
                    <i class="fas fa-align-left me-1"></i>
                    Descripción <span class="text-muted">(opcional)</span>
                </label>
                <textarea class="form-control modern-input @error('description') is-invalid @enderror"
                          id="description" name="description" rows="4"
                          placeholder="Describe los detalles de la tarea...">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="project_id" class="form-label">
                        <i class="fas fa-project-diagram me-1"></i>
                        Proyecto <span class="required">*</span>
                    </label>
                    <select class="form-control modern-input @error('project_id') is-invalid @enderror"
                            id="project_id" name="project_id" required>
                        <option value="">Seleccionar proyecto...</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">El proyecto es obligatorio.</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">
                        <i class="fas fa-info-circle me-1"></i>
                        Estado <span class="required">*</span>
                    </label>
                    <select class="form-control modern-input @error('status') is-invalid @enderror"
                            id="status" name="status" required>
                        <option value="">Seleccionar estado...</option>
                        <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>Por Hacer</option>
                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                        <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Completado</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">El estado es obligatorio.</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="due_date" class="form-label">
                        <i class="fas fa-calendar-alt me-1"></i>
                        Fecha de Vencimiento <span class="text-muted">(opcional)</span>
                    </label>
                    <input type="date" class="form-control modern-input @error('due_date') is-invalid @enderror"
                           id="due_date" name="due_date" value="{{ old('due_date', $task->due_date) }}">
                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-clock me-1"></i>
                        Información de Timestamps
                    </label>
                    <div class="timestamp-info">
                        <small class="text-muted d-block">
                            <strong>Creado:</strong> {{ $task->created_at->format('d/m/Y H:i') }}
                        </small>
                        <small class="text-muted d-block">
                            <strong>Actualizado:</strong> {{ $task->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>

            <div class="form-actions mt-4">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save me-2"></i>
                    Actualizar Tarea
                </button>
                <a href="{{ route('tasks.show', $task->id) }}" class="btn-view">
                    <i class="fas fa-eye me-2"></i>
                    Ver Tarea
                </a>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">
                    <i class="fas fa-times me-2"></i>
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Fix para prevenir superposición del sidebar */
    .content-card {
        max-width: calc(100vw - 320px);
        margin-left: 20px !important;
        position: relative;
        z-index: 1;
    }

    .form-container {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 2;
    }

    .form-modern .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-label i {
        color: #667eea;
        width: 16px;
    }

    .required {
        color: #e53e3e;
        font-weight: bold;
    }

    .modern-input {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .modern-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        outline: none;
    }

    .modern-input:hover {
        border-color: #cbd5e0;
        background: white;
    }

    .timestamp-info {
        background: #f8f9fa;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        margin-top: 0.5rem;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-back:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .btn-save {
        background: linear-gradient(135deg, #48bb78, #38a169);
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(72, 187, 120, 0.3);
    }

    .btn-view {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #5a67d8, #553c9a);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
        text-decoration: none;
    }

    .btn-cancel {
        background: #f56565;
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #e53e3e;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 101, 101, 0.3);
        text-decoration: none;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .content-card {
            max-width: calc(100vw - 40px);
            margin-left: 20px !important;
            margin-right: 20px;
        }

        .form-container {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-save,
        .btn-view,
        .btn-cancel {
            width: 100%;
            text-align: center;
        }
    }

    /* Ensure form is always above sidebar */
    .main-content {
        position: relative;
        z-index: 1;
    }

    .sidebar {
        z-index: 999;
    }

    /* Improve textarea styling */
    textarea.modern-input {
        resize: vertical;
        min-height: 100px;
    }

    /* Better spacing for select elements */
    select.modern-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px 12px;
        padding-right: 40px;
        appearance: none;
    }
</style>
@endsection
