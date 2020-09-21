<div id="content" class="col-lg-10 col-sm-10">
	<!--<link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
	<script src="datepicker/jquery-1.9.1.js"></script>
	<script src="datepicker/jquery-ui.js"></script>-->

	<script type="text/javascript"> 
		$(function() {
			$( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
			$( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
		});	
	</script>
	<!-- for div print code start --->
	<script type="text/javascript">
		function PrintElem(elem)
		{
			Popup($(elem).html());
		}
		function Popup(data) 
		{
			var mywindow = window.open('', 'my div', 'height=400,width=600');
			mywindow.document.write('<html><head><title>my div</title>');
			/*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
			mywindow.document.write('</head><body >');
			mywindow.document.write(data);
			mywindow.document.write('</body></html>');

			mywindow.document.close(); // necessary for IE >= 10
			mywindow.focus(); // necessary for IE >= 10

			mywindow.print();
			mywindow.close();

			return true;
		}
	</script>
	<!--- for div print end----->
	
	<div  class="row box">
		<!-- Form -->
		<div class="col-lg-12 col-sm-12">
			<form class="form-inline" role="form">
				<div class="form-group">
					<label for="Account type">Category</label>
					<select class="form-control" name="ac_type" id="ac">
						<option value="">---Select one---</option>
						<?php 
							$query=$this->db->get('subctg');	
							$result=$query->result();
							foreach ($result as $row):
						?>
						<option value="<?php echo $row->sub_title?>"><?php echo $row->sub_title;?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label for="From Date">From</label>
					<input type="text" name="to_date" class="form-control" id="to_date" value='<?php echo date('Y-m-d');?>'/>
				</div>
				<div class="form-group">
					<label for="To Date">To</label>
					<input type="text" name="from_date" class="form-control"id="from_date" value='<?php echo date('Y-m-d');?>'/>
				</div>
				<button type="button" onclick="htmlData('DailyReports/dailySubLedgerSearch','ac='+ac.value+'&to='+to_date.value+'&from='+from_date.value)" class="btn btn-info">Submit</button>
				<!--<input type="button" value="Print" onclick="PrintElem('#txtResult')" />-->
			</form>
		</div>
	</div>
	<div class="row" style="margin-top: 30px;"> 
		<div class="col-lg-12 col-sm-12"> 
			<div id="txtResult">
				
			</div>
		</div>
	</div>
</div><!--/#content.col-md-0-->