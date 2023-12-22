<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class User1
class User2 extends CI_Controller {
	
	// Konstrutor 
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
	}
	
	// Fungsi untuk menampilkan halaman utama admin
	public function index() {
		// Menampilkan data berdasarkan id-nya yaitu username
		$row = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$queryInformasi = "SELECT gambar FROM informasi";
		$tampilInformasi = $this->db->query($queryInformasi)->result();
		$data = array(	
			'wa'       => 'Web administrator',
			'rab'      => 'RAB PT.ADM',
			'username' => $row['username'],
			'level'    => $row['level'],
			'informasi_data' => $tampilInformasi,
		);

		$this->load->view('beranda1',$data);
		
	}
	
	// Fungsi melakukan logout
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

/* End of file User1.php */
/* Location: ./application/controllers/User1.php */
/* Please DO NOT modify this information : */
?>