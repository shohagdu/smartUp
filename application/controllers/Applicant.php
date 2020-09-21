<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('applicant_model','applicant');
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
	public function profile_upload()
	{
		$this->load->view('admin/profile_upload');
	}
	public function nagorickApplication()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/nagorickApplication');
		$this->load->view('admin/footer');
	}
	public function nagorickapplication_action()
	{
		$this->load->view('admin/application/jqueryPost/nagorickapplication_action');
	}
	public function tradelicenseApplication()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/tradelicenseApplication');
		$this->load->view('admin/footer');
	}
	public function tradelicenseapplication_action()
	{
		$this->load->view('admin/application/jqueryPost/tradelicenseapplication_action');
	}
	public function warishApplication()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/warishApplication');
		$this->load->view('admin/footer');
	}
	public function warishapplication_action()
	{
		$this->load->view('admin/application/jqueryPost/warishapplication_action');
	}
	public function otherServiceApplication()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/otherServiceApplication');
		$this->load->view('admin/footer');
	}
	public function otherserviceapplication_action()
	{
		$this->load->view('admin/application/jqueryPost/otherserviceapplication_action');
	}
	public function nagorickapplicant()
	{
		$data=array(
			'query'=>$this->applicant->nagorick_data()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/nagorickapplicant');
		$this->load->view('admin/footer');
	}
	public function nagorickapplicantReport()
	{
		$data=array(
			'query'=>$this->applicant->nagorick_data()
		);
		$this->load->view('admin/application/nagorickapplicantReport',$data);
	}
	public function otherService()
	{
		$data=array(
			'query'=>$this->applicant->otherService_data()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/otherService');
		$this->load->view('admin/footer');
	}
	public function otherServiceReport()
	{
		$data=array(
			'query'=>$this->applicant->otherService_data()
		);
		$this->load->view("admin/application/otherServiceReport",$data);
	}
	
	public function tradelicenseapplicant()
	{
		$data=array(
			'query'=>$this->applicant->tradelicense_data()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/tradelicenseapplicant');
		$this->load->view('admin/footer');
	}
	
	public function tradelicenseapplicantReport()
	{
		$data=array(
			'query'=>$this->applicant->tradelicense_data()
		);
		$this->load->view('admin/application/tradelicenseapplicantReport',$data);
	}
	
	public function warishapplicant()
	{
		$data=array(
			'query'=>$this->applicant->warish_data()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/warishapplicant');
		$this->load->view('admin/footer');
	}
	public function warishapplicantReport()
	{
		$data=array(
			'query'=>$this->applicant->warish_data()
		);
		$this->load->view('admin/application/warishapplicantReport',$data);
	}
	public function reNewTradelicense()
	{
		$data=array(
			'query'=>$this->applicant->renew_data()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/reNewTradelicense');
		$this->load->view('admin/footer');
	}
}
