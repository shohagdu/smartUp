<?php
	class Certificate_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		/*=========== nagorick certificate start=============*/
		
		// for nagorick all Information bangla and english
		public function nagorickInfo($id)
		{
			$query=$this->db->select('*')->from('personalinfo')->where('sha1(trackid)',$id)->get();
			return $query->row();
		}
		// for serial and date bangla and english
		public function nagorick_serial_date($id)
		{
			$qD=$this->db->select('*')->from('porichoprotro')->where('sha1(trackid)',$id)->get();
			return $row_D=$qD->row();
		}
		/*=========== nagorick certificate end ==============*/
		
		/*=========== other service certificate start=============*/
		
		// for other service all Information bangla and english
		public function otherServiceInfoM($id)
		{
			$query=$this->db->select('*')->from('otherserviceinfo')->where('sha1(trackid)',$id)->get();
			return $query->row();
		}
		// for serial and date bangla and english
		public function otherService_serial_date($id)
		{
			$qD=$this->db->select('*')->from('onnanoseba')->where('sha1(trackid)',$id)->get();
			return $row_D=$qD->row();
		}
		/*=========== otherServie  certificate end ==============*/
		
		
		/*=========== tradelicense certificate start =========*/
		
		// for tradelicense all information bangla and english
		public function tradelicnseInfo($id)
		{
			$query=$this->db->select('*')->from('tradelicense')->where('sha1(trackid)',$id)->get();
			return $row=$query->row();
		}
		// for tradelicense taka related query  bangla and english
		public function tradelicenseTaka($id)
		{
			$lQy=$this->db->select('*')->from('getlicense')->where('sha1(trackid)',$id)->order_by('id','DESC')->limit(1)->get();
			return $lrow=$lQy->row();
		}
		/*========== tradelicense certificate end ===========*/
		
		/* ========== warish certificate start ==============*/
		
		// for warish all information bangla and english
		public function warishInformation($id)
		{
			$qY=$this->db->select('*')->from('tbl_warishesinfo')->where('sha1(trackid)',$id)->get();
			return $row=$qY->row();
		}
		// for warish date, money ,serial query 
		public function warishMoney($id)
		{
			$wMoney=$this->db->select('*')->from('tbl_wcc')->where('sha1(trackid)',$id)->get();
			return $mrow=$wMoney->row();
		}
		// for warish list information....
		public function warishList($id)
		{
			$wQy=$this->db->select('*')->from('warishinfo')->where('sha1(trackid)',$id)->get();
			return $wQy->result();
		}
		
		/* ========== warish certificate end ===============*/
		
		public function serviceNameShow($id){
			$query = $this->db->select("listName")->from("otherservicelist")->where("id",$id)->get()->row();
			return $query;
		}
	}