<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Background
class Background extends CI_Controller
{
     // Konstruktor	
	function __construct(){
        parent::__construct();
        $this->load->model('Background_model'); // Memanggil Background_model yang terdapat pada models
        $this->load->model('Users_model'); // Memanggil Users_model yang terdapat pada models
        $this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library     
		$this->load->helper(array('form', 'url')); // Memanggil form dan url yang terdapat pada helper
		$this->load->library('upload'); // Memanggil upload yang terdapat pada helper
		$this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }
	
	// Fungsi untuk menampilkan halaman background
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
        $this->load->view('background/background_list'); // Menampilkan halaman utama background
		$this->load->view('footer_list'); // Menampilkan bagian footer
    } 
    
	// Fungsi JSON
    public function json() {
        header('Content-Type: application/json');
        echo $this->Background_model->json();
    }

    public function create(){
		
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
	  
		// Menampung data yang diinputkan	  
        $data = array(
            'button' => 'Create',
            'action' => site_url('background/create_action'),
			'back'   => site_url('background'),
			'id_background' => set_value('id_background'),
			'nama_background' => set_value('nama_background'),
			'gambar' => set_value('gambar'),
		);
		$this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users 	
        $this->load->view('background/background_form', $data); // Menampilkan halaman form background
		$this->load->view('footer'); // Menampilkan bagian footer
    }
    
    public function create_action(){
		
        // Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
	
        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi
		
		// Jika form background belum diisi dengan benar 
		// maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } 
		// Jika form background telah diisi dengan benar 
		// maka sistem akan menyimpan kedalam database
		else {
			
			// konfigurasi untuk melakukan upload gambar
			$config['upload_path']   = '../administrator/images/';    //path folder image
			$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diupload jpg|png|jpeg			
			$config['file_name']     = url_title($this->input->post('nama_background')); //nama file gambar dirubah menjadi nama berdasarkan nama_background	
			$this->upload->initialize($config);
			
			// Jika file gambar ada 
			if(!empty($_FILES['gambar']['name'])){
				
				if ($this->upload->do_upload('gambar')){
					$gambar = $this->upload->data();	
					$datagambar = $gambar['file_name'];					
					$this->load->library('upload', $config);
					
					$data = array(
						'id_background' => $this->input->post('id_background',TRUE),
						'nama_background' => $this->input->post('nama_background',TRUE),
						'gambar' => $datagambar,
						);
				   
					$this->Background_model->insert($data);
				}
				
				$this->session->set_flashdata('message', 'Create Record Success');
				redirect(site_url('background'));
				
			}
			// Jika file gambar kosong 
			else{		
			
				$data = array(
					'id_background' => $this->input->post('id_background',TRUE),
					'nama_background' => $this->input->post('nama_background',TRUE),
					);
			   
				$this->Background_model->insert($data);
				$this->session->set_flashdata('message', 'Create Record Success');
				redirect(site_url('background'));
			}
        }
    }
    
    public function update($id){
		
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
		
		// Menampilkan data berdasarkan id-nya yaitu id_background
        $row = $this->Background_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
				'action' => site_url('background/update_action'),
				'back'   => site_url('background'),
				'id_background' => set_value('id_background', $row->id_background),
				'nama_background' => set_value('nama_background', $row->nama_background),
				'gambar' => set_value('gambar', $row->gambar),
				);
			$this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users 	
            $this->load->view('background/background_form', $data); // Menampilkan form mahasiswa
			$this->load->view('footer'); // Menampilkan bagian footer
        } 
		else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('background'));
        }
    }
    
    public function update_action(){
        // Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
	
        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi	 			
		
		// Jika form background belum diisi dengan benar 
		// maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_background', TRUE));
        } 
		// Jika form background telah diisi dengan benar 
		// maka sistem akan melakukan update data background kedalam database
		else {
			
			// Konfigurasi untuk melakukan upload gambar
			$config['upload_path']   = '../administrator/images/';    //path folder
			$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diupload jpg|png|jpeg			
			$config['file_name']     = url_title($this->input->post('nama_background')); //nama file gambar dirubah menjadi nama berdasarkan nama_background	
			$this->upload->initialize($config);
			
			// Jika file gambar ada 
			if(!empty($_FILES['gambar']['name'])){	
			
				// Menghapus file image lama
				unlink("../images/background/".$this->input->post('gambar'));	
				
				// Upload file image baru
				if ($this->upload->do_upload('gambar')){
					$gambar = $this->upload->data();	
					$datagambar = $gambar['file_name'];					
					$this->load->library('upload', $config);
					
					$data = array(
						'id_background' => $this->input->post('id_background',TRUE),
						'nama_background' => $this->input->post('nama_background',TRUE),
						'gambar' => $datagambar,
						);

					$this->Background_model->update($this->input->post('id_background', TRUE), $data);
				}
					$this->session->set_flashdata('message', 'Update Record Success');
					redirect(site_url('background'));
			}			
			// Jika file gambar kosong 
			else{
				
				$data = array(
						'id_background' => $this->input->post('id_background',TRUE),
						'nama_background' => $this->input->post('nama_background',TRUE),					
						);

				$this->Background_model->update($this->input->post('id_background', TRUE), $data);
				$this->session->set_flashdata('message', 'Update Record Success');
				redirect(site_url('background'));	
			}	
            
        }
    }
    
	// Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
    public function delete($id){
		
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $row = $this->Background_model->get_by_id($id);
		
		//jika id nim yang dipilih tersedia maka akan dihapus
        if ($row) {
            $this->Background_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
			
			// menghapus file gambar
			unlink("../administrator/images/".$row->gambar);
            redirect(site_url('background'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('background'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_background', 'id background', 'trim|required');
	$this->form_validation->set_rules('nama_background', 'nama background', 'trim|required');

	$this->form_validation->set_rules('id_background', 'id_background', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Background.php */