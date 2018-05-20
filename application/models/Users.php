<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Users extends CI_Model {
		function __construct(){
      parent::__construct();
      // $this->db1 = $this->load->database('db1', TRUE);
    }
		function get($param=array()){
			
			$this->db->select("*");
			$this->db->from("users");
			if($param!=null)
				$this->db->where($param);
			return $this->db->get();

		}
		function insert($data = array()){
			$this->db->insert("users",$data);
			$last_id = $this->db->insert_id();
			return $last_id;
		}
		function update($param=array(),$data=array()){
			//update users set nama = 'Baso';
			$this->db->update("users",$data);
			$this->db->where($param);
			return $this->db->affected_rows();
		}
		function delete($param=array()){
			// delete from users where id=1
			$this->db->delete("users",$param);
			return $this->db->affected_rows();
		}
	}
