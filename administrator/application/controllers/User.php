<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
     // Konstruktor	
	function __construct()
    {
        parent::__construct();
        $this->load->model('User_model'); // Memanggil User_model yang terdapat pada models
		$this->load->model('Users_model'); // Memanggil Users_model yang terdapat pada models
        $this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library 
		$this->load->helper(array('form', 'url')); // Memanggil form dan url yang terdapat pada helper		
		$this->load->helper('my_function'); // Memanggil fungsi my_function yang terdapat pada helper		
		$this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }
	
	// Fungsi untuk menampilkan halaman user
    public function index(){
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
		// Menampilkan data berdasarkan id-nya yaitu username
		$row = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$dataAdm = array(	
			'wa'       => 'Web administrator',
			'rab'   => 'PT. ADM',
			'username' => $row['username'],
			'email'    => $row['email'],
			'level'    => $row['level'],
		);
		
		$this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users 
        $this->load->view('user/user_list'); // Menampilkan halaman utama user
		$this->load->view('footer_list'); // Menampilkan bagian footer
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->User_model->json();
    }

	
    public function create() 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
	
		// Menampilkan data berdasarkan id-nya yaitu username
		$row = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$dataAdm = array(	
			'wa'       => 'Web administrator',
			'rab'   => 'PT. ADM',
			'username' => $row['username'],
			'email'    => $row['email'],
			'level'    => $row['level'],
		);
		
        $data = array(
			'back'   		=> site_url('user'),
            'button' 		=> 'Create',
            'action' 		=> site_url('user/create_action'),
			'user_id' 		=> set_value('user_id'),
			'username' 		=> set_value('username'),	
			'password' 		=> set_value('password'),
			'email' 		=> set_value('email'),
			'departement' 	=> set_value('departement'),	
			'ext' 			=> set_value('ext'),
			'plant_name' 	=> set_value('plant_name'),	
			'level' 		=> set_value('level'),	
						
		);
		
		$this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('user/user_form', $data); // Menampilkan halaman form user
		$this->load->view('footer'); // Menampilkan bagian footer
    }
    
    public function create_action() 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } 
		else {
            $data = array(
						'user_id'   	=> $this->input->post('user_id',TRUE),
						'username'   	=> $this->input->post('username',TRUE),
						'password' => md5($this->input->post('password',TRUE)),
						'email' 		=> $this->input->post('email',TRUE),
						'departement' 	=> $this->input->post('departement',TRUE),
						'ext' 			=> $this->input->post('ext',TRUE),
						'plant_name' 	=> $this->input->post('plant_name',TRUE),
						'level' 		=> $this->input->post('level',TRUE),
						
						);          
            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
		
    }
    
    public function update($id) 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
	
		// Menampilkan data berdasarkan id-nya yaitu username
		$row = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$dataAdm = array(	
			'wa'       => 'Web administrator',
			'rab'   => 'PT. ADM',
			'username' => $row['username'],
			'email'    => $row['email'],
			'level'    => $row['level'],
		);
		
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
				'back'   => site_url('user'),
                'button' => 'Update',
                'action' => site_url('user/update_action'),
				'user_id' => set_value('user_id', $row->user_id),
				'username' => set_value('username', $row->username),
				'email' => set_value('email', $row->email),
				'departement' => set_value('departement', $row->departement),	
				'ext' => set_value('ext', $row->ext),
				'plant_name' => set_value('plant_name', $row->plant_name),
				'level' => set_value('level', $row->level),		
				
				);
							
			$this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users 	
            $this->load->view('user/user_form', $data); // Menampilkan form mahasiswa
			$this->load->view('footer'); // Menampilkan bagian footer
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('user_id', TRUE));
        } else {
            $data = array(
						'user_id'   	=> $this->input->post('user_id',TRUE),
						'username'   	=> $this->input->post('username',TRUE),
						'password' 		=> md5($this->input->post('password',TRUE)),
						'email' 		=> $this->input->post('email',TRUE),
						'departement' 	=> $this->input->post('departement',TRUE),
						'ext' 			=> $this->input->post('ext',TRUE),
						'plant_name' 	=> $this->input->post('plant_name',TRUE),
						'level' 		=> $this->input->post('level',TRUE),
						); 
			
            $this->User_model->update($this->input->post('user_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function delete($id) 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('username', 'username', 'trim|required');		
	$this->form_validation->set_rules('password', 'password', 'trim|required');	
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('departement', 'departement', 'trim|required');
	$this->form_validation->set_rules('ext', 'ext', 'trim|required');
	$this->form_validation->set_rules('plant_name', 'plant_name', 'trim|required');	
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('user_id', 'user_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */