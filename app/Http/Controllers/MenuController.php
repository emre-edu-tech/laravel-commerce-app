<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function getUserMenu(){
    	// return an array of menu items
    	// empty array
    	$menu = array();

    	// get the authenticated user
    	$user = Auth::user();

    	// no authenticated or customer user exists show normal frontend
    	if (is_null($user)) {
    	   $menu['/'] = 'Anasayfa';
           $menu['/about'] = 'Hakkımızda';
           $menu['/blog'] = 'Blog';
           $menu['/contact'] = 'İletişim';
    	}else{
            if ($user->hasRole('Administator')) {
                $menu['/'] = 'Anasayfa';
                $menu['/about'] = 'Hakkımızda';
                $menu['/blog'] = 'Blog';
                $menu['/contact'] = 'İletişim';
                $menu['/admin/home'] = 'Yönetim Paneli';
                $menu['/admin/categories/create'] = 'Yeni Kategori';
                $menu['/admin/categories'] = 'Kategoriler';
                $menu['/admin/products/create'] = 'Yeni Ürün';
                $menu['/admin/products'] = 'Ürünleri Yönet';
                $menu['/admin/postcategories/create'] = 'Yeni Blog Kategorisi';
                $menu['/admin/postcategories'] = 'Blog Kategorileri Yönet';
                $menu['/admin//posts/create'] = 'Yeni Yazı';
                $menu['/admin/posts'] = 'Blog Yönet';
            }

            if($user->hasRole('Customer')){
                
                $menu['/'] = 'Anasayfa';
                $menu['/about'] = 'Hakkımızda';
                $menu['/blog'] = 'Blog';
                $menu['/contact'] = 'İletişim';
                $menu['/orders'] = 'Siparişler';
            }
        }

        // return the user menu that we have built above
        return $menu;
    }
}
