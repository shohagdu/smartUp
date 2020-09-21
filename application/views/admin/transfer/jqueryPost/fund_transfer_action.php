<?php 
extract($_POST);
 //validation
 
if($fund_id=="" || $catid=="" || $catid2==""){echo "Please Select All Necessary Information."; exit;}
if(isset($_POST['subcat']) && $_POST['subcat']==""){echo "Please Select Left side Sub category";exit;}
if(isset($_POST['subcat2']) && $_POST['subcat2']==""){echo "Please Select Right side Sub category";exit;}
if(isset($_POST['accounts']) && $_POST['accounts']==""){ echo "Please Select Left Side All Bank Information";exit;}
if(isset($_POST['saccounts']) && $_POST['saccounts']==""){ echo "\nPlease Select Right Side All Bank Information";exit;}
if(isset($_POST['ptype']) && $_POST['ptype']==""){ echo "Please Select Left Side Payment Type.";exit;}
if(isset($_POST['ptype2']) && $_POST['ptype2']==""){ echo "Please Select Right Side Payment Type.";exit;}
if(trim($amount)==""){ echo "Please Enter Amount"; exit;}
if(trim($des)==""){ echo "Please Enter Description"; exit;}

$q=$this->db->select('category,balance')->from('mainctg')->where('id',$catid)->get();
$row=$q->row();
if($row->balance<$amount){echo "Sorry have not Enough Balance.";exit;}
if(isset($_POST['accounts'])){
$q=$this->db->select('balance')->from('acinfo')->where('acname',$accounts)->get();
$row=$q->row();
if($row->balance<$amount){echo "Sorry have not Enough Bank Balance.";exit;}
}

//fund to fund transfer
//debit balance
$this->db->query("update mainctg set balance=balance-'$amount' where id=$catid LIMIT 1");
if(isset($_POST['subcat']) && $_POST['subcat']!=""){$this->db->query("update subctg set balance=balance-'$amount' where id=$subcat LIMIT 1");}

//credit balance
$this->db->query("update mainctg set balance=balance+'$amount' where id=$catid2 LIMIT 1");
if(isset($_POST['subcat2']) && $_POST['subcat2']!=""){$this->db->query("update subctg set balance=balance+'$amount' where id=$subcat2 LIMIT 1");}

//Main ctg Ledger Update
$vQ=$this->db->select('max(vno) as vno')->from('voucherinfo')->get();$vrow=$vQ->row();//voucher no
$tQ=$this->db->select('max(tid) as tid')->from('transaction')->get();$trow=$tQ->row();//transaction no

/**********for left side transaction***********/
 /*************updated  main category ledger***************/
$mlegQ=$this->db->query("SELECT balance,category FROM funds where category in(select category from mainctg where id='$catid') order by id DESC LIMIT 1");
$mrow=$mlegQ->row();
$mnBalance=($mrow->balance-$amount);

$mLedg=array(
		'fund_id'=>$fund_id,
		'category'=>$mrow->category,
		'voucherno'=>$vrow->vno+1,
		'trno'=>$trow->tid+1,
		'dr'=>$amount,
		'cr'=>0.00,
		'balance'=>$mnBalance
  );
  $this->db->insert("funds",$mLedg);


  /*************updated  sub category Ledger ***************/
  if(isset($_POST['subcat']) && $subcat!=''){
$slegQ=$this->db->query("SELECT balance,sub_title FROM fund_sub_ctg where sub_title in(select sub_title from subctg where id='$subcat' AND mc_id='$catid') order by id DESC LIMIT 1");
$scrow=$slegQ->row();
$snBalance=($scrow->balance-$amount);
$sLedg=array(
		'fund_id'=>$fund_id,
		'mc_id'=>$catid,
		'sub_title'=>$scrow->sub_title,
		'dr'=>$amount,
		'cr'=>0.00,
		'voucherno'=>$vrow->vno+1,
		'trno'=>$trow->tid+1,
		'balance'=>$snBalance
  ); 
  $this->db->insert("fund_sub_ctg",$sLedg);
  }
 	
/**********for right side transaction***********/
$vData=array(
'vno'=>$vrow->vno+1
);
$tData=array(
'tid'=>$trow->tid+1
);
$this->db->insert("voucherinfo",$vData);
$this->db->insert("transaction",$tData);

 /*************updated  main category ledger***************/
 $q=$this->db->select('category,balance')->from('mainctg')->where('id',$catid2)->get();
$row=$q->row();

$mlegQ2=$this->db->query("SELECT balance,category FROM funds where category in(select category from mainctg where id='$catid2') order by id DESC LIMIT 1");
	
$mrow2=$mlegQ2->row();
$mnBalance2=($mrow2->balance+$amount);
$mLedg2=array(
		'fund_id'=>$sfund_id,
		'category'=>$mrow2->category,
		'voucherno'=>$vrow->vno+2,
		'trno'=>$trow->tid+2,
		'dr'=>0.00,
		'cr'=>$amount,
		'balance'=>$mnBalance2
  );
  $this->db->insert("funds",$mLedg2);
 $vData=array(
'vno'=>$vrow->vno+2
);
$tData=array(
'tid'=>$trow->tid+2
);
$this->db->insert("voucherinfo",$vData);
$this->db->insert("transaction",$tData);
  /*************updated  sub category Ledger ***************/
  if(isset($_POST['subcat2'])){
$slegQ2=$this->db->query("SELECT balance,sub_title FROM fund_sub_ctg where sub_title in(select sub_title from subctg where id=$subcat2 AND mc_id=$catid2) order by id DESC LIMIT 1");
$scrow2=$slegQ2->row();
$snBalance2=($scrow2->balance+$amount);
	   $sLedg2=array(
			'fund_id'=>$sfund_id,
			'mc_id'=>$catid,
			'sub_title'=>$scrow2->sub_title,
			'cr'=>$amount,
			'dr'=>0.00,
			'voucherno'=>$vrow->vno,
			'trno'=>$trow->tid+2,
			'balance'=>$snBalance2
	  ); 
	  $this->db->insert("fund_sub_ctg",$sLedg2);
	  }
  
if(isset($_POST['subcat']) && $_POST['subcat']=="") $subcat="";	  
if(isset($_POST['subcat2']) && $_POST['subcat2']=="") $subcat2=0;	   
if(isset($_POST['sno']) && $_POST['sno']=="") $sno="";	   
if(isset($_POST['sno2']) && $_POST['sno2']=="") $sno2="";	   
if(isset($_POST['cno']) && $_POST['cno']=="") $cno="";	   
if(isset($_POST['cno2']) && $_POST['cno2']=="") $cno2="";	   
if(isset($_POST['bname']) && $_POST['bname']=="") $bname="";	   
if(isset($_POST['bname2']) && $_POST['bname2']=="") $bname2="";	   
if(isset($_POST['pono']) && $_POST['pono']=="") $pono="";	    
if(isset($_POST['pono2']) && $_POST['pono2']=="") $pono2="";	    
if(isset($_POST['ddno']) && $_POST['ddno']=="") $ddno="";	    
if(isset($_POST['ddno2']) && $_POST['ddno2']=="") $ddno2="";	    
if(isset($_POST['ttno']) && $_POST['ttno']=="") $ttno="";	    
if(isset($_POST['ttno2']) && $_POST['ttno2']=="") $ttno2="";	    
if(isset($_POST['issudate']) && $_POST['issudate']=="") $issudate="";	  

//insert fund transfer history 
$ftrans=$trow->tid+1;$strans=$trow->tid+2;
$fvno=$vrow->vno+1;$svno=$vrow->vno+2;
$this->db->query("INSERT INTO `fund_transfer` (`fid`, `transid`, `catid`, `sub_cat`, `accounts`, `amount`, `paytype`, `slipno`, `chno`, `bank`, `issue`, `pono`, `ddno`, `ttno`, `voucherno`, `fid2`, `transid2`, `catid2`, `sub_cat2`, `accounts2`, `paytype2`, `slipno2`, `chno2`, `bank2`, `issue2`, `pono2`, `ddno2`, `ttno2`, `voucherno2`,`des`) VALUES ('$fund_id', '$ftrans', '$catid', '$subcat', '$accounts', '$amount', '$ptype', '$sno', '$cno', '$bname', '$issudate', '$pono', '$ddno', '$ttno', '$fvno', '$sfund_id', '$strans', '$catid2', '$subcat2', '$saccounts', '$ptype2', '$sno2', '$cno2', '$bname2', '$issudate2', '$pono2', '$ddno2', '$ttno2', '$svno', '$des')");	

/*************for bank transfer****************/
if(isset($_POST['accounts']) && isset($_POST['saccounts']))
{
  
/************bank ledger update**************/
if($fund_id==1){$fund="Development";} else{$fund="Personal";}
$user=$this->session->userdata('username');
$legQ=$this->db->query("SELECT  dr,balance,ac FROM ledger where ac in(select acno from acinfo where acname='$accounts') order by id DESC LIMIT 1");
$row=$legQ->row();
$pur=$fund.'&nbsp;'.$srow->sub_title.'&nbsp;'.$row->ac;
$nBalance=$row->balance-$amount;
$ledg=array(
		   'tid'=>$trow->tid+1,
		   'catid'=>$catid,
		   'subid'=>$subcat,
		   'voucherno'=>$vrow->vno+1,
		   'fundtype'=>$fund_id,
		   'ac'=>$row->ac,
		    'purpose'=>$pur,
		   'dr'=>$amount,
		   'cr'=>0.00, 		   
		   'balance'=>$nBalance, 		   
		   'inby'=>$user
	   );
	   $this->db->insert("ledger",$ledg);	    
/************bank ledger update**************/

$legQ2=$this->db->query("SELECT  dr,balance,ac FROM ledger where ac in(select acno from acinfo where acname='$saccounts') order by id DESC LIMIT 1");
$row2=$legQ2->row();
$pur=$fund.'&nbsp;'.$srow2->sub_title.'&nbsp;'.$row2->ac;
$nBalance2=$row2->balance+$amount;
$ledg2=array(
		   'tid'=>$trow->tid+1,
		   'catid'=>$catid,
		   'subid'=>$subcat,
		   'voucherno'=>$vrow->vno+2,
		   'fundtype'=>$sfund_id,
		   'ac'=>$row->ac,
		    'purpose'=>$pur,
		   'cr'=>$amount,
		   'dr'=>0.00, 		   
		   'balance'=>$nBalance2, 		   
		   'inby'=>$user
	   );
	   $this->db->insert("ledger",$ledg2);	  
  
//debit
$this->db->query("update acinfo set balance=balance-$amount where acname='$accounts' LIMIT 1");
//credit
$this->db->query("update acinfo set balance=balance+$amount where acname='$saccounts' LIMIT 1");
echo "Successfully Transfered."; exit;
}
/********for fund to fund transfer*******/
else {
//debit balance
$this->db->query("update mainctg set balance=balance-'$amount' where id=$catid LIMIT 1");
if(isset($_POST['subcat']) && $_POST['subcat']!=""){$this->db->query("update subctg set balance=balance-'$amount' where id=$subcat LIMIT 1");}
//credit balance
$this->db->query("update mainctg set balance=balance+'$amount' where id=$catid2 LIMIT 1");
if(isset($_POST['subcat2']) && $_POST['subcat2']!=""){$this->db->query("update subctg set balance=balance+'$amount' where id=$subcat2 LIMIT 1");}
echo "Successfully Transfered."; exit;
}

	?>