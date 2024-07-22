@extends('tasks.layout')

@section('content')
@auth
<div class="container mt-5">
        <h1 class="display-4">Tarea ID: {{ $task->id }}</h1>
        <hr>
        <h2 class="h4">{{ $task->name }}</h2>
        <p>{{ $task->description }}</p>
        <p><strong>Usuario:</strong> {{ $task->user->name }}</p>
        <p><strong>Prioridad:</strong> {{ $task->priority->name }}</p>
        <p><strong>Etiquetas:</strong>
            @foreach($task->labels as $label)
            <span class="badge bg-info">{{ $label->name }}</span>
            @endforeach
        <br>
       
        <a href="/tasks/{{ $task->id }}/edit" class="btn btn-primary mb-3">Editar</a>
        <a href="/tasks" class="btn btn-secondary mb-3">Volver</a>
       
        
        <form action="/tasks/{{ $task->id }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
@endauth
@guest
    <p>Por favor <a href="{{ route('login') }}">Iniciar Sesión</a> o <a href="{{ route('register') }}">Registrarse</a> para poder ver su tarea</p>
@endguest

@endsection