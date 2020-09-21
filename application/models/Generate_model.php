<?php
	class Generate_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		// common insert query 
		public function common_insert($tablename, $data)
		{
			$this->db->insert($tablename, $data);
		}
		public function common_update_bankLedger($tbl, $col = FALSE, $col2 = FALSE, $id_number = FALSE, $total)
		{
			return $this->db->query("update $tbl set $col=$col+$total where $col2='$id_number'");
		}
		/*
		public function update_bank_balance($acno,$total)
		{
			return $this->db->query("update acinfo set balance=balance+$total where acno='$acno'");
		}
		
		public function update_fund_mainctg_balance($id,$total)
		{
			return $this->db->query("update mainctg set balance=balance+$total where id='$id'");
		}
		
		public function update_fund_subctg_balance($id,$total)
		{
			return $this->db->query("update subctg set balance=balance+$total where id='$id'");
		}*/
		// for mamla no
		public function get_mamal_no(){
			return $this->db->select("MAX(mamla_no) as mamla_no")->from("mamla_tbl")->get()->row()->mamla_no+1;
		}
		
		//get last applicat no 
		public function get_applicant_id($tbl, $col)
		{
			return $this->db->select("MAX($col) as applicant_id")->from("$tbl")->get()->row()->applicant_id+1;
		}
		
		public function get_subctg_info($key)
		{
			return $this->db->select('id,mc_id,sub_title')->from('subctg')->where('sub_title',$key)->get()->row();
		}
		public function get_fundId($mcId)
		{
			return $this->db->select('*')->from('mainctg')->where('id',$mcId)->get()->row();
		}
		// for other service information
		public function otherServiceInfo($id){
			$query = $this->db->select('id, trackid, serviceId, name, bfname, mobile, attachment, profile')->from('otherserviceinfo')->where('sha1(id)',$id)->get();
			return $query->row();
		}
	}