<?php

namespace App\Controllers;
use App\Models\Sentences\SentencesModel;

class Sentences extends BaseController
{
    public function index()
    {
        $SentencesModel = new SentencesModel();

		$limit_page = 20;

		$data_view['num_page'] = $num_page = intval(isset($_GET['page']) ? $_GET['page'] : 1);

		$data_view['search_english'] = $search_english = $this->request->getGet('search_english');
		$data_view['search_native'] = $search_native = $this->request->getGet('search_native');

		$number_total_register = $SentencesModel->countNumberSentences($search_english, $search_native);

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

		$data_view['sentences_user'] = $SentencesModel->getSentences($limit_page, $init, $search_english, $search_native);
		$data_footer['optional_scripts'] = '<script src="'.base_url().'/assets/'.localJS('sentences').'.js?ver=1.0.2"></script>';
		
        $data_head['title_html'] = 'Sentences - Improve English Vocabulary';

        return  view('head', $data_head).
                view('navbar').
                view('sentences/sentences', $data_view).
                view('footer', $data_footer);    
    }

    public function save_sentence()
	{
		if ($this->request->getMethod() == 'post') {

			$SentencesModel = new SentencesModel();

			$data = array(
				'id_user' => session()->get('id_user'),
				'english_sentence' => str_replace('"', "'", $this->request->getPost('english_sentence')),
				'native_sentence' => str_replace('"', "'", $this->request->getPost('native_sentence')),
				'active_in_game' => 0,
				'last_appearance_in_game' => date('Y-m-d H:i:s', strtotime('-7 minutes')),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			);

			$SentencesModel->saveSentences($data);

			$actual_page = $this->request->getPost('actual_page');
			if($actual_page == '0') {
				$actual_page = '';
			} else {
				$actual_page = '?page='.$actual_page;
			}

			return redirect()->to(base_url().'/sentences'.$actual_page);
			exit();

		}
		
	}

	public function ajax_edit_sentence()
	{
		if ($this->request->getMethod() == 'post') {

			$SentencesModel = new SentencesModel();
			$id_sentence = get_show_id($this->request->getPost('info'));
			if(is_numeric($id_sentence)) {

				$data = array(
					'english_sentence' => str_replace('"', "'", $this->request->getPost('english')),
					'native_sentence' => str_replace('"', "'", $this->request->getPost('native')),
					'active_in_game' => 0,
					'last_appearance_in_game' => date('Y-m-d H:i:s', strtotime('-7 minutes')),
					'updated_at' => date('Y-m-d H:i:s'),
				);

				$SentencesModel->editSentences($id_sentence, $data);

				return TRUE;
			} else {
				return FALSE;
			}

		}
	}

	public function ajax_delete_sentence()
	{
		if ($this->request->getMethod() == 'post') {

			$SentencesModel = new SentencesModel();

			$id_sentence = get_show_id($this->request->getPost('info'));
			if(is_numeric($id_sentence)) {
				$SentencesModel->deleteSentences($id_sentence);
				return TRUE;
			} else {
				return FALSE;
			}

		}

	}

}
