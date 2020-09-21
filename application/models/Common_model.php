<?php
	class Common_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		public function genaret_trackid()
		{
			$num= $this->randint(6);
			$check_num = $this->test_unique_number($num,'tbl_tracking','trackid');
			if($check_num==false){
				$this->genaret_trackid();
			}
			else{
				return $num;
			}
		}
		public function genarate_sno()
		{
			$cyear=date('Y');
			$sonod=$this->genSonod($cyear);
			$check_num = $this->test_unique_number($sonod,'up_sonods','sno');
			if($check_num==false){
				$this->genarate_sno();
			}
			else{
				return $sonod;
			}
		}
		
		public function test_unique_number($testnum,$tbl,$colum){
			$tQy=$this->db->select($colum)->from($tbl)->where($colum,$testnum)->order_by('id','DESC')->limit('1')->get();
			if($this->db->affected_rows()>0){
				return false;
			}
			else{
				return true;
			}
		}
		public function genSonod($year)
		{
			$union_code=$this->db->select("union_code")->from("setup_tbl")->get()->row()->union_code;
			$random_digit=$this->randint(6);
			return $data=$year.$union_code.$random_digit;
		}
		public function randint($length)
		{
			$valid_chars="1234567890";
			$random_string = "";
			$num_valid_chars = strlen($valid_chars);
			for ($i = 0; $i < $length; $i++)
			{
				$random_pick = mt_rand(1, $num_valid_chars);
				$random_char = $valid_chars[$random_pick-1];
				$random_string .= $random_char;
			}
			return $random_string;
		}
		//===========License Serial Ke====
		/*======================*****===*/
		public function license_key($x)
		{
				if(strlen($x)<=1){
					return '00000'.$x;
				}
				else if(strlen($x)<=2){
					return '0000'.$x;
				}
				else if(strlen($x)<=3){
					return '000'.$x;
				}
				else if(strlen($x)<=4){
					return '00'.$x;
				}
				else if(strlen($x)<=5){
					return '0'.$x;
				}
				else if(strlen($x)<=6){
					return $x;
				}
		}
		// License no generate only for dania union
		public function daniaup_genSonod($current_year,$book_no)
		{
			$union_code=$this->db->select("union_code")->from("setup_tbl")->get()->row()->union_code;
			$serial=$this->license_key($book_no);
			return $data=$current_year.$union_code.$serial;
		}
		// for other service name show..
		public function serviceNameShow($id){
			$query = $this->db->select("listName")->from("otherservicelist")->where("id",$id)->get()->row();
			return $query;
		}
		public function check_is_clear_holding_tax($data){
			if(isset($data['sha_trackid'])){
				$query = $this->db->get_where($data['target_table'], ['sha1(trackid)' => $data['sha_trackid']]);
			}
			if($query->num_rows() < 1){
				return ['status' => 'error', 'message' => 'Something went wrong. Holding number not found. Kindly update holding number.', 'data' => []];
			}
			$holding_no = $query->row()->holding_no;
			if(empty($holding_no)){
				return ['status' => 'error', 'message' => 'Something went wrong. Holding number not found. Kindly update holding number.', 'data' => []];
			}
			
			$result = $this->db->select("payment.id as p_id, payment.invoice, payment.holding_no, payment.dag_no, payment.sub_amount, payment.payment_date, year.id as y_id")
				->join("tbl_fiscal_year as year", "year.id=payment.fisyal_year_id", "INNER")
				->get_where("payment_log_bosotbita as payment", [
					'payment.holding_no' => (int)$holding_no,
					'year.is_current' => 1
				]);
			if($result->num_rows() < 1){
				return ['status' => 'error', 'message' => 'Oops! You are not eligible for operation. At first pay your current year holding tax.', 'data' => []];
			}
			return ['status' => 'success', 'message' => 'Eligible for Operation.', 'data' => $result->row()];
		}
	}