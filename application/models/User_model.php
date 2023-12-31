<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Users_model
class User_model extends CI_Model
{
   
    // Property yang bersifat public   
    public $table = 'user';
    public $id = 'user_id';
    public $order = 'DESC';
    
   // Konstrutor   
   function __construct()
    {
        parent::__construct();
    }

    // Tabel data dengan nama users
    function json() {
        $this->datatables->select('user_id,username,password,email,departement,ext,plant_name,level');
        $this->datatables->from('user');        
        $this->datatables->add_column('action', anchor(site_url('user/update/$1'),'<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>')."  ".anchor(site_url('user/delete/$1'),'<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'user_id');
        return $this->datatables->generate();
    }

   
   // Menampilkan semua data 
   function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Menampilkan semua data berdasarkan id-nya
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
     // menampilkan jumlah data 
    function total_rows($q = NULL) {
        $this->db->like('user_id', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('departement', $q);
        $this->db->or_like('ext', $q);
        $this->db->or_like('plant_name', $q);
        $this->db->or_like('level', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Menampilkan data dengan jumlah limit
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('user_id', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('departement', $q);
        $this->db->or_like('ext', $q);
        $this->db->or_like('plant_name', $q);
        $this->db->or_like('level', $q);
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

     // Menghapus data kedalam database
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
/* Please DO NOT modify this information : */