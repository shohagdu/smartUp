<?php 
	if($_POST){
		$user=$this->session->userdata('username');
		extract($_POST);
		//if($fee<1){ echo "ফি পরিমান নির্ধারণ করুন";exit;}
		if($gentype=='Generate'){
			$sData=array(
				'name'			=> $name,
				'serviceId'		=> $serviceId,
				'mobile'		=> $mobile,
				'payment_date'	=> $payment_date,
				'fee'			=> $fee,
				'trackid'		=> $trackid,
				'bfname'		=> $bfname,
				'attachment'	=> $attachment,
				'acno'			=> $acno,
				'profile'		=> $profile,
				'uid'			=> $uid
			);
			$this->session->set_userdata($sData);
			echo "3";exit;
		}
		if($gentype=='Continue')
		{
			//print_r($_POST);exit;
			$payment_date=date('Y-m-d',strtotime($payment_date));		// payment date..
			$sonod=$this->common->genarate_sno();						//generate sonod no
			$tData=array('sno'=>$sonod);
			
			//find last transaction no and store....
			$transno=$this->transition->get_transaction();
			$transaction_info=array('tid'=>$transno);
			
			//find last credet voucher no and store....	
			$voucherno=$this->transition->get_credit_voucher();
			$voucher_info=array('vno'=>$voucherno);
			
			//find last applicant id for serial number....
			$applicant_id = $this->mgenerate->get_applicant_id('onnanoseba', 'applicant_id');
			
			$onnanoseba_tbl=array(
				'trackid'		=>	$trackid,
				'applicant_id'	=>	$applicant_id,
				'trno'			=>	$transno,
				'vno'			=>	$voucherno,
				'acno'			=>	$acno,
				'fee'			=>	$fee,
				'payment_date'	=>	$payment_date
			);
			
			$moneyinfo=array(
				'trackid'		=> $trackid,
				'inno'			=> $voucherno,
				'fee'			=> $fee,
				'total'			=> $fee,
				'payment_date'	=> $payment_date,
				'status'		=> 5
			);
			
			$key="udc fee";
			//$purpose="নাগরিক সনদ";
			$purpose =  $this->applicant->serviceNameShow($serviceId)->listName;
			
			// get sub category name,main category Name
			$fRow = $this->mgenerate->get_subctg_info($key);
			$fundId =  $this->mgenerate->get_fundId($fRow->mc_id);
			
			//previous balance acinfo..
			$Rrow=$this->transition->get_account_last_balance($acno);
			$nBalance=($Rrow->balance+$fee);
			
			$ledg=array(
				'tid'			=> $transno,
				'voucherno'		=> $voucherno,
				'vtype'			=> 'C',
				'catid'			=> $fRow->mc_id,
				'subid'			=> $fRow->id,
				'fundtype'		=> $fundId->fund_id,
				'purpose'		=> $purpose,
				'ac'			=> $acno,
				'cr'			=> $fee,
				'balance'		=> $nBalance,
				'payment_date'	=> $payment_date,
				'inby'			=> $user
			);
			
			//get fund sub category last balance [ Individual sub category last balance]
			$scrow=$this->transition->get_fund_sub_category_last_balance($fRow->id);
			$snBalance=($scrow->balance+$fee);
			
			$sLedg=array(
				'mc_id'			=> $fRow->mc_id,
				'subid'			=> $fRow->id,
				'fund_id'		=> $fundId->fund_id,
				'trno'			=> $transno,
				'voucherno'		=> $voucherno,
				'vtype'			=> 'C',
				'sub_title'		=> $fRow->sub_title,
				'cr'			=> $fee,
				'balance'		=> $snBalance,
				'payment_date'	=> $payment_date
			);
			
			//sms notification
			$bangla_sonod=$this->web->conArray($sonod);
			//check sms setting and get message
			$arguments=array(
				'0'=>2,
				'1'=>'nagorik_sonod_on'
			);
			$msg=$this->web->check_sms_setting($arguments);

			//sms notification
			// $msg="অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন";
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
			
			$this->db->trans_start();
				$this->mgenerate->common_insert("up_sonods",$tData);
				$this->mgenerate->common_insert("transaction",$transaction_info);
				$this->mgenerate->common_insert("credit_voucher",$voucher_info);
				$this->mgenerate->common_insert("onnanoseba",$onnanoseba_tbl);
				$this->mgenerate->common_insert("money",$moneyinfo);
				$this->mgenerate->common_insert("fund_sub_ctg",$sLedg);
				$this->mgenerate->common_insert("ledger",$ledg);
				if($msg): $this->db->insert('inbox',$inbox); endif;
				
				//update bank....
				$this->db->query("update otherserviceinfo set attachment='$attachment',sonodno='$sonod',status='1' where id='$uid' LIMIT 1"); 
				$this->mgenerate->common_update_bankLedger("acinfo", "balance", "acno", $acno, $fee);
				$this->mgenerate->common_update_bankLedger("mainctg", "balance", "id", $fRow->mc_id, $fee);
				$this->mgenerate->common_update_bankLedger("subctg", "balance", "id",$fRow->id, $fee);
			$this->db->trans_complete();
			
			$this->session->unset_userdata('uid');
			$this->session->unset_userdata('serviceId');
			$this->session->unset_userdata('trackid');
			$this->session->unset_userdata('profile');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('bfname');
			$this->session->unset_userdata('mobile');
			$this->session->unset_userdata('attachment');
			$this->session->unset_userdata('acno');
			$this->session->unset_userdata('fee');
			$this->session->unset_userdata('payment_date');
			
			if($this->db->trans_status() === TRUE){
				echo "1";
			}
			else {
				echo "Oops!!! Something error";
			}
		}
	}