// check only number
function checkaccnumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}

//load any file specific Div
function loadContent(url)
	{
	$("#content-group").load(url);
	}
$(document).ready(function() {
	
	//All form validate
	function validate() {
	return $("input:text,textarea,select").removeClass('blank').filter(function() {
    return !/\S+/.test($(this).val());
	}).addClass('blank').size() == 0;
	}
	
	$('#validall').submit(validate);
	$('#form').submit(validate);
	
	// for fixed input.....
	function validate_fixed() {
		return $(".fixed_test_valid").removeClass('blank').filter(function() {
		return !/\S+/.test($(this).val());
		}).addClass('blank').size() == 0;
	}
	$('#fixedInputTest').submit(validate_fixed);
	
	// for fixed input test class...........
	function validate_fixed_class() {
		return $(".fixed_test_valid").removeClass('blank').filter(function() {
		return !/\S+/.test($(this).val());
		}).addClass('blank').size() == 0;
	}
	$('.fixedInputTestClass').submit(validate_fixed_class);
	
	setTimeout(function() {
    $('.msg').fadeOut();
	}, 3000)

	$('table th input[type=checkbox]').click(function(){
			var table = $(this).parents('table');
			if($(this).is(':checked')){
				table.find('div.checker span').addClass('checked');
				table.find('input[type=checkbox]').attr('checked', true);
			}
			else if($(this).is(':not(:checked)')){
				table.find('div.checker span').removeClass('checked');
				table.find('input[type=checkbox]').attr('checked', false);
			}
	});
		
	$('#removedata').submit(function() {


	var checked = $('#datatable input[type=checkbox]:checked').length > 0;
	var filename = $("input#filename").val();
	var textmsg="Are you sure you remove selected content";
	
	if (!checked){
	alert("Error: Please check at least one checkbox");
    return false;}
	var answer = confirm(textmsg);
	if (answer) {
	
	//$("#content").empty().append("<p align='center' style='margin-top:15%'><img src='library/admin/tmp/ajaxloader.gif'></p>");
	
	$.post(
            "index.php/admin/removedata",
            $("#removedata").serialize(),
            function(data){
			if (data=="1"){
			window.location=filename;
			}

		});
	return false;
	} else { 
	return false;
	}
	
	});
	
});