<?php

namespace App\Controllers;
use App\Models\Session\LoginModel;
use App\Libraries\Emails\EmailsUser;

class Login extends BaseController
{
    public function login()
    {
        isLoggedReturn();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'login_email' => 'required|min_length[6]|max_length[100]|valid_email',
                'login_password' => 'required|min_length[6]|max_length[255]',
            ];


            if ($this->validate($rules)) {

                $LoginModel = new LoginModel();

                $user_email = trim($this->request->getPost('login_email'));
                $user_pass = $this->request->getPost('login_password');
				$remember = $this->request->getPost('remember_me') == 'on' ? TRUE : FALSE;

                $user = $LoginModel->login($user_email, $user_pass);

                if($user && $user[0]['user_status'] == '1') {
                    $data_session = [
                        'id_user' => $user[0]['id'],
                        'user_status' => $user[0]['user_status'],
                        'user_nickname' => $user[0]['user_nickname'],
                        'id_native_language' => $user[0]['id_native_language'],
                        'number_words_game' => random_int(3, 7)
                    ];

                    session()->set($data_session);
                    if($remember)
                    {
                        session()->sess_expiration = '0';
                    }

                    return redirect()->to(base_url().'/game');
                    exit();
                } else if($user && $user[0]['user_status'] == '0') {
                    $data_view['login_user_error'] = 'Your account is not active.';
                } else {
                    $data_view['login_user_error'] = 'Email or Password is invalid. Please, try again.';
                }
        
            } else {
                $data_view['login_validation'] = $this->validator;
            }
        } //End Post
        else {
            $data_view = '';
        }
        
        $variables_footer['optional_scripts'] = '
            <script src="'.base_url().'/assets/'.localJS('loginValidation').'.js"></script>
            <script src="'.base_url().'/assets/'.localJS('registerValidation').'.js"></script>
            <script>
                let openModal = new bootstrap.Modal(document.getElementById("loginModal"), {});
                    document.onreadystatechange = function () {
                    openModal.show();
                };
            </script>
        ';

        return  view('head').
                view('navbar').
                view('home/home', $data_view).
                view('footer', $variables_footer);
    }


    public function recovery_password()
    {
        isLoggedReturn();

        return  view('head').
                view('navbar').
                view('login/recovery_password').
                view('footer');

    }

    public function recovery_form()
    {
        isLoggedReturn();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email_recovery' => 'required|min_length[6]|max_length[100]|valid_email',
            ];


            if ($this->validate($rules)) {

                $LoginModel = new LoginModel();

                $user_email = trim($this->request->getPost('email_recovery'));

                $code_for_recovery = $LoginModel->check_email_recovery_password($user_email);

                if($code_for_recovery) {
                    $EmailsUser = new EmailsUser();
                    $EmailsUser->email_recovery_password($user_email, $code_for_recovery);
                }
            }
        } 

        return  view('head').
                view('navbar').
                view('login/post_recovery_form').
                view('footer');
    }


    public function new_password($code_email)
    {
        isLoggedReturn();

        $data_view['code_email'] = $code_email;
        $variables_footer['optional_scripts'] = '
            <script src="'.base_url().'/assets/'.localJS('newPassValidation').'.js"></script>
        ';

        return  view('head').
                view('navbar').
                view('login/new_password', $data_view).
                view('footer', $variables_footer);
    }

    public function form_save_new_password()
    {

        isLoggedReturn();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'password_recovery' => 'required|min_length[6]|max_length[255]',
                'password_recovery_two' => 'required|min_length[6]|max_length[255]|matches[password_recovery]',
            ];


            if ($this->validate($rules)) {

                $LoginModel = new LoginModel();

                $password_recovery = $this->request->getPost('password_recovery');
                $code_email = $this->request->getPost('code_email');

                $LoginModel->update_password($password_recovery, $code_email);
            }

        } //End Post

        $variables_footer['optional_scripts'] = '
            <script src="'.base_url().'/assets/'.localJS('loginValidation').'.js"></script>
            <script src="'.base_url().'/assets/'.localJS('registerValidation').'.js"></script>
            <script>
                document.getElementById("loginregister").scrollIntoView();
            </script>
        ';
            
        return  view('head').
                view('navbar').
                view('home/home').
                view('footer', $variables_footer);
    }

    public function logout()
    {
        !isLoggedReturn();

        session()->destroy();
		return redirect()->to(base_url());
    }

}
