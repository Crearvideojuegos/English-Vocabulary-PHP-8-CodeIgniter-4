<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $data_head['title_html'] = 'About - Improve English Vocabulary';

        return  view('head', $data_head) .
                view('navbar') .
                view('about/about') .
                view('footer');
    }
}