<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Contacts extends CI_Model {
		function __construct(){
      parent::__construct();
      // $this->db1 = $this->load->database('db1', TRUE);
    }
		function get($param=array()){
			
			$this->db->select("*");
			$this->db->from("contacts");
			if($param!=null)
				$this->db->where($param);
			return $this->db->get();

		}
		function insert($data = array()){
			$this->db->insert("contacts",$data);
			$last_id = $this->db->insert_id();
			return $last_id;
		}
		function update($param=array(),$data=array()){
			$this->db->update("contacts",$data);
			$this->db->where($param);
			return $this->db->affected_rows();
		}
		function delete($param=array()){
			// delete from contacts where id=1
			$this->db->delete("contacts",$param);
			return $this->db->affected_rows();
		}
		function getFriends($token){
			$this->db->select("u.*");
			$this->db->from("contacts c");
			$this->db->join("users u","c.id_friend = u.id");
			$this->db->join("users ua","c.id_adder = ua.id");
			$this->db->where("ua.token = '$token'");
			return $this->db->get();
		}
	}
