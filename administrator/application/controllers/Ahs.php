<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ahs extends CI_Controller
{
     // Konstruktor	
	function __construct()
    {
        parent::__construct();
        $this->load->model('Ahs_model'); // Memanggil Ahs_model yang terdapat pada models
		$this->load->model('Users_model'); // Memanggil Users_model yang terdapat pada models
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
		$row = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$dataAdm = array(	
			'wa'       => 'Web administrator',
			'rab'   => 'PT. ADM',
			'username' => $row['username'],
			'email'    => $row['email'],
			'level'    => $row['level'],
		);
		$data['ahs'] = $this->Ahs_model->getAhs(); 
		//kategori
		$query = $this->Ahs_model->getSingleKategori('id_kategori', '1');
		$data['kategori'] = $query->row_array();
		$query = $this->Ahs_model->getSingleKategori('id_kategori', '2');
		$data['kategori2'] = $query->row_array();
		$query = $this->Ahs_model->getSingleKategori('id_kategori', '3');
		$data['kategori3'] = $query->row_array();

		$this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users 
        $this->load->view('ahs/ahs_list', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); // Menampilkan bagian footer
    } 
    
    public function create_ahs() 
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
			'back'   => site_url('ahs'),
            'button' => 'Create',
            'action' => site_url('ahs/create_action'),
			'id_ahs' => set_value('id_ahs'),
			'id_pekerjaan' => set_value('id_pekerjaan'),
			'nm_ahs' => set_value('nm_ahs'),	
			'total' => set_value('total'),						
		);
		//ambil semua data kategori bua
       $data['kategori'] = $this->db->get('kategori')->result_array();
       $data['bua'] = $this->db->get('bua')->result_array();
		$this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('ahs/awal_create_form', $data); // Menampilkan halaman form bua
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
						'id_ahs'   		=> $this->input->post('id_ahs',TRUE),
						'id_kategori'   => $this->input->post('id_kategori',TRUE),
						'nm_ahs' 		=> $this->input->post('nm_ahs',TRUE),
						'total' 		=> $this->input->post('total',TRUE),
						);          
            $this->Ahs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ahs'));
        }
		
    }

     public function after_create_ahs($id_ahs) 
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
		 //masukin data ke session id_ahs 
          $id_ahs    = $id_ahs; 
      	  $ahs = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
      	  $data2 = array('id_ahs' => $ahs['id_ahs'], );
      	  $this->session->set_userdata($data2);
      	  $data2['ahs1'] = $this->db->get_where('ahs', ['id_ahs' => $id_ahs ])->row_array(); 
		 
		//ambil semua data kategori bua
       	$query = $this->Ahs_model->getSingleKategori('id_kategori', '1');
		$data['kategori'] = $query->row_array();
		$query = $this->Ahs_model->getSingleKategori('id_kategori', '2');
		$data['kategori2'] = $query->row_array();
		$query = $this->Ahs_model->getSingleKategori('id_kategori', '3');
		$data['kategori3'] = $query->row_array();

       //ambil data ahs
       	$query = $this->Ahs_model->getSingleAhs('id_ahs', $data2['ahs1']['id_ahs']);
		$data['ahs'] = $query->row_array();
		
       //ambil data detail ahs sesuai dengan id_ahs
	 $data['detail_ahs']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $data2['ahs1']['id_ahs'] )
     ->where('t3.id_kategori', '1' )
     ->get()->result_array();

     $data['detail_ahs2']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs',$data2['ahs1']['id_ahs'] )
     ->where('t3.id_kategori', '2' )
     ->get()->result_array();

      $data['detail_ahs3']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $data2['ahs1']['id_ahs'] )
     ->where('t3.id_kategori', '3' )
     ->get()->result_array();

    $data['sum'] = $this->db->select_sum('subtotal')
    ->from('detail_ahs')
    ->where('id_ahs', $data2['ahs1']['id_ahs'])
    ->get()
    ->row()->subtotal;

    $data['sum1'] = $this->db->select_sum('detail_ahs.subtotal')
    ->from('detail_ahs')
    ->join('bua', 'detail_ahs.id_bua = bua.id_bua', 'LEFT')
    ->where('bua.id_kategori', $data['kategori'] ['id_kategori'])
    ->where('detail_ahs.id_ahs', $data2['ahs1']['id_ahs'])
    ->get()
    ->row()->subtotal;

    $data['sum2'] = $this->db->select_sum('detail_ahs.subtotal')
    ->from('detail_ahs')
    ->join('bua', 'detail_ahs.id_bua = bua.id_bua', 'LEFT')
    ->where('bua.id_kategori', $data['kategori2'] ['id_kategori'])
    ->where('detail_ahs.id_ahs', $data2['ahs1']['id_ahs'])
    ->get()
    ->row()->subtotal;

    $data['sum3'] = $this->db->select_sum('detail_ahs.subtotal')
    ->from('detail_ahs')
    ->join('bua', 'detail_ahs.id_bua = bua.id_bua', 'LEFT')
    ->where('bua.id_kategori', $data['kategori3'] ['id_kategori'])
    ->where('detail_ahs.id_ahs', $data2['ahs1']['id_ahs'])
    ->get()
    ->row()->subtotal;

        //$q = $this->Ahs_model->getSingleAhs_by_id('t1.id_ahs', $id_ahs);
		//$data['detail_ahs'] = $q->result_array();
		$this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('ahs/ahs_form', $data); // Menampilkan halaman form bua
		$this->load->view('footer'); // Menampilkan bagian footer
    }

 
 public function ambil_bua($id_ahs,$id_kategori) //manggil hanya yg sesuai $role_id saja
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
		//masukin data ke session id_has 
          $id_ahs = $id_ahs; 
      	  $ahs = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
      	  $data2 = array('id_ahs' => $id_ahs, );
      	  $this->session->set_userdata($data2);
      	  $data2['ahs1'] = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
		 
		 //ambil data ahs
       	$query = $this->Ahs_model->getSingleAhs('id_ahs', $data2['ahs1']['id_ahs']);
		$data['ahs'] = $query->row_array();

        	//masukin data ke session id_kategori
      	  $id_kategori    = $id_kategori; 
      	  $bua = $this->db->get_where('bua', ['id_kategori' => $id_kategori])->row_array(); 
      	  $data1 = array('id_kategori' => $bua['id_kategori'], );
      	  $this->session->set_userdata($data1);
      	  $data1['bua1'] = $this->db->get_where('bua', ['id_kategori' => $id_kategori])->row_array(); 
		  //ambil semua data bua
		  $this->db->where('id_kategori =', $data1['bua1']['id_kategori']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		  $data['bua'] = $this->db->get('bua')->result_array(); //result semua data
		  //ambil data kategori 
       	  $this->db->where('id_kategori =', $id_kategori); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		  $data['kategori'] = $this->db->get('kategori')->row_array(); //row 1 data saja

	 $data['detail_ahs']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $id_ahs )
     ->where('t3.id_kategori', $id_kategori )
     ->get()->result_array();

		$this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users 
        $this->load->view('ahs/add_bua', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); // Menampilkan bagian footer 		
    } 

   public function add_selected_bua(){
   	$bua = $this->input->post('id_bua');
   	//manggil data yang udah di masukin ke session
   	 $data1['bua'] = $this->db->get_where('bua', ['id_kategori' => $this->session->userdata('id_kategori')])->row_array(); 
	 $data2['ahs'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
	 	 
   	for($i=0; $i < count($bua) ; $i++) { 
   		$data = array('id_ahs' => $data2['ahs']['id_ahs'],
   					  'id_bua' => $bua[$i],
   					  );
   		$this->db->insert('detail_ahs', $data);
   	}
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
	
		 //masukin data ke session id_has 
          $id_ahs    = $this->input->post('id_ahs'); 
      	  $ahs = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
      	  $data2 = array('id_ahs' => $ahs['id_ahs'], );
      	  $this->session->set_userdata($data2);
      	  $data2['ahs1'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
		 
      	   //ambil data ahs
       	$query = $this->Ahs_model->getSingleAhs('id_ahs', $data2['ahs1']['id_ahs']);
		$data['ahs'] = $query->row_array();

	  $data['detail_ahs']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $this->session->userdata['id_ahs'] )
     ->where('t3.id_kategori', $this->session->userdata['id_kategori'] )
     ->get()->result_array();

		$this->db->where('id_ahs =', $this->session->userdata['id_ahs']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['ahs'] = $this->db->get('ahs')->row_array();
		
   		$this->db->where('id_kategori =', $this->session->userdata['id_kategori']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['bua'] = $this->db->get('bua')->result_array();
		
		$data['kategori'] = $this->db->get_where('kategori', ['id_kategori' => $this->input->post('id_kategori1')])->row_array(); 
  
		$this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users 
        $this->load->view('ahs/hasil_add_bua', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); 	
   }

    public function form_edit_ahs($id_ahs,$id_kategori,$id_bua){
   	$bua = $id_bua;
   	//manggil data yang udah di masukin ke session
   	 $data['bua'] = $this->db->get_where('bua', ['id_bua' => $id_bua])->row_array(); 
	 $data['ahs'] = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
	 $data['kategori'] = $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row_array(); 
  
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

		 //masukin data ke session id_has 
          $id_ahs    = $id_ahs; 
      	  $ahs = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
      	  $data2 = array('id_ahs' => $ahs['id_ahs'], 
      	  				 'id_kategori' => $id_kategori );
      	  $this->session->set_userdata($data2);
      	  $data2['ahs1'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
		
		$this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users 
        $this->load->view('ahs/edit', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); 	
   }

   public function cancel_edit($id_ahs,$id_kategori,$id_bua)
   {
   	$bua = $id_bua;
   	//manggil data yang udah di masukin ke session
   	 $data1['bua'] = $this->db->get_where('bua', ['id_kategori' => $this->session->userdata('id_kategori')])->row_array(); 
	 $data2['ahs'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
	 	 
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
	
		 //masukin data ke session id_has 
          $id_ahs    = $id_ahs; 
      	  $ahs = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
      	  $data2 = array('id_ahs' => $ahs['id_ahs'], );
      	  $this->session->set_userdata($data2);
      	  $data2['ahs1'] = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
		 
      	   //ambil data ahs
       	$query = $this->Ahs_model->getSingleAhs('id_ahs', $data2['ahs1']['id_ahs']);
		$data['ahs'] = $query->row_array();

	  $data['detail_ahs']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $this->session->userdata['id_ahs'] )
     ->where('t3.id_kategori', $this->session->userdata['id_kategori'] )
     ->get()->result_array();

		$this->db->where('id_ahs =', $this->session->userdata['id_ahs']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['ahs'] = $this->db->get('ahs')->row_array();
		
   		$this->db->where('id_kategori =', $this->session->userdata['id_kategori']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['bua'] = $this->db->get('bua')->result_array();
		
		$data['kategori'] = $this->db->get_where('kategori', ['id_kategori' => $this->input->post('id_kategori1')])->row_array(); 
  
		$this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users 
        $this->load->view('ahs/hasil_add_bua', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); 	
   }

   public function hitung_subtotal(){
   	$bua = $this->input->post('id_bua');
   	//manggil data yang udah di masukin ke session
   	 $data1['bua'] = $this->db->get_where('bua', ['id_kategori' => $this->session->userdata('id_kategori')])->row_array(); 
	 $data2['ahs'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
 
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
		 //masukin data ke session id_has 
          $id_ahs    = $this->input->post('id_ahs'); 
      	  $ahs = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
      	  $data2 = array('id_ahs' => $ahs['id_ahs'], );
      	  $this->session->set_userdata($data2);
      	  $data2['ahs1'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
		 
      	   //ambil data ahs
       	$query = $this->Ahs_model->getSingleAhs('id_ahs', $data2['ahs1']['id_ahs']);
		$data['ahs'] = $query->row_array();

	 $data['detail_ahs']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $this->session->userdata['id_ahs'] )
     ->where('t3.id_kategori', $this->session->userdata['id_kategori'] )
     ->get()->result_array();

		$this->db->where('id_ahs =', $this->session->userdata['id_ahs']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['ahs'] = $this->db->get('ahs')->row_array();
		
   		$this->db->where('id_kategori =', $this->session->userdata['id_kategori']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['bua'] = $this->db->get('bua')->result_array();

		//ambil harga berdasarkan id_ahs dan id_bua
	  $databua['harga_bua']  = $this->db->select('t1.*, t2.*')
     ->from('detail_ahs as t1')
     ->join('bua as t2', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $this->input->post('id_ahs') )
     ->where('t2.id_bua', $this->input->post('id_bua') )
     ->get();	
		
		 $this->form_validation->set_rules('koefisien', 'koefisien', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message' , '<div class="alert alert-danger" role="alert"> Koefisien Required! </div>');
			$this->form_edit_ahs();
		}
		else{
			//proses hitung subtotal
		$koe = (float)$this->input->post('koefisien');
		$h = (int)$this->input->post('harga');
		$hasil = $koe * $h;
		
		//update detail_ahs
		$dataUpdate = array(	
			'koefisien'       => $koe,
			'subtotal'      => $hasil,
		);
		$this->db->where('id_ahs =', $this->input->post('id_ahs'));
		$this->db->where('id_bua =', $this->input->post('id_bua'));
        $this->db->update('detail_ahs', $dataUpdate);

        $this->session->set_flashdata('message1' , '<div class="alert alert-success" role="alert"> Edit Has Been Successfully! </div>');
	    redirect(site_url('ahs/after_create_ahs/'.$id_ahs));
		}
			
   }

    public function after_edit(){
   	$bua = $this->input->post('id_bua');
   	//manggil data yang udah di masukin ke session
   	 $data1['bua'] = $this->db->get_where('bua', ['id_kategori' => $this->session->userdata('id_kategori')])->row_array(); 
	 $data2['ahs'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
	 	 
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
	
		 //masukin data ke session id_has 
          $id_ahs    = $this->input->post('id_ahs'); 
      	  $ahs = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
      	  $data2 = array('id_ahs' => $ahs['id_ahs'], );
      	  $this->session->set_userdata($data2);
      	  $data2['ahs1'] = $this->db->get_where('ahs', ['id_ahs' => $this->session->userdata('id_ahs')])->row_array(); 
		 
      	   //ambil data ahs
       	$query = $this->Ahs_model->getSingleAhs('id_ahs', $data2['ahs1']['id_ahs']);
		$data['ahs'] = $query->row_array();

	  $data['detail_ahs']  = $this->db->select('t1.*, t2.*, t3.*')
     ->from('detail_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->join('bua as t3', 't1.id_bua = t3.id_bua', 'LEFT')
     ->where('t1.id_ahs', $this->session->userdata['id_ahs'] )
     ->where('t3.id_kategori', $this->session->userdata['id_kategori'] )
     ->get()->result_array();

		$this->db->where('id_ahs =', $this->session->userdata['id_ahs']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['ahs'] = $this->db->get('ahs')->row_array();
		
   		$this->db->where('id_kategori =', $this->session->userdata['id_kategori']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		$data['bua'] = $this->db->get('bua')->result_array();
		
		$data['kategori'] = $this->db->get_where('kategori', ['id_kategori' => $this->input->post('id_kategori1')])->row_array(); 
  
		$this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users 
        $this->load->view('ahs/hasil_add_bua', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); 	
   }


    public function add_ahs()
	{
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
			'back'   => site_url('ahs'),
            'button' => 'Create',
            'action' => site_url('ahs/create_action'),
			'id_ahs' => set_value('id_ahs'),
			'id_pekerjaan' => set_value('id_pekerjaan'),
			'nm_ahs' => set_value('nm_ahs'),	
			'total' => set_value('total'),						
		);

		//.buat rule
		$this->form_validation->set_rules('nm_ahs','Name AHS','required|trim'); //required itu harus di isi, trim itu buat klo pas isi text nya ada spasi di depan atau di belakang ga ikut ke save di database
		$this->form_validation->set_rules('id_pekerjaan','Id Pekerjaan','required|trim');
		//ini untuk membuat kondisi form validasi
		if($this->form_validation->run() == false){

	    $data['kategori'] = $this->db->get('kategori')->result_array();
        $data['bua'] = $this->db->get('bua')->result_array();
		$this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('ahs/ahs_form', $data); // Menampilkan halaman form bua
		$this->load->view('footer');
		}
		else{
			$data = [
			// ini dari database(kiri)             ini dari name tiap textfield (kanan)
				'nm_ahs' => htmlspecialchars($this->input->post('nm_ahs', true)),
				'id_pekerjaan'   => $this->input->post('id_pekerjaan',TRUE),
			];

			$this->db->insert('ahs', $data); //untuk simpan ke database
			$this->session->set_flashdata('message' , '<div class="alert alert-success" role="alert"> Congratulation! AHS has been created.</div>'); // unutk munculkan alert
			redirect('ahs'); //untuk ngelink kemana jika kondisi sukses di simpan
		}
		
	}

	public function update_total_ahs()
	{
		$t = $this->input->post('total');	
		$k = $this->input->post('satuan');	
		//update detail_ahs
		$dataUpdate = array(	
			'total'       => $t,
			'satuan'       => $k,
		);
		$this->db->where('id_ahs =', $this->input->post('id_ahs'));
        $this->db->update('ahs', $dataUpdate);

        redirect(site_url('ahs'));
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
		
        $row = $this->Ahs_model->get_by_id($id);

        if ($row) {
            $data = array(
				'back'   => site_url('ahs'),
                'button' => 'Update',
                'action' => site_url('ahs/update_action'),
				'id_ahs' => set_value('id_ahs', $row->id_ahs),
				'id_pekerjaan' => set_value('id_pekerjaan', $row->id_pekerjaan),
				'nm_ahs' => set_value('nm_ahs', $row->nm_ahs),		
				
				);
							
			$this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users 	
            $this->load->view('ahs/edit_ahs', $data); // Menampilkan form mahasiswa
			$this->load->view('footer'); // Menampilkan bagian footer
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ahs'));
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
            $this->update($this->input->post('id_ahs', TRUE));
        } else {
            $data = array(
						'id_ahs'   		=> $this->input->post('id_ahs',TRUE),
						'id_pekerjaan'   		=> $this->input->post('id_pekerjaan',TRUE),
						'nm_ahs' 		=> $this->input->post('nm_ahs',TRUE),
						);
			
            $this->Ahs_model->update($this->input->post('id_ahs', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ahs'));
        }
    }

    public function delete($id) 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $row = $this->Ahs_model->get_by_id($id);

        if ($row) {
            $this->Ahs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ahs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ahs'));
        }
    }

    public function delete_detail($id_ahs, $id_bua)
	{
		$w = array('id_bua' => $id_bua,
				   'id_ahs' => $id_ahs);
	     $this->Ahs_model->delete_data($w,'detail_ahs');
		 $this->after_create_ahs($id_ahs);
	} 

    public function _rules(){
	$this->form_validation->set_rules('id_ahs', 'id ahs', 'trim|required');
	$this->form_validation->set_rules('nm_ahs', 'nama ahs', 'trim|required');			
	$this->form_validation->set_rules('id_ahs', 'id ahs', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

 }


/* End of file Bua.php */