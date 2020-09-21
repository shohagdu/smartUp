	// for validation .............
	function validation(){
		var national_id=document.getElementById('national_id').value;
		var full_name_bangla=document.getElementById('full_name_bangla').value;
		var full_name_english=document.getElementById('full_name_english').value;
		var father_name=document.getElementById('father_name').value;
		var mother_name=document.getElementById('mother_name').value;
		var dofb=document.getElementById('dofb').value;
		var basha_holding=document.getElementById('basha_holding').value;
		var word_no=document.getElementById('word_no').value;
		var gram=document.getElementById('gram').value;
		var post_office=document.getElementById('post_office').value;
		var upzilla=document.getElementById('upzilla').value;
		var district=document.getElementById('district').value;
		var pattern = /^[\s()+-]*([0-9][][০-৯][\s()+-]*){6,20}$/;

		if(national_id==''){
			document.getElementById('error').innerHTML='আপনার ন্যাশনাল আইডি কার্ড নম্বরটা ইংরেজীতে প্রদান করুন ।';
			return false;
		}
		else if(full_name_bangla==''){
			document.getElementById('error').innerHTML="ভোটারের নাম বাংলায় প্রদান করুন ।";
			return false;
		}
		else if(full_name_english==''){
			document.getElementById('error').innerHTML="ভোটারের নাম ইংরেজীতে প্রদান করুন ।";
			return false;
		}
		else if(father_name==''){
			document.getElementById('error').innerHTML="পিতার নাম প্রদান করুন";
			return false;
		}
		else if(mother_name==''){
			document.getElementById('error').innerHTML="মাতার নাম প্রদান করুন";
			return false;
		}
		else if(dofb==''){
			document.getElementById('error').innerHTML='দয়া করে জম্ম তারিখ প্রদান করুন ।';
			return false;
		}
		else if(basha_holding==''){
			document.getElementById('error').innerHTML='দয়া করে বাসা /হোল্ডিং নম্বর প্রদান করুন ।';
			return false;
		}
		else if(word_no==''){
			document.getElementById('error').innerHTML="দয়া করে ওয়ার্ড নং প্রদান করুন";
			return false;
		}
		else if(gram==''){
			document.getElementById('error').innerHTML="দয়া করে গ্রামের নাম প্রদান করুন";
			return false;
		}
		else if(post_office==''){
			document.getElementById('error').innerHTML="দয়া করে পো: অফিসের নাম প্রদান করুন";
			return false;
		}
		else if(upzilla==''){
			document.getElementById('error').innerHTML="দয়া করে উপজেলার নাম প্রদান করুন";
			return false;
		}
		
		else if(district==''){
			document.getElementById('error').innerHTML="দয়া করে জেলার নাম প্রদান করুন";
			return false;
		}
		
		else {
			return true;
		}
	}
	
	// for date picker ................	
	$(function() {
		$( "#dofb" ).datepicker({
			changeMonth: true,
			changeYear: true,
			autoSize: true,
			dateFormat: 'dd-mm-yy'
		});
	});
	
	/*============ number test function start ===============*/
	function numtest(){
		return event.charCode >= 48 && event.charCode <= 57;
	}
	function checkaccnumber(evt){
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}
		return true;
	}
	/*============ number test function end===============*/
	
	// for images upload........
	var loadFile=function(event){
		var output=document.getElementById("image");
		var image_size= parseInt((event.target.files[0].size)/1000);
		//alert(image_size);
		if(image_size > 150){
			document.getElementById("pic").value = "";
			document.getElementById("img_div").style.display = "none";
			alert("IMAGE SIZE LARGE MAXIMUM SIZE 150 KB");
		}
		else{
			document.getElementById("img_div").style.display = "block";
			output.src=URL.createObjectURL(event.target.files[0]);
		}
	};
	
	// for ajax method data submit.........
	$("document").ready(function(){
		$("#voterActionId").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({  
				type: "POST",  
				url: "index.php/Manage/addVoter_action",  
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {
					if(data==1){
						alert("ধন্যবাদ!!! আপনার জাতীয় পরিচয় পত্রের তথ্য যোগ করা হয়েছে।");
						location.reload();
					}
					else if(data==3){
						alert("দয়া করে (*) চিহ্নিত সকল তথ্য সঠিকভাবে প্রদান করুন ।");
					}
					else if(data==2){
						alert("Opps!!! Data not insert");
					}
					else{
						alert(data);
					}
				}
			}); 
			return false;
		});
	});
	
	// for ajax method data update of voter .........
	$("document").ready(function(){
		$("#updateVoterActionId").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({  
				type: "POST",  
				url: "index.php/Manage/updateVoter_action",  
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {
					//alert(data);exit;
					if(data==1){
						alert("ধন্যবাদ!!! আপনার জাতীয় পরিচয় পত্রের তথ্য আপডেট করা হয়েছে।");
						//location.reload();
						window.location='Manage/unionPorishad';
					}
					else if(data==3){
						alert("দয়া করে (*) চিহ্নিত সকল তথ্য সঠিকভাবে প্রদান করুন ।");
					}
					else if(data==2){
						alert("Opps!!! Data not insert");
					}
					else{
						alert(data);
					}
				}
			}); 
			return false;
		});
	});

	