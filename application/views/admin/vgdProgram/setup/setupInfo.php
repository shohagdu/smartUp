<style>
    #content ul li{background:none;}
    .container{width:100%;}
</style>
<script type="text/javascript">
    function loadContent(url, tabId)
    {	// load image
        $("#"+tabId).empty().append('<p align="center" style="margin-top:20%"><img src="img/ajax-loaders/ajax-loader.gif"></p>');
        $("#"+tabId).load(url); // load content in div
    }
</script>
<div id="content" class="col-lg-10 col-sm-10">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <button class="btn btn-custom-info btn-block btn-sm" style="font-size:16px;margin-bottom:10px;font-weight: bolder;"><?php echo (!empty($title)?$title:'') ?></button>
        </div>
    </div>

    <div class="row box" style="padding-bottom:20px;margin-top:10px;">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#menu" onclick="loadContent('index.php/VgdController/setupVGDCircle', 'menu')" style="font-size:14px;">ভিজিডি চক্র</a></li>
                <li><a data-toggle="tab" href="#menu1" onclick="loadContent('index.php/VgdController/setupVGDmonths', 'menu1')" style="font-size:14px;">ভিজিডি মাস সমুহ</a></li>
                <li><a data-toggle="tab" href="#menu2" onclick="loadContent('index.php/VgdController/setupVGDImpAuthority', 'menu2')" style="font-size:14px;">বাস্তবায়নকারী কর্তৃপক্ষ</a></li>
                <li><a data-toggle="tab" href="#menu3" onclick="loadContent('index.php/VgdController/setupVGDResponsibleOffier', 'menu3')" style="font-size:14px;">দায়িত্বপ্রাপ্ত কর্মকর্তা</a></li>
                <li><a data-toggle="tab" href="#menu4" onclick="loadContent('index.php/VgdController/setupVGDUno', 'menu4')" style="font-size:14px;">উপজেলা নির্বাহি অফিসার</a></li>

            </ul>
            <div class="tab-content">
                <!----new client--------for বসতভিটার কর-------start--------------->
                <div id="menu" class="tab-pane fade in active" style="background:none;">
                </div>
                <!----new client--------for বসতভিটার কর-------end--------------->

                <!----old client----for বসতভিটার কর-----------start--------------->
                <div id="menu1" class="tab-pane fade"></div>
                <!----old client----for বসতভিটার কর-----------end--------------->

                <!----trade license এর পেশাজীবি কর start------------------------->
                <div id="menu2" class="tab-pane fade"></div>
                <!----trade license এর পেশাজীবি কর end------------------------->

                <!----trade license এর বসতভিটার কর start------------------------->
                <div id="menu3" class="tab-pane fade"></div>
                <!----trade license এর বসতভিটার কর end------------------------->
                
                <!----trade license এর বসতভিটার কর start------------------------->
                <div id="menu4" class="tab-pane fade"></div>
                <!----trade license এর বসতভিটার কর end------------------------->
                


            </div><!--- /tab content------>
        </div><!-- /container------->
    </div><!-- /row box---->
</div><!--/#content.col-md-0-->