# CRUD

## 📖 Descripción del Proyecto

**CRUD** es un sistema completo de gestión desarrollado en **Laravel 12** que implementa las operaciones básicas de Create, Read, Update y Delete para la administración de **Clientes**, **Proyectos** y **Tareas**. Este proyecto demuestra la implementación de buenas prácticas en el desarrollo web con Laravel.

## 🏗️ Arquitectura del Sistema

El sistema está construido siguiendo el patrón **MVC (Model-View-Controller)** de Laravel e implementa las siguientes entidades:

### 📊 Modelo de Datos

```
Client (Cliente)
├── id
├── name (varchar 250)
├── email (unique)
├── phone (nullable)
├── address (nullable)
└── timestamps

Project (Proyecto)
├── id
├── client_id (FK)
├── name
├── description
├── status
└── timestamps

Task (Tarea)
├── id
├── project_id (FK)
├── title
├── description
├── status
├── priority
└── timestamps
```

### 🔗 Relaciones Eloquent

- **Cliente → Proyectos**: `hasMany` (Un cliente puede tener múltiples proyectos)
- **Proyecto → Cliente**: `belongsTo` (Un proyecto pertenece a un cliente)
- **Proyecto → Tareas**: `hasMany` (Un proyecto puede tener múltiples tareas)
- **Tarea → Proyecto**: `belongsTo` (Una tarea pertenece a un proyecto)

## ⚡ Características Técnicas

### ��️ Seguridad y Buenas Prácticas

- **Mass Assignment Protection**: Uso de `$guarded = []` en modelos para protección controlada
- **Migraciones Versionadas**: Sistema de migraciones con timestamps para control de versiones de BD
- **Relaciones Tipadas**: Uso de tipos de retorno específicos (`HasMany`, `BelongsTo`)
- **Validación de Datos**: Campos únicos y nullable apropiadamente configurados

### 🏛️ Estructura de Código

- **Modelos Eloquent Limpios**: Implementación minimalista con relaciones bien definidas
- **Migraciones Estructuradas**: Esquemas de base de datos organizados por entidad
- **Separación de Responsabilidades**: Estructura MVC respetada
- **Convenciones Laravel**: Nomenclatura y patrones siguiendo estándares del framework

### 📁 Organización del Proyecto

```
app/
├── Models/
│   ├── Client.php      # Modelo Cliente con relación hasMany
│   ├── Project.php     # Modelo Proyecto con relaciones bidireccionales
│   ├── Task.php        # Modelo Tarea con relación belongsTo
│   └── User.php        # Modelo Usuario (Laravel default)
│
database/
├── migrations/
│   ├── create_clients_table.php    # Estructura tabla clientes
│   ├── create_projects_table.php   # Estructura tabla proyectos
│   └── create_tasks_table.php      # Estructura tabla tareas
│
resources/
├── views/
│   ├── clients/        # Vistas CRUD para clientes
│   ├── projects/       # Vistas CRUD para proyectos
│   └── tasks/          # Vistas CRUD para tareas
```

## 🚀 Tecnologías Utilizadas

- **Backend**: Laravel 12 (PHP 8.2+)
- **Base de Datos**: SQLite (desarrollo)
- **Frontend**: Blade Templates + Bootstrap
- **Gestión de Dependencias**: Composer
- **Control de Versiones**: Git
- **Servidor de Desarrollo**: Artisan Server

## 📋 Funcionalidades Implementadas

### ✅ Sistema CRUD Completo
- **Create**: Creación de nuevos registros
- **Read**: Listado y visualización de datos
- **Update**: Edición de registros existentes
- **Delete**: Eliminación de registros

### ✅ Gestión de Relaciones
- **Clientes**: Gestión completa con visualización de proyectos asociados
- **Proyectos**: Administración vinculada a clientes y tareas
- **Tareas**: Control asociado a proyectos específicos

## ⚙️ Instalación y Configuración

### Prerrequisitos
- PHP 8.2 o superior
- Composer
- Node.js y NPM

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/EnriqueDominguezDev/CRUD
cd CRUD
```

2. **Instalar dependencias**
```bash
composer install
npm install
```

3. **Configurar entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos**
```bash
touch database/database.sqlite
php artisan migrate
```

5. **Ejecutar servidor de desarrollo**
```bash
php artisan serve
```

## 🎯 Objetivos del Proyecto

Este proyecto fue desarrollado como parte del aprendizaje y práctica con Laravel, enfocándose en:

- **Dominio de Eloquent ORM**: Implementación correcta de modelos y relaciones
- **Arquitectura MVC**: Aplicación apropiada del patrón de diseño
- **Buenas Prácticas**: Código limpio y mantenible
- **Gestión de Base de Datos**: Migraciones y estructura relacional
- **Desarrollo Full-Stack**: Integración completa backend-frontend

## 📚 Aprendizajes Aplicados

- Implementación de relaciones Eloquent complejas
- Gestión de migraciones y versionado de BD
- Aplicación de convenciones Laravel
- Desarrollo de interfaces CRUD intuitivas
- Organización y estructura de proyectos Laravel

---

**Desarrollado con ❤️ usando Laravel**
