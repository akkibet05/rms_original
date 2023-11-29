<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller
{
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * View Function to display update app view
     *
     * @return html/string
     */
    public function updateApplication()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('max_execution_time', 1000);

        $data['page'] = lang('update_application');
        $data['menu'] = 'update_application';

        $current = $this->UpdateModel->getCurrent();
        $currentVersion = isset($current['version']) ? $current['version'] : '1.1';
        $updateLink = 'http://code-wand.com/updates/cf/index.php?current='.$currentVersion.'&pc='.setting('purchase-code').'&folder=';
        $latest = remoteRequest($updateLink);
        $latest = objToArr(json_decode($latest));

        $latestVersion = isset($latest['version']) ? $latest['version'] : '';

        if (isset($latest['error'])) {
            dd($latest['message']);
        } else if ($currentVersion == $latestVersion || !is_array($latest)) {
            //$latest = 'Your application is up to date';
            $updates = $this->UpdateModel->getAll();
        } else if (is_array($latest['files']) && isset($latest['files'])) {
            foreach ($latest['files'] as $file) {
                $folder = isset($file[3]) ? $file[3] : '';
                $path = $file[0];
                $filename = $file[1];
                $ext = $file[2];
                $remoteFile = 'http://code-wand.com/updates/cf/files.php?version='.$latestVersion.'&pc='.setting('purchase-code').'&folder='.$folder.'&file='.$filename.'.txt';

                $content = remoteRequest($remoteFile);

                //Creating any new directory if not exists
                if (!file_exists(MAIN_ROOT.$path)) {
                    mkdir(MAIN_ROOT.$path, 0777, true);
                }
                
                if (is_writable(MAIN_ROOT.$path)) {
                    $new = MAIN_ROOT.$path.'/'.$filename.'.'.$ext;
                    if (file_exists($new)) {
                        rename($new, MAIN_ROOT.$path.'/'.$filename.'-old-'.$currentVersion.'.'.$ext);
                    }
                    createFile($path.'/'.$filename.'.'.$ext, $content);
                } else {
                    die('Directory is not writeable, Please do manual update');
                }
            }
        }

        if (isset($latest['files'])) {
            $latest['files'] = json_encode($latest['files']);
            $latest['is_current'] = 1;
            $this->UpdateModel->store($latest);
            redirect('schema-import');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/settings/update', compact('updates', 'latest'));
    }

    /**
     * View Function to display app update history
     *
     * @return html/string
     */
    public function updateHistory()
    {
        $data['page'] = lang('update_application');
        $data['menu'] = 'update_application';
        $data['updates'] = $this->UpdateModel->getAll();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/settings/update', $data);
    }

    /**
     * Function to adjust any changes in the schema and import after version update
     *
     * @return html/string
     */
    public function runSchemaAndImportData()
    {
        $this->SchemaModel->run();
        $this->SchemaQuestionsModel->run();
        redirect('admin/settings/update-app');
    }

    /**
     * View Function to display general settings page view
     *
     * @return html/string
     */
    public function general()
    {
        $data['page'] = lang('general_settings');
        $data['menu'] = 'general_settings';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/settings/general', array());
    }

    /**
     * View Function to display display settings page view
     *
     * @return html/string
     */
    public function display()
    {
        $data['page'] = lang('display_settings');
        $data['menu'] = 'display_settings';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/settings/display', array());
    }

    /**
     * View Function to display api settings page view
     *
     * @return html/string
     */
    public function apis()
    {
        $data['page'] = lang('api_settings');
        $data['menu'] = 'api_settings';
        $settings = $this->AdminSettingModel->getSettingsByCategory('Apis');
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/settings/apis', compact('settings'));
    }

    /**
     * View Function to display css settings page view
     *
     * @return html/string
     */
    public function css()
    {
        $data['page'] = lang('css_settings');
        $data['menu'] = 'css_settings';
        $css = file_get_contents(ASSET_ROOT . '/front/'.viewPrfx().'/css/custom-style.css');
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/settings/css', compact('css'));
    }

    /**
     * View Function to display language settings page view
     *
     * @return html/string
     */
    public function home()
    {
        $data['page'] = lang('home_page_settings');
        $data['menu'] = 'home_page_settings';
        $settings = $this->AdminSettingModel->getSettingsByCategory('Home');
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/settings/home', compact('settings'));
    }

    /**
     * Function (for ajax) to process settings update form request
     *
     * @return redirect
     */
    public function updateSettings()
    {
        $this->checkIfDemo();
        $data = $this->xssCleanInput();

        $this->doValidation();

        if ($_FILES) {
            $result  = $this->uploadImage();
            if (!$result['success']) {
                echo json_encode(array(
                    'success' => 'false',
                    'messages' => $this->ajaxErrorMessage(array('error' => $result['messages']))
                ));
                exit;
            } else {
                $data = array_merge($data, $result['messages']);
            }
        }

        $this->AdminSettingModel->updateSetting($data);

        //If there are settings from display
        $this->AdminSettingModel->updateCssVariables($data);

        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('settings_updated')))
        ));
    }

    /**
     * Function (for ajax) to process css update form request
     *
     * @return redirect
     */
    public function updateCss()
    {
        $this->checkIfDemo();
        $data = $this->xssCleanInput();
        $file = fopen(ASSET_ROOT . '/front/'.viewPrfx().'/css/custom-style.css',"w");
        fwrite($file,$data['css-editor']);
        fclose($file);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('settings_updated')))
        ));
    }

    /**
     * Private function to upload image if any
     *
     * @param integer $user_id
     * @return array
     */
    private function uploadImage()
    {
        $this->checkIfDemo();
        $data = array();
        foreach ($_FILES as $key => $file) {
            if (!empty($file['name'])) {
                $ext = explode('.', $file['name'])[1];
                $config['upload_path'] = ASSET_ROOT . '/images/identities/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = $key != 'main-banner' ? $key.'-original' : $key;
                $this->load->library('upload', $config);
                if ($key == 'main-banner') {
                    $this->deleteImages($key); //delete before for site banner image
                }
                if (!$this->upload->do_upload($key)) {
                    return array(
                        'success' => false,
                        'messages' => $this->upload->display_errors()
                    );
                } else {
                    $filepath = ASSET_ROOT . '/images/identities/'.$key.'-original.'.$ext;
                    if ($key == 'site-logo' && file_exists($filepath)) {
                        $this->resizeByWidthOrHeight(ASSET_ROOT . '/images/identities/', $key, $key.'-original', $ext, 0, 45);
                        $this->deleteImages('site-logo'); //delete after for site logo
                    } elseif ($key == 'site-favicon'  && file_exists($filepath)) {
                        $this->resizeByWidthOrHeight(ASSET_ROOT . '/images/identities/', $key, $key.'-original', $ext, 16, 16);
                        $this->deleteImages('site-favicon'); //delete after for site favicon
                    }
                    $data[$key] = $key.'.'.$ext;
                }
                unset($this->upload);
            }
        }
        return array('success' => true, 'messages' => $data);
    }

    /**
     * Function to do validation for setting variables
     *
     * @return json
     */
    public function doValidation()
    {   
        $validate = false;
        if ($this->xssCleanInput('site-name')) {
        $this->form_validation->set_rules('site-name', 'Site Name', 'trim|required|min_length[2]|max_length[50]');
        $validate = true;
        }
        if ($this->xssCleanInput('admin-email')) {
        $validate = true;
        $this->form_validation->set_rules('admin-email', 'Admin Email', 'required|valid_email|max_length[50]');
        }
        
        if ($this->form_validation->run() === FALSE && $validate) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
            exit;
        }
    }

    private function deleteImages($key)
    {
        $extensions = array('png', 'jpg', 'jpeg', 'gif');
        if ($key == 'main-banner') {
            foreach ($extensions as $extension) {
                @unlink(ASSET_ROOT.'/images/identities/'.$key.'.'.$extension);
            }
        } else {
            foreach ($extensions as $extension) {
                @unlink(ASSET_ROOT.'/images/identities/'.$key.'-original.'.$extension);
            }
        }
    }
}
