	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12"> 
			<h3>ওয়ারিশ  রসিদ </h3>
		</div>
	</div>
	<div style="padding:4px;width:100%;font-family:tahoma;">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

			<thead>
				<tr>
					<th>নং</th>
					<th style="white-space:normal;"> নাম</th>
					<th>সনদ নং</th>
					<th>পরিশোদের তারিখ</th>
					<th>ভাউচার নং</th>
					<th>টাকার পরিমাণ</th>
					<th>মানি রিসিট</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					$nr=1;
					foreach ($qy as $row):
				?>
				<tr>
					<td><?php echo $nr;?></td>
					<td style="white-space:normal;"><?php echo $row->bname?></td>
					<td><?php echo $row->sonodno?></td>
					<td><?php echo date('d-m-Y',strtotime($row->payment_date))?></td>
					<td><?php echo $row->inno?></td>
					<td><?php echo $row->fee?></td>
					<td>
						<a href="Money_receipt/warishMoneyReceipt?id=<?php echo sha1($row->trackid)?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a>
					</td>
				</tr>
				<?php $nr++;endforeach;?>
		</table>
	</div>