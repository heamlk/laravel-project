<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function homepage()
    {
        $myName = 'John Doe';
        $animals = array('Dog', 'Cat', 'Bird');

        return view('homepage', array('name' => $myName, 'animals' => $animals));
    }

    public function about()
    {
        return view('about');
    }
}
