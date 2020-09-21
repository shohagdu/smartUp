<?php
class License_check extends CI_Model {
   
	public function index(){
		return false;
	}

function main_license_check(){
	$check_license = $this->check_offline_database();	// database check if 													//	registration.
		
		if( $check_license ):
			$check_registration = $this->registration();	//check online data

			if( $check_registration ):
				$validity = $this->validity();
				
				if( $validity ):	// valid
					return 0;
				else:				// expired
					return 1;
					
				endif;
			
			else:
				return 2;
				
			endif;

		else:
			return 2;
		endif;
}
	// chcek off-line database exits or not ?
	function check_offline_database(){
		$db = $this->db->database;
		$db_prefix = $this->db->dbprefix;

		$tbl1 = 'SELECT count(*) as ft FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA ="'.$db.'" AND TABLE_NAME = "'.$db_prefix.'app_list"';
		$tbl2 = 'SELECT count(*) as st FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA ="'.$db.'" AND TABLE_NAME = "'.$db_prefix.'app_validation"';

		$q1 = $this->db->query($tbl1)->row()->ft;
		$this->db->last_query();
		$q2 = $this->db->query($tbl2)->row()->st;
		
		if( $q1 && $q2 ):
			return true;
		else:
			return false;
		endif;
		// return $query = $this->db->query($sql.$tbl)->result();
	}

	// check app registration

	function registration(){
		//$mac = $this->pc_mac_address();
			
		//$data = array( "app_mac" => $mac );

		$count = $this->db->get("app_list")->num_rows();
	
		if($count):
			return true;
		else:
			return false;
		endif;
	}

	// new application registration
	function save_data( $data ){
		$patch = "new_app_registration";

		$data = $this->encrypt->decode( $data,$patch );


		$regis_info = explode("+", $data);

		$mac = 'Online Registration';
		$app_id = date("Y")+date("m")+date("d")+date("H")+date("i")+date("s");

		$db_prefix = $this->db->dbprefix;

		$tbl1 = 'CREATE TABLE IF NOT EXISTS `'.$db_prefix.'app_list` (
				  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				  `app_id` int(11) NOT NULL,
				  `app_mac` varchar(30) NOT NULL,
				  `app_name` varchar(150) NOT NULL,
				  `user_name` varchar(100) NOT NULL,
				  `address` varchar(200) NOT NULL,
				  `registered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8';
		
		$Query = $this->db->query($tbl1);

		$data = array(
				"id" 		=> '',
				"app_id" 	=> $app_id,
				"app_mac"   => $mac,
				"app_name"  => $regis_info[0],
				"user_name" => $regis_info[1],
				"address"   => $regis_info[2]
			);

		$this->db->insert("app_list",$data);
		$lis = $this->license_data_update( $mac );

		if( $this->db->affected_rows() && $lis ):
			return true;
		else:
			return false;
		endif;

	}

	// license key data update
	function license_data_update( $mac ){
		// take information
		$get_data = $this->db->select("*")->from( "app_list" )->order_by("id","DESC")->limit(1)->get()->row();
		// make license information
		$key = $get_data->app_id.'+'.$mac.'+'.date("Y-m-d").'+'.'30';
		$lis_key = $this->encrypt->encode( $key,$get_data->app_id );
		$pc_name = getenv("username");
		$ip = $this->input->ip_address();

		// database information make or save
		$db_prefix = $this->db->dbprefix;
		$tbl2 = 'CREATE TABLE IF NOT EXISTS `'.$db_prefix.'app_validation` (
				  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				  `app_id` int(11) NOT NULL,
				  `license_key` varchar(500) NOT NULL,
				  `duration` int(11) NOT NULL,
				  `pc_user` varchar(80) NOT NULL,
				  `ip` varchar(30) NOT NULL,
				  `license_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
				) ENGINE=InnoDB DEFAULT CHARSET=utf8';
		
		$Query = $this->db->query($tbl2);

		// updating data
		$up = array(
				"id" 		   => '',
				"app_id"       => $get_data->app_id,
				"license_key"  => $lis_key,
				"duration"     => 30,
				"pc_user"	   => $pc_name,
				"ip"		   => $ip,
				"license_date" => date("Y-m-d")
			);

		$ins = $this->db->insert( "app_validation",$up );
		
		if( $this->db->affected_rows() ):
			return true;
		else:
			return false;
		endif;

	}

	// registration information
	function get_regis_data(){
		return $this->db->select("*")->from("app_list")->order_by("id","DESC")->limit(1)->get()->row();
	}

	// license information
	function get_license_info( $pid ){
		return $this->db->select("*")->from("app_validation")->where("app_id",$pid)->order_by("id","DESC")->limit(1)->get()->row();
	}

	// check license validity
	function validity(){
		$product_id = $this->get_regis_data();
		$license_info = $this->get_license_info( $product_id->app_id );

		$today = date("Y-m-d");
		$valid = $this->make_expired_date( $license_info->license_date,$license_info->duration );
		return $check = $this->check_validity( $valid );

	}

	function make_expired_date( $start,$duration ){
		
		$cd = strtotime($start);
		$newdate = date('Y-m-d',mktime(0,0,0,date('m',$cd),date('d',$cd)+$duration,date('Y',$cd)));
		return $newdate;
	}

// expired date calculation
	function check_validity( $expire_date ){
        return true;
		$today = date_create(date("Y-m-d"));
		$end = date_create($expire_date);

		$diff = date_diff($today,$end);
		
		if($diff->invert):
			return false; // expired
		else:
			return true; // valid
		endif;
	}

	// key validation
	function key_validity( $mac,$pid,$date ){
		$data = array(
				"app_id"  => $pid,
				"app_mac" => $mac
			);
		$data_exit = $this->db->get_where("app_list",$data)->num_rows();

		if($data_exit):
			$kvalid = $this->check_validity( $date );

			if($kvalid):
				return true;
			else:
				return false;
			endif;

		else:
			return false;
		endif;

	}

// save license key
	function save_key_info( $pid,$key,$duration,$lis_date ){
		$pc_name = getenv("username");
		$ip = $this->input->ip_address();

		// updating data
		$up = array(
				"id" 		   => '',
				"app_id"       => $pid,
				"license_key"  => $key,
				"duration"     => $duration,
				"pc_user"	   => $pc_name,
				"ip"		   => $ip,
				"license_date" => $lis_date
			);

		$ins = $this->db->insert( "app_validation",$up );
		
		if( $this->db->affected_rows() ):
			return true;
		else:
			return false;
		endif;
	}

// if license file exits or not ?
	function file_info(){
		$dest = "c:\\Administrator/system/system.tpl";
		if( is_file($dest) ):
			return true;
		else:
			return false;
		endif;
	}

// test license file information
	function file_validity(){
		$mac = $this->app_license->pc_mac_address();
		$pid = $this->get_regis_data();

		$dest = "c:\\Administrator/system/system.json";
		$dest2 = "c:\\Administrator/system/system.tpl";
		//$f= file_get_contents($dest);
		
		rename($dest2, $dest);
		$val = file_get_contents($dest);
		rename($dest, $dest2);

		$val = json_decode($val,true);	
		$make_key = $this->encrypt->decode($val['key'],$pid->app_id);
		$mk_exp = explode("+", $make_key);

		$check_file_to_database = $this->key_validity( $mk_exp[1],$mk_exp[0] );

		if( $check_file_to_database ):
			$mk_exp_date = $this->make_expired_date( $mk_exp[2],$mk_exp[3] );
			$valid = $this->check_validity( $mk_exp_date );
		
			if( $valid ):
				return true;
			else:
				return false;
			endif;
		else:
			return false;
		endif;

	}

}

?>