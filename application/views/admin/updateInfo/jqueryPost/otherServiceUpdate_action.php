<?php
	extract($_POST);
//	print_r($_POST);exit;
	$uid=$this->input->post('uid',TRUE);	
	if(trim($bname)=="" || trim($ename)==""){ echo "আপনার সকল সঠিক তথ্য প্রদান করুন";exit;}
	if(trim($mob)==""){echo "দয়া করে আপনার মোবাইল নাম্বারটি প্রবেশ করুন";exit;}

	//if(trim($nationid)>5){ 
	//$this->db->select('*')->from('tbl_warishes')->where('nationid',$nationid)->get();
	//$this->db->query("select * from otherserviceinfo where nationid=$nationid and trackid not in($trackid) LIMIT 1");
	// if($this->db->affected_rows()>0){ echo "2";exit;}
	//}

	/* if(trim($mob)>10){
		//$this->db->select('*')->from('tbl_warishes')->where('mobile',$mobile)->get();
		$this->db->query("select * from otherserviceinfo where mobile=$mob and trackid not in($trackid) LIMIT 1");
		if($this->db->affected_rows()>0){ echo "6";exit;}
	} */

	if(trim($bcno)>5){ 
		//$this->db->select('*')->from('tbl_warishes')->where('bcno',$bcno)->get();
		$this->db->query("select * from otherserviceinfo where bcno=$bcno and trackid not in($trackid) LIMIT 1");
		if($this->db->affected_rows()>0){ echo "3";exit;}
	}
	if(trim($pno)>5){ 
		//$this->db->select('*')->from('tbl_warishes')->where('pno',$pno)->get();
		$this->db->query("select * from otherserviceinfo where pno=$pno and trackid not in($trackid) LIMIT 1");
		if($this->db->affected_rows()>0){ echo "4";exit;}
	}
	if(trim($nationid>5)){
		$bnid="";
		$len=strlen($nationid);
		$second=str_split($nationid);
		for($i=0;$i<$len;$i++):
		$en=$second[$i];
		$bnid.=$this->web->ceb($en);
		endfor;
	}

	if(trim($bcno>5)){
		$bbcno="";
		$len=strlen($bcno);
		$second=str_split($bcno);
		for($i=0;$i<$len;$i++):
		$en=$second[$i];
		$bbcno.=$this->web->ceb($en);
		endfor;
	}
	if(trim($pno>5)){
		$bpno="";
		$len=strlen($pno);
		$second=str_split($pno);
		for($i=0;$i<$len;$i++):
		$en=$second[$i];
		$bpno.=$this->web->ceb($en);
		endfor;
	}
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
	
	if(isset($_POST['bashinda']) && $bashinda==2){
		$per_thana=$p_thana;
		$per_dis=$p_dis;
		$per_rbs=$p_rbs;
		$per_wordno=$p_wordno;
		$per_gram=$p_gram;
		$per_postof=$p_postof;
		$perb_thana=$pb_thana;
		$perb_dis=$pb_dis;
		$perb_rbs=$pb_rbs;
		$perb_wordno=$pb_wordno;
		$perb_gram=$pb_gram;
		$perb_postof=$pb_postof;
	}
	
	if(!isset($_POST['eHname'])){
		$eHname = "";
	}
	if(!isset($_POST['bHname'])){
		$bHname = "";
	}
	if(!isset($_POST['eWname'])){
		$eWname = "";
	}
	if(!isset($_POST['bWname'])){
		$bWname = "";
	}
	if(($gender=='female' || $gender=='male') && ($mstatus==2)){
		$eHname = "";
		$bHname = "";
		$eWname = "";
		$bWname = "";
	}
	if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
		$profile_info = $this->setup->uploadimage($_FILES['file']);
	}elseif(!empty($profile) && empty($_FILES['file']['name'])){
		$profile_info=$profile;
	}else{
		$profile_info='img/default/profile.png';
	}
	$data=array(
		'delivery_type'	=> $delivery_type,
		'serviceId'		=> $serviceList,
		'mukti_name'	=> $mukti_name,
		'gejet_no'		=> $gejet_no,
		'm_sonshod_sonod'=> $m_sonshod_sonod,
		'relation'		=> $relation,
		'short_rel'		=> $short_rel,
		'sector_no'		=> $sector_no,
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
		'profile'		=> $profile_info
	);
	
	$this->db->where('id',$uid);
	$up=$this->db->update("otherserviceinfo",$data);
	
	if($up){echo '1';} else { echo '0';}
?>		