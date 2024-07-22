@extends('tasks.layout')

@section('content')
<div class="container mt-5">
        <h1 class="display-4">Editando tarea ID: {{ $task->id }}</h1>
        <hr>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $task->name }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="5">{{ $task->description }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="user">Usuario</label>
                <select name="user" id="user" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            <div>
                <label for="priority">Prioridad</label>
                <select name="priority" id="priority" class="form-control">
                    @foreach($priorities as $priority)
                        <option value="{{ $priority->id }}" {{ $task->priority_id == $priority->id ? 'selected' : '' }}>{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="labels">Etiquetas</label>
                <select name="labels[]" id="labels" class="form-control" multiple>
                    @foreach($labels as $label)
                        <option value="{{ $label->id }}" {{ isset($task) && $task->labels->pluck('id')->contains($label->id) ? 'selected' : '' }}>
                            {{ $label->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

@endsection
