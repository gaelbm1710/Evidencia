@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la Orden</h1>
    <p><strong>Factura:</strong> {{ $order->invoice_number }}</p>
    <p><strong>Cliente:</strong> {{ $order->customer->name ?? $order->customer->company_name }}</p>
    <p><strong>Fecha:</strong> {{ $order->order_date }}</p>
    <p><strong>Dirección de Entrega:</strong> {{ $order->delivery_address }}</p>
    <p><strong>Notas:</strong> {{ $order->notes }}</p>
    <p><strong>Estado:</strong> {{ $order->status }}</p>
    @if($order->status == 'In route' && $order->photo_route)
    <div>
        <h3>Foto de Ruta:</h3>
        <img src="{{ asset('storage/' . $order->photo_route) }}" alt="Foto de Ruta" width="300">
    </div>
    @endif
    @if($order->status == 'Delivered' && $order->photo_delivery)
    <div>
        <h3>Foto de Entrega:</h3>
        <img src="{{ asset('storage/' . $order->photo_delivery) }}" alt="Foto de Entrega" width="300">
    </div>
    @endif
    <a href="{{ route('orders.index') }}">Volver</a>
</div>
@endsection