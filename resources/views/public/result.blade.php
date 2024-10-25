@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estado de la Orden</h1>
    <p><strong>Número de Factura:</strong> {{ $order->invoice_number }}</p>
    <p><strong>Estado:</strong> {{ $order->status }}</p>
    @if($order->status == 'Delivered' && $order->photo_delivery)
    <div>
        <h3>Foto de Entrega:</h3>
        <img src="{{ asset('storage/' . $order->photo_delivery) }}" alt="Foto de Entrega" width="300">
    </div>
    @elseif($order->status == 'In process')
    <p>En proceso desde: {{ $order->updated_at }}</p>
    @endif
</div>
@endsection