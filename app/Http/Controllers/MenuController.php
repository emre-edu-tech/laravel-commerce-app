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
    	   $menu['/'] = 'Homepage';
           $menu['/shop'] = 'Shop';
           $menu['/about'] = 'About';
           $menu['/contact'] = 'Contact';
    	}else{
            if ($user->hasRole('Administator')) {
                $menu['/home'] = 'Dashboard';
                $menu['/'] = 'Homepage';
                $menu['/shop'] = 'Shop';
                $menu['/about'] = 'About';
                $menu['/contact'] = 'Contact';
                $menu['/admin/categories/create'] = 'New Category';
                $menu['/admin/categories'] = 'Categories';
                $menu['/admin/products/create'] = 'New Product';
                $menu['/admin/products'] = 'Products';
                $menu['/admin//posts/create'] = 'New Post';
                $menu['/admin/posts'] = 'Posts';
            }

            if($user->hasRole('Customer')){
                $menu['/home'] = 'Dashboard';
                $menu['/'] = 'Homepage';
                $menu['/shop'] = 'Shop';
                $menu['/about'] = 'About';
                $menu['/contact'] = 'Contact';
                $menu['/orders'] = 'Orders';
            }
        }

        // return the user menu that we have built above
        return $menu;
    }
}
