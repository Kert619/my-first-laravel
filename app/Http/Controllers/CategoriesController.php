<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CategoriesModel;

class CategoriesController extends Controller
{
    //
    public function search(Request $request){
       $search = $request->input('search');
       $categories = CategoriesModel::where('category_name', 'like', '%' . $search . '%')->get();
        return view('Categories/categories', ['categories' => $categories]);
    }

    public function get($id){
        $category= CategoriesModel::findorfail($id);
        if(!$category){
            return response()->json(['message' => 'category not found'], 404);
        }
        return response()->json($category, 200);
    }

    public function save(Request $request){
        try {
            $data = [
                'category_name' => $request->input('category_name')
            ];
            
            $category = CategoriesModel::create($data);
    
            return redirect()->back()->with('success', 'Category added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add the category');
        }
    }

    public function update(Request $request, $id){

        try {
            $category = CategoriesModel::find($id);
            $data = [
            'category_name' => $request->input('category_name')
            ];

            $category->update($data);

            return redirect()->back()->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the category');
        }

    }

    public function delete($id){
       try {
            $category = CategoriesModel::find($id);
            $category->delete();

            return redirect()->back()->with('success', 'Category deleted successfully');
       } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the category');
       }
    }
}