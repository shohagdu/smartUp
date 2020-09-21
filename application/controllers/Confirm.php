<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('applicant_model','applicant');
		//$this->load->model('page', 'page');
		//$this->load->model('conversion_number', 'convert');
		$this->load->model('numbertobangla', 'bnc');
		$this->load->model('Role_chk', 'chk');
		$this->load->dbutil();	
		$this->web->expire_license();
		
		$logged_status=$this->session->userdata('logged_status');
		if ($logged_status==FALSE){
			redirect('up24', 'location');
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
	public function nagorikConfirm()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/nagorikConfirm');
		$this->load->view('admin/footer');
	}
	public function otherServiceConfirm()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/otherServiceConfirm');
		$this->load->view('admin/footer');
	}
	public function tradelicenseConfirm(){
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/tradelicenseConfirm');
		$this->load->view('admin/footer');
	}
	public function warishConfirm()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/warishConfirm');
		$this->load->view('admin/footer');
	}
	
	public function newBosodbitaTaxConfirm()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/newBosodbitaTaxConfirm');
		$this->load->view('admin/footer');
	}
	public function oldBosodbitaTaxConfirm()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/oldBosodbitaTaxConfirm');
		$this->load->view('admin/footer');
	}
	public function peshaTradeConfirm()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/peshaTradeConfirm');
		$this->load->view('admin/footer');
	}
	public function tradeBosodbitaTaxConfirm()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/tradeBosodbitaTaxConfirm');
		$this->load->view('admin/footer');
	}
	public function searchUser(){
		if(isset($_GET['user_name'])){
			$userName=$_GET['user_name'];
			$qu=$this->db->query("select username from admin where username='$userName'");
			$num_rows=$qu->num_rows();
			if($num_rows>0){
				echo "1";exit;
			}
		}
	}
	public function reNewTradeLicenseConfirm(){
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/confirmPage/reNewTradeLicenseConfirm');
		$this->load->view('admin/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */