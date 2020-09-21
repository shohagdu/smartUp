<?php
	extract($_POST);
	$user=$this->session->userdata('username');
	if($payDate==''){echo "5";exit;}
	if($money==''){echo "4";exit;}	

	if($moneyRec=='MoneyReceipt'){
		$sData=array(
			'showName'	=> $showName,
			'ShowdagNo1'=> $ShowdagNo1,
			'showMobile'=> $showMobile,
			'payDate'	=> $payDate,
			'money'		=> $money
		);
		$this->session->set_userdata($sData);
		echo "3";exit;
	}
	else
	{
		$payment_date=date('Y-m-d',strtotime($payDate));
		
		//updated logs
		$Qyy=$this->db->query("select acno from acinfo where acname='CASH ACCOUNT' LIMIT 1")->row();
		$acno=$Qyy->acno;
		
		//find last transaction no and store....
		$transno=$this->transition->get_transaction();
		$transaction_info=array('tid'=>$transno);

		//find last credet voucher no and store....	
		$voucherno=$this->transition->get_credit_voucher();
		$voucher_info=array('vno'=>$voucherno);
		
		//find trade license
		$key="হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর";
		$fRow = $this->mgenerate->get_subctg_info($key); 		// get sub category name,fund id,main category Name
		$fundId =  $this->mgenerate->get_fundId($fRow->mc_id);	// for fund id
		
		//previous balance
		$Rrow=$this->transition->get_account_last_balance($acno);
		$nBalance=($Rrow->balance+$money);
		
		$ledg=array(
			'tid'			=> $transno,
			'voucherno'		=> $voucherno,
			'vtype'			=> 'C',
			'catid'			=> $fRow->mc_id,
			'subid'			=> $fRow->id,
			'fundtype'		=> $fundId->fund_id,
			'purpose'		=> $key,
			'ac'			=> $acno,
			'cr'			=> $money,
			'balance'		=> $nBalance,
			'payment_date'	=> $payment_date,
			'inby'			=> $user
		);
		
		$moneyinfo=array(
			'trackid'		=> $ShowdagNo1,
			'inno'			=> $voucherno,
			'fee'			=> $money,
			'total'			=> $money,
			'payment_date'	=> $payment_date,
			'status'		=> 4
		);

		//get fund sub category last balance [ Individual sub category last balance]
		$scrow=$this->transition->get_fund_sub_category_last_balance($fRow->id);
		$snBalance=($scrow->balance+$money);
		
		$sLedg=array(
			'mc_id'			=> $fRow->mc_id,
			'subid'			=> $fRow->id,
			'fund_id'		=> $fundId->fund_id,
			'trno'			=> $transno,
			'voucherno'		=> $voucherno,
			'vtype'			=> 'C',
			'sub_title'		=> $fRow->sub_title,
			'cr'			=> $money,
			'balance'		=> $snBalance,
			'payment_date'	=> $payment_date
		);
		
		$sData=array(
			'holdingNumber'	=>$ShowdagNo1,
			'vno'			=>$voucherno
		);
		$this->session->set_userdata($sData);

		$this->db->trans_start();
			$this->mgenerate->common_insert("transaction",$transaction_info);
			$this->mgenerate->common_insert("credit_voucher",$voucher_info);
			$this->mgenerate->common_insert("money",$moneyinfo);
			$this->mgenerate->common_insert("fund_sub_ctg",$sLedg);
			$this->mgenerate->common_insert("ledger",$ledg);
			
			//update bank account............
			$this->mgenerate->common_update_bankLedger("acinfo", "balance", "acno", $acno, $money);
			$this->mgenerate->common_update_bankLedger("mainctg", "balance", "id", $fRow->mc_id, $money);
			$this->mgenerate->common_update_bankLedger("subctg", "balance", "id",$fRow->id, $money);
		$this->db->trans_complete();

		$this->session->unset_userdata('showName');
		$this->session->unset_userdata('ShowdagNo1');
		$this->session->unset_userdata('showMobile');
		$this->session->unset_userdata('payDate');
		$this->session->unset_userdata('money');

		if($this->db->trans_status() === TRUE){
			echo "1";
		}
		else {
			echo "Oops!!! Something error";
		}
	}
?>