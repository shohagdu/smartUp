<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genarate extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('Transition_model','transition');
		$this->load->model('Generate_model','mgenerate');
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
	/*======== nagorick genarate section start  ==============*/
	// for nagorick genarate
	public function nagorickGenarate()
	{
		extract($_GET);
		$data['row']=$this->web->pPorichoe($id);
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/genarate/nagorickGenarate',$data);
		$this->load->view('admin/footer');	
	}
	public function nagorickGenarate_action()
	{
		$this->load->view("admin/application/jqueryPost/nagorickGenarate_action");
	}
	/*======== nagorick genarate section end  ==============*/
	
	/*======== Other service  genarate section start  ==============*/
	// for other service  genarate
	public function otherServiceGenarate()
	{
		extract($_GET);
		$data['row']=$this->mgenerate->otherServiceInfo($id);
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/genarate/otherServiceGenarate',$data);
		$this->load->view('admin/footer');	
	}
	public function otherServiceGenarate_action()
	{
		$this->load->view("admin/application/jqueryPost/otherServiceGenarate_action");
	}
	/*======== other service genarate section end  ==============*/
	
	/* ======== tradelicense genarate section start =========*/
	
	public function tradelicenseGenarate()
	{
		extract($_GET);
		$data['id']=$id;
		$data['row']=$this->web->getTinfo($id);
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/application/genarate/tradelicenseGenarate',$data);
		$this->load->view('admin/footer');
	}
	// 
	public function ctotal()
	{
		$total=0;
		extract($_GET);
		$total=($fee+$due)-$ds;
		$total=($total*15)/100;
		echo "<input type='text' class='form-control highlisht_font' name='vat' value='$total' id='vat' readonly />";
	}
	//
	public function intotal()
	{
		$total=0;
		extract($_GET);
		$total=($fee+$due+$vat+$sbf+$sub_charge)-$ds;
		echo "<input type='text' class='form-control highlisht_font' name='total' value='$total' id='total' readonly />";
	}
	//
	public function tradelicenseGenarate_action()
	{
		$this->load->view('admin/application/jqueryPost/tradelicenseGenarate_action');
	}
	
	/* ======== tradelicense genarate section end =========*/
	
	
	/*======== oarish genarate section start  ==============*/
	// for oarish genarate........
	public function warishGenarate()
	{
		extract($_GET);
		$data['row']=$this->web->wccinfo($id);
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view("admin/application/genarate/warishGenarate",$data);
		$this->load->view('admin/footer');	
	}
	
	public function warishGenarate_action()
	{
		$this->load->view('admin/application/jqueryPost/warishGenarate_action');
	}
	/*======== oarish genarate section end   ==============*/
}
