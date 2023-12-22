<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bua extends CI_Controller
{
     // Konstruktor	
	function __construct()
    {
        parent::__construct();
        $this->load->model('Bua_model'); // Memanggil Bua_model yang terdapat pada models
		$this->load->model('Users_model'); // Memanggil Users_model yang terdapat pada models
        $this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library 
		$this->load->helper(array('form', 'url')); // Memanggil form dan url yang terdapat pada helper		
		$this->load->helper('my_function'); // Memanggil fungsi my_function yang terdapat pada helper		
		$this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }
	
	// Fungsi untuk menampilkan halaman bua
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
        $this->load->view('bua/bua_list'); // Menampilkan halaman utama bua
		$this->load->view('footer_list'); // Menampilkan bagian footer
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Bua_model->json();
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
			'back'   => site_url('bua'),
            'button' => 'Create',
            'action' => site_url('bua/create_action'),
			'id_bua' => set_value('id_bua'),
			'id_kategori' => set_value('id_kategori'),
			'nama_bua' => set_value('nama_bua'),	
			'satuan' => set_value('satuan'),
			'ukuran' => set_value('ukuran'),
			'spesifikasi' => set_value('spesifikasi'),	
			'merk' => set_value('merk'),
			'warna' => set_value('warna'),
			'harga' => set_value('harga'),		
						
		);
		
		$this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('bua/bua_form', $data); // Menampilkan halaman form bua
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
						'id_bua'   		=> $this->input->post('id_bua',TRUE),
						'id_kategori'   => $this->input->post('id_kategori',TRUE),
						'nama_bua' 		=> $this->input->post('nama_bua',TRUE),
						'satuan' 		=> $this->input->post('satuan',TRUE),
						'ukuran' 		=> $this->input->post('ukuran',TRUE),
						'spesifikasi' 	=> $this->input->post('spesifikasi',TRUE),
						'merk' 			=> $this->input->post('merk',TRUE),
						'warna' 		=> $this->input->post('warna',TRUE),
						'harga' 		=> $this->input->post('harga',TRUE),
						
						);          
            $this->Bua_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bua'));
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
		
        $row = $this->Bua_model->get_by_id($id);

        if ($row) {
            $data = array(
				'back'   => site_url('bua'),
                'button' => 'Update',
                'action' => site_url('bua/update_action'),
				'id_bua' => set_value('id_bua', $row->id_bua),
				'id_kategori' => set_value('id_kategori', $row->id_kategori),
				'nama_bua' => set_value('nama_bua', $row->nama_bua),
				'satuan' => set_value('satuan', $row->satuan),
				'ukuran' => set_value('ukuran', $row->ukuran),	
				'spesifikasi' => set_value('spesifikasi', $row->spesifikasi),
				'merk' => set_value('merk', $row->merk),
				'warna' => set_value('warna', $row->warna),
				'harga' => set_value('harga', $row->harga),			
				
				);
							
			$this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users 	
            $this->load->view('bua/bua_form', $data); // Menampilkan form mahasiswa
			$this->load->view('footer'); // Menampilkan bagian footer
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bua'));
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
            $this->update($this->input->post('id_bua', TRUE));
        } else {
            $data = array(
						'id_bua'   		=> $this->input->post('id_bua',TRUE),
						'id_kategori'   => $this->input->post('id_kategori',TRUE),
						'nama_bua' 		=> $this->input->post('nama_bua',TRUE),
						'satuan' 		=> $this->input->post('satuan',TRUE),
						'ukuran' 		=> $this->input->post('ukuran',TRUE),
						'spesifikasi' 	=> $this->input->post('spesifikasi',TRUE),
						'merk' 			=> $this->input->post('merk',TRUE),
						'warna' 		=> $this->input->post('warna',TRUE),
						'harga' 		=> $this->input->post('harga',TRUE),
						);
			
            $this->Bua_model->update($this->input->post('id_bua', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bua'));
        }
    }
    
    public function delete($id) 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $row = $this->Bua_model->get_by_id($id);

        if ($row) {
            $this->Bua_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bua'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bua'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('id_bua', 'id bua', 'trim|required');
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	$this->form_validation->set_rules('nama_bua', 'nama bua', 'trim|required');		
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');	
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');	
	$this->form_validation->set_rules('id_bua', 'id_bua', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Bua.php */