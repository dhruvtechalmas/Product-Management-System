<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Jobs\SendProductEmailJob;
use App\Mail\ProductCreatedMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
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
        $products = $query->paginate(25)->withQueryString();

        $categories = Category::all();


        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->stock_status = $request->stock > 0 ? 'in_stock' : 'out_of_stock';

        $product->save();

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/products'), $imagename);

            $product->image = $imagename;

            $product->save();
        }

        $users = User::all();

        foreach ($users as $user) {

            if (!empty($user->email) && filter_var($user->email, FILTER_VALIDATE_EMAIL)) {

                SendProductEmailJob::dispatch($product, $user);
            }
        }

        return redirect(route('products.index'))->with('success', 'Product Created Successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::active()->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->description = $request->description;

        $product->stock = $request->stock;

        $product->stock_status = $request->stock > 0 ? 'in_stock' : 'out_of_stock';

        $product->save();

        if ($request->hasFile('image')) {

            File::delete(public_path('uploads/products/' . $product->image));

            $image = $request->file('image');

            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/products'), $imagename);

            $product->image = $imagename;

            $product->save();
        }

        return redirect(route('products.index'))->with('success', 'Product Updated Successfully');
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
