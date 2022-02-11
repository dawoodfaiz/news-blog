<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_posts extends CI_Controller{

  public function __construct(){

    parent::__construct();
    $this->load->model('admin_model', 'admin');

  }

  public function index(){

    $this->load->view('admin/blog-posts/index');

  }

  public function addBlogPost(){

    $this->load->view('admin/blog-posts/add-blog-post');

  }

}

?>