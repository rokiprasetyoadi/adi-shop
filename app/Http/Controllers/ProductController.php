<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function create_product()
    {
        return view('create_product');
    }

    public function store_product(Request $request)
    {
        //validasi
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'stock' => 'required',
            'img' => 'required'
        ]);

        //upload file gambar pakai library laravel, php artisan storage:link 
        $file = $request->file('img');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        //perintah create
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'stock' => $request->stock,
            'img' => $path
        ]);

        return Redirect::route('index_product');
    }

    public function index_product()
    {
        $products = Product::paginate(3);
        return view('index_product', compact('products'));
    }

    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }

    public function edit_product(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    public function update_product(Product $product, Request $request)
    {
        //validasi
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'stock' => 'required',
            'img' => 'required'
        ]);

        //upload file gambar pakai library laravel, php artisan storage:link 
        $file = $request->file('img');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        //perintah create
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'stock' => $request->stock,
            'img' => $path
        ]);

        return Redirect::route('index_product');
    }

    public function delete_product(Product $product)
    {
        $product->delete();
        return Redirect::route('index_product');
    }

}
