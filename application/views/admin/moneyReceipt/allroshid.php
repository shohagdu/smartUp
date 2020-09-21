<div id="content" class="col-lg-10 col-sm-10">
	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	<div  class="row box" style="min-height:1000px;">
		<!-- Form -->
		<div class="col-lg-12 col-sm-12">
			<ul class="nav nav-tabs">
				<li class="active">
					<a id="tradelicens" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/tradelicense_tab_roshid')">ট্রেড লাইসেন্স </a>
				</li>
				<li>
					<a id="bosotvita" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/bosodbitakor_tab_roshid')">বসতভিটার কর</a>
				</li>
				<li>
					<a id="peshazibikor" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/peshajibikor_tab_roshid')">পেশাজীবি কর</a>
				</li>
				<li>
					<a id="trade_bosodbitakor" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/trade_bosodbitakor_tab_roshid')">ট্রেড লাইসেন্সধারির বসত ভিটা কর</a>
				</li>
				<li>
					<a id="dailycollection" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/dailycollection_tab_roshid')">দৈনিক জমা</a>
				</li>
				<li>
					<a id="dailyExpense" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/dailyExpense_tab_roshid')">দৈনিক খরচ</a>
				</li>
				
				<li>
					<a id="nagoriksonod" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/nagoriksonod_tab_roshid')">নাগরিক সনদ</a>
				</li>
				<li>
					<a id="warishsonod" data-toggle="tab" href="javascript:void(0)" onclick="loadContent('Money_receipt/warishsonod_tab_roshid')">ওয়ারিশ লাইসেন্স</a>
				</li>
				
				
				
			</ul>

			<div class="tab-content" id="maincontent" style="">
				<div id="home" class="tab-pane fade in active">
					<div class="row"> 
						<div class="col-lg-12 col-sm-12"> 
							<h3>ট্রেড লাইসেন্স রসিদ </h3>
						</div>
					</div>
					<div style="padding:4px;width:100%;">
						<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>নং</th>
									<th style="white-space:normal;">প্রতিষ্টানের নাম</th>
									<th>ট্রেড লাইসেন্স নং</th>
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
									<td style="white-space:normal;"><?php echo $row->bcomname?></td>
									<td><?php echo $row->sno?></td>
									<td><?php echo date('d-m-Y',strtotime($row->payment_date))?></td>
									<td><?php echo $row->vno?></td>
									<td><?php echo $row->total?></td>
									<td>
										<a href="Money_receipt/tabTradelicenseMoneyReceipt?vno=<?php echo $row->vno;?>&id=<?php echo sha1($row->trackid);?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a>
									</td>
								</tr>
								<?php $nr++; endforeach;?>	
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div><!--/#content.col-md-0-->