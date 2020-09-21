<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onlinetrack extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('certificate_model','certificate');
		$this->load->model('Manage_admin','manageAdmin');
		$this->load->model('numbertobangla', 'bnc');
		$this->load->model('Role_chk', 'chk');
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
		redirect('show','location');
	}
	/*========mamla notice jacai start ==============*/
	public function mamlaNotice()
	{
		extract($_GET);
		if(trim($tid)==""){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার মামলার সনদের নাম্বারটি প্রবেশ করুন</p>';exit;}
		$this->db->select('*')->from('mamla_tbl')->where('mamla_sonod',$tid)->get();
		if($this->db->affected_rows()<1){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  মামলার  সনদের নাম্বারটি সঠিক না  <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন । </p>';exit;}
		$url=base_url()."index.php/onlinetrack/mamla_jacai?id=".sha1($tid);
		echo $this->web->curl_get($url);
	}
	public function mamla_jacai()
	{
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/filterCertificate/mamla_jacai',$data);
	}
	/*========mamla notice jacai end ==============*/
	/*============ holding tax verify  start==============*/
	public function holding_tax_verify()
	{
		extract($_GET);
		if(trim($hid)==""){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার হোল্ডিং নাম্বারটি প্রদান করুন ।</p>';exit;}
		$this->db->select('id')->from('holdingclientinfo')->where('holding_no',$hid)->get();
		if($this->db->affected_rows()<1){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  হোল্ডিং নাম্বারটি সঠিক না  <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন </p>';exit;}
		$url=base_url()."index.php/onlinetrack/holding_tax_justify?id=$hid";
		echo $this->web->curl_get($url);
	}
	public function holding_tax_justify()
	{
		extract($_GET);
		$holding_no=chop($id,'/');
		$response = $this->manageAdmin->get_holding_no_wise_tax_person($holding_no);
		if($response['status'] !== 'success'){
			echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  হোল্ডিং নাম্বারটি সঠিক না  <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন </p>';exit;
		}else{
			$all_info = [
				'all_data'=> $this->setup->getdata(),
				'info'	  => $response,
				'history' => $this->manageAdmin->get_bosotbita_history_for_website($response['data']->dag_no)
			];
			$this->load->view('home/filterCertificate/holding_tax_justify',$all_info);
		}
	}
	
	/*============ holding tax verify  end ==============*/

/*=== nagorik certificate search function start ========*/
	public function nagoriksonodpotro()
	{
		extract($_GET);
		if(trim($tid)==""){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার নাগরিক সনদের নাম্বারটি প্রবেশ করুন</p>';exit;}
		$this->db->select('*')->from('personalinfo')->where('sonodno',$tid)->get();
		if($this->db->affected_rows()<1){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  নাগরিক  সনদের নাম্বারটি সঠিক না  <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন অথবা  <br/>নাগরিক সনদের  জন্য আবেদন করুন। </p>';exit;}
		$url=base_url()."index.php/onlinetrack/nagoriksonod_jachai?id=".sha1($tid);
		echo $this->web->curl_get($url);
	}
	public function nagoriksonod_jachai()
	{
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/filterCertificate/nagoriksonod_jachai',$data);
	}

	/*=== nagorik certificate search function end ========*/
	/*========== other service certificate search function start ========*/
	public function otherServicesonodpotro()
	{
		extract($_GET);
		if(trim($tid)==""){echo '<p style="color:red;text-align:center;font-size:15px;">আপনার সনদের নাম্বারটি প্রবেশ করুন</p>';exit;}
		$this->db->select("*")->from('otherserviceinfo')->where('sonodno',$tid)->get();
		if($this->db->affected_rows()<1){echo '<p style="color:red;text-align:center;font-size:15px;">আপনার সনদের নাম্বারটি সঠিক না  <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন অথবা  <br/>সনদের  জন্য আবেদন করুন। </p>';exit;}
		$url=base_url()."index.php/onlinetrack/otherService_jachai?id=".sha1($tid);
		echo $this->web->curl_get($url);
	}
	public function otherService_jachai()
	{
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/filterCertificate/otherService_jachai',$data);
	}
	/*========== other service certificate search function end ========*/
	
	/*======= trade license certificate search function start ========*/
	
	 public function tradelicense_onosondan()
	 {
		extract($_GET);
		if(trim($tid)==""){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  ট্রেড লাইসেন্স নাম্বারটি প্রবেশ করুন</p>';exit;}
		$this->db->select('*')->from('tradelicense')->where('sno',$tid)->get();
		if($this->db->affected_rows()<1){ echo '<p style="color:red;text-align:center;font-size:15px;">আপনার  ট্রেড লাইসেন্স সনদের নাম্বারটি সঠিক না <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন অথবা  <br/> ট্রেড লাইসেন্স  জন্য আবেদন করুন।</p>';exit;}
		$url=base_url()."index.php/onlinetrack/trade_license_jachai?id=".sha1($tid);
		echo $this->web->curl_get($url);
	 }

	public function trade_license_jachai()
	{
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/filterCertificate/trade_license_jachai',$data);
	}
/*======= trade license certificate search function end ========*/
	
/* oarish certificate search function start =======*/
	
	public function warish_onosondan() /*======== not use curl_get mehtod on page function load kora hoice=======*/
	{
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/filterCertificate/warish_jachai',$data);
	}
/*========oarish certificate search function end======*/

}

?>