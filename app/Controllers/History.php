<?php

namespace App\Controllers;
use App\Models\History\HistoryModel;

class History extends BaseController
{
    public function index()
    {

        $HistoryModel = new HistoryModel();

		$limit_page = 100;

		$data_view['num_page'] = $num_page = intval(isset($_GET['page']) ? $_GET['page'] : 1);

		$number_total_register = $HistoryModel->countNumberHistory();

		if($number_total_register >= $limit_page) {
			$data_view['total_pages'] = ceil($number_total_register / $limit_page);
		} else {
			$data_view['total_pages'] = 1;
		}

		$data_view['counter'] = $counter = 2;
		$data_view['initial_number'] = $num_page - $counter;
		$data_view['number_condition_limit'] = ($num_page + 2) + 1;

		if($num_page == 1) {
			$init = 0;
		} else {
			$init = ($num_page - 1) * $limit_page;
		}

		$data_view['history_user'] = $HistoryModel->getHistory($limit_page, $init);
		$data_footer['optional_scripts'] = '<script src="'.base_url().'/assets/'.localJS('history').'.js?ver=1.0.0"></script>';
		
        $data_head['title_html'] = 'History - Improve English Vocabulary';

        return  view('head', $data_head).
                view('navbar').
                view('history/history', $data_view).
                view('footer', $data_footer);    
    }
}
