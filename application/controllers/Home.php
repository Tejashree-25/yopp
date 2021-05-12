<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index(){
        $this->load->model('Model');

        $data['blog'] = $this->Model->index_blog();
        $this->load->view('index-video',$data);        
    }
    public function blog(){
        // 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
        $this->load->model('Model');
        $allblogs = $this->Model->allblogs();
        $this->load->view('blog.php');
    }
    public function single_post($id){
        $this->load->model('Model');
        $data['single_post'] = $this->Model->single_post($id);
       
        $this->load->view('single-post',$data);        
    }
    function contact_us_form(){
        $this->load->model('Model');

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $date = date('y-m-d');
        $data = array(
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'date' => $date
        );

        $this->db->insert('contact_us',$data);

        $to = $email;
        $from = "therohitsoman25@gmail.com";
        $subject = "From Yopweb";
        $message = "Hello $name
        thanx for contact us we will contact you soon
        ";
        $this->sendmail($to,$from,$subject,$message);
    }
    function sendmail($to,$from,$subject,$message){
        $this->load->library('email');
        $message = $message;
        $to=$to;
        $from=$from;
        $subject=$subject;
        $config['protocol'] ='smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] =  '465';
        $config['smtp_timeout'] = '60';

        $config['smtp_user'] = 'therohitsoman25@gmail.com';
        $config['smtp_pass'] = '8446779566';

        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] =  'html';
        $config['validate'] = TRUE;

   
        $this->email->initialize($config);
        $this->email->set_mailtype('plain/html');
        $this->email->from($from);
        $this->email->to($to);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        $this->email->subject($subject);
        $this->email->send();         
    }
    // function send_mail(){

    // $API = "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";
    // $this->load->library('email');

    // $this->email->initialize(array(
    // 'protocol' => 'smtp',
    // 'smtp_host' => 'smtp.sendgrid.net',
    // 'smtp_user' => 'therohitsoman25@gmail.com',
    // 'smtp_pass' => 'rohitvishwassoman',
    // 'smtp_port' => 587,
    // 'crlf' => "\r\n",
    // 'newline' => "\r\n"
    // ));

    // $this->email->from('therohitsoman25@gmail.com', 'Your Name');
    // $this->email->to('therohitsoman25@gmail.com');
    // $this->email->cc('another@another-example.com');
    // $this->email->subject('Email Test');
    // $this->email->message('Testing the email class.');
    // $this->email->send();

    // echo $this->email->print_debugger();
    //     }
   
}