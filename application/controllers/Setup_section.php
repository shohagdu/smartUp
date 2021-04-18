
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_section extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('Setup_model', 'setup');
		$this->load->model('numbertobangla', 'bnc');
		$this->load->model('Transfer_model','transfer');
		$this->load->model('money_receipt_model','money_receipt');
		$this->load->model('Role_chk', 'chk');
		$this->load->dbutil();
		
		$logged_status=$this->session->userdata('logged_status');
		if($logged_status==FALSE){
			redirect('mms24','location');
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
	public function rateSheet(){
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/rateSheet');
		$this->load->view('admin/footer');
	}
	public function rateSheet_action(){
		extract($_POST);
		//print_r($_POST);exit;
		if(trim($licenseType)=="" || trim($amount)==""){
			echo "55";exit;
		}
		$qy = $this->db->query("SELECT * FROM rate_sheet rs where rs.licence_type='$licenseType'");
		$num_rows=$qy->num_rows();
		if($num_rows>=1){
			echo "Opps!! এই ধরনটি যোগ করা হয়েছে ";exit;
		}
		
		$ins_date = date("Y-m-d");
		$ins_user= $this->session->userdata('username');
		
		$dataRateSheet=array(
			'licence_type'	=> $licenseType,
			'amount'		=> $amount,
			'ins_user'		=> $ins_user,
			'status'		=> 1
		);
		$dataRateSheetHistory=array(
			'old_amount'	=> $amount,
			'new_amount'	=> $amount,
			'ins_date'		=> $ins_date,
			'up_user'		=> $ins_user,
			'status'		=> 1
		);
		$this->db->trans_start();
			$this->db->insert("rate_sheet",$dataRateSheet);
			$rid=$this->db->insert_id();
			$dataRateSheetHistory['rid']=$rid;
			$this->db->insert("rate_sheet_history",$dataRateSheetHistory);
		$this->db->trans_complete();
		if($this->db->trans_complete() === TRUE){
			echo "1";exit;
		}
		else{
			echo "2";exit;
		}
	}
	
	public function editRateSheetInfo(){
		if($_POST){
			extract($_POST);
			$rid;
			$qy=$this->db->select("*")
					->from("rate_sheet")
					->where('rid',$rid)
					->get()
					->row();
		}
	}
	public function checkLicense(){
		if(isset($_GET['licenseType'])){
			$licenseType=$_GET['licenseType'];
			$qy=$this->db->query("SELECT * FROM rate_sheet rs where rs.licence_type='$licenseType'");
			//echo $this->db->last_query();exit;
			$num_rows=$qy->num_rows();
			
			if($num_rows>=1){
				echo "10";exit;
			}
		}
	}
	public function checkHoldingType(){
		if(isset($_GET['holdingLicenseType'])){
			$holdingLicenseType = $_GET['holdingLicenseType'];
			$qy= $this->db->query("SELECT * FROM holding_rate_sheet hrs where hrs.holding_type='$holdingLicenseType'");
			$num_rows=$qy->num_rows();
			
			if($num_rows>=1){
				echo "10";exit;
			}
		}
	}
	public function occupation(){
		$data = [
			'occupation_list' => $this->setup->get_occupation_list()
		];
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/occupation', $data);
		$this->load->view('admin/footer');
	}
	public function occupation_action(){
		$receive = $this->input->post();
		
		if(trim($receive['occupationName']) == ''){
			echo json_encode(['status' => 'error', 'message' => 'দয়া করে পেশার নাম লিখুন']);exit;
		}
		// check duplicate 
		$is_duplicate = $this->setup->is_insert_duplicate('snf_global_form', 'title	', $receive['occupationName']);
		if($is_duplicate){
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! Already exist']); exit;
		}
		
		$response = $this->setup->occupation_operation($receive);
		echo json_encode($response);exit;
	}
	public function update_occupation_info(){
		$receive = $this->input->post();
		if(!isset($receive['fieldData']) && empty($receive['fieldData'])){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);
		}else{
			$id = (string) $receive['fieldData'];
			$response = $this->setup->single_occupation_info($id);
			echo json_encode($response);
		}
	}
	public function update_occupation_action(){
		$receive = (array)$this->input->post();
		if(trim($receive['hid']) ==''){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);exit;
		}
		$response = $this->setup->occupation_update_operation($receive);
		echo json_encode($response);exit;
	}
	public function classification(){
		$data = [
			'classification_list' => $this->setup->get_classification_list()
		];
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/classification', $data);
		$this->load->view('admin/footer');
	}
	public function classicification_action(){
		$receive = $this->input->post();
		
		if(trim($receive['classicificationName']) == ''){
			echo json_encode(['status' => 'error', 'message' => 'দয়া করে শ্রেণী লিখুন']);exit;
		}
		// check duplicate 
		$is_duplicate = $this->setup->is_insert_duplicate('snf_global_form', 'title	', $receive['classicificationName']);
		if($is_duplicate){
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! Already exist']); exit;
		}
		
		$response = $this->setup->classicification_operation($receive);
		echo json_encode($response);exit;
	}
	public function update_classification_info(){
		$receive = $this->input->post();
		if(!isset($receive['fieldData']) && empty($receive['fieldData'])){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);
		}else{
			$id = (string) $receive['fieldData'];
			$response = $this->setup->single_classification_info($id);
			echo json_encode($response);
		}
	}
	public function update_classification_action(){
		$receive = (array)$this->input->post();
		if(trim($receive['hid']) ==''){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);exit;
		}
		$response = $this->setup->classification_update_operation($receive);
		echo json_encode($response);exit;
	}
	// holding rate sheet level
	public function holdingRateSheetLevel(){
		$data = [
			'holding_rate_sheet_lebel' => $this->setup->get_holding_rate_sheet_level()
		];
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/holdingRateSheetLevel', $data);
		$this->load->view('admin/footer');
	}
	public function holdingRateSheetLabel_action(){
		$receive = $this->input->post();
		
		if(trim($receive['holdingRateSheetLabel']) == ''){
			echo json_encode(['status' => 'error', 'message' => 'দয়া করে বসতভিটার ধরন প্রদান করুন']);exit;
		}
		// check duplicate 
		$is_duplicate = $this->setup->is_insert_duplicate('holding_rate_sheet_label', 'rate_sheet_label	', $receive['holdingRateSheetLabel']);
		if($is_duplicate){
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! Already exist']); exit;
		}
		$response = $this->setup->holding_rate_sheet_label_add($receive);
		echo json_encode($response);exit;
	}
	public function update_holding_rate_sheet_label_info(){
		$receive = $this->input->post();
		if(!isset($receive['fieldData']) && empty($receive['fieldData'])){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);
		}else{
			$id = (string) $receive['fieldData'];
			$response = $this->setup->single_holding_rate_sheet_label($id);
			echo json_encode($response);
		}
	}
	public function update_holding_rate_sheet_label_action(){
		$receive = (array)$this->input->post();
		
		if(trim($receive['hid']) ==''){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);exit;
		}
		$response = $this->setup->holding_rate_sheet_label_update($receive);
		echo json_encode($response);exit;
	}
	public function holdingRateSheet(){
		$data = [
			'form_information'   => $this->setup->get_holding_rate_sheet_form_information(),
			'holding_rate_sheet' => $this->setup->get_holding_rate_sheet()
		];
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/holdingRateSheet', $data);
		$this->load->view('admin/footer');
	}
	protected function _check_holding_rate_sheet_required_field($receive){
		if(trim($receive['holdingRateSheetLabel']) == ''){
			return ['status' => 'error', 'message' => 'দয়া করে বসতভিটার ধরন প্রদান করুন'];
		}else if(trim($receive['occupation']) == ''){
			return ['status' => 'error', 'message' => 'দয়া করে পেশা প্রদান করুন'];
		}else if(trim($receive['classification']) == ''){
			return ['status' => 'error', 'message' => 'দয়া করে করের শ্রেনী প্রদান করুন'];
		}else if(trim($receive['amount']) == ''){
			return ['status' => 'error', 'message' => 'দয়া করে ধার্যকৃত টাকার পরিমাণ প্রদান করুন'];
		}else if( ! is_numeric($receive['amount'])){
			return ['status' => 'error', 'message' => 'দয়া করে ধার্যকৃত টাকার পরিমাণ ইংরেজীতে প্রদান করুন'];
		}
		else{
			return ['status' => 'success', 'message' => 'Everything is ok' ];
		}
	}
	public function holdingRateSheet_action(){
		$receive = $this->input->post();
		// check required value
		$check_required_field = $this->_check_holding_rate_sheet_required_field($receive);
		if($check_required_field['status'] !== 'success'){
			echo json_encode($check_required_field);exit;
		}
		// check duplicate 
		$is_duplicate = $this->setup->holding_rate_sheet_duplicate($receive);
		if($is_duplicate){
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! এই বসতভিটার ধরন, পেশা, করের শ্রেনী যোগ করা আছে।']); exit;
		}
		
		$response = $this->setup->holding_rate_sheet_operation($receive);
		echo json_encode($response);exit;
	}
	public function update_holding_rate_sheet_info(){
		$receive = $this->input->post();
		if(!isset($receive['fieldData']) && empty($receive['fieldData'])){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);
		}else{
			$id = (string) $receive['fieldData'];
			$response = $this->setup->single_holding_rate_sheet($id);
			echo json_encode($response);
		}
	}
	// payment page, holding type change amount get
	public function get_rate_sheet_amount(){
		$receive = $this->input->post();
		if(!isset($receive['id']) && empty($receive['id'])){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data' => null]);exit;
		}else{
			echo json_encode($this->setup->get_rate_sheet_amount_by_id($receive['id']));exit;
		}
	}
	public function update_holding_rate_sheet_action(){
		$receive = (array)$this->input->post();
		
		if(trim($receive['hid']) ==''){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);exit;
		}
		if(trim($receive['amount']) ==''){
			echo json_encode(['status' => 'error', 'message' => 'Amount field is required', 'data'=> null]);exit;
		}
		$response = $this->setup->holding_rate_sheet_update_operation($receive);
		echo json_encode($response);exit;
	}
	public function memberAddForm(){
		$data = [
			'member_info' => $this->setup->get_all_member_info()
		];
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/memberAddForm', $data);
		$this->load->view('admin/footer');
	}
	public function info_word_member_table_server(){

		//echo json_encode(['status'=>"succees",'message'=>"hello",'data'=>[]]);
		//$this->load->model("Crud_model");
		
		$fetch_data = $this->db->query("select id,word_no,member_name,member_father from word_member")->result();
		echo json_encode(['status'=>"succees",'message'=>"hello",'draw' => 1, 'recordsTotal' => 7, 'recordsFiltered' => 7, 'data'=>$fetch_data]);
		exit;
		//print_r($fetch_data);exit;
		$data = array();
		foreach($fetch_data as $row){
			$sub_array = array();
			$sub_array[] = $row->id;
			$sub_array[] = $row->word_no;
			$sub_array[] = $row->member_name;
			$sub_array[] = $row->member_father;
			
			$data[]=$sub_array;
		}
		
		$output = array(
			"draw"				=> intval($_POST["draw"]),
			"recordsTotal"		=> 7,
			"recordsFiltered"	=> 7,
			'data'				=> $data
		);
		echo json_encode($output);
	}
	public function checkWordNo(){
		if(isset($_GET['word_no'])){
			$word_no = $_GET['word_no'];
			$qy= $this->db->query("SELECT * FROM word_member wm where wm.word_no='$word_no'");
			$num_rows=$qy->num_rows();
			
			if($num_rows>=1){
				echo "10";exit;
			}
		}
	}
	protected function _check_word_member_required_field($receive){
		if(trim($receive['wordNo']) == ''){
			return ['status' => 'error', 'message' => 'Word number field is required'];
		}else if(trim($receive['memberName']) == ''){
			return ['status' => 'error', 'message' => 'Member name field is required'];
		}else if(trim($receive['memberFather']) == ''){
			return ['status' => 'error', 'message' => 'Member Father name field is required'];
		}else{
			return ['status' => 'success', 'message' => 'Everything is ok' ];
		}
	}
	public function word_member_action(){
		$receive = $this->input->post();
		// check required value
		$check_required_field = $this->_check_word_member_required_field($receive);
		if($check_required_field['status'] !== 'success'){
			echo json_encode($check_required_field);exit;
		}
		// check duplicate 
		$is_duplicate = $this->setup->is_insert_duplicate('word_member', 'word_no', ['word_no' => $receive['wordNo'], 'is_delete' => 0]);
		if($is_duplicate){
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! Already exist']); exit;
		}
		$param = [
			'word_no'	   => (int) trim($receive['wordNo']),
			'member_name'  => (string) trim($receive['memberName']),
			'member_father'=> (string) trim($receive['memberFather']),
			'created_by'   => (int) $this->session->userdata('id'),
			'created_ip'   => (string) $this->input->ip_address(),
			'created_date' => date('Y-m-d H:i:s')
		];
		$this->db->trans_start();
		$this->db->insert("word_member",$param);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo json_encode(['status' => 'error', 'message' => 'Insert failed']);exit;
		}
		else{
			$this->db->trans_commit();
			echo json_encode(['status' => 'success', 'message' => 'Member information add successfully']);exit;
		}
	}
	// update member info 
	public function update_member_info(){
		$receive = $this->input->post();
		if(!isset($receive['fieldData']) && empty($receive['fieldData'])){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);
		}else{
			$id = (string) $receive['fieldData'];
			$single_member_info = $this->setup->get_single_member_info($id);
			echo json_encode($single_member_info);
		}
	}
	public function update_member_info_action(){
		$receive = (array)$this->input->post();
		if(trim($receive['hid']) ==''){
			echo json_encode(['status' => 'error', 'message' => 'required information not found', 'data'=> null]);exit;
		}
		// check required value
		$check_required_field = $this->_check_word_member_required_field($receive);
		if($check_required_field['status'] !== 'success'){
			echo json_encode($check_required_field);exit;
		}
		// check duplicate 
		$is_duplicate = $this->setup->is_update_duplicate('word_member', 'word_no', ['word_no' => $receive['wordNo'], 'md5(id) !=' => $receive['hid'], 'is_delete' => 0]);
		if($is_duplicate){
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! Already exist']); exit;
		}
		
		$param = [
			'word_no'	   => (int) trim($receive['wordNo']),
			'member_name'  => (string) trim($receive['memberName']),
			'member_father'=> (string) trim($receive['memberFather']),
			'is_active'    => (int) $receive['status'],
			'updated_by'   => (int) $this->session->userdata('id'),
			'updated_ip'   => (string) $this->input->ip_address(),
			'updated_date' => date('Y-m-d H:i:s')
		];
		
		$this->db->trans_begin();
		$this->db->where('md5(id)', $receive['hid']);
		$this->db->update("word_member",$param);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo json_encode(['status' => 'error', 'message' => 'update failed']);exit;
		}
		else
		{
			$this->db->trans_commit();
			echo json_encode(['status' => 'success', 'message' => 'Member information add successfully']);exit;
		}
	}
	// delete member info row 
	public function deleteMemberInfoRow(){
		$id = $this->input->post('id');
		if($id == ''){
			echo json_encode(['status' => 'error', 'message' => 'Something wrong']);exit;
		}
		$single_member_info = $this->setup->get_single_member_info($id);
		if($single_member_info['status'] !== 'success'){
			echo json_encode($single_member_info);exit;
		}
	
		$param = [
			'is_delete'    => 1,
			'updated_by'   => (int) $this->session->userdata('id'),
			'updated_ip'   => (string) $this->input->ip_address(),
			'updated_date' => date('Y-m-d H:i:s')
		];
		$this->db->where('md5(id)', $id);
		$this->db->update("word_member",$param);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo json_encode(['status' => 'error', 'message' => $this->db->_error_message()]);exit;
		}
		else
		{
			$this->db->trans_commit();
			echo json_encode(['status' => 'success', 'message' => 'Delete successfully']);exit;
		}
	}
	public function mainCtgEntry(){
		if($_POST){
		  $title=$this->input->post('mctg',true);
		  $fid=$this->input->post('fid',true);
		  if($title=="" || $fid=="-1"){ exit;}
		  $data->category=$this->input->post('mctg',true);
		  $data->fund_id=$this->input->post('fid',true);
		  $in=$this->db->insert("mainctg",$data);
		  if($in) echo '1'; else '0';
		}
		else{
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/setup_section/mainCtgEntry');
			$this->load->view('admin/footer');
		}
	}
	public function assessmentForm(){
		$data = [
			'list_of_holding_tax' => $this->setup->get_all_bosotbita_kor_person()
		];
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/assessmentForm', $data);
		$this->load->view('admin/footer');
	}
	public function getAmount(){
		extract($_POST);
		$amount = $this->db->query("SELECT * FROM holding_rate_sheet WHERE hrid='$hrid'")->row();
		echo $amount->amount;
	}
	public function assesment_action(){
		extract($_POST);
		//print_r($_POST);
		if($holding=="0" || $amount==""){
			echo "দয়া করে বাড়ির ধরন সিলেক্ট করুন";exit;
		}
		$info = $this->db->query("select * from holdingclientinfo where id=$rowid")->row();
		$holding_rate = $this->db->query("select * from holding_rate_sheet where hrid=$holding")->row();
		$ins_user = $this->session->userdata('username');
		$ins_date = date("Y-m-d");
		
		if(isset($assid) && $assid != '')
		{
			$upArray= array(
				'htype_rate_id'	=> $holding,
				'ins_user'		=> $ins_user
			);
			$this->db->trans_start();
				$this->db->where("assid",$assid);
				$this->db->update("tbl_assesment",$upArray);
			$this->db->trans_complete();
			if($this->db->trans_complete()===TRUE){
				echo "2";exit;
			}
			else{
				echo "10";exit;
			}
		}else{
			$assArray = array(
				'hinfoid'		=> $rowid,
				'htype_rate_id'	=> $holding,
				'ins_date'		=> $ins_date,
				'ins_user'		=> $ins_user,
				'status'		=> 1
			);
			$this->db->trans_start();
				$this->db->insert("tbl_assesment",$assArray);
			$this->db->trans_complete();
			if($this->db->trans_complete()===TRUE){
				echo "1";exit;
			}
			else{
				echo "10";exit;
			}
		}
		
	}
	public function SubCtgEntry(){
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/SubCtgEntry');
		$this->load->view('admin/footer');
	}
	
	
	public function SubCtgEntryAction(){
		if($_POST){
			$title=$this->input->post('mcid',true);
			$query=$this->db->query("select fund_id from mainctg where id='$title' limit 1");
			$row=$query->row();

			$stitle=$this->input->post('sctg',true);
			$data->mc_id=$this->input->post('mcid',true);
			$data->sub_title=$this->input->post('sctg',true);
			$data->fund_id=$row->fund_id;
			$title=$this->input->post('sctg',true);
			if($title=="" || $stitle=="") exit;
			$this->db->insert("subctg",$data);

			echo '1';
		}
	}
	
	public function ExpCtgEntry(){
		if($_POST){
			extract($_POST);
			if(trim($name)=="") exit;
			$data=array(
				'title'=>$name,
				'fund'=>$fund
			);
			$this->db->insert("exphead",$data);
			echo "1"; exit;
		}else {
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/setup_section/ExpCtgEntry');
			$this->load->view('admin/footer');
		}
	}
	public function ExpSubCtgEntry(){
		if($_POST){
			extract($_POST);
			if(trim($pname)=="") exit;
			$data=array(
				'pid'=>$pid,
				'pname'=>$pname
			);
			$this->db->insert("expurpose",$data);
			echo "1"; exit;
		}
		else {
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/setup_section/ExpSubCtgEntry');
			$this->load->view('admin/footer');
		}
	}
	
	public function newAccEntry(){
		if($_POST){
			$name=$this->input->post('name',TRUE);
			$acno=$this->input->post('acno',TRUE);
			$balance=$this->input->post('balance',TRUE);
			if($name=="" || $acno==""){ echo "12"; exit;}
			
			$acc_query=$this->db->query("select * from acinfo where acname='$name' and acno='$acno'");
			$q=$this->db->affected_rows();
			if($q>0){ echo "11"; exit;}
			
			$data->acname=$this->input->post('name',TRUE);
			$data->acno=$this->input->post('acno',TRUE);
			$data->balance=$this->input->post('balance',TRUE);
			//add openning balance in Ledger
			$query=$this->db->query("SELECT tid from transaction order by id DESC limit 1");
			$vquery=$this->db->query("SELECT vno from  voucherinfo order by id DESC limit 1");
			$row=$query->row();
			$vrow=$vquery->row();
			//print_r($row);
			if($row->tid>100){$tranction=$row->tid+1;}
			if($vrow->vno>1200){$voucher=$vrow->vno+1;}
			else{
				$tranction=101;
				$voucher=1201;
			}
			//Balance add Ledger
		   $user=$this->session->userdata('username');
		   $ledg=array(
			   'tid'=>$tranction,
			   'voucherno'=>$voucher,
			   'purpose'=>'Opening Balance',
			   'ac'=>$acno,
			   'dr'=>0,
			   'cr'=>0,  
			   'balance'=>$balance,  
			   'inby'=>$user
		   );
		   // echo "<pre>";
		   // print_R($data);
		   $this->db->insert("ledger",$ledg);	
		   //update transaction & voucher
		   $this->db->query("insert into transaction(tid) values('$tranction')");
		   $this->db->query("insert into voucherinfo(vno) values('$voucher')");
		   $in=$this->db->insert("acinfo",$data);
			// echo $this->db->last_query();
			 //echo $in;
			if($in) echo "1"; else echo "0";
		}
		else{
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/setup_section/newAccEntry');
			$this->load->view('admin/footer');
		}
	}
	
	// for account update.........
	public function account_info_show(){
		if(isset($_POST['mid'])){
			extract($_POST);
			$show = $this->setup->search_account_info('acinfo',$mid);
			//print_r($show);
			
			echo $show->id.'|'.$show->acname.'|'.$show->acno;
		}
	}
	public function updateAccountInfo(){
		extract($_POST);
		$account_name=trim($account_name);
		$ref_number=trim($ref_number);
		if($account_name=="" || $ref_number==""){
			echo 5;
			exit;
		}
		else{
			$data = array(
				'acname'	=>	$account_name
			);
			$this->db->where('id',$id);
			$update = $this->db->update('acinfo',$data);
			if($update){
				echo 1;
			}
		}
	}
		
	public function changePassword(){
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/changePassword');
		$this->load->view('admin/footer');
	}
	public function changePasswordAction(){
		extract($_POST);
		$username=$this->session->userdata('username');
		$userid=$this->session->userdata('id');
		$this->db->query("SELECT * FROM admin WHERE username='$username' AND id='$userid' AND pass=md5('$oldPass')");
		if($this->db->affected_rows()<1){ echo 2;exit;}
		$today = date("Y-m-d");
		$data2=array('pass'=>md5($newPass),'passDateTime'=>$today);
		$this->db->where('username',$username);
		$passUpdate = $this->db->update('admin',$data2);
		if($passUpdate){
			echo 1;exit;
		}
	}
	public function changeProfile(){
		$data = array(
			'row'	=> $this->setup->getProfile()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/changeProfile');
		$this->load->view('admin/footer');
	}
	
	public function changeProfileAction(){
		extract($_POST);
		//print_r($_POST);exit;
		if(trim($fullname) == "" || trim($mobile)=="" || trim($email)==""){
			echo 10;exit;
		}
		$userid=$this->session->userdata('id');
		if($_FILES['picture']['name']==''){
			$pic=$image;
		}else{
			$pic=$_FILES['picture']['name'];
			$tmp_name=$_FILES['picture']['tmp_name'];
			if($_FILES['picture']['size']){
				copy($tmp_name,"img/$pic");
			}
		}
		
		$data=array(
			'fullname'	=> $fullname,
			'mobile'	=> $mobile,
			'email'		=> $email,
			'pic'		=> $pic
		);
		
		$this->db->trans_start();
			$this->db->where('id',$userid);
			$this->db->update('admin',$data);
		$this->db->trans_complete();
		if($this->db->trans_complete()=== TRUE){
			echo 1;exit;
		}else{
			echo 'Opss!! somthing error';exit;
		}
	}
	/* public function changePasswordAction(){
		//if ($_POST){
			extract($_POST);
			if($_FILES['picture']['name']==''){
				$pic=$image;
			}else{
				$pic=$_FILES['picture']['name'];
				$tmp_name=$_FILES['picture']['tmp_name'];
					if($_FILES['picture']['size']){
						copy($tmp_name,"img/$pic");
					}
				}
			
			$userid=$this->session->userdata('id');
			$fullname=$this->input->post('fullname',TRUE);
			$phone=$this->input->post('phone',TRUE);
			$email=$this->input->post('email',TRUE);

			$password=$this->input->post('password',TRUE);
			$cpassword=$this->input->post('cpassword',TRUE);


			$data=array(
			'fullname'=>$fullname,
			'phone'=>$phone,
			'email'=>$email,
			'pic'=>$pic
			);
			//print_r($data);exit;
			$this->db->where('id',$userid);
			$this->db->update('admin',$data);

			if (!empty($password) && !empty($cpassword)){
				if ($password!=$cpassword){ echo "10"; exit; } //password does not match
				$data2=array('pass'=>md5($password));
				$pass=$this->db->update('admin',$data2);
				//echo $this->db->last_query();
				if ($pass){ echo "3";exit; } // password Update suceesully
				}
				echo "1"; //succees change your Profile
		//}
	} */
	public function adminProfile(){
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/setup_section/adminProfile');
		$this->load->view('admin/footer');
	}	
}
