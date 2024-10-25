@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <ul>
        @role('Admin')
        <li><a href="{{ route('admin.users.index') }}">Gestión de Usuarios</a></li>
        @endrole
        @role('Sales|Purchasing|Warehouse|Route|Admin')
        <li><a href="{{ route('orders.index') }}">Gestión de Órdenes</a></li>
        @endrole
    </ul>
</div>
@endsection