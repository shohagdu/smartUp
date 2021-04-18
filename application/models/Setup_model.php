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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


    function get_all_info($select=NULL,$table,$where=NULL)
    {
        if(!empty($select)){
            $this->db->select("*");
        }else {
            $this->db->select("*");
        }
        $this->db->from($table);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $query= $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return  false;
        }
    }

    function generateApplicantID()
    {
        $this->db->select("id");
        $this->db->from($this->table);
        $this->db->where('YEAR(created_time)',date('Y'));
        $count= $this->db->count_all_results();
        $finalID= $count+1;
        return date('Y').str_pad($finalID,5,0,STR_PAD_LEFT);
    }
    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen( $output_file, 'wb' );
        fwrite( $ifp, base64_decode( $base64_string ) );
        fclose( $ifp );
        return $output_file;
    }
    function get_single_info($select=NULL,$table,$where=NULL)
    {
        if(!empty($select)){
            $this->db->select($select);
        }else {
            $this->db->select("*");
        }
        $this->db->from($table);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->limit(1);
        $query= $this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return  false;
        }
    }

    function getApplicantInfoAutoComplete($searchInfo){
        $response = array();
        if(isset($searchInfo) ) {
            $this->db->select('id,name,mobile,nid');
            $this->db->where("nid like '%" . $searchInfo . "%' ");
            $this->db->or_where("name like '%" . $searchInfo . "%' ");
            $this->db->or_where("mobile like '%" . $searchInfo . "%' ");
            $this->db->where("is_active",1);
            $records = $this->db->get('food_receiver_applicant_info');
            if($records->num_rows()>0) {
                $data=$records->result();
                foreach ($data as $row) {
                    $response[] = array("value" => $row->id, "label" => $row->name . ' - ' . $row->mobile . ' - [' . $row->nid . ']');
                }
            }
        }
        return json_encode( $response);
    }

    function get_receive_food_info($where=NULL)
    {

        $this->db->select("receive.*,applicant.name,applicant.card_no,applicant.nid,applicant.mobile as applicant_mobile,applicant.village,applicant.wordNo,applicant.pic,dealer.name as dealer_name,dealer.shop_name,dealer.address,dealer.mobile as dealer_mobile,program.title as program_name,program.is_active as program_status");
        $this->db->from('food_receiver_record as receive');
        $this->db->join('food_receiver_applicant_info as applicant','applicant.id=receive.applicant_id',"left");
        $this->db->join('food_dealer_info as dealer','receive.dealer_id=dealer.id',"left");
        $this->db->join('food_program_info as program','program.id=receive.food_program_id',"left");
        if(!empty($where)){
            $this->db->where($where);
        }else {
            $this->db->where('receive.is_active !=', 0);
        }
        $this->db->order_by('receive.applicant_id','ASC');
        $query= $this->db->get();

        if($query->num_rows()>0){
            return ['status'=>'success','message'=>'Successfully Data found','data'=>$query->result()];
        }else{
            return ['status'=>'error','message'=>'No Data found','data'=>''];
        }
    }

    function getPorichoyApiInfo($data,$apiURL,$apiKey){
        $url = $apiURL;
// Collection object
// Initializes a new cURL session
        $curl = curl_init($url);
// Set the CURLOPT_RETURNTRANSFER option to true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// Set the CURLOPT_POST option to true for POST request
        curl_setopt($curl, CURLOPT_POST, true);
// Set the request data as JSON using json_encode function
        curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
// Set custom headers for RapidAPI Auth and Content-Type header
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'x-api-key:'.$apiKey,
            'Content-Type: application/json'
        ]);
// Execute cURL request with all previous settings
        $response = curl_exec($curl);
// Close cURL session
        curl_close($curl);
      if(!empty($response)){
          return $response;
      }else{
          return  false;
      }
    }

    function getAlApplicantInfo($postData=null){

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
      //  $columnIndex = $postData['order'][0]['column']; // Column index
       // $columnName = $postData['columns'][$columnIndex]['data']; // Column name
       // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = !empty($postData['search']['value'])?$postData['search']['value']:''; // Search value

        // Custom search filter
        $dealer_id = !empty($postData['dealer_id'])?$postData['dealer_id']:'';

//        $this->db->like("card_no", $_POST["search"]["value"]);
//        $this->db->or_like("name", $_POST["search"]["value"]);
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
            $search_arr[] = " (food_receiver_applicant_info.name like '%".$searchValue."%' or 
         food_receiver_applicant_info.card_no like '%".$searchValue."%' or 
         food_receiver_applicant_info.mobile like '%".$searchValue."%' or 
         food_receiver_applicant_info.nid like'%".$searchValue."%' ) ";
        }
        if($dealer_id != ''){
            $search_arr[] = " food_receiver_applicant_info.dealer_id='".$dealer_id."' ";
        }

        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('food_receiver_applicant_info')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('food_receiver_applicant_info')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select(" `applicant_id`, `card_no`, `nid`, food_receiver_applicant_info.name, `pic`, `father_name`, food_receiver_applicant_info.mobile, `spouse_name`, `is_verify`, food_receiver_applicant_info.id,dealer.name as dealerName");
        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->join('food_dealer_info as dealer','dealer.id=food_receiver_applicant_info.dealer_id',"left");
        $this->db->order_by('food_receiver_applicant_info.id', 'ASC');
        $this->db->limit($rowperpage, $start);
        $record = $this->db->get('food_receiver_applicant_info');
        if(!empty($record->num_rows()>0)) {
            $records = $record->result();
            $data = array();
            $i = $start + 1;
            foreach ($records as $slKey => $record) {
                $action = '';
                $action .= '<a href="' . base_url('FoodController/editApplicantInfo/' . md5($record->id)) . '"  id="' . $record->id . '" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </a> <button type="button" name="delete" onclick="deleteApplicantInfo(' . $record->id . ')"  title="Delete"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
                $action .= ' <a href="' . base_url('FoodController/viewApplicantInfo/' . md5($record->id)) . '"   class="btn btn-warning btn-xs" style="margin:2px;"><i class="glyphicon glyphicon-eye-open"></i> Card</button>';
//
//            if($record->is_verify==1) {
//                $action .= ' <button type="button" name="update" onclick="verifyApplicantInfo(' . $record->id . ')" class="btn btn-warning btn-xs" style="margin:2px;"><i class="glyphicon glyphicon-refresh"></i> Verify Now</button>';
//            }else{
//                $action .= '<span class="badge" style="margin:2px;"> <i class="glyphicon glyphicon-ok-circle"></i> Verified</span>';
//            }
                $img = file_exists($record->pic) ? base_url() . $record->pic : 'img/default/default.jpg';

                $data[] = array(
                    "img" => '<img src="' . $img . '" class="img-thumbnail" width="50" height="35"  />',
                    "applicant_id" => $record->applicant_id,
                    "card_no" => $record->card_no,
                    "nid" => $record->nid,
                    "name" => $record->name,
                    "father_name" => $record->father_name,
                    "mobile" => $record->mobile,
                    "dealerName" => $record->dealerName,
                    "action" => $action,
                    "slNo" => $i++,
                );
            }
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
    function showApplicantInfo($where){
        $this->db->select(" `applicant_id`, `card_no`, `nid`, food_receiver_applicant_info.name, `pic`, `father_name`, food_receiver_applicant_info.mobile, `spouse_name`, `is_verify`, food_receiver_applicant_info.id,dealer.name as dealerName,is_fringerprint_register");
        if($where != '') {
            $this->db->where($where);
        }
        $this->db->join('food_dealer_info as dealer','dealer.id=food_receiver_applicant_info.dealer_id',"left");
//        $this->db->order_by('card_no','ASC');
        $records = $this->db->get('food_receiver_applicant_info');
        if($records->num_rows()>0){
            return ['status'=>'success','message'=>'Successfully Data found','data'=>$records->result()];
        }else{
            return ['status'=>'error','message'=>'No Data found','data'=>''];
        }
    }

    function showSingleApplicantInfo($where){
        $this->db->select(" applicant. applicant_id, applicant.card_no, applicant.nid, applicant.name, applicant.pic, applicant.father_name, applicant.mobile, applicant.spouse_name, applicant.is_verify, applicant.id,dealer.name as dealerName,applicant.is_fringerprint_register,applicant.card_issue_dt,applicant.village,applicant.wordNo,applicant.post_office,applicant.guardin_type,dealer.address as dealerAddress,dealer.address as dealerAddress,dealer.mobile as dealerMobile,occupation.title as occuTitle,authority.name as authorityTitle");
        if($where != '') {
            $this->db->where($where);
        }
        $this->db->join('food_dealer_info as dealer','dealer.id=applicant.dealer_id',"left");
        $this->db->join('food_dealer_info as authority','authority.id=applicant.issueingAuthority',"left");
        $this->db->join('snf_global_form as occupation','occupation.id=applicant.occupation',"left");
//        $this->db->order_by('card_no','ASC');
        $records = $this->db->get('food_receiver_applicant_info as applicant ');
        if($records->num_rows()>0){
            return ['status'=>'success','message'=>'Successfully Data found','data'=>$records->row()];
        }else{
            return ['status'=>'error','message'=>'No Data found','data'=>''];
        }
    }

    // Global Function worked
    function generateApplicantVGDID()
    {
        $this->db->select("id");
        $this->db->from("food_vgd_applicant_info");
        $this->db->where('YEAR(created_time)',date('Y'));
        $count= $this->db->count_all_results();
        $finalID= $count+1;
        return date('Y').str_pad($finalID,5,0,STR_PAD_LEFT);
    }

    /**
     * @param $table
     *
     * @return bool
     */
    public function get($table, $where = false, $field_rows = '*', $limit = false, $order_by = false, $where_in = false, $group_by = false, $like = false) {
        $this->db->select($field_rows)->from($table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($where_in)) {
            $this->db->where_in($where_in['key'], $where_in['values']);
        }

        if (!empty($like)) {
            $this->db->like($like);
        }

        if (!empty($limit)) {
            $this->db->limit($limit['limit'], $limit['start']);
        }

        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by['field'], $order_by['order']);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_join($table, $where = FALSE, $field_rows = '*', $limit = FALSE, $order_by = FALSE, $where_in_parmas = FALSE, $join_parmas = FALSE, $group_by = FALSE, $like = FALSE) {
        $this->db->select($field_rows);
        $this->db->from($table);

        if (!empty($join_parmas)) {
            foreach ($join_parmas as $join_item) {
                if (isset($join_item['type'])) {
                    $this->db->join($join_item['table'], $join_item['relation'], $join_item['type']);
                } else {
                    $this->db->join($join_item['table'], $join_item['relation']);
                }
            }
        }

        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($where_in_parmas)) {
            if (isset($where_in_parmas['key']) && isset($where_in_parmas['values'])) {
                $this->db->where_in($where_in_parmas['key'], $where_in_parmas['values']);
            } else {
                foreach ($where_in_parmas as $where_in) {
                    $this->db->where_in($where_in['key'], $where_in['values']);
                }
            }
        }

        if (!empty($like)) {
            $this->db->like($like);
        }

        if (!empty($limit)) {
            $this->db->limit($limit['limit'], $limit['start']);
        }

        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by['field'], $order_by['order']);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    /**
     * @param $table
     * @param $where
     *
     * @return bool
     */
    public function get_row($table, $where, $field_rows = '*', $order_by = false, $where_in = false) {
        $this->db->select($field_rows)->from($table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($where_in)) {
            $this->db->where_in($where_in['key'], $where_in['values']);
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by['filed'], $order_by['order']);
        }

        $query = $this->db->get();
        if ($query->result()) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function insert($table, $data = array()) {
        $insert = $this->db->insert($table, $data);
        if($insert) {
            return $this->db->insert_id();
        }
        else {
            return false;
        }
    }

    public function update($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
        return TRUE;
    }

    function getVGDApplicantInfo($postData=null){

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        //  $columnIndex = $postData['order'][0]['column']; // Column index
        // $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        // $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = !empty($postData['search']['value'])?$postData['search']['value']:''; // Search value

        // Custom search filter
        $dealer_id = !empty($postData['dealer_id'])?$postData['dealer_id']:'';

//        $this->db->like("card_no", $_POST["search"]["value"]);
//        $this->db->or_like("name", $_POST["search"]["value"]);
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
            $search_arr[] = " ( food_vgd_applicant_info.name like '%".$searchValue."%' or 
          food_vgd_applicant_info.vgd_card_no like '%".$searchValue."%' or 
          food_vgd_applicant_info.mobile_no like '%".$searchValue."%' or 
          food_vgd_applicant_info.nid like'%".$searchValue."%' ) ";
        }
        $search_arr[] = " food_vgd_applicant_info.is_active = 1 ";

        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('food_vgd_applicant_info')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('food_vgd_applicant_info')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select(" `applicant_id`, `vgd_card_no`, `nid`, food_vgd_applicant_info.name, `pic`, `gurdian_name`, food_vgd_applicant_info.mobile_no,  `is_verify`, food_vgd_applicant_info.id");
        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }
//        $this->db->join('food_dealer_info as dealer','dealer.id=food_receiver_applicant_info.dealer_id',"left");
        $this->db->order_by('food_vgd_applicant_info.id', 'ASC');
        $this->db->limit($rowperpage, $start);
        $record = $this->db->get('food_vgd_applicant_info');

        if(!empty($record->num_rows()>0)) {
            $records = $record->result();
            $data = array();
            $i = $start + 1;
            foreach ($records as $slKey => $record) {
                $action = '';
                $action .= '<a href="' . base_url('VgdController/editNewMember/' . md5($record->id)) . '"  id="' . $record->id . '" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </a> <button type="button" name="delete" onclick="deleteVGDApplicantInfo(' . $record->id . ')"  title="Delete"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>';
//                $action .= ' <a href="' . base_url('FoodController/viewApplicantInfo/' . md5($record->id)) . '"   class="btn btn-warning btn-xs" style="margin:2px;"><i class="glyphicon glyphicon-eye-open"></i> Card</button>';

                $img = file_exists($record->pic) ? base_url() . $record->pic : 'img/default/default.jpg';

                $data[] = array(
                    "img" => '<img src="' . $img . '" class="img-thumbnail" width="50" height="35"  />',
                    "applicant_id" => $record->applicant_id,
                    "card_no" => $record->vgd_card_no,
                    "nid" => $record->nid,
                    "name" => $record->name,
                    "father_name" => $record->gurdian_name,
                    "mobile" => $record->mobile_no,
                    "dealerName" => '',
                    "action" => $action,
                    "slNo" => $i++,
                );
            }
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
    function get_receive_vgd_food_info($where=NULL,$receive_status=NULL)
    {

        if($receive_status==1) {
            //Successfully received product
            $this->db->select("receive.*,applicant.name,applicant.vgd_card_no,applicant.nid,applicant.mobile_no as applicant_mobile,applicant.village,applicant.wordNo,applicant.pic,circle.title as circleTitle,program.title as program_name,program.is_active as program_status");
            $this->db->from('food_vgd_applicant_info as applicant');
            $this->db->join('food_vgd_receiver_info as receive', 'applicant.id=receive.applicant_id', "left");
            $this->db->join('food_vgd_circle_setup as circle', 'receive.vgd_circle_id=circle.id', "left");
            $this->db->join('food_program_info as program', 'program.id=receive.vgd_program_id', "left");
                    if(!empty($where)){
                        $this->db->where($where);
                    }else {
                        $this->db->where('receive.is_active !=', 0);
                    }
            $this->db->order_by('applicant.vgd_card_no', 'ASC');
            $query = $this->db->get();
        }else{
            //No  product received
            $vgd_program_id=(!empty($where['receive.vgd_program_id']))?$where['receive.vgd_program_id']:'';
            $vgd_circle_id=(!empty($where['receive.vgd_circle_id']))?$where['receive.vgd_circle_id']:'';
            unset($where['receive.vgd_program_id']);
            unset($where['receive.vgd_circle_id']);
            $this->db->select("receive.*,applicant.name,applicant.vgd_card_no,applicant.nid,applicant.mobile_no as applicant_mobile,applicant.village,applicant.wordNo,applicant.pic,circle.title as circleTitle,program.title as program_name,program.is_active as program_status");
            $this->db->from('food_vgd_applicant_info as applicant');
            $this->db->join('food_vgd_receiver_info as receive', "applicant.id=receive.applicant_id AND receive.vgd_program_id= $vgd_program_id AND receive.vgd_circle_id=$vgd_circle_id ", "left");
            $this->db->join('food_vgd_circle_setup as circle', 'receive.vgd_circle_id=circle.id', "left");
            $this->db->join('food_program_info as program', 'program.id=receive.vgd_program_id', "left");
            $this->db->where('applicant.is_active', 1);
            $this->db->where('receive.applicant_id IS NULL');
            $this->db->order_by('applicant.vgd_card_no', 'ASC');
            $query = $this->db->get();
        }
       // return  $this->db->last_query();
        if($query->num_rows()>0){
            return ['status'=>'success','message'=>'Successfully Data found','data'=>$query->result()];
        }else{
            return ['status'=>'error','message'=>'No Data found','data'=>''];
        }
    }
}
