<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Resumes extends CI_Controller
{
    /**
     * View Function to display account resume listing page
     *
     * @return html/string
     */
    public function listing($id = null)
    {
        $this->checkLogin();
        if (setting('enable-multiple-resume') == 'yes') {
            $pageData['page'] = lang('resume_listing').' | ' . setting('site-name');
            $data['page'] = 'resumes';
            $data['resumes'] = $this->ResumeModel->getCandidateResumes(candidateSession());
            $data['breadcrumb_title'] = lang('resume_listing');
            $data['breadcrumb_page'] = 'account/';
            $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
            $this->load->view('front/'.viewPrfx().'/account-resume-listing', $data);            
        } else {
            $resume = $this->ResumeModel->getFirstDetailedResume();
            redirect('account/resume/'.encode($resume));
        }        
    }    

    /**
     * Function (for ajax) to process create resume form request
     *
     * @return redirect
     */
    public function create()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('designation', lang('designation'), 'trim|required|min_length[2]|max_length[80]');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } else {
            $result = $this->ResumeModel->createResume();
            die(json_encode(array(
                'success' => 'true',
                'id' => encode($result['resume_id']),
                'messages' => $this->ajaxErrorMessage(array('success' => 'success'))
            )));
        }
    }

    /**
     * View Function to display account resume detail page
     *
     * @return html/string
     */
    public function detailView($id = null)
    {
        $this->checkLogin();
        $id = setting('enable-multiple-resume') == 'yes' ? $id : encode($this->ResumeModel->getFirstDetailedResume());
        $pageData['page'] = lang('resume_detail').' | ' . setting('site-name');
        $data['page'] = 'resumes';
        $data['resume'] = $this->ResumeModel->getCompleteResume(decode($id));
        $data['breadcrumb_title'] = lang('resume_detail');
        $data['breadcrumb_page'] = 'account/resume/'.$id;
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        if ($data['resume']['type'] == 'detailed') {
            $this->load->view('front/'.viewPrfx().'/account-edit-resume', $data);
        } else {
            $this->load->view('front/'.viewPrfx().'/account-edit-resume-doc', $data);
        }
    }

    /**
     * Function (for ajax) to process resume general section update form request
     *
     * @return redirect
     */
    public function updateGeneral()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title', lang('title'), 'trim|required|min_length[2]|max_length[80]'
        );
        $this->form_validation->set_rules(
            'designation', lang('designation'), 'trim|required|min_length[2]|max_length[80]'
        );
        $this->form_validation->set_rules('objective', lang('objective'), 'required|min_length[50]|max_length[1000]');

        $docRes = $this->uploadDoc($this->xssCleanInput('id'));

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } elseif ($docRes['success'] == false) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $docRes['message']))
            )));
        } else {
            $this->ResumeModel->updateResumeGeneral($docRes);
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('general_section_updated')))
            )));
        }
    }

    /**
     * Function (for ajax) to process resume experiences section update form request
     *
     * @return redirect
     */
    public function updateExperience()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title[]', lang('title'), 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules('from[]', lang('from'), 'required|max_length[20]');
        $this->form_validation->set_rules(
            'company[]', lang('company'), 'trim|required|min_length[3]|max_length[50]'
        );
        $this->form_validation->set_rules('to[]', lang('to'), 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('description[]', lang('description'), 'required|min_length[3]|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } else {
            $this->ResumeModel->updateResumeExperience();
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('experiences_updated')))
            )));
        }
    }

    /**
     * Function (for ajax) to process resume qualifications section update form request
     *
     * @return redirect
     */
    public function updateQualification()
    {
        $this->checkIfDemo();
        //$this->form_validation->set_rules('resume_experience_id[]', 'Ids', 'required');
        $this->form_validation->set_rules(
            'title[]', lang('title'), 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules('from[]', lang('from'), 'required|max_length[20]');
        $this->form_validation->set_rules('marks[]', lang('marks'), 'required|min_length[1]|max_length[5]|numeric');
        $this->form_validation->set_rules('to[]', lang('to'), 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules(
            'institution[]', lang('institution'), 'trim|required|min_length[3]|max_length[100]'
        );
        $this->form_validation->set_rules('out_of[]', lang('out_Of'), 'required|min_length[1]|max_length[5]|numeric');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } else {
            $this->ResumeModel->updateResumeQualification();
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('qualifications_updated')))
            )));
        }
    }

    /**
     * Function (for ajax) to process resume skill section update form request
     *
     * @return redirect
     */
    public function updateSkill()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title[]', lang('skill'), 'required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } else {
            $this->ResumeModel->updateResumeSkill();
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('skills_updated')))
            )));
        }
    }

    /**
     * Function (for ajax) to process resume language section update form request
     *
     * @return redirect
     */
    public function updateLanguage()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title[]', lang('language'), 'required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } else {
            $this->ResumeModel->updateResumeLanguage();
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('languages_updated')))
            )));
        }
    }

    /**
     * Function (for ajax) to process resume achievement section update form request
     *
     * @return redirect
     */
    public function updateAchievement()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title[]', lang('title'), 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules('date[]', lang('date'), 'max_length[20]');
        $this->form_validation->set_rules('link[]', lang('link'), 'trim|valid_url|min_length[1]|max_length[200]');
        $this->form_validation->set_rules('description[]', lang('description'), 'required|min_length[10]|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } else {
            $this->ResumeModel->updateResumeAchievement();
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('achievements_updated')))
            )));
        }
    }

    /**
     * Function (for ajax) to process resume reference section update form request
     *
     * @return redirect
     */
    public function updateReference()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title[]', lang('title'), 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules(
            'relation[]', lang('relation'), 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules('email[]', lang('email'), 'required|min_length[2]|max_length[100]|valid_email');
        $this->form_validation->set_rules('company[]', lang('company'), 'trim|max_length[50]');
        $this->form_validation->set_rules('phone[]', lang('phone'), 'max_length[50]|numeric');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } else {
            $this->ResumeModel->updateResumeReference();
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('references_updated')))
            )));
        }
    }

    /**
     * Function (for ajax) to process resume section add request
     *
     * @param string $resume_id
     * @param string $type
     * @return void
     */
    public function addSection($resume_id, $type)
    {
        switch ($type) {
            case 'experience':
                $data['experience'] = $this->ResumeModel->getEmptyTableObject('resume_experiences');
                $data['experience']['resume_id'] = decode($resume_id);
                $data['experience']['from'] = date('Y-m-d');
                $data['experience']['to'] = date('Y-m-d');
                echo $this->load->view('front/'.viewPrfx().'/partials/account-edit-resume-experiences.php', $data, TRUE);
                break;
            case 'qualification':
                $data['qualification'] = $this->ResumeModel->getEmptyTableObject('resume_qualifications');
                $data['qualification']['resume_id'] = decode($resume_id);
                $data['qualification']['from'] = date('Y-m-d');
                $data['qualification']['to'] = date('Y-m-d');
                echo $this->load->view('front/'.viewPrfx().'/partials/account-edit-resume-qualifications.php', $data, TRUE);
                break;
            case 'language':
                $data['language'] = $this->ResumeModel->getEmptyTableObject('resume_languages');
                $data['language']['resume_id'] = decode($resume_id);
                echo $this->load->view('front/'.viewPrfx().'/partials/account-edit-resume-languages.php', $data, TRUE);
                break;
            case 'skill':
                $data['skill'] = $this->ResumeModel->getEmptyTableObject('resume_skills');
                $data['skill']['resume_id'] = decode($resume_id);
                echo $this->load->view('front/'.viewPrfx().'/partials/account-edit-resume-skills.php', $data, TRUE);
                break;
            case 'achievement':
                $data['achievement'] = $this->ResumeModel->getEmptyTableObject('resume_achievements');
                $data['achievement']['resume_id'] = decode($resume_id);
                $data['achievement']['date'] = date('Y-m-d');
                echo $this->load->view('front/'.viewPrfx().'/partials/account-edit-resume-achievements.php', $data, TRUE);
                break;
            case 'reference':
                $data['reference'] = $this->ResumeModel->getEmptyTableObject('resume_references');
                $data['reference']['resume_id'] = decode($resume_id);
                echo $this->load->view('front/'.viewPrfx().'/partials/account-edit-resume-references.php', $data, TRUE);
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Function (for ajax) to process resume section delete request
     *
     * @param integer $section_id
     * @param string $type
     * @return void
     */
    public function removeSection($section_id, $type)
    {
        $this->checkIfDemo();
        $this->ResumeModel->removeSection($section_id, $type);
    }

    /**
     * Function (for ajax) to process profile update form request
     *
     * @return redirect
     */
    public function updateDocResume()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[2]|max_length[20]');

        $docRes = $this->uploadDoc($this->xssCleanInput('resume_id'));

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        } elseif ($docRes['success'] == false) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $docRes['message']))
            )));
        } else {
            $this->ResumeModel->updateDocResume($docRes);
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('resume_updated')))
            )));
        }
    }

    /**
     * Private function to upload resume file if any
     *
     * @param integer $resume_id
     * @return array
     */
    private function uploadDoc($resume_id = false)
    {
        if (!isset($_FILES['file'])) {
            return false;
        }
        
        if ($_FILES['file']['name'] != '') {
            $resume = objToArr($this->ResumeModel->getFirst('resumes.resume_id', decode($resume_id)));
            if ($resume['file']) {
                @unlink(ASSET_ROOT.'/images/candidates/'.$resume['file']);
            }
            $file = explode('.', $_FILES['file']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $config['max_size'] = uploadLimit(1024);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                return array(
                    'success' => false,
                    'message' => uploadImageError(uploadLimit(1024), lang('only_ms_word_pdf_file'))                    
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'file' => $data['file_name']);
            }
        }
        return array('success' => true, 'message' => '');
    }
}

