<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('dashboard');
		$this->load->model('Update_model','updateModel');
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
	
	/* picture upload function */
	public function profile_upload()
	{
		$this->load->view('admin/profile_upload');
	}
	
	
	// for nagorick information update...........
	public function nagorickInfo()
	{
		if($_POST)
		{
			$this->load->view('admin/updateInfo/jqueryPost/nagorickUpdate_action');
		}
		else
		{
			extract($_GET);
			$data=array(
				'row'	=>	$this->updateModel->nagorickInformation($id)
			);
			$this->load->view('admin/topBar',$data);
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/updateInfo/nagorickInfo');
			$this->load->view('admin/footer');
		}
	}
	// for other service information updatee.......
	public function otherServiceInfo(){
		if($_POST){
			$this->load->view('admin/updateInfo/jqueryPost/otherServiceUpdate_action');
		}
		else{
			extract($_GET);
			$data=array(
				'row'	=> $this->updateModel->otherServiceInformation($id)
			);
			$this->load->view('admin/topBar',$data);
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/updateInfo/otherServiceInfo');
			$this->load->view('admin/footer');
		}
	}
	
	// for tradelicense information update..........
	
	public function tradelicenseInfo()
	{
		extract($_GET);
		$data=array(
			'row'	=>	$this->updateModel->tradelicenseInformation($id)
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/updateInfo/tradelicenseInfo');
		$this->load->view('admin/footer');
	}
	public function tradelicenseUpdate()
	{
		$this->load->view('admin/updateInfo/jqueryPost/tradelicenseUpdate');
	}
	public function warishInfo()
	{
		extract($_GET);
		$warish		=	$this->updateModel->warishInformation($id);
		$trackid	=	$warish->trackid;
		$data=array(
			'row'	=> $warish,
			'wQy'	=> $this->updateModel->sub_warish_list($trackid)
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/updateInfo/warishInfo');
		$this->load->view('admin/footer');
	}
	public function wInfo()
	{
		extract($_GET);
		$data=array(
			'w_name'=>$w_name,
			'w_relation'=>$w_relation,
			'w_age'=>$w_age
		);
		$this->db->where('id',$id);
		$this->db->update('warishinfo',$data);
		echo "Modified Successfully.";
	}
	public function wdel()
	{
		extract($_GET);
		$this->db->where('id',$id);
		$this->db->delete('warishinfo');
		echo "Deleted Successfully.";
	}
	public function warishUpdate_action()
	{
		$this->load->view('admin/updateInfo/jqueryPost/warishUpdate_action');
	}
	
}
