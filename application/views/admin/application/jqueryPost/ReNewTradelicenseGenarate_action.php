<?php
	if($_POST){
		$user=$this->session->userdata('username');
		extract($_POST);
		//print_r($_POST);
		if(trim($fee)==""){echo "দয়া করে ট্রেড লাইসেন্স ফি প্রবেশ করুন.";exit;}
		if(isset($due)){if(trim($due)==""){echo "দয়া করে বকেয়া ফি প্রবেশ করুন.";exit;}}
		if(trim($scharge)==""){echo "দয়া করে সাব চার্জ পরিমান প্রবেশ করুন.";exit;}
		$issue_date=date("Y-m-d",strtotime($issue_date));
		$expire_date=date("Y-m-d",strtotime($expire_date));
		
		// echo "<pre>";
		// print_r($_POST);exit;
		if($gentype=='generate'){
			$sData=array(
				'bno'=>$bno,
				'company'=>$company,
				'bype'=>$bype,
				'acno'=>$acno,
				'issue_date'=>$issue_date,
				'expire_date'=>$expire_date,
				'fee'=>$fee,
				'due'=>$due,
				'sbfee'=>$sbfee,
				'sb_fee'=>$sb_fee,
				'discount'=>$discount,
				'scharge'=>$scharge,
				'vat'=>$vat,
				'total'=>$total,
				'payment_date'=>$payment_date,
				'trackid'=>$trackid,
				'sno'=>$sno,
				'mobile'=>$mobile
			);
			$this->session->set_userdata($sData);
			echo "3";exit;
		}
		else{
			
			//extract($this->session->all_userdata());
			extract($_POST);
			
			// echo "<pre>";
			// print_r($_POST);
			if(trim($due)=='') {$due='0.00';}
			if(trim($discount)=="") {$discount='0.00';}

			if(isset($_POST['sb_fee']) && $sb_fee==1){$sb_fee=$sb_fee;$sbfee=$sbfee;} else {$sb_fee=$sbfee=0;}

			//update sonod
			//print_r($payment_date);exit;
			//$payment_date=date('Y/m/d',strtotime($payment_date));

			$payment_date=date("Y-m-d",strtotime($payment_date));

			/*==== for sonod no generate =====*/
			/*
			$cyear=date('Y');
			$sonod=$this->web->genSonod($cyear);
			$tQy=$this->db->select('sno')->from('up_sonods')->where('sno',$sonod)->order_by('id','DESC')->limit('1')->get();
			if($this->db->affected_rows()>0){$sonod=$this->web->genSonod($cyear);}
			$tData=array(
				'sno'=>$sonod
			);
			*/

			// insert old data entry ****************start***************
			$isDate=$this->db->query("select issue_date,expire_date from tradelicense where sno='$sonod'")->row();

			$licenseHistory=array(
				'sno'=>$sonod,
				'issue_date'=>$isDate->issue_date,
				'expire_date'=>$isDate->expire_date,
				'status'=>1
			);
			
			// echo "<pre>";
			// print_r($licenseHistory);exit;
			$this->db->insert("license_hostory",$licenseHistory);
			
			// insert old data entry ****************ende***************
			$this->db->query("update renew_req set status='2' where sno ='$sonod'");

			$licenseHistoryNew=array(
				'sno'=>$sonod,
				'issue_date'=>$issue_date,
				'expire_date'=>$expire_date,
				'status'=>2
			);
			$this->db->insert("license_hostory",$licenseHistoryNew);

			//update invoice,voucher, trasaction
			//logs
			//find last invoice no
			//$invoice=$this->web->get_invoice();

			//find last transaction no
			$transno=$this->web->get_transaction();

			//find last voucher no
			$voucherno=$this->web->get_credit_voucher();

			//update issue & expire date & status
			$this->db->query("update tradelicense set issue_date='$issue_date',expire_date='$expire_date',status='2' where trackid='$trackid' LIMIT 1");

			$licenseinfo=array(
				'bno'=>$bno,
				'trackid'=>$trackid,
				'btype'=>$bype,
				'acno'=>$acno,
				'fee'=>$fee,
				'vat'=>$vat,
				'vno'=>$voucherno,
				'trno'=>$transno,
				'discount'=>$discount,
				'due'=>$due,
				'scharge'=>$scharge,
				'total'=>$total,
				'sbfee'=>$sbfee,
				'payment_date'=>$payment_date,
				'status'=>1
			);

			//echo "<pre>";
			//print_r($licenseinfo);
			//store generted license info and payment detials

			$moneyinfo=array(
				'trackid'=>$trackid,
				'acno'=>$acno,
				'fee'=>$fee,
				'vat'=>$vat,
				'inno'=>$voucherno,
				'btype'=>$bype,
				'discount'=>$discount,
				'due'=>$due,
				'scharge'=>$scharge,
				'total'=>$total,
				'payment_date'=>$payment_date,
				'status'=>1
			);
			
			//echo "<pre>";
			//print_r($moneyinfo);exit;
			//store trade license book no
			$book_info=array(
			'bno'=>$bno,
			'budget_year'=>$this->web->get_current_budget_year()
			);

			//store transaction no
			$transaction_info=array('tid'=>$transno);

			//store credit voucher no
			$voucher_info=array('vno'=>$voucherno);


			$key="ট্রেড লাইসেন্স ফি";
			$fRow=$this->web->get_subctg_info($key); // get sub category name,fund id,main category Name
			//previous balance
			$Rrow=$this->web->get_account_last_balance($acno);
			// echo $Rrow->balance; exit;
			$nBalance=($Rrow->balance+$total);
			//echo $this->db->last_query();exit;

			//update ledger
			$ledg=array(
				'tid'=>$transno,
				'catid'=>$fRow->mc_id,
				'subid'=>$fRow->id,
				'voucherno'=>$voucherno,
				'fundtype'=>$fRow->fund_id,
				'payment_date'=>$payment_date,
				'ac'=>$acno,
				'purpose'=>$key,
				'cr'=>$total, 		   
				'balance'=>$nBalance, 		   
				'inby'=>$user
			);

			//get fund sub category last balance [ Individual sub category last balance]
			$scrow=$this->web->get_fund_sub_category_last_balance($fRow->id);
			$snBalance=($scrow->balance+$total);
			//sub ctg ledger
			$sLedg=array(
				'fund_id'=>$fRow->fund_id,
				'mc_id'=>$fRow->mc_id,
				'sub_title'=>$fRow->sub_title,
				'cr'=>$total,
				'voucherno'=>$voucherno,
				'payment_date'=>$payment_date,
				'trno'=>$transno,
				'balance'=>$snBalance
			);
			//start sms notification
			$bangla_sonod=$this->web->conArray($sonod);
			//check sms setting and get message
			$arguments=array(
			'0'=>4,
			'1'=>'tradelicense_renew_On'
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
			$this->db->insert('inbox',$inbox);
			endif;
           //end sms notification
			
			//execute all queries
			$this->db->trans_start();
			
			//store union trade lincse sonod no......
			//$this->web->store_up_sonod_no($tData,$sonod,$trackid);
			$this->web->store_licenseinfo($licenseinfo);
			$this->web->store_moneyrecipt($moneyinfo);
			$this->web->store_book_no($book_info);
			$this->web->store_transaction_no($transaction_info);
			$this->web->store_credit_voucher_no($voucher_info);
			$this->web->store_sub_ledger_info($sLedg);
			$this->web->store_bank_ledger_info($ledg);

			//update bank account............
			$this->web->update_bank_balance($acno,$total);
			$this->web->update_fund_subctg_balance($fRow->id,$total);
			$this->web->update_fund_mainctg_balance($fRow->mc_id,$total);
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
			$this->session->unset_userdata('trackid');
			echo "1";
		}
	}
?>