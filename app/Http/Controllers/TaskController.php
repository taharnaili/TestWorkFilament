<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
   
   public function editStatus($id){
   	$task=Task::where('id',$id)->first();
   	return view('task.modal',compact('task'));
   }

       public function updateStatus(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $task->update(['status' => $validatedData['status']]);

        return back()->withSuccess('Updated Succefully');
    }
}
