<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url(); ?>">
    <link rel="stylesheet" type="text/css" href="certificate_css/food_distributes.css">
    <title>খাদ্য বান্ধব কর্মসূচি</title>
    <style>
        @media print
        {
            .no-print, .no-print *
            {
                visibility:hidden;
            }
            table{
                background:none !important;
            }
            #main{
                border:0px !important;
            }
        }
        table.certificate td{line-height:2px;}
    </style>
</head>
<?php
//echo'<pre>';
//print_r($all_data);
?>
<?php
$main2='style="height:11in;width:8.5in;"';
$main_second2='style="height:11in;width:8.5in;"';
$wrapper2='style="margin-top:3px;height:11in;width:8.2in"';
$cert2='style="height:11iin;width:8.2in"';
?>
<body>
<div id="main" <?php if(isset($muri) && $muri==0):echo $main2;endif;?>>
    <div id="main_second" <?php if(isset($muri) &&$muri==0):echo $main_second2;endif;?>>
        <!--- certificate div start here --->
        <div class="wrapper jolchap" <?php if(isset($muri) && $muri==0):echo $wrapper2;endif;?>>
            <div id="cert" <?php if(isset($muri) && $muri==0):echo $cert2;endif;?>>

                <table border="0px" width="99%" height="60px" cellspacing="0"  cellpadding="0" style="border-collapse:collapse;margin:0px auto;">
                    <tr>
                        <td style="width:1.7in;font-size:13px;padding-top: 5px;padding-left: 5px; ">শেখ হাসিনার বাংলাদেশ</td>
                        <td>
                        </td>
                        <td style="width:1.4in;font-size:13px;padding-top: 5px;padding-left: 5px;">
                            ক্ষুধা হবে নিরুদ্দেশ
                        </td>
                    </tr>
                    <tr height="60px">
                        <td <?php if(isset($logo) && $logo==0) { ?> class="no-print" <?php } ?> style="width:1.5in; text-align:right;padding-top:20px;"><img src="logo_images/logo.png" height="55px" width="65px"/></td>
                        <td <?php if(isset($header) && $header==0) { ?> class="no-print" <?php } ?> style="text-align:center;height:60px;"><font style="font-size:15px; font-weight:bold; color:blue; width:5.5in;">গনপ্রজাতন্ত্রী বাংলাদেশ সরকার</font>  <br />
                            <div style="font-size:13px; font-weight:bold;">
                                খাদ্য মন্ত্রণালয়
                            </div>
                            <div style="font-size:13px; font-weight:bold;">
                                খাদ্য অধিদপ্তর
                            </div>

                        </td>
                        <td style="width:1.4in;padding-top:20px;">
                            <img src="<?php echo base_url('logo_images/foodOdidoptor.jpg') ?>" height="65px" width="55px"/>
                        </td>
                    </tr>

                </table>
                <table width="95%" height='240px' border='0' class="muri_table" style="border-collapse:collapse;margin:0px auto;line-height: 24px;">
                    <tr>
                        <td colspan="4" width='100%'>
                            <div class="owarishheadEng">খাদ্য বান্ধব কর্মসূচি</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 145px;font-size:13px;vertical-align:middle;"></td>
                        <td style="width:250px;" ></td>
                        <td style="width: 145px;font-size:13px;vertical-align:middle;text-align: right">কার্ড নম্বর</td>
                        <td style="width:360px;">: <input type="text" value='<?php echo (!empty($applicant_info->card_no)?$applicant_info->card_no:'') ?>' style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                    <tr>
                        <td style="font-size:13px;vertical-align:middle;"></td>
                        <td style="" ></td>
                        <td style="font-size:13px;vertical-align:middle;text-align: right">ইউনিয়নের নাম</td>
                        <td style="border-bottom:1px dashed black;font-size:13px;">: <?php echo $all_data->full_name; ?></td>
                    </tr>


                    <tr>
                        <td style="font-size:12px;vertical-align:middle;">১। কার্ডধারীর নাম </td>
                        <td colspan="3">: <input type="text" value='<?php echo (!empty($applicant_info->name)?$applicant_info->name:'') ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;vertical-align:middle;">২। পিতা/স্বামীর নাম</td>
                        <td colspan="3">: <input type="text" value='<?php echo (!empty($applicant_info->father_name)?$applicant_info->father_name:'')  ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;vertical-align:middle;">৩। পেশা</td>
                        <td colspan="3">: <input type="text" value='<?php echo (!empty($applicant_info->occuTitle)?$applicant_info->occuTitle:'')  ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>

                    <tr>
                        <td style="font-size:12px;vertical-align:middle;">৪।  ঠিকানা: <span style="padding-left:40px"> গ্রাম </span></td>
                        <td colspan="3">: <input type="text" value='<?php echo (!empty($applicant_info->village)?$applicant_info->village:'') ?>' style="font-size:13px;width:260px;border-bottom:1px dashed black;" readonly />
                            <span style="font-size: 12px;">ওয়ার্ড নং</span>
                            : <input type="text" value='<?php echo (!empty($applicant_info->wordNo)?$applicant_info->wordNo." নং":'') ?>' style="width:290px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;vertical-align:middle;text-align: right">ডাকঘর</td>
                        <td colspan="3">:
                            <input type="text" value='<?php echo (!empty($applicant_info->post_office)?$applicant_info->post_office:'') ?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
                            <span style="font-size: 12px;text-right">উপজেলা </span>
                            : <input type="text" name="" value="<?php echo (!empty($all_data->thana) ? $all_data->thana   : '') ?>" id="" style="width:282px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;vertical-align:middle;" colspan="4">৫। জাতীয় পরিচয়পত্র নম্বর
                            <input type="text" value='<?php echo $this->web->banDate($applicant_info->nid)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
                            <span style="font-size: 12px;">জেলা</span>
                            : <input type="text" name="" value="<?php echo (!empty($all_data->district) ?  $all_data->district : '') ?>" id="" style="width:299px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;vertical-align:middle;" colspan="4">৬। কার্ডধারীর স্বাক্ষর ও টিপসই
                            <input type="text" value='<?php echo (!empty($applicant_info->nationid)?  $this->web->banDate($applicant_info->nationid):'') ?>' style="width:585px;font-size:13px;border-bottom:1px dashed black;" readonly />
                        </td>
                    </tr>


                    <tr>
                        <td style="font-size:12px;vertical-align:middle;">৭। ডিলারের নাম</td>
                        <td colspan="3">: <input type="text" value='<?php echo (!empty($applicant_info->dealerName)?$applicant_info->dealerName:'')  ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;vertical-align:middle;" colspan="4">৮। খাদ্য শস্য সরবরাহের দোকানের নাম ও অবস্থান: <input type="text" value='<?php echo (!empty($applicant_info->dealerAddress)?$applicant_info->dealerAddress:''); echo (!empty($applicant_info->dealerMobile)?", মোবাইল নং: ". $this->web->banDate($applicant_info->dealerMobile):'')  ?>' style="width:480px;font-size:13px;border-bottom:1px dashed black;" readonly />
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:12px;vertical-align:middle;" colspan="4">৯। ইস্যুকারী কর্তৃপক্ষের স্বাক্ষর ও সীল: <input type="text" value='<?php echo (!empty($applicant_info->authorityTitle)?$applicant_info->authorityTitle:'') ?>' style="width:550px;font-size:13px;border-bottom:1px dashed black;" readonly />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;vertical-align:middle;" colspan="4">১০। কার্ড ইস্যুর তারিখ
                            <input type="text" value='<?php echo (!empty($applicant_info->card_issue_dt)?$this->web->banDate(date('d-m-Y',strtotime($applicant_info->card_issue_dt))):'') ?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
                            <span style="font-size: 12px;">মোবাইল নং</span>
                            : <input type="text" name="" value="<?php echo (!empty($applicant_info->mobile)?$this->web->banDate($applicant_info->mobile):'') ?>" id="" style="width:289px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
                    </tr>
                </table>


                <h3 style="text-align: center">খাদ্যশস্য বিতরণের বিবরণ </h3>
                <table border="1px" align="center" width="95%" height="310px" align="center" style="border-collapse:collapse; " cellspacing="0" cellpadding="0"  >
                    <thead>
                    <tr height="20px">
                        <th rowspan="2" style="width:5%;font-size:14px;">নং</th>
                        <th  rowspan="2" style="width:20%;font-size:14px;">বিতরনের তারিখ</th>
                        <th style="width:19%;font-size:14px;" colspan="2">পরিমান (কেজি হিসেবে)</th>
                        <th  rowspan="2" style="width:14%;font-size:14px;">গ্রহীতার স্বাক্ষর</th>
                        <th  rowspan="2" style="width:14%;font-size:14px;">সরবরাহকারীর স্বাক্ষর</th>
                    </tr>
                    <tr height="20px">

                        <th style="width:10%;font-size:14px;">চাল</th>
                        <th style="width:10%;font-size:14px;">অন্যান্য</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=1;$i<=22;$i++):?>

                        <tr height='25px'>
                            <td style="text-align:center;font-size:11px;"><?php echo $this->web->banDate($i);?></td>
                            <td id='wn<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
                            <td id='wrel<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
                            <td id='others<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
                            <td id='collector<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
                            <td id='dealer<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
                        </tr>

                    <?php endfor;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--- for print----->
<div id="print-full-page" class="no-print">
    <div class="print-certificate">
        <a target="" href="javaScript:window.print();" title="প্রিন্ট করুন">
            <img src="<?php echo base_url();?>library/print_big.png" alt="প্রিন্ট করুন" />
        </a>
    </div>
</div>
<!--- end for print------>
<script>
    <?php $nr=1; foreach ($receiveInfo as $wrow):?>
    document.getElementById('wn<?php echo $nr?>').innerHTML='<?php echo (!empty($wrow->receive_dt)?$this->web->banDate(date('d-m-Y',strtotime($wrow->receive_dt))):'')?>';
    document.getElementById('wrel<?php echo $nr?>').innerHTML='<?php echo $this->web->banDate($wrow->food_amount)." কেজি"?>';
    <?php $nr++;endforeach;?>

</script>
</body>
</html>