@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        </div>
        <div>
            <label for="password">Contraseña (dejar en blanco para no cambiar):</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>
        <div>
            <label for="role">Rol:</label>
            <select name="role" id="role" required>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status">Activo:</label>
            <input type="checkbox" name="status" id="status" value="1" {{ $user->active ? 'checked' : '' }}>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection