<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
       
        $category = new Category();

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        return redirect(route('categories.index'))->with('success', 'Category Created SuccessFully');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        return redirect(route('categories.index'))->with('success', 'Category Created SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect(route('categories.index'))->with('success', 'Your category Deleted SuccessFully');
    }


    public function deleteWithOption(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // count products
        $count = Product::where('category_id', $id)->count();

        // no products
        if ($count == 0) {
            $category->delete();
            return back()->with('success', 'Category deleted');
        }

        // DELETE ALL PRODUCTS
        if ($request->action == 'delete') {

            Product::where('category_id', $id)->delete();
            $category->delete();

            return back()->with('success', 'Category & products deleted');
        }

        // TRANSFER PRODUCTS
        if ($request->action == 'transfer') {

            if (!$request->new_category_id) {
                return back()->with('error', 'Select category');
            }

            if ($request->new_category_id == $id) {
                return back()->with('error', 'Cannot transfer to same category');
            }

            Product::where('category_id', $id)
                ->update(['category_id' => $request->new_category_id]);

            $category->delete();

            return back()->with('success', 'Products transferred & category deleted');
        }

        return back()->with('error', 'Invalid action');
    }
}
