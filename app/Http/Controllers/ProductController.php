<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\IdentificationType;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /*
    public function __construct()
    {
         $this->middleware('can:products.index')->only('index');
        $this->middleware('can:products.create')->only('create', 'store');
        $this->middleware('can:products.edit')->only('edit', 'update');
        $this->middleware('can:products.destroy')->only('destroy'); 
    } //construct
    */

    public function index()
    {
        //return view('livewire.products.index');
    } //index



    public function formImage(Product $product){
        return view('livewire.products.form', compact('product'));
    }

    public function storeImage(Request $request)
    {
        foreach ($request->file('file') as $key => $img) {
            $imgUrl = $img->store('public/products');
            $imgUrl = Storage::url($imgUrl);
            $imgSave =  new Image();
            $imgSave->url = $imgUrl;
            $imgSave->imageable_id = $request->productId;
            $imgSave->imageable_type = "App\Models\Product";
            $imgSave->save();
        }
        return response()->json(['message' => "Imagenes subidas con exito"]);
    } //storeImage

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        $ptypes = ProductType::all();
        return view('livewire.products.show', compact('product', 'ptypes'));
    }
} //class
