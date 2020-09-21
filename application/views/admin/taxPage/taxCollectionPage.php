<div class="row"> 
	<div class="col-sm-12"> 
		<div class="form-group">
			<label class="control-label col-sm-11 col-xs-8" style="text-decoration: underline;">
				<h3 style="font-size: 20px;color: gray;margin-bottom: 20px;">বসতভিটার কর আদায়:</h3>
				
			</label>
			<label for="" class="col-sm-1 col-xs-4">
				<button type="button" class="btn btn-danger btn-sm pull-right" style="position: relative; top: 15px;" onclick="refreshPage();">
				  <span class="glyphicon glyphicon-refresh"></span> Refresh
				</button>
			</label>
		</div>
	</div>
</div>
<style type="text/css"> 
	.help-block{
		text-align: right;
	}
</style>
<div class="row" style="margin-bottom: 20px;"> 
	<div class="col-sm-5 col-sm-offset-1">
		<form class="form-inline" action="admin/search_dag_no" id="dagNoFormId">
			<div class="form-group">
				<label for="Dag No" style="font-size: 20px; font-weight: bolder;">দাগ নং:</label>
				<input type="text" name="dagNo" class="form-control" id="" onkeypress="return numtest();" />
			</div>
			<div class="form-group"> 
				<input type="submit" name="submitBtn" value="খোঁজ করুন" class="btn btn-default">
			</div>
		</form>
	</div>
	<div class="col-sm-1"><span style="font-size: 20px; font-weight: bolder;"> অথবা </span></div>
	<div class="col-sm-5">
		<form class="form-inline" action="admin/searchHolding" id="holdingNoFormId">
			<div class="form-group">
				<label for="Holding No" style="font-size: 20px; font-weight: bolder;">হোল্ডিং নং :</label>
				<input type="text" name="holdingNo" class="form-control" id="" onkeypress="return numtest();" />
			</div>
			<div class="form-group"> 
				<input type="submit" name="submitBtn" value="খোঁজ করুন" class="btn btn-default">
			</div>
		</form>
	</div>
</div>
<div class="row"> 
	<div class="col-sm-12 col-xs-12">
		<span id="error" style="font-size:24px; color:red;"></span>
	</div>
</div>
<div class="row"> 
	<div class="col-lg-12 col-sm-12"> 
		<div id="informationShow"></div>
	</div>
</div>
<script src="all/custom_js/holdingTaxCollection_form.js" type="text/javascript"></script>