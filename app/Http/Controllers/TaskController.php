<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Priority;
use App\Models\User;
use App\Models\Label;



class TaskController extends Controller
{
    public function index()
    {

        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {

        return view('tasks.create', ['priorities' => Priority::all(), 
        'users' => User::all(), 'labels' => Label::all()]);
    }

    public function show(Task $task)
    {

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store(Request $request)
{
    // Validar los datos de la solicitud
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|exists:priorities,id',
        'user' => 'required|exists:users,id',
        'labels' => 'array|exists:labels,id',
    ]);

    // Crear y guardar la nueva tarea
    $task = new Task();
    $task->name = $validatedData['name']; 
    $task->description = $validatedData['description'];
    $task->priority_id = $validatedData['priority'];
    $task->user_id = $validatedData['user'];
    $task->save();  // Guarda la tarea primero

    // Adjuntar etiquetas a la tarea
    if (isset($validatedData['labels'])) {
        $task->labels()->attach($validatedData['labels']);
    }

    

    return redirect('/tasks');
}


    public function edit(Task $task)
    {

        return view('tasks.edit', ['task'=> $task, 'priorities' 
        => Priority::all(), 'users' => User::all(), 'labels' => Label::all()]);
     
    }

    public function update(Task $task, Request $request)
    {

        
        $task->name = $request -> name; 
        $task->description = $request -> description;
        $task->priority_id = $request -> priority;
        $task->user_id = $request -> user;
        $task->labels()->sync($request->labels);

        $task->save();

        return redirect('/tasks');
    }

    public function complete(Task $task)
    {
        $task->completed = true; 
        $task->save();
        return redirect('/tasks'); 
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }
    

    
}
