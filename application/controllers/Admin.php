<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index(){
        $this->load->view('Admin/login');        
    }
    function check_login(){
        $this->load->model('Model');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $check_login = $this->Model->check_login($username,$password);
        
        if($check_login){
        redirect(base_url('/Admin/addblog'),'refresh');  
        }
        else{
        echo "<script> alert('Invalid Username Or Password'); </script>";
        redirect(base_url('/Admin'),'refresh');
        }
    }
    function addblog(){
        $this->load->view('Admin/addblog');
    }

    function insert_blog(){
    $this->load->model('Model');
    $config['file_name'] = time().".png";
    $config['upload_path'] = './blog_images';
    $config['allowed_types'] = 'png|jpg|jpeg';
    $config['max_size'] = 5000;
    $config['max_width'] = 5000;
    $config['max_height'] = 5000;
    
    $this->load->library('upload', $config);
    $this->upload->do_upload('blog_banner');
   
    $new_name = $config['file_name'];
    $Blog_heading = $this->input->post('Blog_heading');
    $summary = $this->input->post('summary');
    $date = $this->input->post('date');
    $main_image = "1620327588.png";
    $data = array(
        'blog_heading' => $Blog_heading,
        'summary' => $summary,
        'date' => $date,
        'blog_banner' => $new_name,
        'main_image' => $main_image
    );

    $this->db->insert('blogs',$data);

    $this->load->view('Admin/crop_blog');
    }
    function addedblog(){
        echo "<script> alert('Blog Adder Sucesfully'); </script>";
        redirect(base_url('/Admin/addblog'),'refresh');
    }
    function blog_crop_img(){
        $this->load->model('Model');

        $dataid=$this->Model->blog_img();
        foreach($dataid as $row){
            $id=$row->id;
        }
    
        if(isset($_POST["image"]))
        {

       $data = $_POST["image"];

       $image_array_1 = explode(";", $data);

       $image_array_2 = explode(",", $image_array_1[1]);

       $data = base64_decode($image_array_2[1]);

       $imageName = time() . '.png';

       

       file_put_contents('blog_images/'.$imageName, $data);

       $image_file = addslashes(file_get_contents('blog_images/'.$imageName));
    

       $this->db->query("UPDATE blogs SET main_image='$imageName' WHERE blogs.id=$id");
      
   }
    }
}