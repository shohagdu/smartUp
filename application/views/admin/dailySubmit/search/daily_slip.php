
	<?php
		$name=$this->input->get('id',true);
		if($name=="") exit;
		if(isset($_GET['pay']) && $_GET['pay']==2){$pay=2;}
		if($name=='cash'){
	?>
	<div class="form-group"> 
		<label class="control-label col-sm-2 col-sm-offset-1  midum-font" for=""></label>
		<div class="col-sm-3"> 
			<input type="hidden" name="sno<?php echo $pay?>" class="form-control" value="0"/>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php } else if($name=='cheque'){?>
	
	<div class="form-group ch01">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Cheque No.">Cheque No.</label>
		<div class="col-sm-4">
			<input type="text" name="cno<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group ch02">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Bank Name">Bank Name</label>
		<div class="col-sm-4">
			<input type="text" name="bname<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group ch03">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Issu Date">Issu Date</label>
		<div class="col-sm-4">
			<input type="text" name="issudate<?php echo $pay?>" class="form-control" value="<?php  echo date('Y-m-d')?>" id="dofb" />
		</div>
		<div class="clearfix"></div>
	</div>
	<?php } else if($name=='po'){?>
	<div class="form-group p1">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Pay Order No">Pay Order No.</label>
		<div class="col-sm-4">
			<input type="text" name="pono<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group p2">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Bank Name">Bank Name</label>
		<div class="col-sm-4">
			<input type="text" name="bname<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group p3">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Issu Date">Issu Date</label>
		<div class="col-sm-4">
			<input type="text" name="issudate<?php echo $pay?>" class="form-control" value="<?php  echo date('Y-m-d')?>" />
		</div>
		<div class="clearfix"></div>
	</div>
	<?php } else if($name=='dd'){ ?>
	
	<div class="form-group dd0">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="DD No">DD No.</label>
		<div class="col-sm-4">
			<input type="text" name="ddno<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group dd01">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Bank Name">Bank Name</label>
		<div class="col-sm-4">
			<input type="text" name="bname<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group dd02">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Issu Date">Issu Date</label>
		<div class="col-sm-4">
			<input type="text" name="issudate<?php echo $pay?>" value="<?php  echo date('Y-m-d')?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<?php } else if($name=='tt'){?>	
	
	<div class="form-group t0">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="TT No">TT No.</label>
		<div class="col-sm-4">
			<input type="text" name="ttno<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group t1">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Bank Name">Bank Name</label>
		<div class="col-sm-4">
			<input type="text" name="bname<?php echo $pay?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>	
	<div class="form-group t2">
		<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Issu Date">Issu Date</label>
		<div class="col-sm-4">
			<input type="text" name="issudate<?php echo $pay?>" value="<?php  echo date('Y-m-d')?>" class="form-control" />
		</div>
		<div class="clearfix"></div>
	</div>
	<?php } ?>