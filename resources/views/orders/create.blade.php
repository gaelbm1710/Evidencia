@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Orden</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div>
            <label for="invoice_number">Número de Factura:</label>
            <input type="text" name="invoice_number" id="invoice_number" required>
        </div>
        <div>
            <label for="customer_name">Nombre del Cliente:</label>
            <input type="text" name="customer_name" id="customer_name">
        </div>
        <div>
            <label for="company_name">Nombre de la Empresa:</label>
            <input type="text" name="company_name" id="company_name">
        </div>
        <div>
            <label for="customer_number">Número de Cliente:</label>
            <input type="text" name="customer_number" id="customer_number" required>
        </div>
        <div>
            <label for="fiscal_data">Datos Fiscales:</label>
            <textarea name="fiscal_data" id="fiscal_data" required></textarea>
        </div>
        <div>
            <label for="order_date">Fecha y Hora del Pedido:</label>
            <input type="datetime-local" name="order_date" id="order_date" required>
        </div>
        <div>
            <label for="delivery_address">Dirección de Entrega:</label>
            <input type="text" name="delivery_address" id="delivery_address" required>
        </div>
        <div>
            <label for="notes">Notas:</label>
            <textarea name="notes" id="notes"></textarea>
        </div>
        <button type="submit">Crear Orden</button>
    </form>
</div>
@endsection