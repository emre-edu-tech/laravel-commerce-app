<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Category;
use App\PackageType;
use App\BoxType;
use Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        // dd($products);

        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get categories and 
        $categories = Category::all()->where('parent_id', '!=', 0);
        $packageTypes = PackageType::all();
        $boxTypes = BoxType::all();

        $data = [
            'categories' => $categories,
            'packageTypes' => $packageTypes,
            'boxTypes' => $boxTypes,
        ];

        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the product that will be added
        $this->validate($request, [
            'category' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'packageType' => 'required|integer',
            'netWeight' => 'required',
            'baseUnitPrice' => 'required',
            'quantityInStock' => 'required|numeric',
            'featuredImage' => 'required|image',
        ],
        [
            'category.integer' => 'Ürün kategorisi giriniz',
            'name.required' => 'Ürün adını giriniz',
            'description.required' => 'Ürün açıklaması giriniz',
            'packageType.integer' => 'Ambalaj tipi giriniz',
            'netWeight.required' => 'Ürün net ağırlığını giriniz',
            'baseUnitPrice.required' => 'Ürün birim fiyatını giriniz',
            'quantityInStock.required' => 'Stok durumu giriniz',
            'quantityInStock.numeric' => 'Stok durumunu sayısal değer olmalıdır',
            'featuredImage.required' => 'Ürün için bir resim seçiniz',
            'featuredImage.image' => 'Ürün resmi için resim dosyası seçiniz',
        ]);

        // prepare a new product object to save it to database
        $product = new Product();
        $product->category_id = $request->input('category');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->package_type_id = $request->input('packageType');
        $product->box_type_id = $request->input('boxType');
        $product->net_weight = $request->input('netWeight');
        $product->base_unit_price = $request->input('baseUnitPrice');
        $product->sale_unit_price = $request->input('saleUnitPrice');
        $product->quantity_in_stock = $request->input('quantityInStock');
        $product->slug = str_slug($product->name, $separator = '-') . '-' . time();
        $image_file = $request->file('featuredImage');
        if($image_file){
            // set a file name to upload to a folder and also to the database as image file name - with its file extension
            $filename = time() . '-' . str_slug($product->name, $separator = '-') . '.' . File::extension($image_file->getClientOriginalName());

            // upload the original picture to resize and use it later
            Storage::disk('public')->put('products/original/'.$filename, File::get($image_file));

            // assign the original image filename for the database
            $product->featured_image = $filename;

            // find the uploaded image resize it and save it
            $img = Image::make(storage_path('app/public/products/original/').$filename)->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            });

            // save it with a different file name than before
            // it is a must
            $img->save(storage_path('app/public/products/').'resized-'.$filename);

            // assign the new file name for the thumb of newly created image
            $product->thumb_featured_image = 'resized-' . $filename;

            $product->save();
        }else{
            return redirect('admin/products/create')->with('error', 'Geçerli bir resim dosyası bulunamadı');
        }

        return redirect('admin/products')->with('success', 'Yeni bir ürün eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the product that will be upated
        $product = Product::find($id);
        // Get categories and 
        $categories = Category::all()->where('parent_id', '!=', 0);
        $packageTypes = PackageType::all();
        $boxTypes = BoxType::all();

        $data = [
            'product' => $product,
            'categories' => $categories,
            'packageTypes' => $packageTypes,
            'boxTypes' => $boxTypes,
        ];

        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate the product that will be added
        $this->validate($request, [
            'category' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'packageType' => 'required|integer',
            'netWeight' => 'required|string',
            'baseUnitPrice' => 'required',
            'quantityInStock' => 'required|numeric',
            'featuredImage' => 'sometimes|image',
        ],
        [
            'category.required' => 'Ürün kategori giriniz',
            'name.required' => 'Ürün adını giriniz',
            'description.required' => 'Ürün açıklaması giriniz',
            'packageType.required' => 'Ambalaj tipi giriniz',
            'netWeight.required' => 'Ürün net ağırlığını giriniz',
            'baseUnitPrice.required' => 'Ürün birim fiyatını giriniz',
            'quantityInStock.required' => 'Stok durumu giriniz',
            'quantityInStock.numeric' => 'Stok durumunu sayısal değer olmalıdır',
            'featuredImage.sometimes' => 'Ürün resminizi güncellemek için bir resim dosyası seçiniz',
            'featuredImage.image' => 'Ürün resmi için resim dosyası seçiniz',
        ]);

        // prepare a new product object to save it to database
        $product = Product::find($id);
        $product->category_id = $request->input('category');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->package_type_id = $request->input('packageType');
        $product->box_type_id = $request->input('boxType');
        $product->net_weight = $request->input('netWeight');
        $product->base_unit_price = $request->input('baseUnitPrice');
        $product->sale_unit_price = $request->input('saleUnitPrice');
        $product->quantity_in_stock = $request->input('quantityInStock');
        $product->slug = str_slug($product->name, $separator = '-') . '-' . time();
        $image_file = $request->file('featuredImage');
        if($image_file){
            // set a file name to upload to a folder and also to the database as image file name - with its file extension
            $filename = time() . '-' . str_slug($product->name, $separator = '-') . '.' . File::extension($image_file->getClientOriginalName());

            // upload the original picture to resize and use it later
            Storage::disk('public')->put('products/original/'.$filename, File::get($image_file));

            // assign the original image filename for the database
            $product->featured_image = $filename;

            // find the uploaded image resize it and save it
            $img = Image::make(storage_path('app/public/products/original/').$filename)->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            });

            // save it with a different file name than before
            // it is a must
            $img->save(storage_path('app/public/products/').'resized-'.$filename);

            // assign the new file name for the thumb of newly created image
            $product->thumb_featured_image = 'resized-' . $filename;
        }

        $product->update();

        return redirect('admin/products')->with('success', 'Ürün güncellemesi başarılı');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect('admin/products')->with('success', 'Ürün başarıyla silindi');
    }

    public function search(Request $request){
        // validation has been done using only empty function
        $searchTerm = $request->input('searchTerm');

        if(!empty($searchTerm)){
            $products = Product::whereHas('category', function($query) use($searchTerm){
                                    $query->orWhere('name', 'LIKE', '%'.$searchTerm.'%');  
                                })
                                ->where('name', 'LIKE', '%'.$searchTerm.'%')
                                ->orWhere('description', 'LIKE', '%'.$searchTerm.'%')
                                ->orderBy('id', 'desc')
                                ->get();
            // dd($categories);
        }else{
            $products = Product::orderBy('id', 'desc')->get();
        }

        return view('products.index')->with('products', $products);
    }
}
