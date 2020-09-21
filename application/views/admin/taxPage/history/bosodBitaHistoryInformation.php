<?php if((string)$info['status'] === 'success'):?>
<style type="text/css"> 
	.custom-label-text{
		font-size: 18px;
		text-align: right;
	}
	.custom-info-text{
		font-size: 18px;
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
					<label class="control-label col-sm-2 col-xs-4 custom-label-text">জন্ম নিবন্ধন নং</label>
					<div class="col-sm-4 col-xs-8 custom-info-text">:  <?php echo !empty($info['data']->birth_certificate_id) ? $info['data']->birth_certificate_id : '';?> </div>
					<div class="visible-xs clearfix"></div>
					<label class="control-label col-sm-2 col-xs-4 custom-label-text" style="font-size: 16px;">জাতীয় পরিচয় পত্র নং</label>
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
					<label class="control-label col-sm-2 col-xs-4 custom-label-text">বসতভিটার ধরন - পেশা - করের শ্রেনী</label>
					<div class="col-sm-4 col-xs-8 custom-info-text"> : <?php echo !empty($info['data']->rate_sheet_label) ? $info['data']->rate_sheet_label : '';?>  </div>
					<div class="visible-xs clearfix"></div>
					<label class="control-label col-sm-2 col-xs-4 custom-label-text">মোবাইল নং</label>
					<div class="col-sm-4 col-xs-8 custom-info-text">:  <?php echo !empty($info['data']->mobile_number) ? $info['data']->mobile_number : '';?></div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-6 col-sm-2" style="text-align: right;margin-top: 15px;">
						<a href="Admin/payment_holding_tax?id=<?php echo !empty($info['data']->id) ? md5($info['data']->id) : '';?>" class="btn btn-info btn-sm">Payment</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif;?>


<?php if((string)$history['status'] === 'success'):?>
<div id="historyShow">
	<button class="btn btn-primary btn-block">Holding TAX Payment History</button>
	<table class="table table-striped table-bordered dt-responsive nowrap">
		<tr>
			<th style="text-align:center;" >নং</th>
			<th style="text-align:center;">অর্থ সাল</th>
			<th style="text-align:center;">নাম</th>
			<th style="text-align:center;">বই নম্বর </th>
			<th style="text-align:center;">মানি রসিদ নম্বর</th>
			<th style="text-align:center;">ভাউচার নং</th>
			<th style="text-align:center;">টাকার পরিমান</th>
			<th style="text-align:center;">পরিশোধের তারিখ</th>
			<th style="text-align:center;">মানি রিসিট</th>
			
		</tr>
		<?php $i = 1;foreach($history['data'] as $row): ?>
			<tr>
				<td style="text-align:center;"><?php echo $i++; ?></td>
				<td style="text-align:left;"><?php echo @$row->year_name; ?></td>
				<td style="text-align:leftt;"><?php echo @$row->name; ?></td>
				<td style="text-align:center;"><?php echo @$row->book_number; ?></td>
				<td style="text-align:center;"><?php echo @$row->money_receipt_number; ?></td>
				<td style="text-align:center;"><?php echo @$row->invoice; ?></td>
				<td style="text-align:center;"><?php echo @$row->pay_amount; ?></td>
				<td style="text-align:center;"><?php echo $payDate=date('Y-m-d',strtotime($row->payment_date)) ?></td>
				<td style="text-align:center;"><a href="Money_receipt/bosodbitakorMoneyReceipt?id=<?php echo $row->money_id?>&vno=<?php echo $row->invoice?>&dno=<?php echo $row->dag_no?>" class='btn btn-success btn-sm' target='_blank'>প্রিন্ট</a></td>
			</tr>
		<?php endforeach;?>
	</table>
</div>
<?php endif;?>