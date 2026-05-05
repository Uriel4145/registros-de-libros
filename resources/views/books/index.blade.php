<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Libros - UGB</title>
    {{-- Bootstrap 5 para los estilos --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        :root { --ugb-color: #003366; }

    
        .navbar-ugb { background-color: var(--ugb-color); }

      
        .card-header-ugb { background-color: var(--ugb-color); color: white; }

        
        .btn-ugb {
            background-color: var(--ugb-color);
            color: white;
            width: 100%;
        }
        .btn-ugb:hover { background-color: #002244; color: white; }

        
        .footer {
            background-color: var(--ugb-color);
            color: rgba(255,255,255,0.8);
            padding: 16px 0;
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
        }
        .footer span { color: #fff; font-weight: 500; }
    </style>
</head>
<body class="bg-light">

    {{-- NAVBAR CON LOGO DE LA UNIVERSIDAD --}}
    <nav class="navbar navbar-ugb py-2">
        <div class="container">
            {{-- Logo de la UGB --}}
            <img src="{{ asset('images/logo.png') }}" alt="Logo UGB" height="55">
            <span class="text-white fw-bold fs-5 ms-3">Sistema de Registro de Libros</span>
        </div>
    </nav>

    <div class="container py-5">

        <h2 class="text-center mb-4" style="color: var(--ugb-color);">📚 Registro de Libros</h2>

        {{-- Mensaje de éxito al registrar un libro --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- FORMULARIO DE REGISTRO --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header card-header-ugb">
                Registrar Nuevo Libro
            </div>
            <div class="card-body">
                {{-- Envía los datos al controlador mediante POST --}}
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf {{-- Token de seguridad requerido por Laravel --}}

                    {{-- Campo Título --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Título</label>
                        <input type="text" name="titulo"
                               class="form-control @error('titulo') is-invalid @enderror"
                               value="{{ old('titulo') }}"
                               placeholder="Ej: Cien años de soledad">
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo Autor --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Autor</label>
                        <input type="text" name="autor"
                               class="form-control @error('autor') is-invalid @enderror"
                               value="{{ old('autor') }}"
                               placeholder="Ej: Gabriel García Márquez">
                        @error('autor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo Año de Publicación --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Año de Publicación</label>
                        <input type="number" name="anio_publicacion"
                               class="form-control @error('anio_publicacion') is-invalid @enderror"
                               value="{{ old('anio_publicacion') }}"
                               placeholder="Ej: 1967"
                               min="1000" max="{{ date('Y') }}">
                        @error('anio_publicacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botón de envío --}}
                    <button type="submit" class="btn btn-ugb">
                        Registrar Libro
                    </button>
                </form>
            </div>
        </div>

        {{-- TABLA DE LIBROS REGISTRADOS --}}
        <div class="card shadow-sm">
            <div class="card-header card-header-ugb d-flex justify-content-between align-items-center">
                <span>Libros Registrados</span>
                {{-- Muestra el total de libros --}}
                <span class="badge bg-light text-dark">Total: {{ $books->count() }}</span>
            </div>
            <div class="card-body p-0">
                @if($books->isEmpty())
                    {{-- Mensaje cuando no hay libros --}}
                    <p class="text-center text-muted py-4">No hay libros registrados aún.</p>
                @else
                    {{-- Tabla con todos los libros --}}
                    <table class="table table-striped table-hover mb-0">
                        <thead style="background-color: var(--ugb-color); color: white;">
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Año</th>
                                <th>Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Itera sobre cada libro y lo muestra en una fila --}}
                            @foreach($books as $i => $book)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $book->titulo }}</td>
                                <td>{{ $book->autor }}</td>
                                <td>{{ $book->anio_publicacion }}</td>
                                <td>{{ $book->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>

    {{-- PIE DE PÁGINA --}}
    <footer class="footer">
        <p class="mb-0">© {{ date('Y') }} Universidad Gerardo Barrios &nbsp;|&nbsp; Powered by <span>Uriel Vargas</span></p>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>