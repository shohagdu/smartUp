<?php 
extract($_GET);
$id=$tid;
if(trim($id)==""){echo '<p style="color:red;text-align:center;fontsize:15px;">আপনার ওয়ারিশ আবেদনের ট্র্যাকিং নম্বরটি প্রবেশ করুন</p>';exit;}
$query=$this->db->select('*')->from('tbl_warishesinfo')->where('trackid',$id)->limit('1')->get();
$row=$query->row();
if($this->db->affected_rows()>0){
?>
<style>
b{padding-left:8px;}
</style>
	<span>
		<?php
			$url=base_url()."home/showOarishInformation?scode=$tid";
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
			echo $html =curl_get($url); 
		?>
	</span>
 <?php } else {?><div class='clearfix'></div>
	<p style="color:red;font-size:15px;text-align:center; ">আপনার  ওয়ারিশ আবেদনের  নাম্বারটি সঠিক না  <br/>আপনি ইউনিয়ন পরিষদে যোগাযোগ করুন অথবা  <br/>ওয়ারিশের  জন্য আবেদন করুন। </p>
 <?php } ?>