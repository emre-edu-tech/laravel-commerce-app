<?php

namespace App\Http\Controllers;

use Image;
use App\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $postCategories = PostCategory::with('children')->orderBy('id', 'desc')->get();
        $parentCategories = PostCategory::with('children')->where('parent_category_id', 0)->orderBy('name', 'asc')->get();

        return view('postcategories.index')->with('parentCategories', $parentCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = PostCategory::with('children')->where('parent_category_id', 0)->orderBy('name', 'asc')->get();

        return view('postcategories.create')->with('parentCategories', $parentCategories);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'parentCategory' => 'required|integer',
            'featuredImage' => 'required|image'
        ],
        // custom validation messages
        [
            'name.required' => 'Kategori Adı giriniz',
            'description.required' => 'Kategori Açıklaması girilmesi gerekli',
            'parentCategory.required' => 'Ana kategori seçiniz',
            'featuredImage.required' => 'Kategori için bir resim seçiniz',
            'featuredImage.image' => 'Kategori resmi olarak resim dosyası seçiniz',
        ]);

        $postCategory = new PostCategory();
        $postCategory->parent_category_id = $request->input('parentCategory');
        $postCategory->name = $request->input('name');
        $postCategory->description = $request->input('description');
        $postCategory->slug = Str::slug($postCategory->name, '-') . '-' . time();
        $image_file = $request->file('featuredImage');

        if($image_file){

            // set a file name to upload to the folder
            $filename = time() . '-' . Str::slug($postCategory->name, '-') . '.' . File::extension($image_file->getClientOriginalName());

            Storage::disk('public')->put('postcategories/original/'.$filename, File::get($image_file));
            $postCategory->featured_image = $filename;

            $img = Image::make(storage_path('app/public/postcategories/original/').$filename)->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            });

            $img->save(storage_path('app/public/postcategories/').'resized-'.$filename);

            $postCategory->thumb_featured_image = 'resized-'.$filename;
            
            // save category to the database
            $postCategory->save();
        }else{
            return redirect('/admin/postcategories/create')->with('error', 'Geçerli bir resim dosyası bulunamadı');
        }

        return redirect('/admin/postcategories')->with('success', 'Yeni bir kategori eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postCategory = PostCategory::find($id);

        return view('postcategories.show')->with('postCategory', $postCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postcategory = PostCategory::find($id);
        $parentCategories = PostCategory::with('children')->where('parent_category_id', 0)->orderBy('name', 'asc')->get();
        return view('postCategories.edit')->with('postCategory', $postcategory);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
