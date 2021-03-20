<?php

namespace App\Http\Controllers;

class MainPageController extends Controller
{

    /**
     * Main page
     */
    public function index()
    {
        return view('posts.index');
    }

    public function about()
    {
        return view('profile.about');
    }

}
