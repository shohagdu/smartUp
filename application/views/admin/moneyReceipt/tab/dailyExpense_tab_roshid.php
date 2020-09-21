	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12"> 
			<h3>দৈনিক খরচের রসিদ </h3>
		</div>
	</div>
	<div style="padding:4px;width:100%;font-family:tahoma;">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

			<thead>
				<tr>
					<th>নং</th>
					<th>বর্ণনা</th>
					<th>খরচের খাত</th>
					<th>পরিশোদের তারিখ</th>
					<th>ভাউচার নং</th>
					<th>টাকার পরিমাণ</th>
					<th>মানি রিসিট</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					$col=1; 
					foreach ($qy as $row):
				?>
				<tr>
					<td style="font-family:tahoma;"><?php echo $col;?></td>
					<td style="font-family:tahoma;"><?php echo $row->des?></td>
					<td style="font-family:tahoma;"><?php echo $row->purpose?></td>
					<td style="font-family:tahoma;"><?php echo date('d-m-Y',strtotime($row->payment_date))?></td>
					<td style="font-family:tahoma;"><?php echo $row->voucherno?></td>
					<td style="font-family:tahoma;"><?php echo $row->amount?></td>
					<td><a href="Money_receipt/dailyExpenseMoneyReceipt?id=<?php echo md5($row->id);?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a></td>
				</tr>
				<?php $col++;endforeach;?>	
			</tbody>
		</table>
	</div>
