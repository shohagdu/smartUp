<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<base href='<?php echo base_url();?>'/>
	<title></title>
</head>
<body>
	<?php if((string)$info['status'] === 'success'):?>
	<style type="text/css"> 
		.custom-label-text{
			font-size: 16px;
			text-align: right;
		}
		.custom-info-text{
			font-size: 16px;
		}
	</style>
	<div id="informationShow">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading"><span style="font-size: 15px;"> <?php echo !empty($info['data']->name) ? $info['data']->name : '';?>  এর  তথ্য</span></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">নাম</label>
						<div class="col-sm-4 col-xs-8 custom-info-text"> : <?php echo !empty($info['data']->name) ? $info['data']->name : '';?>  </div>
						<div class="visible-xs clearfix"></div>
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">পিতার নাম</label>
						<div class="col-sm-4 col-xs-8 custom-info-text">:  <?php echo !empty($info['data']->fathername) ? $info['data']->fathername : '';?></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label class="control-label col-sm-2 col-xs-4 custom-label-text" style="font-size: 14px;">জন্ম নিবন্ধন নং</label>
						<div class="col-sm-4 col-xs-8 custom-info-text">:  <?php echo !empty($info['data']->birth_certificate_id) ? $info['data']->birth_certificate_id : '';?> </div>
						<div class="visible-xs clearfix"></div>
						<label class="control-label col-sm-2 col-xs-4 custom-label-text" style="font-size: 14px;">পরিচয় পত্র নং</label>
						<div class="col-sm-4 col-xs-8 custom-info-text"> : <?php echo !empty($info['data']->national_id) ? $info['data']->national_id : '';?> </div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">গ্রাম </label>
						<div class="col-sm-4 col-xs-8 custom-info-text">: <?php echo !empty($info['data']->village) ? $info['data']->village : '';?>  </div>
						<div class="visible-xs clearfix"></div>
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">ওয়ার্ড নং</label>
						<div class="col-sm-4 col-xs-8 custom-info-text">:  <?php echo !empty($info['data']->wordno) ? $info['data']->wordno.' ওয়ার্ড' : '';?> </div>
					</div>
					<div class="clearfix"></div><div class="form-group">
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">হোল্ডিং নং</label>
						<div class="col-sm-4 col-xs-8 custom-info-text">: <?php echo !empty($info['data']->holding_no) ? $info['data']->holding_no : '';?>  </div>
						<div class="visible-xs clearfix"></div>
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">দাগ নং</label>
						<div class="col-sm-4 col-xs-8 custom-info-text">:  <?php echo !empty($info['data']->dag_no) ? $info['data']->dag_no : ''; ?> </div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">পেশা</label>
						<div class="col-sm-4 col-xs-8 custom-info-text"> : <?php echo !empty($info['data']->profession) ? $info['data']->profession : '';?>  </div>
						<div class="visible-xs clearfix"></div>
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">করের শ্রেনী</label>
						<div class="col-sm-4 col-xs-8 custom-info-text"> : <?php echo !empty($info['data']->shreni) ? $info['data']->shreni : '';?>  </div>
						<div class="visible-xs clearfix"></div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label class="control-label col-sm-2 col-xs-4 custom-label-text" style="font-size: 14px;" >বসতভিটার ধরন</label>
						<div class="col-sm-4 col-xs-8 custom-info-text"> : <?php echo !empty($info['data']->holding_label) ? $info['data']->holding_label : '';?>  </div>
						<div class="visible-xs clearfix"></div>
						<label class="control-label col-sm-2 col-xs-4 custom-label-text">ধার্যকৃত টাকা</label>
						<div class="col-sm-4 col-xs-8 custom-info-text"> : <?php echo !empty($info['data']->amount) ? $info['data']->amount : '';?>  </div>
						<div class="visible-xs clearfix"></div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>


	<?php if((string)$history['status'] === 'success'):?>
	<div id="historyShow">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align: center; font-weight: bold; text-transform: capitalize !important;">Payment Record</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap">
						<tr>
							<th style="text-align:center;" >নং</th>
							<th style="text-align:center;">অর্থ সাল</th>
							<th style="text-align:center;">পরিশোধের তারিখ</th>
							<th style="text-align:center;">টাকার পরিমান</th>
							
						</tr>
						<?php $i = 1;foreach($history['data'] as $row): ?>
							<tr>
								<td style="text-align:center;"><?php echo $i++; ?></td>
								<td style="text-align:center;"><?php echo $row->fiscal_year; ?></td>
								<td style="text-align:center;"><?php echo $payDate=date('Y-m-d',strtotime($row->payment_date)) ?></td>
								<td style="text-align:center;"><?php echo $row->amount; ?></td>
							</tr>
						<?php endforeach;?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
</body>
</html>