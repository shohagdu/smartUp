<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="datetime"> 
				<h3>ডিজিটাল ইউনিয়ন পরিষদে আপনাকে  স্বাগতম , <span class="show-date-time">Today, <?php echo date('d M, Y');?> </span></h3>
			</div>
		</div>
	</div>
	<?php 
		
		//echo "<pre>";
		//print_r($this->session->userdata());
	?>
	<div class="row"  style="background: #FBFDFE"> 
		<div class="col-md-7 col-sm-7 col-xs-12">
			<h5 class="short-heading"> Quick Manage </h5>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="quick-manage"> 
					<a href="Applicant/nagorickapplicant?napply=new" <?php $this->chk->acl('nagorickapplicant'); ?>>
						<img src="site_image/icon/teach.png" alt="image" />
						<p>নাগরিক আবেদনকারীগন</p>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="quick-manage"> 
					<a href="Applicant/tradelicenseapplicant?napply=new" <?php $this->chk->acl('tradelicenseapplicant'); ?>>
						<img src="site_image/icon/gallery.png" alt="image" />
						<p>ট্রেড লাইসেন্স আবেদনকারীগন </p>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="quick-manage"> 
					<a href="Applicant/warishapplicant?napply=new" <?php $this->chk->acl('warishapplicant'); ?>>
						<img src="site_image/icon/profile.png" alt="image" />
						<p>ওয়ারিশ আবেদনকারীগন </p>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="quick-manage"> 
					<a href="Admin/dailySubmit" <?php $this->chk->acl('dailySubmit'); ?>>
						<img src="site_image/icon/cashin_small.jpg" alt="image" class="img-thumbnail img-responsive"  />
						<p>দৈনিক জমা</p>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="quick-manage"> 
					<a href="Admin/dailyExp">
						<img src="site_image/icon/4_small.jpg" alt="image" class="img-thumbnail img-responsive" />
						<p>দৈনিক খরচ </p>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="quick-manage"> 
					<a href="Admin/taxCollection" <?php $this->chk->acl('taxCollection'); ?>>
						<img src="site_image/icon/3_small.jpg" alt="image"  class="img-thumbnail img-responsive" />
						<p>বসত ভিটা ও পেশাজীবি কর আদায় </p>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-5 col-sm-5 col-xs-12">
			<h5 class="short-heading"> Site Stats </h5>
			<ul class="list-group">
				<li class="list-group-item list-group-item-success">
					<span class="badge badge-color-notification">
						<a href="Applicant/nagorickapplicant?napply=new" <?php $this->chk->acl('nagorickapplicant'); ?>><?php echo $this->dashboard->newNagorik();?></a>
					</span>নতুন নাগরিক আবেদনকারী
				</li>
				<li class="list-group-item list-group-item-success">
					<span class="badge badge-color">
						<a href="Applicant/nagorickapplicant?napply=5" <?php $this->chk->acl('nagorickapplicant'); ?>><?php echo $this->dashboard->CompleteNagorik();?></a>
					</span> মোট নাগরিক সনদ প্রদান
				</li>  
				<li class="list-group-item list-group-item-info">
					<span class="badge badge-color-notification">
						<a href="Applicant/tradelicenseapplicant?napply=new" <?php $this->chk->acl('tradelicenseapplicant'); ?>><?php echo $this->dashboard->newTradelicense()?></a>
					</span> নতুন ট্রেড লাইসেন্স আবেদনকারী
				</li> 
				<li class="list-group-item list-group-item-info">
					<span class="badge badge-color">
						<a href="Applicant/tradelicenseapplicant?napply=5" <?php $this->chk->acl('tradelicenseapplicant'); ?>><?php echo $this->dashboard->genTradelicense();?></a>
					</span> মোট ট্রেড লাইসেন্স সনদ প্রদান
				</li>
				<li class="list-group-item list-group-item-info">
					<span class="badge badge-color-warning">
						<a href="Applicant/tradelicenseapplicant?napply=expire" <?php $this->chk->acl('tradelicenseapplicant'); ?>><?php echo $this->dashboard->expireLicense();?></a>
					</span> মেয়াদ উত্তীর্ণ ট্রেড লাইসেন্স
				</li>  
				<li class="list-group-item list-group-item-info">
					<span class="badge badge-color-notification">
						<a href="Applicant/reNewTradelicense"><?php echo $this->dashboard->renew_app();?></a>
					</span> ট্রেড লাইসেন্স নবায়ন আবেদন
				</li> 
				<li class="list-group-item list-group-item-success">
					<span class="badge badge-color-notification">
						<a href="Applicant/warishapplicant?napply=new"<?php $this->chk->acl('warishapplicant'); ?>><?php echo $this->dashboard->newWarish();?></a>
					</span> নতুন ওয়ারিশ সনদের আবেদনকারী
				</li> 
				<li class="list-group-item list-group-item-success">
					<span class="badge badge-color">
						<a href="Applicant/warishapplicant?napply=5" <?php $this->chk->acl('warishapplicant'); ?>><?php echo $this->dashboard->CompleteWarish();?></a>
					</span> মোট ওয়ারিশ সনদ প্রদান
				</li> 
			</ul>
		</div>
	</div>
	
	<div class="row"> 
		<div class="col-md-7 col-sm-7 col-xs-12">
			<h5 class="short-heading"> ব্যাংক সমুহ </h5>
			<div class="table-responsive bank-table">
				<table class="table">
					<thead>
						<tr class="danger">
							<th>একাউন্টের নাম</th>
							<th>একাউন্ট নং</th>
							<th>টাকার পরিমান</th>
						</tr>
						<?php 
							$blance1=0;$total=0;
							foreach($bank_report as $row):
						?>
					</thead>
					<tbody>
						<tr class='success'>
							<td><?php echo $row->acname;?></td>
							<td><?php echo $row->acno;?></td>
							<td>
								<?php 
									echo $blance1=$row->balance;
									$total+=$row->balance;
								?>
							</td>
						</tr>
					</tbody>
							<?php endforeach; ?>
					<tfoot>
						<tr class="bank-footer"> 
							<td></td>
							<td>Total : </td>
							<td><?php echo number_format($total); ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		
		<div class="col-md-5 col-sm-5 col-xs-12">
			<h5 class="short-heading">SMS Inbox</h5>
			<ul class="list-group">
				<li class="list-group-item list-group-item-danger"><span class="badge badge-color-notification"><?php echo $total=1000;?></span>Total SMS</li>
				<li class="list-group-item list-group-item-success"><span class="badge"><?php echo $use=$sms_report->count_sms ?></span>Use SMS</li>  
				<li class="list-group-item list-group-item-info sms-remaning"><span class="badge badge-color"><?php echo $remaining=$total-$use;?></span>Remaining SMS</li> 
			</ul>
		</div>
	</div>
</div><!--/#content.col-md-0-->


<hr>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
			</div>
		</div>
	</div>
</div>

	
	