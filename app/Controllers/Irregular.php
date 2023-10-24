<?php

namespace App\Controllers;
use App\Models\Irregular\IrregularModel;

class Irregular extends BaseController
{
    public function index()
    {
        if(session()->get('id_user') != '1') {
            return;
        }

        $IrregularModel = new IrregularModel();

        $data_view['irregular'] = $IrregularModel->getIrregular();
		
        $data_head['title_html'] = 'Irregular - Improve English Vocabulary';
		$data_footer['optional_scripts'] = '<script src="'.base_url().'/assets/'.localJS('game').'.js?ver=1.0.1"></script>';

        return  view('head', $data_head).
                view('navbar').
                view('irregular/irregular', $data_view).
                view('footer', $data_footer);   
    }

    public function table()
    {
        if(session()->get('id_user') != '1') {
            return;
        }

        $IrregularModel = new IrregularModel();

        $data_view['irregular'] = $IrregularModel->getAllIrregular();
		
        $data_head['title_html'] = 'Irregular - Improve English Vocabulary';

        return  view('head', $data_head).
                view('navbar').
                view('irregular/table', $data_view).
                view('footer');   
    }
}