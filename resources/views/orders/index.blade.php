@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Órdenes</h1>
    <a href="{{ route('orders.create') }}">Crear Nueva Orden</a>
    <form action="{{ route('orders.index') }}" method="GET">
        <input type="text" name="invoice_number" placeholder="Número de Factura">
        <input type="text" name="customer_number" placeholder="Número de Cliente">
        <input type="date" name="date">
        <select name="status">
            <option value="">Todos los Estados</option>
            <option value="Ordered">Ordered</option>
            <option value="In process">In process</option>
            <option value="In route">In route</option>
            <option value="Delivered">Delivered</option>
        </select>
        <button type="submit">Buscar</button>
    </form>
    @if(session('success'))
    <div>{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->invoice_number }}</td>
                <td>{{ $order->customer->name ?? $order->customer->company_name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('orders.show', $order) }}">Ver</a>
                    <a href="{{ route('orders.edit', $order) }}">Editar</a>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                    @if($order->status != 'Delivered')
                    <form action="{{ route('orders.changeStatus', $order) }}" method="POST" style="display:inline;">
                        @csrf
                        <select name="status">
                            <option value="Ordered">Ordered</option>
                            <option value="In process">In process</option>
                            <option value="In route">In route</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                        <button type="submit">Cambiar Estado</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('orders.archived') }}">Órdenes Eliminadas</a>
</div>
@endsection