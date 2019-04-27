<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get the main categories
        $parentCategories = Category::all()->where('parent_id', 0);
        $parentCategoryOptions = array();
        if(count($parentCategories) > 0){
            foreach ($parentCategories as $parentCategory) {
                $parentCategoryOptions[$parentCategory->id] = $parentCategory->name;
            }
        }

        return view('categories.create')->with('parentCategoryOptions', $parentCategoryOptions);
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
            'featuredLogo' => 'required'
        ],
        // custom validation messages
        [
            'name.required' => 'Kategori Adı giriniz',
            'description.required' => 'Kategori Açıklaması girilmesi gerekli',
            'parentCategory.required' => 'Ana kategori seçiniz',
            'featuredLogo.required' => 'Kategori için bir logo seçiniz',
        ]);

        $category = new Category();
        $category->parent_id = $request->input('parentCategory');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->slug = str_slug($category->name, $separator = '-');
        $image_file = $request->file('featuredLogo');
        if($image_file){
            // set a file name to upload to the folder
            $filename = uniqid() . '-' . $category->name . '.' . File::extension($image_file->getClientOriginalName());
            $category->featured_logo = $filename;
            Storage::disk('public')->put($filename, File::get($image_file));
            $category->save();
        }else{
            return redirect('/admin/categories/create')->with('error', 'Geçerli bir resim dosyası bulunamadı');
        }

        return redirect('/admin/categories')->with('success', 'Yeni kategori eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
