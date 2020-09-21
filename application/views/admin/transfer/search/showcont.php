	<?php
		extract($_GET);
		if($id=="") exit;
		if(isset($_GET['ac']) && $_GET['ac']==2){$ac=2;$pay=2;}
		if(trim($id)!=='Cash'){
	?>
	<div class="form-group">
		<label class="control-label col-sm-3" for="Payment Type">Payment Type</label>
		<div class="col-sm-9"> 
			<select name="ptype<?php echo $ac?>" class="form-control"  onchange="slip<?php echo $ac?>('Transfer/pType','id='+this.value+'&pay=<?php echo $pay?>')">
				<option value="">--Select--</option>
				<option value="cash">Cash</option>
				<option value="cheque">Cheque</option>
				<option value="po">Pay Order</option>
				<option value="dd">DD</option>
				<option value="tt">TT</option>
			</select>
		</div>
	</div>
	<?php } ?>