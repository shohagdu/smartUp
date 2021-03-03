function verifyNIDInfo(){
    var NiD=$("#n_id").val();
    $.ajax({
        url: 'FoodController/verifyNID',
        type: 'POST',
        data: {nid:NiD},
        dataType:'JSON',
        //beforeSend:function() { alert('sending----'); },
        success: function(result) {
            if(result.status == 'error'){
                $('#errorMessage').fadeIn('slow').delay(5000).fadeOut('slow');
                $('#errorText').text(result.message);
            }else if(result.status == 'success'){
                console.log(result);
                var data=result.data;
                console.log(data);
                $("#full_name").val(data.name);
                $("#guardina_name").val(data.father);
                $("#spouse_name").val(data.spouse);
                // $("#guardina_name").val(data.mother);
                $("#dofb").val(data.dobNew);
                $("#village").val(data.village);
                $("#post_office").val(data.post_office);
                $("#upazila").val(data.upazila);
                $("#district").val(data.district);
                if(data.image!=null) {
                    $("#image").attr("src", data.image);
                    $("#old_image").val(data.image);
                }
                if(data.spouse==null){
                    $("#guardina_type").val(1);
                    $("#fatherInfo").show();
                    $("#spouseInfo").hide();
                }else{
                    $("#guardina_type").val(2);
                    $("#spouseInfo").show();
                    $("#fatherInfo").hide();
                }
                var jsonData= JSON.stringify( data );
                $("#api_data").val(jsonData);
                $("#is_verify").val(2);
            }else{
                alert(result);
            }

        }
    });
}
var LoadFile = function (event) {
    var output = document.getElementById("img_id");
    document.getElementById("img_div").style.display = "block";
    output.src = URL.createObjectURL(event.target.files[0]);
}
$(document).ready(function (e) {
    $("#fixedInputTest").on('submit',(function(e) {
        $("#submitBtn").attr('disabled',true);
        var formData = new FormData(this)
        e.preventDefault();
        $.ajax({
            url: "FoodController/newApplicantInfoAction",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            'dataType': 'json',
            success: function(data)
            {
                if (data.error.length > 0) {
                    $("#submitBtn").attr('disabled',false);
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                    }
                    $('#error_output').html(error_html);
                } else {
                    $('#error_output').html('');
                    alert(data.success);
                    window.location=data.redirect_page;
                }
            }
        });
    }));
});

$(document).ready(function(){
    $('#exampleNew').dataTable();

    var dataTable = $('#food_distribute_applicant_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"FoodController/applicantInfo",
            type:"POST"
        },
        "columnDefs":[
            {
                "targets":[0, 3, 4],
                "orderable":false,
            },
        ],
    });
});
// Food Program
function addFoodProgram() {
    $("#programInfoForm")[0].reset();
    $("#saveBtnLevel").html('Save');
    $('.output_error').html('');
}
function updateFoodProgram() {
    $.ajax({
        type: "POST",
        url: "FoodController/updateFoodProgram",
        data: $('#programInfoForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('.output_error').html(error_html);
            } else {
                $('.output_error').html('');
                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });

            }
        }
    });
}
function editFoodProgram(id){
    $("#programInfoForm")[0].reset();
    $("#output_error").html('');
    $("#saveBtnLevel").html('Update');
    $('.output_error').html('');

    $.ajax({
        type: "POST",
        url: "FoodController/getFoodProgram",
        data: {id:id},
        'dataType': 'json',
        success: function (data) {
            if (data.status = 'success') {
               var info=data.data;
               $("#programName").val(info.title);
               $("#person_amt").val(info.person_amt);
               $("#total_allotment").val(info.total_allotment);
               $("#status").val(info.is_active);
               $("#updateId").val(id);
            } else {

            }
        }
    });
}
function DeleteFoodProgram(id) {
    swal({
        title: "Are you sure?",
        text: "After confirmation, your changes will be saved",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "FoodController/delete_food_program",
                    data: {id: id},
                    'dataType': 'json',
                    success: function (response) {
                        if (response.status == 'success') {
                            swal({
                                text: response.message,
                                icon: "success",
                            }).then(function () {
                                location.reload();
                            });

                        } else {
                            swal(response.message, {
                                icon: "warning",
                            });
                        }
                    }
                });
            }
        });
}

// Authority information update
function addAuthorityInfo(){
    $("#authorityInfoForm")[0].reset();
    $("#saveBtnLevel").html('Save');
    $('.output_error').html('');
}
function updateAuthorityInfo() {
    $.ajax({
        type: "POST",
        url: "FoodController/updateAuthorityInfo",
        data: $('#authorityInfoForm').serialize(),
        'dataType': 'json',
        success: function (data) {
            if (data.error.length > 0) {
                var error_html = '';
                for (var count = 0; count < data.error.length; count++) {
                    error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
                }
                $('.output_error').html(error_html);
            } else {
                $('.output_error').html('');
                swal({
                    text: data.success,
                    icon: "success",
                }).then(function () {
                    location.reload();
                });

            }
        }
    });
}

function editAuthorityInfo(id){
    $("#authorityInfoForm")[0].reset();
    $(".output_error").html('');
    $("#saveBtnLevel").html('Update');
    $.ajax({
        type: "POST",
        url: "FoodController/getAuthorityInfo",
        data: {id:id},
        'dataType': 'json',
        success: function (data) {
            if (data.status = 'success') {
                var info=data.data;
                $("#name").val(info.name);
                $("#shopName").val(info.shop_name);
                $("#address").val(info.address);
                $("#mobile").val(info.mobile);
                $("#status").val(info.is_active);
                $("#updateId").val(id);
            } else {

            }
        }
    });
}
function DeleteAuthorityInfo(id) {
    swal({
        title: "Are you sure?",
        text: "After confirmation, your changes will be saved",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: "FoodController/delete_authority_nfo",
                data: {id: id},
                'dataType': 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        swal({
                            text: response.message,
                            icon: "success",
                        }).then(function () {
                            location.reload();
                        });

                    } else {
                        swal(response.message, {
                            icon: "warning",
                        });
                    }
                }
            });
        }
    });
}