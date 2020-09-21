<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Role_chk extends CI_Model {

	public function __construct()
	{
	
	}
 	public function acl($pram){
		 
		 $uid=$this->session->userdata('id');
		 $udata = array( "id" => $uid );
		 $rid = $this->db->get_where("admin",$udata)->row();
		 
		 $query=$this->db->query("SELECT * FROM acl WHERE role_id='$rid->role_id' LIMIT 1");
		 $r=$query->row();
	

		 $gets=explode(',',$r->widget);
		 if (!in_array($pram, $gets)) {
		 			 echo 'onclick="alert(\'দুঃখিত !!! আপনার এই লিংক দেখার জন্য অনুমতি নেই। \');return false;"';
		
 			}
 		}


 		public function acl_url($pram){
 			$role_id=$this->session->userdata('role_id');
		 $query=$this->db->query("SELECT * FROM acl WHERE role_id='$role_id' LIMIT 1");
		 $r=$query->row();
	

		 $gets=explode(',',$r->widget);
		 if (!in_array($pram, $gets)) {
		 	
		 	echo '<script>alert("Sorry !!! You have no permission to access this page.");window.history.back();</script>';
		 	exit;
		 }

 		}

    }
