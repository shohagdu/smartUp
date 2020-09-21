<?php
	class Money_receipt_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		/*============== nagorick money receipt start ===============*/
		
		// for nagorick fee and total amount......
		public function moneyrecptInfo($id)
		{
			$query=$this->db->select('fee,total')->from('money')->where('sha1(trackid)',$id)->order_by('id','DESC')->limit(1)->get();
			return $query->row();
		}
		// for nagorick information.........
		public function nagorickInfo($trackid)
		{
			$query=$this->db->select('*')->from('personalinfo')->where('sha1(trackid)',$trackid)->get();
			return $nrow=$query->row();			
		}
		//money receipt for date........
		public function nagorickDate($trackid)
		{
			$query=$this->db->select('*')->from('money')->where('sha1(trackid)',$trackid)->get();
			return $mrow=$query->row();
		}
		
		/*============== nagorick money receipt end ==================*/
		
		/*============== tradelicense money receipt start ==================*/
		
		// for tradelicense information .............
		
		public function tradelicenseInfo($id)
		{
			$query=$this->db->select('*')->from('tradelicense')->where('sha1(trackid)',$id)->get();
			return $nrow=$query->row();
		}
		// for tradelicense taka releted query........
		
		public function tradeTakaInfo($id)
		{
			$lQy=$this->db->select('*')->from('getlicense')->where('sha1(trackid)',$id)->order_by('id','DESC')->limit(1)->get();
			return $lrow=$lQy->row();	
		}
		
		// for tab tradelicense taka releted query.......
		public function tabTradeTakaInfo($vno)
		{
			$lQy=$this->db->select('*')->from('getlicense')->where('vno',$vno)->order_by('id','DESC')->limit(1)->get();
			return $lrow=$lQy->row();
		}
		
		/*============== tradelicense money receipt end  ==================*/
		
		/*============== tab all roshid query start  ===================*/
		
		//default tab tradelicense roshid query......
		public function tabtradelicense()
		{
			$qy=$this->db->query("select tradelicense.id,tradelicense.bcomname,getlicense.payment_date,tradelicense.sno,getlicense.vno,getlicense.total,tradelicense.trackid from tradelicense right join getlicense on tradelicense.trackid=getlicense.trackid order by date(getlicense.payment_date) DESC");
			return $qy->result();
		}
		// for tab bosodbita kor.......
		public function tabbosodbitakor()
		{
			$query = $this->db->select('m.id as money_id, info.name, info.holding_no, m.trackid as dag_no, m.bno as book_number, m.m_r_n as money_receipt_number, m.inno as invoice, m.fee as payable, m.discount, m.total as pay_amount, m.payment_date, m.status, GROUP_CONCAT(log.fisyal_year_id) as year_ids, GROUP_CONCAT(log.rate_sheet_id) as rate_sheet_ids, GROUP_CONCAT(log.sub_amount) as sub_amounts, GROUP_CONCAT(year.full_year) as year_name')
					->join('money as m', 'm.inno=log.invoice')
					->join('tbl_fiscal_year as year', 'year.id=log.fisyal_year_id')
					->join('holdingclientinfo as info', 'info.dag_no=log.dag_no')
					->where(['m.status' => '4'])
					->group_by('log.invoice')
					->order_by('m.id', 'DESC')
					->get('payment_log_bosotbita as log');
					
			if($query->num_rows() > 0){
				return ['status' => 'success', 'message' => 'Information found', 'data'=> $query->result()];
			}else{
				return ['status' => 'error', 'message' => 'Information not found', 'data'=> null];
			}
		}
		// for tab peshajibi kor.... 
		public function tabpeshajibikor()
		{
			$qy=$this->db->query("select trackid,payment_date,inno,fee,id from money where status=3  order by payment_date DESC");
			return $qy->result();
		}
		// for tab dailycollection ....
		public function tabdailycollection()
		{
			$qy=$this->db->query("select * from dailycollection  order by payment_date DESC");
			return $qy->result();
		}
		// for tab trade license bosodbita kor......
		public function tabtrade_bosodbitakor()
		{
			$qy=$this->db->query("select trackid,payment_date,inno,fee,id from money where status=2   order by payment_date DESC");
			return $qy->result();
		}
		//for tab nagorick.......
		public function tabnagoriksonod()
		{
			$qy=$this->db->query("select p.name,p.sonodno,m.trackid,payment_date,inno,fee from money m inner join personalinfo p on p.trackid=m.trackid where m.status=5 order by m.payment_date DESC");
			return $qy->result();
		}
		// for tab warish..........
		public function tabwarishsonod()
		{
			$qy=$this->db->query("select w.bname,w.sonodno,m.trackid,payment_date,inno,fee from money m inner join tbl_warishesinfo w on w.trackid=m.trackid where m.status=6 order by m.payment_date DESC");
			return $qy->result();
		}
		/*============== tab all roshid query end  ===================*/
		
		/*========= bosodbita kor money receipt query start===========*/
		public function holding_client_info($dno, $vno)
		{
			$query = $this->db->select('info.id as info_id, info.name, info.fathername, info.national_id, info.birth_certificate_id, info.village, info.wordno, info.holding_no, info.dag_no, info.mobile_number, info.registration_date, money.bno, money.m_r_n, money.inno, money.fee, money.discount, money.total, money.fiscal_year_id, money.rate_sheet_id, money.rate_sheet_amount, money.payment_date, money.status')
					->join('money', "money.trackid = info.dag_no and money.inno=$vno")
					->order_by('money.id', 'DESC')
					->limit('1')
					->get_where('holdingclientinfo as info', ['dag_no' => $dno]);
					
			return $query->row();
		}
		public function get_fiscal_year_wise_payment_log($dno, $vno){
			$query = $this->db->select('payment.invoice, payment.dag_no, payment.book_number, payment.money_receipt, payment.fisyal_year_id, year.full_year, payment.rate_sheet_id, level.rate_sheet_label, payment.sub_amount')
					->join('tbl_fiscal_year as year', 'year.id=payment.fisyal_year_id')
					->join('holding_rate_sheet as rate', 'rate.id=payment.rate_sheet_id')
					->join('holding_rate_sheet_label as level','level.id=rate.label_id')
					->order_by('payment.id', 'DESC')
					->get_where('payment_log_bosotbita as payment', ['payment.dag_no' => $dno, 'payment.invoice' => $vno]);
					
			return $query->result();
		}
		public function holding_client_money($id)
		{
			$qy=$this->db->select('*')->from('money')->where('id',$id)->get();
			return $row=$qy->row();
		}
		public function session_holding_client_money($holdingNo)
		{
			$qy=$this->db->select('*')->from('money')->where('trackid',$holdingNo)->order_by('id','DESC')->limit('1')->get();
			return $row=$qy->row();
		}
		/*======== bosodbita kor money receipt query end=============*/
		
		/*======== pesha money receipt query start=================*/
		public function pesh_money_info($trackid)
		{
			$query=$this->db->select('*')->from('tradelicense')->where('trackid',$trackid)->get();
			return $nrow=$query->row();
		}
		public function pesh_money_money($id)
		{
			$qy=$this->db->select('*')->from('money')->where('id',$id)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		public function session_pesh_money_money($id)
		{
			$qy=$this->db->select('*')->from('money')->where('trackid',$id)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		/*======== pesha money receipt query end ==================*/
		
		/* ======= trade bosodbita kor money receipt query start =======*/
		public function tradebosodbitaMoneyInfo($id)
		{
			$qy=$this->db->select('*')->from('money')->where('id',$id)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		public function tradebosodbitaInfo($trackid)
		{
			$query=$this->db->select('*')->from('tradelicense')->where('trackid',$trackid)->get();
			return $nrow=$query->row();
		}
		
		public function tradebosodbitaMoney_sesion($id)
		{
			$qy=$this->db->select('*')->from('money')->where('trackid',$id)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		/* ======= trade bosodbita kor money receipt query end =======*/
		
		/* ============= daily collection query start ==============*/
		
		public function dailyCollectionInfo($id)
		{
			$qy=$this->db->select('*')->from('dailycollection')->where('md5(id)',$id)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		public function dailyCollectionInfo_session($vno)
		{
			$qy=$this->db->select('*')->from('dailycollection')->where('voucherno',$vno)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		/* ========= dalily collection query end================*/
		
		// update by shohag 20.03.2016
		public function tabdailyExpense(){
			$qy=$this->db->query("select * from dailyexp  order by payment_date DESC");
			return $qy->result();
		}
		public function dailyExpenseInfo($id){
			$qy=$this->db->select('*')->from('dailyexp')->where('md5(id)',$id)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		public function dailyExpenseInfo_session($vno){
			$qy=$this->db->select('*')->from('dailyexp')->where('voucherno',$vno)->order_by('id','DESC')->get();
			return $row=$qy->row();
		}
		
		/*============== other service money receipt start ===============*/
		
		// for nagorick fee and total amount......
		public function otherServicemoneyrecptInfo($id)
		{
			$query=$this->db->select('fee,total')->from('money')->where('sha1(trackid)',$id)->order_by('id','DESC')->limit(1)->get();
			return $query->row();
		}
		// for nagorick information.........
		public function otherServiceInfoM($trackid)
		{
			$query=$this->db->select('*')->from('otherserviceinfo')->where('sha1(trackid)',$trackid)->get();
			return $nrow=$query->row();			
		}
		//money receipt for date........
		public function otherServiceDate($trackid)
		{
			$query=$this->db->select('*')->from('money')->where('sha1(trackid)',$trackid)->get();
			return $mrow=$query->row();
		}
		
		/*============== other service  money receipt end ==================*/

		public function serviceNameShow($id){
			$query = $this->db->select("listName")->from("otherservicelist")->where("id",$id)->get()->row();
			return $query;
		}
	}