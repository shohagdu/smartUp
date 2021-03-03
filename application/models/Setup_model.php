<?php
class Setup_model extends CI_Model{
	public function __construct(){
		ob_start();
		parent::__construct();
	}
	// get fiscal year
	public function get_fiscal_year(){
		
		$query = $this->db->select('id, md5(id) as hid, full_year, short_year, start_year, end_year, is_current')->order_by('id', 'DESC')->get('tbl_fiscal_year');
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Fiscal year found', 'data' => $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Fiscal year not found', 'data' => []];
		}
	}
	// get fiscal year without current fiscal year
	public function get_fiscal_year_without_current_fiscal_year(){
		
		$query = $this->db->select('id, full_year, short_year, start_year, end_year, is_current')->order_by('id', 'DESC')->get_where('tbl_fiscal_year',['is_current !=' => 1]);
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Fiscal year found', 'data' => $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Fiscal year not found', 'data' => []];
		}
	}
	// get current fiscal year
	public function get_current_fiscal_year(){
		
		$query = $this->db->select('id, full_year, short_year, start_year, end_year, is_current')->order_by('id', 'DESC')->get_where('tbl_fiscal_year',['is_current' => 1]);
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Fiscal year found', 'data' => $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Fiscal year not found', 'data' => []];
		}
	}
	// get person wise fiscal year reday for payment form
	public function get_person_wise_fiscal_year($dag_no){
		$query1 = $this->db->select('GROUP_CONCAT(fisyal_year_id) as year_ids')
				->get_where('payment_log_bosotbita', ['dag_no' => $dag_no]);
		
		if($query1->num_rows() > 0){
			$year_array =  array_unique(explode(',', $query1->row()->year_ids));
			$query2 = $this->db->select('id, full_year, short_year, start_year, end_year, is_current')
							->where_not_in('id', $year_array)
							->order_by('id', 'DESC')
							->get('tbl_fiscal_year');
			
			if($query2->num_rows() > 0){
				return ['status' => 'success', 'message' => 'Fiscal year found', 'data' => $query2->result()];
			}else{
				return ['status' => 'error', 'message' => "$dag_no এই দাগ নম্বর এর সকল অর্থ বছরের টাকা পরিশোধ করা আছে ।", 'data' => []];
			}
			
		}else{
			$query3 = $this->db->select('id, full_year, short_year, start_year, end_year, is_current')
							->order_by('id', 'DESC')
							->get_where('tbl_fiscal_year',[]);
							
			if($query3->num_rows() > 0){
				return ['status' => 'success', 'message' => 'Fiscal year found', 'data' => $query3->result()];
			}else{
				return ['status' => 'error', 'message' => 'Fiscal year not found', 'data' => []];
			}
		}
	}
	
	//force password change function
	public function forcePassChange(){
		$userid=$this->session->userdata('id');
		$Query=$this->db->query("SELECT id, username, passDateTime FROM admin WHERE id='$userid'");
		$data =  $Query->row();
		
		$today = date("Y-m-d");
		$dbDate = date("Y-m-d",strtotime($data->passDateTime));
		if($today != $dbDate){
			return true;
		}else{
			return true;
		}
	}
	
	// check basic union setup
	public function basicUnionSetup(){
		//$s=$this->db->count_all("setup_tbl");
		$count = $this->db->get("setup_tbl")->num_rows();
		if($count):
			return true;
		else:
			return false;
		endif;	
	}
	// for login user info .....
	public function getProfile(){
		$userid=$this->session->userdata('id');
		$Query=$this->db->query("SELECT * FROM admin WHERE id='$userid'");
		return $Query->row();
	}
	
	//full website setup data
	public function getdata(){
		$query = $this->db->get('setup_tbl');
		return $query->row();
	}
	
	public function fighter_data(){
		$query = $this->db->get('tbl_fighters');
		return $query->result();
	}
	public function count_fighter(){
		$qy=$this->db->query("select count(*) as total from tbl_fighters order by id desc");
		$row=$qy->row();
		return $row->total;
	}
	public function nagorick_table(){
		$query=$this->db->query("select name,bfname,nationid,dofb,perb_wordno,mobile from personalinfo where nationid !='' order by id DESC")->result();
		return $query;
	}
	public function count_voter(){
		$qy=$this->db->query("select count(*) as total from tbl_voter_list");
		$row=$qy->row();
		return $row->total;
	}
	public function fighter_onerow($id){
		$this->db->where("id",$id);
		$query=$this->db->get('tbl_fighters');
		return $query->row();
		
	}
	public function updateonerow($id){
		$this->db->where("md5(id)",$id);
		$query=$this->db->get('tbl_fighters');
		return $query->row();
	}
	public function update_poorman_row($id){
		$this->db->where("md5(id)",$id);
		$query=$this->db->get('tbl_poormans');
		return $query->row();
	}
	public function poorman_data(){
		$query = $this->db->get('tbl_poormans');
		return $query->result();
	}
	public function count_poormans(){
		$qy=$this->db->query("SELECT count(*) as total FROM tbl_poormans order by id DESC");
		$row=$qy->row();
		return $row->total;
	}
	public function count_widow()
	{
		$qy = $this->db->query("SELECT count(*) as total FROM tbl_widow order by id DESC");
		$row= $qy->row();
		return $row->total;
	}
	public function count_foreignMan()
	{
		$qy = $this->db->query("SELECT count(*) as total FROM  tbl_foreignman order by id DESC");
		$row= $qy->row();
		return $row->total;
	}
	public function update_oldman_stipend($id){
		$this->db->where("md5(id)",$id);
		$query=$this->db->get('tbl_oldmanstipend');
		return $query->row();
	}
	public function oldmanStipend_data(){
		$query=$this->db->get('tbl_oldmanstipend');
		return $query->result();
		
	}
	public function count_oldmanstipend(){
		$qy=$this->db->query("SELECT count(*) as total FROM tbl_oldmanstipend order by id DESC");
		$row=$qy->row();
		return $row->total;
	}
	public function count_motherVata()
	{
		$qy=$this->db->query("SELECT count(*) as total FROM tbl_mother_vata order by id DESC");
		$row=$qy->row();
		return $row->total;
	}
	public function count_autistic()
	{
		$qy=$this->db->query("SELECT count(*) as total FROM tbl_autistic order by id DESC");
		$row=$qy->row();
		return $row->total;
	}
	public function count_autisticStudent()
	{
		$qy=$this->db->query("SELECT count(*) as total FROM tbl_autisticstudent order by id DESC");
		$row=$qy->row();
		return $row->total;
	}
	
	// for account information update........
	public function search_account_info($table,$id){
		$this->db->where("id",$id);
		$query= $this->db->get($table);
		return $query->row();
	}
	// for status showing....
	public function statusFunction($sts){
		if($sts==1){
			return "<p style='color: green'>Enable</p>";
		}
		else{
			return "<p style='color: red'>Disable</p>";
		}
	}
	// check duplicate  for insert
	public function is_insert_duplicate($table, $column, $where){
		$query = $this->db->select("$column")
				 ->get_where("$table", $where);
				 
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// check holding rate sheet duplicate
	public function holding_rate_sheet_duplicate($receive){
		$query = $this->db->select('id')->get_where('holding_rate_sheet', [
			'classification_id' => (int)$receive['classification'],
			'occupation_id' => (int)$receive['occupation'],
			'label_id' => (int)$receive['holdingRateSheetLabel']
		]);
		
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// check duplicate  for update
	public function is_update_duplicate($table, $column, $where){
		$query = $this->db->select("$column")
				 ->get_where("$table", $where);
				 
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	// get all member information
	public function get_all_member_info(){
		$query = $this->db->select("id, word_no, member_name, member_father, IF(is_active='1','Enable','Disable') as status ")
				->order_by('id', 'DESC')
				->get_where('word_member', ['is_delete' => 0]);
		
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Member Information Found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Member Information not Found', 'data'=> null];
		}
	}
	// get current active rate sheet
	public function get_current_active_rate_sheet(){
		$query = $this->db->select('rate.id as rid, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label, rate.amount, rate.is_current, rate.is_active')
				->join('holding_rate_sheet_label as label', 'label.id=rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where(['rate.is_current' => 1, 'rate.is_active'=> 1])
				->order_by('rate.id', 'DESC')
				->get('holding_rate_sheet as rate');
		
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Rate Sheet Information Found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Rate Sheet Information not Found', 'data'=> null];
		}
	}
	// get single member information
	public function get_single_member_info($id){
		$query = $this->db->select("id, md5(id) as hid, word_no, member_name, member_father, is_active as status ")
				->get_where('word_member', ['md5(id)' => $id]);
				
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Member Information Found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Member Information not Found', 'data'=> null];
		}
	}
	// get classification list
	public function get_classification_list(){
		$query = $this->db->select('snf.id, snf.title, snf.type, IF(snf.status,"Enable", "Disable") as status, DATE_FORMAT(snf.created_date, "%Y-%m-%d %h:%i:%s %p") as created_date', false)
				->where(['snf.type' => 2]) // 2= classification
			    ->order_by('snf.id', 'DESC')
				->get('snf_global_form as snf');
				
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'classification information found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'classification information not found', 'data'=> null];
		}		
	}
	// classicification operation
	public function classicification_operation($receive){
		
		$this->db->trans_begin();
		
		$this->db->insert("snf_global_form", [
			'created_date' => date('Y-m-d H:i:s'),
			'created_ip' => (string) $this->input->ip_address(),
			'created_by' => (int) $this->session->userdata('id'),
			'title' => (string) trim($receive['classicificationName']),
			'status' => 1, // Enable
			'type' => 2 // classicification
		]);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Insertion failed'];
		}else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'Add successfully'];
		}
	}
	// get single classification info 
	public function single_classification_info($id){
		$query = $this->db->select('snf.id, md5(snf.id) as hid, snf.title, snf.type, snf.status', false)
				->get_where('snf_global_form as snf', ['md5(snf.id)' => $id]);
				
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Classification information found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Classification information not found', 'data'=> null];
		}
	}
	// classification update opeartion
	public function classification_update_operation($receive){
		
		// update block
		$param = [
			'status'    => (int) $receive['status'],
			'updated_by'   => (int) $this->session->userdata('id'),
			'updated_ip'   => (string) $this->input->ip_address(),
			'updated_date' => date('Y-m-d H:i:s')
		];
		$this->db->trans_begin();
		$this->db->where('md5(id)', $receive['hid']);
		$this->db->update("snf_global_form",$param);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Update failed'];
		}else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'update successfully'];
		}
	}
	// get occupation list
	public function get_occupation_list(){
		$query = $this->db->select('snf.id, snf.title, snf.type, IF(snf.status,"Enable", "Disable") as status, DATE_FORMAT(snf.created_date, "%Y-%m-%d %h:%i:%s %p") as created_date', false)
				->where(['snf.type' => 1])
			    ->order_by('snf.id', 'DESC')
				->get('snf_global_form as snf');
				
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Occupation information found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Occupation information not found', 'data'=> null];
		}		
	}
	// occupation operation
	public function occupation_operation($receive){
		
		$this->db->trans_begin();
		
		$this->db->insert("snf_global_form", [
			'created_date' => date('Y-m-d H:i:s'),
			'created_ip' => (string) $this->input->ip_address(),
			'created_by' => (int) $this->session->userdata('id'),
			'title' => (string) trim($receive['occupationName']),
			'status' => 1, // Enable
			'type' => 1 // occupation
		]);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Insertion failed'];
		}else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'Add successfully'];
		}
	}
	// get single occupation info 
	public function single_occupation_info($id){
		$query = $this->db->select('snf.id, md5(snf.id) as hid, snf.title, snf.type, snf.status', false)
				->get_where('snf_global_form as snf', ['md5(snf.id)' => $id]);
				
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Occupation information found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Occupation information not found', 'data'=> null];
		}
	}
	// occupation update opeartion
	public function occupation_update_operation($receive){
		
		// update block
		$param = [
			'status'    => (int) $receive['status'],
			'updated_by'   => (int) $this->session->userdata('id'),
			'updated_ip'   => (string) $this->input->ip_address(),
			'updated_date' => date('Y-m-d H:i:s')
		];
		$this->db->trans_begin();
		$this->db->where('md5(id)', $receive['hid']);
		$this->db->update("snf_global_form",$param);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Update failed'];
		}else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'update successfully'];
		}
	}
	// get holding rate sheet form information 
	public function get_holding_rate_sheet_form_information(){
		$feedback = [];
		
		$label = $this->db->select('id, rate_sheet_label as label')->get_where('holding_rate_sheet_label', ['status' => 1]);
		if($label->num_rows() > 0){
			$feedback['label'] = ['status' => 'success', 'message' => 'Holding Rate Sheet Label information found', 'data' => $label->result()];
		}else{
			$feedback['label'] = ['status' => 'error', 'message' => 'Holding Rate Sheet Label information not found', 'data' => []];
		}
		$occupation = $this->db->select('id, title')->get_where('snf_global_form', ['type' => 1, 'status' => 1]);
		if($occupation->num_rows() > 0){
			$feedback['occupation'] = ['status' => 'success', 'message' => 'Occupation information found', 'data' => $occupation->result()];
		}else{
			$feedback['occupation'] = ['status' => 'error', 'message' => 'Occupation information not found', 'data' => []];
		}
		$classification = $this->db->select('id, title')->get_where('snf_global_form', ['type' => 2, 'status' => 1]);
		if($classification->num_rows() > 0){
			$feedback['classification'] = ['status' => 'success', 'message' => 'Classification information found', 'data' => $classification->result()];
		}else{
			$feedback['classification'] = ['status' => 'error', 'message' => 'Classification information not found', 'data' => []];
		}
		return $feedback;
	}
	// get holding rate sheet label
	public function get_holding_rate_sheet_level(){
		
		$query = $this->db->select('id, rate_sheet_label as label, IF(status="1","Enable","Disable") as status, DATE_FORMAT(created_date,"%Y-%m-%d %h:%i:%s %p") as created_date', false)
				->order_by('id', 'DESC')
				->get_where('holding_rate_sheet_label');
		
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Rate sheet information found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Rate sheet information not found', 'data'=> null];
		}
	}
	// holding rate sheet label add
	public function holding_rate_sheet_label_add($receive){
		
		$this->db->trans_begin();
		$this->db->insert("holding_rate_sheet_label", [
			'rate_sheet_label'=> (string) trim($receive['holdingRateSheetLabel']),
			'created_by'      => (int) $this->session->userdata('id'),
			'created_ip'      => (string) $this->input->ip_address(),
			'created_date'    => date('Y-m-d H:i:s')
		]);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Insertion failed'];
		}else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'Add successfully'];
		}
	}
	public function single_holding_rate_sheet_label($id){
		$query = $this->db->select("id, md5(id) as hid, rate_sheet_label, status", false)
				->get_where('holding_rate_sheet_label', ['md5(id)' => $id]);
			
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Holding rate sheet label information found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Holding rate sheet label information not found', 'data'=> null];
		}
	}
	public function holding_rate_sheet_label_update($receive){
	
		$this->db->trans_begin();
		$this->db->where('md5(id)', $receive['hid']);
		$this->db->update("holding_rate_sheet_label", [
			'status'       => (int) $receive['status'],
			'updated_by'   => (int) $this->session->userdata('id'),
			'updated_ip'   => (string) $this->input->ip_address(),
			'updated_date' => date('Y-m-d H:i:s')
		]);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Update failed'];
		}else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'update successfully'];
		}
	}
	// get all holding rate sheet
	public function get_holding_rate_sheet(){
		$query = $this->db->select('rate.id as rid, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as label, rate.amount, IF(rate.is_active="1","Enable","Disable") as status, DATE_FORMAT(rate.created_date,"%Y-%m-%d %h:%i:%s %p") as created_date', false)
				->join('holding_rate_sheet_label as label', 'rate.label_id=label.id')
			    ->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->order_by('rate.id', 'DESC')
				->where(['rate.is_current' => 1])
				->get_where('holding_rate_sheet as rate');
		
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Rate sheet information found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Rate sheet information not found', 'data'=> null];
		}
	}
	// holding rate sheet operation
	public function holding_rate_sheet_operation($receive){
		
		$this->db->trans_begin();
		$this->db->insert("holding_rate_sheet", [
			'classification_id' => (int) trim($receive['classification']),
			'occupation_id' => (int) trim($receive['occupation']),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => (int) $this->session->userdata('id'),
			'created_ip' => (string) $this->input->ip_address(),
			'is_current' => 1,
			'is_active' => 1,
			'label_id' => (int) trim($receive['holdingRateSheetLabel']),
			'amount' => (double) trim($receive['amount'])
		]);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Insertion failed'];
		}else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'Add successfully'];
		}
	}
	public function single_holding_rate_sheet($id){
		$query = $this->db->select("rate.id as rid, md5(rate.id) as hid, CONCAT(label.rate_sheet_label,'-',occupation.title,'-', classification.title) as rate_sheet_label, rate.amount, rate.is_current, rate.is_active as status", false)
				->join('holding_rate_sheet_label as label', 'rate.label_id = label.id', 'inner')
			    ->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->get_where('holding_rate_sheet as rate', ['md5(rate.id)' => $id]);
		
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Holding rate sheet information found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Holding rate sheet information not found', 'data'=> null];
		}
	}
	//
	public function get_rate_sheet_amount_by_id($id){
		$query = $this->db->select('id, label_id, amount')
				->get_where('holding_rate_sheet', ['id' => $id]);
				
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Holding rate sheet information found', 'data' => $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Holding rate sheet information not found', 'data' => null];
		}
	}
	public function holding_rate_sheet_update_operation($receive){
		// check change amount
		$query = $this->db->select('id, label_id, occupation_id, classification_id, amount, is_active')
				->get_where('holding_rate_sheet', ['md5(id)' => (string) $receive['hid']]);
		$info = $query->row();
		if((double)$info->amount !== (double) $receive['amount']){
			// insert block
			$insert_param = [
				'classification_id' => (int) $info->classification_id,
				'occupation_id'     => (int) $info->occupation_id,
				'label_id'          => (int) $info->label_id,
				'amount'  	   => (double) trim($receive['amount']),
				'created_by'   => (int) $this->session->userdata('id'),
				'created_ip'   => (string) $this->input->ip_address(),
				'created_date' => date('Y-m-d H:i:s'),
				'is_current'   => 1,
				'is_active'    => (int) $receive['status']
			];
			$update_param = [
				'is_current'   => 0,
				'updated_by'   => (int) $this->session->userdata('id'),
				'updated_ip'   => (string) $this->input->ip_address(),
				'updated_date' => date('Y-m-d H:i:s')
			];
			
			$this->db->trans_begin();
			$this->db->insert("holding_rate_sheet",$insert_param);
			if($this->db->error()['code'] > 0){
				$error_message = $this->db->error()['message'];
				$this->db->trans_rollback();
				return ['status' => 'error', 'message' => $error_message];
			}
			$this->db->where('id', $info->id);
			$this->db->update("holding_rate_sheet",$update_param);
			if($this->db->error()['code'] > 0){
				$error_message = $this->db->error()['message'];
				$this->db->trans_rollback();
				return ['status' => 'error', 'message' => $error_message];
			}
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return ['status' => 'error', 'message' => 'Insertion failed'];
			}else{
				$this->db->trans_commit();
				return ['status' => 'success', 'message' => 'Add successfully'];
			}
			
		}else{
			if((int) $info->is_active === (int)$receive['status']){
				return ['status' => 'warning', 'message' => 'Nothing Change'];
			}
			// update block
			$param = [
				'is_active'    => (int) $receive['status'],
				'updated_by'   => (int) $this->session->userdata('id'),
				'updated_ip'   => (string) $this->input->ip_address(),
				'updated_date' => date('Y-m-d H:i:s')
			];
			$this->db->trans_begin();
			$this->db->where('md5(id)', $receive['hid']);
			$this->db->update("holding_rate_sheet",$param);
			if($this->db->error()['code'] > 0){
				$error_message = $this->db->error()['message'];
				$this->db->trans_rollback();
				return ['status' => 'error', 'message' => $error_message];
			}
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return ['status' => 'error', 'message' => 'Update failed'];
			}else{
				$this->db->trans_commit();
				return ['status' => 'success', 'message' => 'update successfully'];
			}
		}
	}			
	public function get_all_bosotbita_kor_person(){
		$query = $this->db->select('info.id as id, info.name, info.fathername, info.wordno, info.holding_no, info.dag_no, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label, rate.amount')
				->join('holding_rate_sheet as rate', 'rate.id = info.rate_sheet_id')
				->join('holding_rate_sheet_label as label', 'label.id = rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where(['info.is_active' => 1])
				->order_by('info.id', 'DESC')
				->get('holdingclientinfo as info');
		if($query->num_rows() > 0){
			return [
				'status' => 'success',
				'message' => 'Information found',
				'total_amount' => array_sum(array_column($query->result(), 'amount')),
				'data'=> $query->result()
			];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'data'=> null];
		}	
	}
    public  function uploadimage($image){

        $ext =  pathinfo($image['name'],PATHINFO_EXTENSION);
        $imageName=time().rand(10000 , 99999 ).".".$ext;
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image']	= $image['tmp_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = TRUE;
        $config['height']	= "300";
//        $config['width'] = "300";
        $config['new_image'] = "library/profile/".$imageName;//you should have write permission here..
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        return $config['new_image'];
    }
    public  function uploadimageFoodApplicant($image){

        $ext =  pathinfo($image['name'],PATHINFO_EXTENSION);
        $imageName="NID_UPLOADED_IMAGE_".time().rand(10000 , 99999 ).".".$ext;
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image']	= $image['tmp_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = TRUE;
        $config['height']	= "300";
//        $config['width'] = "300";
        $config['new_image'] = "library/NID_image/".$imageName;//you should have write permission here..
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        return $config['new_image'];
    }

}
