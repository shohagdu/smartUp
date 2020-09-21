function loadContent(url)
	{
	$("#maincontent").empty().append('<p align="center" style="margin-top:20%"><img src="library/img/ajaxloader.gif"></p>');
	$("#maincontent").load(url);
	}
/*	function msg1()
	{
	alert('!!!Attention!!! \r\n Be Careful to Select this Option.');
	}
	
	leftVal = (screen.width - 440) / 2;
	topVal = (screen.height - 420) / 2;
	
$(document).ready(function(){

	$(".notify").load("index.php/admin/count_noity");
	var refreshId = setInterval(function() {
    $(".notify").hide().load('index.php/admin/count_noity?randval='+ Math.random()).slideDown("fast");
	}, 20000);
	$.ajaxSetup({ cache: false });
	
	$('#scrollbar1').tinyscrollbar();
	
	$('#globalmsg2').show('fast');
	setTimeout(function() {
    $('#globalmsg2').hide('fast');
	}, 3000)
	
	$('.notify').show('fast');
	
	$('#globalmsg').click(function() {
	$('#globalmsg').hide('fast');
	});
	
	$('#globalmsg2').click(function() {
	$(this).hide('fast');
	});
	
	$('#addpur_add').click(function() {
	$("#pur_choose").hide();
	$("#pur_add").show();
	});
	
	$('#addpur_choose').click(function() {
	$("#pur_add").hide();
	$("#new_purpose").val("");
	$("#pur_choose").show();
	});
	
	$(function(){
	$(".datatable tr").hover(
	function()
	{
    $(this).addClass("highlight");
	},
	function()
	{
    $(this).removeClass("highlight");
	});
	});	

	function confirmation() {
		var answer = confirm("Are you sure?")
		if (answer) return true ;
		else return false ;
	}
	
	function validate() {
		return $("input:text,textarea,select").removeClass('error').filter(function() {
		return !/\S+/.test($(this).val());
		}).addClass('error').size() == 0;
	}

	$('#form').submit(validate);

	function validate_reseller() {
		return $("input[name=login], input[name=password],input[name=InputIdentifier],select[name=SelectTariff],input[name=InputClientsLimit],input[name=Fullname],input[name=Address],input[name=City],input[name=ZipCode],input[name=Phone],input[name=Email],input[name=InputRate]").removeClass('error').filter(function() {
		return !/\S+/.test($(this).val());
		}).addClass('error').size() == 0;
	}	
	$('#form1').submit(validate_reseller);

	$('#example').dataTable( {
					"sPaginationType": "full_numbers"
	});
	
	
	$(function() {
		$("#datepicker").datepicker();
		$("#datepicker2").datepicker();
		$("#datepicker3").datepicker();
		$("#datepicker4").datepicker();
		$("#datepicker5").datepicker();
		$("#datepicker6").datepicker();
	});
	
	$("#checkall").click(function()				
			{
				var checked_status = this.checked;
				$("#example input[type=checkbox]").each(function()
				{
					this.checked = checked_status;
			});
	});	
	
	$(function() {
	$('.boxy').boxy();
	});
	 
	
	$('#clientaction').submit(function() {
	
	var targetScroll = 0;
	var checked = $('#example input[type=checkbox]:checked').length > 0;
	var action = $("input[name=action]:checked").length > 0;
	var filename = $("input#filename").val();

	var actionname = $("input[name=action]:checked").val();
	
	if (actionname=='change'){ var actionname='change tariff to'; }
	
    if (!checked){
	$("#globalmsg").show("normal").html('<p class="error">Error: Please check at least one checkbox</p>');
    return false;}
	
	if (!action){
	$("#globalmsg").show("normal").html('<p class="error">Error: Please choose an action to execute</p>');
    return false;}
	
	var answer = confirm("Are you sure you want to "+actionname+" selected clients")
	
	
	if (answer) {
	
	$("#load").append('<img src="library/formloader.gif">');
	
	$.post(
            "index.php/admin/clientaction",
            $("#clientaction").serialize(),
            function(data){
			if (data=="1"){
			$("#globalmsg").show("normal").html('<p class="done">Done: Action executed successfully</p>');
			setTimeout(function() {
			$("#maincontent").load("index.php/admin/"+filename);}, 3000)
			}
			else {
			$("#load").empty().append('<input type="submit" class="buttonslim" value=" &raquo; Apply for Filtered ">');
			$("#globalmsg").show("normal").html('<p class=\"error\">Opps: An error has occurred with our system</p>');
			}
		});
	return false;
	} else { 
	return false;
	}
	
	});
	
	// Remove Data
	$('#removedata').submit(function() {
	var targetScroll = 0;
	var checked = $('#example input[type=checkbox]:checked').length > 0;
	var filename = $("input#filename").val();
	var textmsg="Are you sure you remove selected content";
	
	if (filename=="resellers_i")
	{
	var textmsg="This operation will remove all reseller clients and billing information.Are you sure you remove?";
	}
	if (filename=="providers")
	{
	var textmsg="This operation will remove all accounting information related with this provider's.Are you sure you remove?";
	}
	
	if (!checked){
	$("#globalmsg").show("fast").html('<p class="error">Error: Please check at least one checkbox</p>');
    return false;}
	
	var answer = confirm(textmsg);
	if (answer) {
	
	$("#load").append('<img src="library/formloader.gif">');
	
	$.post(
            "index.php/admin/removedata",
            $("#removedata").serialize(),
            function(data){
			if (data==3){
			$("#load").empty().append('<input type="submit" class="buttonslim" value=" &raquo; Remove Selected">');
			$("#globalmsg").show("fast").html('<p class="warn">Warning: Probably given reseller has children!</p>');
			setTimeout(function() {
			$("#maincontent").load("index.php/admin/"+filename);}, 1000)
			}
			if (data==9){
			$("#load").empty().append('<input type="submit" class="buttonslim" value=" &raquo; Remove Selected">');
			$("#globalmsg").show("fast").html('<p class="warn">Warning: This gateway assigned with some dialing plan</p>');
			setTimeout(function() {
			$("#maincontent").load("index.php/admin/"+filename);}, 1000)
			}
			if (data==1){
			$("#globalmsg").show("fast").html('<p class="done">Done: Action executed successfully</p>');
			setTimeout(function() {
			$("#maincontent").load("index.php/admin/"+filename);}, 3000)
			}
			if (empty(data)){
			$("#load").empty().append('<input type="submit" class="buttonslim" value=" &raquo; Remove Selected">');
			$("#globalmsg").show("fast").html('<p class=\"error\">Opps: An error has occurred with our system</p>');
			}
		});
	return false;
	} else { 
	return false;
	}
	
	});
	//export form
	
	$('#export_form').submit(function() {
	Boxy.get(this).hide();
	return true;
	});
	
	$('#import_form').submit(function() {
	Boxy.get(this).hide();
	return true;
	});
	
	$('#change_form').submit(function() {
	$.post(
            "index.php/admin/change_rate_sub",
            $("#change_form").serialize(),
            function(data){
			alert(data);
			$("#maincontent").load("index.php/admin/tariffdetails?data=<?php echo $id_tariff ?>");
		});
	return false;
	});
	
	$('#searchform').submit(function() {
		var search = $("input#search").val();
		var thisurl = $("input#thisurl").val();
		var url=thisurl+"?qs="+search+"";
		var url=encodeURI(url);
		$("#maincontent").empty().append('<p align="center" style="margin-top:20%"><img src="library/ajaxloader.gif"></p>');
		$("#maincontent").load(url);
			
	return false;
	});
	
	 $('.payWindow').click(function (event){
                    var url = $(this).attr("href");
                    var windowName = "popUp";//$(this).attr("name");
                    var windowSize = "width=440,height=420,left="+leftVal+",top="+topVal;
                    window.open(url, windowName, windowSize);
                    event.preventDefault();
    });
	setInterval('updateClock()', 1000);
});

function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
	
$(function(){
	$('#res_chart_pie').visualize({type: 'pie', height: '200px', width: '550px', colors: ['#FF0000','#008800']});
	$('#chart_pie').visualize({type: 'pie', height: '200px', width: '750px', colors: ['#FF0000','#008800','#333']});
	$('#chart_area').visualize({type: 'area', height: '200px', width: '750px', colors: ['#6fb9e8']});
});

*/