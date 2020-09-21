<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Manage_admin','manageAdmin');
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
/* home page load function start */

	// application section 
	
   public function nagorikapplication()
   {
		$data = array();
		$data['title'] = "নাগরিক আবেদন";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/application/nagorikapplication');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	
	// nagorikapplication submit page function
	public function nagorikapplication_action()
	{
		$this->load->view('home/application/jqueryPost/nagorikapplication_action');
	}
	
	public function tradelicenseapplication()
	{
		$data = array();
		$data['title']= "ট্রেড লাইসেন্স আবেদন";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/application/tradelicenseapplication');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	
	//tradelicenseapplication submit page function 
	public function tradelicenseapplication_action()
	{
		$this->load->view('home/application/jqueryPost/tradelicenseapplication_action');
	}
	//trade license renew
	public function renewapplication()
	{
		$data=array(
			'all_data'	=>	$this->setup->getdata()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/application/renewapplication');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function license_renew()
	{
		extract($_POST);
		//print_r($_POST); exit();
		if(trim($delivery_type)==""){ echo "দয়া করে সরবরাহের  ধরণ নির্বাচন করুন";exit;}
		if(trim($tradeno)==""){ echo "আপনার  ট্রেড লাইসেন্স সনদের নাম্বারটি ইংরেজীতে প্রবেশ করুন";exit;}
		$qy=$this->db->select('*')->from('tradelicense')->where('sno',$tradeno)->get()->row();
		if($this->db->affected_rows()<1){ echo "আপনার  ট্রেড লাইসেন্স সনদের নাম্বারটি সঠিক না, \nআপনি ইউনিয়ন পরিষদে যোগাযোগ করুন অথবা  \nনতুন ট্রেড লাইসেন্স এর জন্য আবেদন করুন।";exit;}
		else if($this->db->affected_rows()==1){
			$cdate=date("Y-m-d");
			$expire_date=$qy->expire_date;
			$show_date=date("d M, Y",strtotime($expire_date));
			if($expire_date > $cdate){
				echo "আপনার লাইসেন্সটি $show_date পর্যন্ত বৈধ আছে, \n আপনি এর পর নবায়নের জন্য আবেদন করতে পারবেন।";exit();
			}
			$where=array(
				'sno'		=>	$tradeno,
				'status'	=>	1
			);
			$renew_data = $this->db->select('*')->from('renew_req')->where($where)->get()->row();
			$show_sno = $renew_data->sno;
			if($this->db->affected_rows()>0){
				echo "দুঃখিত!!!  $show_sno এই সনদ নম্বরটি already নবায়নের জন্য আবেদন করা হয়েছে, \nআপনি ইউনিয়ন পরিষদে যোগাযোগ করুন।";exit();
			}
			else if($this->db->affected_rows()<1){
				$data=array(
					'sno'=>$tradeno,
					'dtype'=>$delivery_type
				);
				// for ne-rew table insert.......
				$this->db->insert("renew_req",$data);
				
				// for tradelicense status update
				$data_up=array(
					'status'	=> 3
				);
				$this->db->where("sno",$tradeno);
				$this->db->update("tradelicense",$data_up);
				echo 3;exit();
			}
		}
	}
	public function oarishapplication()
	{
		$data = array();
		$data['title']= 'ওয়ারিশ আবেদন';
		$data['all_data']=$this->setup->getdata();	
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/application/oarishapplication');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	
	// warish application submit page function
	public function oarishapplication_action()
	{
		$this->load->view('home/application/jqueryPost/oarishapplication_action');
	}
	//****** other service start ********//
	public function otherService()
   {
		extract($_GET);
		if($service==""){
			$title = "অন্যান্য সেবা";
		}
		else{
			$where=array(
				'id' 	=> $service,
				'status'=>1
			);
			$qy = $this->db->select("id,listName")->from("otherservicelist")->where($where)->get()->row();
			$title = $qy->listName;
		}

		$data = array();
		$data['title'] = $title;
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/application/otherService');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function otherService_action(){
		$this->load->view('home/application/jqueryPost/otherService_action');
	}
	//****** other service end ******//
	
	// application filter section 
	public function filternagorikapplication()
	{
		$data = array();
		$data['title'] = "নাগরিক আবেদন যাচাই";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterApplication/filternagorikapplication');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	// for search function 
	public function showNagorickInformation(){
		$data=array();
		$data['all_data'] = $this->setup->getdata();   
		$this->load->view('home/filterApplication/showNagorickInformation',$data);
   }
   //==== for other service 
   public function filterOtherServiceApplication(){
	   $data=array();
	   $data['title'] = "অন্যান্য সেবাসমূহের আবেদন যাচাই";
	   $data['all_data']=$this->setup->getdata();
	   $this->load->view('home/header',$data);
	   $this->load->view('home/slide');
	   $this->load->view('home/filterApplication/filterOtherServiceApplication');
	   $this->load->view('home/right_content');
	   $this->load->view('home/footer');
   }
   // for search information
   public function showOtherServiceInformation(){
	   $data=array();
	   $data['all_data']=$this->setup->getdata();
	   $this->load->view('home/filterApplication/showOtherServiceInformation',$data);
   }
   // for tradelicence application...........
	public function filtertradeapplication()
	{
		$data = array();
		$data['title']= "ট্রেড লাইসেন্স আবেদন যাচাই";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterApplication/filtertradeapplication');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	
	//for search function 
	public function showTradelicenseInformation(){
		$data=array();
		$data['all_data'] = $this->setup->getdata();
		$this->load->view('home/filterApplication/showTradelicenseInformation',$data);
	}
	public function filteroarishapplication()
	{
		$data = array();
		$data['title']= 'ওয়ারিশ আবেদন যাচাই';
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterApplication/filteroarishapplication');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	
	// for search function 
	public function showOarishInformation()
	{
	   $data=array();
	   $data['all_data'] = $this->setup->getdata();   
	   $this->load->view('home/filterApplication/showOarishInformation',$data);
		
	}
	
	// filter certificate
	public function filternagorikcertificate(){
		$data = array();
		$data['title'] = "নাগরিক সনদপত্র যাচাই";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterCertificate/filternagorikcertificate');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function filterOtherServiceCertificate(){
		$data=array();
		$data['title']="অন্যান্য সেবাসমূহের সনদপত্র যাচাই";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterCertificate/filterOtherServiceCertificate');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	
	public function filtertradecertificate(){
		$data = array();
		$data['title']= "ট্রেড লাইসেন্স সনদপত্র যাচাই";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterCertificate/filtertradecertificate');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function filteroarishcertificate(){
		$data = array();
		$data['title']= 'ওয়ারিশ সনদপত্র যাচাই';
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterCertificate/filteroarishcertificate');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	// for mamla notice
	public function jacaiMamlaNotice(){
		$data = array();
		$data['title'] = "মামলার নোটিশ যাচাই";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterCertificate/jacaiMamlaNotice');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function verify_holding_tax(){
		$data = array();
		$data['title'] = "হোল্ডিং ট্যাক্স যাচাই করুন";
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/filterCertificate/verify_holding_tax');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	// for union parishad..........
	
	public function voterList(){
		$data=array(
			'title'			=>	'ভোটার তালিকা',
			'all_data'		=>	$this->setup->getdata(),
			'voterInfo'		=>	$this->manageAdmin->getAllInformation('tbl_voter_list')
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/voterList');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printVoterList()
	{
		$data = array(
			'title'			=>	'ভোটার তালিকা',
			'all_data'		=>	$this->setup->getdata(),
			'voterInfo'		=>	$this->manageAdmin->getAllInformation('tbl_voter_list')
		);
		$this->load->view('home/up/printVoterList',$data);
	}
	public function fighters(){
		$data=array(
			'title'				=>	'মুক্তিযোদ্ধাদের তালিকা',
			'all_data'			=>	$this->setup->getdata(),
			'fighters_record'	=>	$this->manageAdmin->fighterInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/fighters');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	// fighter search query
	public function fighter_detalies(){
		if(isset($_POST['mid'])){
			extract($_POST);
			$show=$this->setup->fighter_onerow($mid);
			//print_r($show);
			echo $show->national_id.'|'.$show->pic.'|'.$show->life_history;
		}
	}
	public function printFighterList()
	{
		$data = array(
			'title'			=>	'মুক্তিযোদ্ধাদের তালিকা',
			'all_data'		=>	$this->setup->getdata(),
			'voterInfo'		=>	$this->manageAdmin->fighterInformation()
		);
		$this->load->view('home/up/printFighterList',$data);
	}
	public function poorman(){
		$data=array(
			'title'				=>	'দুস্থদের তালিকা',
			'all_data'			=>	$this->setup->getdata(),
			'poormans_record'	=>	$this->manageAdmin->poormanInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/poorman');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printpoormanList()
	{
		$data=array(
			'title'				=>	'দুস্থদের তালিকা',
			'all_data'			=>	$this->setup->getdata(),
			'poormans_record'	=>	$this->manageAdmin->poormanInformation()
		);
		$this->load->view('home/up/printpoormanList',$data);
	}
	public function widow()
	{
		$data = array(
			'title'				=>	'বিধবাদের তালিকা',
			'all_data'			=>	$this->setup->getdata(),
			'widow_record'		=>	$this->manageAdmin->widowInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/widow');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printwidowList()
	{
		$data = array(
			'title'				=>	'বিধবাদের তালিকা',
			'all_data'			=>	$this->setup->getdata(),
			'widow_record'		=>	$this->manageAdmin->widowInformation()
		);
		$this->load->view('home/up/printwidowList',$data);
	}
	public function foreignMan()
	{
		$data = array(
			'title'				=>	'প্রবাসীদের তালিকা',
			'all_data'			=>	$this->setup->getdata(),
			'foreignMan_record'	=>	$this->manageAdmin->foreignManInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/foreignMan');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printforeignManList()
	{
		$data = array(
			'title'				=>	'প্রবাসীদের তালিকা',
			'all_data'			=>	$this->setup->getdata(),
			'foreignMan_record'	=>	$this->manageAdmin->foreignManInformation()
		);
		$this->load->view('home/up/printforeignManList',$data);
	}
	public function oldmanStipend(){
		$data=array(
			'title'					=>	'বয়স্ক ভাতা প্রাপ্তদের তালিকা',
			'all_data'				=>	$this->setup->getdata(),
			'oldmanStipend_record'	=>	$this->manageAdmin->oldmanstipendInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/oldmanStipend');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printoldmanStipendList()
	{
		$data=array(
			'title'					=>	'বয়স্ক ভাতা প্রাপ্তদের তালিকা',
			'all_data'				=>	$this->setup->getdata(),
			'oldmanStipend_record'	=>	$this->manageAdmin->oldmanstipendInformation()
		);
		$this->load->view('home/up/printoldmanStipendList',$data);
	}
	public function motherVata()
	{
		$data=array(
			'title'					=>	'মাতৃত্বকালীন ভাতা',
			'all_data'				=>	$this->setup->getdata(),
			'motherVata_record'	=>	$this->manageAdmin->motherVataInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/motherVata');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printmotherVataList()
	{
		$data=array(
			'title'					=>	'মাতৃত্বকালীন ভাতা',
			'all_data'				=>	$this->setup->getdata(),
			'motherVata_record'		=>	$this->manageAdmin->motherVataInformation()
		);
		$this->load->view('home/up/printmotherVataList',$data);
	}
	public function autistic()
	{
		$data=array(
			'title'					=>	'প্রতিবন্ধী ভাতা',
			'all_data'				=>	$this->setup->getdata(),
			'autistic_record'		=>	$this->manageAdmin->autisticInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/autistic');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printautisticList()
	{
		$data=array(
			'title'					=>	'প্রতিবন্ধী ভাতা',
			'all_data'				=>	$this->setup->getdata(),
			'autistic_record'		=>	$this->manageAdmin->autisticInformation()
		);
		$this->load->view('home/up/printautisticList',$data);
	}
	public function autisticStudent()
	{
		$data=array(
			'title'					=>	'প্রতিবন্ধী ছাত্র/ছাত্রী',
			'all_data'				=>	$this->setup->getdata(),
			'autisticStudent_record'		=>	$this->manageAdmin->autisticStudentInformation()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/up/autisticStudent');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	public function printautisticStudentList()
	{
		$data=array(
			'title'					=>	'প্রতিবন্ধী ছাত্র/ছাত্রী',
			'all_data'				=>	$this->setup->getdata(),
			'autisticStudent_record'		=>	$this->manageAdmin->autisticStudentInformation()
		);
		$this->load->view('home/up/printautisticStudentList',$data);
	}
	
/* home page load function end */


	/* picture upload function */

	public function profile_upload()
	{
		$this->load->view('admin/profile_upload');
	}
/*====application print copy page function start====*/
	
   public function ppreview()
   {
		$data=array();
		$data['all_data'] = $this->setup->getdata();   
		$this->load->view('home/print/ppreview',$data);
   }
   public function opreview()
   {
		$data=array();
		$data['all_data'] = $this->setup->getdata();   
		$this->load->view('home/print/opreview',$data);
   }
	public function tpreview()
	{
		$data=array();
		$data['all_data'] = $this->setup->getdata();
		$this->load->view('home/print/tpreview',$data);
	}

    public function wpreview()
   {
		$data=array();
		$data['all_data'] = $this->setup->getdata();   
		$this->load->view('home/print/wpreview',$data);
   }
/*====  application print copy page function end ======*/
   
   
/*====== profile view function start ==================*/
   public function profileview()
	{
		$data['all_data']=$this->setup->getdata();
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/profileview/profileview');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
/*======== profile view function start ===============*/
/*============ new section start ====================*/
public function all_news()
	{
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'all_news'	=>	$this->db->select("*")->from("tbl_news")->where("status","1")->order_by('id','desc')->get()->result()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/news/all_news');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
	
	public function bistarito()
	{
		extract($_GET);
		$data=array(
			'all_data'	=>	$this->setup->getdata(),
			'news'		=>	$this->db->select("*")->from("tbl_news")->where("md5(id)","$id")->get()->row()
		);
		$this->load->view('home/header',$data);
		$this->load->view('home/slide');
		$this->load->view('home/news/bistarito');
		$this->load->view('home/right_content');
		$this->load->view('home/footer');
	}
/*============ new section start ====================*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */