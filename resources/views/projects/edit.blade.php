@extends('layouts.index')

@section('content')
<div class="content-card" style="margin-left: 0; position: relative; z-index: 1;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="color: #2d3748; font-weight: 600;">
                <i class="fas fa-user-edit me-2" style="color: #667eea;"></i>
                Editar Proyecto
            </h2>
            <p class="text-muted mb-0">Modifica la información del proyecto seleccionado</p>
        </div>
        <a href="{{ route('projects.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>
            Volver a la Lista
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="form-modern" novalidate>
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">
                        <i class="fas fa-user me-1"></i>
                        Nombre <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control modern-input @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $project->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @else
                    <div class="invalid-feedback">El nombre es obligatorio.</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">
                        <i class="fas fa-file-text me-1"></i>
                        Descripción <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control modern-input @error('description') is-invalid @enderror"
                        id="description" name="description" value="{{ old('description', $project->description) }}">
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">
                        <i class="fas fa-tasks me-1"></i>
                        Estado <span class="required">*</span>
                    </label>
                    <select class="form-control modern-input @error('status') is-invalid @enderror" id="status"
                        name="status" required>
                        <option value="">Seleccionar estado...</option>
                        <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : ''
                            }}>Pendiente</option>
                        <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' :
                            '' }}>En Progreso</option>
                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : ''
                            }}>Completado</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @else
                    <div class="invalid-feedback">El estado es obligatorio.</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">
                        <i class="fas fa-calendar me-1"></i>
                        Fecha de Inicio
                    </label>
                    <input type="date" class="form-control modern-input @error('start_date') is-invalid @enderror"
                        id="start_date" name="start_date" value="{{ old('start_date', $project->start_date) }}">
                    @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">
                        <i class="fas fa-calendar me-1"></i>
                        Fecha de Fin
                    </label>
                    <input type="date" class="form-control modern-input @error('end_date') is-invalid @enderror"
                        id="end_date" name="end_date" value="{{ old('end_date', $project->end_date) }}">
                    @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="client_id" class="form-label">
                        <i class="fas fa-user me-1"></i>
                        Cliente <span class="required">*</span>
                    </label>
                    <select class="form-control modern-input @error('client_id') is-invalid @enderror" id="client_id"
                        name="client_id" required>
                        <option value="">Seleccionar cliente...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @else
                    <div class="invalid-feedback">El cliente es obligatorio.</div>
                    @enderror
                </div>
            </div>

            <div class="form-actions mt-4">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save me-2"></i>
                    Actualizar Proyecto
                </button>
                <a href="{{ route('projects.index') }}" class="btn-cancel">
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
</style>
@endsection
