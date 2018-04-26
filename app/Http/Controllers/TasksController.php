<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        Task::create($request->all());


        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $myTask = Task::find($id);

        return view('tasks.edit', ['task' => $myTask]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $myTask = Task::find($id);

        $myTask->fill($request->all());
        $myTask->save();

        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $myTask = Task::find($id);

        return view('tasks.show', ['task' => $myTask]);
    }

    public function destroy($id)
    {
        Task::find($id)->delete();

        return redirect()->route('tasks.index');
    }
}
