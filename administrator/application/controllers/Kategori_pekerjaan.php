<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_pekerjaan extends CI_Controller
{
     // Konstruktor	
	function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_pekerjaan_model'); // Memanggil Kategori_model yang terdapat pada models
		$this->load->model('Users_model'); // Memanggil Users_model yang terdapat pada models
        $this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library 
		$this->load->helper(array('form', 'url')); // Memanggil form dan url yang terdapat pada helper		
		$this->load->helper('my_function'); // Memanggil fungsi my_function yang terdapat pada helper		
		$this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }
	
	// Fungsi untuk menampilkan halaman kategori
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
        $this->load->view('kategori_pekerjaan/kategori_pekerjaan_list'); // Menampilkan halaman utama kategori
		$this->load->view('footer_list'); // Menampilkan bagian footer
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kategori_pekerjaan_model->json();
    }
	
	/*
    public function read($id) 
    {
        $row = $this->Kategori_model->get_by_id($id);
        if ($r ow) {
            $data = array(
		'id_kategori' => $row->id_kategori,
		'nama_kategori' => $row->nama_kategori,
		'kategori_seo' => $row->kategori_seo,
		'aktif' => $row->aktif,
	    );
            $this->load->view('kategori/kategori_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori'));
        }
    }
	*/
	
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
			'back'   => site_url('kategori_pekerjaan'),
            'button' => 'Create',
            'action' => site_url('kategori_pekerjaan/create_action'),
			'id_pekerjaan' => set_value('id_pekerjaan'),
			'nama_kategori' => set_value('nama_kategori'),						
		);
		
		$this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('kategori_pekerjaan/kategori_pekerjaan_form', $data); // Menampilkan halaman form kategori
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
						'id_pekerjaan'   => $this->input->post('id_pekerjaan',TRUE),
						'nama_kategori' => $this->input->post('nama_kategori',TRUE),
						);          
            $this->Kategori_pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kategori_pekerjaan'));
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
		
        $row = $this->Kategori_pekerjaan_model->get_by_id($id);

        if ($row) {
            $data = array(
				'back'   => site_url('kategori_pekerjaan'),
                'button' => 'Update',
                'action' => site_url('kategori_pekerjaan/update_action'),
				'id_pekerjaan' => set_value('id_pekerjaan', $row->id_pekerjaan),
				'nama_kategori' => set_value('nama_kategori', $row->nama_kategori),				
				);
							
			$this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users 	
            $this->load->view('kategori_pekerjaan/kategori_pekerjaan_form', $data); // Menampilkan form mahasiswa
			$this->load->view('footer'); // Menampilkan bagian footer
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_pekerjaan'));
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
            $this->update($this->input->post('id_pekerjaan', TRUE));
        } else {
            $data = array(
						'id_pekerjaan'   => $this->input->post('id_pekerjaan',TRUE),
						'nama_kategori' => $this->input->post('nama_kategori',TRUE),
						);
			
            $this->Kategori_pekerjaan_model->update($this->input->post('id_pekerjaan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kategori_pekerjaan'));
        }
    }
    
    public function delete($id) 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $row = $this->Kategori_pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Kategori_pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategori_pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_pekerjaan'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('id_pekerjaan', 'id id_pekerjaan', 'trim|required');
	$this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');	
	$this->form_validation->set_rules('id_pekerjaan', 'id_pekerjaan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kategori.php */