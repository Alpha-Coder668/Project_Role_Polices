<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display products for the authenticated user
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->get();
        return view('products.index', compact('products'));
    }
    
    // Show form to create a new product
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product with image handling
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $product = new Product($request->except('images'));
        $product->user_id = auth()->id(); 
        $product->save();
    
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $imageName, 'public');
                $imagePaths[] = $path;
            }
            $product->images = json_encode($imagePaths);
            $product->save();
        }
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    
    // Show a specific product for all users
    public function show($id)
    {
        $product = Product::findOrFail($id);  // Allow any user to view the product
        return view('products.show', compact('product'));
    }

    // Show the form to edit an existing product
    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('products.edit', compact('product'));
    }

    // Update product details with new image handling
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update($request->except('images'));

        if ($request->hasFile('images')) {
            $imagePaths = json_decode($product->images) ?? [];

            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $imageName, 'public');
                $imagePaths[] = $path;
            }

            $product->images = json_encode($imagePaths);
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // Display all products for all users
    public function allproducts()
    {
        $categories = Category::withCount('products')->get(); // Get categories with product counts
        $products = Product::with('category', 'user')->paginate(12); // Adjust pagination as needed
    
        return view('products.all', compact('products', 'categories'));
    }
    
}
