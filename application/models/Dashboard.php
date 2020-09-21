<?php
	class Dashboard extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		//full table search korte
		public function getdata($tbl){
			$query = $this->db->query("select * from $tbl")->result();
			return $query;
		}
		
		// sms search
		public function sms_query(){
			$contSms=$this->db->query("select count(id) as count_sms from inbox")->row();
			return $contSms;
		}
		
		// new nagorick count 
		public function newNagorik(){
			$qy=$this->db->query("select count(*) as total from personalinfo where sonodno is null AND status='0' order by id desc");
			$row=$qy->row();
			return $row->total;
		}
		// generat nagorick count
		public function CompleteNagorik(){
			$qy=$this->db->query("select count(*) as total from personalinfo where status='1' AND sonodno!='' order by id desc");
			$row=$qy->row();
			return $row->total;
		}
		//new tradelicense count 
		public function newTradelicense(){
			$qy=$this->db->query("select count(*) as total from tradelicense where sno is null AND status='1'");
			$row=$qy->row();
			return $row->total;
		}
		//  generat tradelicense count 
		public function genTradelicense(){
			$cDate=date("Y-m-d");
			$qy=$this->db->query("select count(*) as total from tradelicense where sno!='' AND status='2' AND expire_date >='$cDate' and expire_date!='0000-00-00'");
			$row=$qy->row();
			return $row->total;
		}
		// expire tradelicense count
		public function expireLicense()
		{
			$cdate=date("Y-m-d");
			$qy=$this->db->query("select count(*) as total from tradelicense where expire_date < '$cdate' and expire_date!='0000-00-00' and status='2'");
			$row=$qy->row();
			return $row->total;
		}
		 // renew applicant count 
		public function renew_app()
		{
			$qy=$this->db->query("select count(*) as total from renew_req where status='1'");
			$row=$qy->row();
			return $row->total;
		}
		// new warish count 
		public function newWarish()
		{
			$qy=$this->db->query("select count(*) as total from tbl_warishesinfo where sonodno is null AND status='0' order by id desc");
			$row=$qy->row();
			return $row->total;
		}
		// generat warish count 
		public function CompleteWarish()
		{
			$qy=$this->db->query("select count(*) as total from tbl_warishesinfo where status='1' AND sonodno!='' order by id desc");
			$row=$qy->row();
			return $row->total;
		}
	}