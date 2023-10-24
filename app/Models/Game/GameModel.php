<?php

namespace App\Models\Game;

use CodeIgniter\Model;

class GameModel extends Model
{
    public function selectSentence($origin = '')
    {
        $builder = $this->db->table('sentence_user su');
        $builder->select('su.id, su.english_sentence, su.native_sentence');
        $builder->where('su.id_user', session()->get('id_user'));
        $builder->where('active_in_game != 2');
        $builder->where('last_appearance_in_game <= "'.date('Y-m-d H:i:s').'" - INTERVAL 5 MINUTE');        
        $builder->limit(1);
        $builder->orderBy('id', 'RANDOM');

        $query = $builder->get()->getResultArray();

        if (empty($query)) {
            $data = array(
                'active_in_game' => '0',
                'last_appearance_in_game' => date('Y-m-d H:i:s', strtotime('-7 minutes')),
            );
            
            $builder = $this->db->table('sentence_user');
            $builder->where('id_user', session()->get('id_user'));
            $builder->update($data);
        }

        $builder = $this->db->table('sentence_user su');
        $builder->select('su.id, su.english_sentence, su.native_sentence');
        $builder->where('su.id_user', session()->get('id_user'));
        $builder->where('active_in_game != 2');
        $builder->where('last_appearance_in_game <= "'.date('Y-m-d H:i:s').'" - INTERVAL 5 MINUTE');        
        $builder->limit(1);
        $builder->orderBy('id', 'RANDOM');

        $query = $builder->get()->getResultArray();

        if(empty($query) && $origin != 'empty') {
            $this->selectWord('empty');
        }

        return $query;
    }

    public function selectWord($origin = '')
    {
        $builder = $this->db->table('word_user wu');
        $builder->select('wu.id, wu.english_word, wu.native_word, wu.description');
        $builder->where('wu.id_user', session()->get('id_user'));
        $builder->where('active_in_game != 2');
        $builder->where('last_appearance_in_game <= "'.date('Y-m-d H:i:s').'" - INTERVAL 5 MINUTE');        
        $builder->limit(1);
        $builder->orderBy('id', 'RANDOM');

        $query = $builder->get()->getResultArray();

        if (empty($query)) {
            $data = array(
                'active_in_game' => '0',
                'last_appearance_in_game' => date('Y-m-d H:i:s', strtotime('-7 minutes')),
            );

            $builder = $this->db->table('word_user');
            $builder->where('id_user', session()->get('id_user'));
            $builder->update($data);
        }

        $builder = $this->db->table('word_user wu');
        $builder->select('wu.id, wu.english_word, wu.native_word, wu.description');
        $builder->where('wu.id_user', session()->get('id_user'));
        $builder->where('active_in_game != 2');
        $builder->where('last_appearance_in_game <= "'.date('Y-m-d H:i:s').'" - INTERVAL 5 MINUTE');        
        $builder->limit(1);
        $builder->orderBy('id', 'RANDOM');

        $query = $builder->get()->getResultArray();

        if(empty($query) && $origin != 'empty') {
            $this->selectSentence('empty');
        }

        return $query;
    }

    public function errorSentence($id)
    {
        $data_update = array(
            'active_in_game' => '1',
            'last_appearance_in_game' => date('Y-m-d H:i:s'),
        );

        $builder = $this->db->table('sentence_user');
        $builder->set('number_failed', 'number_failed+1', FALSE);
        $builder->where('id_user', session()->get('id_user'));
        $builder->where('id', $id);
        $builder->update($data_update);

        //Save error
        $data_sentence = array(
            'id_user' => session()->get('id_user'),
            'id_sentence' => $id,
            'created_at' => date('Y-m-d H:i:s'),
        );

        $builder = $this->db->table('failure_history_user');
        $builder->insert($data_sentence);
    }

    public function errorWord($id)
    {
        $data_update = array(
            'active_in_game' => '1',
            'last_appearance_in_game' => date('Y-m-d H:i:s'),
        );

        $builder = $this->db->table('word_user');
        $builder->set('number_failed', 'number_failed+1', FALSE);
        $builder->where('id_user', session()->get('id_user'));
        $builder->where('id', $id);
        $builder->update($data_update);

        //Save error
        $data_sentence = array(
            'id_user' => session()->get('id_user'),
            'id_word' => $id,
            'created_at' => date('Y-m-d H:i:s'),
        );

        $builder = $this->db->table('failure_history_user');
        $builder->insert($data_sentence);
    }

    public function successSentence($id)
    {
        $data_update = array(
            'active_in_game' => '2',
            'last_appearance_in_game' => date('Y-m-d H:i:s'),
        );

        $builder = $this->db->table('sentence_user');
        $builder->set('number_success', 'number_success+1', FALSE);
        $builder->where('id_user', session()->get('id_user'));
        $builder->where('id', $id);
        $builder->update($data_update);
    }

    public function successWord($id)
    {
        $data_update = array(
            'active_in_game' => '2',
            'last_appearance_in_game' => date('Y-m-d H:i:s'),
        );

        $builder = $this->db->table('word_user');
        $builder->set('number_success', 'number_success+1', FALSE);
        $builder->where('id_user', session()->get('id_user'));
        $builder->where('id', $id);
        $builder->update($data_update);
    }

    public function userHaveWord()
    {
        $builder = $this->db->table('word_user wu');
        $builder->selectCount('wu.id');
        $builder->where('wu.id_user', session()->get('id_user'));

        $builder->orderBy('wu.created_at', 'DESC');
        $query = $builder->get();

        return $query->getResult()[0]->id;    
    }

    public function userHaveSentence()
    {
        $builder = $this->db->table('sentence_user su');
        $builder->selectCount('su.id');
        $builder->where('su.id_user', session()->get('id_user'));

        $builder->orderBy('su.created_at', 'DESC');
        $query = $builder->get();

        return $query->getResult()[0]->id;    
    }

}