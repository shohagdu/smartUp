<div id="content" class="col-lg-10 col-sm-10">
	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		function delete_function(){
			return confirm('Are you sure delete this?');
		}
	</script>
	<style>
	.ellipsis {
text-overflow: ellipsis;

/* Required for text-overflow to do anything */
white-space: nowrap;
overflow: hidden;
width:400px;
}
	</style>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">বিভিন্ন ধরনের এসএমএস সেটিং</button>
		</div>
	</div>

	<div style="padding:4px;width:100%;">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th> নং</th>
					<th>ধরণ</th>
					<th>মেসেজ</th>
					<th>সর্বশেষ পরিবর্তন</th>	
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$nr=1;
					foreach($row as $value):
				?>
				<tr>
					<td><?php echo $this->web->banDate($nr++);?></td>
					<td><?php echo $this->web->smsType($value->sms_type);?></td>
					<td><p class='ellipsis'><?php  echo $value->msg; ?></p></td>
					<td><?php echo date('d M Y',strtotime($value->entry_date))?></td>
					<td>
					<a href="setup/update_message_type/<?php echo $value->id?>">
					<button type="button" name="button" class="btn  btn-info btn-sm" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil" style="font-size: 10px"></i></button>
					</a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div><!--/#content.col-md-0-->
<style type="text/css"> 
	a:hover{
		text-decoration: none;
	}
</style>