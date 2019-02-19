<?php

namespace App\Http\Controllers;
use App\Items;

class HomeController extends Controller
{
    /**
     * Display the TodoList homepage.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Items::setId();
        return view('home.index');
    }
}
