<?php

namespace App\Models\Profile;

use CodeIgniter\Model;
use App\Libraries\Phpass\PasswordHash;

class ProfileModel extends Model
{
    public function obtain_info_user_by_id()
    {
        $query = $this->db->table('user u');
        $query->select('u.user_nickname, u.user_email');
        $query->where('u.id', session()->get('id_user'));
        $query->groupBy('u.id');

        $result = $query->get()->getResultArray();

        return $result;
    }

    public function update_password($password_recovery, $actual_password)
    {
        $wp_hasher = new PasswordHash(8, true);

        $query = $this->db->table('user u');
        $query->select('u.user_pass');
        $query->where('u.deleted_at IS NULL');
        $query->where('u.id', session()->get('id_user'));

        $result = $query->get()->getRow();

        if(!is_null($result)) {
            $hash = $result->user_pass;
        }
        else {
            return FALSE;
        }

        $pass_hashed = $wp_hasher->CheckPassword($actual_password, $hash);

        if($pass_hashed == TRUE) {

            $user_pass = $wp_hasher->HashPassword(trim($password_recovery));

            $data_user = array(
                'user_pass' => $user_pass,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $builder = $this->db->table('user');
            $builder->where('id', session()->get('id_user'));
            $builder->update($data_user);

            return TRUE;

        } else {
            return FALSE;
        }
    }

    public function delete_account()
    {

        $data_user = array(
            'user_email' => 'XXXXXXXXXXXXXXXXXXXXXX',
            'user_pass' => 'XXXXXXXXXXXXXXXXXXXXXX',
            'updated_at' => date('Y-m-d H:i:s'),
            'user_status' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $builder = $this->db->table('user');
        $builder->where('id', session()->get('id_user'));
        $builder->update($data_user);
    }

    public function update_voice($voice_selected)
    {
        $data_user = array(
            'user_voice_selected' => $voice_selected,
        );

        $builder = $this->db->table('user');
        $builder->where('id', session()->get('id_user'));
        $builder->update($data_user);
    }

}