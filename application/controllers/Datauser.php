<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauser extends CI_Controller {
	
	public function get(){
		$this->load->model('Users');
		$data = null;
		$data = $this->Users->get($data);
		echo json_encode($data->row());
	}

}
