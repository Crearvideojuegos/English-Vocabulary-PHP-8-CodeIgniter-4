<?php

namespace App\Models\Words;

use CodeIgniter\Model;

class WordsModel extends Model
{
    public function countNumberWords($search_word, $search_native, $search_description)
    {
        $builder = $this->db->table('word_user wu');
        $builder->selectCount('wu.id');
        $builder->where('wu.id_user', session()->get('id_user'));

        if(!empty($search_word)) { $builder->like('wu.english_word', $search_word); }
        if(!empty($search_native)) { $builder->like('wu.native_word', $search_native); }
        if(!empty($search_description)) { $builder->like('wu.description', $search_description); }

        $builder->orderBy('wu.created_at', 'DESC');
        $query = $builder->get();

        return $query->getResult()[0]->id;    
    }

    public function getWords($limit_page, $init, $search_word, $search_native, $search_description)
    {
        $builder = $this->db->table('word_user wu');
        $builder->select('wu.id, wu.english_word, wu.native_word, wu.description, wu.number_failed, wu.number_success,
        wu.active_in_game, wu.created_at');
        $builder->where('wu.id_user', session()->get('id_user'));

        if(!empty($search_word)) { $builder->like('wu.english_word', $search_word); }
        if(!empty($search_native)) { $builder->like('wu.native_word', $search_native); }
        if(!empty($search_description)) { $builder->like('wu.description', $search_description); }

        $builder->orderBy('wu.created_at', 'DESC');

        $builder->limit($limit_page, $init);

        $query = $builder->get()->getResultArray();

        if ($query) {
            return $query;
        } 
        return FALSE;
    }

    public function saveWords($data)
    {
        $builder = $this->db->table('word_user');
        $builder->insert($data);
    }
    
    public function editWords($id_word, $data)
    {
        $builder = $this->db->table('word_user');
        $builder->where('id_user', session()->get('id_user'));
        $builder->where('id', $id_word);
        $builder->update($data);
    }

    public function deleteWords($id_word)
    {
        $builder = $this->db->table('word_user wu');
        $builder->where(['id' => $id_word, 'id_user' => session()->get('id_user')]);
        $builder->delete();
    }

    public function checkNewWord($english_word)
    {
        $builder = $this->db->table('word_user wu');
        $builder->select('wu.id');
        $builder->where('wu.english_word', $english_word);
        $builder->where('wu.id_user', session()->get('id_user'));

        $query = $builder->get()->getResultArray();

        if ($query) {
            return TRUE;
        }
        return FALSE;
    }

}