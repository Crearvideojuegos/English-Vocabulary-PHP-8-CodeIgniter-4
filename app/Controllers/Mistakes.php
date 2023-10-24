<?php

namespace App\Controllers;
use App\Models\Mistakes\MistakesModel;

class Mistakes extends BaseController
{
    public function index()
    {
        $MistakesModel = new MistakesModel();

		$limit_page = 100;

		$data_view['num_page'] = $num_page = intval(isset($_GET['page']) ? $_GET['page'] : 1);

		$number_total_register = $MistakesModel->countNumberMistakes();

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

		$mistakes_user = $MistakesModel->getMistakes($limit_page, $init);

		usort($mistakes_user, function ($item1, $item2) {
			return $item2['date_order'] <=> $item1['date_order'];
		});

		$data_view['mistakes_user'] = $mistakes_user;

		$data_head['title_html'] = 'Mistakes - Improve English Vocabulary';

        return  view('head', $data_head).
                view('navbar').
                view('mistakes/mistakes', $data_view).
                view('footer');    
    }

	public function reset_mistakes()
	{
        $MistakesModel = new MistakesModel();
		$MistakesModel->resetMistakes();

		return redirect()->to(base_url().'/mistakes');
	}

}
