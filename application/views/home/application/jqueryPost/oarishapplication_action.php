<?php
	extract($_POST);
	if(!isset($_POST['delivery_type'])){
		echo "দয়া করে সরবরাহের  ধরণ নির্বাচন করুন";exit;
	}
	if(trim($ename)=="" || trim($bname)=="" || trim($emname)=="" || trim($bmane)==""){
		echo "আপনার সকল সঠিক তথ্য প্রদান করুন";exit;
	}
	if(trim($english_applicant_name)=="" || trim($bangla_applicant_name)=="" || trim($english_applicant_father_name)=="" || trim($bangla_applicant_father_name)==""){
		echo "যোগাযোগের জন্য আপনার সকল সঠিক তথ্য প্রদান করুন";exit;
	}
	if(trim($gender)==""){
		echo "দয়া করে লিঙ্গ সিলেক্ট করুন";exit;
	}
	if(trim($mstatus)==""){
		echo "দয়া করে বৈবাহিক অবস্থা সিলেক্ট করুন";exit;
	}
	if(($gender=='male') && ($mstatus==1)){
		if(trim($eWname)=="" && trim($bWname)==""){
			echo "দয়া করে স্ত্রীর নাম বাংলায় ও ইংরেজিতে প্রদান করুন ।";
			exit;
		}
	}
	if(($gender=='female') && ($mstatus==1)){
		if(trim($eHname)=="" && trim($bHname)==""){
			echo "দয়া করে স্বামীর নাম বাংলায় ও ইংরেজিতে প্রদান করুন ।";
			exit;
		}
	}
	if(trim($warishname[0])== "" || trim($warishrel[0])=="" || trim($warishage[0])==""){
		echo "দয়া করে নিচে একজন ওয়ারিশ এর তথ্য প্রদান করুন";exit;
	}
	if(trim($mob)=="" || substr($mob,-11)<11){
		echo "দয়া করে আপনার মোবাইল নাম্বারটি প্রবেশ করুন";exit;
	}
	
	if(trim($nationid)!==""){ 
		$this->db->select('*')->from('tbl_warishesinfo')->where('nationid',$nationid)->get();
		if($this->db->affected_rows()>0){ echo "2";exit;}
	}
	if(trim($bcno)!==""){ 
		$this->db->select('*')->from('tbl_warishesinfo')->where('bcno',$bcno)->get();
		if($this->db->affected_rows()>0){ echo "3";exit;}
	}
	if(trim($pno)!==""){ 
		$this->db->select('*')->from('tbl_warishesinfo')->where('pno',$pno)->get();
		if($this->db->affected_rows()>0){ echo "4";exit;}
	}
	/*if(trim($mob)!==""){ 
		$this->db->select('*')->from('tbl_warishesinfo')->where('mobile',$mob)->get();
		if($this->db->affected_rows()>0){ echo "6";exit;}
	}*/
	
	if(($gender=='female' || $gender=='male') && ($mstatus==2)){
		$eHname = "";
		$bHname = "";
		$eWname = "";
		$bWname = "";
	}
	
	if(isset($_POST['bashinda']) && $_POST['bashinda']==2){
		$per_thana	=	$p_thana;
		$per_dis	=	$p_dis;
		$per_rbs	=	$p_rbs;
		$per_wordno	=	$p_wordno;
		$per_gram	=	$p_gram;
		$per_postof	=	$p_postof;
		$perb_thana	=	$pb_thana;
		$perb_dis	=	$pb_dis;
		$perb_rbs	=	$pb_rbs;
		$perb_wordno=	$pb_wordno;
		$perb_gram	=	$pb_gram;
		$perb_postof=	$pb_postof;
	}
	
	$trackid=$this->common->genaret_trackid(); 						// genaret_trackid..
	$ftrackid=$this->web->conArray($trackid); 						// bangla track for message..
	$dofb = date('Y-m-d',strtotime($dofb)); 						// change date formate..
	$CuDate=date("Y-m-d");											// current date.......
	
	// if father and mother live then count as a warish
	if($flive==1){
		$fdata = array(
			'trackid'=>$trackid,
			'w_name'=>$bfname,
			'w_relation'=>'পিতা',
			'w_age'=>$fyears
		);
	}
	if($mlive==1){
		$mdata = array(
			'trackid'=>$trackid,
			'w_name'=>$bmane,
			'w_relation'=>'মাতা',
			'w_age'=>$myears
		);
	}
	$data = array(
		'trackid'						=>	$trackid,
		'delivery_type'					=>	$delivery_type,
		'nationid'						=>	$nationid,
		'bcno'							=>	$bcno,
		'pno'							=>	$pno,
		'dofb'							=>	$dofb,
		'ename'							=>	$ename,
		'bname'							=>	$bname,
		'gender'						=>	$gender,
		'mstatus'						=>	$mstatus,
		'ewname'						=>	$ewname,
		'bwname'						=>	$bwname,
		'ehname'						=>	$ehname,
		'bhname'						=>	$bhname,
		'efname'						=>	$efname,
		'bfname'						=>	$bfname,
		'emname'						=>	$emname,
		'bmane'							=>	$bmane,
		'ocupt'							=>	$ocupt,
		'bashinda'						=>	$bashinda,
		'p_gram'						=>	$p_gram,
		'pb_gram'						=>	$pb_gram,
		'p_rbs'							=>	$p_rbs,
		'pb_rbs'						=>	$pb_rbs,
		'p_wordno'						=>	$p_wordno,
		'pb_wordno'						=>	$pb_wordno,
		'p_dis'							=>	$p_dis,
		'pb_dis'						=>	$pb_dis,
		'p_thana'						=>	$p_thana,
		'pb_thana'						=>	$pb_thana,
		'p_postof'						=>	$p_postof,
		'pb_postof'						=>	$pb_postof,
		'per_gram'						=>	$per_gram,
		'perb_gram'						=>	$perb_gram,
		'per_rbs'						=>	$per_rbs,
		'perb_rbs'						=>	$perb_rbs,
		'per_wordno'					=>	$per_wordno,
		'perb_wordno'					=>	$perb_wordno,
		'per_dis'						=>	$per_dis,
		'perb_dis'						=>	$perb_dis,
		'per_thana'						=>	$per_thana,
		'perb_thana'					=>	$perb_thana,
		'per_postof'					=>	$per_postof,
		'perb_postof'					=> 	$perb_postof,
		'english_applicant_name'		=> 	$english_applicant_name,
		'bangla_applicant_name'			=> 	$bangla_applicant_name,
		'english_applicant_father_name'	=> 	$english_applicant_father_name,
		'bangla_applicant_father_name'	=> 	$bangla_applicant_father_name,
		'mobile'						=>	$mob,
		'email'							=> 	$email,
		'note'							=>  (empty(trim($appNote)) ? NULL : $appNote),
		'status'						=>	'0',
		'ins_time'						=> 	$CuDate
	);
	// for tracking table.....
	$tData=array(
		'trackid'=>$trackid
	);
	
	//sms notification
	$msg="আপনার  ট্র্যাকিং নং : $trackid অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন";
	//$this->web->sendSms($mob,$msg);
	$inbox = array(
		'mobile'	=> $mob,
		'trackid'	=> $trackid,
		'msg'		=> $msg
	); 
	
	$this->db->trans_start();
		$this->db->insert("tbl_tracking",$tData);
		$this->db->insert('tbl_warishesinfo',$data);
		if($flive== 1):
			$this->db->insert("warishinfo",$fdata);
		endif;
		if($mlive==1):
			$this->db->insert("warishinfo",$mdata);
		endif;
		if(isset($_POST['warishname'])):
			foreach($warishname as $key => $value):
				$wdata = array(
					'trackid'	=> $trackid,
					'w_name'	=> $value,
					'w_relation'=> $warishrel[$key],
					'w_age'		=> $warishage[$key]
				);
				$this->db->insert('warishinfo',$wdata);
			endforeach;
		endif;
		$this->db->insert('inbox',$inbox);
	$this->db->trans_complete();

	$wdata=array(
		'wCode'=>$trackid
	);
	$this->session->set_userdata($wdata);
	
	if($this->db->trans_status() === TRUE){
		echo "1";
	}
	else{
		echo "Oops!! Something error";
	}
?>