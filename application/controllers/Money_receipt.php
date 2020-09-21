<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Money_receipt extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('numbertobangla', 'bnc');
		$this->load->model('certificate_model','certificate');
		$this->load->model('money_receipt_model','money_receipt');
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
	// for nagorick money receipt
	public function nagorickMoneyReceipt()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'row'		=>	$this->money_receipt->moneyrecptInfo($id),
			'nrow'		=>	$this->money_receipt->nagorickInfo($id),
			'mrow'		=>	$this->money_receipt->nagorickDate($id)
		);
		$this->load->view("admin/moneyReceipt/nagorickMoneyReceipt",$data);	
	}
	
	// for nagorick money receipt
	public function otherServiceMoneyReceipt()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'row'		=>	$this->money_receipt->otherServicemoneyrecptInfo($id),
			'nrow'		=>	$this->money_receipt->otherServiceInfoM($id),
			'mrow'		=>	$this->money_receipt->otherServiceDate($id)
		);
		
		$this->load->view("admin/moneyReceipt/otherServiceMoneyReceipt",$data);	
	}
	// for tradelicense money receipt
	public function tradelicenseMoneyReceipt()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'nrow'		=>	$this->money_receipt->tradelicenseInfo($id),
			'lrow'		=>	$this->money_receipt->tradeTakaInfo($id)
		);
		$this->load->view('admin/moneyReceipt/tradelicenseMoneyReceipt',$data);
	}
	// for tab  tradelicense money receipt....
	public function tabTradelicenseMoneyReceipt()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'nrow'		=>	$this->money_receipt->tradelicenseInfo($id),
			'lrow'		=>	$this->money_receipt->tabTradeTakaInfo($vno)
		);
		$this->load->view('admin/moneyReceipt/tradelicenseMoneyReceipt',$data);
	}
	public function tardelicenseTaka()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata()
		);
		$this->load->view('admin/moneyReceipt/tardelicenseTaka',$data);
	}
	// for warish money receipt
	public function warishMoneyReceipt()
	{
		extract($_GET);
		$data['trackid']=$id;
		$data['all_data']=$this->setup->getdata();
		$this->load->view("admin/moneyReceipt/warishMoneyReceipt",$data);
	}
	// for all roshid show function...........
	public function allroshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabtradelicense()
		);
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/moneyReceipt/allroshid',$data);
		$this->load->view('admin/footer');
	}
	/*========= tab roshid all function start =============*/
	// for tradelicense roshid.........
	public function tradelicense_tab_roshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabtradelicense()
		);
		$this->load->view('admin/moneyReceipt/tab/tradelicense_tab_roshid',$data);
	}
	// for bosodbitakor roshid..........
	public function bosodbitakor_tab_roshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabbosodbitakor()
		);
		$this->load->view('admin/moneyReceipt/tab/bosodbitakor_tab_roshid',$data);
	}
	// for peshajibikor roshid.........
	public function peshajibikor_tab_roshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabpeshajibikor()
		);
		$this->load->view('admin/moneyReceipt/tab/peshajibikor_tab_roshid',$data);
	}
	// for dailycollection roshid.........
	public function dailycollection_tab_roshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabdailycollection()
		);
		$this->load->view('admin/moneyReceipt/tab/dailycollection_tab_roshid',$data);
	}
	// for trade bosodbitakor roshid.........
	public function trade_bosodbitakor_tab_roshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabtrade_bosodbitakor()
		);
		$this->load->view('admin/moneyReceipt/tab/trade_bosodbitakor_tab_roshid',$data);
	}
	// for nagorick roshid.........
	public function nagoriksonod_tab_roshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabnagoriksonod()
		);
		$this->load->view('admin/moneyReceipt/tab/nagoriksonod_tab_roshid',$data);
	}
	// for warish roshid.........
	public function warishsonod_tab_roshid()
	{
		$data=array(
			'qy'	=> $this->money_receipt->tabwarishsonod()
		);
		$this->load->view('admin/moneyReceipt/tab/warishsonod_tab_roshid',$data);
	}
	/*========= tab roshid all function end =============*/
	
	/*========== bosodbita kor money receipt start ========*/
	public function bosodbitakorMoneyReceipt()
	{
		if(isset($_GET['id']) && !empty($_GET['id'])){
			//extract($_GET);
			$receive = $this->input->get();
			$data=array(
				'all_data'	=>	$this->setup->getdata(),
				'nrow'		=>	$this->money_receipt->holding_client_info($receive['dno'], $receive['vno']),
				'row'		=>	$this->money_receipt->get_fiscal_year_wise_payment_log($receive['dno'], $receive['vno'])
			);
			$this->load->view('admin/moneyReceipt/bosodbitakorMoneyReceipt',$data);
		}
		else{
			$session_info = $this->session->userdata('holding_money_receipt');
			$data=array(
				'all_data'	=>	$this->setup->getdata(),
				'nrow'		=>	$this->money_receipt->holding_client_info($session_info['holdingNumber'], $session_info['vno']),
				'row'		=>	$this->money_receipt->get_fiscal_year_wise_payment_log($session_info['holdingNumber'], $session_info['vno'])
			);
			$this->load->view('admin/moneyReceipt/bosodbitakorMoneyReceipt',$data);
		}
	}
	/*========== bosodbita kor money receipt end ========*/
	
	/*=========== pesha money receipt  start=========*/
	public function peshaMoneyReceipt()
	{
		if(isset($_GET['id']) && !empty($_GET['id'])){
			extract($_GET);
			$pesha_money_query = $this->money_receipt->pesh_money_money($id);
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'nrow'			=>	$this->money_receipt->pesh_money_info($sno),
				'row'			=>	$pesha_money_query,
				'voucher_no'	=>	$pesha_money_query->inno
			);
			//echo '<pre>';
			//print_r($data);exit;
			$this->load->view('admin/moneyReceipt/peshaMoneyReceipt',$data);
		}
		else{
			$vno=$this->session->userdata('vno');
			$id=$this->session->userdata('tradLicenceId');
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'nrow'			=>	$this->money_receipt->pesh_money_info($id),
				'row'			=>	$this->money_receipt->session_pesh_money_money($id),
				'voucher_no'	=>	$vno
			);
			$this->load->view('admin/moneyReceipt/peshaMoneyReceipt',$data);
		}
	}
	/*=========== pesha money receipt  end=========*/
	
	
	/*=========== trade bosodbita  money receipt  start =========*/
	public function tradeBosodbitakorMoneyReceipt()
	{
		if(isset($_GET['id']) && !empty($_GET['id'])){
			extract($_GET);
			$tradebosodbitaMoneyInfo = $this->money_receipt->tradebosodbitaMoneyInfo($id);
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'nrow'			=>	$this->money_receipt->tradebosodbitaInfo($sno),
				'row'			=>	$tradebosodbitaMoneyInfo,
				'voucher_no'	=>	$tradebosodbitaMoneyInfo->inno
			);
			$this->load->view('admin/moneyReceipt/tradeBosodbitakorMoneyReceipt',$data);
		}
		else{
			$id=$this->session->userdata('tradLicenceId');
			$vno=$this->session->userdata('vno');
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'nrow'			=>	$this->money_receipt->tradebosodbitaInfo($id),
				'row'			=>	$this->money_receipt->tradebosodbitaMoney_sesion($id),
				'voucher_no'	=>	$vno
			);
			$this->load->view('admin/moneyReceipt/tradeBosodbitakorMoneyReceipt',$data);
		}
	}
	/*====== trade bosodbita  money receipt end============== */
	
	
	/*====== daily collection  money receipt start ============== */
	
	public function dailyCollectionMoneyReceipt()
	{
		if(isset($_GET['id']) && !empty($_GET['id'])){
			extract($_GET);
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'row'			=>	$this->money_receipt->dailyCollectionInfo($id)
			);
			$this->load->view('admin/moneyReceipt/dailyCollectionMoneyReceipt',$data);
		}
		else{
			$vno = $this->session->userdata('voucherno');
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'row'			=>	$this->money_receipt->dailyCollectionInfo_session($vno)
			);
			$this->load->view('admin/moneyReceipt/dailyCollectionMoneyReceipt',$data);
		}
	}
	
	/*====== daily collection  money receipt end  =============== */
	// for dailyExpense roshid.........19.03.2016
	public function dailyExpense_tab_roshid()
	{
		$data=array(
			'qy' => $this->money_receipt->tabdailyExpense()
		);
		$this->load->view('admin/moneyReceipt/tab/dailyExpense_tab_roshid',$data);
	}
	
	public function dailyExpenseMoneyReceipt()
	{
		if(isset($_GET['id']) && !empty($_GET['id'])){
			extract($_GET);
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'row'			=>	$this->money_receipt->dailyExpenseInfo($id)
			);
			$this->load->view('admin/moneyReceipt/dailyExpenseMoneyReceipt',$data);
		}
		else{
			$vno = $this->session->userdata('voucherno');
			$data=array(
				'all_data'		=>	$this->setup->getdata(),
				'row'			=>	$this->money_receipt->dailyCollectionInfo_session($vno)
			);
			$this->load->view('admin/moneyReceipt/dailyExpenseInfo_session',$data);
		}
	}
	
}
