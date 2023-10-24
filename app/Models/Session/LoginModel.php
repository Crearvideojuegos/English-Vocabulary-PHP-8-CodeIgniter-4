<?php

namespace App\Models\Session;

use CodeIgniter\Model;
use App\Libraries\Phpass\PasswordHash;

class LoginModel extends Model
{
    public function login(string $user_email, string $user_pass)
    {
        $query = $this->db->table('user u');
        $query->select('u.user_pass');
        $query->where('u.deleted_at IS NULL');
        $query->where('u.user_email', $user_email);

        $result = $query->get()->getRow();

        if(!is_null($result)) {
            $hash = $result->user_pass;
        }
        else {
            return FALSE;
        }

        $wp_hasher = new PasswordHash(8, true);
        $pass_hashed = $wp_hasher->CheckPassword($user_pass, $hash);

        if($pass_hashed == TRUE) {
            $query = $this->db->table('user u');
            $query->select('u.id, u.user_status, u.user_nickname, u.id_native_language');
            $query->where('u.deleted_at IS NULL');
            $query->where('u.user_email', $user_email);
            $query->groupBy('u.id');
            $query->limit('1');

            $result = $query->get()->getResultArray();

            return $result;
        }
        else {
            return FALSE;
        }
        return FALSE;
    }

    public function check_email_recovery_password(string $user_email)
    {
        $query = $this->db->table('user u');
        $query->select('u.id');
        $query->where('u.deleted_at IS NULL');
        $query->where('u.user_status', 1);
        $query->where('u.user_email', $user_email);

        $result = $query->get()->getRow();

        if(!is_null($result)) {

            $code_for_recovery = bin2hex(random_bytes(16));

            $data_user = array(
                'id_user' => $result->id,
                'code_for_recovery' => $code_for_recovery,
                'created_at' => date('Y-m-d H:i:s')
            );

            $builder = $this->db->table('user_recovery_password');
            $builder->insert($data_user);

            return $code_for_recovery;

        }

        return FALSE;
    }


    public function update_password($password_recovery, $code_email)
    {
        $query = $this->db->table('user_recovery_password urp');
        $query->select('urp.id_user');
        $query->where('urp.code_for_recovery',$code_email);

        $result = $query->get()->getRow();

        if(!is_null($result)) {

            $wp_hasher = new PasswordHash( 8, true );
            $user_pass = $wp_hasher->HashPassword(trim($password_recovery));

            $data_user = array(
                'user_pass' => $user_pass,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $builder = $this->db->table('user');
            $builder->where('id', $result->id_user);
            $builder->update($data_user);

            $builder = $this->db->table('user_recovery_password');
            $builder->delete(['id_user' => $result->id_user]);

        }

        return FALSE;
    }




}