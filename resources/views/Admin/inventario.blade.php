@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Gestión de Inventario de Piezas</h2>

    <!-- Filtro de búsqueda -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" id="searchInput" placeholder="Buscar por nombre o proveedor...">
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.createPieza') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Agregar Nueva Pieza
            </a>
        </div>
    </div>

    <!-- Tabla de inventario -->
    <div class="table-responsive mt-4">
        <table class="table table-striped" id="inventarioTable">
            <thead>
                <tr>
                    <th>Nombre de la Pieza</th>
                    <th>Cantidad Disponible</th>
                    <th>Proveedor</th>
                    <th>Costo Unitario</th>
                    <th>Stock Mínimo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($piezas as $pieza)
                    <tr>
                        <td>{{ $pieza->nombre_pieza }}</td>
                        <td>{{ $pieza->cantidad_disponible }}</td>
                        <td>{{ $pieza->proveedor }}</td>
                        <td>{{ $pieza->costo_unidad }} RD$</td>
                        <td>{{ $pieza->stock_minimo }}</td>
                        <td>
                            @if($pieza->cantidad_disponible <= $pieza->stock_minimo)
                                <span class="badge bg-danger">Bajo Stock</span>
                            @else
                                <span class="badge bg-success">Disponible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.editPieza', $pieza->id_pieza) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('admin.deletePieza', $pieza->id_pieza) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta pieza?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Función para filtrar la tabla por nombre o proveedor
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var filter = this.value.toLowerCase();
        var rows = document.querySelectorAll('#inventarioTable tbody tr');
        rows.forEach(function(row) {
            var nombre = row.cells[0].textContent.toLowerCase();
            var proveedor = row.cells[2].textContent.toLowerCase();
            if (nombre.indexOf(filter) > -1 || proveedor.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection

