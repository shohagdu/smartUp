	<div id="content" class="col-lg-10 col-sm-10">
		<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
		<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>library/voterAdd.js"></script>
		<style type="text/css"> 
			@-moz-document url-prefix() {
				.input-file-sm {
					height: auto;
					padding-top: 2px;
					padding-bottom: 1px;
				}
			}
			.medium-font{
				font-size: 13px;
				font-weight: normal;
			}
			.h-style{
				font-size: 15px;
				font-weight: normal;
				text-align: center;
			}
			.medium-font-inupt{
				font-size: 14px !important;
				letter-spacing: 0px;
				color: #333 !important;
			}
			.all-input-form label>span{
				color:red;
			}
		</style>
		<!-- some information query -->
		<div class="row">
			<div class="col-md-12"> 
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">আপনার ইউনিয়ন পরিষদের প্রতিবন্ধী ছাত্র/ছাত্রী ভাতা প্রাপ্তদের তথ্য যোগ করুন</div>
					<div class="panel-body all-input-form">
						<div class="row" style="margin-bottom: 10px;"> 
							<div class="col-sm-9 pull-left">
								<span id="error" style="font-size:20px;color:red;"></span>
								<span id="success" style="font-size:20px;color:green;"></span>
							</div>
							<div class="col-sm-3 pull-right"> 
								<a href="Manage/unionPorishad">
									<button type="button" class="btn-success btn-sm pull-right">প্রতিবন্ধী ছাত্র/ছাত্রী ভাতা প্রাপ্তদের তালিকা</button>
								</a>
							</div>
						</div>
						<form action="Manage/addAutisticStudent_action" method="post" onsubmit="return validation();" id="autisticStudentFormId" enctype="multipart/form-data" class="fixedInputTestClass form-horizontal">
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<div class="col-sm-3">
											<h3 class="h-style">পিতা/মাতা/স্বামীর ন্যাশনাল আইডি</h3>
										</div>
										<div class="col-sm-3">
											<h3 class="h-style">ছাত্র/ছাত্রীর নাম </h3>
										</div>
										<div class="col-sm-2">
											<h3 class="h-style">পিতা/স্বামীর নাম</h3>
										</div>
										<div class="col-sm-2">
											<h3 class="h-style">গ্রাম</h3>
										</div>
										<div class="col-sm-1">
											<h3 class="h-style">ওয়ার্ড নং</h3>
										</div>
										<div class="col-sm-1">
											<h3 class="h-style">অ্যকশন</h3>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<div class="col-sm-3">
											<input type="text" name="national_id[]" id="n_id" class="form-control medium-font-inupt fixed_test_valid" onkeypress="return checkaccnumber(event);" />
										</div>
										<div class="col-sm-3">
											<input type="text" name="bangla_name[]" id="studentName" class="form-control medium-font-inupt fixed_test_valid" />
										</div>
										<div class="col-sm-2">
											<input type="text" name="father_name[]" id="fname" class="form-control medium-font-inupt fixed_test_valid" readonly />
										</div>
										<div class="col-sm-2">
											<input type="text" name="gram[]" id="gram_id" class="form-control medium-font-inupt fixed_test_valid" readonly />
										</div>
										<div class="col-sm-1">
											<input type="text" name="word_no[]" id="w_no" class="form-control medium-font-inupt fixed_test_valid" readonly />
										</div>
										<div class="col-sm-1">
											<input type="button" name="nwarish" onclick="addRow(this.form);" value='যোগ করুন' class="btn btn-info btn-sm"/>
										</div>
									</div>
								</div>
							</div>
							<div class="row  medium-font">
								<div class="col-sm-12" id="itemRows"> 
									
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-1 col-sm-offset-11" >
									<input type="submit" value="Submit"  class="btn btn-info btn-sm" />
								</div>
							</div>
							<!---
							<div class="row">
								<div class="col-sm-offset-3 col-sm-1"> 
									<input type='submit' value="যোগ করুন" name="addVoter" class="btn btn-info btn-sm"/>
								</div>
								<div class="col-sm-6 pull-left"> 
									<span id="error" style="font-size:18px;font-family:comicsans-ms;color:red;"></span>
								</div>
							</div>
							--->
						</form>
					</div>
				</div><!--- / panel primary----->
			</div>
		</div><!-- row end--->
	</div><!--/#content.col-md-10-->
</div><!--/fluid-row-->
<script type="text/javascript"> 
	var rowNum = 0;
	function addRow(frm){
		var n_id=document.getElementById("n_id").value;
		var studentName=document.getElementById("studentName").value;
		var fname=document.getElementById("fname").value;
		var gram_id=document.getElementById("gram_id").value;
		var w_no=document.getElementById("w_no").value;
		if(n_id==''){
			alert("দু:খিত! ন্যাশনাল আইডি নম্বর দিতে হবে");
		}
		else if(studentName==''){
			alert("দু:খিত! নাম দিতে হবে");
		}
		else if(fname==''){
			alert("দু:খিত! পিতার নাম দিতে হবে");
		}
		else if(gram_id==''){
			alert("দু:খিত! গ্রামের নাম দিতে হবে");
		}
		else if(w_no==''){
			alert("দু:খিত! ওয়ার্ড নম্বর দিতে হবে");
		}
		else{
			$.post(
				"index.php/Manage/checkArray",
				$("#autisticStudentFormId").serialize(),
				function(data){
					//alert(data);
					if(data==1){
						document.getElementById('error').innerHTML="আপনার ন্যাশনাল আইডি নম্বরটি Already নিচে যোগ করা আছে।";
						document.getElementById('success').innerHTML="";
						var n_id = document.getElementById('n_id').value;
						$('#autisticStudentFormId').trigger('reset');
						document.getElementById('n_id').value=n_id;
					}
					else{
						rowNum ++;
						var row = '<div id="rowNum'+rowNum+'" class="form-group"><div class="col-sm-3"><input type="text" name="national_id[]" value="'+frm.n_id.value+'" class="form-control" readonly /></div><div class="col-sm-3"><input type="text" name="bangla_name[]" value="'+frm.studentName.value+'" class="form-control" readonly /></div><div class="col-sm-2"><input type="text" name="father_name[]" value="'+frm.fname.value+'" class="form-control"  readonly/></div><div class="col-sm-2"><input type="text" name="gram[]" value="'+frm.gram_id.value+'" class="form-control" readonly /></div><div class="col-sm-1"><input type="text" name="word_no[]" value="'+frm.w_no.value+'" class="form-control" readonly /></div><div class="col-sm-1"><input type="button" value="Remove" class="btn btn-danger btn-xs" onclick="removeRow('+rowNum+');" /></div></div>';
						jQuery('#itemRows').append(row);
						frm.n_id.value = '';
						document.getElementById('success').innerHTML="";
						frm.studentName.value = '';
						frm.fname.value = '';
						frm.gram_id.value = '';
						frm.w_no.value = '';
					}
				});	
		}
	}
	function removeRow(rnum){
		jQuery('#rowNum'+rnum).remove();
	}
</script>
<script type="text/javascript">
	$("document").ready(function(){
		$("#n_id").keyup(function(){
			var n_id=$("#n_id").val();
			//alert(n_id);exit;
			var tbl_autisticStudent = 'tbl_autisticStudent' // it's table name
			if(n_id.trim()==""){
				$('#autisticStudentFormId').trigger('reset');
				document.getElementById('error').innerHTML="";
				document.getElementById('success').innerHTML="";
				exit();
			}
			$.ajax({
				url:"Manage/searchVoterInfo?tbl="+tbl_autisticStudent,
				data:{n_id:n_id},
				type:"GET",
				success:function(hr){
					//var result=hr.responseText;

					//alert(hr);
					if(hr==1){
						document.getElementById('error').innerHTML="আপনার ন্যাশনাল আইডি নম্বরটি সঠিক নয় অথবা ভোটার তথ্যে যোগ করা হয়নি।";
						document.getElementById('success').innerHTML="";
						var n_id = document.getElementById('n_id').value;
						$('#autisticStudentFormId').trigger('reset');
						document.getElementById('n_id').value=n_id;
					}
					else if(hr==2){
						document.getElementById('error').innerHTML="আপনার ন্যাশনাল আইডি নম্বরটি Already যোগ করা হয়েছে।";
						document.getElementById('success').innerHTML="";
						var n_id = document.getElementById('n_id').value;
						$('#autisticStudentFormId').trigger('reset');
						document.getElementById('n_id').value=n_id;
					}
					else{
						document.getElementById('error').innerHTML="";
						document.getElementById('success').innerHTML="আপনার ন্যাশনাল আইডি নম্বরটি ভোটার তথ্যে পাওয়া গেছে, দয়া করে যোগ করুন।";
						var d=hr.split("+");
						//document.getElementById('n_id').value=d[0];
						document.getElementById('fname').value=d[1]; // father name hishabe
						document.getElementById('gram_id').value=d[3];
						document.getElementById('w_no').value=d[4];
					}
				}
			});
		});
	});
</script>