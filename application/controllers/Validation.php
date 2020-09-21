<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
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
	// for national id......
	public function check_uniqueNid(){
		$nationid = $_POST['nationid'];
		$tbl = $_GET['tbl'];
		$this->db->select('nationid')->from($tbl)->where('nationid',$nationid)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// for mukti sonod ........
	public function check_uniqueMuktiSonod(){
		$mukti_sonod = $_POST['mukti_sonod'];
		$tbl = $_GET['tbl'];
		$this->db->select('mukti_sonod')->from($tbl)->where('mukti_sonod',$mukti_sonod)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// for birthcertificate number....
	public function check_uniqueBcno(){
		$bcno = $_POST['bcno'];
		$tbl = $_GET['tbl'];
		$this->db->select('bcno')->from($tbl)->where('bcno',$bcno)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// for passport number..
	public function check_uniquePno(){
		$pno = $_POST['pno'];
		$tbl = $_GET['tbl'];
		$this->db->select('pno')->from($tbl)->where('pno',$pno)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else {
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	public function check_holding_no(){
		$holding_no = $_POST['holding_no'];
		$query = $this->db->select('holding_no')->from("holdingclientinfo")->where('holding_no',$holding_no)->get();
		if($query->num_rows() < 1){
			echo json_encode(array(
				'valid' => false,
				'message' => "Holding number not found. At first registration for holding TAX.",
			));
		}else{
			echo json_encode(array(
				'valid' => true
			));
			
		}
	}
	public function check_uniqueMob(){
		$mob = $_POST['mob'];
		$tbl = $_GET['tbl'];
		$this->db->select('mobile')->from($tbl)->where('mobile',$mob)->get();
		if($this->db->affected_rows()>0){
			$valid = true;
			$msg = 'The Moblie number is already exist';
			$available = false;
			echo json_encode(array(
				'valid' => $valid,
				'message' => $msg,
				'available' => $available
			));
		}
		else {
			$valid = true;
			echo json_encode(array(
				'valid'		=> $valid
			));
		}
		
	}
	
	// for unique tradelicense institute name.....
	public function check_uniqueInstituteName(){
		$ecomname = $_POST['ecomname'];
		$tbl = $_GET['tbl'];
		$this->db->select('ecomname')->from($tbl)->where('ecomname',$ecomname)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// for check bangla unique institute name
	public function check_banglaUniqueInstituteName(){
		$bcomname = $_POST['bcomname'];
		$tbl = $_GET['tbl'];
		$this->db->select('bcomname')->from($tbl)->where('bcomname',$bcomname)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// for unique VAT id for tradelicense ...
	public function check_uniqueVatid(){
		$vatid = $_POST['vatid'];
		$this->db->select('vatid')->from("tradelicense")->where('vatid',$vatid)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else {
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// for unique TAX id for tradelicense ...
	public function check_uniqueTaxid(){
		$taxid = $_POST['taxid'];
		$this->db->select('taxid')->from("tradelicense")->where('taxid',$taxid)->get();
		if($this->db->affected_rows()>0){
			$isAvailable = false;
		}
		else {
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	
	/**
	* Holding reigstration validation
	*/
	// check duplicate national id
	public function check_unique_nid(){
		$national_id = $_POST['nationalId'];
		$tbl = $_GET['tbl'];
		$query = $this->db->select('national_id')->from($tbl)->where('national_id', $national_id)->get();
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate birth certificate id
	public function check_unique_birth_certificate_id(){
		$birth_certificate_id = $_POST['birthCertificateId'];
		$tbl = $_GET['tbl'];
		$query = $this->db->select('birth_certificate_id')->from($tbl)->where('birth_certificate_id', $birth_certificate_id)->get();
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate dag no
	public function check_unique_dag_no(){
		$dag_no = $_POST['dagNo'];
		$tbl = $_GET['tbl'];
		$query = $this->db->select('dag_no')->from($tbl)->where('dag_no', $dag_no)->get();
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate mobile number
	public function check_unique_mobile_number(){
		$mobile_number = $_POST['mobileNo'];
		$tbl = $_GET['tbl'];
		$query = $this->db->select('mobile_number')->from($tbl)->where('mobile_number',$mobile_number)->get();
		if($query->num_rows() > 0){
			echo json_encode(array(
				'valid'     => true,
				'message'   => 'The Moblie number is already exist',
				'available' => false
			));
		}
		else {
			echo json_encode(array(
				'valid'		=> true
			));
		}
		
	}
	// check duplicate word number
	public function check_unique_word_number(){
		$word_no = (int)$_POST['wordNo'];
		$tbl = $_GET['tbl'];
		$query = $this->db->select('word_no')->from($tbl)->where(['word_no' => $word_no, 'is_delete' => 0])->get();
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate word number
	public function check_unique_word_number_for_update(){
		$word_no = (int)$_POST['wordNo'];
		$hid     =  (string)$_POST['hid'];
		$tbl = $_GET['tbl'];
		
		$query = $this->db->select('id, word_no')->from($tbl)->where(['md5(id) !=' => $hid, 'word_no' => $word_no, 'is_delete' => 0])->get();
		
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate occupatoin
	public function check_unique_occupation(){
		$occupation_name = trim((string)$_POST['occupationName']);
		$tbl = $_GET['ch'];
		$query = $this->db->select('title')->get_where($tbl, ['type' => 1, 'title' => $occupation_name]);
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate occupation when update
	public function check_unique_occupation_for_update(){
		$occupation_name = trim((string)$_POST['occupationName']);
		$hid     =  (string)$_POST['hid'];
		$tbl = $_GET['ch'];
		
		$query = $this->db->select('title')->from($tbl)->where(['md5(id) !=' => $hid, 'type' => 1, 'title' => $occupation_name])->get();
		
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate classicification
	public function check_unique_classicification(){
		$classicification_name = trim((string)$_POST['classicificationName']);
		$tbl = $_GET['ch'];
		$query = $this->db->select('title')->get_where($tbl, ['type' => 2, 'title' => $classicification_name]);
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate occupation when update
	public function check_unique_classicification_for_update(){
		$classicification_name = trim((string)$_POST['classicificationName']);
		$hid     =  (string)$_POST['hid'];
		$tbl = $_GET['ch'];
		
		$query = $this->db->select('title')->from($tbl)->where(['md5(id) !=' => $hid, 'type' => 2, 'title' => $classicification_name])->get();
		
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	// check duplicate holding rate sheet
	public function check_unique_holding_rate_sheet(){
		$tbl = $_GET['ch'];
		$classification_id = (int)$_POST['classification'];
		$occupation_id = (int)$_POST['occupation'];
		$label_id = (int)$_POST['holdingRateSheetLabel'];
		if(trim($label_id) == '' || trim($classification_id) == '' || trim($occupation_id) == ''){
			$isAvailable = true;
		}else{
			$query = $this->db->select('id')->from($tbl)->where(['label_id' => $label_id, 'classification_id' => $classification_id, 'occupation_id' => $occupation_id])->get();
			if($query->num_rows() > 0){
				$isAvailable = false;
			}
			else{
				$isAvailable = true;
			}
		}
		echo json_encode(array( 'valid' => $isAvailable));
	}
	// check duplicate holding rate sheet label for insert
	public function check_unique_holding_rate_sheet_label(){
		$label = (string)$_POST['holdingRateSheetLabel'];
		$tbl = $_GET['ch'];
		
		$query = $this->db->select('rate_sheet_label')->from($tbl)->where(['rate_sheet_label' => $label])->get();
		
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	
	// check duplicate holding rate sheet label for update
	public function check_unique_holding_rate_sheet_label_for_update(){
		$label = (string)$_POST['holdingRateSheetLabel'];
		$hid     =  (string)$_POST['hid'];
		$tbl = $_GET['ch'];
		
		$query = $this->db->select('rate_sheet_label')->from($tbl)->where(['md5(id) !=' => $hid, 'rate_sheet_label' => $label])->get();
		
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	
	//  dag no exists check
	public function check_exists_dag_no(){
		$dag_no = (string)trim($_POST['dagNo']);
		$tbl = $_GET['tbl'];
		$query = $this->db->select('dag_no')->from($tbl)->where('dag_no', $dag_no)->get();
		if($query->num_rows() > 0){
			$isAvailable = true;
		}
		else{
			$isAvailable = false;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	//holding no exists check
	public function check_exists_holding_no(){
		$holding_no = $_POST['holdingNo'];
		$tbl = $_GET['tbl'];
		$query = $this->db->select('holding_no')->from($tbl)->where('holding_no', $holding_no)->get();
		if($query->num_rows() > 0){
			$isAvailable = true;
		}
		else{
			$isAvailable = false;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
	public function check_unique_book_and_money_number(){
		$money_number = (int)$_POST['moneyNumber'];
		$book_number    =  (int)$_POST['bookNumber'];
		$tbl = $_GET['ch'];
		
		$query = $this->db->select('id, book_number, money_receipt')->from($tbl)->where(['money_receipt' => $money_number, 'book_number' => $book_number])->get();
		
		if($query->num_rows() > 0){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		echo json_encode(array(
			'valid' => $isAvailable,
		));
	}
}