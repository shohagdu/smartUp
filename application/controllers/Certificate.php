<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('certificate_model','certificate');
		$this->load->model('numbertobangla', 'bnc');
		$this->load->model('dashboard');
		$this->load->model('Role_chk', 'chk');
		$this->load->dbutil();
		
		$logged_status=$this->session->userdata('logged_status');
		if($logged_status==FALSE){
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
	public function index(){
		show_404();
	}
	// for nagorick Bangla certificate........
	public function nagorickBangla()
	{
		extract($_GET);
		$data = [
			'all_data' => $this->setup->getdata()
		];
		$result = $this->common->check_is_clear_holding_tax([
			'sha_trackid' => $id,
			'target_table' => "personalinfo"
		]);
		if($result['status'] === 'error'){
			$data['title'] = 'নাগরিক সনদপত্র';
			$data['message'] = "আপনার বর্তমান অর্থ বছরের হোল্ডিং ট্যাক্স পরিষদ করা হয় নাই। প্রথমে হোল্ডিং ট্যাক্স পরিষদ করতে হবে, তারপর সার্টিফিকেট প্রিন্ট করতেন পারবেন।";
			$this->load->view("admin/certificate/certificate_error_page", $data);
		}else{
			$data['row'] = $this->certificate->nagorickInfo($id);
			$data['row_Seril_Date'] = $this->certificate->nagorick_serial_date($id);
			
			$this->load->view("admin/certificate/nagorickBangla",$data);
		}
	}
	// for nagorick english certificate........
	public function nagorickEnglish()
	{
		extract($_GET);
		$data = [
			'all_data' => $this->setup->getdata()
		];
		$result = $this->common->check_is_clear_holding_tax([
			'sha_trackid' => $id,
			'target_table' => "personalinfo"
		]);
		if($result['status'] === 'error'){
			$data['title'] = 'Citizenship Certificate';
			$data['message'] = $result['message'];
			$this->load->view("admin/certificate/certificate_error_page", $data);
		}else{
			$data['row'] = $this->certificate->nagorickInfo($id);
			$data['row_Seril_Date'] = $this->certificate->nagorick_serial_date($id);
			
			$this->load->view("admin/certificate/nagorickEnglish",$data);
		}
	}
	// for other service  Bangla certificate........
	public function otherServiceBangla()
	{
		extract($_GET);
		$data=array(
			'all_data'				=> $this->setup->getdata(),
			'row' 					=> $this->certificate->otherServiceInfoM($id),
			'row_Seril_Date' 		=> $this->certificate->otherService_serial_date($id)
			
		);
		$this->load->view("admin/certificate/otherServiceBangla",$data);
	}
	// for other service  english certificate........
	public function otherServiceEnglish()
	{
		extract($_GET);
		$data=array(
			'all_data'				=> $this->setup->getdata(),
			'row' 					=> $this->certificate->otherServiceInfoM($id),
			'row_Seril_Date' 		=> $this->certificate->otherService_serial_date($id)
			
		);
		$this->load->view("admin/certificate/otherServiceEnglish",$data);
	}
	
	// for tradelicense Bangla certificate.........
	public function tradelicenseBangla()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'row'		=>	$this->certificate->tradelicnseInfo($id),
			'lrow'		=>	$this->certificate->tradelicenseTaka($id)
		);
		$this->load->view('admin/certificate/tradelicenseBangla',$data);
	}
	// for tradelicense english certificate........
	public function tradelicenseEnglish()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'row'		=>	$this->certificate->tradelicnseInfo($id),
			'lrow'		=>	$this->certificate->tradelicenseTaka($id)
		);
		$this->load->view('admin/certificate/tradelicenseEnglish',$data);
	}
	// for warish Bangla certificate.......
	public function warishBangla()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'row'		=>	$this->certificate->warishInformation($id),
			'mrow'		=>	$this->certificate->warishMoney($id),
			'wQy'		=>	$this->certificate->warishList($id)
		);
		$this->load->view("admin/certificate/warishBangla",$data);
	}
	// for warish English certificate......
	public function warishEnglish()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'row'		=>	$this->certificate->warishInformation($id),
			'mrow'		=>	$this->certificate->warishMoney($id),
			'wQy'		=>	$this->certificate->warishList($id)
		);
		$this->load->view("admin/certificate/warishEnglish",$data);
	}
}
