<?php 
	extract($_POST);
	$user = $this->session->userdata('username');
	print_r($_POST);exit;
	if($name==''){echo "4";exit;}
	if($mobileNo==''){echo "6";exit;}
	if($dagNo==''){echo "7";exit;}
	
	if($gtype=='newBosod'){
		$qData=array(
			'name'			=> $name,
			'dagNo'			=> $dagNo,
			'mobileNo'		=> $mobileNo,
			'payment_date'	=> $payment_date,
			'money'			=> $money,
			'fatherName'	=> $fatherName,
			'nid'			=> $nid,
			'bid'			=> $bid,
			'village'		=> $village,
			'wordNo'		=> $wordNo,
			'holdingNumber'	=> $holdingNumber,
			'holdingType'	=> 1,
			'tax'			=> 1
		);
		$this->session->set_userdata($qData);
		echo "3";exit;
	}
	else {
		
		$payment_date = date('Y-m-d',strtotime($payment_date));
		
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
			'trackid'		=> $dagNo,
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
		
		$clientData=array(
			'name'			=> $name,
			'fathername'	=> $fatherName,
			'nid'			=> $nid,
			'bid'			=> $bid,
			'village'		=> $village,
			'wordno'		=> $wordNo,
			'holdingno'		=> $holdingNumber,
			'dagno'			=> $dagNo,
			'mobileno'		=> $mobileNo,
			'pdate'			=> $payment_date,
			'status'		=> '1',
			'update_by'		=> $user
		);

		$sData=array(
			'holdingNumber'	=>$dagNo,
			'vno'			=>$voucherno
		);
		$this->session->set_userdata($sData);
		
		$this->db->trans_start();
			$this->mgenerate->common_insert("holdingclientinfo",$clientData);
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

		$this->session->unset_userdata('name');
		$this->session->unset_userdata('dagNo');
		$this->session->unset_userdata('mobileNo');
		$this->session->unset_userdata('payment_date');
		$this->session->unset_userdata('money');
		$this->session->unset_userdata('fatherName');
		$this->session->unset_userdata('nid');
		$this->session->unset_userdata('bid');
		$this->session->unset_userdata('village');
		$this->session->unset_userdata('wordNo');
		$this->session->unset_userdata('holdingType');
		$this->session->unset_userdata('tax');

		if($this->db->trans_status() === TRUE){
			echo "1";
		}
		else {
			echo "Oops!!! Something error";
		}
	}
?>