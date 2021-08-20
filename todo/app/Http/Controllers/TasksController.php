<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function CreateTask(Request $request)
    {
        $rules=array(
            'description' => 'required|min:5|max:50'
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()) {
            return $validator->errors();
        }
        $task = new Task();
        $task->description = $request->description;
        $task->status="Pending";
        $result=$task->save();
        if($result) {
            return ["Result"=>"Task Created Successfully"];
        }
        else {
            return ["Result"=>"Task Creation Failed"];
        }
    }
    public function DeleteTask($id):JsonResponse
    {
        if(DB::table('tasks')->where('id',$id)->doesntExist()) {
            return response()->json([
                'message'=>"Task not found",
            ]);
        }
        DB::table('tasks')->where('id',$id)->delete();
        return response()->json([
            'message'=>"Task deleted successfully",
        ]);
    }
    public function GetAllTasks():JsonResponse
    {
        $tasks=DB::table('tasks')->get();
        return response()->json([
           'tasks'=>$tasks,
        ]);
    }
    public function UpdateStatus(Request $request,$id):JsonResponse
    {
        if(DB::table('tasks')->where('id',$id)->doesntExist()) {
            return response()->json([
                'message'=>"Task not found",
            ]);
        }
        $UpdatedTask=DB::table('tasks')->where('id',$id)->update(['status'=>$request->status]);
        return response()->json([
            'task'=>'task status updated',
        ]);
    }
}
