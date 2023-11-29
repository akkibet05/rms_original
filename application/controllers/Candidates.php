<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Candidates extends CI_Controller
{
    /**
     * View function to display login page for candidate
     *
     * @return html/string
     */
    public function loginView($slug = null)
    {
        if (candidateSession()) {
            redirect('account');
        } else if ($this->input->cookie('remember_me_token_candidate' . appId(), TRUE)) {
            $candidateWithToken = $this->CandidateModel->getCandidateWithRememberMeToken(
                $this->input->cookie('remember_me_token_candidate' . appId())
            );
            if ($candidateWithToken) {
                $this->session->set_userdata(array('candidate' => objToArr($candidateWithToken)));
                redirect('account');
            } else {
                $this->logout();
            }
        }

        $pageData['page'] = lang('login').' | ' . setting('site-name');
        $data['breadcrumb_title'] = lang('login');
        $data['breadcrumb_page'] = 'login';
        $data['settings'] = setting();
        $data['slug'] = $slug;

        if (setting('enable-google-login') == 'yes') {
            $client = $this->getGoogleClient();
            $data['googleLogin'] = $client->createAuthUrl();
        } else {
            $data['googleLogin'] = '';
        }

        if (setting('enable-linkedin-login') == 'yes') {
            $linkedinHelper = new LinkedinHelper();
            $data['linkedinLogin'] = $linkedinHelper->getLink();
        } else {
            $data['linkedinLogin'] = '';
        }

        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/login', $data);
    }

    /**
     * Post Function to process login request by candidate
     *
     * @return html/string
     */
    public function login()
    {
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
        $this->form_validation->set_rules('password', lang('password'), 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', lang('email_and_or_password_was_invalid'));
        } else {
            $email = $this->xssCleanInput('email');
            $password = makePassword($this->xssCleanInput('password'));
            $candidate = $this->CandidateModel->login($email, $password);
            if ($candidate) {
                $this->session->set_userdata(array('candidate' => objToArr($candidate)));
                $this->setRememberMe($email, $this->xssCleanInput('remember'));
                redirect('/account');
            } else {
                $this->session->set_flashdata('error', lang('email_and_or_password_was_invalid'));
            }
        }
        redirect('/login');
    }

    /**
     * View Function to display register page for candidate
     *
     * @return html/string
     */
    public function registerView()
    {
        if (candidateSession()) {
            redirect('account');
        } else if ($this->input->cookie('remember_me_token_candidate' . appId(), TRUE)) {
            $candidateWithToken = $this->CandidateModel->getCandidateWithRememberMeToken(
                $this->input->cookie('remember_me_token_candidate' . appId())
            );
            if ($candidateWithToken) {
                $this->session->set_userdata(array('candidate' => objToArr($candidateWithToken)));
                redirect('account');
            } else {
                $this->logout();
            }
        }

        if (setting('enable-register') == 'yes') {
            $pageData['page'] = lang('register').' | ' . setting('site-name');
            $data['breadcrumb_title'] = lang('register');
            $data['breadcrumb_page'] = 'register';            
            $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
            $this->load->view('front/'.viewPrfx().'/register', $data);
        } else {
            $this->load->view('front/'.viewPrfx().'/404');
        }
    }

    /**
     * Post Function to register a candidate
     *
     * @return html/string
     */
    public function register()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique[candidates.email]', array('is_unique' => 'Email already exists'));
        $this->form_validation->set_rules('password', lang('password'), 'required');
        $this->form_validation->set_rules('retype_password', lang('retype_password'), 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            if (setting('enable-email-verification') == 'yes') {
                $candidate = $this->CandidateModel->createCandidate(true);
                $message = $this->load->view('front/'.viewPrfx().'/emails/verify-account', compact('candidate'), TRUE);
                $this->sendEmail(
                    $message,
                    $candidate['email'],
                    lang('activate_account')
                );
                $message = lang('a_verification_email_has_been_sent');
            } else {
                $candidate = $this->CandidateModel->createCandidate();
                $message = lang('account_created_please_login');
            }
            $this->sendEmail(
                $this->load->view('admin/emails/new-signup', compact('candidate'), TRUE),
                setting('admin-email'),
                lang('new_candidate_signed_up')
            );
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => $message))
            ));
        }
    }

    /**
     * View Function to display candidate job applications page
     *
     * @param integer $page
     * @return html/string
     */
    public function interviewsView($page = null)
    {
        $this->checkLogin();

        if (setting('display-candidate-interviews') == 'no') {
            die('not_allowed');
        }

        $total = $this->CandidateModel->getTotalCandidateInterviews();
        $limit = 5;
        $pageData['page'] = lang('interviews').' | ' . setting('site-name');
        $data['page'] = 'interviews';
        $data['interviews'] = $this->CandidateModel->getCandidateInterviews($limit, $page);
        $data['pagination'] = $this->createPagination($page, '/account/interviews/', $total, $limit);
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/account-interviews', $data);
    }

    /**
     * Private function to set remember me token for logged in user
     *
     * @return void
     */
    private function setRememberMe($email, $check)
    {
        if ($check) {
            $this->load->helper('cookie');
            $tokenValue = $email.'-'.strtotime(date('Y-m-d G:i:s'));
            $cookie = array(
                'name' => 'remember_me_token_candidate' . appId(),
                'value' => $tokenValue,
                'expire' => '1209600',// Two weeks
                'domain' => SITE_URL,
                'path' => '/'
            );
            $this->input->set_cookie($cookie);
            $this->CandidateModel->storeRememberMeToken($email, $tokenValue);
        }
    }

    /**
     * Function to process request for logout
     *
     * @return redirect
     */
    public function logout()
    {
        $this->session->unset_userdata('candidate');
        $this->session->unset_userdata('candidate_language');
        $this->session->unset_userdata('candidate_language_dir');
        $this->session->set_flashdata('user_loggedout', lang('you_are_now_logged_out'));
        $this->load->helper('cookie');
        delete_cookie('remember_me_token_candidate' . appId(), SITE_URL, '/');
        redirect('/login');
    }

    /**
     * View Function to display register page for user
     *
     * @return html/string
     */
    public function showForgotPassword()
    {
        if (setting('enable-forgot-password') == 'yes') {
            $pageData['page'] = lang('forgot_password').' | ' . setting('site-name');
            $data['breadcrumb_title'] = lang('forgot_password');
            $data['breadcrumb_page'] = 'forgot-password';
            $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
            $this->load->view('front/'.viewPrfx().'/forgot-password', $data);
        } else {
            redirect('404_override');
        }
    }

    /**
     * Function to display register page for user
     *
     * @return html/string
     */
    public function sendPasswordLink()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif (!$this->CandidateModel->getFirst('candidates.email', $this->xssCleanInput('email'))) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('email_does_not_exist')))
            ));
        } else {
            $this->CandidateModel->createTokenForCandidate($this->xssCleanInput('email'));
            $existingCandidate = $this->CandidateModel->getFirst('candidates.email', $this->xssCleanInput('email'));
            $this->sendEmail(
                $this->load->view('front/'.viewPrfx().'/emails/forgot-password', $existingCandidate, TRUE),
                $existingCandidate['email'],
                lang('create_new_password')
            );
            $message = lang('an_email_with_a_link_to_reset');
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => $message))
            ));
        }
    }

    /**
     * View function to display password reset form by email
     *
     * @return redirect
     */
    public function resetPassword($token = null)
    {
        $data['token'] = $token;
        $data['breadcrumb_title'] = lang('reset_password');
        $data['breadcrumb_page'] = 'reset-password';
        $pageData['page'] = lang('reset_password').' | ' . setting('site-name');
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/reset-password', $data);
    }

    /**
     * Function (for ajax) to process password reset form request
     *
     * @return redirect
     */
    public function updatePasswordByForgot()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('token', 'Token', 'required', array('required' => 'Token mismatch.'));
        $this->form_validation->set_rules('password', lang('new_password'), 'required');
        $this->form_validation->set_rules('retype_password', lang('retype_password'), 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif (!$this->CandidateModel->getFirst('candidates.token', $this->xssCleanInput('token'))) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('token_mismatch')))
            ));
        } else {
            $this->CandidateModel->updatePasswordByField(
                'candidates.token',
                $this->xssCleanInput('token'),
                makePassword($this->xssCleanInput('password'))
            );
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('password_updated')))
            ));
        }
    }    

    /**
     * View Function to display profile update page for candidate
     *
     * @return html/string
     */
    public function updateProfileView($id = null)
    {
        $this->checkLogin();
        $candidateId = candidateSession();
        $pageData['page'] = lang('update_profile').' | ' . setting('site-name');
        $data['page'] = 'profile';
        $data['candidate'] = $this->CandidateModel->getFirst('candidates.candidate_id', $candidateId);
        $data['breadcrumb_title'] = lang('update_profile');
        $data['breadcrumb_page'] = 'account/profile';
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/account-profile', $data);
    }    

    /**
     * Function (for ajax) to process profile update form request
     *
     * @return redirect
     */
    public function updateProfile()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('phone1', lang('phone1'), 'max_length[50]|numeric');
        $this->form_validation->set_rules('city', lang('city'), 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('country', lang('country'), 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('dob', lang('date_of_birth'), 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('phone2', lang('phone2'), 'max_length[50]|numeric');
        $this->form_validation->set_rules('state', lang('state'), 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('address', lang('address'), 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('bio', lang('short_biography'), 'required|min_length[3]|max_length[2500]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');

        $imageRes = $this->uploadImage(candidateSession());

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->CandidateModel->valueExist(
            'email', 
            $this->xssCleanInput('email'), 
            candidateSession()
        )) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('email_already_exist')))
            ));
        } elseif ($imageRes['success'] == false) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $imageRes['message']))
            ));
        } else {
            $this->CandidateModel->updateProfile($imageRes);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('profile_updated')))
            ));
        }
    }

    /**
     * Private function to upload user image if any
     *
     * @param integer $candidate_id
     * @return array
     */
    private function uploadImage($candidate_id = false)
    {
        if ($_FILES['image']['name'] != '') {
            $candidate = objToArr($this->CandidateModel->getFirst('candidates.candidate_id', $candidate_id));
            if ($candidate['image']) {
                $file = explode('.', $candidate['image']);
                //unlink(ASSET_ROOT.'/images/candidates/'.$candidate['image']);
                foreach (userImageDimensions() as $d) {
                    $name = $file[0] . '-' . $d[0] . '-' . $d[1] . '.' . $file[1];
                    @unlink(ASSET_ROOT . '/images/candidates/' . $name);
                }
            }
            $file = explode('.', $_FILES['image']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'jpg|png|JPG|PNG';
            $config['file_name'] = $filename;
            $config['max_size'] = uploadLimit(1024);
            $config['max_width'] = '400';
            $config['max_height'] = '400';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                return array(
                    'success' => false,
                    'message' => uploadImageError(uploadLimit(1024), lang('only_image_allowed_400_2'))                    
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'file' => $data['file_name']);
            }
        }
        return array('success' => true, 'message' => '');
    }

    /**
     * View Function to display password update page for candidate
     *
     * @return html/string
     */
    public function updatePasswordView($id = null)
    {
        $this->checkLogin();
        $pageData['page'] = lang('update_password').' | ' . setting('site-name');
        $data['page'] = 'password';
        $data['breadcrumb_title'] = lang('update_password');
        $data['breadcrumb_page'] = 'account/password';
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/account-password', $data);
        $this->load->view('front/'.viewPrfx().'/layout/footer');
    }

    /**
     * Function (for ajax) to process password reset form request
     *
     * @return redirect
     */
    public function updatePassword()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', lang('new_password'), 'required');
        $this->form_validation->set_rules('retype_password', lang('retype_password'), 'required|matches[new_password]');
        $candidate = $this->CandidateModel->getFirst('candidates.email', candidateSession('email'));

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif (makePassword($this->xssCleanInput('old_password')) !== $candidate['password']) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('old_password_do_not_match')))
            ));
        } else {
            $this->CandidateModel->updatePasswordByField(
                'candidates.candidate_id',
                candidateSession(),
                makePassword($this->xssCleanInput('new_password'))
            );
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('password_updated')))
            ));
        }
    }

    /**
     * Function to activate account 
     * e.g. resulting function for click on email
     * 
     * @return redirect
     */
    public function activateAccount($token = null)
    {
        $result = $this->CandidateModel->activateAccount($token);
        if ($result) {
            $content = '';
            $content .= '<strong><h3>'.lang('congratulations').'</h3></strong>';
            $content .= '<br /><br />';
            $content .= '<p>'.lang('account_activated_login_with_creds').'.</p >';
            $content .= '<br /><br />';
            $content .= '<p>'.lang('will_be_redirected_in_while').'</p >';
            $pageData['page'] = 'Jobs | ' . setting('site-name');
            $pageData['breadcrumb_title'] = lang('account_activation');
            $pageData['breadcrumb_page'] = 'login';            
            $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
            $this->load->view('front/'.viewPrfx().'/result-action-page', compact('content'));
            header( "refresh:3; url=".CF_BASE_URL."/account");
        } else {
            $content = '';
            $content .= '<strong><h3>'.lang('some_error_occured').'!</h3></strong>';
            $content .= '<br /><br />';
            $content .= '<a href="'.CF_BASE_URL.'/login">'.lang('please_try_again').'</a>';
            $pageData['page'] = setting('site-name');
            $data['breadcrumb_title'] = lang('some_error_occured');
            $data['breadcrumb_page'] = 'login';
            $data['content'] = $content;
            $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
            $this->load->view('front/'.viewPrfx().'/result-action-page', $data);
        }
    }

    /**
     * Page Function to process google redirect
     *
     * @return html
     */
    public function googleRedirect()
    {
        $client = $this->getGoogleClient();

        // authenticate code from Google OAuth Flow
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);

            // get profile info
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $id =  $google_account_info->id;
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;
            $image = $google_account_info->picture;

            $result = $this->CandidateModel->createGoogleCandidateIfNotExist($id, $email, $name, $image);
            if ($result) {
                $this->session->set_userdata(array('candidate' => objToArr($result)));
                $this->setRememberMe($email, $this->xssCleanInput('remember'));
                redirect('account');
            } else {
                $pageData['page'] = lang('login').' | ' . setting('site-name');
                $data['breadcrumb_title'] = lang('login');
                $data['breadcrumb_page'] = 'login';                
                $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
                $this->load->view('front/'.viewPrfx().'/user-existing-account', $data);
            }
        }
    }

    /**
     * Page Function to process linkedin redirect
     *
     * @return html
     */
    public function linkedinRedirect()
    {
        if(isset($_GET['code']))
        {
            $linkedinHelper = new LinkedinHelper();
            $accessToken = $linkedinHelper->getAccessToken($_GET['code']);
            $result = $linkedinHelper->getLinkedinRefinedData($accessToken);
            $result = $this->CandidateModel->createLinkedinCandidateIfNotExist($result);
            $email = $result['email'];
            if ($result) {
                $this->session->set_userdata(array('candidate' => objToArr($result)));
                $this->setRememberMe($email, $this->xssCleanInput('remember'));
                redirect('account');
            } else {
                $this->load->view('front/'.viewPrfx().'/user-existing-account');
            }
        } else {
            redirect('account');
        }
    }

    /**
     * Post Function to process login request by admin to login as candidate
     *
     * @param string $user_id
     * @param string $candidate_id
     * @return html/string
     */
    public function adminLogin($candidate_id, $user_id)
    {
        //First decoding
        $user_id = decode($user_id);
        $candidate_id = decode($candidate_id);

        //Second checking if admin is logged in
        if ($user_id != adminSession()) {
            die(lang('unauthorized'));
        }

        //Third checking if candidate exists
        $candidate = $this->CandidateModel->getFirst('candidates.candidate_id', $candidate_id);
        if ($candidate['candidate_id'] != $candidate_id) {
            die(lang('unauthorized'));   
        }

        //Forth loggin in as candidate if above two checks are correct        
        $this->session->set_userdata(array('candidate' => objToArr($candidate)));
        redirect('/account');
    }    
}

