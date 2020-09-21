<?php 
 $id=$_GET['q'];

			$i=1;
			$rTrade=$this->db->query("select * from money where  trackid='$id' and status='4'")->result();
			if($this->db->affected_rows()<=0){}
			else{
	?>
	<button class="btn btn-primary btn-block">Last Paymand History বসতভিটার কর</button>
	<table class="table table-striped table-bordered dt-responsive nowrap">
		<tr>
			<th style="text-align:center;" >নং</th>
			<th style="text-align:center;">নাম</th>
			<th style="text-align:center;">দাগ নং</th>
			<th style="text-align:center;">পরিশোধের তারিখ</th>
			<th style="text-align:center;">ভাউচার নং</th>
			<th style="text-align:center;">টাকার পরিমান</th>
			<th style="text-align:center;">মানি রিসিট</th>
			
		</tr>
		<?php 
			
			foreach($rTrade as $row){
				 $DragNo=$row->trackid;
				$clintInfo=$this->db->query("select name from holdingclientinfo where dag_no='$DragNo'")->row();
				//if($this->db->affected_rows()>0){echo "6";exit;}
		//$payDate=date('Y-m-d',strtotime($payment_date));
		 //$payDate=$row->payment_date; echo  $payDate=date('d-m-Y',strtotime($payDate))
				
			
		?>
		<tr>
			<td style="text-align:center;"><?php echo $i++; ?></td>
			<td style="text-align:center;"><?php echo $clintInfo->name; ?></td>
			<td style="text-align:center;"><?php echo $row->trackid; ?></td>
			<td style="text-align:center;"><?php echo $payDate=date('d-m-Y',strtotime($row->payment_date)) ?></td>
			<td style="text-align:center;"><?php echo $row->inno; ?></td>
			<td style="text-align:center;"><?php echo $row->total; ?></td>
			<td style="text-align:center;"><a href="Money_receipt/bosodbitakorMoneyReceipt?id=<?php echo $row->id?>&vno=<?php echo $row->inno?>&dno=<?php echo $row->trackid?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a></td>
			
		</tr>
		<?php 
			}
		}
		?>
	</table>
		 