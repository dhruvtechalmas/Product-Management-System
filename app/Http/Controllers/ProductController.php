<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->withTrashed();

        // 🔍 Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        // 📄 Pagination
        $products = $query->paginate(1)->withQueryString();

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:0,1'

        ]);

        if ($validator->fails()) {
            return redirect(route('products.create'))->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
            $product->image = $imagename;
            $product->save();
        }

        return redirect(route('products.index'))->with('success', 'Product Created SuccessFully');



    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:0,1'

        ]);

        if ($validator->fails()) {
            return redirect(route('products.edit', $product->id))->withErrors($validator)->withInput();
        }


        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('image')) {

            //delete product firts
            File::delete(public_path('uploads/products/' . $product->image));

            //here we will store image
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            //save image to prodoct directory
            $image->move(public_path('uploads/products'), $imagename);

            //save image name in database
            $product->image = $imagename;
            $product->save();
        }

        return redirect(route('products.index'))->with('success', 'Product Updated SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // File::delete(public_path('uploads/products/' . $product->image));

        $product->delete();


        return redirect(route('products.index'))->with('success', 'Product Deleted SuccessFully');

    }

    public function restore($id)
    {

        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect(route('products.index'))->with('success', 'Product Restore SuccessFully');

    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        // image delete only here
        if ($product->image) {
            File::delete(public_path('uploads/products/' . $product->image));
        }

        $product->forceDelete();

        return redirect()->back()->with('success', 'Product Permanently Deleted');
    }

    //pdf funtions

    public function exportSingle($id)
    {
        $product = Product::findOrFail($id);

        $pdf = Pdf::loadView('pdf.single', compact('product'));

        return $pdf->download('product.pdf');
    }

    public function exportAll()
    {
        $products = Product::all();

        $pdf = Pdf::loadView('pdf.all', compact('products'));

        return $pdf->download('products.pdf');
    }

    public function exportCategory($id)
    {
        $products = Product::where('category_id', $id)->get();

        $pdf = Pdf::loadView('pdf.category', compact('products'));

        return $pdf->download('category.pdf');
    }
}
