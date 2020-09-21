
	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	
	<?php
		// some execution here............
		$total=0;$totalcr=0;$totaldr=0;
		extract($_GET);
		if(trim($ac!="")){$account="category='$ac' AND";}
		if(trim($to)!="" && trim($from)!=""){$range="date(payment_date) between '$to' and '$from'";}
		$query=$this->db->query("select * from funds where $account $range order by voucherno ASC");
		$result=$query->result();
		//echo $this->db->last_query();
	?>
	
	<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

			<thead>
				<tr>
					<th>Nr.</th>
					<th>Tr Id </th>
					<th>Voucher No </th>
					<th>Fund Type</th>
					<th>Purpose</th>
					<th>Dr Balance</th>
					<th>Cr Balance</th>
					<th>Balance</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					$nr=1;
					foreach($result as $row):
				?>
				<tr>
					<td><?php echo $nr?></td>
					<td><?php echo $row->trno;?></td>
					<td><?php echo $row->voucherno;?></td>
					<td><?php if($row->fund_id==1) $fund='Development'; if($row->fund_id==2) $fund='Personal'; echo $fund;?></td>
					<td><?php echo $this->web->exppurinfo($row->trno);?></td>
					<td><?php echo $row->dr;$totaldr+=$row->dr;?></td>
					<td><?php echo $row->cr;$totalcr+=$row->cr;?></td>
					<td><?php echo $row->balance;?></td>
				</tr>
				<?php $nr++; endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan='5' align='right' style="text-align:right;"><b>Total</b>&nbsp;:</td>
					<td style="font-weight:bolder;font-size: 14px;"><?php echo number_format($totaldr,2);?></td>
					<td style="font-weight:bolder;font-size: 14px;"><?php echo number_format($totalcr,2);?></td>
					<td style="font-weight:bolder;font-size: 14px;"><?php echo number_format($row->balance,2);?></td>
				</tr>
			</tfoot>
		</table>
	</div>