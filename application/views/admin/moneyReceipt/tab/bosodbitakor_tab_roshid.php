	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12"> 
			<h3>বসত ভিটা কর  রসিদ</h3>
		</div>
	</div>
	<div style="padding:4px;width:100%;font-family:tahoma;">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th style="text-align:center;" >নং</th>
					<th style="text-align:center;">অর্থ সাল</th>
					<th style="text-align:center;">নাম</th>
					<th style="text-align:center;">দাগ নং</th>
					<th style="text-align:center;">বই </th>
					<th style="text-align:center;">মানি রসিদ</th>
					<th style="text-align:center;">ভাউচার</th>
					<th style="text-align:center;">টাকা</th>
					<th style="text-align:center;">পরিশোধের তারিখ</th>
					<th style="text-align:center;">মানি রিসিট</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($qy['status'] === 'success'): $tr=1; foreach ($qy['data'] as $row): ?>
						<tr>
							<td style="text-align:center;"><?php echo $tr++; ?></td>
							<td style="text-align:left;"><?php echo @$row->year_name; ?></td>
							<td style="text-align:left;"><?php echo @$row->name; ?></td>
							<td style="text-align:left;"><?php echo @$row->dag_no; ?></td>
							<td style="text-align:center;"><?php echo @$row->book_number; ?></td>
							<td style="text-align:center;"><?php echo @$row->money_receipt_number; ?></td>
							<td style="text-align:center;"><?php echo @$row->invoice; ?></td>
							<td style="text-align:center;"><?php echo @$row->pay_amount; ?></td>
							<td style="text-align:center;"><?php echo $payDate=date('Y-m-d',strtotime($row->payment_date)) ?></td>
							<td style="text-align:center;"><a href="Money_receipt/bosodbitakorMoneyReceipt?id=<?php echo $row->money_id?>&vno=<?php echo $row->invoice?>&dno=<?php echo $row->dag_no?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a></td>
						</tr>
				<?php $tr++;endforeach; endif;?>
			</tbody>
		</table>
	</div>