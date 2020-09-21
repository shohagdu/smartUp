 <?php 
	extract($_POST);
	//echo '<pre>';
	//print_r($_POST);exit;
	$user=$this->session->userdata('username');
	
	if($fund_id==""){
		echo "Please Select Any Fund.";exit;
	}
	if($catid==""){
		echo "Please Select Category.";exit;
	}
	if(isset($_POST['subcat']) && $subcat==""){
		echo "Please Select Sub category.";exit;
	}
	if($describe==""){ 
		echo "Please Input Proper Description";exit;
	}
	if($accounts==""){ 
		echo "Please Select an Account."; exit;
	}
	if($subcat=="") $subcat=0;
	if($amount==""){ 
		echo "Please Input Amount";exit;
	}
	if($accounts!='CASH ACCOUNT'){if($ptype==""){ echo "Please Select Payment Type";exit;}}
	
	$payment_date=date('Y-m-d',strtotime($payment_date));
	/*********Bank Reference No************/
	$query=$this->db->query("select acno,balance from acinfo where acname='$accounts'");
	$row=$query->row();	

	//Added Ledger
	$lquery=$this->db->query("select * from exphead where id='$catid'  limit 1");
	$lrow=$lquery->row();
	
	$squery=$this->db->query("select *  from expurpose where pid='$catid' and id='$subcat' limit 1");
	$srow=$squery->row();

	//from ledger this account opening balance
	$legQ=$this->db->query("SELECT  dr,balance FROM ledger where ac='$row->acno' order by id DESC");
	$Rrow=$legQ->row();
	
	// New Balance-----
	$nBalance=($Rrow->balance-$amount);
	
	if($srow->pname==""){$subtitle=0;} else {$subtitle=$srow->pname;}
	if(!empty($srow->pname)){$pur=$lrow->title.','.$subtitle;} else {$pur=$lrow->title;}
	
	//find last transaction no and store....
	$transno=$this->transition->get_transaction();
	$transaction_info=array('tid'=>$transno);
	
	//find last credet voucher no and store....	
	$voucherno=$this->transition->get_debit_voucher();
	$voucher_info=array('vno'=>$voucherno);
	
	$ledg=array(
		'tid'			=> $transno,
		'voucherno'		=> $voucherno,
		'vtype'			=> 'D',
		'catid'			=> $catid,
		'subid'			=> $subcat,
		'fundtype'		=> $fund_id,
		'purpose'		=> $pur,
		'ac'			=> $row->acno,
		'dr'			=> $amount,
		'balance'		=> $nBalance, 
		'payment_date'	=> $payment_date,
		'inby'			=> $user
	);
	
	$moneyinfo=array(
		'trackid'		=> '111111',
		'inno'			=> $voucherno,
		'fee'			=> $amount,
		'total'			=> $amount,
		'payment_date'	=> $payment_date,
		'status'		=> 8
	);

	if($accounts!=='cash'){
		$payType=$this->input->post('ptype',true);
		if($payType=="") exit;
		$data['paytype']=$payType;
		if($payType=='cash')
		{
			$sno=$this->input->post('sno',true); if($sno=="") exit; 
			$data['slipno']=$sno;  
		}
		if($payType=='cheque')
		{
			$cno=$this->input->post('cno',true); if($cno=="") exit; 
			$bname=$this->input->post('bname',true); if($bname=="") exit; 
			$isdate=$this->input->post('issudate',true); if($isdate=="") exit; 
			$data['chno']=$this->input->post('cno',true);
			$data['bank']=$this->input->post('bname',true);
			$data['issue']=$this->input->post('issudate',true);
		}
		if($payType=='po')
		{
			$pono=$this->input->post('pono',true); if($pono=="") exit; 
			$bname=$this->input->post('bname',true); if($bname=="") exit; 
			$isdate=$this->input->post('issudate',true); if($isdate=="") exit; 
			$data['bank']=$this->input->post('bname',true);
			$data['pono']=$this->input->post('pono',true);
			$data['issue']=$this->input->post('issudate',true);
		}
		if($payType=='dd')
		{
			$ddno=$this->input->post('ddno',true); if($ddno=="") exit; 
			$bname=$this->input->post('bname',true); if($bname=="") exit; 
			$isdate=$this->input->post('issudate',true); if($isdate=="") exit; 
			$data['ddno']=$this->input->post('ddno',true);
			$data['bank']=$this->input->post('bname',true);
			$data['issue']=$this->input->post('issudate',true);
		}
		if($payType=='tt')
		{
			$ttno=$this->input->post('ttno',true); if($ttno=="") exit; 
			$bname=$this->input->post('bname',true); if($bname=="") exit;  
			$issue=$this->input->post('issudate',true);if($issue=="") exit; 
			$data['ttno']=$this->input->post('ttno',true);
			$data['bank']=$this->input->post('bname',true);
			$data['issue']=$this->input->post('issudate',true);
		}
	}
	//update sub category account
	
	/*********inset dailycollection info*******/
	$data=array(
		'fid'			=> $fund_id,
		'catid'			=> $catid,
		'sub_cat'		=> $subcat,
		'transid'		=> $transno,
		'voucherno'		=> $voucherno,
		'accounts'		=> $accounts,
		'amount'		=> $amount,
		'paytype'		=> $ptype,
		'purpose'		=> $pur,
		'des'			=> $describe,
		'payment_date'	=> $payment_date,
		'update_by'		=> $user
	);
	
	$ses_array=array(
		'voucherno'		=> $voucherno,
		'des'			=> $describe,
		'amount'		=> $amount,
		'payment_date'	=> $payment_date
	);
	
	$this->session->set_userdata($ses_array);
	$Que=$this->db->query("select id from dailyexp order by id desc limit 1")->row();
	$lastId=$Que->id+1;
	
	$this->db->trans_start();
		$this->mgenerate->common_insert("transaction",$transaction_info);
		$this->mgenerate->common_insert("debit_voucher",$voucher_info);
		$this->mgenerate->common_insert("dailyexp",$data);
		//echo $this->db->last_query();exit;
		$this->mgenerate->common_insert("ledger",$ledg);
		$this->mgenerate->common_insert("money",$moneyinfo);
		
		//update.....
		$this->db->query("update acinfo set balance=balance-$amount where acno='$row->acno'");
		$this->db->query("update exphead set balance=balance+$amount where id='$catid'");
		if($subtitle!='0'){
			$this->db->query("update expurpose set balance=balance+$amount where pid='$catid' and id='$subcat'");
		}
	$this->db->trans_complete();
	
	if($this->db->trans_status() === TRUE){
		echo '1'."+&+".md5($lastId);
	}
	else {
		echo "Oops!!! Something error";
	}
?>