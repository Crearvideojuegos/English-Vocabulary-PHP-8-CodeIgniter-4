<?php

namespace App\Models\Sentences;

use CodeIgniter\Model;

class SentencesModel extends Model
{
    public function countNumberSentences($search_english, $search_native)
    {
        $builder = $this->db->table('sentence_user su');
        $builder->selectCount('su.id');
        $builder->where('su.id_user', session()->get('id_user'));

        if(!empty($search_english)) { $builder->like('su.english_sentence', $search_english); }
        if(!empty($search_native)) { $builder->like('su.native_sentence', $search_native); }

        $builder->orderBy('su.created_at', 'DESC');
        $query = $builder->get();

        return $query->getResult()[0]->id;    
    }

    public function getSentences($limit_page, $init, $search_english, $search_native)
    {
        $builder = $this->db->table('sentence_user su');
        $builder->select('su.id, su.english_sentence, su.native_sentence, su.number_failed, su.number_success,
        su.active_in_game, su.created_at');
        $builder->where('su.id_user', session()->get('id_user'));

        if(!empty($search_english)) { $builder->like('su.english_sentence', $search_english); }
        if(!empty($search_native)) { $builder->like('su.native_sentence', $search_native); }
        
        $builder->orderBy('su.created_at', 'DESC');

        $builder->limit($limit_page, $init);

        $query = $builder->get()->getResultArray();

        if ($query) {
            return $query;
        } 
        return FALSE;
    }

    public function saveSentences($data)
    {
        $builder = $this->db->table('sentence_user');
        $builder->insert($data);
    }

    public function editSentences($id_sentence, $data)
    {
        $builder = $this->db->table('sentence_user');
        $builder->where('id_user', session()->get('id_user'));
        $builder->where('id', $id_sentence);
        $builder->update($data);
    }

    public function deleteSentences($id_sentence)
    {
        $builder = $this->db->table('sentence_user su');
        $builder->where(['id' => $id_sentence, 'id_user' => session()->get('id_user')]);
        $builder->delete();
    }


}