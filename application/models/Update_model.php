<?php
	class Update_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		public function nagorickInformation($id)
		{
			$qY=$this->db->query("select * from personalinfo where md5(id)='$id' limit 1");
			return $row=$qY->row();
		}
		public function otherServiceInformation($id)
		{
			$qY=$this->db->query("select * from otherserviceinfo where md5(id)='$id' limit 1");
			return $row=$qY->row();
		}
		public function tradelicenseInformation($id)
		{
			$qY=$this->db->query("select * from tradelicense where md5(id)='$id' limit 1");
			return $row=$qY->row();
		}
		public function warishInformation($id)
		{
			$qY=$this->db->query("select * from tbl_warishesinfo where md5(id)='$id' limit 1");
			return $row=$qY->row();
		}
		public function sub_warish_list($trackid)
		{
			$wQy = $this->db->select('*')->from('warishinfo')->where('trackid',$trackid)->get();
			return $wQy->result();
		}
	}