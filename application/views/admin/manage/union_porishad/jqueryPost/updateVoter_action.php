<?php 
	if($_POST){
		$user = $this->session->userdata('username');
		extract($_POST);
		extract($_FILES);
		//print_r($_POST);exit;
		if(trim($national_id)=="" || trim($bangla_name)=="" || trim($english_name)=="" || trim($father_name)=="" || trim($mother_name)=="" || trim($date_of_birth)=="" || trim($basha)=="" || trim($word_no)=="" || trim($gram)=="" || trim($post_office)=="" || trim($upzilla)=="" || trim($district)==""){
			echo 3; exit;
		}
		if(trim($national_id != "")){
			$qy = $this->db->select("id,national_id")->from("tbl_voter_list")->where('national_id',$national_id)->get()->row();
			
			$show_national_id = $qy->national_id;
			$idd = $qy->id;
			
			if($this->db->affected_rows() > 0){
				
				if($idd != $id){
					echo "দুঃখিত!!!  $show_national_id, এই আইডি নম্বরটি already exists!!!";exit;
				}
			}
		}
		if(trim($mobile != "")){
			$qq = $this->db->select("id,mobile")->from("tbl_voter_list")->where('mobile',$mobile)->get()->row();
			$show_mobile = $qq->mobile;
			$idd = $qq->id;
			if($this->db->affected_rows() > 0){
				if($idd != $id){
					echo "দুঃখিত!!!  $show_mobile, এই মোবাইল নম্বরটি already exists!!!";exit;
				}
			}
		}
		$date_of_birth = date("Y-m-d",strtotime($date_of_birth));
		
		if($_FILES['picture']['size']){
			$pic=$_FILES['picture']['name'];
			$tmp_name=$_FILES['picture']['tmp_name'];
			copy($tmp_name,"library/profile/voters/".$pic);
			$pic = "library/profile/voters/".$pic;
			
			$data=array(
				"national_id"	=>	$national_id,
				"bangla_name"	=>	$bangla_name,
				"english_name"	=>	$english_name,
				"father_name"	=>	$father_name,
				"mother_name"	=>	$mother_name,
				"date_of_birth"	=>	$date_of_birth,
				"basha"			=>	$basha,
				"gram"			=>	$gram,
				"word_no"		=>	$word_no,
				"post_office"	=>	$post_office,
				"upzilla"		=>	$upzilla,
				"district"		=>	$district,
				"mobile"		=>	$mobile,
				"insert_by"		=>	$user,
				"pic"			=>	$pic
			);
		}
		else{
			$data=array(
				"national_id"	=>	$national_id,
				"bangla_name"	=>	$bangla_name,
				"english_name"	=>	$english_name,
				"father_name"	=>	$father_name,
				"mother_name"	=>	$mother_name,
				"date_of_birth"	=>	$date_of_birth,
				"basha"			=>	$basha,
				"gram"			=>	$gram,
				"word_no"		=>	$word_no,
				"post_office"	=>	$post_office,
				"upzilla"		=>	$upzilla,
				"district"		=>	$district,
				"mobile"		=>	$mobile,
				"insert_by"		=>	$user
			);
		}
		$this->db->trans_start();
		$qy = $this->db->query("select * from tbl_voter_list where id='$id'")->row();
		
		$show_national_id = $qy->national_id;
		
		$this->db->where("id",$id);
		$this->db->update("tbl_voter_list",$data);
		
		$qqq = array(
			'national_id' => $national_id
		);
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_autisticstudent',$qqq);
		
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_autistic',$qqq);
		
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_fighters',$qqq);
		
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_foreignman',$qqq);
		
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_mother_vata',$qqq);
		
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_oldmanstipend',$qqq);
		
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_poormans',$qqq);
		
		$this->db->where("national_id",$show_national_id);
		$this->db->update('tbl_widow',$qqq);
		//echo $this->db->last_query();exit;
		
		$this->db->trans_complete();
		if($this->db->trans_complete()){
			echo 1; exit;
		}else{
			echo 2; exit;
		}
	}
?>