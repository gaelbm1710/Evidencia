@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Consultar Estado de Orden</h1>
    @if(session('error'))
    <div>{{ session('error') }}</div>
    @endif
    <form action="{{ route('public.search') }}" method="POST">
        @csrf
        <div>
            <label for="customer_number">Número de Cliente:</label>
            <input type="text" name="customer_number" id="customer_number">
        </div>
        <div>
            <label for="invoice_number">Número de Factura:</label>
            <input type="text" name="invoice_number" id="invoice_number" required>
        </div>
        <button type="submit">Buscar</button>
    </form>
</div>
@endsection