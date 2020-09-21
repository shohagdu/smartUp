<?php 
	$id=$_GET['q'];
	$i=1;
	$query1 = $this->db->query("select * from tradelicense where sno='$id'")->row();
	$trackid = $query1->trackid;
	$rTrade=$this->db->query("select * from money where  trackid='$trackid' and status='2'")->result();
	if($this->db->affected_rows()<=0){
		/*echo "<p style='padding-left:500px;color:red;'>আপনার ট্রেড লাইসেন্স নং টা সঠিক নয়</p>";exit;*/ 
	}
	else
	{
?>
		<button class="btn btn-primary btn-block">ট্রেড লাইসেন্স এর বসতভিটার কর এর Last payment History </button>
		<table class="table table-striped table-bordered dt-responsive nowrap">
			<tr>
				<th style="text-align:center;" >নং</th>
				<th style="text-align:center;">নাম</th>
				<th style="text-align:center;">লাইসেন্স নং</th>
				<th style="text-align:center;">পরিশোধের তারিখ</th>
				<th style="text-align:center;">ভাউচার নং</th>
				<th style="text-align:center;">টাকার পরিমান</th>
				<th style="text-align:center;">মানি রিসিট</th>
				
			</tr>
			<?php 
				foreach($rTrade as $row){
					//$licenseNO=$row->trackid;
					//$clintInfo=$this->db->query("select * from tradelicense where sno='$licenseNO'")->row();
				
			?>
					<tr>
						<td style="text-align:center;"><?php echo $i++; ?></td>
						<td style="text-align:center;"><?php echo $query1->ecomname; ?></td>
						<td style="text-align:center;"><?php echo $query1->sno; ?></td>
						<td style="text-align:center;"><?php  echo date('d-m-Y',strtotime($row->payment_date)) ?></td>
						<td style="text-align:center;"><?php echo $row->inno; ?></td>
						<td style="text-align:center;"><?php echo $row->total; ?></td>
						<td style="text-align:center;"><a href="Money_receipt/tradeBosodbitakorMoneyReceipt?id=<?php echo $row->id?>&vno=<?php echo $row->inno?>&sno=<?php echo $row->trackid?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a></td>
						
					</tr>
			<?php 
				}
	}
			?>
		</table>
		 