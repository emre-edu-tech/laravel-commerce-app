<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PagesController extends Controller
{
    public function getIndex(){

    	$products = Product::orderBy('id', 'desc')->get();

    	$data = [
    		'welcoming' => 'Dervişoğlu Ürünleri',
    		'welcomeParagraph' => 'Bu sayfada ürünlerimizi listeleyebilir ve ürünlerimiz arasında arama yapabilirsiniz',
    		'callToAction' => 'Hakkımızda',
    		'pageTitle' => 'Ürünlerimiz',
    		'products' => $products,
    	];

    	return view('pages.index')->with($data);
    }

    public function getAbout(){
    	$data = [
    		'welcoming' => 'Dervişoğlu Kurumsal',
    		'welcomeParagraph' => 'Firmamıza ait en güncel ve resmi bilgilere bu sayfadan ulaşabilirsiniz',
    		'callToAction' => 'İletişim',
    		'pageTitle' => 'Hakkımızda',
    	];
    	return view('pages.about')->with($data);
    }

    public function getContact(){
    	$data = [
    		'welcoming' => 'Dervişoğlu İletişim',
    		'welcomeParagraph' => 'Bu sayfadan yararlanarak firmamızın yerini öğrenebilir ve iletişim formumuzu kullanarak düşüncelerinizi bize iletebilirsiniz',
    		'callToAction' => 'Ürünlerimiz',
    		'pageTitle' => 'İletişim',
    	];
    	return view('pages.contact')->with($data);
    }

    public function getBlog(){
    	$data = [
    		'welcoming' => 'Dervişoğlu Blog',
    		'welcomeParagraph' => 'Bu sayfadan firmamızla ilgili en son yenilikleri öğrenebilir ve ülkemizdeki tarımsal faaliyetleri takip edebilirsiniz',
    		'callToAction' => 'Popüler Yazılarımız',
    		'pageTitle' => 'Blog'
    	];
    	return view('pages.blog')->with($data);	
    }
}
