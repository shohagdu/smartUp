<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('license_check','app_license');
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
	public function registration_successfull(){
		$this->load->view("registration/success_regis");
	}

	public function expire(){
		$this->load->view("registration/expired_license");
	}

	public function regis(){
		$this->load->view("registration/registration");
	}

	public function registered(){
		$patch = 'new_app_registration';

		$this->form_validation->set_rules("app_name","Application Name","trim|required");
		$this->form_validation->set_rules("username","Username","trim|required");
		$this->form_validation->set_rules("address","Address information","trim|required");
		
	
		if( $this->form_validation->run() == FALSE ):
			$this->load->view("registration/registration");
		else:
			extract($_POST);

			$data = $app_name.'+'.$username.'+'.$address;
			$data = $this->encrypt->encode( $data,$patch );
			$regis = $this->app_license->save_data( $data );
		
			if( $regis ):
				redirect("registration/registration_successfull","location");
			else:
				redirect("welcome/","location");
			endif;

		endif;

	}


	// new key checking
	public function new_license_key(){
		extract($_POST);

		$this->form_validation->set_rules("key","New License Key","trim|required");

		if( $this->form_validation->run() == FALSE ):
			$this->load->view("registration/expired_license");
		else:
			$regis = $this->app_license->get_regis_data();
			$pid = $regis->app_id;

			$key_info = $this->encrypt->decode( $key,$pid );

			if( $key_info ):
				$key_exp = explode("+", $key_info);
				if( count($key_exp) ):
					$get_key_validity = $this->app_license->key_validity( $key_exp[1],$key_exp[0],$key_exp[2] );
					if( $get_key_validity ):
						$valid = $this->app_license->save_key_info( $key_exp[0],$key,$key_exp[3],$key_exp[2] );

						$url = base_url();
						
						if($valid):
							redirect($url,"location");
						else:
							redirect($url,"location");
						endif;
					else:
						$url = 'registration/expire/invalid';
						redirect($url,"location");
					endif;
				else:
					$url = 'registration/expire/invalid';
					redirect($url,"location");
				endif;
			else:
				$url = 'registration/expire/invalid';
				redirect($url,"location");
			endif;
		endif;

	}

}