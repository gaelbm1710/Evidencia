@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cambiar Estado de la Orden</h1>
    <form action="{{ route('orders.changeStatus', $order) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="status">Nuevo Estado:</label>
            <select name="status" id="status" required>
                <option value="Ordered">Ordered</option>
                <option value="In process">In process</option>
                <option value="In route">In route</option>
                <option value="Delivered">Delivered</option>
            </select>
        </div>
        @role('Route')
        @if($order->status == 'In route')
        <div>
            <label for="photo_route">Foto de Ruta:</label>
            <input type="file" name="photo_route" id="photo_route" accept="image/*" required>
        </div>
        @endif

        @if($order->status == 'Delivered')
        <div>
            <label for="photo_delivery">Foto de Entrega:</label>
            <input type="file" name="photo_delivery" id="photo_delivery" accept="image/*" required>
        </div>
        @endif
        @endrole
        <button type="submit">Actualizar Estado</button>
    </form>
</div>
@endsection