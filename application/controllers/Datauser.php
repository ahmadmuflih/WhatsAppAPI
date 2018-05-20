<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauser extends CI_Controller {
	
	public function get(){
		if(isset($_GET['token'])){
			$this->load->model('Users');
			$data = array(
				'token' => $_GET['token']
				);
			$result = $this->Users->get($data);
			if($result->num_rows()>0){
				echo json_encode(array('status'=>'success','code'=>200,'message'=>'Data is available','data'=>$result->row()));
			}
			else{
				echo json_encode(array('status'=>'failed','code'=>400,'message'=>'Session is not available!','data'=>null));
			}
		}
		else{
			echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No token!','data'=>null));
		}
	}

	public function search(){
		if(isset($_GET['token'])){

			$this->load->model('Users');
			$data = array(
				'token' => $_GET['token']
				);
			$result = $this->Users->get($data);
			if($result->num_rows()>0){
				if(isset($_GET['username'])){
					$data = array(
						'username' => $_GET['username'],
						'token!=' => $_GET['token']
						);
					$result = $this->Users->get($data);
					if($result->num_rows()>0){
						echo json_encode(array('status'=>'success','code'=>200,'message'=>'Data is available','data'=>$result->row()));
					}
					else{
						echo json_encode(array('status'=>'failed','code'=>404,'message'=>'Username is not found!','data'=>null));
					}
				}
				else{
					echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No username!','data'=>null));
				}
			}
			else{
				echo json_encode(array('status'=>'failed','code'=>400,'message'=>'Session is not available!','data'=>null));
			}
		}
		else{
			echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No token!','data'=>null));
		}
	}

	public function updateName(){
		if(isset($_GET['token']) && isset($_GET['nama'])){
			$this->load->model('Users');
			$param = array(
				'token' => $_GET['token']
				);
			$data = array(
				'nama'=> $_GET['nama']
				);
			$result = $this->Users->update($param,$data);
			echo json_encode(array('status'=>'success','code'=>200,'message'=>'Data has successfully updated','data'=>null));
		}
		else{
			echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No name or token !','data'=>null));
		}
	}
	public function login(){
		if(isset($_GET['username']) && isset($_GET['password'])){
			$data = array(
				'username' => $_GET['username'],
				'password' => md5($_GET['password'])
				);
			$this->load->model('Users');
			$result = $this->Users->get($data);

			if($result->num_rows()>0){
				$token = bin2hex(random_bytes(16));
				$data = array(
						'token' => $token
					);
				$param = array(
						'id' => $result->row()->id
					);
				$this->Users->update($param,$data);
				$result = $this->Users->get($data);

				echo json_encode(array('status'=>'success','code'=>200,'message'=>'Data is available','data'=>$result->row()));

			}
			else{
				echo json_encode(array('status'=>'failed','code'=>401,'message'=>'Username or password is wrong!','data'=>null));
			}
		}
		else{
			echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No username / password !','data'=>null));
		}
	}
}
