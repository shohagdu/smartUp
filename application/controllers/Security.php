<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('Security_set','sq');
		$this->load->model('dashboard');
		$this->load->model('Role_chk', 'chk');
		$this->load->dbutil();
		
		$logged_status=$this->session->userdata('id');
		if(!strlen($logged_status)){
			redirect('mms24','location');
		}
		$passChang = $this->setup->forcePassChange();
		if($passChang==false){
			redirect("setup_section/changePassword");
		}
		$get = $this->setup->basicUnionSetup();
		if($get==false){
			redirect("setup/updatesetupform",'location');
		}
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
	public function index()
	{
		extract($this->session->all_userdata());
		$page_load=array();
		$rivi= array(
			'row'		=>	$this->sq->get_all_security_settings($id,$question_id),
			'rowpic'	=>	$this->sq->get_random_img($id)
		);
		$page_load['content']=$this->load->view('admin/2_step_verification/step_2',$rivi,true);
		$this->load->view('login',$page_load);
	}
	public function checkAccount()
	{
		extract($_POST);
		extract($this->session->all_userdata());
		//print_r($_POST);
		$where = array(
			'user_id'		=>	$user_id,
			'question_id'	=>	$hidden_que_id
		);
		$query=$this->db->select('*')->from('dcb_sq_ans')->where($where)->get();
		$row = $query->row();
		//echo $this->db->last_query();
		if($row->ans != $ans){
			echo '1';exit;
		}
		else if($hidden_img != $user_id){
			echo '2';exit;
		}
		else{
			$status = array("logged_status" => TRUE);
			$this->session->set_userdata($status);
			$dataMMS=array(
				'sid'=>$sid,
				'status'=>'1'
			);
			$update=$this->db->where('id',$id)->update('admin',$dataMMS);
			if($update){
				echo '10';
				//redirect('Admin','location');
			}
		}
	}
	
   function security_question_setting()
   {
		$data=array(
		'quest'=>$this->sq->get_all_questions(),
		'ex_questions'=>$this->sq->check_exist_q()
		);
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/2_step_verification/security_question_setting',$data);
		$this->load->view('admin/footer');  
   }
 
	public function uniqueCheck(){
		extract($_POST);
		$ar=array();
		foreach($quest as $val){
			if($val!=''){
				array_push($ar,$val);
			}
		}
		if(count($ar)==1){
			echo 1;exit;
		}
		elseif(count($ar)==2){
			if($ar[0]==$ar[1]){
				echo 0;exit;
			}
		}
		
		elseif(count($ar)==3)
		{
			$unique=array_unique($quest);
			if(count($ar)!=count($unique)){
				echo 0;exit;
			}
		}
		echo 1;exit;          
	}
   
	public function security_setup()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/2_step_verification/setting');
		$this->load->view('admin/footer');
	}
	public function security_setup_submit()
	{
		extract($_POST);
		if(!strlen($two_step_verify)):echo "Please Select Two Step Verification"; exit;endif;
		//two step verification ON/OFF check
	    if(strlen($two_step_verify)):
			if(!strlen($security_question_verify) && !strlen($send_sms_verify) || !strlen($security_question_verify) && !strlen($random_picture_verify) || !strlen($send_sms_verify) && !strlen($random_picture_verify)):
			 echo "2";exit;
			endif;
		endif;
		//Mandatory mobile and email address verification
		if(strlen($send_sms_verify) && !strlen($mobile_verify) || !strlen($email_verify)):
		 echo "Please Select Verify Mobile & Verify Email.";exit;
		endif;
		$user_id=$this->session->userdata('id');
		$this->db->get_where("dcb_security_setting",array('user_id'=>$user_id))->row();
		$input=$this->input->post(null);
		if($this->db->affected_rows()>0):	
			if(!strlen($two_step_verify)):$two_step_verify='0'; endif;
			if(!strlen($security_question_verify)):$security_question_verify='0'; endif;
			if(!strlen($trans_pin_code)):$trans_pin_code='0'; endif;
			if(!strlen($mobile_verify)):$mobile_verify='0'; endif;
			if(!strlen($email_verify)):$email_verify='0'; endif;
			if(!strlen($send_sms_verify)):$send_sms_verify='0'; endif;
			if(!strlen($random_picture_verify)):$random_picture_verify='0'; endif;
			if(!strlen($password_complexity)):$password_complexity='0'; endif;
			if(!strlen($pass_change_45_days)):$pass_change_45_days='0'; endif;
			$update=array(
				'two_step_verify'=>$two_step_verify,
				'security_question_verify'=>$security_question_verify,
				'trans_pin_code'=>$trans_pin_code,
				'mobile_verify'=>$mobile_verify,
				'email_verify'=>$email_verify,
				'send_sms_verify'=>$send_sms_verify,
				'random_picture_verify'=>$random_picture_verify,
				'password_complexity'=>$password_complexity,
				'pass_change_45_days'=>$pass_change_45_days
			);   
		   $this->db->where('user_id',$input['user_id'])->update("dcb_security_setting",$update);
		else:	
			$this->db->insert("dcb_security_setting",$input);
			//update security setting on	
			$up_security=array('security_setting'=>1);
			$this->db->where('id',$user_id)->update('admin',$up_security);
		 endif;
		  extract($this->session->all_userdata());	  
		  if($verify_mobile=='0' || !strlen($question_id)):
		  //send verification code
		    echo "3";exit;
		  else:
		 echo "1";
		 endif;
		
	}
	public function update_security_submit()
	{
		$input=$this->input->post(null);
		$user_id=$this->session->userdata('id');
		$exists_q=$this->sq->check_exist_q();
		if(count(array_unique($input['quest']))<3):
         echo "2";exit;	
		endif;
		// echo count($exists_q);exit;
		for($i=0;$i<=2;$i++):
		$q_ans=array(
			'user_id'=>$user_id,
			'question_id'=>$input['quest'][$i],
			'ans'=>$input['ans'][$i]
		);
		if(count($exists_q)>0):
		$this->db->where('user_id',$user_id)->where('question_id',$input['quest'][$i])->update("dcb_sq_ans",$q_ans);
		else:
       $this->db->insert("dcb_sq_ans",$q_ans);	
       endif;	   
	 endfor;	
    $questions=array('question_id'=>implode(",",$input['quest']));
	$up=$this->db->where('id',$user_id)->update("admin",$questions);
	if($up):
	  echo "1";exit;
	endif;
	
	}
	function mobile_verfication_code()
	{   
	    $user_id=$this->session->userdata('id');
		$number=$this->uri->segment(3);
		$code=rand(000001,1000000);
		$msg="$code is Your Mobile Verification Code.";
		// $send=$this->sq->sendSms($number,$msg);
		$url=$_SERVER['HTTP_REFERER'];
		$verificaiton_record=array(
			'user_id'=>$user_id,
			'mobile'=>$number,
			'code'=>$code
		);
		$this->sq->store_verfication_record($verificaiton_record);
		redirect($url,'location');
		// if($send): redirect($url,'location');endif;
	}
	function valid_code($mobile,$code)
	{
		if($_POST):	
		$user_id=$this->session->userdata('id');
		extract($_POST);
		$result=$this->sq->find_valid_code($mobile,$code);
		if($result>0): echo "Verify"; 
		$verify=array('verify_mobile'=>'1');
		$this->db->where('id',$user_id)->update("admin",$verify);
		else: echo "Invalid Code";endif; exit;	
		endif;	 
	}
	
}
