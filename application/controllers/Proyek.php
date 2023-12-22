<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proyek extends CI_Controller
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
		$this->load->library('mypdf'); // Memanggil datatables yang terdapat pada library
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

		$this->load->view('header_list', $data); // Menampilkan bagian header dan object data users 
        $this->load->view('proyek/proyek_list', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); // Menampilkan bagian footer
    } 
    
    public function create_proyek() 
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
			'back'   => site_url('proyek'),
            'button' => 'Create',
            'action' => site_url('proyek/create_action'),
			'id_proyek' => set_value('id_proyek'),
			'user_id' => set_value('user_id'),	
			'project_name' => set_value('project_name'),
			'create_date' => set_value('create_date'),
			'due_date' => set_value('due_date'),
			'status' => set_value('status'),						
		);
		//ambil semua data kategori bua
       $data['kategori_pekerjaan'] = $this->db->get('kategori_pekerjaan')->result_array();
		$this->load->view('header',$dataUser ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('proyek/awal_create_form', $data); // Menampilkan halaman form bua
		$this->load->view('footer'); // Menampilkan bagian footer
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
		$this->load->view('header',$dataUser ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('proyek/proyek_form', $data); // Menampilkan halaman form bua
		$this->load->view('footer'); // Menampilkan bagian footer
    }
    public function add_kategori_pekerjaan(){
    	$id_proyek = $this->input->post('id_proyek');
    	$id_pekerjaan = $this->input->post('id_pekerjaan');
    	//insert kategori pekerjaan
    	$this->form_validation->set_rules('id_pekerjaan','Id Pekerjaan','required|trim');
		//ini untuk membuat kondisi form validasi
		if($this->form_validation->run() == false){
	   	$this->after_create_proyek($id_proyek);
		}
		else{
    	$dataInsert = array(
    						'id_proyek' => $id_proyek,
    						'id_pekerjaan' => $id_pekerjaan,
    						);
    	$this->db->insert('detail_proyek', $dataInsert); 
    	redirect(site_url('proyek/after_create_proyek/'.$id_proyek));
    }

    }

    public function ambil_proyek($id_proyek,$id_pekerjaan) //manggil hanya yg sesuai $role_id saja
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
		//masukin data ke session id_has 
          $id_proyek1 = $id_proyek; 
      	  $id_pekerjaan1    = $id_pekerjaan; 
      	  $query = $this->Proyek_model->getSingleProyek('id_proyek', $id_proyek1);
		  $data['proyek'] = $query->row_array();
		  $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', $id_pekerjaan1);
		  $data['pekerjaan'] = $query->row_array();
      	//ambil AHS
		  $this->db->where('id_pekerjaan =', $id_pekerjaan1); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
		  $data['ahs'] = $this->db->get('ahs')->result_array(); //result semua data

		$this->load->view('header_list', $dataUser); // Menampilkan bagian header dan object data users 
        $this->load->view('proyek/add_ahs', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); // Menampilkan bagian footer 		
    } 

     public function add_selected_ahs(){
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
		//manggil data yang udah di masukin ke session
   	 $kat = $this->db->get_where('kategori_pekerjaan', ['id_pekerjaan' => $this->input->post('id_pekerjaan')])->row_array(); 
	 $p = $this->db->get_where('proyek', ['id_proyek' => $this->input->post('id_proyek')])->row_array(); 
	//simpan data detail_proyek berdasarkan checkbox yang di pilih
	 $id_ahs = $this->input->post('id_ahs');
   	for($i=0; $i < count($id_ahs) ; $i++) { 
   		$dataInsert = array('id_proyek' => $p['id_proyek'],
   							'id_pekerjaan' => $kat['id_pekerjaan'],
   					  		'id_ahs' => $id_ahs[$i],
   					  		);
   		$this->db->insert('detail_proyek_ahs', $dataInsert);
   	}
    //masukin data ke session
      	  $query = $this->Proyek_model->getSingleProyek('id_proyek', $p['id_proyek']);
		  $data['proyek'] = $query->row_array();
		  $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', $kat['id_pekerjaan']);
		  $data['pekerjaan'] = $query->row_array();

    //ambil Ahs
	 $this->db->where('id_pekerjaan =', $kat['id_pekerjaan']); //ini buat memfilter yg di munculkan tabel user_menu selain Admin 
	 $data['ahs'] = $this->db->get('ahs')->result_array(); //result semua data
    //ambil data detail_proyek_ahs
	  $data['detail_proyek_ahs']  = $this->db->select('t1.*, t2.*')
     ->from('detail_proyek_ahs as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->where('t2.id_pekerjaan', $kat['id_pekerjaan'] )
     ->where('t1.id_proyek', $p['id_proyek'])
     ->get()->result_array();
	
	$this->load->view('header_list', $dataUser); // Menampilkan bagian header dan object data users 
    $this->load->view('proyek/hasil_add_ahs', $data); // Menampilkan halaman utama Ahs
	$this->load->view('footer'); 	
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
						'id_proyek'   	=> $this->input->post('id_proyek',TRUE),
						'user_id'   	=> $this->input->post('user_id',TRUE),
						'project_name' 	=> $this->input->post('project_name',TRUE),
						'create_date'   => $this->input->post('create_date',TRUE),
						'due_date' 		=> $this->input->post('due_date',TRUE),
						'status' 		=> $this->input->post('status',TRUE),
						);          
            $this->Proyek_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('proyek'));
        }
    }

     public function add_proyek()
	{
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
		//.buat rule
		$this->form_validation->set_rules('project_name','Project Name','required|trim');
		$this->form_validation->set_rules('due_date','Due Data','required|trim');
		 //required itu harus di isi, trim itu buat klo pas isi text nya ada spasi di depan atau di belakang ga ikut ke save di database
		//ini untuk membuat kondisi form validasi
		if($this->form_validation->run() == false){

	    $data['kategori_pekerjaan'] = $this->db->get('kategori_pekerjaan')->result_array();
		$this->load->view('header',$data ); // Menampilkan bagian header dan object data users 	 
        $this->load->view('proyek/proyek_form', $data); // Menampilkan halaman form bua
		$this->load->view('footer');
		}
		else{
			$dataProyek = [
			// ini dari database(kiri)             ini dari name tiap textfield (kanan)
				'user_id'   	=> $row['user_id'], //ini ambil dari session
				'project_name' 	=> $this->input->post('project_name',TRUE),
				'create_date'	=> $this->input->post('create_date',TRUE),
				'due_date' 		=> $this->input->post('due_date',TRUE),
				'status' 		=> $this->input->post('status',TRUE),
			];

			$this->db->insert('proyek', $dataProyek); //untuk simpan ke database
			$this->session->set_flashdata('message' , '<div class="alert alert-success" role="alert"> Congratulation! Proyek has been created.</div>'); // unutk munculkan alert
			redirect('proyek'); //untuk ngelink kemana jika kondisi sukses di simpan
		}	
	}

	public function form_edit_ahs($id_proyek,$id_pekerjaan,$id_ahs){
   	//manggil data yang udah di masukin ke session
   	 $data['ahs'] = $this->db->get_where('ahs', ['id_ahs' => $id_ahs])->row_array(); 
   	 $data['kategori_pekerjaan'] = $this->db->get_where('kategori_pekerjaan', ['id_pekerjaan' => $id_pekerjaan])->row_array(); 
	 $data['proyek'] = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array(); 
	
   	if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		// Menampilkan data berdasarkan id-nya yaitu username
		$rowUs = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$dataUs = array(	
			'wa'       => 'Web administrator',
			'rab'      => 'RAB PT.ADM',
			'username' => $rowUs['username'],
			'level'    => $rowUs['level'],
		);

		//masukin data ke session id_ahs 
          $id_proyek    = $id_proyek; 
      	  $proyek = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array(); 
      	  $data2 = array('id_proyek' => $proyek['id_proyek'], );
      	  $this->session->set_userdata($data2);
      	  $data2['proyek1'] = $this->db->get_where('proyek', ['id_proyek' => $this->session->userdata('id_proyek')])->row_array();

		$this->load->view('header_list', $dataUs); // Menampilkan bagian header dan object data users 
        $this->load->view('proyek/edit', $data); // Menampilkan halaman utama Ahs
		$this->load->view('footer_list'); 	
   }

   public function hitung_subtotal(){
   	 $ahs = $this->input->post('id_ahs1');
   	//manggil data yang udah di masukin ke session
   	 $data['ahs'] = $this->db->get_where('ahs', ['id_ahs' => $this->input->post('id_ahs')])->row_array(); 
	 $data['proyek'] = $this->db->get_where('proyek', ['id_proyek' => $this->session->userdata('id_proyek')])->row_array(); 
 
   	if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		// Menampilkan data berdasarkan id-nya yaitu username
		$rowUs = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$dataUs = array(	
			'wa'       => 'Web administrator',
			'rab'      => 'RAB PT.ADM',
			'username' => $rowUs['username'],
			'level'    => $rowUs['level'],
			);
		 //masukin data ke session id_ahs 
          $id_proyek    = $this->input->post('id_proyek'); 
      	  $proyek = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array(); 
      	  $data2 = array('id_proyek' => $proyek['id_proyek'], );
      	  $this->session->set_userdata($data2);
      	  $data2['proyek1'] = $this->db->get_where('proyek', ['id_proyek' => $this->session->userdata('id_proyek')])->row_array();
		 
      	 //ambil data ahs
       	$query = $this->Proyek_model->getSingleProyek('id_proyek', $data2['proyek1']['id_proyek']);
		$data['proyek'] = $query->row_array();

		 $this->form_validation->set_rules('volume', 'volume', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message' , '<div class="alert alert-danger" role="alert"> Koefisien Required! </div>');
			$this->form_edit_ahs();
		}
		else{
			//proses hitung subtotal
		$volume = (float)$this->input->post('volume');
		$total = (int)$this->input->post('total');
		$hasil = $volume * $total;
		
		//update detail_ahs
		$dataUpdate = array(	
			'volume'      	=> $volume,
			'subtotal'      => $hasil,
		);
		$this->db->where('id_ahs =', $this->input->post('id_ahs'));
		$this->db->where('id_proyek =', $this->input->post('id_proyek'));
		$this->db->where('id_pekerjaan =', $this->input->post('id_pekerjaan'));
		//$this->db->where('id_pekerjaan =', $this->input->post('id_pekerjaan'));
        $this->db->update('detail_proyek_ahs', $dataUpdate);

        //masukin data ke session id_has 
          $id_proyek = $this->input->post('id_proyek'); 
      	  $id_pekerjaan    = $this->input->post('id_pekerjaan'); 
      	  $dataSes = array('id_pekerjaan' =>  $id_pekerjaan,
      	  				'id_proyek' => $id_proyek, );
      	  $this->session->set_userdata($dataSes);
		}
		$this->session->set_flashdata('message1' , '<div class="alert alert-success" role="alert"> Edit Has Been Successfully! </div>');
	    redirect(site_url('proyek/after_create_proyek/'.$id_proyek));
   }

     public function after_edit(){
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
		//manggil data yang udah di masukin ke session
   	 $kat = $this->db->get_where('kategori_pekerjaan', ['id_pekerjaan' => $this->input->post('id_pekerjaan')])->row_array(); 
	 $p = $this->db->get_where('proyek', ['id_proyek' => $this->input->post('id_proyek')])->row_array(); 
	//simpan data detail_proyek berdasarkan checkbox yang di pilih
	 $id_ahs = $this->input->post('id_ahs');
    //masukin data ke session
       $query = $this->Proyek_model->getSingleProyek('id_proyek', $p['id_proyek']);
		  $data['proyek'] = $query->row_array();
		  $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', $kat['id_pekerjaan']);
		  $data['pekerjaan'] = $query->row_array();
    //ambil AHS
      $data['ahs1'] = $this->Proyek_model->getAHS(); 

    //ambil data detail_proyek
	  $data['detail_proyek']  = $this->db->select('t1.*, t2.*')
     ->from('detail_proyek as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->where('t1.id_proyek', $p['id_proyek'] )
     ->where('t1.id_pekerjaan', $kat['id_pekerjaan'] )
     ->get()->result_array();
	
	$this->load->view('header_list', $dataUser); // Menampilkan bagian header dan object data users 
    $this->load->view('proyek/hasil_add_ahs', $data); // Menampilkan halaman utama Ahs
	$this->load->view('footer_list'); 	
   }

   public function cancel_edit($id_proyek,$id_pekerjaan){
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
		//manggil data yang udah di masukin ke session
	 $id_proyek1 = $id_proyek; 
     $id_pekerjaan1    = $id_pekerjaan;
   	 $kat = $this->db->get_where('kategori_pekerjaan', ['id_pekerjaan' => $id_pekerjaan])->row_array(); 
	 $p = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array(); 
	//simpan data detail_proyek berdasarkan checkbox yang di pilih
	 $id_ahs = $this->input->post('id_ahs');
    //masukin data ke session
          $query = $this->Proyek_model->getSingleProyek('id_proyek', $p['id_proyek']);
		  $data['proyek'] = $query->row_array();
		  $query = $this->Proyek_model->getSingleKategori('id_pekerjaan', $kat['id_pekerjaan']);
		  $data['pekerjaan'] = $query->row_array();
    //ambil AHS
      $data['ahs1'] = $this->Proyek_model->getAHS(); 

    //ambil data detail_proyek
	  $data['detail_proyek']  = $this->db->select('t1.*, t2.*')
     ->from('detail_proyek as t1')
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
     ->where('t1.id_proyek', $p['id_proyek'] )
     ->where('t1.id_pekerjaan', $kat['id_pekerjaan'] )
     ->get()->result_array();
	
	$this->load->view('header_list', $dataUser); // Menampilkan bagian header dan object data users 
    $this->load->view('proyek/hasil_add_ahs', $data); // Menampilkan halaman utama Ahs
	$this->load->view('footer_list'); 	
   }

  public function delete($id_ahs, $id_proyek, $id_pekerjaan)
	{
		$w = array('id_proyek' => $id_proyek,
				   'id_ahs' => $id_ahs);
	    $this->Proyek_model->delete_data($w,'detail_proyek_ahs');
		$this->after_create_proyek($id_proyek);
	} 

	public function delete_kategori($id_proyek, $id_pekerjaan)
	{

		$w = array('id_proyek' => $id_proyek,
				   'id_pekerjaan' => $id_pekerjaan);
		$this->Proyek_model->delete_data($w,'detail_proyek');
		$this->Proyek_model->delete_data($w,'detail_proyek_ahs');
		$this->after_create_proyek($id_proyek);
	} 

	public function delete_proyek($id) 
    {
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		
        $row = $this->Proyek_model->get_by_id($id);

        if ($row) {
            $this->Proyek_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('proyek'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('proyek'));
        }
    }

    public function update_total_ahs()
	{
		$t = $this->input->post('total');		
		//update detail_ahs
		$dataUpdate = array(	
			'total'       => $t,
		);
		$this->db->where('id_ahs =', $this->input->post('id_ahs'));
        $this->db->update('ahs', $dataUpdate);

        $this->index();
	}

	 public function update($id) 
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
		
        $row = $this->Proyek_model->get_by_id($id);

        if ($row) {
            $data = array(
				'back'   => site_url('proyek'),
                'button' => 'Update',
                'action' => site_url('proyek/update_action'),
				'id_proyek' => set_value('id_proyek', $row->id_proyek),
				'user_id' => set_value('user_id', $row->user_id),
				'project_name' => set_value('project_name', $row->project_name),
				'due_date' => set_value('due_date', $row->due_date),
				'status' => set_value('status', $row->status),		
				
				);
							
			$this->load->view('header',$dataUser); // Menampilkan bagian header dan object data users 	
            $this->load->view('proyek/edit_proyek', $data); // Menampilkan form mahasiswa
			$this->load->view('footer'); // Menampilkan bagian footer
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('proyek'));
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
            $this->update($this->input->post('id_proyek', TRUE));
        } else {
            $data = array(
						'project_name' 	=> $this->input->post('project_name',TRUE),
						'due_date' 		=> $this->input->post('due_date',TRUE),
						'status' 		=> $this->input->post('status',TRUE),
						);
			
            $this->Proyek_model->update($this->input->post('id_proyek', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('proyek'));
        }
    }

     public function _rules(){
	$this->form_validation->set_rules('id_proyek', 'id proyek', 'trim|required');
	$this->form_validation->set_rules('project_name', 'project_name', 'trim|required');
	$this->form_validation->set_rules('due_date', 'due_date', 'trim|required');				
	$this->form_validation->set_rules('id_proyek', 'id proyek', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function pdf($id_proyek)
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

		$data['proyek1']  = $this->db->select('t1.*, t2.*')
     		->from('proyek as t1')
     		->join('user as t2', 't1.user_id = t2.user_id', 'LEFT')
     		->where('t1.id_proyek', $id_proyek )
    		->get()->row_array();

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

       $this->load->view('Proyek/dompdf',$data);
    	
    	$this->mypdf->generate('Proyek/dompdf');
    }

     public function pdf1($id_proyek)
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

		$data['proyek1']  = $this->db->select('t1.*, t2.*')
     		->from('proyek as t1')
     		->join('user as t2', 't1.user_id = t2.user_id', 'LEFT')
     		->where('t1.id_proyek', $id_proyek )
    		->get()->row_array();

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

       $this->load->view('Proyek/dompdf1',$data);
    	
    	$this->mypdf->generate('Proyek/dompdf1');
    }

    public function update_total_proyek()
	{
		$id_proyek=$this->input->post('id_proyek');
		$t = $this->input->post('total');	
		$k = $this->input->post('kontraktor');	
		$a = $this->input->post('approved');	
		$c = $this->input->post('checked');	
		$p = $this->input->post('prepared');
		//buat kondisi jika status proyek open maka revisi tetap 0 / kosong
		$row = $this->db->get_where('proyek', ['id_proyek' => $id_proyek])->row_array();
		if($row['status'] == 'return'){
	   //update proyek
		$dataRevisi =  $row['revision'] + 1;
		$dataUpdate = array(	
			'total'       => $t,
			'kontraktor'       => $k,
			'approved'       => $a,
			'checked'       => $c,
			'prepared'       => $p,
			'kontraktor'	=> $k,
			'revision'		=> $dataRevisi,
		);
		$this->db->where('id_proyek =', $id_proyek);
        $this->db->update('proyek', $dataUpdate);
		}
		else{	
		//update proyek
		$dataUpdate = array(	
			'total'       => $t,
			'kontraktor'       => $k,
			'approved'       => $a,
			'checked'       => $c,
			'prepared'       => $p,
			'kontraktor'	=> $k,
		);
		$this->db->where('id_proyek =', $id_proyek);
        $this->db->update('proyek', $dataUpdate);
		}
		
        redirect(site_url('proyek'));
	}

 }


/* End of file Bua.php */