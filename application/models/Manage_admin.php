<?php
class Manage_admin extends CI_Model{
	public function __construct(){
		ob_start();
		parent::__construct();
	}
	
	public function employeeInformation()
	{
		return $this->db->select("*")->from("admin")->order_by("id","asc")->get()->result();
	}
	
	public function employeeAdd_action($data1,$tbl1)
	{
		$this->db->insert($tbl1,$data1);
		if($this->db->affected_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}
	public function webSiteUpMembterInformation()
	{
		return $this->db->select("*")->from("tbl_upmember")->order_by("id","asc")->get()->result();
	}
	
	public function insert_query($data,$tbl)
	{
		$this->db->insert($tbl,$data);
		if($this->db->affected_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}
	public function upMemberInformation($id)
	{
		return $this->db->select("*")->from("tbl_upmember")->where('id',$id)->get()->row();
	}
	public function charimanMessageQuery()
	{
		$q=$this->db->query("select * from chairman_message order by id desc limit 1")->row();
		return $q;
	}
	/*======== union parishad section start ============*/
	
	// for all item select of a table
	public function getAllInformation($table)
	{
		$query = $this->db->select("*")->from($table)->order_by("id","DESC")->get();
		return $query->result();
	}
	
	// for widow information............
	public function widowInformation()
	{
		$data = array(
			"v.status" => 1,
			"w.status" => 1
		);
		$query = $this->db->select("v.*,w.id as wid, w.status as wstatus, w.insert_by as winsert_by, w.insert_date as winsert_date")->from("tbl_voter_list as v, tbl_widow as w")->where($data)->where('v.national_id=w.national_id')->order_by("w.id","DESC")->get()->result();
		return $query;
	}
	public function fighterInformation()
	{
		$data = array(
			"v.status" => 1,
			"f.status" => 1
		);
		$query = $this->db->select("v.*,f.id as fid, f.status as fstatus, f.insert_by as finsert_by, f.insert_date as finsert_date,f.sector_no,f.life_history")->from("tbl_voter_list as v, tbl_fighters as f")->where($data)->where('v.national_id=f.national_id')->order_by("f.id","DESC")->get()->result();
		return $query;
	}
	public function oneFighterInformation($national_id)
	{
		$query = $this->db->query("select v.bangla_name, f.id,f.national_id,f.sector_no,f.life_history from tbl_fighters as f, tbl_voter_list as v where f.national_id='$national_id' and v.national_id='$national_id'");
		return $query->row();
	}
	public function poormanInformation()
	{
		$data = array(
			"v.status" => 1,
			"p.status" => 1
		);
		$query = $this->db->select("v.*,p.id as pid, p.status as pstatus, p.insert_by as pinsert_by, p.insert_date as pinsert_date")->from("tbl_voter_list as v, tbl_poormans as p")->where($data)->where('v.national_id=p.national_id')->order_by("p.id","DESC")->get()->result();
		return $query;
	}
	public function oldmanstipendInformation()
	{
		$data = array(
			"v.status" => 1,
			"o.status" => 1
		);
		$query = $this->db->select("v.*,o.id as oid, o.status as ostatus, o.insert_by as oinsert_by, o.insert_date as oinsert_date")->from("tbl_voter_list as v, tbl_oldmanstipend as o")->where($data)->where('v.national_id=o.national_id')->order_by("o.id","DESC")->get()->result();
		return $query;
	}
	public function motherVataInformation()
	{
		$data = array(
			"v.status" => 1,
			"m.status" => 1
		);
		$query = $this->db->select("v.*,m.id as mid, m.status as mstatus, m.insert_by as minsert_by, m.insert_date as minsert_date")->from("tbl_voter_list as v, tbl_mother_vata as m")->where($data)->where('v.national_id=m.national_id')->order_by("m.id","DESC")->get()->result();
		return $query;
	}
	public function autisticInformation()
	{
		$data = array(
			"v.status" => 1,
			"a.status" => 1
		);
		$query = $this->db->select("v.*,a.id as aid, a.status as astatus, a.insert_by as ainsert_by, a.insert_date as ainsert_date")->from("tbl_voter_list as v, tbl_autistic as a")->where($data)->where('v.national_id=a.national_id')->order_by("a.id","DESC")->get()->result();
		return $query;
	}
	public function autisticStudentInformation()
	{
		$data = array(
			"v.status" => 1,
			"tas.status" => 1
		);
		$query = $this->db->select("v.*,tas.id as tasid, tas.student_name as student, tas.status as tasstatus, tas.insert_by as tasinsert_by, tas.insert_date as tasinsert_date")->from("tbl_voter_list as v, tbl_autisticstudent as tas")->where($data)->where('v.national_id=tas.national_id')->order_by("tas.id","DESC")->get()->result();
		return $query;
	}
	
	public function foreignManInformation()
	{
		$data = array(
			"v.status" => 1,
			"fo.status" => 1
		);
		$query = $this->db->select("v.*,fo.id as foid, fo.status as fostatus, fo.insert_by as foinsert_by, fo.insert_date as foinsert_date")->from("tbl_voter_list as v, tbl_foreignman as fo")->where($data)->where('v.national_id=fo.national_id')->order_by("fo.id","DESC")->get()->result();
		return $query;
	}
	public function oneVoterInformation($id)
	{
		$this->db->where("md5(id)",$id);
		$query = $this->db->get('tbl_voter_list');
		return $query->row();
	}
	/*================== end =======================*/
	
	/*============= old process section start ==============*/
	/*
	public function fighterInformation()
	{
		$query = $this->db->select("*")->from("tbl_fighters")->order_by("id","DESC")->get();
		return $query->result();
	}
	public function poormanInformation()
	{
		$query = $this->db->select("*")->from("tbl_poormans")->order_by("id","DESC")->get();
		return $query->result();
	}
	public function oldmanstipendInformation()
	{
		$query = $this->db->select("*")->from("tbl_oldmanstipend")->order_by("id","DESC")->get();
		return $query->result();
	}
	public function oneFighterInformation($id)
	{
		$this->db->where("md5(id)",$id);
		$query=$this->db->get('tbl_fighters');
		return $query->row();
	}
	public function onePoormanInformation($id)
	{
		$this->db->where("md5(id)",$id);
		$query=$this->db->get('tbl_poormans');
		return $query->row();
	}
	public function oneOldmanstipendInformation($id)
	{
		$this->db->where("md5(id)",$id);
		$query=$this->db->get('tbl_oldmanstipend');
		return $query->row();
	}
	*/
	/*============ old process section end===========*/
	
	// for admin information query......
	public function adminInformation($id)
	{
		return $this->db->select("*")->from("admin")->where('md5(id)',$id)->get()->row();
	}
	//===========mamla notice section start===================//
	public function getMamlaInfo($id){
		$query=$this->db->select('*')->from('mamla_tbl')->where('sha1(id)',$id)->order_by('id','DESC')->limit(1)->get();
		return $query->row();
		
	}
	public function badiInfo($id){
		$query=$this->db->select('*')->from('mamla_badi')->where('sha1(mamla_id)',$id)->order_by('id','DESC')->limit(5)->get();
		return $query->result();
	}
	public function bibadiInfo($id){
		$query=$this->db->select('*')->from('mamla_bibadi')->where('sha1(mamla_id)',$id)->order_by('id','DESC')->limit(5)->get();
		return $query->result();
	}
	public function barShow($date){
		$bar = date('D',strtotime($date));
		if($bar=='Sat'){
			return "শনি ";
		}
		else if($bar=='Sun'){
			return "রবি ";
		}
		else if($bar=='Mon'){
			return "সোম ";
		}
		else if($bar=='Tue'){
			return "মঙ্গল ";
		}else if($bar=='Wed'){
			return "বুধ ";
		}else if($bar=='Thu'){
			return "বৃহস্পতি ";
		}else if($bar=='Fri'){
			return "শুক্র ";
		}
		else{
			return '......';
		}
	}
	
	// for all mamla information
	public function getAllMamla(){
		return $this->db->query("SELECT * FROM mamla_tbl order by id desc")->result();
	}
	// for status 
	public function getStatus($status){
		if($status=='3'){
			return "<font style='color: red; font-weight: bolder;'>বাতিল</font>";
		}else if($status=='2'){
			return "<font style='color: green; font-weight: bolder;'>সম্পাদিত</font>";
		}else{
			return "<font style='color: blue; font-weight: bolder;'>চলমান</font>";
		}
	}
	// for sercha subject and status 
	public function getSubjectAndStatusInfo($tbl,$id){
		$this->db->where("id",$id);
		$query = $this->db->get($tbl);
		return $query->row();
	}
	//===========mamla notice section end ===================//
	// tax registration form 
	public function tax_registration_operation($receive){
		$param = [
			'rate_sheet_id'	       => (int) trim($receive['rateSheet']),
			'name'   		       => (string) trim($receive['name']),
			'fathername'		   => (string) trim($receive['fatherName']),
			'wordno'			   => (int) trim($receive['wordNo']),
			'national_id'		   => (!empty($receive['nationalId']) ? (string) trim($receive['nationalId']) : null),
			'birth_certificate_id' => (!empty($receive['birthCertificateId']) ? (string) trim($receive['birthCertificateId']) : null),
			'village'			   => (string) trim($receive['village']),
			'holding_no'		   => (string) trim($receive['holdingNumber']),
			'dag_no'			   => (string) trim($receive['dagNo']),
			'mobile_number'		   => (!empty($receive['mobileNo']) ? (string) trim($receive['mobileNo']) : null),
			'registration_date'	   => date('Y-m-d H:i:s'),
			'is_active'            => 1,
			'created_by'           => (int) $this->session->userdata('id'),
			'created_ip'           => (string) $this->input->ip_address()
		];
		
		$this->db->trans_begin();
		$this->db->insert("holdingclientinfo",$param);
		if($this->db->error()['code'] > 0){
			$error_message = $this->db->error()['message'];
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => $error_message];
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return ['status' => 'error', 'message' => 'Insert failed'];
		}
		else{
			$this->db->trans_commit();
			return ['status' => 'success', 'message' => 'Add successfully'];
		}
	}
	public function exists_holding_person($id){
		$query = $this->db->select('id')->get_where('holdingclientinfo', ['md5(id)' => $id]);
		
		if($query->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}
	public function get_holding_tax_member_info($id){
		$query = $this->db->select('info.id as id, info.name, info.fathername, info.national_id, info.birth_certificate_id, info.village, info.wordno, info.holding_no, info.dag_no, info.mobile_number, DATE_FORMAT(info.registration_date,"%Y-%m-%d %h:%i:%s %p") as registration_date, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label, label.id as label_id, rate.amount, rate.id as rate_id', false)
				->join('holding_rate_sheet as rate', 'rate.id = info.rate_sheet_id')
				->join('holding_rate_sheet_label as label', 'label.id = rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where(['info.is_active' => 1, 'md5(info.id)' => $id])
				->get('holdingclientinfo as info');
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Information found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'data'=> null];
		}
	}
	public function get_dag_no_wise_tax_person($dag_no){
		$query = $this->db->select('info.id as id, info.name, info.fathername, info.national_id, info.birth_certificate_id, info.village, info.wordno, info.holding_no, info.dag_no, info.mobile_number, DATE_FORMAT(info.registration_date,"%Y-%m-%d %h:%i:%s %p") as registration_date, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label, rate.amount', false)
				->join('holding_rate_sheet as rate', 'rate.id = info.rate_sheet_id')
				->join('holding_rate_sheet_label as label', 'label.id = rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where(['info.is_active' => 1, 'info.dag_no' => $dag_no])
				->get('holdingclientinfo as info');
				
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Information found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'data'=> null];
		}
	}
	public function get_dag_no_wise_bosotbita_history($dag_no){
		$query = $this->db->select('m.id as money_id, info.name, info.holding_no, m.trackid as dag_no, m.bno as book_number, m.m_r_n as money_receipt_number, m.inno as invoice, m.fee as payable, m.discount, m.total as pay_amount, m.payment_date, m.status, GROUP_CONCAT(log.fisyal_year_id) as year_ids, GROUP_CONCAT(log.rate_sheet_id) as rate_sheet_ids, GROUP_CONCAT(log.sub_amount) as sub_amounts, GROUP_CONCAT(year.full_year) as year_name')
					->join('money as m', 'm.inno=log.invoice')
					->join('tbl_fiscal_year as year', 'year.id=log.fisyal_year_id')
					->join('holdingclientinfo as info', 'info.dag_no=log.dag_no')
					->where(['log.dag_no' => $dag_no, 'm.status' => '4'])
					->group_by('log.invoice')
					->order_by('m.id', 'DESC')
					->get('payment_log_bosotbita as log');
					
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Information found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'data'=> null];
		}		
	}
	// holding no 
	public function get_holding_no_wise_tax_person($holding_no){
		$query = $this->db->select('info.id as id, info.name, info.fathername, info.national_id, info.birth_certificate_id, info.village, info.wordno, info.holding_no, info.dag_no, info.mobile_number, DATE_FORMAT(info.registration_date,"%Y-%m-%d %h:%i:%s %p") as registration_date, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label, label.rate_sheet_label as holding_label, occupation.title as profession, classification.title as shreni, rate.amount', false)
				->join('holding_rate_sheet as rate', 'rate.id = info.rate_sheet_id', 'LEFT')
				->join('holding_rate_sheet_label as label', 'label.id = rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where(['info.is_active' => 1, 'info.holding_no' => $holding_no])
				->get('holdingclientinfo as info');
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Information found', 'data'=> $query->row()];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'data'=> null];
		}	
	}
	// for website data show
	public function get_bosotbita_history_for_website($dag_no){
	
		$query = $this->db->select('year.full_year as fiscal_year, info.name, info.holding_no, log.dag_no, log.invoice, log.sub_amount as amount, log.payment_date')
					->join('tbl_fiscal_year as year', 'year.id=log.fisyal_year_id')
					->join('holdingclientinfo as info', 'info.dag_no=log.dag_no')
					->where(['log.dag_no' => $dag_no])
					->order_by('year.id', 'DESC')
					->get('payment_log_bosotbita as log');
					
		if($query->num_rows() > 0){
			return ['status' => 'success', 'message' => 'Information found', 'data'=> $query->result()];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'data'=> null];
		}
	}
	public function has_duplicate_book_money($book, $money){
		$query = $this->db->select('id, book_number, money_receipt')->from('payment_log_bosotbita')->where(['money_receipt' => $money, 'book_number' => $book])->get();
		
		if($query->num_rows() > 0){
			return ['status' => 'warning', 'message' => 'এই বই এর জন্য এই মানি রসিদ একবার ব্যবহার করা হয়েছে! দয়া করে মুছে আবার লিখূন'];
		}else{
			return ['status' => 'success', 'message' => 'everything is ok'];
		}
	}
}