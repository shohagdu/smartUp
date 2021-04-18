$(function() {
    $(".dateFormatDate").datepicker({ dateFormat: 'dd-mm-yy' });
});
function verifyNIDInfo(){
    var NiDstr=$("#n_id").val();
    var NiD= NiDstr.trim();
    $.ajax({
        url: 'FoodController/verifyNID',
        type: 'POST',
        data: {nid:NiD},
        dataType:'JSON',
        //beforeSend:function() { alert('sending----'); },
        success: function(result) {
            // console.log(result);
            if(result.status == 'error'){
                $('#errorMessage').fadeIn('slow').delay(5000).fadeOut('slow');
                $('#errorText').text(result.message);
            }else if(result.status == 'success'){
                var data=result.data;
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
    $("#foodApplicnatInfoForm").on('submit',(function(e) {
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
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        window.location=data.redirect_page;
                    });

                }
            }
        });
    }));
});

$(document).ready(function(){
    $('#exampleNew').dataTable();
    $('#exampleNew1').dataTable();
    $('#exampleNew2').dataTable();
    $('#exampleNew3').dataTable();
    $('#exampleNew4').dataTable();

    var distribute_applicant_data_dataTable = $('#food_distribute_applicant_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"FoodController/applicantInfo",
            type:"POST",
            'data': function(data){
                data.dealer_id = $('#dealer_id').val();
            }
        },
        'columns': [
            { data: 'slNo' },
            { data: 'img' },
            { data: 'applicant_id' },
            { data: 'card_no' },
            { data: 'nid' },
            { data: 'name' },
            { data: 'father_name' },
            { data: 'mobile' },
            { data: 'dealerName' },
            { data: 'action' },
        ],
        "columnDefs":[
            {
                "targets":[0, 3, 4],
                "orderable":false,
            },
        ],
    });
    $('#dealer_id').change(function(){
        distribute_applicant_data_dataTable.draw();
    });


    var vgd_applicant_data = $('#vgd_applicant_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"VgdController/applicantInfo",
            type:"POST",
            'data': function(data){
                data.dealer_id = $('#dealer_id').val();
            }
        },
        'columns': [
            { data: 'slNo' },
            { data: 'img' },
            { data: 'applicant_id' },
            { data: 'card_no' },
            { data: 'nid' },
            { data: 'name' },
            { data: 'father_name' },
            { data: 'mobile' },
            { data: 'action' },
        ],
        "columnDefs":[
            {
                "targets":[0, 3, 4],
                "orderable":false,
            },
        ],
    });
    // $('#dealer_id').change(function(){
    //     vgd_applicant_data.draw();
    // });



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
                $("#designation").val(info.designation);
                $("#mobile").val(info.mobile);
                $("#status").val(info.is_active);
                $("#updateId").val(id);
            } else {

            }
        }
    });
}
function editAuthorityInfoVGD(id){
    $("#authorityInfoForm")[0].reset();
    $(".output_error").html('');
    $(".saveBtnLevel").html('Update');
    $.ajax({
        type: "POST",
        url: "FoodController/getAuthorityInfo",
        data: {id:id},
        'dataType': 'json',
        success: function (data) {
            if (data.status = 'success') {
                var info=data.data;
                $(".name").val(info.name);
                $(".shopName").val(info.shop_name);
                $(".address").val(info.address);
                $(".designation").val(info.designation);
                $(".mobile").val(info.mobile);
                $(".status").val(info.is_active);
                $(".updateId").val(id);
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



// Food Collection information update
function addFoodReceiveInfo(){
    $("#foodCollectionForm")[0].reset();
    $("#saveBtnLevel").html('Save');
    $('.output_error').html('');
    $("#statuDiv").hide();
}

$(document).on("keyup.autocomplete","#foodApplicantNameLabel",function(){
    var options = {
        source: function (request, response) {
            $.ajax({
                url: "FoodController/getApplicantInfo",
                method: 'GET',
                dataType: "json",
                autoFocus:true,
                data: {
                    q: request.term,
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        select: function (event, ui) {
            if(ui.item.value !='') {
                $('#foodApplicantNameLabel').val(ui.item.label);
                $('#foodApplicantName').val(ui.item.value);
                    var applicantID=ui.item.value;
                    $.ajax({
                        type: "POST",
                        url: "FoodController/get_single_applicant_info",
                        data: {id: applicantID},
                        'dataType': 'json',
                        success: function (response) {
                            if (response.status == 'success') {
                                console.log(response);
                            } else {

                            }
                        }
                    });

            }else{
                $('#foodApplicantNameLabel').val('');
                $('#foodApplicantName').val('');
            }
            return false;
        }
    };
    $('body').on('keyup.autocomplete', "#foodApplicantNameLabel", function() {
        $(this).autocomplete(options);
    });
});


function updateFoodCollectionInfo() {
    $.ajax({
        type: "POST",
        url: "FoodController/updateFoodCollectionInfo",
        data: $('#foodCollectionForm').serialize(),
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

function editFoodCollectionInfo(id){
    $("#foodCollectionForm")[0].reset();
    $(".output_error").html('');
    $("#saveBtnLevel").html('Update');
    $("#statuDiv").show();
    $.ajax({
        type: "POST",
        url: "FoodController/getFoodCollectionInfo",
        data: {id:id},
        'dataType': 'json',
        success: function (data) {
            if (data.status = 'success') {
                var info=data.data;
                console.log(info);
                $("#foodApplicantName").val(info.applicant_id);
                $("#foodApplicantNameLabel").val(info.name+ ' '+ info.applicant_mobile + ' ['+ info.nid+ ']');
                $("#collectionDt").val(info.receive_dt);
                $("#status").val(info.is_active);
                $("#updateId").val(id);
            } else {

            }
        }
    });
}
function searchingReceivedFood(){
    $.ajax({
        type: "POST",
        url: "FoodController/searchingReceivedFood",
        data: $('#searchingReceivedFoodForm').serialize(),
        success: function (data) {
            if (data != '') {
                $("#show_result").html(data);
            } else {

            }
        }
    });
}

function DeleteFoodCollectionInfo(id) {
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
                url: "FoodController/DeleteFoodCollectionInfo",
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

function deleteApplicantInfo(id) {
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
                url: "FoodController/deleteApplicantInfo",
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



// VGD Program

$(document).ready(function (e) {
    $("#VgdApplicnatInfoForm").on('submit',(function(e) {
        $("#submitBtn").attr('disabled',true);
        var formData = new FormData(this)
        e.preventDefault();
        $.ajax({
            url: "VgdController/addNewMemberAction",
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
                    swal({
                        text: data.success,
                        icon: "success",
                    }).then(function () {
                        window.location=data.redirect_page;
                    });

                }
            }
        });
    }));
});

function deleteVGDApplicantInfo(id) {
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
                    url: "VgdController/deleteVGDApplicantInfo",
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

// VGD Progrom

// Authority information update
function addVGDCircleInfo(){
    $("#vgdCircleForm")[0].reset();
    $("#saveBtnLevel").html('Save');
    $('.output_error').html('');
}
function updateVGDCircleInfo() {
    $.ajax({
        type: "POST",
        url: "VgdController/saveVgdCircle",
        data: $('#vgdCircleForm').serialize(),
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
function editVGDcircleInfo(id){
    $("#vgdCircleForm")[0].reset();
    $(".output_error").html('');
    $("#saveBtnLevelCircle").html('Update');
    $.ajax({
        type: "POST",
        url: "VgdController/getVGDcircleInfo",
        data: {id:id},
        'dataType': 'json',
        success: function (data) {
            if (data.status = 'success') {
                var info=data.data;
                $("#name").val(info.title);
                $("#cardIssueDt").val(info.issue_dt);
                $("#cardDistributesDt").val(info.distributes_dt);
                $("#foodType").val(info.food_type);
                $("#implementing_authority").val(info.implement_authority);
                $("#responsibleOfficer").val(info.responsibile_officer);
                $("#responsible_uno_info").val(info.responsibile_uno);
                $("#statusVGD").val(info.is_active);
                $("#updateIdVGD").val(id);
            }
        }
    });
}
function DeleteVGDcircleInfo(id) {
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
                    url: "VgdController/deleteVGDcircleInfo",
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

function editVgdMonth(id){
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
                $("#vgdCircle").val(info.vgd_cricle);
                $("#status").val(info.is_active);
                $("#updateId").val(id);
            } else {

            }
        }
    });
}