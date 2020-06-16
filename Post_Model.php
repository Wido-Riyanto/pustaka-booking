<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->helper('cleanurl_helper');
		$this->load->helper('tglindo_helper');
	}

	public function create($table,$data){
		$this->db->insert($table,$data);
	}

	public function read($table,$limit,$offset){
		// $query = $this->db->query("select * from $table order by ID DESC");
		
	
		$this->db->from($table);
		$this->db->limit($limit,$offset);
		$this->db->order_by('ID', 'DESC');
	
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}

			$query->free_result();
		}
		else{
			$data = NULL;
		}
		
		return $data;
	}
	
	public function read_komen($ID)
	{
		$q = $this->db->query("SELECT * FROM comment WHERE ID='$ID'");
		return $q->result();
	}
	
	

	public function edit($id,$table){
		$this->db->where('ID',$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

	public function update($id,$data,$table){
		$this->db->where('ID',$id);
		$this->db->update($table,$data);		
	}
	

	public function delete($id,$table){
		$this->db->where('ID',$id);
		$this->db->delete($table);
	}

	public function total_rows($table){
		return $this->db->count_all_results($table);
	}

	public function baca_artikel($id){
		$query = $this->db->query("SELECT * FROM tbl_post WHERE ID='$id'");
		return $query->result_array();
	}	

	public function readtesti($table,$limit,$offset){
		// $query = $this->db->query("select * from $table order by ID DESC");
		
	
		$this->db->from($table);
		$this->db->limit($limit,$offset);
		$this->db->order_by('testi_id', 'DESC');
	
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}

			$query->free_result();
		}
		else{
			$data = NULL;
		}
		
		return $data;
	}	

	public function deletetesti($id,$table){
		$this->db->where('testi_id',$id);
		$this->db->delete($table);
	}	
	/*
     public function getkomentar($id_artikel){
      $this->db->select("*");
      $this->db->from('comment');
      $this->db->where('ID', $id_artikel);
      $this->db->join('tbl_post','ID=comment.ID');

      return $this->db->get();
    } 	*/  	
}