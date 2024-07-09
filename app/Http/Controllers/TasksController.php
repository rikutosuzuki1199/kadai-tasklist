<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', \Auth::user()->id)->get();
        
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required'
        ]);
       
        $request->user()->tasks()->create([
            'status' => $request->status,
            'content' => $request->content,
        ]);
        
        /*
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        */
        
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        
        if (auth()->user()->id != $task->user_id) {
            return redirect(route('tasks.index'));
        }
        
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        
        if (auth()->user()->id != $task->user_id) {
            return redirect(route('tasks.index'));
        }
        
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required'
        ]);
        
        $task = Task::findOrFail($id);
        if (auth()->user()->id != $task->user_id) {
            return redirect(route('tasks.index'));
        }
        
        //$task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = \App\Models\Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        /*
        $task = Task::findOrFail($id);
        $task->delete();
        */
        
        return redirect('/tasks');
    }
}
