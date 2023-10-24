<?php

namespace App\Models\Export;

use CodeIgniter\Model;

class ExportModel extends Model
{
    public function getWords()
    {
        $builder = $this->db->table('word_user wu');
        $builder->select('wu.id, wu.english_word, wu.native_word, wu.description, wu.number_failed, wu.number_success,
        wu.active_in_game, wu.created_at');
        $builder->where('wu.id_user', session()->get('id_user'));

        $builder->orderBy('wu.created_at', 'DESC');

        $query = $builder->get()->getResultArray();

        if ($query) {
            return $query;
        }
        return FALSE;
    }

    public function getSentences()
    {
        $builder = $this->db->table('sentence_user su');
        $builder->select('su.id, su.english_sentence, su.native_sentence, su.number_failed, su.number_success,
        su.active_in_game, su.created_at');
        $builder->where('su.id_user', session()->get('id_user'));
        
        $builder->orderBy('su.created_at', 'DESC');

        $query = $builder->get()->getResultArray();

        if ($query) {
            return $query;
        } 
        return FALSE;
    }

    public function getEmailUser()
    {
        $query = $this->db->table('user u');
        $query->select('u.user_email');
        $query->where('u.deleted_at IS NULL');
        $query->where('u.user_status', 1);
        $query->where('u.id', session()->get('id_user'));

        $result = $query->get()->getRow();

        return $result->user_email;
    }


}