<?php
	extract($_POST);
	if(!isset($_POST['delivery_type'])){
		echo "দয়া করে সরবরাহের  ধরণ নির্বাচন করুন";exit;
	}
	if($_POST['ownertype']==""){
		echo "দয়া করে প্রতিষ্ঠানের মালিকানার ধরণ নির্বাচন করুন";exit;
	}
	if(trim($bcomname)=="" || trim($ecomname)==""){ 
		echo "আপনার প্রতিষ্ঠানের নাম ইংরেজী ও বাংলায় প্রদান করুন";exit;
	}
	if(trim($ewname[0])=="" || trim($bwname[0])=="" || trim($emname[0])=="" || trim($bmname[0])==""){
		echo "দয়া করে উপরে এক জন মালিকের সম্পূর্ন তথ্য প্রদান করুন",exit;
	}
	if($business_type==""){
		echo "দয়া করে  আপানার ব্যবসার ধরন নির্বাচন করুন ";exit;
	}
	if(trim($mob) == ""){
		echo "দয়া করে মো্বাইল নম্বর প্রদান করুন";exit;
	}
	if(trim($ecomname)!=""){ 
		$this->db->select('*')->from('tradelicense')->where('ecomname',$ecomname)->get();
		if($this->db->affected_rows()>0){ 
			echo "দুঃখিত  আপনার প্রতিষ্ঠানের নামটি পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;
		}
	}
	if(trim($bcomname)!=""){ 
		$this->db->select('*')->from('tradelicense')->where('bcomname',$bcomname)->get();
		if($this->db->affected_rows()>0){
			echo "দুঃখিত আপনার প্রতিষ্ঠানের নামটি পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;
		}
	}
	if(strlen($vatid)>2){ 
		$this->db->select('*')->from('tradelicense')->where('vatid',$vatid)->get();
		if($this->db->affected_rows()>0){
			echo "দুঃখিত আপানর ভ্যাট নং পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;
		}
	}
	if(strlen($taxid)>2){ 
		$this->db->select('*')->from('tradelicense')->where('taxid',$taxid)->get();
		if($this->db->affected_rows()>0){
			echo "দুঃখিত আপানর ট্যাক্স নং  পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;
		}
	}
	/*
	if(trim($mob)!=""){ 
		$this->db->select('*')->from('tradelicense')->where('mobile',$mob)->get();
		if($this->db->affected_rows()>0){
			echo "দুঃখিত আপানর মোবাইল নাম্বারটি পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;
		}
	}
	*/
 
	$bw_bname="";
	$bw_ename="";
	$bw_efname="";
	$bw_bfname="";
	$bw_emname="";
	$bw_bmname="";
	
	foreach ($ewname as $en):
		$bw_ename.=$en.',';
	endforeach;
	$bw_ename=chop($bw_ename,',');
	
	foreach ($bwname as $wn):
		$bw_bname.=$wn.',';
	endforeach;
	$bw_bname=chop($bw_bname,',');
	
	foreach ($efname as $en):
		$bw_efname.=$en.',';
	endforeach;
	$bw_efname=chop($bw_efname,',');
	
	foreach ($bfname as $en):
		$bw_bfname.=$en.',';
	endforeach;
	$bw_bfname=chop($bw_bfname,',');
	
	foreach ($emname as $en):
		$bw_emname.=$en.',';
	endforeach;
	$bw_emname=chop($bw_emname,',');
	
	foreach ($bmname as $en):
		$bw_bmname.=$en.',';
	endforeach;
	$bw_bmname=chop($bw_bmname,',');
	

	if(!isset($_POST[gender])){$gender=0;}
	else{$gender=implode(",",$gender);}

	if(!isset($_POST[mstatus])){$mstatus=0;}
	else{$mstatus=implode(",",$mstatus);}

	if(!isset($_POST[bsname])){$bsname=0;}
	else{$bsname=implode(",",$bsname);}

	if(!isset($_POST[esname])){$esname=0;}
	else{$esname=implode(",",$esname);}

	$btypes=trim($business_type);$business_type=trim($btypes,'"'); // business type trim and remove (")...
	//if($profile=='') $profile=base_url().'img/default/profile.png'; 	// default img url...
	$profile_info= !empty($_FILES['file'])? $this->setup->uploadimage($_FILES['file']):'img/default/profile.png';
	$trackid=$this->common->genaret_trackid();							// generate trackid...
	$ftrackid=$this->web->conArray($trackid);							// bangla trackid for message....
	$insert_time=date('Y-m-d');											// current date .......
	
	// for trackid......
	$tData=array(
		'trackid'=>$trackid
	);
	// for tradelicense....
	$data = array(
		'trackid'		=> $trackid,
		'delivery_type'	=> $delivery_type,
		'app_type'		=> $app_type,
		'ownertype'		=> $ownertype,
		'ecomname'		=> $ecomname,
		'bcomname'		=> $bcomname,
		'ewname'		=> $bw_ename,
		'bwname'		=> $bw_bname,
		'gender'		=> $gender,
		'mstatus'		=> $mstatus,
		'efname'		=> $bw_efname,
		'bfname'		=> $bw_bfname,
		'ehname'		=> $esname,
		'bhname'		=> $bsname,
		'emname'		=> $bw_emname,
		'bmane'			=> $bw_bmname,
		'vatid'			=> $vatid,
		'taxid'			=> $taxid,
		'btype'			=> $business_type,
		'btype_english' => $business_type_english,
		'pay_amount'	=> $pay_amount,
		'be_gram'		=> $be_gram,
		'bb_gram'		=> $bb_gram,
		'be_rbs'		=> $be_rbs,
		'bb_rbs'		=> $bb_rbs,
		'be_wordno'		=> $be_wordno,
		'bb_wordno'		=> $bb_wordno,
		'be_dis'		=> $be_dis,
		'bb_dis'		=> $bb_dis,
		'be_thana'		=> $be_thana,
		'bb_thana'		=> $bb_thana,
		'be_postof'		=> $be_postof,
		'bb_postof'		=> $bb_postof,
		'mobile'		=> $mob,
		'phone'			=> $phone,
		'email'			=> $email,
		'profile'		=> $profile_info,
		'status'		=> 1,
		'insert_time'	=> $insert_time,
		'syn_status'	=> 1
	);
	
	// for inbox...
	$msg="আপনার  ট্র্যাকিং নং : $trackid অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন";
	$inbox=array(
		'mobile'=>$mob,
		'trackid'=>$trackid,
		'msg'=>$msg
	);
	$this->db->trans_start();
		$this->db->insert("tbl_tracking",$tData);
		$this->db->insert('tradelicense',$data);
		//$this->web->sendSms($mob,$msg);
		$this->db->insert('inbox',$inbox);
	$this->db->trans_complete();
	
	$sData=array(
		'trackid'=>$trackid
	);
    $this->session->set_userdata($sData);
	
	if($this->db->trans_status()=== TRUE){
		echo "1";
	}
	else{
		echo "Oops!!! Something error";
	}
	
?>
	