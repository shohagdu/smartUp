<?php
	class Security_set extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		function get_all_questions()
		{
			return  $this->db->select('*')->from('dcb_security_question')->get()->result();
		}
		function curl_get($url, array $get = NULL, array $options = array()) 
		{
			$defaults = array(
				CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get), 
				CURLOPT_HEADER => 0, 
				CURLOPT_RETURNTRANSFER => TRUE, 
				CURLOPT_TIMEOUT => 10 
			); 
		
			$ch = curl_init(); 
			curl_setopt_array($ch, ($options + $defaults)); 
			if( ! $result = curl_exec($ch)) 
				{ trigger_error(curl_error($ch)); } 
			curl_close($ch); 
			return $result; 
		}
		  
		function sendSms($mobile,$message)
		{
			//get sms reseller information	
			$row=$this->db->select('*')->from('dcb_sms')->get()->row();
			//sms configuration
			$info=array(
				'user'=>$row->username,
				'pass'=>$row->pass,
				'key'=>$row->api_key,
				'mobile'=>$mobile,
				'msg'=>$message
			);
			//store sms history
			$history=array(
				'mobile'=>$mobile,
				'msg'=>$message
			);
			$this->db->insert("sms_history",$history);
			//send sms by api
			$response=$this->curl_get($row->api_url,$info);
			return $response;	
		}
		function check_exist_q(){
			$user_id=$this->session->userdata('id');
			return $this->db->select("*")->from("dcb_sq_ans")->where("user_id",$user_id)->get()->row();
		}
		
		function store_verfication_record($data)
		{
			$this->db->insert("dcb_mobile_verfication",$data);
		}	
		function find_valid_code($mobile,$code)
		{
			$para=array('mobile'=>$mobile,'code'=>$code,'status'=>'0');
			$qy=$this->db->select("*")->from("dcb_mobile_verfication")->where($para)->get()->row();
			// echo $this->db->last_query();exit;
			$status=array('status'=>'1');
			if($this->db->affected_rows()>0): $this->db->where($para)->update("dcb_mobile_verfication",$status);
			return $this->db->affected_rows();
			else: return  $this->db->affected_rows();endif;
			
		}
		function get_all_security_settings($user_id,$question_id)
		{
			return $this->db->query("SELECT q.title,q.question_id,a.ans,s.* FROM dcb_security_question q inner join dcb_sq_ans a on q.question_id=a.question_id left join dcb_security_setting s on s.user_id=a.user_id where q.question_id in($question_id) and a.user_id=$user_id order by rand() limit 1")->row();
			// $this->db->select('q.title,a.ans')
			// ->from('dcb_security_question q')
			// ->join('dcb_sq_ans a','q.question_id=a.question_id','inner')	
			// ->where_in('a.question_id',$question_id)
			// ->where('a.user_id',$user_id)
		    // ->order_by('rand()')
			// ->limit(1);
			// $result=$this->db->row();
			// echo "<pre>";
			// echo $this->db->last_query();
		    // print_r($result); exit;
			
		}
		public function get_random_img($user_id)
		{
			//SELECT SUBSTRING_INDEX(GROUP_CONCAT( id SEPARATOR ','),',',2) idshowFROM admin p;
			$data_array = array();
			$f_query = $this->db->query("SELECT id,pic FROM admin WHERE id in($user_id)")->row();
			array_push($data_array,$f_query->pic.'/'.$f_query->id);
			
			$s_query = $this->db->query("SELECT id,pic FROM admin WHERE id not in($user_id) and pic !='' order by rand() limit 2");
			$num = count($s_query->result());
			if($num==0){
				array_push($data_array,'error.jpg'.'/'.'404');
				array_push($data_array,'maci.jpg'.'/'.'405');
			}
			else if($num==1){
				array_push($data_array,$s_query->row()->pic.'/'.$s_query->row()->id);
				array_push($data_array,'error.jpg'.'/'.'404');
			}
			else{
				foreach($s_query->result() as $val){
					array_push($data_array,$val->pic.'/'.$val->id);
				}
			}
			return $data_array;
			
		}
		
	}
