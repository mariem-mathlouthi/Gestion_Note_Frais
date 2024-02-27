<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function GetAllCategory(){
        //search || pagination
        $categories = Category::all();
        return response()->json(["data"=>$categories],200);
    }

    public function AddCategory(Request $request){
        $file_name = time() . '_' . $request->photo->getClientOriginalName();
        $image = $request->file('photo')->storeAs('images', $file_name, 'public');

        $category=Category::create([
            'photo'=>'/storage/' . $image,
            'description'=>$request->description,
            ]
        );
        return response()->json(['data'=>$category], 200);
    }

    public function UpdateCategory(Request $request,int $id){
        $category=Category::find($id);
        if($category){
            if($request->hasFile('photo')){
                $file_name = time() . '_' . $request->photo->getClientOriginalName();
                $image = $request->file('photo')->storeAs('images', $file_name, 'public');
                $category->update([
                    'photo'=>'/storage/' . $image,
                    'description'=>$request->description,
                ]);
            }else{
                $category->update([
                    'description'=>$request->description,
                ]);
            }
            return response()->json(["message"=>"Category Updated"],200);
        }else{
            return response()->json(["message"=>"NOt Found"],404);
        }
    }


    public function DeleteCategory($id){
        $category=Category::find($id);
        if($category){
            $category->delete();
            return response()->json(["message"=>"Category Deeted"],200);
        }else{
            return response()->json(["message"=>"NOt Found"],404);
        }
    }

    public function GetcategoryById($id){
        $category=Category::find($id);
        if($category){
            return response()->json(["data"=>$category],200);
        }else{
            return response()->json(["message"=>"NOt Found"],404);
        }
    }
}
