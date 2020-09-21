<?php
class Website_syn extends CI_Controller {

  	public function __construct(){
		ob_start();
		parent::__construct();
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
	public function dailyHistory(){
	 $this->web->dailyHistory();
	}
		
}
?>
