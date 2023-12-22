<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proyek1 extends CI_Controller
{
     // Konstruktor	
	function __construct()
    {
        parent::__construct();
        $this->load->model('Proyek_model'); // Memanggil Ahs_model yang terdapat pada models
		$this->load->model('User_model'); // Memanggil Users_model yang terdapat pada models
        $this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library 
		$this->load->helper(array('form', 'url')); // Memanggil form dan url yang terdapat pada helper		
		$this->load->helper('my_function'); // Memanggil fungsi my_function yang terdapat pada helper		
		$this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }
	
	// Fungsi untuk menampilkan halaman ahs
    public function index(){
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
		// Menampilkan data berdasarkan id-nya yaitu username
		$row = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data = array(	
			'wa'       => 'Web administrator',
			'rab'      => 'RAB PT.ADM',
			'username' => $row['username'],
			'level'    => $row['level'],
		);
		$data['proyek'] = $this->Proyek_model->getProyek(); 
		//kategori
		$query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '1');
		$data['kategori'] = $query->row_array();
		$query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '2');
		$data['kategori2'] = $query->row_array();
		$query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '3');
		$data['kategori3'] = $query->row_array();

		$this->load->view('header_list1', $data); // Menampilkan bagian header dan object data users 
        $this->load->view('proyek1/proyek_list', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); // Menampilkan bagian footer
    } 

     public function after_create_proyek($id_proyek) 
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login         
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }
        // Menampilkan data berdasarkan id-nya yaitu username
        $row = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $dataUser = array(  
            'wa'       => 'Web administrator',
            'rab'      => 'RAB PT.ADM',
            'username' => $row['username'],
            'level'    => $row['level'],
        );
        $data = array(
            'id_pekerjaan' => set_value('id_pekerjaan'),                    
        );
         //masukin data ke session id_ahs 
          $id_proyek    = $id_proyek; 
          $proyek = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array(); 
          $data2 = array('id_proyek' => $proyek['id_proyek'], );
          $this->session->set_userdata($data2);
          $data2['proyek1'] = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array(); 
         
        //ambil semua data kategori pekerjaan
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '1');
        $data['kategori'] = $query->row_array();
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '2');
        $data['kategori2'] = $query->row_array();
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '3');
        $data['kategori3'] = $query->row_array();
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '4');
        $data['kategori4'] = $query->row_array();

       //ambil data ahs
        $query = $this->Proyek_model->getSingleProyek('id_proyek', $data2['proyek1']['id_proyek']);
        $data['proyek'] = $query->row_array();

       //ambil data detail ahs sesuai dengan id_ahs
     $data['coba']  = $this->db->select('t1.*, t2.*')
     ->from('detail_proyek as t1')
     ->join('kategori_pekerjaan as t2', 't1.id_pekerjaan = t2.id_pekerjaan', 'RIGHT')
     ->where('t1.id_proyek', $data2['proyek1']['id_proyek'] )
     ->get()->result_array();

      $data['detail_proyek_ahs']  = $this->db->select('t1.*, t2.*')
     ->from('detail_proyek_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->where('t1.id_proyek', $data2['proyek1']['id_proyek'] )
     ->get()->result_array();

     //untuk menghitung sum proyek
    $data['sum'] = $this->db->select_sum('subtotal')
    ->from('detail_proyek_ahs')
    ->where('id_proyek', $data2['proyek1']['id_proyek'])
    ->get()
    ->row()->subtotal;
     //hitung harga konstraktor 10% * harga total
      $t =  $data['sum'];   
      $data['kt'] = $t * 0.1;       
     //hitung total jumlah per kategori
    $data['sum1'] = $this->db->select_sum('detail_proyek_ahs.subtotal')
    ->from('detail_proyek_ahs')
    ->join('proyek', 'detail_proyek_ahs.id_proyek = proyek.id_proyek', 'LEFT')
    //->where('detail_proyek.id_pekerjaan', $data['kategori'] ['id_pekerjaan'])
    ->where('proyek.id_proyek', $data2['proyek1']['id_proyek'])
    ->get()
    ->row()->subtotal;

        //$q = $this->Ahs_model->getSingleAhs_by_id('t1.id_ahs', $id_ahs);
        //$data['detail_ahs'] = $q->result_array();
        $this->load->view('header1',$dataUser ); // Menampilkan bagian header dan object data users   
        $this->load->view('proyek1/proyek_form', $data); // Menampilkan halaman form bua
        $this->load->view('footer'); // Menampilkan bagian footer
    }

    public function hitung_subtotal(){
 
   // Jika session data username tidak ada maka akan dialihkan kehalaman login          
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }
        // Menampilkan data berdasarkan id-nya yaitu username
        $row = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $dataUser = array(  
            'wa'       => 'Web administrator',
            'rab'      => 'RAB PT.ADM',
            'username' => $row['username'],
            'level'    => $row['level'],
        );
         ///masukin data ke session id_ahs 
          $id_proyek    = $this->input->post('id_proyek'); 
          $proyek = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array(); 
          $data2 = array('id_proyek' => $proyek['id_proyek'], );
          $this->session->set_userdata($data2);
          $data2['proyek1'] = $this->db->get_where('proyek', ['id_proyek' => $this->session->userdata('id_proyek')])->row_array(); 
         
        //ambil semua data kategori pekerjaan
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '1');
        $data['kategori'] = $query->row_array();
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '2');
        $data['kategori2'] = $query->row_array();
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '3');
        $data['kategori3'] = $query->row_array();
        $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', '4');
        $data['kategori4'] = $query->row_array();

       //ambil data ahs
        $query = $this->Proyek_model->getSingleProyek('id_proyek', $data2['proyek1']['id_proyek']);
        $data['proyek'] = $query->row_array();

            //proses hitung subtotal
            $status = $this->input->post('status');
              $dataUpdate = array(    
            'status'       => 'acc',
        );
        $this->db->where('id_proyek =', $this->input->post('id_proyek'));
        $this->db->update('proyek', $dataUpdate);
         if($status == 'acc')
         {
            $dataUpdate = array(    
            'status'       => 'acc',
        );
        $this->db->where('id_proyek =', $this->input->post('id_proyek'));
        $this->db->update('proyek', $dataUpdate);
        }
        else if($status == 'return')
        {
             $dataUpdate = array(    
            'status'       => 'return',);
        $this->db->where('id_proyek =', $this->input->post('id_proyek'));
        $this->db->update('proyek', $dataUpdate);
        }
        else{
             $dataUpdate = array(    
            'status'       => 'close',);
        $this->db->where('id_proyek =', $this->input->post('id_proyek'));
        $this->db->update('proyek', $dataUpdate);
        }

        $this->session->set_flashdata('message1' , '<div class="alert alert-success" role="alert"> Edit Has Been Successfully! </div>');
        redirect(site_url('proyek1'));           
   }

 }


/* End of file Bua.php */