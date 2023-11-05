<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{

    public function index(){
        // $tasks = Task::orderBy("id","desc")->where('is_shared',1)->paginate(2);
        $tasks = Task::with('category')
        ->where('is_shared', 1)
        ->orderBy('category.name')
        ->paginate(2);
        return response()->json($tasks);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|string',
            'is_shared'=>'required|boolean',
            'type'=>'required|in:text,list',
            'category_id'=>'required',
        ]);
        $task=Task::create([
            'name'=> $request->name,
            'is_shared'=>$request->is_shared,
            'type'=> $request->type,
            'category_id'=> $request->category_id,
        ]);
        return response()->json($task);
    }
    public function show($id){
        $task=Task::find($id);
        if(!$task){
            return response()->json(['message'=> 'task not found'],404);
         }
        return response()->json($task);
    }
        public function update(Request $request, $id){
            $this->validate($request,[
                'name'=>'required|string',
                'is_shared'=>'required|boolean',
                'type'=>'required|in:text,list',
                'category_id'=>'required',
            ]);
            $task=Task::find($id);
            if(!$task){
                return response()->json(['message'=> 'task not found'],404);
             }
             $task->name=$request->name;
             $task->type=$request->type;
             $task->category_id=$request->category_id;
             $task->is_shared=$request->is_shared;
             $task->save();
            return response()->json(['message'=> 'task updated successfully'],200);

        }
        public function delete($id){
            $task=Task::find($id);
            if(!$task){
                return response()->json(['message'=> 'task not found'],404);
            }
            $task->delete();
            return response()->json(['message'=> 'task deleted successfully'],200);

        }

}
