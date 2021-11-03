<?php

namespace App\Http\Controllers;

use Image;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('children')->orderBy('id', 'desc')->get();

        return view('categories.index')->with('categories', $categories);
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
            'featuredLogo' => 'required|image'
        ],
        // custom validation messages
        [
            'name.required' => 'Kategori Adı giriniz',
            'description.required' => 'Kategori Açıklaması girilmesi gerekli',
            'parentCategory.required' => 'Ana kategori seçiniz',
            'featuredLogo.required' => 'Kategori için bir logo seçiniz',
            'featuredLogo.image' => 'Kategori logosu olarak resim dosyası seçiniz',
        ]);

        $category = new Category();
        $category->parent_id = $request->input('parentCategory');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->slug = Str::slug($category->name, '-') . '-' . time();
        $image_file = $request->file('featuredLogo');

        if($image_file){

            // set a file name to upload to the folder
            $filename = time() . '-' . Str::slug($category->name, '-') . '.' . File::extension($image_file->getClientOriginalName());

            Storage::disk('public')->put('categories/original/'.$filename, File::get($image_file));
            $category->featured_logo = $filename;

            $img = Image::make(storage_path('app/public/categories/original/').$filename)->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            });

            $img->save(storage_path('app/public/categories/').'resized-'.$filename);

            $category->thumb_featured_logo = 'resized-'.$filename;
            
            // save category to the database
            $category->save();
        }else{
            return redirect('/admin/categories/create')->with('error', 'Geçerli bir resim dosyası bulunamadı');
        }

        return redirect('/admin/categories')->with('success', 'Yeni bir kategori eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::with('children')->get();

        $category = $categories->find($id);

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        // get the main categories
        $parentCategories = Category::all()->where('parent_id', 0);
        $parentCategoryOptions = array();
        if(count($parentCategories) > 0){
            foreach ($parentCategories as $parentCategory) {
                $parentCategoryOptions[$parentCategory->id] = $parentCategory->name;
            }
        }

        $data = [
            'category' => $category,
            'parentCategoryOptions' => $parentCategoryOptions,
        ];

        return view('categories.edit')->with($data);
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
        // validate the data
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'parentCategory' => 'required',
            'featuredLogo' => 'sometimes|image'
        ],
        // custom validation messages
        [
            'name.required' => 'Kategori Adı giriniz',
            'description.required' => 'Kategori Açıklaması girilmesi gerekli',
            'parentCategory.required' => 'Ana kategori seçiniz',
            'featuredLogo.sometimes' => 'Logonuzu değiştirmek için resim seçin',
            'featuredLogo.image' => 'Seçilen dosya bir resim dosyası olmalıdır',
        ]);

        $category = Category::find($id);
        $category->parent_id = $request->input('parentCategory');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->slug = Str::slug($category->name, '-');
        $image_file = $request->file('featuredLogo');

        if($image_file){

            // set a file name to upload to the folder
            $filename = time() . '-' . $category->slug . '.' . File::extension($image_file->getClientOriginalName());

            Storage::disk('public')->put('original/'.$filename, File::get($image_file));
            $category->featured_logo = $filename;

            $img = Image::make(storage_path('app/public/original/').$filename)->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            });

            $img->save(storage_path('app/public/').'resized-'.$filename);

            $category->thumb_featured_logo = 'resized-'.$filename;
            
        }

        $category->update();

        return redirect('/admin/categories')->with('success', 'Kategori başarıyla güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect('/admin/categories')->with('success', 'Kategori başarıyla silindi');
    }

    public function search(Request $request){

        // validation has been done using only empty function
        $searchTerm = $request->input('searchTerm');

        if(!empty($searchTerm)){
            $categories = Category::with('children')
                          ->whereHas('parent', function($query) use($searchTerm){
                            $query->where('name', 'LIKE', '%'.$searchTerm.'%')
                                  ->orWhere('description', 'LIKE', '%'.$searchTerm.'%');
                          })
                          ->orWhere('name', 'LIKE', '%'.$searchTerm.'%')
                          ->orWhere('description', 'LIKE', '%'.$searchTerm.'%')
                          ->orderBy('id', 'desc')
                          ->get();
            // dd($categories);
        }else{
            $categories = Category::with('children')->orderBy('id', 'desc')->get();
        }

        return view('categories.index')->with('categories', $categories);
    }
}
