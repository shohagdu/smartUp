<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtrack extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();
		
		$this->load->dbutil();
	}
	
	public function index(){
		redirect("home/jacaiMamlaNotice",'location');
	}
	
}
