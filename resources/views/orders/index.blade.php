<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Pedidos</h1>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('orders.index') }}">
        <div class="form-group">
            <label for="search">Buscar por número de factura o cliente:</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Buscar...">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Tabla de pedidos -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Número de Factura</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->invoice_number }}</td>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <!-- Acciones: Ver, Editar, Eliminar -->
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $orders->links() }}
</div>
@endsection
