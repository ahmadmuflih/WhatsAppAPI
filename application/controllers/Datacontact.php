<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datacontact extends CI_Controller {
	


	public function getFriends(){
		if(isset($_GET['token'])){
			$this->load->model('Contacts');
			$token = $_GET['token'];
			$result = $this->Contacts->getFriends($token);
			if($result->num_rows()>0){
				echo json_encode(array('status'=>'success','code'=>200,'message'=>'Data is available','data'=>$result->result()));
			}
			else{
				echo json_encode(array('status'=>'failed','code'=>400,'message'=>'Session is not available!','data'=>null));
			}
		}
		else{
			echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No token!','data'=>null));
		}
	}

	public function addFriend(){
		if(isset($_GET['token'])){
			$this->load->model(array('Users','Contacts'));
			$data = array(
				'token' => $_GET['token']
				);
			$result = $this->Users->get($data);
			if($result->num_rows()>0){
				if(isset($_GET['id'])){
					$data = array(
						'id_adder' => $result->row()->id,
						'id_friend' => $_GET['id']
						);
					$cek = $this->Contacts->get($data);
					if($cek->num_rows()>0){
						echo json_encode(array('status'=>'failed','code'=>400,'message'=>'Telah ditambahkan sebagai teman!','data'=>null));
					}
					else{
						$this->Contacts->insert($data);
						echo json_encode(array('status'=>'success','code'=>200,'message'=>'Berhasil ditambahkan!','data'=>null));
					}
					

				}
				else{
					echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No friend!','data'=>null));
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
	public function deleteFriend(){
		if(isset($_GET['token'])){
			$this->load->model(array('Users','Contacts'));
			$data = array(
				'token' => $_GET['token']
				);
			$result = $this->Users->get($data);
			if($result->num_rows()>0){
				if(isset($_GET['id'])){
					$data = array(
						'id_adder' => $result->row()->id,
						'id_friend' => $_GET['id']
						);
						$this->Contacts->delete($data);
						echo json_encode(array('status'=>'success','code'=>200,'message'=>'Berhasil dihapus!','data'=>null));
					}
				else{
					echo json_encode(array('status'=>'failed','code'=>404,'message'=>'No friend!','data'=>null));
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
}
