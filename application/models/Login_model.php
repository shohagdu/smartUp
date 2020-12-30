<?php
	class Login_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		public function loginInfo($username,$password){
			if(trim($username)=='' || trim($password)==''){
				redirect('mms24?sk=empty','location');
			}
			$password = md5($password);
			$query=$this->db->query("SELECT id,username,fullname,mobile,email,security_setting,verify_mobile,verify_email,question_id,MD5(UNIX_TIMESTAMP() + id +RAND(UNIX_TIMESTAMP())) sid FROM admin WHERE username='$username' AND pass='$password'");
		//	return $this->db->last_query();

			$login=$query->num_rows();
			if($login!='1'){
				redirect('mms24?sk=invalid','location');
			}
			if($login=='1'){
				$row=$query->row();
				
				$device_browser = $this->get_agent();
				$ip = $this->input->ip_address();
				//$mac = $this->pc_mac_address();
				$login_time = date("Y-m-d H:i:s");
				$login_history= array(
					'user_id'			=>	$row->id,
					'device_browser	'	=>	$device_browser,
					'pc_ip'				=>	$ip,
					'mac'				=>	'mac',
					'login_time'		=>	$login_time
				);
				$this->db->insert("dcb_login_history",$login_history);
				$log_id = $this->db->insert_id();
				$data=array(
					'id'=>$row->id,
					'username'=>$row->username,
					'fullname'=>$row->fullname,
					'mobile'=>$row->mobile,
					'verify_mobile'=>$row->verify_mobile,
					'verify_email'=>$row->verify_email,
					'question_id'=>$row->question_id,
					'email'=>$row->email,
					'sid'=>$row->sid,
					'log_id'=>$log_id
					//'logged_status'=>TRUE
				);


				$this->session->set_userdata($data);
				if($row->security_setting=='1' && $row->verify_mobile=='1' && strlen($row->question_id)>2){
					redirect('Security','location');
				}
				elseif($row->security_setting=='1' && $row->verify_mobile=='0'){
					$status = array("logged_status" => TRUE);
					$this->session->set_userdata($status);
					$url='Manage/employeeManageUpdate?id='.md5($row->id);
				}
				elseif($row->security_setting=='0'){
					$status = array("logged_status" => TRUE);
					$this->session->set_userdata($status);
					$url='Security/security_setup';
				}
				else{
					$status = array("logged_status" => TRUE);
					$this->session->set_userdata($status);
					$url='Admin';
				}
				
				$dataMMS=array(
					'sid'=>$row->sid,
					'status'=>'1'
				);
				$update=$this->db->where('id',$row->id)->update('admin',$dataMMS);
				if($update){
					redirect($url,'location');
				}
			}
		}
		public function get_basic_setup_configuration(){
			return $this->db->select('*')->from('setup_tbl')->limit(1)->get()->row();
		}
		public function get_agent()
		{
			if ($this->agent->is_browser())
			{
				$agent = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot())
			{
				$agent = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile())
			{
				$agent = $this->agent->mobile();
			}
			else
			{
				$agent = 'Undefined';
			}
			return $agent;
		}
		
	}
