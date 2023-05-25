<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductsModel;
use App\Models\CategoriesModel;

class ProductsController extends Controller
{
    //
    public function welcome()
    {
        return view("welcome");
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = ProductsModel::select('products.*', 'categories.category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('product_name', 'like', '%' . $search . '%')
            ->paginate(2);
        $categories = CategoriesModel::select('id', 'category_name')->get();
        return view("Products/products", ['products' => $products, 'categories' => $categories]);
    }

    public function get($id)
    {
        $product = ProductsModel::with('category')->findorfail($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }

        $product->category_name = $product->category->category_name;
        unset($product->category); // Remove the category object from the product


        return response()->json($product, 200);
    }

    public function save(Request $request)
    {
        try {
            $data = [
                'product_name' => $request->input('product_name'),
                'category_id' => $request->input('category_id'),
                'product_price' => $request->input('product_price'),
                'product_stocks' => $request->input('product_stocks')
            ];

            ProductsModel::create($data);

            return redirect()->back()->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add the product');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = ProductsModel::find($id);
            $data = [
                'product_name' => $request->input('product_name'),
                'category_id' => $request->input('category_id'),
                'product_price' => $request->input('product_price'),
                'product_stocks' => $request->input('product_stocks')
            ];

            $product->update($data);
            return redirect()->back()->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the product');
        }
    }

    public function delete($id)
    {
        try {
            $product = ProductsModel::find($id);
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the product');
        }
    }
}