<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyReports extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('numbertobangla', 'bnc');
		$this->load->model('dailyreports_model','daily_reports');
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
	public function daily_holding_tax_report(){
		
		if(isset($_GET['cDate']) && !empty($_GET['cDate'])){
			$param = ['cDate' => $_GET['cDate']];
		}else{
			$param = ['cDate' => date('Y-m-d')];
		}
		$data = [
			'all_data' => $this->setup->getdata(),
			'report'   => $this->daily_reports->get_daily_holding_tax_report($param),
			'cDate'    => $param['cDate']
		];
		$this->load->view("admin/dailyReports/daily_holding_tax_report",$data);
	}
	public function yearly_holding_tax_report(){
		
		if(isset($_GET['fiscalYear']) && !empty($_GET['fiscalYear'])){
			$param = ['year' => (string)$_GET['fiscalYear']];
		}else{
			$param = ['year' => null];
		}
		$data = [
			'all_data'   => $this->setup->getdata(),
			'fiscal_year'=> $this->setup->get_fiscal_year(), 
			'report'     => $this->daily_reports->get_yearly_holding_tax_report($param),
			'cDate'      => date('Y-m-d')
		];
		$this->load->view("admin/dailyReports/yearly_holding_tax_report",$data);
	}
	public function holding_tax_unrealized_report(){
		
		if(isset($_GET['fiscalYear']) && !empty($_GET['fiscalYear'])){
			$param = ['year' => (string)$_GET['fiscalYear']];
		}else{
			$param = ['year' => null];
		}
		$data = [
			'all_data'   => $this->setup->getdata(),
			'fiscal_year'=> $this->setup->get_fiscal_year(), 
			'report'     => $this->daily_reports->get_holding_tax_unrealized_report($param),
			'cDate'      => date('Y-m-d')
		];
		echo "<pre>";
		print_r($data);
		exit;
		$this->load->view("admin/dailyReports/holding_tax_unrealized_report",$data);
	}
	public function holding_tax_list(){
		$data = [
			'all_data'   => $this->setup->getdata(),
			'report'     => $this->setup->get_all_bosotbita_kor_person(),
			'cDate'      => date('Y-m-d')
		];
		$this->load->view("admin/dailyReports/holding_tax_list",$data);
	}
	public function dailyShortReport(){
		$data=array();
		$data['all_data']= $this->setup->getdata();
		$this->load->view("admin/dailyReports/dailyShortReport",$data);
	}
	// for daily collection ..........
	public function dailyCollection()
	{
		$data=array();
		$data['all_data']=$this->setup->getdata();
		if(isset($_GET['fdate']) && isset($_GET['tdate'])){
			$param=array(
				'fdate' => $_GET['fdate'],
				'tdate' => $_GET['tdate'],
				'ctg' => (isset($_GET['ctg'])? $_GET['ctg']:'')
			);
		}else{
			$param=array(
				'fdate' => date('Y-m-d'),
				'tdate' => date('Y-m-d')
			);
		}
		$data['dailyReport'] = $this->daily_reports->dailyCollectionReport($param);
		$data['record'] = count($data['dailyReport']);
		$data['fdate'] = $param['fdate'];
		$data['tdate'] = $param['tdate'];
		if(isset($_GET['ctg'])){
			$data['ctg'] = $_GET['ctg'];
		}
		
		$q=$this->db->select('sub_title')->from('subctg');				
		$data['out'] = $q->get()->result();
		$this->load->view("admin/dailyReports/dailyCollection",$data);
	}
	/*
	* Daily Vat collection report
	*/
	public function dailyVatCollection()
	{
		$data=array();
		$data['all_data']=$this->setup->getdata();
		if(isset($_GET['fdate']) && !empty($_GET['fdate']) && isset($_GET['tdate']) && !empty($_GET['tdate'])){
			$param = [
				'fdate'	=> $_GET['fdate'],
				'tdate'	=> $_GET['tdate']
			];
		}else{
			$param = [
				'fdate'	=> date('Y-m-d'),
				'tdate'	=> date('Y-m-d')
			];
		}
		$data['daily_vat_report'] = $this->daily_reports->daily_vat_collection_report($param);
		$data['record'] = count($data['daily_vat_report']);
		$data['fdate']= $param['fdate'];
		$data['tdate'] = $param['tdate'];
		
		$this->load->view("admin/dailyReports/dailyVatCollection",$data);
	}
	public function dailyBankDetails()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/dailyReports/dailyBankDetails');
		$this->load->view('admin/footer');
	}
	public function dailyBankReportSearch()
	{
		//print_r($_GET);
		$this->load->view('admin/dailyReports/search/dailyBankReportSearch');
	}
	public function dailyMainLedger()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/dailyReports/dailyMainLedger');
		$this->load->view('admin/footer');
	}
	public function dailyMainLedgerSearch()
	{
		//print_r($_GET);
		$this->load->view('admin/dailyReports/search/dailyMainLedgerSearch');
	}
	public function dailySubLedger()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/dailyReports/dailySubLedger');
		$this->load->view('admin/footer');
	}
	public function dailySubLedgerSearch()
	{
		//print_r($_GET);
		$this->load->view('admin/dailyReports/search/dailySubLedgerSearch');
	}
	// update by shohage 21.03.2016
	public function dailyExpense()
	{
		$data=array();
		$data['all_data']=$this->setup->getdata();
		$this->load->view("admin/dailyReports/dailyExpense",$data);
	}
	// month reports.....
	public function monthlyReport(){
		$data=array();
		$data['all_data']= $this->setup->getdata();
		$this->load->view("admin/dailyReports/monthlyReport",$data);
	}
	// yearly reports
	public function yearlyReport(){
		$data=array();
		$data['all_data']= $this->setup->getdata();
		$this->load->view("admin/dailyReports/yearlyReport",$data);
	}
	public function incomeTicaInfo(){
		$data = array();
		$data['all_data'] = $this->setup->getdata();
		$this->load->view("admin/dailyReports/incomeTicaInfo",$data);
	}
    public function foodApplicantReport(){
        $data=array();
        $data['all_data'] = $this->setup->getdata();
        $data['dealerInfo']= $this->setup->get_all_info('id,type,name,shop_name,address,mobile,is_active',"food_dealer_info",['is_active'=>1,'type'=>1]);
        $this->load->view("admin/dailyReports/foodApplicantReport",$data);
    }
    public function foodCollectionReport(){
        $data=array();
        $data['all_data'] = $this->setup->getdata();
        $data['program'] =  $this->setup->get_all_info('id,title,person_amt,total_allotment',"food_program_info",['is_active != '=>0,'program_type'=>1]);
        $data['dealerInfo']= $this->setup->get_all_info('id,type,name,shop_name,address,mobile,is_active',"food_dealer_info",['is_active'=>1,'type'=>1]);
        $this->load->view("admin/dailyReports/foodCollectionReport",$data);
    }
    public function vgdDistributesReport(){
        $data=array();
        $data['all_data'] = $this->setup->getdata();
        $data['program'] =  $this->setup->get_all_info('id,title,person_amt,total_allotment',"food_program_info",['is_active != '=>0,'program_type'=>2]);
        $data['AllCircleInfo']=$this->setup->get('food_vgd_circle_setup',['is_active'=>1],'id,title,issue_dt,distributes_dt,implement_authority,responsibile_officer,responsibile_uno',['filed'=>'id','order'=>'DESC']);
        $this->load->view("admin/dailyReports/vgdDistributesReport",$data);
    }

}
