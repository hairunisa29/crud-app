<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Melakukan validasi data
        $request->validate(
            [
                'name' => 'required|max:45',
                'type' => 'required|max:45',
                'sell_price' => 'required|numeric',
                'buy_price' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Field Name is required',
                'name.max' => 'Maximum characters are 45',
                'type.required' => 'Field Type is required',
                'type.max' => 'Maximum characters are 45',
                'sell_price.required' => 'Field Sell Price is required',
                'buy_price.required' => 'Field Buy Price is required',
                'image.max' => 'Maximum image size is 2 MB',
                'image.mimes' => 'File extension must be jpg, png, jpeg, gif, svg',
                'image.image' => 'File must be an image'
            ]
        );

        if (!empty($request->image)) {
            $filename = 'image-' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('image'), $filename);
        } else {
            $filename = 'nophoto.jpg';
        }

        // tambah data product
        DB::table('products')->insert([
            'name' => $request->name,
            'type' => $request->type,
            'sell_price' => $request->sell_price,
            'buy_price' => $request->buy_price,
            'description' => $request->description,
            'image' => $filename
        ]);

        return redirect()->route('index.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $id)
    {
        return view('product.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi data
        $request->validate(
            [
                'name' => 'required|max:45',
                'type' => 'required|max:45',
                'sell_price' => 'required|numeric',
                'buy_price' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Field Name is required',
                'name.max' => 'Maximum characters are 45',
                'type.required' => 'Field Type is required',
                'type.max' => 'Maximum characters are 45',
                'sell_price.required' => 'Field Sell Price is required',
                'buy_price.required' => 'Field Buy Price is required',
                'image.max' => 'Maximum image size is 2 MB',
                'image.mimes' => 'File extension must be jpg, png, jpeg, gif, svg',
                'image.image' => 'File must be an image'
            ]
        );

        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($product->image && file_exists(public_path('image/' . $product->image))) {
                unlink(public_path('image/' . $product->image));
            }

            // Ganti foto dengan yang baru
            $fileName = 'image-' . $id . '.' . $request->image->extension();
            $request->image->move(public_path('image'), $fileName);
        } else {
            $fileName = $product->image;
        }

        // Update data produk
        $product->update([
            'name' => $request->name,
            'type' => $request->type,
            'sell_price' => $request->sell_price,
            'buy_price' => $request->buy_price,
            'description' => $request->description,
            'image' => $fileName
        ]);

        return redirect()->route('index.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $id)
    {
        if ($id->image && file_exists(public_path('image/' . $id->image))) {
            unlink(public_path('image/' . $id->image));
        }
        
        $id->delete();

        return redirect()->route('index.index')
            ->with('success', 'Successfully deleted the product');
    }
}
