<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return  view('head').
                view('navbar').
                view('home/home').
                view('footer');    
    }
}
