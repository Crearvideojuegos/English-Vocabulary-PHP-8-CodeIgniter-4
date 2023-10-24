<?php

namespace App\Controllers;
use App\Models\Session\RegisterModel;
use App\Libraries\Phpass\PasswordHash;
use App\Libraries\Emails\EmailsUser;

class Register extends BaseController
{
    public function register()
    {
        isLoggedReturn();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'register_nickname' => 'required|min_length[3]|max_length[50]|alpha_numeric_space',
                'register_email' => 'required|min_length[6]|max_length[100]|valid_email',
                'register_password' => 'required|min_length[6]|max_length[255]',
                'register_password_two' => 'required|min_length[6]|max_length[255]|matches[register_password]',
                'native_language' => 'required|min_length[1]|max_length[2]',
            ];


            if ($this->validate($rules)) {

                $RegisterModel = new RegisterModel();

                $user_nickname = trim($this->request->getPost('register_nickname'));
                $user_email = trim($this->request->getPost('register_email'));
                $user_pass = $this->request->getPost('register_password');
                $native_language = $this->request->getPost('native_language');

                $exists_nickname_email = $RegisterModel->exists_nickname_email($user_nickname, $user_email);

                if($exists_nickname_email == 1) {
                    // Insert User

                    $wp_hasher = new PasswordHash( 8, true );
                    $user_pass = $wp_hasher->HashPassword(trim($user_pass));

                    $code_for_activation = bin2hex(random_bytes(16));

                    $data_user = array(
                        'user_nickname' => $user_nickname,
                        'user_email' => $user_email,
                        'user_pass' => $user_pass,
                        'id_user_type' => '1',
                        'user_status' => 0,
                        'id_native_language' => $native_language,
                        'is_premium' => 0,
                        'code_for_activation' => $code_for_activation,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'deleted_at' => NULL
                    );
        
                    $id_user = $RegisterModel->insert_user($data_user);

                    if(!$id_user) {

                        $data_view['register_user_error'] = 'Unexpected error. Try again.';

                        return  view('head').
                                view('navbar').
                                view('home/home', $data_view).
                                view('footer');
                        exit();
                    }

                    $EmailsUser = new EmailsUser();
                    $EmailsUser->email_welcome_register($user_nickname, $user_email, $code_for_activation);

                    session()->setFlashdata('redirect_post_register', 'yes');
                    return redirect()->to(base_url().'/register/check-email');
                    exit();

                } else {

                    if($exists_nickname_email == 2) {
                        $data_view['register_user_error'] = 'Exist Nickname';
                    } else if ($exists_nickname_email == 3) {
                        $data_view['register_user_error'] = 'Exist Email';
                    } else if($exists_nickname_email == 4) {
                        $data_view['register_user_error'] = 'Exist Nickname and Email';
                    }

                }

            } else {
                $data_view['register_validation'] = $this->validator;
            }
        } //End Post
        else {
            $data_view = '';
        }

        if(!isLoggedBool()) {
            $variables_footer['optional_scripts'] = '
                <script src="'.base_url().'/assets/'.localJS('loginValidation').'.js"></script>
                <script src="'.base_url().'/assets/'.localJS('registerValidation').'.js"></script>

            ';
        }

        return  view('head').
                view('navbar').
                view('home/home', $data_view).
                view('footer', $variables_footer);
    }

    public function check_email()
    {
        isLoggedReturn();

        if(session()->getFlashdata('redirect_post_register') == 'yes')
        {
            return  view('head').
                    view('navbar').
                    view('register/check_email').
                    view('footer');
            exit();
        }

        return redirect()->to(base_url());
        exit();
    }

    public function email_activation($code_for_activation)
    {
        isLoggedReturn();

        $RegisterModel = new RegisterModel();
        $is_active = $RegisterModel->active_email($code_for_activation);

        if($is_active) {
            session()->setFlashdata('email_active', 'yes');
        } else {
            session()->setFlashdata('email_active', 'no');
        }

        return redirect()->to(base_url().'/register/email-activated');
        exit();

    }

    public function email_activated()
    {
        isLoggedReturn();

        if(session()->has('email_active')) 
        {

            if(session()->getFlashdata('email_active'))
            {
                $data_view['is_corrected'] = 'yes';
            } else {
                $data_view['is_corrected'] = 'no';
            }
    
            return  view('head').
                    view('navbar').
                    view('register/email_activated', $data_view).
                    view('footer');
            exit();
            

        } else {
            return redirect()->to(base_url());
            exit();
        }
    }


}

