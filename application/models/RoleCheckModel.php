<?php
	class RoleCheckModel extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		
		function mainCheck($id){
			$udata = array( "id" => $id );
			$info = $this->db->get_where("admin",$udata)->row();
			
			$rdata = array( "role_id" => $info->role_id );
			$roleData = $this->db->get_where("acl",$rdata)->row();
			
			$widget = explode(",",$roleData->widget);
			
			$currentMethod = $this->router->fetch_method();
			
			if( in_array($currentMethod,$widget) ):
				return true;
			else:
				return false;
			endif;
		}
	}