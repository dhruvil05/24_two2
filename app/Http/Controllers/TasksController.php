<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all()->toArray();
        // dd($tasks);
        return response()->json(['tasks'=>$tasks]);
    }

    public function redirectView(){
        return view('pages.calendar.add_task');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if($validated){
            
            $task = new Task();
            $task->name = $request->name;
            $task->description = $request->description;
            $task->start_date = $request->start_date;
            $task->end_date = $request->end_date;
            $task->user_id = auth()->id();

            if(!$task->save()){
                return response()->json(['error'=>'Something went wrong, please, try again.']);
            }
            return response()->json(['success'=>'Task Has Been added Successfully.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if(!$task->delete()){
            return response()->json(['error'=>'Something went wrong, please, try again.']);
        }
        return response()->json(['success'=>'Task Has Been Successfully Deleted.']);
    }
}
