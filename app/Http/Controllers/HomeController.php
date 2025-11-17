<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = ProductModel::select('id','name','description','price','image','categoria','badge_tag')->get();
        return view('frontend.home', compact('products'));
    }
}
