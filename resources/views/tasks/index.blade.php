@extends('tasks.layout')

@section('content')
<div class="container">
    <main>
        <h2 class="display-6 text-center mb-4">Tareas</h2>
        <a href="tasks/create" class="btn btn-outline-primary mb-3">Nueva Tarea</a>
        <div class="table-responsive">
            <table class="table text-left">
                <thead>
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 22%;">Nombre</th>
                        <th style="width: 22%;">Descripción</th>
                        <th style="width: 22%;">Usuario</th>
                        <th style="width: 22%;">Prioridad</th>
                        <th style="width: 22%;">Etiqueta</th>
                        <th style="width: 22%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="{{ $task->completed ? 'table-success' : '' }}">
                        <th scope="row">{{ $task->id }}</th>
                        <td><a href="/tasks/{{ $task->id }}">{{ $task->name }}</a></td>
                        <td>{{ $task-> description }}</td>
                        <td>{{ $task->user -> name }}</td>
                        <td>{{ $task->priority -> name }}</td>
                        <td>
                            @foreach($task->labels as $label)
                            <span class="badge bg-info">{{ $label->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @auth
                            @if ($task->completed)
                            <span class="badge bg-success">Completada</span>
                            @else
                            <form action="/tasks/{{ $task->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success">Completada</button>
                            </form>
                            @endif  
                            @endauth
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
