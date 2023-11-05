<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

public function index(){
        $categories=Category::all();
   return response()->json($categories);
}
public function store(Request $request){
    // dd($request->all());
    $this->validate($request,[
        'name'=> 'required|string|max:255',
    ]);
    $category=Category::create([
        'name'=> $request->name
    ]);
   return response()->json(['message'=> 'name added successfully'],200);

}

    public function show($id){
     $category=Category::find($id);
     if(!$category){
        return response()->json(['message'=> 'Category not found'],404);
     }
     return response()->json($category);
  }

public function update (Request $request, $id){
    $this->validate($request,[
        "name"=> 'required|string|max:255',
    ]);
    $category=Category::find($id);
    if(!$category){
       return response()->json(['message'=> 'Category not found'],404);
    }
    $category->name=$request->name;
    $category->save();
    return response()->json($category);
}
public function delete($id){
$category=Category::find($id);
if(!$category){
    return response()->json(['message'=> 'Category not found'],404);
 }
 $category->delete();
 return response()->json(['message'=> 'deleted successfully'],200);
}
}

