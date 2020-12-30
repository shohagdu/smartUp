<?php 
	extract($_POST);

	if(trim($bcomname)=="" || trim($ecomname)==""){ echo "আপনার সকল সঠিক তথ্য প্রদান করুন";exit;}
	if($btype==""){echo "দয়া করে  আপানার ব্যবসার ধরন নির্বাচন করুন ";exit;}
	
	if(trim($mob)==""){echo "5";exit;}
	if(trim($nationid)=="") $nationid="";
	if(trim($bcno)=="") $bcno="";
	if(trim($pno)=="") $pno="";


	/*if(trim($ecomname)!=""){ 
		$this->db->query("select * from tradelicense where ecomname='$ecomname' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "দুঃখিত  আপনার প্রতিষ্ঠানের    নামটি পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;}
	}*/
 
	if(strlen($vatid)>5){ 
		$this->db->query("select * from tradelicense where vatid='$vatid' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "দুঃখিত আপানর ভ্যাট নং পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;}
	}
	if(strlen($taxid)>5){ 
		$this->db->query("select * from tradelicense where taxid='$taxid' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "দুঃখিত আপানর ট্যাক্স নং  পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;}
	}
 
	/* if(trim($bcomname)!=""){ 
		$this->db->query("select * from tradelicense where bcomname='$bcomname' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "দুঃখিত আপনার প্রতিষ্ঠানের   নামটি পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন";exit;}
	}*/
 
	if(trim($nationid)>11){ 
		$this->db->query("select * from tradelicense where nationid='$nationid' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "2";exit;}
	}
	if(trim($bcno)>11){ 
		$this->db->query("select * from tradelicense where bcno='$bcno' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "3";exit;}
	}
	if(trim($pno)>5){ 
		$this->db->query("select * from tradelicense where pno='$pno' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "4";exit;}
	}
	if(trim($mob)>11){ 
		$this->db->query("select * from tradelicense where mobile='$mobile' AND trackid not in('$trackid')");
		if($this->db->affected_rows()>0){ echo "আপনার মোবাইল নাম্বারটি পূর্বে ব্যবহার করা হয়েছে।";exit;}
	}
	if(trim($nationid)>11){
		$bnid=$this->web->banglatk($nationid);
	}
 
	if(trim($bcno)>11){
		$bbcno=$this->web->banglatk($bcno);;
	}
	if(trim($pno)>5){
		$bpno=$this->web->banglatk($pno);
	}

	if(trim($nationid)=="") $nationid="";
	if(trim($bcno)=="") $bcno="";
	if(trim($pno)=="") $pno="";

    if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
        $profile_info = $this->setup->uploadimage($_FILES['file']);
    }elseif(!empty($profile) && empty($_FILES['file']['name'])){
        $profile_info=$profile;
    }else{
        $profile_info='img/default/profile.png';
    }
		
    $imp_bwname=implode($bwname,",");
    $imp_ewname=implode($ewname,",");
    $imp_bfname=implode($bfname,",");
    $imp_efname=implode($efname,",");
    $imp_emname=implode($emname,",");
    $imp_bmname=implode($bmname,",");
    $imp_bhname=implode($bhname,",");
    $imp_ehname=implode($ehname,",");
    $imp_mstatus=implode($mstatus,",");
    $imp_gender=implode($gender,",");
		
	$fqy=$this->db->query("UPDATE `tradelicense` SET trackid='$trackid', delivery_type='$delivery_type', bcomname='$bcomname', ecomname='$ecomname', bwname='$imp_bwname', ewname='$imp_ewname', vatid='$vatid', taxid='$taxid', btype='$btype', btype_english='$business_type_english', be_gram='$be_gram', be_rbs='$be_rbs', be_wordno='$be_wordno', be_dis='$be_dis', be_thana='$be_thana', be_postof='$be_postof', bb_gram='$bb_gram', bb_rbs='$bb_rbs', bb_wordno='$bb_wordno', bb_dis='$bb_dis', bb_thana='$bb_thana', bb_postof='$bb_postof', emname='$imp_emname', bmane='$imp_bmname', email='$email', mobile='$mob', phone='$phone', profile='$profile_info',bfname='$imp_bfname',efname='$imp_efname',gender='$imp_gender',mstatus='$imp_mstatus',bhname='$imp_bhname',ehname='$imp_ehname' where id='$uid'");
	//echo $this->db->last_query();exit;
	echo "1"; exit;
?>