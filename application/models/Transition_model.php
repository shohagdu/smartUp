<?php
	class Transition_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		//get last transaction no 
		public function get_transaction()
		{
			return $this->db->select("MAX(tid) as tid")->from("transaction")->get()->row()->tid+1;
		}
		
		// get last credit voucer no...
		public function get_credit_voucher()
		{
			return $this->db->select("MAX(vno) as vno")->from("credit_voucher")->get()->row()->vno+1;
		}
		// get last debit voucer no...
		public function get_debit_voucher()
		{
			return $this->db->select("MAX(vno) as vno")->from("debit_voucher")->get()->row()->vno+1;
		}
		// last balance main account..
		public function get_account_last_balance($acno)
		{
			return $this->db->select("balance")->from("acinfo")->where("acno",$acno)->get()->row();
		}
		//get fund sub category last balance delete hobe ...
		public function get_fund_sub_category_last_balance($id)
		{
			return $this->db->select("balance")->from("subctg")->where("id",$id)->get()->row();
		}
		
	}