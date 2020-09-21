<?php
class Application_model extends CI_Model{
	public function __construct(){
		ob_start();
		parent::__construct();
	}
	
	
}