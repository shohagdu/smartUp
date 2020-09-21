<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RenewTradeLicense extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
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
	
	// for Renew Trade License genarate section start.......
	public function RenewTradeLicenGenerate(){
		extract($_GET);
		$data['id']=$id;
		$data['row']=$this->web->getTinfo($id);
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/Renew/RenewTradeLicenGenerate',$data);
		$this->load->view('admin/footer');
	}
	
	public function ReNewTradelicenseGenarate_action(){
		$this->load->view('admin/application/jqueryPost/ReNewTradelicenseGenarate_action');
	}
	// for Renew Trade License genarate section end........
	
	// for trade license SMS section start...... 
	public function smsInformation(){
		extract($_POST);
		$q=$this->db->query("select bcomname,id,trackid,sno,mobile from tradelicense where id='$tId'")->row();
		echo $q->bcomname."+&+&".$q->sno."+&+&".$q->mobile."+&+&".$q->id;
	}
	public function sendSMStrade(){
			extract($_POST);
			//echo "<pre>";
			//print_r($_POST);exit;
			$mobile1 = substr($mobile, -11);
			$sendSm=$this->web->smsSendNew($mobile1,$msg);
			
			if($sendSm=="success"){echo "1";}
			else{
			    echo $sendSm;exit;
			}
	}
	// for trade license SMS section end......
	
	// for renew section.........
	public function renew_license(){
		//if(isset($_POST['applyReNew'])){
			extract($_POST);
			
			$this->db->query("select * from renew_req where sno ='$sno1' and status='1'");
			
			$affRow=$this->db->affected_rows();
			if($affRow>0){ echo "2"; exit;}
			$data=array(
				'sno'=>$sno1,
				'dtype'=>$delivery_type
			);
			$this->db->insert("renew_req",$data);
			$ins=$this->db->query("update tradelicense set status='3' where sno ='$sno1' LIMIT 1");
			if($ins){echo "1";exit;}
		//}
	}
}
