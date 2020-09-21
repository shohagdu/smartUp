<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_backup extends CI_Controller {
	
	public function __construct(){
		ob_start();
		parent::__construct();	
	}
	public function my_db_backup(){
		//curl -s "http://matuailup.com/Db_backup/my_db_backup"  //for crob job
		
		ini_set('memory_limit', '-1'); // for unlimited memory
		$this->load->dbutil();

        $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'my_db_backup.sql'
              );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		
		if (!file_exists('backup')) {
			mkdir('backup', 0777, true);
		}
        $save = 'backup/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 


        $this->load->helper('download');
        force_download($db_name, $backup); 
	}
}
