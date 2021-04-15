<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::latest()->take(5)->get();
        return view('homepage', compact('categories'));
    }
}
