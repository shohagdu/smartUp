<div id="content" class="col-lg-10 col-sm-10">
	<style type="text/css"> 
		@-moz-document url-prefix() {
			.input-file-sm {
				height: auto;
				padding-top: 2px;
				padding-bottom: 1px;
			}
		}
		.medium-font{
			font-size: 15px;
			font-weight: normal;
		}
		.medium-font-inupt{
			font-size: 16px !important;
			letter-spacing: 1px;
			color: #333 !important;
		}
		.all-input-form label>span{
			color:red;
		}
	</style>
	<script type="text/javascript"> 
		// for images upload........
		var loadFile=function(event){
			var output=document.getElementById("image");
			output.src=URL.createObjectURL(event.target.files[0]);
			document.getElementById('error_id').innerHTML="";
		};
	</script>
	<!-- Content (Right Column)-->
	
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<!-- Form -->
			<h3 class="tit" style="margin-top:0px;margin-bottom: 30px;background:lightgray;padding:5px;text-align:center;"> ওয়েব সাইট Logo ম্যনেজ</h3>
			<form action="Admin/logo_submit_action" method="post" style="border: 1px solid #ddd; padding: 10px;box-sizing: border-box;" enctype="multipart/form-data" class="form-horizontal">
				<div class="row"> 
					<div class="col-sm-12"> 
						<div class="form-group"> 
							<div class="col-sm-6 col-sm-offset-3" id="UPLOAD"> 
								<img src="logo_images/logo.png" id="image" name="pic" class="img-thumbnail" style="height:162px;width:162px;" />
							</div>
						</div>
					</div>
				</div>
				<div class="row medium-font">
					<div class="col-sm-12"> 
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-3">
								<span style="opacity: 0.6;font-size: 14px; font-family: comicsans-ms;">Hints: দয়া করে 162 x 162 এবং 500 kb র নিচে লোগো আপলোড করুন </span>
							</div>
						</div>
					</div>
				</div>
				<div class="row medium-font">
					<div class="col-sm-12"> 
						<div class="form-group">
							<label for="Picture" class="col-sm-3 control-label">ছবি</label>
							<div class="col-sm-6">
								<input type="file" name="picture" id="pic" title="please select images" class="form-control input-file-sm" onchange="loadFile(event)" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-offset-3 col-sm-1"> 
						<input type='submit' value="আপলোড" name='logo_setup' class="btn btn-info btn-sm"/>
					</div>
					<div class="col-sm-7 pull-left"> 
						<?php 
							$er = $this->session->userdata('error');
							$this->session->unset_userdata('error');
							if($er==1):
								echo '<span id="error_id" style="font-size:18px;font-family:comicsans-ms;color:red;">
									Your selected logo size is more than 500 KB.Select less than 500 KB logo.
								</span>';
							elseif($er==2):
								echo '<span id="error_id" style="font-size:18px;font-family:comicsans-ms;color:green;">
									Successfully upload your Logo <br />  restart your browser...
								</span>';	
							endif; 
						?>
					</div>
				</div>
			</form>
		</div><!--- /col-lg-12 col-sm-12-------->	
	</div> <!-- /row -->
</div><!--/#content.col-md-0-->

