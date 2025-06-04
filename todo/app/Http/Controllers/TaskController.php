<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(Auth::check()){
        //select * from tasks;
        $tasks = Task::all();
        //$tasks = Task::orderby('title')->first();
        //return $tasks[2]['title'];

       return view('task.index', ['tasks' => $tasks]);
    //    } 
    //    return 'Bye';
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
            'user_id' => Auth::user()->id,
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

    public function completed($completed){
        $tasks = Task::where('completed', $completed)->get();
        return view('task.index', ['tasks' => $tasks]);
    }

    public function query(){
        
        // SELECT * FROM tasks;
        //$task = Task::all();
        // SELECT title, description FROM tasks;
        // $task = Task::select('title', 'description')->get();
        // return $task[8]['title'];
        // SELECT title, description FROM tasks  LIMIT 1
        //$task = Task::select('title', 'description')->first();
        
        //WHERE
        //select * from tasks where id = 1 LIMIT 1;
        //$task = Task::find(1);
        //$task = Task::where('id', 1)->first();

        //select * from tasks where completed = 1;
        $task = Task::select('title')->where('completed','=', 1)->get();
        //select * from tasks where title LIKE "e%";
        $task = Task::where('title','like', 'e%')->get();

        //ORDER BY
        //select * from tasks order by title";
        //$task = Task::orderby('title', 'desc')->get();
        
        $task = Task::select('title')->where('completed','=', 1)->orderby('title')->get();
        
        //AND
        //SELECT * FROM tasks WHERE user_id = 1 AND completed = 1
        $task = Task::where('user_id', 1)->where('completed', 1)->get();

        //OR
        //SELECT * FROM tasks WHERE user_id = 1 OR completed = 1
        $task = Task::where('user_id', 1)->orWhere('completed', 1)->get();

        //JOIN
        //SELECT * FROM tasks INNER JOIN users ON users.id = user_id

        //$task = Task::join('users', 'user_id', 'users.id')->get();
        

        //OUTER
         //SELECT * FROM tasks RIGHT OUTER JOIN users ON users.id = user_id
        
         $task = Task::rightJoin('users', 'users.id', 'user_id')->get();


         //aggregate
        //select count(*) from tasks
        $task = Task::Max('created_at');

        //select count(*) from tasks where user_id = 1;
        $task = Task::where('user_id', 1)->count();

        //GROUP BY / Requête Brute

        $task = Task::select(DB::raw('count(*) as count_tasks'), 'user_id')
        ->groupby('user_id')
        ->get();

        return $task;
    }

}
