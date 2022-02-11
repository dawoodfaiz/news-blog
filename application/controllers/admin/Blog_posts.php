<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_posts extends CI_Controller{

  public function __construct(){

    parent::__construct();
    $this->load->model('blog_posts_model', 'blog_posts');

  }

  public function view_blog_posts(){

    $this->load->view('admin/blog_posts/view_blog_posts');

  }

  public function add_blog_post(){

    $this->load->view('admin/blog_posts/add_blog_post');

  }

  public function process_add_blog_post(){

    $data = [];
    $data['response'] = false;
    $formData = $this->input->post();

    if(!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $validationRules = array(
      array(
        'field' => 'title',
        'label' => 'Post Title',
        'rules' => 'required|trim',
        'errors'=> array(
          'required' => 'Please Enter %s.'
        )
      ),
      array(
        'field' => 'description',
        'label' => 'Post Description',
        'rules' => 'required|trim',
        'errors'=> array(
          'required' => 'Please Enter %s.'
        )
      )
    );
    $this->form_validation->set_rules($validationRules);

    if(!empty($_FILES['image']['tmp_name'])){
      $config['upload_path'] ='./assets/uploads/';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['max_size'] = 10000;
      $config['max_height'] = 3000;
      $config['max_width'] = 3000;
      $this->load->library('upload', $config);

      if(!$this->upload->do_upload('image')){
        $data['image_errors'] = $this->upload->display_errors();
      }else {
        $formData['image'] = $this->upload->data('file_name');
      }
    }

      if($this->form_validation->run() == true){
        $insert_id = $this->blog_posts->save($formData);
        if($insert_id){
          $data['response'] = true;
        }
      }else {
        $data['errors'] = $this->form_validation->error_array();
      }
      echo json_encode($data);
      exit;
  }

}

?>