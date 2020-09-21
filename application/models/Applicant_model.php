<?php
	class Applicant_model extends CI_Model{
		public function __construct(){
			ob_start();
			parent::__construct();
		}
		// nagorick section 
		
		public function nagorick_data(){
			
			// for new applicant 
			if(isset($_GET['napply']) && $_GET['napply']=='new'){
				$query=$this->db->query("SELECT id, name, trackid, delivery_type, mobile, insert_time, profile, status FROM personalinfo where sonodno is null AND status='0' order by date(insert_time) DESC, id DESC")->result();
			}
			
			// for certificate generate applicant 
			else if(isset($_GET['napply']) && $_GET['napply']=='5'){
				
				extract($_GET);
				$cDate=date("Y-m-d");
				if(@$opt==2){
					//echo "last todays";	
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM personalinfo as i INNER JOIN porichoprotro as p on i.trackid = p.trackid WHERE DATE(p.payment_date) >= DATE_ADD('$cDate', INTERVAL -1 DAY) AND i.status='1' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
					
				}
				elseif(@$opt==7){
					//echo "last week";	
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM personalinfo as i INNER JOIN porichoprotro as p on i.trackid = p.trackid WHERE DATE(p.payment_date) >= DATE_ADD('$cDate', INTERVAL -6 DAY) AND i.status='1' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
				elseif(@$opt==30){
					//echo "last Month";	
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM personalinfo as i INNER JOIN porichoprotro as p on i.trackid = p.trackid WHERE DATE(p.payment_date) >= DATE_ADD('$cDate', INTERVAL -30 DAY) AND i.status='1' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
				elseif(@$opt==1000){
					//echo "all data";
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM personalinfo as i INNER JOIN porichoprotro as p on i.trackid = p.trackid WHERE i.status='1' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
				elseif(@$opt!=''){
					//echo "date";
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM personalinfo as i INNER JOIN porichoprotro as p on i.trackid = p.trackid WHERE p.payment_date = '$opt' AND i.status='1' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
					
				}
				else {
					//echo 'defalut';
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM personalinfo as i INNER JOIN porichoprotro as p on i.trackid = p.trackid WHERE p.payment_date = '$cDate' AND i.status='1' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
			}
			
			// for defalut new applicant
			else {
				$query=$this->db->query("SELECT id, name, trackid, delivery_type, mobile, insert_time, profile, status FROM personalinfo where sonodno is null AND status='0' order by date(insert_time) DESC, id DESC")->result();
				
			}
			//echo $this->db->last_query();
			return $query;	
		}
		
		// trade license section 
		public function tradelicense_data(){
			
			// for new applicant
			if(isset($_GET['napply']) && $_GET['napply']=='new'){
				$query=$this->db->query("select tradelicense.id id,trackid,delivery_type,mobile,sno,bwname,bcomname,utime,profile,status from tradelicense where sno is null AND status='1'  order by date(utime) DESC,id DESC")->result();
			}
			// for expire trade license
			else if(isset($_GET['napply']) && $_GET['napply']=='expire'){
				$cdate=date("Y-m-d");
				$query=$this->db->query("select tradelicense.id id,trackid,mobile,delivery_type,tradelicense.sno,bwname,bcomname,tradelicense.utime,profile,tradelicense.status,issue_date,expire_date from tradelicense where expire_date < '$cdate' and expire_date!='0000-00-00' and status='2' order by date(tradelicense.utime) DESC")->result();
			}
			// for license generate
			// this is new process........
			else if(isset($_GET['napply']) && $_GET['napply']=='5'){
				extract($_GET);
				$cDate=date("Y-m-d");
				
				if(@$opt==2){
					//echo "last todays";	
					$query=$this->db->query("SELECT t.id, t.trackid, t.sno, t.bwname, t.bcomname, t.profile,t.delivery_type,t.mobile,t.status, g.vno, g.payment_date as utime  FROM tradelicense t INNER JOIN getlicense g ON t.trackid = g.trackid where DATE(t.issue_date)>=DATE_ADD('$cDate', INTERVAL -1 DAY) AND t.status='2' AND t.sno !='' AND t.expire_date !='0000-00-00' AND t.expire_date >='$cDate' and g.vno in(select max(vno) as vno from getlicense group by trackid) order by g.vno desc")->result();
				}
				elseif(@$opt==7){
					//echo "last week";	
					$query=$this->db->query("SELECT t.id, t.trackid, t.sno, t.bwname, t.bcomname, t.profile,t.delivery_type,t.mobile,t.status, g.vno, g.payment_date as utime  FROM tradelicense t INNER JOIN getlicense g ON t.trackid = g.trackid where DATE(t.issue_date)>=DATE_ADD('$cDate', INTERVAL -6 DAY) AND t.status='2' AND t.sno !='' AND t.expire_date !='0000-00-00' AND t.expire_date >='$cDate' and g.vno in(select max(vno) as vno from getlicense group by trackid) order by g.vno desc")->result();
				}
				elseif(@$opt==30){
					//echo "last Month";	
					$query=$this->db->query("SELECT t.id, t.trackid, t.sno, t.bwname, t.bcomname, t.profile,t.delivery_type,t.mobile,t.status, g.vno, g.payment_date as utime  FROM tradelicense t INNER JOIN getlicense g ON t.trackid = g.trackid where DATE(t.issue_date)>=DATE_ADD('$cDate', INTERVAL -1 Month) AND t.status='2' AND t.sno !='' AND t.expire_date !='0000-00-00' AND t.expire_date >='$cDate' and g.vno in(select max(vno) as vno from getlicense group by trackid) order by g.vno desc")->result();
				}
				elseif(@$opt==1000){
					//echo "all data";
					$query=$this->db->query("SELECT t.id, t.trackid, t.sno, t.bwname, t.bcomname, t.profile,t.delivery_type,t.mobile,t.status, g.vno, g.payment_date as utime  FROM tradelicense t INNER JOIN getlicense g ON t.trackid = g.trackid AND t.status='2' AND t.sno !='' AND t.expire_date >='$cDate' and g.vno in(select max(vno) as vno from getlicense group by trackid) order by g.vno desc")->result();
				}
				elseif(@$opt!=''){
					//echo "date";
					$query=$this->db->query("SELECT t.id, t.trackid, t.sno, t.bwname, t.bcomname, t.profile,t.delivery_type,t.mobile,t.status, g.vno, g.payment_date as utime  FROM tradelicense t INNER JOIN getlicense g ON t.trackid = g.trackid where t.issue_date = '$opt' AND t.status='2' AND t.sno !='' AND t.expire_date !='0000-00-00' AND t.expire_date >='$cDate' and g.vno in(select max(vno) as vno from getlicense group by trackid) order by g.vno desc")->result();				
				}
				else {
					//echo 'defalut';
					$query=$this->db->query("SELECT t.id, t.trackid, t.sno, t.bwname, t.bcomname, t.profile,t.delivery_type,t.mobile,t.status, g.vno, g.payment_date as utime  FROM tradelicense t INNER JOIN getlicense g ON t.trackid = g.trackid where DATE(t.issue_date)='$cDate' AND t.status='2' AND t.sno !='' AND t.expire_date !='0000-00-00' AND t.expire_date >='$cDate' and g.vno in(select max(vno) as vno from getlicense group by trackid) order by g.vno desc")->result();
				}
			}
			// for new applicant defalut query
			else {
				$query=$this->db->query("select tradelicense.id id,trackid,delivery_type,mobile,sno,bwname,bcomname,utime,profile,status from tradelicense where sno is null AND status='1'  order by date(utime) DESC,id DESC")->result();
			}
			return $query;
		}
		
		// warish section 
		public function warish_data(){
			
			// for new applicant 
			if(isset($_GET['napply']) && $_GET['napply']=='new'){
				$query=$this->db->query("SELECT id, bname, trackid, delivery_type, mobile, ins_time as insert_time FROM tbl_warishesinfo WHERE sonodno is null AND status='0' ORDER BY date(ins_time) DESC, id DESC")->result();
			}
			// for certificate generate
			else if(isset($_GET['napply']) && $_GET['napply']=='5'){
				
				extract($_GET);
				$cDate=date("Y-m-d");
				if(@$opt==2){
					//echo "last todays";	
					$query=$this->db->query("SELECT i.id, i.bname, i.trackid, i.sonodno, i.delivery_type, i.mobile, w.payment_date as insert_time, w.applicant_id FROM tbl_warishesinfo as i INNER JOIN tbl_wcc as w on i.trackid=w.trackid WHERE DATE(w.payment_date) >= DATE_ADD('$cDate', INTERVAL -1 DAY) AND i.status='1' AND i.sonodno!='' ORDER BY date(w.payment_date) DESC, i.id DESC")->result();
					
				}
				elseif(@$opt==7){
					//echo "last week";	
					$query=$this->db->query("SELECT i.id, i.bname, i.trackid, i.sonodno, i.delivery_type, i.mobile, w.payment_date as insert_time, w.applicant_id FROM tbl_warishesinfo as i INNER JOIN tbl_wcc as w on i.trackid=w.trackid WHERE DATE(w.payment_date) >= DATE_ADD('$cDate', INTERVAL -6 DAY) AND i.status='1' AND i.sonodno!='' ORDER BY date(w.payment_date) DESC, i.id DESC")->result();
				}
				elseif(@$opt==30){
					//echo "last Month";	
					$query=$this->db->query("SELECT i.id, i.bname, i.trackid, i.sonodno, i.delivery_type, i.mobile, w.payment_date as insert_time, w.applicant_id FROM tbl_warishesinfo as i INNER JOIN tbl_wcc as w on i.trackid=w.trackid WHERE DATE(w.payment_date) >= DATE_ADD('$cDate', INTERVAL -30 DAY) AND i.status='1' AND i.sonodno!='' ORDER BY date(w.payment_date) DESC, i.id DESC")->result();
				}
				elseif(@$opt==1000){
					//echo "all data";
					$query=$this->db->query("SELECT i.id, i.bname, i.trackid, i.sonodno, i.delivery_type, i.mobile, w.payment_date as insert_time, w.applicant_id FROM tbl_warishesinfo as i INNER JOIN tbl_wcc as w on i.trackid=w.trackid WHERE i.status='1' AND i.sonodno!='' ORDER BY date(w.payment_date) DESC, i.id DESC")->result();
				}
				elseif(@$opt!=''){
					//echo "date";
					$query=$this->db->query("SELECT i.id, i.bname, i.trackid, i.sonodno, i.delivery_type, i.mobile, w.payment_date as insert_time, w.applicant_id FROM tbl_warishesinfo as i INNER JOIN tbl_wcc as w on i.trackid=w.trackid WHERE w.payment_date = '$opt' AND i.status='1' AND i.sonodno!='' ORDER BY date(w.payment_date) DESC, i.id DESC")->result();
					
				}
				else {
					//echo 'defalut';
					$query=$this->db->query("SELECT i.id, i.bname, i.trackid, i.sonodno, i.delivery_type, i.mobile, w.payment_date as insert_time, w.applicant_id FROM tbl_warishesinfo as i INNER JOIN tbl_wcc as w on i.trackid=w.trackid WHERE w.payment_date = '$cDate' AND i.status='1' AND i.sonodno!='' ORDER BY date(w.payment_date) DESC, i.id DESC")->result();
				}
			}
			// for new applicant defalut query 
			else {
				$query=$this->db->query("SELECT i.id, bname, trackid, delivery_type, mobile, ins_time FROM tbl_warishesinfo WHERE sonodno is null AND status='0' ORDER BY date(ins_time) DESC, id DESC")->result();
			}
			return $query;
		}
		
		//********* other service data start *******//
		public function otherService_data(){
			//extract($_GET);
			//print_r($_GET);
			// for new applicant 
			if(isset($_GET['napply']) && $_GET['napply']=='new'){
				$query=$this->db->query("SELECT id, serviceId, name, trackid, delivery_type, mobile, insert_time, profile, status FROM otherserviceinfo where sonodno is null AND status='0' order by date(insert_time) DESC, id DESC")->result();
			}
			
			// for certificate generate applicant 
			else if(isset($_GET['napply']) && $_GET['napply']=='5'){
				
				extract($_GET);
				//print_r($_GET);
				$cDate=date("Y-m-d");
				if(@$opt==2){
					//echo "last todays";	
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.serviceId, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM otherserviceinfo as i INNER JOIN onnanoseba as p on i.trackid = p.trackid WHERE DATE(p.payment_date) >= DATE_ADD('$cDate', INTERVAL -1 DAY) AND i.status='1' AND i.serviceId='$service' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
					
				}
				elseif(@$opt==7){
					//echo "last week";	
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.serviceId, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM otherserviceinfo as i INNER JOIN onnanoseba as p on i.trackid = p.trackid WHERE DATE(p.payment_date) >= DATE_ADD('$cDate', INTERVAL -6 DAY) AND i.status='1' AND i.serviceId='$service' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
				elseif(@$opt==30){
					//echo "last Month";	
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.serviceId, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM otherserviceinfo as i INNER JOIN onnanoseba as p on i.trackid = p.trackid WHERE DATE(p.payment_date) >= DATE_ADD('$cDate', INTERVAL -30 DAY) AND i.status='1' AND i.serviceId='$service' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
				elseif(@$opt==1000){
					//echo "all data";
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.serviceId, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM otherserviceinfo as i INNER JOIN onnanoseba as p on i.trackid = p.trackid WHERE i.status='1' AND i.serviceId='$service' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
				elseif(@$opt!=''){
					//echo "date";
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.serviceId, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM otherserviceinfo as i INNER JOIN onnanoseba as p on i.trackid = p.trackid WHERE p.payment_date = '$opt' AND i.status='1' AND i.serviceId='$service' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
					
				}
				else {
					//echo 'defalut';
					$query=$this->db->query("SELECT i.id, i.name, i.trackid, i.serviceId, i.sonodno, i.delivery_type, i.mobile, i.profile, p.payment_date as insert_time, p.applicant_id FROM otherserviceinfo as i INNER JOIN onnanoseba as p on i.trackid = p.trackid WHERE p.payment_date = '$cDate' AND i.status='1' AND i.serviceId='$service' AND i.sonodno !='' ORDER BY p.payment_date DESC, i.id DESC")->result();
				}
			}
			
			// for defalut new applicant
			else {
				$query=$this->db->query("SELECT id, serviceId, name, trackid, delivery_type, mobile, insert_time, profile, status FROM otherserviceinfo where sonodno is null AND status='0' order by date(insert_time) DESC, id DESC")->result();
				
			}
			//echo $this->db->last_query();
			return $query;	
		}
		//********* other service data end   *******//
		
		// for renew data search....... renew_req and tradelicense table........
		public function renew_data(){
			$query=$this->db->query("select t.*,r.dtype, renew_utime from renew_req r left join tradelicense t on r.sno =t.sno where r.status='1' and t.status='3' order by r.id desc")->result();
			return $query;
		}
		
		// for nagorick certificate button 
		public function exPrintPori($id)
		{
			$this->db->select('*')->from('porichoprotro')->where('trackid',$id)->get();
			if($this->db->affected_rows()>0) return "Print"; else return "Generate";
		}
		
		// for tradlicense certificate button 
		public function rePrint($id)
		{
			$this->db->query("SELECT * FROM getlicense WHERE trackid='$id' order by vno desc LIMIT 1");
			if($this->db->affected_rows()>0) return "Print"; else return "Generate";
		
		}
		// for warish certificate button 
		public function exPrintwcc($id)
		{
			$this->db->select('*')->from('tbl_wcc')->where('trackid',$id)->get();
			if($this->db->affected_rows()>0) return "Print"; else return "Generate";
		}
		// count for total warish 
		public function tWarish($id)
		{
			$query=$this->db->select('*')->from('warishinfo')->where('trackid',$id)->get();
			return $query->num_rows();
		}
		// for other service name show..
		public function serviceNameShow($id){
			$query = $this->db->select("listName")->from("otherservicelist")->where("id",$id)->get()->row();
			return $query;
		}
		// for other service button 
		public function printOtherService($id)
		{
			$this->db->select('*')->from('onnanoseba')->where('trackid',$id)->get();
			if($this->db->affected_rows()>0) return "Print"; else return "Generate";
		}
		
	}