	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12"> 
			<h3>ট্রেড লাইসেন্সধারির বসত ভিটা কর রসিদ </h3>
		</div>
	</div>
	<div style="padding:4px;width:100%;font-family:tahoma;">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

			<thead>
				<tr>
					<th>নং</th>
					<th>প্রতিষ্টানের নাম</th>
					<th>ট্রেড লাইসেন্স নং</th>
					<th>পরিশোদের তারিখ</th>
					<th>ভাউচার নং</th>
					<th>টাকার পরিমাণ</th>
					<th>মানি রিসিট</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					$tr=1;
					foreach ($qy as $row):
					$trow=$this->web->licenseInfo($row->trackid);
				?>
				<tr>
					<td><?php echo $tr;?></td>
					<td><?php echo $trow->bcomname?></td>
					<td><?php echo $row->trackid?></td>
					<td><?php echo date('d-m-Y',strtotime($row->payment_date))?></td>
					<td><?php echo $row->inno?></td>
					<td><?php echo $row->fee?></td>
					<td><a href="Money_receipt/tradeBosodbitakorMoneyReceipt?id=<?php echo $row->id?>&vno=<?php echo $row->inno?>&sno=<?php echo $row->trackid?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a></td>
				</tr>
				<?php $tr++;endforeach;?>
			</tbody>
		</table>
	</div>