<?php

namespace App\Models\Mistakes;

use CodeIgniter\Model;

class MistakesModel extends Model
{
    public function resetMistakes()
    {
        $builder = $this->db->table('word_user');
        $builder->where('id_user', session()->get('id_user'));
        $builder->set('active_in_game', '0');
        $builder->set('last_appearance_in_game', date('Y-m-d H:i:s', strtotime('-7 minutes')));
        $builder->update();

        $builder = $this->db->table('sentence_user');
        $builder->where('id_user', session()->get('id_user'));
        $builder->set('active_in_game', '0');
        $builder->set('last_appearance_in_game', date('Y-m-d H:i:s', strtotime('-7 minutes')));
        $builder->update();
    }

    public function countNumberMistakes()
    {
        $builder = $this->db->table('word_user wu');
        $builder->selectCount('wu.id');
        $builder->where('wu.id_user', session()->get('id_user'));
        $builder->where('wu.active_in_game', '1');
        $query = $builder->get();

        $number_words = $query->getResult()[0]->id;

        $builder = $this->db->table('sentence_user su');
        $builder->selectCount('su.id');
        $builder->where('su.id_user', session()->get('id_user'));
        $builder->where('su.active_in_game', '1');
        $query = $builder->get();

        $number_sentences = $query->getResult()[0]->id;

        return $number_words + $number_sentences;
    }

    public function getMistakes($limit_page, $init)
    {
        //Words
        $builder = $this->db->table('word_user wu');
        $builder->select('wu.id, wu.english_word AS english, wu.native_word AS native, wu.description, 
        unix_timestamp(wu.last_appearance_in_game) AS date_order');
        $builder->where('wu.id_user', session()->get('id_user'));
        $builder->where('wu.active_in_game', '1');
        $builder->orderBy('wu.last_appearance_in_game', 'DESC');

        $builder->limit($limit_page, $init);

        $query_words = $builder->get()->getResultArray();

        //Sentences

        $builder = $this->db->table('sentence_user su');
        $builder->select('su.id, su.english_sentence AS english, su.native_sentence AS native, 
        unix_timestamp(su.last_appearance_in_game) AS date_order');
        $builder->where('su.id_user', session()->get('id_user'));
        $builder->where('su.active_in_game', '1');
        $builder->orderBy('su.last_appearance_in_game', 'DESC');

        $builder->limit($limit_page, $init);

        $query_sentences = $builder->get()->getResultArray();

        $querys = array_merge($query_words, $query_sentences);

        return $querys;
    }

}