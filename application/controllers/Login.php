<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Login
class Login extends CI_Controller {
  
  // Konstruktor  
  function __construct() {
   parent:: __construct();
   $this->load->library('form_validation');
   $this->load->model('Background_model');
  }
  
  // Fungsi untuk menampilkan halaman utama Login
  function index() {

    $queryBackground = "SELECT gambar FROM background";
    $tampilBackground = $this->db->query($queryBackground)->result();
    $data = array(  
      'background_data' => $tampilBackground,
    );

    $this->form_validation->set_rules('username','Username', 'trim|required');
    $this->form_validation->set_rules('password','Password', 'trim|required');

    if ($this->form_validation->run() == false) 
    {
      $this->load->view('login',$data);
    }
    else{
      //validasi success
      $this->proses();
    }
  }
  
  // Fungsi untuk melakukan proses login
  function proses() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['username' => $username])->row_array();
    
    //jika user nya ada
    if ($user) {
        //cek password , //password_verify itu fungsi php untuk cek password yang sudah di hash dan menyamakan apakah password di inputan sama atau tidak dengan password di database
        if (md5($password) == $user['password']) {
          $data =
          [
            'username' => $user['username'], //isi $data
            'level' => $user['level'], //isi $data
          ];
          $this->session->set_userdata($data); //masukin $data ke session
          if ($user['level'] == 'proyek_created') {
            redirect('user1', $data);
          }
          else{
            $_SESSION['level'] = 'approved';
            redirect('user2');
          }
          
        }
        else{
          $this->session->set_flashdata('result_login' , '<div class="alert alert-danger" role="alert"> Wrong password! </div>');
          redirect('login'); 
        }
      }
    else{
      $this->session->set_flashdata('result_login' , '<div class="alert alert-danger" role="alert"> Your username is not registered! </div>');
      redirect('login'); 
    }
  }
}
/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
/* Please DO NOT modify this information : */
?>