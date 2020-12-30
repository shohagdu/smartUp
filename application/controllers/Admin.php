<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
        $this->load->library('session');
		$this->load->model('Transition_model','transition');
		$this->load->model('Generate_model','mgenerate');
		$this->load->model('Manage_admin','manageAdmin');
		$this->load->model('dashboard');
		$this->load->model('Security_set', 'sq');
		$this->load->model('Role_chk', 'chk');

		 $logged_status=$this->session->userdata('logged_status');

		// echo $this->sq->check_exist_q();

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
	public function index()
	{
		$data=array(
			'bank_report'=>$this->dashboard->getdata('acinfo'),
			'sms_report'=>$this->dashboard->sms_query('inbox')
		);

		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/content');
		$this->load->view('admin/footer');
	}
	
	function viewQuery()
	{
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/query');
		$this->load->view('admin/footer');
	}
	// for mamla information 
	public function mamlaNotice(){
		$data = array(
			'mamlaInfo'	=> $this->manageAdmin->getAllMamla()
		);
		
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/mamlaPage/mamlaNotice');
		$this->load->view('admin/footer');
	}
	public function mamlaInformationSubmit(){
		$this->load->view('admin/mamlaPage/mamlaInformationSubmit');
	}
	public function subjectAndStatusInfo(){
		if(isset($_POST['id'])){
			extract($_POST);
			$show = $this->manageAdmin->getSubjectAndStatusInfo("mamla_tbl",$id);
			//print_r($show);
			echo $show->id.'|'.$show->subject.'|'.$show->status.'|'.$show->comments;
		}
	}
	public function updateMamlaStatus(){
		extract($_POST);
		$comments = trim($comments);
		$data = array(
			'subject'	=> $subject,
			'status'	=> $status,
			'comments'	=> $comments
		);
		$this->db->trans_start();
			$this->db->where('id',$hid);
			$this->db->update('mamla_tbl',$data);
		$this->db->trans_complete();
		
		if($this->db->trans_status() === TRUE){
			redirect("Admin/mamlaNotice","location");
		}
		else {
			echo "Oops!!! Something error";
		}
	}
	public function editMamla(){
		extract($_GET);
		$data = array(
			'mamlaInfo' => $this->manageAdmin->getMamlaInfo($id),
			'badiInfo'	=> $this->manageAdmin->badiInfo($id),
			'bibadiInfo'=> $this->manageAdmin->bibadiInfo($id)
		);
		
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/mamlaPage/editMamla');
		$this->load->view('admin/footer');
	}
	public function onebadiup(){
		extract($_GET);
		$data=array(
			'badi_name'			=>$badi_name,
			'badi_father_name'	=>$badi_father_name,
			'gram'				=>$badi_gram
		);
		$this->db->where('id',$id);
		$this->db->update('mamla_badi',$data);
		echo "Modified Successfully.";
	}
	public function badidelete(){
		extract($_GET);
		$this->db->where('id',$id);
		$this->db->delete('mamla_badi');
		echo "Deleted Successfully.";
	}
	public function onebibadiup(){
		extract($_GET);
		$data=array(
			'bibadi_name'		=>$bibadi_name,
			'bibadi_father_name'=>$bibadi_father_name,
			'gram'				=>$bibadi_gram
		);
		$this->db->where('id',$id);
		$this->db->update('mamla_bibadi',$data);
		echo "Modified Successfully.";
	}
	public function bibadidelete(){
		extract($_GET);
		$this->db->where('id',$id);
		$this->db->delete('mamla_bibadi');
		echo "Deleted Successfully.";
	}
	public function editAllmamlaInfo(){
		$this->load->view('admin/mamlaPage/editAllmamlaInfo');
	}
	public function mamlaNoticePrint(){
		extract($_GET);
		if(isset($_GET['id'])){$id = $this->input->get('id',TRUE);}
		else{
			$id = $this->session->userdata('sCode');
			$id=chop($id,'/');
			$id = sha1($id);
		}
		
		
		$data=array(
			'all_data'	=> $this->setup->getdata(),
			'mamlaInfo' => $this->manageAdmin->getMamlaInfo($id),
			'badiInfo'	=> $this->manageAdmin->badiInfo($id),
			'bibadiInfo'=> $this->manageAdmin->bibadiInfo($id)
		);
		
		$this->load->view('admin/mamlaPage/noticePrint/noticePrintPage',$data);
	}
	// for tax collection ...........
	public function taxCollection()
	{
		$data = [
			'member_info' => $this->setup->get_all_member_info(),
			'rate_sheet'  => $this->setup->get_current_active_rate_sheet()
		];
		// $data = [];
		// $page_view['main_content'] = $this->load->view('admin/taxPage/taxCollection', $data, true);
		// $this->load->view('admin/common/common_page', $page_view);
		
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/taxPage/taxCollection', $data);
		$this->load->view('admin/footer');
	}
	public function taxRegistrationPage(){
		$data = [
			'member_info' => $this->setup->get_all_member_info(),
			'rate_sheet'  => $this->setup->get_current_active_rate_sheet()
		];
		$this->load->view('admin/taxPage/taxRegistrationPage', $data);
	}
	public function taxCollectionPage(){
		$this->load->view('admin/taxPage/taxCollectionPage');
	}
	public function tradlicencePesajibiKorCollectionPage(){
		$this->load->view('admin/taxPage/tradlicencePesajibiKorCollectionPage');
	}
	public function tradlicenceHoldingTaxCollectionPage(){
		$this->load->view('admin/taxPage/tradlicenceHoldingTaxCollectionPage');
	}
	protected function _check_holding_tax_registration_form_required_field($receive){
		if(trim($receive['name']) == ''){
			return ['status' => 'error', 'message' => 'Name field is required'];
		}else if(trim($receive['fatherName']) == ''){
			return ['status' => 'error', 'message' => 'Father name field is required'];
		}else if(trim($receive['village']) == ''){
			return ['status' => 'error', 'message' => 'Village field is required'];
		}else if(trim($receive['wordNo']) == ''){
			return ['status' => 'error', 'message' => 'Word number field is required'];
		}else if(trim($receive['holdingNumber']) == ''){
			return ['status' => 'error', 'message' => 'Holding Number field is required'];
		}else if(trim($receive['dagNo']) == ''){
			return ['status' => 'error', 'message' => 'Dag Number field is required'];
		}else if(trim($receive['rateSheet']) == ''){
			return ['status' => 'error', 'message' => 'Bosot bitar Doron field is required'];
		}else{
			return ['status' => 'success', 'message' => 'Everything is ok' ];
		}
	}
	// New bosotbita tax collection ........
	public function newBosotbitaTaxCollection()
	{	$receive = $this->input->post();
		// check required value
		$check_required_field = $this->_check_holding_tax_registration_form_required_field($receive);
		if($check_required_field['status'] !== 'success'){
			echo json_encode($check_required_field);exit;
		}
		// check duplicate dagno
		$is_duplicate = $this->setup->is_insert_duplicate('holdingclientinfo', 'dag_no', $receive['dagNo']);
		if($is_duplicate){
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! Dag number Already exist']); exit;
		}
		// check duplicate nationalId
		// $is_duplicate = $this->setup->is_insert_duplicate('holdingclientinfo', 'national_id', $receive['nationalId']);
		// if($is_duplicate){
			// echo json_encode(['status' => 'error', 'message' => 'Oops!!! national Id Already exist']); exit;
		// }
		
		// check duplicate birthCertificateId	
		// $is_duplicate = $this->setup->is_insert_duplicate('holdingclientinfo', 'birth_certificate_id', $receive['birthCertificateId']);
		// if($is_duplicate){
			// echo json_encode(['status' => 'error', 'message' => 'Oops!!! birthCertificate Id Already exist']); exit;
		// }
		$response = $this->manageAdmin->tax_registration_operation($receive);
		echo json_encode($response);exit;
	}
	// old bosodbit tax collection .........
	public function oldBosotbitaTaxCollection()
	{
		$this->load->view('admin/taxPage/jqueryPost/oldBosotbitaTaxCollection');
	}
	// bosodbita history page..............
	public function historyBosod()
	{
		 $this->load->view('admin/taxPage/history/historyBosod');
	}
	// boshod bita search query............
	public function search_dag_no()
	{
		$receive = (array)$this->input->post();
		$dag_no = (string) trim($receive['dagNo']);
		//$dag_no = (string) $_GET['dagNo'];
		$response = $this->manageAdmin->get_dag_no_wise_tax_person($dag_no);
		if($response['status'] !== 'success'){
			echo json_encode($response);exit;
		}else{
			
			$all_info = [
				'info'	  => $response,
				'history' => $this->manageAdmin->get_dag_no_wise_bosotbita_history($dag_no)
			];
			$feedback =[
				'status'	=> $response['status'],
				'message'   => $response['message'],
				'data'		=> $this->load->view('admin/taxPage/history/bosodBitaHistoryInformation.php', $all_info, true)
			];
			echo json_encode($feedback);exit;
		}
	}
	public function searchHolding()
	{
		$receive = (array)$this->input->post();
		$holding_no = (string) trim($receive['holdingNo']);
		//$dag_no = (string) $_GET['dagNo'];
		$response = $this->manageAdmin->get_holding_no_wise_tax_person($holding_no);
		if($response['status'] !== 'success'){
			echo json_encode($response);exit;
		}else{
			
			$all_info = [
				'info'	  => $response,
				'history' => $this->manageAdmin->get_dag_no_wise_bosotbita_history($response['data']->dag_no)
			];
			$feedback =[
				'status'	=> $response['status'],
				'message'   => $response['message'],
				'data'		=> $this->load->view('admin/taxPage/history/bosodBitaHistoryInformation.php', $all_info, true)
			];
			echo json_encode($feedback);exit;
		}
	}
	public function payment_holding_tax(){
		$receive = (array) $this->input->get();
		if($receive['id'] == '' || $this->manageAdmin->exists_holding_person($receive['id'])){
			redirect('Admin/taxCollection', 'location');
		}else{
			$info = $this->manageAdmin->get_holding_tax_member_info($receive['id'])['data'];
			$data = [
				'tax_member_info'     => $info,
				'fiscal_year'	      => $this->setup->get_person_wise_fiscal_year($info->dag_no),
				'rate_sheet'          => $this->setup->get_current_active_rate_sheet()
			];
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/taxPage/payment_holding_tax', $data);
			$this->load->view('admin/footer');
		}
	}
	
	protected function holding_tax_payment_required_field($receive){
		
		if((int)count(array_filter(array_map('trim', $receive['fiscalYear']))) !== (int)count($receive['fiscalYear'])) {
			return ['status' => 'error', 'message' => 'Fiscal Year field is required'];
		}else if((int)count(array_filter(array_map('trim', $receive['holdingType']))) !== (int)count($receive['holdingType'])){
			return ['status' => 'error', 'message' => 'Holding Type field is required'];
		}else if((int)count(array_filter(array_map('trim', $receive['holdingAmount']))) !== (int)count($receive['holdingAmount'])){
			return ['status' => 'error', 'message' => 'Amount field is required'];
		}else if(trim($receive['paymentDate']) == ''){
			return ['status' => 'error', 'message' => 'Payment Date field is required'];
		}else if(trim($receive['bookNumber']) == ''){
			return ['status' => 'error', 'message' => 'Book Number field is required'];
		}else if(trim($receive['moneyNumber']) == ''){
			return ['status' => 'error', 'message' => 'Payment Date field is required'];
		}else if(trim($receive['discount']) == ''){
			return ['status' => 'error', 'message' => 'Discount field is required'];
		}else {
			return ['status' => 'success', 'message' => 'Everything is ok'];
		}
	}
	public function check_duplicate_fiscal_year($array){
		if(count(array_unique($array))<count($array)){
			return ['status' => 'warning', 'message' => 'Oops !!! Duplicate fiscal year found'];
		} else{
			return ['status' => 'success', 'message' => 'everything is ok'];
		}
	}
	public function payment_action_holding_tax(){
		$receive = $this->input->post();
		$check_required_field = $this->holding_tax_payment_required_field($receive);
		if($check_required_field['status'] !== 'success'){
			echo json_encode($check_required_field);exit;
		}
		$has_duplicate_year = $this->check_duplicate_fiscal_year($receive['fiscalYear']);
		if($has_duplicate_year['status'] !== 'success'){
			echo json_encode($has_duplicate_year);exit;
		}
		$has_duplicate_book_money = $this->manageAdmin->has_duplicate_book_money($receive['bookNumber'], $receive['moneyNumber']);
		if($has_duplicate_book_money['status'] !== 'success'){
			echo json_encode($has_duplicate_book_money);exit;
		}
		
		$this->load->view('admin/taxPage/jqueryPost/bosotbita_payment_action', ['request' => $receive]);
	}
	public function testt(){
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('test');
		$this->load->view('admin/footer');
	}
	
	/*=================== peshazibi kor start ====================*/
	
	// for peshazibikor tax collection action ........
	public function peshaZibikorTaxCollection()
	{
		$this->load->view('admin/taxPage/jqueryPost/peshaZibikorTaxCollection');
	}
	// for history peshazibi kor ............
	public function historyPesha()
	{
		$this->load->view('admin/taxPage/history/historyPesha');
	}
	// for tradelicense peshazibikor information search 
	public function searchTrade(){
		  $tradLicenceId=$_GET['tradLicenceId'];
		
		 $qu=$this->db->query("select * from  tradelicense where  sno='$tradLicenceId'");
		 $num_rows=$qu->num_rows();
		 if($num_rows<=0){
			 echo "1";exit;
		}
		else{
			 $row=$qu->row();
				$bcomname=$row->bcomname;
				$ownertype=$row->ownertype;
				$village=explode(',',$row->bb_gram);
				$gram="";
				foreach ($village as $var):
				$gram.=$var.' ';
				endforeach;
				$wordno=$row->bb_wordno;
				$mobileno=$row->mobile;	
				
				if($ownertype=='1'){
					$oType='ব্যাক্তি মালিকানা';
				}else if($ownertype=='2'){
					$oType='যেীথমালিকানা';
				}else if($ownertype=='3'){
					$oType='কোম্পানী';
				}
		 
			echo $bcomname.",".$oType.",".$gram.",".$wordno.",".$mobileno;
		}
	}
	/*================= peshazibi kor end================= */
	
	/*================= bosodbita kor start ================*/
	
	// for bosodbita tax collection action ...........
	public function boshodbitakorTaxCollection()
	{
      $this->load->view('admin/taxPage/jqueryPost/boshodbitakorTaxCollection');
	}
	// for history tradelicense bosodbita kor..........
	public function historyTradepesha()
	{
		$this->load->view('admin/taxPage/history/historyTradepesha');
	}
	// for tradelicense bosodbita information search ...............
	public function searchTradebosodbita(){
		$tradLicenceId=$_GET['tradLicenceIdNew'];
		
		$qu=$this->db->query("select bcomname, ownertype, btype, bb_gram, bb_wordno,mobile from  tradelicense where  sno='$tradLicenceId'");
		$num_rows=$qu->num_rows();
		if($num_rows<=0){
			 echo "1";exit;
		}
		else{
			$row=$qu->row();
			$bcomname=$row->bcomname;
			$ownertype=$row->ownertype;
			$village=explode(',',$row->bb_gram);
			$gram="";
			foreach ($village as $var):
				$gram.=$var.' ';
			endforeach;
			$wordno=$row->bb_wordno;
			$mobileno=$row->mobile;
				
			if($ownertype=='1'){
				$oType='ব্যাক্তি মালিকানা';
			}else if($ownertype=='2'){
				$oType='যেীথমালিকানা';
			}else if($ownertype=='3'){
				$oType='কোম্পানী';
			}
			echo $bcomname.",".$oType.",".$gram.",".$wordno.",".$mobileno;
		}
	}
	/*============ bosodbita kor end=======================*/
	
	/*============ daily submit section start =============*/
	public function dailySubmit()
	{
		$data=array(
			'trans'		=> $this->transition->get_transaction(),
			'voucher'	=> $this->transition->get_credit_voucher()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/dailySubmit/dailySubmit');
		$this->load->view('admin/footer');
	}
	
	// for jquery post method......
	public function dailySubmit_action()
	{
		$this->load->view('admin/dailySubmit/jqueryPost/dailySubmit_action');
	}
	
	// for main cagegory search......
	public function daily_ctg()
	{
		$this->load->view('admin/dailySubmit/search/daily_ctg');
	}
	// for sub cagegory search .........
	public function sCategory()
	{
		$this->load->view('admin/dailySubmit/search/subctgs');
	}
	// for account type.......
	public function daily_sContent()
	{
		$this->load->view('admin/dailySubmit/search/daily_account');
	}
	public function daily_pType()
	{
		$this->load->view('admin/dailySubmit/search/daily_slip');
	}
	/*============ daily submit section end  =============*/
	
	/*============ daynamic slide section start =========*/
	public function dynamicSlide()
	{
		$data=array();
		$data['all_slide']=$this->db->select("*")->from("slide_setting")->order_by("id","desc")->get()->result();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/slide/dynamicSlide',$data);
		$this->load->view('admin/footer');
	}
	
	public function slideEdit()
	{
		$data=array();
		extract($_POST);
		$data['slide_info']=$this->db->select("*")->from("slide_setting")->where("id",$submit)->get()->row();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/slide/slideEdit',$data);
		$this->load->view('admin/footer');
	}
	
	public function slide_edit_submit()
	{	
		extract($_POST);
		if(empty($_FILES['image']['name']))
		{
			$data = array(
			"title"	=> $title,
			"description" => $description,
			"sequence" => $sequence,
			"status" => $status
			);
		}
		else 
		{
			$des="all/slide/".$hid_img;
			unlink($des);
			$name = $_FILES['image']['name'];
			$tmp_name = $_FILES['image']['tmp_name'];
			$path = "all/slide/";
			$m = move_uploaded_file($tmp_name, $path.$name);
			
			$data = array(
			"image_name" => $name,
			"title"	=> $title,
			"description" => $description,
			"sequence" => $sequence,
			"status" => $status
			);
		}
		
		$this->db->where("id",$uid);
		$up=$this->db->update("slide_setting",$data);
		
		if($up)
		{
			echo 1;
		}
		else 
		{
			echo 0;
		}
	}
	
	public function slide_upload()
	{
		if( isset($_POST['upload']) ):
			extract($_POST);

			$name = $_FILES['image']['name'];
			$tmp_name = $_FILES['image']['tmp_name'];

			// data array
    	$data = array(
    			"id" => '',
    			"image_name" => $name,
    			"title"	=> $title,
    			"description" => $description,
    			"sequence" => $sequence
    		);

    	$this->db->insert("slide_setting",$data);

		$path = "all/slide/";
    	$m = move_uploaded_file($tmp_name, $path.$name);

			if( $this->db->affected_rows() ):
				echo "<script>window.history.back();alert('Upload Successfully');</script>";
			else:
				redirect("Admin/dynamicSlide");
			endif;

		endif;
	}
	/*============ daynamic slide section start =========*/
	
	/*============= logo section start ==================*/
	public function logoManage()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/logoPage');
		$this->load->view('admin/footer');
	}
	public function logo_submit_action()
	{
		if(isset($_POST['logo_setup'])){
			
			$pic = 'logo.png';
			$tmp_name = $_FILES['picture']['tmp_name'];

			if(($_FILES['picture']['size']/1024)<=500){
				
				move_uploaded_file($tmp_name,"logo_images/".$pic);
				//copy("logo_images/logo.png","all/logo/logo.png");
				
				$err = array( "error" => 2 );
				$this->session->set_userdata($err);
			}
			else{
				$err = array( "error" => 1 );
				$this->session->set_userdata($err);
			}
		
			redirect("admin/logoManage","location");
		}
	}
	/*============== logo section end ===================*/
	
	/*============== websit tool section start ==========*/
		public function toolSetting()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/toolSetting');
		$this->load->view('admin/footer');
	}
	public function websiteTools_submit()
	{
		extract($_POST);
		//print_r($input_checked);
		//echo $hid_text;
		$explode=explode(",",$hid_text);
		foreach($explode as $value)
		{
			if(!(in_array($value,$input_checked)))
			{
				$up=$this->db->query("update tbl_webtools set status='0' where id='$value'");
			}
			else
			{
				$up=$this->db->query("update tbl_webtools set status='1' where id='$value'");
			}	
		}
		echo 1;
		
	}
	/*============== websit tool section end ==========*/
	/*=============== news and google map seeting start =====*/
	public function newsManage()
	{
		$data=array();
		$data['all_khobor']=$this->db->select("*")->from("tbl_news")->get()->result();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/news/newsManage',$data);
		$this->load->view('admin/footer');
	}
	
	public function khobor_setting_submit()
	{
		extract($_POST);
		$data = array(
			"id" => '',
			"title"	=> $title,
			"descrip" => $msg,
			"entry_user" =>$this->session->userdata('username')
		);

    	$insert=$this->db->insert("tbl_news",$data);
		if($insert)
		{
			redirect("Admin/newsManage","location");
		}
		else
		{
			redirect("Admin/newsManage","location");
		}	
	}
	
	//news_edit
	public function newsEdit()
	{
		$data=array();
		extract($_POST);
		$data['khobor']=$this->db->select("*")->from("tbl_news")->where("id",$uid)->get()->row();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/news/newsEdit',$data);
		$this->load->view('admin/footer');
	}
	
	public function khobor_setting_update()
	{
		extract($_POST);
		$data = array(
			"title"	=> $title,
			"descrip" => $msg,
			"status"=> $status
		);
		$this->db->where("id",$id);
		$up=$this->db->update("tbl_news",$data);
		if($up)
		{
			redirect("Admin/newsManage?id=1","location");
		}
		else
		{
			echo "<script>window.history.back();alert('Update Fail');</script>";
		}	
	}
	
	public function upMap()
	{
		$data=array();
		$data['map']=$this->db->select("*")->from("up_map")->limit("1")->get()->row();
		$data['row']=$this->db->affected_rows();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/map/upMap',$data);
		$this->load->view('admin/footer');
	}
	
	public function up_map_submit()
	{
		$info=$this->db->select("*")->from("up_map")->limit("1")->get()->row();
		$row=$this->db->affected_rows();
		extract($_POST);
		$data=array('map_link'=>$link);
		if($row<1)
		{
			$insert=$this->db->insert("up_map",$data);
			if($insert)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			
			$up=$this->db->update("up_map",$data);
			if($up)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
	}
	
	/*=============== news and google map seeting end =====*/
	/*============ daily expense section start ========== update by shohag 19.03.2016===*/

	public function dailyExp()
	{
		$data=array(
			'trans'		=> $this->transition->get_transaction(),
			'voucher'	=> $this->transition->get_debit_voucher()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/dailyExpense/dailyExp');
		$this->load->view('admin/footer');
	}
	/*============ daily expense section end =============*/

	public function daily_exp_ctg()
	{
		$this->load->view('admin/dailySubmit/search/daily_exp_ctg');
	}
	
	public function expense_sub_ctg()
	{
		$this->load->view('admin/dailySubmit/search/expense_sub_ctg');

	}


	public function dailyExpense_action()
	{
		$this->load->view('admin/dailySubmit/jqueryPost/dailyExpense_action');
	}
	
	
	//update by shohag 08.05.2016
	// for balance check start ................
	public function checkBalance(){
		extract($_GET);
		// echo $acc_no;
		// echo  $amount;
	 
		$query=$this->db->query("SELECT * from acinfo where acname='$acc_no' LIMIT 1");
		$rows=$query->row();
		$bal=$rows->balance;
		if($acc_no=='-1'){
			echo "empyAcc";
		}else{
			if($amount=='' && $acc_no!='-1'){
				echo "accEmpty";
			}else{
				if($amount>$bal && $acc_no!='-1'){
					echo $bal;
				}
				if($amount<$bal  && $acc_no!='-1'){
					echo "ValidBalance";
				}
			}
		}
	}
	// for balance check end.............
}
