<?php 
	extract($_POST);
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
	if($amount==""){
		echo "Please Input Amount";exit;
	}
	if($accounts!='CASH ACCOUNT'){if($ptype==""){ echo "Please Select Payment Type";exit;}}
	
	if($subcat=="") $subcat=0;
	$payment_date=date('Y-m-d',strtotime($payment_date));
	
	//find last transaction no and store....
	$transno=$this->transition->get_transaction();
	$transaction_info=array('tid'=>$transno);
	
	//find last credet voucher no and store....	
	$voucherno=$this->transition->get_credit_voucher();
	$voucher_info=array('vno'=>$voucherno);
	
	/*********Bank Reference No************/
	$query=$this->db->query("select acno,balance from acinfo where acname='$accounts'");
	$row=$query->row();	
	
	//Added Ledger
	$lquery=$this->db->query("select fund_id,category from mainctg where id='$catid'  limit 1");
	$lrow=$lquery->row();
	$squery=$this->db->query("select *  from subctg where mc_id='$catid' and id='$subcat' limit 1");
	$srow=$squery->row();
	
	//from ledger this account opening balance
	$legQ=$this->db->query("SELECT  dr,balance FROM ledger where ac='$row->acno' order by id DESC");
	$Rrow=$legQ->row();
	$nBalance=($Rrow->balance+$amount);
	
	if($srow->sub_title==""){ $subtitle=0;} else {$subtitle=$srow->sub_title;}
	
	if(!empty($srow->sub_title)){$pur=$lrow->category.','.$subtitle;} else {$pur=$lrow->category;}

	$ledg=array(
		'tid'			=> $tid,
		'voucherno'		=> $voucherno,
		'vtype'			=> 'C',
		'catid'			=> $catid,
		'subid'			=> $subcat,
		'fundtype'		=> $fund_id,
		'purpose'		=> $pur,
		'ac'			=> $row->acno,
		'cr'			=> $amount,
		'balance'		=> $nBalance, 
		'payment_date'	=> $payment_date, 
		'inby'			=> $user
	);


	/*************updated  sub category Ledger ***************/
	$slegQ=$this->db->query("SELECT  * FROM fund_sub_ctg where subid='$subcat' and mc_id='$catid' order by voucherno DESC limit 1");
	$scrow=$slegQ->row();
	
	$snBalance=($scrow->balance+$amount);
	
	$sLedg=array(
		'mc_id'			=> $catid,
		'subid'			=> $srow->id,
		'fund_id'		=> $lrow->fund_id,
		'trno'			=> $tid,
		'voucherno'		=> $voucherno,
		'vtype'			=> 'C',
		'sub_title'		=> $subtitle,
		'cr'			=> $amount,
		'balance'		=> $snBalance,
		'payment_date'	=> $payment_date
	);
	
	$moneyinfo=array(
		'trackid'		=> '000000',
		'inno'			=> $voucherno,
		'fee'			=> $amount,
		'total'			=> $amount,
		'payment_date'	=> $payment_date,
		'status'		=> 7
	);
	
	$data=array(
		'fid'			=> $fund_id,
		'catid'			=> $catid,
		'transid'		=> $tid,
		'sub_cat'		=> $subcat,
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
	/**********if accounts cash*************/
	if($ptype!=='cash'){
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
	
	$this->session->set_userdata($ses_array);
	
	$this->db->trans_start();
		$this->mgenerate->common_insert("transaction",$transaction_info);
		$this->mgenerate->common_insert("credit_voucher",$voucher_info);
		$this->mgenerate->common_insert("dailycollection",$data);
		$this->mgenerate->common_insert("ledger",$ledg);
		$this->mgenerate->common_insert("money",$moneyinfo);
		if($subtitle != '0'){
			$this->mgenerate->common_insert("fund_sub_ctg",$sLedg);
		}
		
		//update
		$this->db->query("update acinfo set balance=balance+$amount where acno='$row->acno'");
		$this->db->query("update mainctg set balance=balance+$amount where id='$catid'");
		if($subtitle!='0'){
			$this->db->query("update subctg set balance=balance+$amount where mc_id='$catid' and id='$subcat'");
		}
	$this->db->trans_complete();
	
	if($this->db->trans_status() === TRUE){
		echo "1";
	}
	else {
		echo "Oops!!! Something error";
	}
?>