<?php

namespace Nayourown\Http\Controllers;

use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    /** Returns the entry into the SPA */
    public function index()
    {
        return view('app');
    }
}
