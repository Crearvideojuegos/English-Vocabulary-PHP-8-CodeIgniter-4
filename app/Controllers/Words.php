<?php

namespace App\Controllers;
use App\Models\Words\WordsModel;

class Words extends BaseController
{
    public function index()
    {
        $WordsModel = new WordsModel();

		$limit_page = 100;

		$data_view['num_page'] = $num_page = intval(isset($_GET['page']) ? $_GET['page'] : 1);


		$data_view['search_word'] = $search_word = $this->request->getGet('search_word');
		$data_view['search_native'] = $search_native = $this->request->getGet('search_native');
		$data_view['search_description'] = $search_description = $this->request->getGet('search_description');


		$number_total_register = $WordsModel->countNumberWords($search_word, $search_native, $search_description);

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

		$data_view['words_user'] = $WordsModel->getWords($limit_page, $init, $search_word, $search_native, $search_description);
		$data_footer['optional_scripts'] = '<script src="'.base_url().'/assets/'.localJS('words').'.js?ver=1.0.2"></script>';
		
        $data_head['title_html'] = 'Words - Improve English Vocabulary';


        return  view('head', $data_head).
                view('navbar').
                view('words/words', $data_view).
                view('footer', $data_footer);    
    }

    public function save_word()
	{
		if ($this->request->getMethod() == 'post') {

			if($this->request->getPost('native_word') == '' || $this->request->getPost('english_word') == '')
			{
				return FALSE;
			}

			$WordsModel = new WordsModel();
			$english_word = ucfirst($this->request->getPost('english_word'));
			$english_word = trim($english_word);

						$WordsModel = new WordsModel();
			$native_word = ucfirst($this->request->getPost('native_word'));
			$native_word = trim($native_word);

			

			$data = array(
				'id_user' => session()->get('id_user'),
				'english_word' => str_replace('"', "'", $english_word),
				'native_word' => str_replace('"', "'", $native_word),
				'description' => str_replace('"', "'",$this->request->getPost('description')),
				'active_in_game' => 0,
				'last_appearance_in_game' => date('Y-m-d H:i:s', strtotime('-7 minutes')),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			);

			$WordsModel->saveWords($data);

			$actual_page = $this->request->getPost('actual_page');
			if($actual_page == '0') {
				$actual_page = '';
			} else {
				$actual_page = '?page='.$actual_page;
			}

			return redirect()->to(base_url().'/words'.$actual_page);
			exit();

		}
		
	}

	public function ajax_edit_word()
	{
		if ($this->request->getMethod() == 'post') {

			if($this->request->getPost('native') == '' || $this->request->getPost('english') == '')
			{
				return FALSE;
			}

			$WordsModel = new WordsModel();
			$id_word = get_show_id($this->request->getPost('info'));
			if(is_numeric($id_word)) {

				$data = array(
					'english_word' => str_replace('"', "'", $this->request->getPost('english')),
					'native_word' => str_replace('"', "'", $this->request->getPost('native')),
					'description' => str_replace('"', "'", $this->request->getPost('description')),
					'active_in_game' => 0,
					'last_appearance_in_game' => date('Y-m-d H:i:s', strtotime('-7 minutes')),
					'updated_at' => date('Y-m-d H:i:s'),
				);

				$WordsModel->editWords($id_word, $data);

				return TRUE;
			} else {
				return FALSE;
			}

		}
	}

	public function ajax_delete_word()
	{
		if ($this->request->getMethod() == 'post') {

			$WordsModel = new WordsModel();

			$id_word = get_show_id($this->request->getPost('info'));
			if(is_numeric($id_word)) {
				$WordsModel->deleteWords($id_word);
				return TRUE;
			} else {
				return FALSE;
			}

		}

	}

	public function check_new_word()
	{
		if ($this->request->getMethod() == 'post') {

			$WordsModel = new WordsModel();

			$exist = $WordsModel->checkNewWord($this->request->getPost('info')); 

			if($exist) {
				echo 'yes';
			} else {
				echo 'no';
			}

		}
	}


}
