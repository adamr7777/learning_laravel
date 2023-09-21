<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function homePage() {
        return view('homePage');
    }

    public function aboutPage() {
        $name = 'Ted';
        return view('aboutPage', ['name' => $name]);
    }
}
