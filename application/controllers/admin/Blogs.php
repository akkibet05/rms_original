<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller
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
     * View Function to display blogs list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('blogs');
        $data['menu'] = 'blogs';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/blogs/listing');
    }

    /**
     * Function to get data for blogs jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminBlogModel->blogsList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $blog_id
     * @return html/string
     */
    public function createOrEdit($blog_id = NULL)
    {
        $pagedata['blog'] = objToArr($this->AdminBlogModel->getBlog('blogs.blog_id', $blog_id));
        $pagedata['categories'] = objToArr($this->AdminBlogCategoryModel->getAll());
        $data['page'] = lang('blogs');
        $data['menu'] = 'blogs';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/blogs/create-or-edit', $pagedata);        
    }

    /**
     * Function (for ajax) to process blog create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('description', lang('description'), 'required|min_length[50]|max_length[1000000]');

        $edit = $this->xssCleanInput('blog_id') ? $this->xssCleanInput('blog_id') : false;
        $imageUpload = $this->uploadImage($edit);        

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminBlogModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('blog_already_exist')))
            ));
        } elseif ($imageUpload['success'] == 'false') {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $imageUpload['message']))
            ));
        } else {
            $data = $this->AdminBlogModel->store($edit, $imageUpload['message']);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('blog') . ($edit ? lang('updated') : lang('created')))),
                'data' => $data
            ));
        }
    }

    /**
     * Function (for ajax) to process blog change status request
     *
     * @param integer $blog_id
     * @param string $status
     * @return void
     */
    public function changeStatus($blog_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminBlogModel->changeStatus($blog_id, $status);
    }

    /**
     * Function (for ajax) to process blog bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminBlogModel->bulkAction();
    }

    /**
     * Function (for ajax) to process blog delete request
     *
     * @param integer $blog_id
     * @return void
     */
    public function delete($blog_id)
    {
        $this->checkIfDemo();
        $this->AdminBlogModel->remove($blog_id);
    }

    /**
     * Upload Function (for ajax) to upload images from the ckeditor window
     *
     * @return html
     */
    public function uploadCkEditorImages()
    {
        if (isset($_FILES['upload']['name'])) {
            $file = $_FILES['upload']['tmp_name'];
            $file_name = $_FILES['upload']['name'];
            $file_name_array = explode('.', $file_name);
            $extension = end($file_name_array);
            $new_image_name = makeSlug($file_name).'-'.rand().'.'.$extension;
            chmod(ASSET_ROOT.'/images/ckeditor/', 0777);
            $allowed_extension = array('jpg', 'gif', 'png');
            if (in_array($extension, $allowed_extension)) {
                move_uploaded_file($file, ASSET_ROOT.'/images/ckeditor/'.$new_image_name);
                $function_number = $_GET['CKEditorFuncNum'];
                $url = base_url().'/assets/images/ckeditor/'.$new_image_name;
                $message = '';
                echo "<script>window.parent.CKEDITOR.tools.callFunction('".$function_number."', '".$url."', '".$message."');</script>";
            }
        }
    }    

    /**
     * Private function to upload blog image if any
     *
     * @param integer $edit
     * @return array
     */
    private function uploadImage($edit = false)
    {
        if ($_FILES['image']['name'] != '') {
            if ($edit) {
                $blog = objToArr($this->AdminBlogModel->getBlog('blog_id', $edit));
                if ($blog['image']) {
                    @unlink(ASSET_ROOT . '/images/blogs/' . $blog['image']);
                }
            }
            $file = explode('.', $_FILES['image']['name']);
            $filename = url_title(convert_accented_characters($_FILES['image']['name']), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/blogs/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $filename;
            $config['max_size'] = uploadLimit(1024);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                return array(
                    'success' => 'false',
                    'message' => uploadImageError(uploadLimit(1024), lang('only_image_allowed'))
                );
            } else {
                $data = $this->upload->data();
                return array('success' => 'true', 'message' => $data['file_name']);
            }
        }
        return array('success' => 'true', 'message' => '');
    }        
}
