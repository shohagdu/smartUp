<?php
class Website extends CI_Model {

   function _construct()
    {
          parent::_construct();
    }
	
	//send sms
	public function smsSendNew($mobile,$message)
	{
	    
		//get sms reseller information	
		$row=$this->db->select('*')->from('dcb_sms')->get()->row();
		
		//sms configuration
		$info=array(
			'user'	=> $row->username,
			'pass'	=> $row->pass,
			'key'	=> $row->api_key,
			'mobile'=> $mobile,
			'msg'	=> $message
		);
	  
		//store sms history
		$history=array(
			'mobile'	=> $mobile,
			'msg'		=> $message
		);
	 
		$this->db->insert("dcb_sms_history",$history);

		$response=$this->curl_get($row->api_url,$info);
		return $response;
		// var_dump($response);exit;
		// $qu=$this->db->query("select * from api_setup order by id desc limit 1")->row();
		//	$api=$qu->api;
        
        // Register your ip first. To do that, contact bpl personnel
       /* $url = 'http://powersms.banglaphone.net.bd/httpapi/sendsms';
                $fields = array(
					'userId' => urlencode('sozibdcb'),
					'password' => urlencode('Linkon@787'),
					'smsText' => urlencode('This is a sample sms text.'),
					'commaSeperatedReceiverNumbers' => '01825292980'
				);
        foreach($fields as $key=>$value){ 
        	$fields_string .= $key.'='.$value.'&'; 
        }
        
        rtrim($fields_string, '&');
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        
        // If you have proxy
        // $proxy = '<proxy-ip>:<proxy-port>';
        // curl_setopt($ch, CURLOPT_PROXY, $proxy);
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($ch);
        
        if($result === false)
        {    
        	echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
        	return;
        }
        
        $json_result = json_decode($result);
        var_dump($json_result);
        
        if($json_result->isError){
        	echo sprintf("<p style='color:red'>ERROR: <span style='font-weight:bold;'>%s</span></p>", $json_result->message);
        }
        else{
        	echo sprintf("<p style='color:green;'>SUCCESS!</p>");
        }
        
        curl_close($ch);
        return  true;
	  */
	}
	public function curl_get($url, array $get = NULL, array $options = array()) 
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
	//calculation budget current year
    public function get_current_budget_year()
	{  
      	$budget_year=0;
		$current_year=date('Y'); 
		$current_month=date('m');
		if($current_month > 6):  
		$new_year=$current_year+1;
		$budget_year=$current_year.'-'.$new_year;
		else: 
		$new_year=$current_year-1;
		$budget_year=$new_year.'-'.$current_year;
		endif;
	   return $budget_year;
	}
	public function mbalance($id)
	{
	 $query=$this->db->query("select sum(sbalance) as total from ac_setup where mid='$id' group by mid");
	 $row=$query->row();
	 return $row->total;
	}
	//word slice  
	function getExcerpt($text)
	{	
		$words_in_text = str_word_count($text,1);
		$words_to_return = 10;
		$result = array_slice($words_in_text,0,$words_to_return);
		return '<em>'.implode(" ",$result).'</em>';
	}
	
	//get_book_no without serial by budget year
	public function get_book_no()
	{
		// $budget_year=array('budget_year'=>'2016-2017');
		return $this->db->select("MAX(bno) as bno")->from("tbl_books")->get()->row()->bno+1;	
		
	}
	//get book no serial by budget year Matuail Union Parishad
	public function matuailup_get_book_no()
	{
	  $where=array(
	  'budget_year'=>$this->get_current_budget_year()
	  );
	  return $this->db->select("MAX(bno) as bno")->from("tbl_books")->where($where)->get()->row()->bno+1;	
		
	}
	//get type of sms messages
	function smsType($id)
	{
	if($id==1): $type="নাগরিক/ওয়ারিশ/ট্রেড লাইসেন্স আবেদন"; endif;
	 if($id==2): $type="নাগরিক/ওয়ারিশ/ট্রেড লাইসেন্স  সনদ তৈরি";endif;
	 if($id==3): $type="ট্রেড লাইসেন্স  নবায়ন"; endif;
	if($id==4): $type="ট্রেড লাইসেন্স  নবায়ন  নোটিশ";endif;

	return $type;
	}
	
	//check sms setting
	function check_sms_setting($arguments)
	{
		$sms_on_off=$this->db->get("dcb_sms_notification")->row();
		$on_options=explode(',',$sms_on_off->wedgets);
		if(in_array($arguments[1],$on_options)):
		  $row=$this->db->select('msg')->from('dcb_sms_setting')->where('id',$arguments[0])->get()->row();
		  return $row->msg;
		 else:
         return false;		 
		endif;
	}
	
	//get invoice no
	public function get_invoice()
	{
		return $this->db->select("MAX(inno) as inno")->from("invoices")->get()->row()->inno+1;	
	}
	//get main category id,fund id, sub category name delete hobe..
	public function get_subctg_info($key)
	{
		return $this->db->select('id,mc_id,fund_id,sub_title')->from('subctg')->where('sub_title',$key)->get()->row();
	}
  //get account last balance delete hobe...
	public function get_account_last_balance($acno)
	{
		return $this->db->select("balance")->from("acinfo")->where("acno",$acno)->get()->row();
	}
	//get fund sub category last balance delete hobe ...
	public function get_fund_sub_category_last_balance($id)
	{
		return $this->db->select("balance")->from("subctg")->where("id",$id)->get()->row();
	}
	
	//get transaction  delete hobe..
	public function get_transaction()
	{
		return $this->db->select("MAX(tid) as tid")->from("transaction")->get()->row()->tid+1;
	}
	// insert holdingclientinformation
	public function store_holdingclientinfo($clientData)
	{
		return $this->db->insert("holdingclientinfo",$clientData);
	}
	
	//get voucher  delete hobe..
	public function get_credit_voucher()
	{
		return $this->db->select("MAX(vno) as vno")->from("credit_voucher")->get()->row()->vno+1;
	}
	//store generted license info and payment detials
	public function store_licenseinfo($info)
	{
		$this->db->insert("getlicense",$info);
	}
	//store trade license book no
	public function store_book_no($info)
	{
		$this->db->insert("tbl_books",$info);
	}
	//store union all sonod no delete hobe....
	public function store_up_sonod_no($info,$sonod,$trackid)
	{
		$this->db->insert("up_sonods",$info);
		$this->db->query("update tradelicense set sno='$sonod' where trackid='$trackid' LIMIT 1");
		
	}
	//store trade license book no delete hobe..
	public function store_transaction_no($info)
	{
		return $this->db->insert("transaction",$info);
	}
	//store credit voucher no delete hobe...
	public function store_credit_voucher_no($info)
	{
		return $this->db->insert("credit_voucher",$info);
	}
	
	//store payment details delete hobe...
	public function store_moneyrecipt($info)
	{
		return $this->db->insert("money",$info);
	}
	//store sub ledger details delete hobe ...
	public function store_sub_ledger_info($info)
	{
		return $this->db->insert("fund_sub_ctg",$info);
	}

	//store bank ledger details delete hobe...
	public function store_bank_ledger_info($info)
	{
		return $this->db->insert("ledger",$info);
	}
	// delete hobe...
	public function update_bank_balance($acno,$total)
	{
		return $this->db->query("update acinfo set balance=balance+$total where acno='$acno'");
	}
	
	//sub category balance update delete hobe..
	public function update_fund_subctg_balance($id,$total)
	{
		return $this->db->query("update subctg set balance=balance+$total where id='$id'");
	}
	
	//main category balance update delete hobe..
	public function update_fund_mainctg_balance($id,$total)
	{
		return $this->db->query("update mainctg set balance=balance+$total where id='$id'");
	}
	
	public function expire_license()
	{
	$cDate=date('Y-m-d');
	$qy=$this->db->query("update tradelicense set status='0' where expire_date='$cDate'");
	//echo $this->db->last_query();
	}
	//company details
	public function compDetails($vno)
	{ 
		$row=$this->db->query("select status from money where inno='$vno' LIMIT 1")->row();
		//return $row->status;
		if($row->status==1){
			$qy=$this->db->query("select g.bno,t.bcomname from  getlicense g,tradelicense t where g.vno='$vno' AND t.trackid=g.trackid  LIMIT 1")->row();
			//echo $this->db->last_query();
			if($this->db->affected_rows()>0){
				return '&nbsp;&raquo;&nbsp;'.$qy->bcomname.'&nbsp;&raquo;SN#'.$qy->bno;
			}
			else {return "";}
		}
   
		if($row->status==2){
			$qy=$this->db->query("select t.bcomname,g.trackid from  money g,tradelicense t where g.inno='$vno' AND t.sno=g.trackid  LIMIT 1")->row();
			//echo $this->db->last_query();
			if($this->db->affected_rows()>0){
				$brow=$this->db->query("select g.bno from getlicense g,tradelicense t where t.sno='$qy->trackid' AND t.trackid=g.trackid order by g.id DESC LIMIT 1")->row();
				// echo $this->db->last_query();
				return '&nbsp;&raquo;&nbsp;'.$qy->bcomname.'&nbsp;&raquo;SN#'.$brow->bno;
			}
			else {return "";}
		}
		
		if($row->status==3){
			$qy=$this->db->query("select t.bcomname,g.trackid from  money g,tradelicense t where g.inno='$vno' AND t.sno=g.trackid  LIMIT 1")->row();
			//echo $this->db->last_query();
			if($this->db->affected_rows()>0){
			$brow=$this->db->query("select g.bno from getlicense g,tradelicense t where t.sno='$qy->trackid' AND t.trackid=g.trackid order by g.id DESC LIMIT 1")->row();
			// echo $this->db->last_query();
			return '&nbsp;&raquo;&nbsp;'.$qy->bcomname.'&nbsp;&raquo;SN#'.$brow->bno;
			}
			else{return "";}
		}
		
		if($row->status==4){
			$qy=$this->db->query("select h.name,h.dagno from  holdingclientinfo h,money m where m.inno='$vno' AND h.dagno=m.trackid  order by m.id DESC LIMIT 1")->row();
			//echo $this->db->last_query();
			if($this->db->affected_rows()>0){
				// echo $this->db->last_query();
				return '&nbsp;&raquo;&nbsp;'.$qy->name.'&nbsp;&raquo;DN#'.$qy->dagno;
			}
			else{return "";}

		}
	}
  	//company details
  public function compDetailsvat($vno)
  {

  $qy=$this->db->query("select g.bno,t.bcomname from  getlicense g,tradelicense t where g.vno='$vno' AND t.trackid=g.trackid  LIMIT 1")->row();
   //echo $this->db->last_query();
   if($this->db->affected_rows()>0){
   return 'ট্রেড লাইসেন্স ফি&nbsp;&raquo;&nbsp;'.$qy->bcomname.'&nbsp;&raquo;SN#'.$qy->bno;
  }
   else {return "";}


  }
		public function acname($id)
	{
	 $query=$this->db->select('acname')->from('acinfo')->where('acno',$id)->get();
	 $row=$query->row();
	 return $row->acname; 
	}
	public function moneyInfo($id)
	{
	$query=$this->db->select('fee')->from('porichoprotro')->where('trackid',$id)->order_by('id','DESC')->limit(1)->get();
	$row=$query->row();
	return $this->conArray($row->fee);
	}
	public function otherServiceMoneyInfo($id)
	{
	$query=$this->db->select('fee')->from('onnanoseba')->where('trackid',$id)->order_by('id','DESC')->limit(1)->get();
	$row=$query->row();
	return $this->conArray($row->fee);
	}
	public function budget_2014_actual($catid,$sid,$year)
	{
	$filter=array(
	'catid'=>$catid,
	'sid'=>$sid,
	'budget_year'=>$year
	);
	$qy=$this->db->query("select actual_budget from subctg_in_budget where catid='$catid' AND sid='$sid' AND budget_year='$year'");
	$row=$qy->row();return $row->actual_budget;
	}
	public function budget_2014_actual_main($catid,$year)
	{

	$qy=$this->db->query("select actual_budget from mainctg_in_budget where catid='$catid' AND budget_year='$year'");
	$row=$qy->row();return $row->actual_budget;
	}
	
	
	public function enmoneyInfo($id)
	{
	$query=$this->db->select('fee')->from('porichoprotro')->where('trackid',$id)->order_by('id','DESC')->limit(1)->get();
	$row=$query->row();
	return $row->fee;
	}
	public function otherServiceEnmoneyInfo($id)
	{
	$query=$this->db->select('fee')->from('onnanoseba')->where('trackid',$id)->order_by('id','DESC')->limit(1)->get();
	$row=$query->row();
	return $row->fee;
	}
	// without dania union parishad
	
	
	/********************************/
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
	
	
	public function ctginfo()
	{
	$query=$this->db->query("select * from mainctg where fund_id=2");
	return $query->result();
	}
	
	public function comname($id)
	{
	$query=$this->db->select('title')->from('buisnestypes')->where('id',$id)->get();
	$row=$query->row();
	return $row->title;
	}
	public function parent_id($id)
	{
	$query=$this->db->select('mc_id')->from('subctg')->where('id',$id)->get();
	$row=$query->row();
	return $row->mc_id;
	}
	public function parent_id_exp($id)
	{
	$query=$this->db->select('id as mc_id')->from('expurpose')->where('id',$id)->get();
	$row=$query->row();
	return $row->mc_id;
	}
	
	
	public function voucherinfo($id)
	{
	$query=$this->db->select('vno')->from('porichoprotro')->where('trackid',$id)->get();
	$row=$query->row();
	return $this->conArray($row->vno);
	}
	public function otherServiceVoucherInfo($id)
	{
	$query=$this->db->select('vno')->from('onnanoseba')->where('trackid',$id)->get();
	$row=$query->row();
	return $this->conArray($row->vno);
	}
	
	
	
	public function comeb($en)
	{
	if($en=='.') return $en=".";
	if($en==0) return $en="০";
	if($en==1) return $en="১";
	if($en==2) return $en="২";
	if($en==3) return $en="৩";
	if($en==4) return $en="৪";
	if($en==5) return $en="৫";
	if($en==6) return $en="৬";
	if($en==7) return $en="৭";
	if($en==8) return $en="৮";
	if($en==9) return $en="৯";
	if($en==10) return $en="১০";
	}
		public function ceb($en)
	{
	if($en=='.') return $en=".";
	if($en==0) return $en="০";
	if($en==1) return $en="১";
	if($en==2) return $en="২";
	if($en==3) return $en="৩";
	if($en==4) return $en="৪";
	if($en==5) return $en="৫";
	if($en==6) return $en="৬";
	if($en==7) return $en="৭";
	if($en==8) return $en="৮";
	if($en==9) return $en="৯";
	if($en==10) return $en="১০";
	if($en==11) return $en="১১";
	if($en==12) return $en="১২";
	if($en==13) return $en="১৩";
	if($en==14) return $en="১৪";
	if($en==15) return $en="১৫";
	if($en==16) return $en="১৬";
	if($en==17) return $en="১৭";
	if($en==18) return $en="১৮";
	if($en==19) return $en="১৯";
	if($en==20) return $en="২০";
	}
	public function banDate($date)
	{
	$currentDate =$date;
$engDATE = array(1,2,3,4,5,6,7,8,9,0);
$bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
$convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);
return $convertedDATE;
	}
	public function banglatk($fee)
	{
	$taka="";
	$len=strlen($fee);
	$second=str_split($fee);
	for($i=0;$i<$len;$i++):
	$en=$second[$i];
	$taka.=$this->ceb($en);
	endfor;
	return $taka;
	}
	public function pPorichoe($id)
	{
		$query=$this->db->select('*')->from('personalinfo')->where('sha1(id)',$id)->get();
		return $query->row();
	}
	public function conArray($data)
	{
		$output="";
		$info=str_split($data);
		for($i=0;$i<strlen($data);$i++):
		$output.=$this->ceb($info[$i]);
		endfor;
		return $output;
	}
	
	public function acBalance($id)
	{
	 $query=$this->db->select('balance')->from('acinfo')->where('acno',$id)->get();
	 $row=$query->row();
	 return $row->balance; 
	}
	
	public function mctgBalance($id)
	{
	 $query=$this->db->select('balance')->from('mainctg')->where('id',$id)->get();
	 $row=$query->row();
	 return $row->balance; 
	}
	//send sms
	public function sendSms($mobile,$message)
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
	  $this->db->insert("dcb_sms_history",$history);
	 //send sms by api
	 $response=$this->curl_get($row->api_url,$info);
			
		/*		
		// $client = new SoapClient('https://powersms.banglaphone.net.bd/Services/SmsClient.asmx?WSDL');
		$client = new SoapClient('http://180.210.160.7/Services/SmsClient.asmx?WSDL');
		// Set the parameters
		$requestParams = array(
			'userName' => 'SOZIBDCB', // Use your user-id here
			'password' => 'SOZIBDCB123',
			'smsText'  => $Message,
			'commaSeparatedReceiverNumbers' =>$Mobile, // you can use multiple mobile numbers here; e.g: 01810000000,01710000000,0191000000,015...
			'nameToShowAsSender' => '' // Use your mask text here if you want (and you have masking enabled)
		);
		// Call to send sms
		$response = $client->SendSms($requestParams)->SendSmsResult;
		// Check if sms sending was successful
		if($response->IsError){
			//echo "<h2 style='color:red'>FAILED!</h3>";
			// Know the reason for failure (and the error code)
			echo sprintf("Reason: %s [%d]", $response->ErrorMessage, $response->ErrorCode);
		}
		else{
			//echo "<h2 style='color:green;'>SUCCESS!</h2>";
		}
		*/
	}	
	
	public function sctgBalance($id)
	{
	 $query=$this->db->select('balance')->from('subctg')->where('id',$id)->get();
	 $row=$query->row();
	 return $row->balance; 
	}
	
	public function exheadinfo($id)
	{
	 $query=$this->db->select('*')->from('exphead')->where('sha1(id)',$id)->get();
	 return $query->row();
	}	
	
	public function businesinfo($id)
	{
	 $query=$this->db->select('*')->from('buisnestypes')->where('sha1(id)',$id)->get();
	 return $query->row();
	}	
	
	
	public function expurinfo($id)
	{
	 $query=$this->db->select('*')->from('expurpose')->where('sha1(id)',$id)->get();
	 return $query->row();
	}	
	public function mPurpose($id)
	{
	 $query=$this->db->select('title')->from('exphead')->where('id',$id)->get();
	 $row=$query->row();
	  return $row->title;
	}	
	
	public function exphinfo()
	{
	 $query=$this->db->get('exphead');
	 return $query->result();
	}
	
	// count for total warish  delete hobe
	public function tWarish($id)
	{
	 $query=$this->db->select('*')->from('warishinfo')->where('trackid',$id)->get();
	 return $query->num_rows();
	}
	
	
	public function exppurinfo($id)
	{
	 $query=$this->db->select('purpose')->from('ledger')->where('tid',$id)->limit(1)->get();
	 $row=$query->row();
	 return $row->purpose;
	}
	
	
	public function tdmoneyrecptInfo($id)
	{
	 $query=$this->db->select('fee,total')->from('money')->where('sha1(lno)',$id)->get();
	 return $query->row();
	}
	
	public function wwccinfo($id)
	{
	 $query=$this->db->select('*')->from('warishinfo')->where('sha1(trackid)',$id)->get();
	 
	 return $query->row();
	}

	public function wccinfo($id)
	{
	 $query=$this->db->select('*')->from('tbl_warishesinfo')->where('sha1(id)',$id)->get();
	 return $query->row();
	}
	
	public function subCtg($id)
	{
	 $query=$this->db->select('*')->from('subctg')->where('mc_id',$id)->get();
	 //echo $this->db->last_query();
	 return $query->result();
	}
	
	public function expsubCtg($id)
	{
	
	}
	
	
	public function statusBDG($year,$title)
	{
	 $query=$this->db->query("select * from budgets where title='$title' AND budget_year='$year' LIMIT 1");
	 return $this->db->affected_rows();
	}
	
	
	public function getTinfo($id)
	{
	 $query=$this->db->select('*')->from('tradelicense')->where('sha1(trackid)',$id)->get();
	 return $query->row();
	 
	}
	
	public function licenseInfo($id)
	{
	 $query=$this->db->select('*')->from('tradelicense')->where('sno',$id)->get();
	 return $query->row();
	 
	}
	public function holdingInfo($id)
	{
	 $query=$this->db->select('name')->from('holdingclientinfo')->where('dag_no',$id)->get();
	 return $query->row();
	 
	}
	
	public function println($id)
	{
	 $query=$this->db->select('*')->from('tradelicense')->where('sha1(t_licenseno)',$id)->get();
	 $query=$this->db->select('*')->from('money')->where('sha1(lno)',$id)->get();
	 return $query->row();
	 
	}
	
	
	public function sbalance($mid,$sid)
	{
	 $query=$this->db->query("select sbalance from ac_setup where mid='$mid' and sid='$sid'");
	 $row=$query->row();
	 return $row->sbalance;
	}
	
	
	public function eMobile($phn)
	{
	$this->db->query("SELECT phone FROM employers WHERE phone='$phn' LIMIT 1");
	return $this->db->affected_rows();
	}
	
	public function sctgs($m,$from,$to,$fund)
	{
	 $query=$this->db->query("select distinct SUBSTRING_INDEX(SUBSTRING_INDEX(purpose,',',2),',',-1) sub,dr,cr,balance from ledger where date(up_date) between '$from' and '$to' and fundtype='$fund' and catid='$m' group by SUBSTRING_INDEX(SUBSTRING_INDEX(purpose,',',2),',',-1)");
     $results=$query->result();
	 return $results;
	}
  public function ctotal()
	{
	$query=$this->db->query("select sum(sbalance) as total from ac_setup");
	$ctotal=$query->row();
	$bquery=$this->db->query("select sum(balance) as total from tembank");
	$btotal=$bquery->row();
	if($ctotal->total!==$btotal->total)
	{
	 echo 'onclick="alert(\'Sorry Your Total Category Amount \nIs not Equal to Bank Banlance\');return false;"';
	 }
	 else{return true;}
	}
	public function scname($id)
	{
	 $query=$this->db->query("select title from inmc where id='$id' limit 1");
	 $row=$query->row();
	 return $row->title;
	}
	public function mcat($id)
	{
	 $query=$this->db->query("select title from inmc where id='$id' limit 1");
	 $row=$query->row();
	 return $row->title;
	}
		public function tradeInfo($id)
	{
	 $query=$this->db->select('*')->from('tradelicense')->where('md5(id)',$id)->get();
	 return $query->row();
	}
	
	public function status()
	{
	 $query=$this->db->query("select status from finalsetup where title='accounting'");
	 $row=$query->row();
	 return $row->status;
	}
	public function mCtgName($id)
	{
	 $query=$this->db->query("select category from mainctg where id='$id' limit 1");
	 $row=$query->row();
	 return $row->category;
	}
	public function mCtgNameexp($id)
	{
	 $query=$this->db->query("select title from exphead where id='$id' limit 1");
	 $row=$query->row();
	 return $row->title;
	}

	public function SCtgName($id)
	{
	 $query=$this->db->query("select sub_title from subctg where id='$id' limit 1");
	 $row=$query->row();
	 return $row->sub_title;
	}
	
	public function ExfundName($id)
	{
	 $query=$this->db->query("select fund_id from funds where id='$id'  limit 1");
	 $row=$query->row();
	 if($row->fund_id=='1') $ans='Development';
	 if($row->fund_id=='2') $ans='Personal';
	 return $ans;
	
	}
	public function InfundName($id)
	{
	 $query=$this->db->query("select fund_id from mainctg where id='$id' limit 1");
	 $row=$query->row();
	 if($row->fund_id=='1') $ans='Development';
	 if($row->fund_id=='2') $ans='Personal';
	 return $ans;
	}
	
	
	
	public function expscname($id)
	{
	 $query=$this->db->query("select expsctitle from expsc where expmcid='$id' limit 1");
	 $row=$query->row();
	 return $row->expsctitle;
	}
	
	public function getList()
	{
	 $query=$this->db->query("select * from tradelicense order by delivery_type ASC");
	 return $query->result();
	}
	//renew list
	public function getRenew()
	{
	 $query=$this->db->query("select * from tradelicense t,renew_req r where t.sno=r.sno group by t.sno order by t.delivery_type ASC");
	 return $query->result();
	}
	
	
	public function sProduct($pc,$pn)
	{
	$query=$this->db->query("SELECT sum(Qt) as tQt FROM sales WHERE ctg='$pc' AND pname='$pn' LIMIT 1");
	$row=$query->row();
	return $row->tQt;
	}
	public function cMobile($phn)
	{
	$this->db->query("SELECT cphone FROM customer WHERE cphone='$phn' LIMIT 1");
	return $this->db->affected_rows();
	}
	public function ePurinfo($pc,$pn,$pid,$company,$in)
	{
	$this->db->query("SELECT pcate,pname,pid,company FROM purchase WHERE pcate='$pc' AND pname='$pn' AND pid='$pid' AND company='$company' AND invoice='$in' LIMIT 1");
	return $this->db->affected_rows();
	}
	public function get_setupinfo()
	{
		return $this->db->select("union_code,upazila_code")->from("setup_tbl")->get()->row();
	}
	
	public function dailyHistory()
	{   $today=date('Y-m-d');
		$today_citizen_apply=$this->db->query("select count(*) as citizen_apply from personalinfo where date(insert_time)='$today'")->row()->citizen_apply;
		$today_citizen_certificate=$this->db->query("select count(*) as citizen_certificate from personalinfo c inner join porichoprotro p on c.trackid=p.trackid AND c.sonodno!='' and date(p.utime)='$today';")->row()->citizen_certificate;
		$today_warish_apply=$this->db->query("select count(*) as warish_apply from tbl_warishesinfo where date(ins_time)='$today'")->row()->warish_apply;
		$today_warish_certificate=$this->db->query("select count(*) as warish_certificate from tbl_warishesinfo w inner join tbl_wcc c on w.trackid=c.trackid AND date(c.utime)='$today' AND w.sonodno!=''")->row()->warish_certificate;
		$today_trade_apply=$this->db->query("select count(*) as trade_apply from tradelicense where date(utime)='$today'")->row()->trade_apply;
		$today_trade_certificate=$this->db->query("select count(*) as trade_certificate from tradelicense where issue_date='$today' AND sno!=''")->row()->trade_certificate;
		$today_collection=$this->db->query("select sum(total) as total from money where date(payment_date)='$today'")->row()->total;
		$info=$this->get_setupinfo();
		$data=array(
			 'union_code'=>$info->union_code,
			 'upzilla_code'=>$info->upazila_code,
			 'today_citizen_apply'=>$today_citizen_apply,
			 'today_citizen_certificate'=>$today_citizen_certificate,
			 'today_warish_apply'=>$today_warish_apply,
			 'today_warish_certificate'=>$today_warish_certificate,
			 'today_trade_apply'=>$today_trade_apply,
			 'today_trade_certificate'=>$today_trade_certificate,
			 'taka'=>$today_collection
		);
		// print_r($data);exit;
		$url="http://datacenter.com.bd/centralup/index.php/Union/dailyRecord";
		$this->test_curl($url,$data);
    
	}
	public function ip2location()
	{	
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$data=array(
		'key'=>'f9d1c013d46fad87f8abf42c45df4f9ec28af2dc50dfd6eca3c8c47d0cc3a75d',
		'ip'=>$ipaddress,
		'format'=>'json'
		);
	$url='http://api.ipinfodb.com/v3/ip-country/';
	
	$res=$this->web->curl_get($url,$data);
	$data=json_decode($res);
	return $data;
	}
	
	public function curl_get_union($url, array $get = NULL, array $options = array())
	{   $defaults = array( 
        CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get), 
        CURLOPT_HEADER => 0, 
        CURLOPT_POST => TRUE, 
        CURLOPT_RETURNTRANSFER => TRUE, 
        CURLOPT_TIMEOUT => 10 
    ); 
   
    $ch = curl_init(); 
    curl_setopt_array($ch, ($options + $defaults)); 
	curl_exec($ch);
   // Check if any error occurred
if(!curl_errno($ch))
{
 $info = curl_getinfo($ch);

 echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
}
// Close handle
curl_close($ch);
    
	}
	public function test_curl($url,$data)
	{
	$string=http_build_query($data);
    $ch=curl_init($url);	
    curl_setopt($ch,CURLOPT_POST,true);	
    curl_setopt($ch,CURLOPT_POSTFIELDS,$string);	
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);	
	curl_exec($ch);
	curl_close($ch);
	}
	
  public function getJobs($limit,$offset){
	$pquery=$this->db->get("students",$limit,$offset);
	//$pquery=$this->db->query("SELECT * FROM  students $offset,$limit");
	$data['result']=$pquery->result();
	$query=$this->db->query("SELECT * FROM students");
	$data['total']=$query->num_rows();
	return $data;
	}
	public function getResult($limit,$offset){
	$pquery=$this->db->get("results",$limit,$offset);
	//$pquery=$this->db->query("SELECT * FROM  students $offset,$limit");
	$data['result']=$pquery->result();
	$query=$this->db->query("SELECT * FROM results");
	$data['total']=$query->num_rows();
	return $data;
	}
	public function getPub($limit,$offset){
	$pquery=$this->db->get("pdf",$limit,$offset);
	//$pquery=$this->db->query("SELECT * FROM  students $offset,$limit");
	$data['result']=$pquery->result();
	$query=$this->db->query("SELECT * FROM pdf");
	$data['total']=$query->num_rows();
	return $data;
	}
	
	public function info(){
	$Query=$this->db->query("SELECT * FROM settings WHERE options='site_title'");
	$row=$Query->row();
	$info->site_title=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='site_tag'");
	$row=$Query->row();
	$info->site_tag=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='site_email'");
	$row=$Query->row();
	$info->site_email=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='facebook_page'");
	$row=$Query->row();
	$info->facebook_page=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='featured_video'");
	$row=$Query->row();
	$info->featured_video=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='furl'");
	$row=$Query->row();
	$info->furl=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='turl'");
	$row=$Query->row();
	$info->turl=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='yurl'");
	$row=$Query->row();
	$info->yurl=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='gurl'");
	$row=$Query->row();
	$info->gurl=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='about'");
	$row=$Query->row();
	$info->about=$row->value;

	$Query=$this->db->query("SELECT * FROM settings WHERE options='site_logo'");
	$row=$Query->row();
	$info->site_logo=$row->value;
	
	return $info;
}
 	
	public function pagetop(){
	$query=$this->db->query("SELECT * FROM pages WHERE parentid='-1'");
	$result=$query->result();
	return $result;
	}
	public function existAcc($n,$r,$d,$ses,$sem){
	$query=$this->db->query("SELECT * FROM students WHERE name='$n' AND roll='$r' AND deppt='$d' AND session='$ses' AND sem='$sem' LIMIT 1");
	$result=$query->num_rows();
	return $result;
	}
	
	public function pageName($id){
	if ($id!=-1){
	$query=$this->db->query("SELECT title FROM pages WHERE id='$id'");
	$row=$query->row();
	}else {
	$row->title="No Parent";
	}
	return $row->title;
	}
	public function tkconvert($number)
	{
		if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}

		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */

		$res = "";

		if ($Gn) {
			$res .= $this->tkconvert($Gn) .  "Million";
		}

		if ($kn) {
			$res .= (empty($res) ? "" : " ") .$this->tkconvert($kn) . " হাজার";
		}

		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .$this->tkconvert($Hn) . " শত";
		}

		$ones = array("", "এক", "দুই", "তিন", "চার", "পাঁচ", "ছয়", "সাত", "আট", "নয়", "দশ", "এগার", "বার", "তের", "চোদ্দ", "পনের", "ষোল", "সতের", "আঠার", "ঊনিষ");
		$tens = array("", "", "বিশ", "একুশ", "বাইশ", "তেইশ", "চব্বিশ","পঁচিশ","ছাব্বিশ", "সাতাশ", "আটাশ", "ঊনত্রিশ");

		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " ";
			}

			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];

				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}

		if (empty($res)) {
			$res = "শূন্য";
		}

		return $res;
	}
	
	//update by shohag 20.03.2016
	public function mainExpBalance($id)
	{
		$query=$this->db->select('balance')->from('exphead')->where('id',$id)->get();
		$row=$query->row();
		return $row->balance; 
	}
	public function subExpBalance($id)
	{
		$query=$this->db->select('balance')->from('expurpose')->where('id',$id)->get();
		$row=$query->row();
		return $row->balance;
	}
	// for bar
	public function barShow($date){
		$bar = date('D',strtotime($date));
		if($bar=='Sat'){
			return "শনি ";
		}
		else if($bar=='Sun'){
			return "রবি ";
		}
		else if($bar=='Mon'){
			return "সোম ";
		}
		else if($bar=='Tue'){
			return "মঙ্গল ";
		}else if($bar=='Wed'){
			return "বুধ ";
		}else if($bar=='Thu'){
			return "বৃহস্পতি ";
		}else if($bar=='Fri'){
			return "শুক্র ";
		}
		else{
			return '......';
		}
	}
	public function jacai_obsthan($status){
		if($status=='3'){
			return "<font style='color: red; font-size: 22px; font-weight: bolder;'>আপনার মামলাটি বাতিল করা হয়েছে। </font>";
		}else if($status=='2'){
			return "<font style='color: green; font-size: 22px; font-weight: bolder;'>আপনার মামলাটি সম্পাদিত হয়েছে। </font>";
		}else{
			return "<font style='color: blue; font-size: 22px; font-weight: bolder;'>আপনার মামলাটি চলমান রয়েছে। </font>";
		}
	}
	public function getUrl(){
		
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$validUrl = str_replace("&","&amp;",$url);
		$showUrl =  parse_url($validUrl);
		return $showUrl['host'];
	}
}
?>
