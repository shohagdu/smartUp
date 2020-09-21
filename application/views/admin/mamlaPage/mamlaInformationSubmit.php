<?php 
	extract($_POST);
	//echo '<pre>';
	//print_r($_POST);exit;
	$getTbl = $this->mgenerate->get_mamal_no();
	if($getTbl != $mamlaNo){
		echo "10";exit;
	}
	if(trim($subject)==""){
		echo "9";exit;
	}
	if(trim($mamla_date)=="" || trim($sunani_date)==""){
		echo "8";exit;
	}
	if(trim($badi_name[0])=="" || trim($bibadi_name[0])==""){
		echo "7";exit;
	}
	if(!isset($badi_gram)){$badi_gram="";}
	if(!isset($bibadi_gram)){$bibadi_gram="";}
	
	$ins_user = $this->session->userdata('username');
	$mamla_date = date('Y-m-d',strtotime($mamla_date));
	$sunani_date = date('Y-m-d',strtotime($sunani_date));
	$sonod=$this->common->genarate_sno();
	$tData=array('sno'=>$sonod);
	
	$mamlaInfo = array(
		'mamla_no'		=> $getTbl,
		'mamla_sonod'	=> $sonod,
		'subject'		=> $subject,
		'mamla_date'	=> $mamla_date,
		'sunani_date'	=> $sunani_date,
		'badi_gram'		=> $badi_gram,
		'bibadi_gram'	=> $bibadi_gram,
		'status'		=> 1,
		'ins_user'		=> $ins_user
	);
	
	$this->db->trans_start();
		$this->mgenerate->common_insert("up_sonods",$tData);
		$this->db->insert("mamla_tbl",$mamlaInfo);
		$mamla_id=$this->db->insert_id();
		$sData=array(
			'sCode'=>$mamla_id
		);
		$this->session->set_userdata($sData);
		
		if(isset($_POST['badi_name'])):
			foreach($badi_name as $key => $value):
				$badiData = array(
					'mamla_id'			=> $mamla_id,
					'badi_name'			=> $value,
					'badi_father_name'	=> $badi_father[$key],
					'gram'				=> $badi_gram_arry[$key],
					'status'			=>'1'
				);
				$this->db->insert('mamla_badi',$badiData);
			endforeach;
		endif;
			 
		if(isset($_POST['bibadi_name'])):
			foreach($bibadi_name as $key22 => $value22):
				$bibadiData = array(
					'mamla_id'			=> $mamla_id,
					'bibadi_name'		=> $value22,
					'bibadi_father_name'=> $bibadi_father[$key22],
					'gram'				=> $bibadi_gram_arry[$key22],
					'status'			=>'1'
				);
				$this->db->insert('mamla_bibadi',$bibadiData);
			endforeach;
		endif;
	$this->db->trans_complete();
	if($this->db->trans_status() === TRUE){
		echo "1";
	}
	else{
		echo "Oops!! Something error";
	}
?>