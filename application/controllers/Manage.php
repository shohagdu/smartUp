<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('dashboard');
		$this->load->model('Manage_admin','manageAdmin');
		$this->load->model('Security_set','sq');
		$this->load->model('Role_chk', 'chk');
		$this->load->dbutil();
		
		$logged_status=$this->session->userdata('logged_status');
		if($logged_status==FALSE){
			redirect('mms24','location');
		}
		$passChang = $this->setup->forcePassChange();
		if($passChang==false){
			redirect("setup_section/changePassword");
		}
		$get = $this->setup->basicUnionSetup();
		if($get==false){
			redirect("setup/updatesetupform",'location');
		}
	}
	public function _remap($method, $params=array()){
		$funcs = get_class_methods($this);
		if(in_array($method, $funcs)){ // We are trying to go to a method in this class
			return call_user_func_array(array($this, $method), $params);
		}
		else{
		  show_404();
		}
	}
	public function index(){
		show_404();
	}
/*=================  Administration section start =========================	*/

	public function employeeManage()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/employeeManage');
		$this->load->view('admin/footer');
	}
	public function employeeAdd()
	{
		if(isset($_POST['submit_btn'])){
			
			$full_name=$_POST['full_name'];
			$user_name=$_POST['user_name'];
			$password=$_POST['password'];
			
			$pass=md5($password);

			$user_type=$_POST['desig'];
			$user_role=$_POST['user_role'];
			$phone=$_POST['mobile'];
			if(trim($phone != "")){
				$qq = $this->db->select("mobile")->from("admin")->where('mobile',$phone)->get()->row();
				$show_mobile = $qq->mobile;
				if($this->db->affected_rows() > 0){
					echo "দুঃখিত!!!  $show_mobile, এই মোবাইল নম্বরটি already exists!!!";exit;
				}
			}
			if(trim($user_name != "")){
				$qy = $this->db->select("username")->from("admin")->where('username',$user_name)->get()->row();
				$show_user = $qy->username;
				if($this->db->affected_rows() > 0){
					echo "দুঃখিত!!!  $show_user, এই user already exists!!!";exit;
				}
			}
			
			$email=$_POST['email'];
			$desig=$_POST['designation'];
			$pic=$_FILES['picture']['name'];
			$tmp_name=$_FILES['picture']['tmp_name'];
			

			if($_FILES['picture']['size']){
				copy($tmp_name,"img/$pic");
			}

			$logdata=array(
				"id"=>'',
				"role_id"=>$user_role,
				"username"=>$user_name,
				"fullname"=>$full_name,
				"pass"=>$pass,
				"email"=>$email,
				"mobile"=>$phone,
				"desig" => $desig,
				"pic" => $pic,
				"sid"=>'',
				"status"=>'1',
				"verify_mobile"=>1,
				"security_setting"=>'1'
			);
			// $empdata=array(
			// 	"id"=>'',
			// 	"role_id"=>$user_role,
			// 	"desig"=>$desig,
			// 	"username"=>$user_name,
			// 	"fullname"=>$full_name,
			// 	"pass"=>$pass,
			// 	"email"=>$email,
			// 	"phone"=>$phone,
			// 	"pic"=>$pic
			// );
			$insert = $this->manageAdmin->employeeAdd_action($logdata,'admin');
			if($insert==true){
				redirect('Manage/employeeList','location');
			}
			else{
				echo "<script>alert('Fail to create employee');</script>";
				redirect('Manage/employeeManage','location');
			}
		}
	}
	public function employeeManageUpdate()
	{
		extract($_GET);
		$data=array(
			'row'	=>	$this->manageAdmin->adminInformation($id)		
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/employeeManageUpdate');
		$this->load->view('admin/footer');
	}
	
	public function employeeManageUpdate_action()
	{
		if(isset($_POST['submit_btn'])){
			$id=$_POST['id'];
			$full_name=$_POST['full_name'];
			$user_name=$_POST['user_name'];
			$password=$_POST['password'];
			
			$pass=md5($password);

			$user_type=$_POST['desig'];
			$user_role=$_POST['user_role'];
			$phone=$_POST['mobile'];
			$email=$_POST['email'];
			$desig=$_POST['designation'];
			

			$logdata=array(
				"role_id"=>$user_role,
				"fullname"=>$full_name,
				"email"=>$email,
				"mobile"=>$phone,
				"desig" => $desig
			);
			
			$this->db->where("id",$id);
			$update = $this->db->update("admin",$logdata);
			
			if($update==true){
				redirect('Manage/employeeList','location');
			}
			else{
				echo "<script>alert('Fail to create employee');</script>";
				redirect('Manage/employeeManage','location');
			}
		}
	}
	
	public function employeeDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('admin',$id);
		redirect('Manage/employeeList','location');
	}
	public function employeeList()
	{
		$data=array(
			'row'	=>	$this->manageAdmin->employeeInformation()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/employeeList');
		$this->load->view('admin/footer');
	}
/*=================  Administration section end =========================	*/

/*===================  Website section start =============================	*/
	public function webSiteUpMemberList()
	{
		$data=array(
			'row'	=>	$this->manageAdmin->webSiteUpMembterInformation()
		);
		//print_r($data);exit;
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/website/webSiteUpMemberList');
		$this->load->view('admin/footer');
	}
	public function webSiteUpMemberDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_upmember',$id);
		redirect('Manage/webSiteUpMemberList','location');
	}
	public function webSiteUpMembterAdd()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/website/webSiteUpMembterAdd');
		$this->load->view('admin/footer');
	}
	public function webSiteUpMemberAdd_action()
	{
		if(isset($_POST['profile_setup'])){
			$full_name=trim($_POST['full_name']);
			$n_id=trim($_POST['n_id']);
			$designation=trim($_POST['designation']);
			$status=$_POST['status'];
			$email=trim($_POST['email']);
			$mobile=trim($_POST['mobile']);
			$dofb=trim($_POST['dofb']);
			$mstatus=trim($_POST['mstatus']);
			$district=trim($_POST['district']);
			$qualification=trim($_POST['qualification']);
			$joindate=trim($_POST['joindate']);
			$barea=trim($_POST['barea']);
			$vno=trim($_POST['vno']);
			$pic=$_FILES['picture']['name'];
			$tmp_name=$_FILES['picture']['tmp_name'];
			
			if($_FILES['picture']['size']){
				copy($tmp_name,"library/profile/".$pic);
			}
			$dofb	  = date('Y-m-d',strtotime($dofb));
			$joindate = date('Y-m-d',strtotime($joindate));
			
			$setup_data=array(
				"id"			=> '',
				"full_name"		=> $full_name,
				"n_id"			=> $n_id,
				"designation"	=> $designation,
				"status"		=> $status,
				"email"			=> $email,
				"mobile"		=> $mobile,
				"dofb"			=> $dofb,
				"mstatus"		=> $mstatus,
				"district"		=> $district,
				"qualification"	=> $qualification,
				"joindate"		=> $joindate,
				"barea"			=> $barea,
				"vno"			=> $vno,
				"pic"			=> $pic
			);
			$insert = $this->manageAdmin->insert_query($setup_data,'tbl_upmember');
			if($insert==true){
				redirect('Manage/webSiteUpMemberList','location');
			}
			else{
				echo "<script>alert('Fail to create employee');</script>";
				redirect('Manage/webSiteUpMembterAdd','location');
			}
		}
	}
	public function webSiteUpMemberUpdate($id)
	{
		$data=array(
			'row'	=>	$this->manageAdmin->upMemberInformation($id)
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/website/webSiteUpMemberUpdate');
		$this->load->view('admin/footer');
	}
	public function webSiteUpMemberUpdate_action()
	{
		if(isset($_POST['profile_update'])){
			$id=$_POST['id'];
			$full_name=trim($_POST['full_name']);
			$n_id=trim($_POST['n_id']);
			$designation=trim($_POST['designation']);
			$status=$_POST['status'];
			$email=trim($_POST['email']);
			$mobile=trim($_POST['mobile']);
			$dofb=trim($_POST['dofb']);
			$mstatus=trim($_POST['mstatus']);
			$district=trim($_POST['district']);
			$qualification=trim($_POST['qualification']);
			$joindate=trim($_POST['joindate']);
			$barea=trim($_POST['barea']);
			$vno=trim($_POST['vno']);
		
			$dofb	  = date('Y-m-d',strtotime($dofb));
			$joindate = date('Y-m-d',strtotime($joindate));
			
			if($_FILES['picture']['size']){
				$pic=$_FILES['picture']['name'];
				$tmp_name=$_FILES['picture']['tmp_name'];
				copy($tmp_name,"library/profile/".$pic);
			
				$setup_data=array(
					"full_name"		=>$full_name,
					"n_id"			=>$n_id,
					"designation"	=>$designation,
					"status"		=>$status,
					"email"			=>$email,
					"mobile"		=>$mobile,
					"dofb"			=>$dofb,
					"mstatus"		=>$mstatus,
					"district"		=>$district,
					"qualification"	=>$qualification,
					"joindate"		=>$joindate,
					"barea"			=>$barea,
					"vno"			=>$vno,
					"pic"			=>$pic
				);

			}else{
				$setup_data=array(
					"full_name"=>$full_name,
					"n_id"=>$n_id,
					"designation"=>$designation,
					"status"=>$status,
					"email"=>$email,
					"mobile"=>$mobile,
					"dofb"=>$dofb,
					"mstatus"=>$mstatus,
					"district"=>$district,
					"qualification"=>$qualification,
					"joindate"=>$joindate,
					"barea"=>$barea,
					"vno"=>$vno
				);
			}
			$this->db->trans_start();
			$this->db->where('id',$id);
			$this->db->update('tbl_upmember',$setup_data);
			$this->db->trans_complete();
			
			if($this->db->trans_complete()){
				redirect('Manage/webSiteUpMemberList','location');
			}
		}
	}
	public function charimanMessage()
	{
		$data=array(
			'row'	=>	$this->manageAdmin->charimanMessageQuery()
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/charimanMessage/charimanMessage');
		$this->load->view('admin/footer');
	}
	public function chairmanMessageUpdate()
	{
		if(isset($_POST['submitBtn'])){
			extract($_POST);
			$user_name = $this->session->userdata('username');
			$qu = $this->db->query("select * from chairman_message order by id desc limit 1")->row();
			$count = $this->db->affected_rows();
			if($count<=0){
				$data = array(
					'title'		=> $title,
					'message'	=> $msg,
					'update_by' => $user_name
				);
				$in = $this->db->insert("chairman_message",$data);
				if($in){
					redirect('Manage/charimanMessage','location');
				}
			}
			else{
				$up=$this->db->query("update chairman_message set title='$title',message='$msg',update_by='$user_name'");
				if($up){
					redirect('Manage/charimanMessage','location');
				}
			}
		}
	}
	
	
	
/*=============== union parishad public people function start ==========*/
	public function unionPorishad()
	{
		$data=array(
			'row'	=> $this->manageAdmin->getAllInformation('tbl_voter_list')
		);
		
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/unionPorishad');
		$this->load->view('admin/footer');
	}
	public function voter_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->getAllInformation("tbl_voter_list")
		);
		$this->load->view('admin/manage/union_porishad/tab/voter_tab',$data);
	}
	public function addVoter()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addVoter');
		$this->load->view('admin/footer');
	}
	public function addVoter_action()
	{
		$this->load->view('admin/manage/union_porishad/jqueryPost/addVoter_action');
	}
	public function editVoter($id)
	{
		$data=array(
			'row'	=> $this->manageAdmin->oneVoterInformation($id)
		);
		$this->load->view('admin/topBar',$data);
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/editVoter');
		$this->load->view('admin/footer');
	}
	public function updateVoter_action()
	{
		$this->load->view('admin/manage/union_porishad/jqueryPost/updateVoter_action');
	}
	public function deleteVoter($id)
	{
		$qy = $this->db->query("select * from tbl_voter_list where id='$id'")->row();
		$national_id = $qy->national_id;
		
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_voter_list',$id);
		
		$national_id = $this->db->where('national_id',$national_id);
		$this->db->delete('tbl_autisticstudent',$national_id);
		$this->db->delete('tbl_autistic',$national_id);
		$this->db->delete('tbl_fighters',$national_id);
		$this->db->delete('tbl_foreignman',$national_id);
		$this->db->delete('tbl_mother_vata',$national_id);
		$this->db->delete('tbl_oldmanstipend',$national_id);
		$this->db->delete('tbl_poormans',$national_id);
		$this->db->delete('tbl_widow',$national_id);
		
		redirect('Manage/unionPorishad','location');
	}
	public function widow_tab()
	{
		$data=array(
			'row'	=>	$this->manageAdmin->widowInformation()
		);
		$this->load->view('admin/manage/union_porishad/tab/widow_tab',$data);
	}
	public function addWidow()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addWidow');
		$this->load->view('admin/footer');
	}
	public function searchVoterInfo()
	{
		extract($_GET);
		$query = $this->db->query("SELECT * FROM $tbl WHERE national_id = '$n_id'");
		if($this->db->affected_rows() > 0){
			echo '2';exit;
		}
		$qy = $this->db->query("SELECT * FROM tbl_voter_list WHERE national_id = '$n_id'");
		$num_rows = $qy->num_rows();
		if($num_rows <= 0){
			echo "1"; exit;
		}
		else{
			$row	= $qy->row();
			$n_id	= $row->national_id;
			$bname	= $row->bangla_name;
			$fname	= $row->father_name;
			$gram	= $row->gram;
			$w_no	= $row->word_no;
			$status	= $row->status;
			echo $n_id."+".$bname."+".$fname."+".$gram."+".$w_no."+".$status;
		}
	}
	public function checkArray(){
		extract($_POST);
		//print_r($_POST);
		$n_id = count($national_id);
		$unique_national_id = count(array_unique($national_id));
		if($n_id != $unique_national_id){
			echo 1; exit;
		}
	}
	public function addWidow_action()
	{
		extract($_POST);
		//echo '<pre>';
		//print_r($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_widow',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad"; </script>';
		}
	}
	public function deleteWidow($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_widow',$id);
		redirect('Manage/unionPorishad','location');
	}
	public function fighter_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->fighterInformation()
		);
		/* echo '<pre>';
		print_r($data); */ 
		$this->load->view('admin/manage/union_porishad/tab/fighter_tab',$data);
	}
	public function addFighter()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addFighter');
		$this->load->view('admin/footer');
	}
	
	public function addFighter_action()
	{
		extract($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_fighters',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad"; </script>';
		}
	}
	
	public function modalShow()
	{
		extract($_GET);
		$data = array(
			'q'	=>	$this->manageAdmin->oneFighterInformation($national_id)
		);
		$this->load->view('admin/manage/union_porishad/tab/fighter_modal',$data);
	}
	public function updateFighter_action()
	{
		if(isset($_POST['fighter_update'])){
			extract($_POST);
			//print_r($_POST);
			$sector_no		=	trim($sector_no);
			$life_history	=	trim($life_history);
			$data = array(
				'sector_no'		=>	$sector_no,
				'life_history'	=>	$life_history
			);
			$this->db->trans_start();
			$this->db->where("national_id",$national_id);
			$this->db->update("tbl_fighters",$data);
			$this->db->trans_complete();

			if($this->db->trans_complete()){
				
				echo "<script>alert('Data update successfully');</script>";
				echo "<script>window.location='unionPorishad'</script>";
			}else{
				echo "<script>alert('Fail to update');</script>";
			}
		}
	}
	/*public function updateFighter_action()
	{
		if(isset($_POST['fighter_update'])){
			$id=$this->input->post('id',true);
			$full_name=trim($_POST['full_name']);
			$father_name=trim($_POST['father_name']);
			$n_id=trim($_POST['n_id']);
			$gram=trim($_POST['gram']);
			$word_no=trim($_POST['word_no']);
			$sector_no=trim($_POST['sector_no']);
			$mobile=trim($_POST['mobile']);
			$dofb=trim($_POST['dofb']);
			$life_history=trim($_POST['life_history']);

			if($_FILES['picture']['size']){
				$pic=$_FILES['picture']['name'];
				$tmp_name=$_FILES['picture']['tmp_name'];
				copy($tmp_name,"library/profile/fighters/".$pic);

				$data=array(
					"full_name"=>$full_name,
					"father_name"=>$father_name,
					"n_id"=>$n_id,
					"gram"=>$gram,
					"word_no"=>$word_no,
					"sector_no"=>$sector_no,
					"mobile"=>$mobile,
					"dofb"=>$dofb,
					"life_history"=>$life_history,
					"pic"=>$pic
				);

			}
			else{
				$data=array(
					"full_name"=>$full_name,
					"father_name"=>$father_name,
					"n_id"=>$n_id,
					"gram"=>$gram,
					"word_no"=>$word_no,
					"sector_no"=>$sector_no,
					"mobile"=>$mobile,
					"dofb"=>$dofb,
					"life_history"=>$life_history
				);
			}
			$this->db->trans_start();
			$this->db->where("id",$id);
			$this->db->update("tbl_fighters",$data);
			$this->db->trans_complete();

			if($this->db->trans_complete()){
				
				echo "<script>alert('Data update successfully');</script>";
				//redirect('Manage/unionPorishad','location');
				echo "<script>window.location='unionPorishad'</script>";
			}else{
				echo "<script>alert('Fail to update');</script>";
				echo "<script>window.location='Manage/editFighter'</script>";
			}
		}
	}*/
	public function fighterDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_fighters',$id);
		redirect('Manage/unionPorishad','location');
	}
	public function poorman_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->poormanInformation()
		);
		//print_r($data);
		$this->load->view('admin/manage/union_porishad/tab/poorman_tab',$data);
	}
	public function addPoorman()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addPoorman');
		$this->load->view('admin/footer');
	}
	
	public function addPoorman_action()
	{
		extract($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_poormans',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad";</script>';
		}
	}
	public function poormanDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_poormans',$id);
		redirect('Manage/unionPorishad','location');
	}
	
	public function oldmanstipend_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->oldmanstipendInformation()
		);
		$this->load->view('admin/manage/union_porishad/tab/oldmanstipend_tab',$data);
	}
	public function addOldmanstipend()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addOldmanstipend');
		$this->load->view('admin/footer');
	}
	public function addOldmanstipend_action()
	{
		extract($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_oldmanstipend',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad";</script>';
		}
	}
	public function oldmanstipendDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_oldmanstipend',$id);
		redirect('Manage/unionPorishad','location');
	}
	public function motherVata_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->motherVataInformation()
		);
		$this->load->view('admin/manage/union_porishad/tab/motherVata_tab',$data);
	}
	public function addMotherVata()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addMotherVata');
		$this->load->view('admin/footer');
	}
	public function addMotherVata_action()
	{
		extract($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_mother_vata',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad";</script>';
		}
	}
	public function motherVataDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_mother_vata',$id);
		redirect('Manage/unionPorishad','location');
	}
	public function autistic_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->autisticInformation()
		);
		$this->load->view('admin/manage/union_porishad/tab/autistic_tab',$data);
	}
	public function addAutistic()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addAutistic');
		$this->load->view('admin/footer');
	}
	public function addAutistic_action()
	{
		extract($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_autistic',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad";</script>';
		}
	}
	public function autisticDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_autistic',$id);
		redirect('Manage/unionPorishad','location');
	}
	public function autisticStudend_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->autisticStudentInformation()
		);
		$this->load->view('admin/manage/union_porishad/tab/autisticStudend_tab',$data);
	}
	public function addAutisticStudent()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addAutisticStudent');
		$this->load->view('admin/footer');
	}
	public function addAutisticStudent_action()
	{
		extract($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'student_name'	=>	$bangla_name[$key],
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_autisticstudent',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad";</script>';
		}
	}
	public function autisticStudentDelete($id){
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_autisticstudent',$id);
		redirect('Manage/unionPorishad','location');
	}
	public function foreignMan_tab()
	{
		$data=array(
			'row'	=> $this->manageAdmin->foreignManInformation()
		);
		$this->load->view('admin/manage/union_porishad/tab/foreignMan_tab',$data);
	}
	public function addForeignMan()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/manage/union_porishad/addForeignMan');
		$this->load->view('admin/footer');
	}
	public function addForeignMan_action()
	{
		extract($_POST);
		$insert_user_name = $this->session->userdata('username');
		if(isset($_POST['national_id'])){
			foreach($_POST['national_id'] as $key => $info){
				$data = array(
					'national_id'	=>	$info,
					'status'		=>	1,
					'insert_by'		=>	$insert_user_name
				);
				$this->db->insert('tbl_foreignman',$data);
			}
			echo '<script type="text/javascript"> window.location="unionPorishad";</script>';
		}
	}
	public function foreignManDelete($id)
	{
		$id = $this->db->where('id',$id);
		$this->db->delete('tbl_foreignman',$id);
		redirect('Manage/unionPorishad','location');
	}
/*=============== union parishad public people function end  ==========*/
	
/*===================  Website section end ===============================	*/	
}
