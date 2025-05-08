<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //select * from tasks;
        $tasks = Task::all();
        //$tasks = Task::orderby('title')->first();
        //return $tasks[2]['title'];

       return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);
        // return redirect()->back()->withErrors([])->with('input')
   
        $task=Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->input('completed', false),
            'due_date' => $request->due_date,
            'user_id' => 1,
        ]);

     return redirect()->route('task.show', $task->id)->with('success', 'Task Created Successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // $task = select * from tasks where id = $task
       return  view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', ['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->input('completed', false),
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('task.show', $task->id)->with('success', 'Task Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $title = $task->title;
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task: '.$title.' was deleted successfully!');
    }
}
