<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Bua_model
class Ahs_model extends CI_Model
{
   
   function cek1($id_ahs) {
        $this->db->where("id_ahs", $id_ahs);
        //$this->db->where("password", $password);
        return $this->db->get("detail_ahs");
      }
    function cek2($id_kat) {
        $this->db->where("id_kategori", $id_kat);
        //$this->db->where("password", $password);
        return $this->db->get("bua");
      }
       function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // Property yang bersifat public  
    public $table = 'ahs';
    public $id = 'id_ahs';
    public $order = 'DESC';
    
   // Konstrutor   
   function __construct()
    {
        parent::__construct();
    }

    // Tabel data dengan nama bua
    function json() {
        $this->datatables->select("i.id_bua,nama_bua, i.satuan, i.ukuran, i.spesifikasi, i.merk, i.warna, i.harga, k.nama_kategori");
        $this->datatables->from('bua as i');
        //add this line for join
        $this->datatables->join('kategori as k','k.id_kategori= i.id_kategori');
        $this->datatables->add_column('action', anchor(site_url('bua/update/$1'),'<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>')."  ".anchor(site_url('bua/delete/$1'),'<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_bua');
	   return $this->datatables->generate();
    }

     public function getSingleBua($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get('bua');
    }  
     public function getSingleAhs($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get('ahs');
    }   
     public function getSingleKategori($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get('kategori');
    }   
   
   // Menampilkan semua data
   function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    public function getAhs()
    {
        $query = "select ahs.*, kategori_pekerjaan.* FROM ahs join kategori_pekerjaan ON ahs.id_pekerjaan=kategori_pekerjaan.id_pekerjaan";
        return $this->db->query($query)->result_array();
    }

     public function getBua_By_id_ahs($field, $value)
    {
        $query ="select detail_ahs.*, ahs.* FROM detail_ahs join ahs ON detail_ahs.id_ahs=ahs.id_ahs where detail_ahs.id_ahs = '$field, $value'";
        return $this->db->query($query)->result_array();
    }   
     public function getSingleAhs_by_id($id)
    {
       $this->db->select('t1.*, t2.*')
     ->from('detail_ahs as t1')
     ->where('t1.id_ahs', $id)
     ->join('ahs as t2', 't1.id_ahs = t2.id_ahs', 'LEFT')
   //  ->join('table3 as t3', 't1.id = t3.id', 'LEFT')
     ->get();
    }   
    
    // menampilkan jumlah data	
    function total_rows($q = NULL) {
        $this->db->like('id_bua', $q);
		$this->db->or_like('id_bua', $q);
        $this->db->or_like('id_kategori', $q);
		$this->db->or_like('nama_bua', $q);
        $this->db->or_like('satuan', $q);
        $this->db->or_like('ukuran', $q);
        $this->db->or_like('spesifikasi', $q);
        $this->db->or_like('merk', $q);
        $this->db->or_like('warna', $q);
        $this->db->or_like('harga', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Menampilkan data dengan jumlah limit
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_bua', $q);
        $this->db->or_like('id_bua', $q);
        $this->db->or_like('id_kategori', $q);
        $this->db->or_like('nama_bua', $q);
        $this->db->or_like('satuan', $q);
        $this->db->or_like('ukuran', $q);
        $this->db->or_like('spesifikasi', $q);
        $this->db->or_like('merk', $q);
        $this->db->or_like('warna', $q);
        $this->db->or_like('harga', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // Menambahkan data kedalam database
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // Merubah data kedalam database
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    public function updateDetail_ahs($id, $post)
    {
        $this->db->where('id_ahs', $id);
        $this->db->where('id_bua', $id);
        $this->db->update('detail_ahs', $post);
        return $this->db->affected_rows();
    }

     // Menghapus data kedalam database
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function delete_data($where,$table){
    $this->db->where($where);
    $this->db->delete($table);
  }

}

/* End of file Bua_model.php */
/* Location: ./application/models/Bua_model.php */
/* Please DO NOT modify this information : */