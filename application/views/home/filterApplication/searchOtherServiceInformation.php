<?php 
	extract($_GET);
	//print_r($_GET); exit;
	$id=$tid;
	if(trim($id)==""){echo '<p style="color:red;text-align:center;fontsize:15px;">আপনার আবেদনের ট্র্যাকিং নম্বরটি প্রবেশ করুন</p>';exit;}
	$query=$this->db->select('*')->from('otherserviceinfo')->where('trackid',$id)->limit('1')->get();
	$row=$query->row();
	if($this->db->affected_rows()>0){
?>
	<style>
		b{padding-left:8px;font-family:solaimanLipi;}
	</style>

	<span>
		 <?php
			$url=base_url()."home/showOtherServiceInformation?scode=$tid";
		 //echo file_get_contents($url);
		function curl_get($url, array $get = NULL, array $options = array()) 
			{    
				$defaults = array( 
					CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get), 
					CURLOPT_HEADER => 0, 
					CURLOPT_RETURNTRANSFER => TRUE, 
					CURLOPT_TIMEOUT => 10 
				); 
				
				$ch = curl_init(); 
				curl_setopt_array($ch, ($options + $defaults)); 
				if( ! $result = curl_exec($ch)) 
				{ trigger_error(curl_error($ch)); } 
				curl_close($ch); 
				return $result; 
			}
		echo $html =curl_get($url); ?>
	</span>
 <?php } else {?>
	<p style="color:red;font-size:15px;text-align:center; ">আপনার  আবেদনের  নাম্বারটি সঠিক না  <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন অথবা  <br/>অন্যান্য সেবা সমূহের জন্য আবেদন করুন। </p>
 <?php } ?>