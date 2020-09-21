<?php 
	$this->load->view('admin/topBar');
	$this->load->view('admin/leftMenu');
	echo (isset($main_content) ? $main_content : "");
	$this->load->view('admin/footer');
