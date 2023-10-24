<?php

namespace App\Controllers;

class Privacy extends BaseController
{
    public function index()
    {

        $data_head['title_html'] = 'Privacy - Improve English Vocabulary';

        return  view('head', $data_head) .
                view('navbar') .
                view('privacy/privacy') .
                view('footer');
    }
}