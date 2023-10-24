<?php

namespace App\Models\Session;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    public function exists_nickname_email($user_nickname, $user_email)
    {
        $exist_nickname = FALSE;
        $exist_email = FALSE;
        $check = 1;

        // Check Nickname
        $query = $this->db->table('user u');
        $query->select('u.user_nickname');
        $query->where('u.user_nickname', $user_nickname);

        $result = $query->get()->getRow();

        if(!is_null($result)) {
            $exist_nickname = TRUE;
        }

        // Check Email
        $query = $this->db->table('user u');
        $query->select('u.user_email');
        $query->where('u.user_email', $user_email);

        $result = $query->get()->getRow();

        if(!is_null($result)) {
            $exist_email = TRUE;
        }

        // Return if exist nickname, email or both
        if($exist_nickname && !$exist_email)
        {
            $check = 2;
        } else if(!$exist_nickname && $exist_email)
        {
            $check = 3;
        } else if($exist_nickname && $exist_email) {
            $check = 4;
        }

        return $check;
    }

    public function insert_user($data_user) 
    {
        $builder = $this->db->table('user');
        $builder->insert($data_user);
        $id_user = $this->db->insertID();

        if(is_numeric($id_user) && $id_user != 0) {
            return $id_user;
        } else {
            return FALSE;
        }
    }

    public function active_email($code_for_activation)
    {
        $query = $this->db->table('user u');
        $query->select('u.id');
        $query->where('u.deleted_at IS NULL');
        $query->where('u.code_for_activation', $code_for_activation);

        $result = $query->get()->getRow();

        if(!is_null($result)) {
            $user_id = $result->id;

            $data_user = array(
                'user_status' => 1,
                'code_for_activation' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $builder = $this->db->table('user');
            $builder->where('id', $user_id);
            $builder->update($data_user);

            return TRUE;
            
        }

        return FALSE;
    }


}