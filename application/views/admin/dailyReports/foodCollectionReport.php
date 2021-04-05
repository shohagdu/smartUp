<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
    <base href="<?php echo base_url();?>"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> খাদ্য বান্ধব কর্মসূচি খাদ্য গ্রহণের তালিকা</title>
    <meta name="robots" content="index, nofollow" />
    <link rel="shortcut icon" href="img/favicon.ico"  type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="reports_css/reports.css"/>
    <link rel="stylesheet" type="text/css" href="reports_css/dailyreport.css"/>
    <link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
    <script src="datepicker/jquery-1.9.1.js"></script>
    <script src="datepicker/jquery-ui.js"></script>
</head>
<body>
<div id="bar">
    <div class="barcon">
        <form action="" method="get">
            <p align="right"  style="width: 80%">
                <select name="programInfo" id="">
                    <option value="" >কর্মসূচি চিহ্নিত করুন</option>
                    <?php
                    if(!empty($program)){
                        foreach($program as $programVal):
                            ?>
                            <option value="<?php echo $programVal->id;?>" <?php echo ($programVal->id==(!empty($_GET['programInfo'])?$_GET['programInfo']:''))? "selected" : '';?> ><?php echo $programVal->title;?></option>
                        <?php endforeach; } ?>
                </select>
                <select name="dealerName" id="">
                    <option value="" >ডিলার চিহ্নিত করুন</option>
                    <?php
                    if(!empty($dealerInfo)){
                        foreach($dealerInfo as $key=> $value):
                            ?>
                            <option value="<?php echo $value->id;?>" <?php echo ($value->id==(!empty($_GET['dealerName'])?$_GET['dealerName']:''))? "selected" : '';?> ><?php echo $value->name;?></option>
                        <?php endforeach; } ?>
                </select>


                <select name="wordNo" id="wordNo" class="form-control medium-font-inupt fixed_test_valid"  >
                    <option value="">ওয়ার্ড নং চিহ্নিত করূন</option>
                    <?php
                    for($i=1;$i<=50;$i++){
                        $selectedWard=($i==(!empty($_GET['wordNo'])?$_GET['wordNo']:''))? "selected" : '';
                        echo '<option value="'.$i.'"'. $selectedWard.'> ওয়ার্ড নং - '.$i.'</option>';
                    }
                    ?>
                </select>



                <input type="submit" value="Search" class="submit">

            </p>
        </form>
        <p align="right" style="float:left;width:20%;">
            <a href="javaScript:window.print();" title="Print"><img src="library/img/print.png"></a>
            <a href="<?php echo base_url('DailyReports/foodCollectionReport') ?>" style="font-size:16px;font-weight: bold;margin-left:10px;color:white;" title="Reload">Refresh</a>

        </p>
    </div>
</div>
<?php
if(empty($_GET['programInfo'])) {
    $report=  ['status'=>'error','message'=>'কর্মসূচি চিহ্নিত করুন','data'=>''];
}else {
    if (!empty($_GET['programInfo'])) {
        $param['receive.food_program_id'] = $_GET['programInfo'];
    }
    if (!empty($_GET['dealerName'])) {
        $param['receive.dealer_id'] = $_GET['dealerName'];
    }

    if (!empty($_GET['wordNo'])) {
        $param['applicant.wordNo'] = $_GET['wordNo'];
    }

    $param['receive.is_active'] = 1;
    $report = $this->setup->get_receive_food_info($param);
}

?>
<div class="fix stracture wrapper1">
    <div class="fix top-side">
        <div class="fix heading">
            <h2><?php echo (!empty($all_data->full_name)?$all_data->full_name:'');?></h2>
            <h4><?php echo $all_data->gram;?></h4>
            <p class="highilight">
                <span>খাদ্য বান্ধব কর্মসূচি খাদ্য গ্রহণের তালিকা</span>
            </p>
            <h4 style="font-size: 15px;">প্রিন্ট তারিখঃ  <?php echo $this->web->banDate(date('d-m-Y'));?></h4>
        </div>
        <div class="fix footer">
            <table cellpadding="0" cellspacing="0" width="99%" style="margin: 0px auto; border-collapse:collapse;table-layout: auto;" >
                <thead>
                <tr>
                    <td class="tbl-head" style="width: 20px;">ক্রঃ</td>
                    <td class="tbl-head" style="width: 120px;">নাম</td>
                    <td class="tbl-head" nowrap style="width: 50px;">কার্ড নং</td>
                    <td class="tbl-head" nowrap style="width: 100px;">জাতীয় পরিচয় পত্র</td>
                    <td class="tbl-head" style="width: 50px;">মোবাইল</td>
                    <td class="tbl-head" style="width: 50px;">পরিমান</td>
                    <td class="tbl-head" style="width: 80px;">ডিলার</td>
                    <td class="tbl-head" style="width: 50px;">ওয়ার্ড নং</td>
                    <td class="tbl-head" style="width: 50px;">তারিখ</td>
                </tr>
                </thead>
                <tbody>
                <?php if($report['status'] === 'error'):?>
                    <tr height='10'>
                        <td colspan="9"><p style="text-indent: 10px;"><?php echo $report['message']  ?></p></td>
                    </tr>
                <?php else:  $sl=1; foreach($report['data'] as $row):?>
                    <tr>
                        <td class="tbldis"><?php echo $sl++;?></td>
                        <td class="tbldis"><?php echo $row->name;?></td>
                        <td class="tbldis "><?php echo $row->card_no;?></td>
                        <td class="tbldis "><?php echo $row->nid;?></td>
                        <td class="tbldis "><?php echo $row->applicant_mobile;?></td>
                        <td class="tbldis" nowrap><?php echo $this->web->banDate($row->food_amount)." (Kg)";?></td>
                        <td class="tbldis"><?php echo $row->dealer_name;?></td>
                        <td class="tbldis"><?php echo $this->web->banDate($row->wordNo)." নং";?></td>
                        <td class="tbldis"><?php echo !empty($row->receive_dt)?$this->web->banDate(date('d-m-Y',strtotime($row->receive_dt))):'';?></td>

                    </tr>
                <?php endforeach;endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>