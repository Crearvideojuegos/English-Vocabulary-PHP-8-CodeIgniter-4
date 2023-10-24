<?php

namespace App\Controllers;
use App\Models\Game\GameModel;

class Game extends BaseController
{
    public function index()
    {
        $GameModel = new GameModel();

        $user_have_word = $GameModel->userHaveWord();
        $user_have_sentence = $GameModel->userHaveSentence();

        $data_view['user_can_game'] = $user_have_word + $user_have_sentence;

        $number_words_game = session()->get('number_words_game');
        if($number_words_game == '0') {
            $data_view['type_game'] = 'sentence';
            $data_view['game'] = $GameModel->selectSentence();
            session()->set('number_words_game', random_int(3, 7));

            if($user_have_sentence == 0)
            {
                $data_view['type_game'] = 'word';
                $data_view['game'] = $GameModel->selectWord();
            }


        } else {
            $data_view['type_game'] = 'word';
            $data_view['game'] = $GameModel->selectWord();
            session()->set('number_words_game', --$number_words_game);

            if($user_have_word == 0)
            {
                $data_view['type_game'] = 'sentence';
                $data_view['game'] = $GameModel->selectSentence();
            }

        }


		$data_footer['optional_scripts'] = '<script src="'.base_url().'/assets/'.localJS('game').'.js?ver=1.0.1"></script>';

        $data_head['title_html'] = 'Game - Improve English Vocabulary';
        
        return  view('head', $data_head).
                view('navbar').
                view('game/game', $data_view).
                view('footer', $data_footer);    
    }


    public function error_game()
    {
        if ($this->request->getMethod() == 'post') {

			$GameModel = new GameModel();

            $type_game = $this->request->getPost('type_game');
            $id = get_show_id($this->request->getPost('game'));

            if($type_game == 'sentence') {
                $GameModel->errorSentence($id);
            } else if($type_game == 'word') {
                $GameModel->errorWord($id);
            }

        }
        
        return redirect()->to(base_url().'/game');
        exit();
    }


    public function success_game()
    {

        if ($this->request->getMethod() == 'post') {

            $GameModel = new GameModel();

            $type_game = $this->request->getPost('type_game');
            $id = get_show_id($this->request->getPost('game'));

            if($type_game == 'sentence') {
                $GameModel->successSentence($id);
            } else if($type_game == 'word') {
                $GameModel->successWord($id);
            }

        }
        return redirect()->to(base_url().'/game');
        exit();
    }


}
