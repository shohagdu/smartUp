<?php
	extract($_POST);
	$uid=$this->input->post('uid',TRUE);
	if(trim($bname)=="" || trim($ename)==""){ echo "আপনার সকল সঠিক তথ্য প্রদান করুন";exit;}
	if(trim($mob)==""){echo "দয়া করে আপনার মোবাইল নাম্বারটি প্রবেশ করুন";exit;}
	if(trim($nationid)!=""){
		//$this->db->select('*')->from('tbl_warishes')->where('nationid',$nationid)->get();
		$this->db->query("select * from tbl_warishesinfo where nationid='$nationid' and trackid not in('$trackid') LIMIT 1");
		if($this->db->affected_rows()>0){ echo "2";exit;}
	}

	if(trim($mobile)!=""){ 
		//$this->db->select('*')->from('tbl_warishes')->where('mobile',$mobile)->get();
		$this->db->query("select * from tbl_warishesinfo where mobile='$mobile' and trackid not in('$trackid') LIMIT 1");
		if($this->db->affected_rows()>0){ echo "6";exit;}
	}

	if(trim($bcno)!=""){ 
		$this->db->select('*')->from('tbl_warishes')->where('bcno',$bcno)->get();
		$this->db->query("select * from tbl_warishesinfo where bcno='$bcno' and trackid not in('$trackid') LIMIT 1");
		if($this->db->affected_rows()>0){ echo "3";exit;}
	}
	if(trim($pno)!=""){ 
		$this->db->select('*')->from('tbl_warishes')->where('pno',$pno)->get();
		$this->db->query("select * from tbl_warishesinfo where pno='$pno' and trackid not in('$trackid') LIMIT 1");
		if($this->db->affected_rows()>0){ echo "4";exit;}
	}
	if(trim($nationid!="")){
		$bnid=$this->web->banglatk($nationid);
	}

	if(trim($bcno!="")){
		$bbcno=$this->web->banglatk($bcno);;
	}
	if(trim($pno!="")){
		$bpno=$this->web->banglatk($pno);
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
	if(trim($phone)==""){ $phone="";}
	$data=array(
		'delivery_type'					=> $delivery_type,
		'nationid'						=> $nationid,
		'bcno'							=> $bcno,
		'pno'							=> $pno,
		'dofb'							=> $dofb,
		'ename'							=> $ename,
		'bname'							=> $bname,
		'gender'						=> $gender,
		'mstatus'						=> $mstatus,
		'ewname'						=> $ewname,
		'bwname'						=> $bwname,
		'ehname'						=> $ehname,
		'bhname'						=> $bhname,
		'efname'						=> $efname,
		'bfname'						=> $bfname,
		'emname'						=> $emname,
		'bmane'							=> $bmane,
		'ocupt'							=> $ocupt,
		'bashinda'						=> $bashinda,
		'p_gram'						=> $p_gram,
		'pb_gram'						=> $pb_gram,
		'p_rbs'							=> $p_rbs,
		'pb_rbs'						=> $pb_rbs,
		'p_wordno'						=> $p_wordno,
		'pb_wordno'						=> $pb_wordno,
		'p_dis'							=> $p_dis,
		'pb_dis'						=> $pb_dis,
		'p_thana'						=> $p_thana,
		'pb_thana'						=> $pb_thana,
		'p_postof'						=> $p_postof,
		'pb_postof'						=> $pb_postof,
		'per_gram'						=> $per_gram,
		'perb_gram'						=> $perb_gram,
		'per_rbs'						=> $per_rbs,
		'perb_rbs'						=> $perb_rbs,
		'per_wordno'					=> $per_wordno,
		'perb_wordno'					=> $perb_wordno,
		'per_dis'						=> $per_dis,
		'perb_dis'						=> $perb_dis,
		'per_thana'						=> $per_thana,
		'perb_thana'					=> $perb_thana,
		'per_postof'					=> $per_postof,
		'perb_postof'					=> $perb_postof,
		'english_applicant_name'		=> $english_applicant_name,
		'bangla_applicant_name'			=> $bangla_applicant_name,
		'english_applicant_father_name'	=> $english_applicant_father_name,
		'bangla_applicant_father_name'	=> $bangla_applicant_father_name,
		'mobile'						=> $mob,
		'email'							=> $email,
		'note'							=> (empty(trim($appNote)) ? NULL : $appNote),
		'verifier_name'					=> $verifier_name
		//'falive'						=> $falive,
		//'malive'						=> $malive,
	);
	//$count_w=count($w_name1);
	$i=0;
	foreach($w_name1 as $value):
		$new_warish=array(
			'trackid'=>$trackid,
			'w_name'=>$value,
			'w_relation'=>$w_rel1[$i],
			'w_age'=>$w_age1[$i]
		);
		$this->db->insert("warishinfo",$new_warish);
		$i++;
	endforeach;
	$this->db->where('id',$uid);
	$up=$this->db->update("tbl_warishesinfo",$data);
	
	if($up){echo '1';} else { echo '0';}
?>		