<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->model('dashboard');
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

	//////////////////////////////////////////////////////////////////////////
///////////////////// role management system ////////////////////////////
//////////////////// Md Shoriful Islam 		////////////////////////////
/////////////////// 09-02-2016 				///////////////////////////
//////////////////////////////////////////////////////////////////////

public function role()
	{
		$this->load->view('admin/topBar');
		$this->load->view('admin/leftMenu');
		$this->load->view('admin/role/role');
		$this->load->view('admin/footer');
	}

	public function role_submit(){
		if(isset($_POST['add'])){
			extract($_POST);


			$role_w=implode(',', $role);
			$role_widget='index,'.$role_w;

			$d=date("Y-m-d");

			$id_src=$this->db->select("role_id")
							->from("acl")
							->order_by("role_id","desc")
							->limit(1)
							->get()
							->row();

			if($id_src->role_id=='') {$id=1;}
				else{$id=$id_src->role_id+1;}

			$user=$this->session->userdata("username");

			$data=array(
				"id"=>'',
				"role_id"=>$id,
				"role_name"=>$role_name,
				"widget"=>$role_widget,
				"ins_date"=>$d,
				"insert_by"=>$user
				);

			$this->db->trans_start();
			$ins=$this->db->insert("acl",$data);
			$this->db->trans_complete();

			if($this->db->trans_complete()){
				echo "<script>alert('Role Successfuly Created')</script>";
				//redirect("role/role","location");
				echo "<script>window.location='role_list';</script>";
			}else{
				echo "<script>alert('Fail to Create Role')</script>";
				//redirect("role/role","location");
				echo "<script>window.location='role';</script>";
			}	
		}
	}

public function role_list(){
	$this->load->view('admin/topBar');
	$this->load->view('admin/leftMenu');
	$this->load->view('admin/role/role_list');
	$this->load->view('admin/footer');
}

public function roleDelete(){
	$rid = $this->uri->segment(3);

	$data = array( "id" => $rid );
	$this->db->delete("acl",$data);

	if( $this->db->affected_rows() ):
		redirect("role/role_list","location");
	else:
		redirect("role/role_list","location");
	endif;
}

public function roleUpdate(){
	$this->load->view('admin/topBar');
	$this->load->view('admin/leftMenu');
	$this->load->view('admin/role/roleUpdate');
	$this->load->view('admin/footer');
}

public function roleUpdateSubmit(){
	if(isset($_POST['update'])):
		extract($_POST);

		$data =array( "id" => $role_id );
		$role_w=implode(',', $role);
		$widget='index,'.$role_w;

		$updata = array(
				"role_name" => $role_name,
				"widget" => $widget
			);

		$this->db->where($data)->update("acl",$updata);

		if( $this->db->affected_rows() ):
			redirect("role/role_list","location");
		else:
			redirect("role/roleUpdate","location");
		endif;
	endif;
}

	//////////////////////////////////////////////////////////////////
	/////////////////////// role management end ////////////////////
	////////////////////////////////////////////////////////////////
}