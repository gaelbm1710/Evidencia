@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Órdenes Eliminadas</h1>
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
                    <form action="{{ route('orders.restore', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit">Restaurar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('orders.index') }}">Volver a Órdenes</a>
</div>
@endsection