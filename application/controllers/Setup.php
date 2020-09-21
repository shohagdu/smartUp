<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('login_model');
		$this->load->model('Role_chk', 'chk');
		$this->load->dbutil();
		
		$logged_status=$this->session->userdata('logged_status');
		if($logged_status==FALSE){
			redirect('mms24','location');
		}
	}
	public function _remap($method, $params=array()){
		$funcs = get_class_methods($this);
		if(in_array($method, $funcs)){ // We are trying to go to a method in this class
			return call_user_func_array(array($this, $method), $params);
		}
		else{
		  show_404();
		}
	}
	
	public function index(){
		$s=$this->db->count_all("setup_tbl");
		
		if($s<=0):
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/setupForm');
			$this->load->view('admin/footer');
		 else:
			$this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/error');
			$this->load->view('admin/footer');
		endif; 
	}
	public function searchUnionCode(){
		if(isset($_GET['union_code'])){
			$union_code=$_GET['union_code'];
			$qu=$this->db->query("select union_code from setup_tbl where union_code='$union_code'");
			$num_rows=$qu->num_rows();
			if($num_rows>0){
				echo "1";exit;
			}
		}
	}
 // entry new type of message 	
 public function entry_type_messages()
 {
	    $this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/sms/type_messages');
		$this->load->view('admin/footer');
 }
	//type of sms message showing
	public function type_of_messages()
	{
		$data['row']=$this->db->select('*')->from('dcb_sms_setting')->order_by('sms_type','ASC')->get()->result();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/sms/type_of_messages',$data);
		$this->load->view('admin/footer');
	}
	//update sms type
		public function update_message_type()
	{
		if($_POST):
	    $id=$this->uri->segment(3);
	     /*================try to url encode by key============*/
		//////////////////////////////////////////////////////////
		//$decode_url=$this->encrypt->decode($encript_url,$key);//
		//echo $decode_url=$this->encrypt->decode($id,$key);//////
		/////////////////////////////////////////////////////////
		/*====================================================*/

		$input=$this->input->post(null);
		$up=$this->db->where('id',$id)->update('dcb_sms_setting',$input);
		 if($up): redirect('setup/type_of_messages','location');endif;
		else:
		$where=array('id'=>$this->uri->segment(3));
		$data['row']=$this->db->select('*')->from('dcb_sms_setting')->where($where)->get()->row();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/sms/update_message_type',$data);
		$this->load->view('admin/footer');
		endif;
	}
	
	//sms configuration
	public function sms_config()
	{
		    $data['row']=$this->db->select('*')->from('dcb_sms')->get()->row();
	        $this->load->view('admin/topBar');
			$this->load->view('admin/leftMenu');
			$this->load->view('admin/sms/sms_config',$data);
			$this->load->view('admin/footer');
	}
	public function sms_config_sub()
	{
		$input=$this->input->post(null);
		
		if($input['hid'] != ""){
			unset($input['hid']);
			$this->db->trans_start();
				$this->db->update("dcb_sms",$input);
			$this->db->trans_complete();
		
		}else{
			unset($input['hid']);
			$this->db->trans_start();
				$this->db->insert("dcb_sms",$input);
			$this->db->trans_complete();
		}
		if($this->db->trans_complete()===TRUE){
			echo "1";
		}else{
			echo "Opss! something error";
		}
	}
	//sms control setting
	public function sms_notification_setting(){
		$data['info']=$this->db->get("dcb_sms_notification")->row();
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/sms/sms_notification_setting',$data);
		$this->load->view('admin/footer');
	}
	
	function type_messages_sub()
	{
		$input=$this->input->post(null);
		$this->db->insert("dcb_sms_setting",$input);
		redirect('admin','location');
		
	}
	
	public function sms_notification_setting_sub()
	{
		extract($_POST);
	   $data['wedgets']=implode(",",$wedgets);
	    $qy=$this->db->get("dcb_sms_notification");
		if($qy->num_rows()>0):
		 $this->db->update("dcb_sms_notification",$data);
		 else:	 
	   $this->db->insert("dcb_sms_notification",$data);
	   endif;
	   redirect('admin','location');
	}
	
	
	public function setupSubmit()
	{
		extract($_POST);
		$j=0;
		foreach($_POST as $value)
		{
			if(trim($value)=='')
			{
				$j++;
			}
		}
		if($j>0)
		    {
			    echo 2;
			}
			else
			{
				$setup_data=array(
					"id"=>'',
					"full_name"=>$full_name,
					"full_name_english"=>$full_name_english,
					"gram"=>$gram,
					"thana"=>$thana,
					"district"=>$district,
					"postal_code"=>$postal_code,
					"union_code"=>$union_code,
					"upazila_code"=>$upazila_code,
					"email"=>$email,
					"mobile"=>$mobile,
					"phone"=>$phone,
					"web_link"=>$web_link
					);
				$insert=$this->db->insert("setup_tbl",$setup_data);
				if($insert)
					{
						echo 1;
					}
					else
					{
						echo 0;
					}	
				
			}	
	}
	
	public function updatesetupform(){
		$data = [
			'setup_info' => $this->login_model->get_basic_setup_configuration()
		];
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/updatesetupform', $data);
		$this->load->view('admin/footer');
	}
	public function setupUpdate()
	{
		extract($_POST);
		$s=$this->db->count_all("setup_tbl");
	
		if(isset($id) && $id != '' && $s >= 1){
			$j=0;
			foreach($_POST as $value)
			{
				if(trim($value)=='')
				{
					$j++;
					break;
				}
			}
			if($j>0){echo 2;}
			else
			{
				$unionCodeValidation = strlen($union_code);
				if($unionCodeValidation < 6 || $unionCodeValidation >= 8){
					echo "দয়া করে নির্দেশনা অনুযায়ী ইউনিয়ন কোড প্রদান করুন";exit;
				}
				if($unionCodeValidation==6){
					$union_code='0'.$union_code;
				}
				$setup_data=array(
					"full_name"			=> $full_name,
					"full_name_english"	=> $full_name_english,
					"gram"				=> $gram,
					"gram_english"		=> $gram_english,
					"thana"				=> $thana,
					"thana_english"  	=> $thana_english,
					"district"			=> $district,
					"district_english"  => $district_english,
					"postal_code"		=> $postal_code,
					"union_code"		=> $union_code,
					"upazila_code"		=> $upazila_code,
					"email"				=> $email,
					"mobile"			=> $mobile,
					"phone"				=> $phone,
					"web_link"			=> $web_link,
					'updated_by'        => (int)$this->session->userdata('id'),
					'updated_ip'        => $this->input->ip_address(),
					'updated_time'      => date('Y-m-d H:i:s')
				);
			
				$unioninfo=array(
					"union_code"=>$union_code,
					"union_name_bn"=>$full_name,
					"union_name_en"=>$full_name_english,
					"gram"=>$gram,
					"upzila_code"=>$upazila_code,
					"postal_code"=>$postal_code,
					"mobile"=>$mobile,
					"phone"=>$phone,
					"upzila_name"=>$thana,
					"email"=>$email,
					"district"=>$district,
					"setup_date"=>date('Y-m-d'),
					"web_url"=>$web_link
				);	
				// $url="http://datacenter.com.bd/centralup/index.php/Union";
				// $this->web->test_curl($url,$unioninfo);
				//$this->web->dailyHistory();
				
				$this->db->trans_start();
					$this->db->where('id',$id);
					$this->db->update("setup_tbl",$setup_data);
				$this->db->trans_complete();
				if($this->db->trans_complete()===TRUE){
					echo 1;
				}else{
					echo 0;
				}	
			}
		}else if($s <= 0){
			$j=0;
			foreach($_POST as $key => $value)
			{
				if($key=='id'){
					continue;
				}
				else{
					if(trim($value)=='')
					{
						$j++;
						break;
					}
				}
			}
			if($j>0){echo 2;}
			else
			{
				$unionCodeValidation = strlen($union_code);
				if($unionCodeValidation < 6 || $unionCodeValidation >= 8){
					echo "দয়া করে নির্দেশনা অনুযায়ী ইউনিয়ন কোড প্রদান করুন";exit;
				}
				if($unionCodeValidation==6){
					$union_code='0'.$union_code;
				}
				$setup_data=array(
					"full_name"			=> $full_name,
					"full_name_english"	=> $full_name_english,
					"gram"				=> $gram,
					"gram_english"		=> $gram_english,
					"thana"				=> $thana,
					"thana_english"  	=> $thana_english,
					"district"			=> $district,
					"district_english"  => $district_english,
					"postal_code"		=> $postal_code,
					"union_code"		=> $union_code,
					"upazila_code"		=> $upazila_code,
					"email"				=> $email,
					"mobile"			=> $mobile,
					"phone"				=> $phone,
					"web_link"			=> $web_link,
					'created_by'        => (int)$this->session->userdata('id'),
					'created_ip'        => $this->input->ip_address(),
					'created_time'      => date('Y-m-d H:i:s')
				);
				$unioninfo=array(
					"union_code"	=> $union_code,
					"union_name_bn"	=> $full_name,
					"union_name_en"	=> $full_name_english,
					"gram"			=> $gram,
					"upzila_code"	=> $upazila_code,
					"postal_code"	=> $postal_code,
					"mobile"		=> $mobile,
					"phone"			=> $phone,
					"upzila_name"	=> $thana,
					"email"			=> $email,
					"district"		=> $district,
					"setup_date"	=> date('Y-m-d'),
					"web_url"		=> $web_link
				);	
				// $url="http://datacenter.com.bd/centralup/index.php/Union";
				// $this->web->test_curl($url,$unioninfo);
				//$this->web->dailyHistory();
				
				$this->db->trans_start();
					$this->db->insert("setup_tbl",$setup_data);
				$this->db->trans_complete();
				if($this->db->trans_complete()===TRUE){
					echo 1;
				}else{
					echo 0;
				}
			}
		}
		else{
			echo "already setup or setup problem!!!!!!";
		}
	}
}
