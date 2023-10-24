<?php

namespace App\Controllers;
use App\Models\Profile\ProfileModel;

class Profile extends BaseController
{
    public function index()
    {
        $ProfileModel = new ProfileModel();
        
        $data_view['info_user_by_id'] = $ProfileModel->obtain_info_user_by_id();
        $variables_footer['optional_scripts'] = '
            <script src="'.base_url().'/assets/'.localJS('profileValidation').'.js"></script>
        ';
        
        if(session()->getFlashdata('redirect_post_save_password') == 'yes') {
            $data_view['show_message_password_success'] = TRUE;
        } else {
            $data_view['show_message_password_success'] = FALSE;
        }

        $data_head['title_html'] = 'Profile - Improve English Vocabulary';

        return  view('head', $data_head).
                view('navbar').
                view('profile/profile', $data_view).
                view('footer', $variables_footer);

    }

    public function change_info()
    {
        if ($this->request->getMethod() == 'post') {


            $rules = [
                'actual_password_profile' => 'required|min_length[6]|max_length[255]',
                'password_profile' => 'required|min_length[6]|max_length[255]',
                'password_profile_two' => 'required|min_length[6]|max_length[255]|matches[password_profile]',
            ];


            if ($this->validate($rules)) {


                $ProfileModel = new ProfileModel();

                $password_profile = $this->request->getPost('password_profile');
                $actual_password = $this->request->getPost('actual_password_profile');

                $ProfileModel->update_password($password_profile, $actual_password);
                session()->setFlashdata('redirect_post_save_password', 'yes');

            } else {
                session()->setFlashdata('redirect_post_save_password', 'no');
            }


        }//End Post

        return redirect()->to(base_url().'/profile');
        exit();

    }

    public function deleteuser()
    {
        $data_head['title_html'] = 'Delete My Account - Improve English Vocabulary';
        
        return  view('head', $data_head).
                view('navbar').
                view('profile/deleteuser').
                view('footer');    
    }

    public function confirmdeleteuser()
    {
        $ProfileModel = new ProfileModel();

        $ProfileModel->delete_account();

        session()->destroy();
		return redirect()->to(base_url());
    }

    public function save_voice()
    {
        $ProfileModel = new ProfileModel();

        $voice_selected = $this->request->getPost('voiceList');
        $actual_page = $this->request->getPost('voice_page');

        $ProfileModel->update_voice($voice_selected);

        if($actual_page == 'word') {
            return redirect()->to(base_url().'/words');
        } else if($actual_page == 'sentence') {
            return redirect()->to(base_url().'/sentences');
        } else if($actual_page == 'game') {
            return redirect()->to(base_url().'/game');
        } 

        return redirect()->to(base_url().'/words');
    }

}

