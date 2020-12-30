<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mms24 extends CI_Controller {
	public function __construct(){
		ob_start();
		parent::__construct();
		$this->load->library('user_agent');
		
		$this->load->model('Security_set','sq');
		$this->load->model('Login_model','mlogin');
		$this->load->model('license_check','app_license');
		
		$valid = $this->app_license->main_license_check();
		if( $valid == 0 ):
		elseif( $valid == 1 ):
			redirect("registration/expire","location");
		elseif( $valid == 2 ):
			redirect("registration/regis","location");
		endif;
	}
	public function _remap($method, $params=array()){
		$funcs = get_class_methods($this);
		if(in_array($method, $funcs)){ // We are trying to go to a method in this class
			return call_user_func_array(array($this, $method), $params);
		}
		else{
		  show_404();
		}
	}
	public function index(){
		$page_data=array();
		if(isset($_POST['loginform'])){
			if($_POST){
				$username=$this->input->post('username',TRUE);
				$password=$this->input->post('password',TRUE);
				$data=$this->mlogin->loginInfo($username,$password);
				echo "<pre>";
				print_r($data);
				exit;
			}
			
		}
		if(isset($_GET['sessionend'])){
			$sessionend=$this->input->get('sessionend');
			$sesID=$this->session->userdata('sid');
			$id=$this->session->userdata('id');
			$log_id = $this->session->userdata('log_id');
			if($sessionend == $sesID){
				$dd=array(
					'sid'=>'',
					'status'=>'0'
				);
				$this->db->where('id',$id);
				$this->db->update('admin',$dd);
				
				$logout_time = date("Y-m-d H:i:s");
				$login_history=array(
					'logout_time'	=>	$logout_time
				);
				$this->db->where('history_id',$log_id);
				$this->db->update('dcb_login_history',$login_history);
				$this->session->sess_destroy();
				redirect('mms24?sk=logout','location');
			}
			
		}
		else{
            $this->session->sess_destroy();
            $page_data['content']=$this->load->view("login_content",true);
            $this->load->view('login',$page_data);
		}
		/* $this->load->view('admin/loginMenu');
		$this->load->view('admin/loginContent');
		$this->load->view('admin/loginFooter'); */
	}
}