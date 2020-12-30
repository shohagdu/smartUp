 <?php
	extract($_POST);
	//print_r($_POST);exit;
	if(!isset($_POST['serviceList'])){
		echo "service id problem";exit;
	}
	if(!isset($_POST['delivery_type'])){
		echo "দয়া করে সরবরাহের  ধরণ নির্বাচন করুন";exit;
	}
	if(trim($bname)=="" || trim($ename)=="" || trim($emname)=="" || trim($bmane)=="" || trim($bashinda)==""){
		echo "আপনার সকল সঠিক তথ্য প্রদান করুন";exit;
	}
	if(isset($bfname) && trim($bfname)==""){
		echo "দয়া করে আপনার পিতা/ স্বামী  বাংলা নাম প্রবেশ করুন";exit;
	}
	if(trim($mob)==""){
		echo "দয়া করে আপনার মোবাইল নাম্বারটি প্রবেশ করুন";exit;
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
	if(trim($nationid)!=""){
		$this->db->select('*')->from('otherserviceinfo')->where('nationid',$nationid)->get();
		if($this->db->affected_rows()>0){ echo "2";exit;}
	}
	if(trim($bcno)!=""){ 
		$this->db->select('*')->from('otherserviceinfo')->where('bcno',$bcno)->get();
		if($this->db->affected_rows()>0){ echo "3";exit;}
	}
	if(trim($pno)!=""){ 
		$this->db->select('*')->from('otherserviceinfo')->where('pno',$pno)->get();
		if($this->db->affected_rows()>0){ echo "4";exit;}
	}
	/* if(trim($mob)!=""){ 
		$this->db->select('*')->from('otherserviceinfo')->where('mobile',$mob)->get();
		if($this->db->affected_rows()>0){ echo "6";exit;}
	} */
	if( $serviceList ==13 ){
		$sector_no = $sector;
	}else if($serviceList ==12 ){
		$sector_no = $sector2;
	}else{
		$sector_no = "";
	}
	
	if( $serviceList ==13 ){
		$mukti_sonod = $mukti_sonod;
	}else if($serviceList ==12 ){
		$mukti_sonod = $mukti_sonod2;
	}else{
		$mukti_sonod = "";
	}
	
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
	
	//if($profile=='') $profile=base_url().'img/default/profile.png'; // default img url...
	$trackid=$this->common->genaret_trackid(); 						// genaret_trackid..
	$ftrackid=$this->web->conArray($trackid); 						// bangla track for message..
	$dofb = date('Y-m-d',strtotime($dofb)); 						// change date formate..
	$cDate=date("Y-m-d"); 											// current date .....
	if($ddfb != ""){
		$ddfb = date('Y-m-d',strtotime($ddfb));						// death date for death certificate..
	}else{
		$ddfb = "0000-00-00";
	}

     if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
         $profile_info = $this->setup->uploadimage($_FILES['file']);
     }elseif(!empty($old_profile) && empty($_FILES['file']['name'])){
         $profile_info=$old_profile;
     }else{
         $profile_info='img/default/profile.png';
     }
	$data=array(
		'trackid'		=> $trackid,
		'delivery_type'	=> $delivery_type,
		'serviceId'		=> $serviceList,
		'mukti_name'	=> $mukti_name,
		'gejet_no'		=> $gejet_no,
		'm_sonshod_sonod'=> $m_sonshod_sonod,
		'relation'		=> $relation,
		'short_rel'		=> $short_rel,
		'sector_no'		=> $sector,
		'mukti_sonod'	=> $mukti_sonod,
		'incomeAmount'	=> $incomeAmount,
		'publishName'	=> $publishName,
		'workPlace'		=> $workPlace,
		'ddfb'			=> $ddfb,
		'nationid'		=> $nationid,
		'bcno'			=> $bcno,
		'pno'			=> $pno,
		'dofb'			=> $dofb,
		'ename'			=> $ename,
		'name'			=> $bname,
		'gender'		=> $gender,
		'mstatus'		=> $mstatus,
		'ewname'		=> $eWname,
		'bwname'		=> $bWname,
		'ehname'		=> $eHname,
		'bhname'		=> $bHname,
		'efname'		=> $efname,
		'bfname'		=> $bfname,
		'emname'		=> $emname,
		'mname'			=> $bmane,
		'ocupt'			=> $ocupt,
		'edustatus'		=> $qualification,
		'religion'		=> $religion,
		'bashinda'		=> $bashinda,
		'p_gram'		=> $p_gram,
		'pb_gram'		=> $pb_gram,
		'p_rbs'			=> $p_rbs,
		'pb_rbs'		=> $pb_rbs,
		'p_wordno'		=> $p_wordno,
		'pb_wordno'		=> $pb_wordno,
		'p_dis'			=> $p_dis,
		'pb_dis'		=> $pb_dis,
		'p_thana'		=> $p_thana,
		'pb_thana'		=> $pb_thana,
		'p_postof'		=> $p_postof,
		'pb_postof'		=> $pb_postof,
		'per_gram'		=> $per_gram,
		'perb_gram'		=> $perb_gram,
		'per_rbs'		=> $per_rbs,
		'perb_rbs'		=> $perb_rbs,
		'per_wordno'	=> $per_wordno,
		'perb_wordno'	=> $perb_wordno,
		'per_dis'		=> $per_dis,
		'perb_dis'		=> $perb_dis,
		'per_thana'		=> $per_thana,
		'perb_thana'	=> $perb_thana,
		'per_postof'	=> $per_postof,
		'perb_postof'	=> $perb_postof,
		'mobile'		=> $mob,
		'email'			=> $email,
		'attachment'	=> $attachment,
		'profile'		=> $profile_info,
		'status'		=> '0',
		'insert_time'	=> $cDate
	);
	// for tracking id....
	$tData=array(
		'trackid'=>$trackid
	);
	
	//check sms setting and get message
	$arguments=array(
		'0'=>1,
		'1'=>'nagorik_app_on'
	);
	$msg=$this->web->check_sms_setting($arguments);
	
	//sms notification
	// $msg="অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন";
	if($msg):
		$trackinginfo="  আপনার  ট্র্যাকিং নং : $ftrackid";
		$msg.=$trackinginfo;
		$this->web->sendSms($mob,$msg);
	    $inbox=array(
			'mobile'=>$mob,
			'trackid'=>$trackid,
			'msg'=>$msg
		);
    endif;
	$this->db->trans_start();
		$this->db->insert("tbl_tracking",$tData);
		$this->db->insert("otherserviceinfo",$data);
		if($msg):
			$this->db->insert('inbox',$inbox);
		endif;
	$this->db->trans_complete();
	
	$sData=array(
		'sCode'=>$trackid
	);
	$this->session->set_userdata($sData);

	if($this->db->trans_status() === TRUE){
		echo '11';exit;
	}
	else {
		echo "Oops!!! Something error";
	}
?>