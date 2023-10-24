<?php

namespace App\Models\History;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    public function countNumberHistory()
    {
        $builder = $this->db->table('failure_history_user fhu');
        $builder->selectCount('fhu.id');
        $builder->where('fhu.id_user', session()->get('id_user'));
        $query = $builder->get();

        return $query->getResult()[0]->id;
    }

    public function getHistory($limit_page, $init)
    {
        $builder = $this->db->table('failure_history_user fhu');
        $builder->select('
        fhu.id_word, fhu.id_sentence, fhu.created_at,
        wu.english_word, wu.native_word, wu.description, wu.number_failed AS word_failed, wu.number_success AS word_success,
        wu.active_in_game AS word_game,
        su.english_sentence, su.native_sentence, su.number_failed AS sentence_failed, su.number_success AS sentence_success,
        su.active_in_game AS sentence_game,');
        $builder->join('word_user wu', 'wu.id = fhu.id_word', 'left');
        $builder->join('sentence_user su', 'su.id = fhu.id_sentence', 'left');
        $builder->where('fhu.id_user', session()->get('id_user'));
        $builder->orderBy('fhu.created_at', 'DESC');

        $builder->limit($limit_page, $init);

        return $builder->get()->getResultArray();
    }

}