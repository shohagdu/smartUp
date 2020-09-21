<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('numbertobangla', 'bnc');
		$this->load->model('Transfer_model','transfer');
		$this->load->model('Transition_model','transition');
		$this->load->model('Generate_model','mgenerate');
		$this->load->model('money_receipt_model','money_receipt');
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
		/********inter bank balance Transfer*******/
		
	public function bankTransfers()
	{
		if($_POST){
			//print_r($_POST);exit;
			$fac=$this->input->post('faccount',true);
			$tac=$this->input->post('taccount',true);
			$amount=$this->input->post('amount',true);
			$payment_date=$this->input->post('payment_date',true);
			if($payment_date == "") exit;
			if($fac=="") exit;
			if($tac=="") exit;
			if($amount=="") exit;
			if($fac==$tac){ echo '2';exit;}
	
			$payment_date=date('Y-m-d',strtotime($payment_date));
			$fquery=$this->db->query("select balance from acinfo where acno='$fac'");
			$frow=$fquery->row();
			if($amount>$frow->balance){ echo '3'; exit;}
			
			//find last transaction no and store....
			$transno=$this->transition->get_transaction();
			$transaction_info=array('tid'=>$transno);
			
			//find last credet voucher no and store....	
			$voucherno=$this->transition->get_debit_voucher();
			$voucher_info=array('vno'=>$voucherno);
			
			
			$this->db->trans_start();
			//from account balance updated
				$this->db->query("update acinfo set balance=balance-$amount where acno='$fac'");
				$this->mgenerate->common_insert("transaction",$transaction_info);
				$this->mgenerate->common_insert("debit_voucher",$voucher_info);
	   
			//ledger updated
			//Balance add Ledger
			$user=$this->session->userdata('username');
			$legQ=$this->db->query("SELECT balance FROM ledger where ac='$fac' order by id DESC");
			$Rrow=$legQ->row();
			$nBalance=($Rrow->balance-$amount);
			$ledg=array(
				'tid'=>$transno,
				'voucherno'=>$voucherno,
				'purpose'=>'Balance Transfer From',
				'ac'=>$fac,
				'dr'=>$amount,
				'cr'=>0,  
				'vtype'=>'D',  
				'payment_date'=>$payment_date,  
				'balance'=>$nBalance,  
				'inby'=>$user
			); 
			$this->db->insert("ledger",$ledg);	
			//to account balance 
			$this->db->query("update acinfo set balance=balance+$amount where acno='$tac'");
       
       		$this->db->trans_complete();	
			if($this->db->trans_status() === TRUE){
				echo "1";
			}
			else {
				echo "Oops!!! Something error";
			}
		}
		else {
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/transfer/bankTransfers');
			$this->load->view('admin/footer'); 
		}
	}
	/******==== end bank transfer =====*********/
	
	public function taccount()
	{
		$ac=$this->input->get('ac',true);
		$query=$this->db->query("select balance from acinfo where acno='$ac' limit 1");
		$row=$query->row();
		echo $row->balance;
	}
	public function faccount()
	{
		$ac=$this->input->get('ac',true);
		$query=$this->db->query("select balance from acinfo where acno='$ac' limit 1");
		$row=$query->row();
		echo $row->balance;
	}
	
	/*====== fund transfer  strat ============*/
	public function fundTransfers()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/transfer/fundTransfers');
		$this->load->view('admin/footer');
	}
	public function fund_transfer_action()
	{
		$this->load->view('admin/transfer/jqueryPost/fund_transfer_action');
	}
	
	public function funwctg()
	{
		$this->load->view('admin/transfer/search/ctgfund');
	}
	public function sCategory()
	{
		$this->load->view('admin/transfer/search/subctgs');
	}
	public function sContent()
	{
		$this->load->view('admin/transfer/search/showcont');
	}
	public function pType()
	{
		$this->load->view('admin/transfer/search/slip');
	}
	/*======= end fund transfer ===========*/
}
