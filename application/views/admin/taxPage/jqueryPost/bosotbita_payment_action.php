<?php
	
	$user=$this->session->userdata('username');
	//if($payDate==''){echo "5";exit;}
	//if($money==''){echo "4";exit;}	

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
	else{
		// echo "<pre>";
		// print_r($request);
		// exit;
		$payment_date=date('Y-m-d',strtotime($request['paymentDate']));
		
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
		$nBalance=($Rrow->balance+$request['paymentAmount']);
		
		$ledg=array(
			'tid'			=> $transno,
			'voucherno'		=> $voucherno,
			'vtype'			=> 'C',
			'catid'			=> $fRow->mc_id,
			'subid'			=> $fRow->id,
			'fundtype'		=> $fundId->fund_id,
			'purpose'		=> $key,
			'ac'			=> $acno,
			'cr'			=> $request['paymentAmount'],
			'balance'		=> $nBalance,
			'payment_date'	=> $payment_date,
			'inby'			=> $user
		);
		
		$moneyinfo=array(
			'trackid'		    => (string)$request['dagNo'],
			'bno'			    => $request['bookNumber'],
			'm_r_n'			    => $request['moneyNumber'],
			'inno'			    => $voucherno,
			'fiscal_year_id'    => json_encode($request['fiscalYear']),
			'rate_sheet_id'	    => json_encode($request['holdingType']),
			'rate_sheet_amount'	=> json_encode($request['holdingAmount']),
			'fee'			    => $request['totalAmount'],
			'discount'		    => $request['discount'],
			'total'			    => $request['paymentAmount'],
			'payment_date'	    => $payment_date,
			'status'		    => 4
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
			'cr'			=> $request['paymentAmount'],
			'balance'		=> $snBalance,
			'payment_date'	=> $payment_date
		);
		
		if(array_key_exists("holding_money_receipt",$this->session->all_userdata())){
			$this->session->unset_userdata('holding_money_receipt');
		}
		$sData=array(
			'holdingNumber'	=>(string)$request['dagNo'],
			'vno'			=>$voucherno
		);
		$this->session->set_userdata('holding_money_receipt', $sData);
		
		$this->db->trans_start();
			$this->mgenerate->common_insert("transaction",$transaction_info);
			$this->mgenerate->common_insert("credit_voucher",$voucher_info);
			$this->mgenerate->common_insert("money",$moneyinfo);
			$this->mgenerate->common_insert("fund_sub_ctg",$sLedg);
			$this->mgenerate->common_insert("ledger",$ledg);
			
			if(isset($request['fiscalYear'])):
				foreach($request['fiscalYear'] as $key => $value):
					$temp_data = array(
						'invoice'	     => $voucherno,
						'dag_no'	     => $request['dagNo'],
						'holding_no'	 => $request['holdingNo'],
						'book_number'	 => $request['bookNumber'],
						'money_receipt'	 => $request['moneyNumber'],
						'fisyal_year_id' => $request['fiscalYear'][$key],
						'rate_sheet_id'	 => $request['holdingType'][$key],
						'sub_amount'     => $request['holdingAmount'][$key],
						'payment_date'	 => $payment_date,
						'created_by'	 => $this->session->userdata('id')
					);
					$this->db->insert('payment_log_bosotbita', $temp_data);
				endforeach;
			endif;
			
			//update bank account............
			$this->mgenerate->common_update_bankLedger("acinfo", "balance", "acno", $acno, $request['paymentAmount']);
			$this->mgenerate->common_update_bankLedger("mainctg", "balance", "id", $fRow->mc_id, $request['paymentAmount']);
			$this->mgenerate->common_update_bankLedger("subctg", "balance", "id",$fRow->id, $request['paymentAmount']);
		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE){
			echo json_encode(['status' => 'success', 'message' => 'Insert Successfully', 'data' => []]);exit;
		}
		else {
			echo json_encode(['status' => 'error', 'message' => 'Oops!!! Something error', 'data' => []]);exit;
		}
	}
?>