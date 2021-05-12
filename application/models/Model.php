<?php 
class Model extends CI_Model {
    public function check_login($username,$password){
        

    $this->db->where('username',$username);
    $this->db->where('password',$password);

    $query=$this->db->select()->from('user')->get()->num_rows();
    if($query == 1){
        return true;
    }
    else{
        return false;
    }
    }
    function blog_img(){        
        $query=$this->db->query("SELECT * FROM blogs order by id DESC limit 1");
        return $query->result();
        }

    function index_blog(){
        $query=$this->db->query("SELECT * FROM blogs order by id DESC limit 4");
        return $query->result();
    }
    function single_post($id){
        $query=$this->db->query("SELECT * FROM blogs where blogs.id=$id");
        return $query->result();
    }
    function allblogs(){
        $query=$this->db->query("SELECT * FROM blogs order by id DESC ");
        return $query->result();
    }
}