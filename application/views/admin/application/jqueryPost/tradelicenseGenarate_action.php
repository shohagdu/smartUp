<?php
	if($_POST){
		$user=$this->session->userdata('username');
		extract($_POST);
		if(trim($fee)==""){echo "দয়া করে ট্রেড লাইসেন্স ফি প্রবেশ করুন.";exit;}
		if(trim($scharge)==""){echo "দয়া করে সাব চার্জ পরিমান প্রবেশ করুন.";exit;}
		$issue_date=date("Y-m-d",strtotime($issue_date));
		$expire_date=date("Y-m-d",strtotime($expire_date));
		
		if($gentype=='generate'){
			$sData=array(
				'bno'			=> $bno,
				'company'		=> $company,
				'bype'			=> $bype,
				'acno'			=> $acno,
				'issue_date'	=> $issue_date,
				'expire_date'	=> $expire_date,
				'fee'			=> $fee,
				'due'			=> $due,
				'sbfee'			=> $sbfee,
				'sb_fee'		=> $sb_fee,
				'discount'		=> $discount,
				'scharge'		=> $scharge,
				'vat'			=> $vat,
				'total'			=> $total,
				'payment_date'	=> $payment_date,
				'trackid'		=> $trackid
			);
			$this->session->set_userdata($sData);
			echo "3";exit;
		}
		else{
			//extract($this->session->all_userdata());
			
			if(trim($due)=='') {$due='0.00';}
			if(trim($discount)=="") {$discount='0.00';}
			
			if(isset($_POST['sb_fee']) && $sb_fee==1){$sb_fee=$sb_fee;$sbfee=$sbfee;} else {$sb_fee=$sbfee=0;}
			$payment_date=date("Y-m-d",strtotime($payment_date));
		
			$sonod=$this->common->genarate_sno();						//generate sonod no
			$tData=array('sno'=>$sonod);
			
			
			//find last transaction no and store....
			$transno=$this->transition->get_transaction();
			$transaction_info=array('tid'=>$transno);
			
			//find last credet voucher no and store....	
			$voucherno=$this->transition->get_credit_voucher();
			$voucher_info=array('vno'=>$voucherno);
			
			$book_info=array(
				'bno'			=> $bno,
				'fiscal_year'	=> $this->web->get_current_budget_year()
			);
			
			$license_history=array(
				'sno'			=> $sonod,
				'issue_date'	=> $issue_date,
				'expire_date'	=> $expire_date,
				'status'		=> '1'
			);
			
			$licenseinfo=array(
				'trackid'		=> $trackid,
				'bno'			=> $bno,
				'fiscal_year'	=> $this->web->get_current_budget_year(),
				'trno'			=> $transno,
				'vno'			=> $voucherno,
				'fee'			=> $fee,
				'due'			=> $due,
				'scharge'		=> $scharge,
				'sbfee'			=> $sbfee,
				'discount'		=> $discount,
				'vat'			=> $vat,
				'total'			=> $total,
				'payment_date'	=> $payment_date,
				'status'		=> '1',
				'update_by'		=> $user
			);
			
			$moneyinfo=array(
				'trackid'		=> $trackid,
				'bno'			=> $bno,
				'inno'			=> $voucherno,
				'fee'			=> $fee,
				'due'			=> $due,
				'scharge'		=> $scharge,
				'discount'		=> $discount,
				'vat'			=> $vat,
				'total'			=> $total,
				'payment_date'	=> $payment_date,
				'status'		=> 1
			);
			
			$key    ="ট্রেড লাইসেন্স ফি";
			$purpose="ট্রেড লাইসেন্স ফি";
			
			$fRow = $this->mgenerate->get_subctg_info($key);
			$fundId =  $this->mgenerate->get_fundId($fRow->mc_id);
			
			//previous balance acinfo..
			$Rrow=$this->transition->get_account_last_balance($acno);
			$nBalance=($Rrow->balance+$total);
			
			
			$ledg=array(
				'tid'			=> $transno,
				'voucherno'		=> $voucherno,
				'vtype'			=> 'C',
				'catid'			=> $fRow->mc_id,
				'subid'			=> $fRow->id,
				'fundtype'		=> $fundId->fund_id,
				'purpose'		=> $purpose,
				'ac'			=> $acno,
				'cr'			=> $total,
				'balance'		=> $nBalance,
				'payment_date'	=> $payment_date,
				'inby'			=> $user
			);
			
		 
			//get fund sub category last balance [ Individual sub category last balance]
			$scrow=$this->transition->get_fund_sub_category_last_balance($fRow->id);
			$snBalance=($scrow->balance+$total);
			
			$sLedg=array(
				'mc_id'			=> $fRow->mc_id,
				'subid'			=> $fRow->id,
				'fund_id'		=> $fundId->fund_id,
				'trno'			=> $transno,
				'voucherno'		=> $voucherno,
				'vtype'			=> 'C',
				'sub_title'		=> $fRow->sub_title,
				'cr'			=> $total,
				'balance'		=> $snBalance,
				'payment_date'	=> $payment_date
			);
			
			//start sms notification
			$bangla_sonod=$this->web->conArray($sonod);
			//check sms setting and get message
			$arguments=array(
				'0'=>2,
				'1'=>'tradelicense_sonod_on'
			);
			$msg=$this->web->check_sms_setting($arguments);

			//send and store sms notification
			if($msg):
				$sonodinfo="  আপনার  সনদ নং : $bangla_sonod";
				$msg.=$sonodinfo;
				$this->web->sendSms($mobile,$msg);
				$inbox=array(
					'mobile'=>$mobile,
					'trackid'=>$trackid,
					'msg'=>$msg
				);
			endif;
           //end sms notification
			$this->db->trans_start();
				$this->mgenerate->common_insert("up_sonods",$tData);
				$this->mgenerate->common_insert("tbl_books",$book_info);
				$this->mgenerate->common_insert("license_hostory",$license_history);
				$this->mgenerate->common_insert("transaction",$transaction_info);
				$this->mgenerate->common_insert("credit_voucher",$voucher_info);
				$this->mgenerate->common_insert("getlicense",$licenseinfo);
				$this->mgenerate->common_insert("money",$moneyinfo);
				$this->mgenerate->common_insert("fund_sub_ctg",$sLedg);
				$this->mgenerate->common_insert("ledger",$ledg);
				if($msg): $this->db->insert('inbox',$inbox); endif;
				
				//update bank....
				$this->db->query("update tradelicense set sno='$sonod', issue_date='$issue_date',expire_date='$expire_date',status='2' where trackid='$trackid' LIMIT 1");
				$this->mgenerate->common_update_bankLedger("acinfo", "balance", "acno", $acno, $total);
				$this->mgenerate->common_update_bankLedger("mainctg", "balance", "id", $fRow->mc_id, $total);
				$this->mgenerate->common_update_bankLedger("subctg", "balance", "id",$fRow->id, $total);
			$this->db->trans_complete();
			
			$this->session->unset_userdata('bno');
			$this->session->unset_userdata('company');
			$this->session->unset_userdata('bype');
			$this->session->unset_userdata('acno');
			$this->session->unset_userdata('fee');
			$this->session->unset_userdata('due');
			$this->session->unset_userdata('sbfee');
			$this->session->unset_userdata('sb_fee');
			$this->session->unset_userdata('discount');
			$this->session->unset_userdata('scharge');
			$this->session->unset_userdata('vat');
			$this->session->unset_userdata('total');
			$this->session->unset_userdata('payment_date');
			$this->session->unset_userdata('issue_date');
			$this->session->unset_userdata('expire_date');
			$this->session->unset_userdata('trackid');

			if($this->db->trans_status() === TRUE){
				echo "1";
			}
			else {
				echo "Oops!!! Something error";
			}
		}
	}
?>