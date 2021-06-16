<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    private $mechine_list;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $method = $this->input->method(true);

        if ($method == 'POST') {

            $request = json_decode($_POST['data'], true);

            $insert_data = [];

            if (count($request) > 0) {
                // process data
                foreach ($request as $item) {
                    // insert new entry
                    if(!empty($item['card_no'])){
                        $insert_data[] = [
                            "log_id"      => (!empty($item['id'])?$item['id']:''), // log_id
                            "card_no"      => (!empty($item['card_no'])?$item['card_no']:''), // card no
                            "attendance_date" => date("Y-m-d H:i:s", strtotime($item['attendance_date'])),
                            "nid_no"         => (int) $item['nid_no'],
                            "status"          => (int) $item['status'],
                            "created_at"    => date("Y-m-d H:i:s"),
                            "created_by_ip"   => $this->__get_requested_agent_ip_address(),
                        ];
                    }
                }

                // start transaction
                // $this->db->trans_start();
                if(!empty($insert_data)){
                    $this->db->insert_batch("attendance_logs", $insert_data);
                }

                // echo "<pre>";
                // print_r($this->db->last_query());
                // exit;

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    die(json_encode(['status' => 'error', 'message' => 'Fail to sync. data with live.', 'data' => []]));
                }else{
                    // Finally complete the transaction
                    $this->db->trans_commit();
                    die(json_encode(['status' => 'success', 'message' => 'Successfully data sync. with master.', 'data' => $insert_data]));
                }

            } else {
                die(json_encode(['status' => 'error', 'message' => 'Empty request to master.', 'data' => []]));
            }

        } else {
            die(json_encode(['status' => 'error', 'message' => 'Un-Authorized Access.', 'data' => []]));
        }

    }

    private function __get_requested_agent_ip_address()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }



    // make single row data with login time and logout time
    public function process_log_data()
    {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }


        // Get Current Circle information start

        $foodProgram= $this->db->select("
                  food_program_info.id as programID, 
                  person_amt,
                  program_type
                 
                  ")->get_where("food_program_info", [
            "food_program_info.is_active"=>  1,
            "food_program_info.program_type"=>  1

        ]);

        if($foodProgram->num_rows() > 0){
            $foodProgramData= $foodProgram->row();

        }else{
            die(json_encode( ['status'=>'error','message'=>'Sorry!! No Active Food Program Found, Please first active one Food Program ','data'=>[]]));
        }

        // Get Current Circle information end


        // get all un-processed data
        $un_process_data =
            $this->db->select("attendance_logs.id as logs_primary_id, attendance_logs.attendance_date, attendance_logs.nid_no, attendance_logs.status, attendance_logs.created_at, created_by_ip,food_receiver_applicant_info.id as applicant_primary_id,food_receiver_applicant_info.dealer_id,food_receiver_applicant_info.name,food_receiver_applicant_info.nid as applicant_nid,food_receiver_applicant_info.father_name,food_receiver_applicant_info.mobile,card_issue_dt,date_of_birth,food_receiver_applicant_info.card_no as applicant_card_no")
                ->join('food_receiver_applicant_info','food_receiver_applicant_info.card_no=attendance_logs.card_no','left')
                ->limit(30)
                ->get_where("attendance_logs", [
                    "is_process" => 0
                ])->result()
        ;


        // echo "<pre>";
        // print_r($un_process_data);
        // exit;

        $user_id = '';
        $attendance_date = '';
        $success_output='';
        $updateStatus=[];
        if (count($un_process_data) > 0) {
            foreach ($un_process_data as $key=> $item) {
                $updateStatus[]=  $item;
                if(empty($item->applicant_primary_id)){
                    $updateStatus[$key]->upload_status='ApplicantIdisEmpty';

                    $update_data_info = [
                        "is_process" => 3,
                        "status" => 4,
                    ];

                    $this->db->where('id',$item->logs_primary_id);
                    $this->db->update("attendance_logs",$update_data_info);

                }else{

                    $existance_qry = $this->db->select("food_receiver_record.id, food_receiver_record.applicant_id, food_receiver_record.food_program_id, receive_dt")
                        ->get_where("food_receiver_record", [
                            "food_receiver_record.applicant_id" =>  $item->applicant_primary_id,
                            'food_receiver_record.food_program_id' => $foodProgramData->programID

                        ]);

                    if ($existance_qry->num_rows() > 0) {
                        $update_data_info = [
                            "is_process" => 2,
                            "status" => 3,
                        ];

                        $this->db->where('id',$item->logs_primary_id);
                        $updated= $this->db->update("attendance_logs",$update_data_info);

                        $updateStatus[$key]->upload_status='AlreadyExist';
                    }else{


                        $data = array(
                            "food_program_id" => $foodProgramData->programID,
                            "applicant_id" => (!empty(trim( $item->applicant_primary_id)) ? trim( $item->applicant_primary_id) : ''),
                            "food_type" =>1,
                            "food_amount" => $foodProgramData->person_amt,
                            "unit_id" => 1,

                            "receive_dt" => (!empty(trim($item->attendance_date)) ?date('Y-m-d',strtotime($item->attendance_date) ): date('Y-m-d')),
                            "dealer_id" => (!empty($item->dealer_id)?$item->dealer_id:''),
                            "is_active" => 1,
                            "created_time" => date('Y-m-d H:i:s'),
                            "created_by" => $this->session->userdata('id'),
                            "created_ip" => $this->__get_requested_agent_ip_address(),
                        );


                        $this->db->insert('food_receiver_record', $data);


                        $update_data_info = [
                            "is_process" => 1,
                            "status" => 2,
                        ];

                        $this->db->where('id',$item->logs_primary_id);
                        $updated= $this->db->update("attendance_logs",$update_data_info);

                        if($updated){
                            $updateStatus[$key]->upload_status='SuccessfullyUpload';
                            //$success_output='Successfully Saved this Information';
                        }else{
                            $updateStatus[$key]->upload_status='FailedUpload';

                        }


                        //  $this->db->trans_complete();
                        //  $success_output='Successfully Saved this Information';
                    }
                }

            }
            // echo "<pre>";
            echo json_encode(['status'=>'success','message'=>'Successfully Process Data','data'=>$updateStatus]); exit;
        }else{

            die(json_encode( ['status'=>'error','message'=>'No remaining data found for process','data'=>[]]));

        }

    }






    /*-------------------------------------------------------------------------
    ----------------------- VGD Program----------------------------------------
    -------------------------------------------------------------------------*/


    public function vgd_data_sync()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
        $method = $this->input->method(true);

        if ($method == 'POST') {

            $request = json_decode($_POST['data'], true);
            // echo "<pre>";
            // print_r($request);
            // exit;

            $insert_data = [];

            if (count($request) > 0) {
                // process data
                foreach ($request as $item) {
                    // insert new entry
                    if(!empty($item['card_no'])){
                        $insert_data[] = [
                            "card_no"      => (!empty($item['card_no'])?$item['card_no']:''), // card no
                            "attendance_date" => date("Y-m-d H:i:s", strtotime($item['attendance_date'])),
                            "nid_no"         => (int) $item['nid_no'],
                            "status"          => (int) $item['status'],
                            "created_at"    => date("Y-m-d H:i:s"),
                            "created_by_ip"   => $this->__get_requested_agent_ip_address(),
                        ];
                    }
                }
                //echo "<pre>";
                //print_r($insert_data);
                // exit;

                // start transaction
                //$this->db->trans_start();
                if(!empty($insert_data)){
                    $this->db->insert_batch("vgd_attendance_logs", $insert_data);
                }

                // echo "<pre>";
                //  print_r($this->db->last_query());
                //  exit;

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    die(json_encode(['status' => 'error', 'message' => 'Fail to sync. data with live.', 'data' => []]));
                }else{
                    // Finally complete the transaction
                    $this->db->trans_commit();
                    die(json_encode(['status' => 'success', 'message' => 'Successfully data sync. with master.', 'data' => $insert_data]));
                }

            } else {
                die(json_encode(['status' => 'error', 'message' => 'Empty request to master.', 'data' => []]));
            }

        } else {
            die(json_encode(['status' => 'error', 'message' => 'Un-Authorized Access.', 'data' => []]));
        }

    }


    public function vgd_process_log_data()
    {

        error_reporting();
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }

        $foodProgram= $this->db->select("
                  food_program_info.id as programID, 
                  person_amt,
                  program_type
                  ")->get_where("food_program_info", [
            "food_program_info.is_active"=>  1,
            "food_program_info.program_type"=>  2

        ]);


        if($foodProgram->num_rows() > 0){
            $foodProgramData= $foodProgram->row();
        }else{
            die(json_encode( ['status'=>'error','message'=>'Sorry!! No Active Food Program Found, Please first active one Food Program ','data'=>[]]));
        }



        // Get Current Circle information start

        $currentCircleInfo= $this->db->select("
                  food_vgd_circle_setup.id as circleID, 
                  issue_dt,
                  food_type,
                  food_amount,	
                  implement_authority,
                  responsibile_officer,
                  responsibile_uno
                  ")->get_where("food_vgd_circle_setup", [
                    "food_vgd_circle_setup.is_active"=>  1
                    ]
        );


        if($currentCircleInfo->num_rows() <= 0){
            die(json_encode( ['status'=>'error','message'=>'Sorry!! No Active VGD Circle Found, Please first active one VGD Circle ','data'=>[]]));
        }else{
            $currentCircleData= $currentCircleInfo->row();
        }

//           echo "<pre>";
//           print_r($currentCircleData);
//           exit;
        // Get Current Circle information end

        $un_process_data =
            $this->db->select("
        vgd_attendance_logs.id as logs_primary_id, 
        
        vgd_attendance_logs.attendance_date,
        vgd_attendance_logs.nid_no,
        vgd_attendance_logs.status, 
        vgd_attendance_logs.created_at,
        vgd_attendance_logs.created_by_ip,
        
        food_vgd_applicant_info.id as applicant_primary_id,
        food_vgd_applicant_info.name,
        food_vgd_applicant_info.nid as applicant_nid,
        food_vgd_applicant_info.gurdian_name,
        food_vgd_applicant_info.mobile_no,
        food_vgd_applicant_info.vgd_card_no,
        card_issue_dt,
        date_of_birth,
        implementing_authority,
        responsible_officer,
        responsible_uno_info,
        vgd_attendance_logs.card_no as log_card_no
       
        ")
                ->join('food_vgd_applicant_info','food_vgd_applicant_info.vgd_card_no=vgd_attendance_logs.card_no','left')
                ->limit(10)
                ->get_where("vgd_attendance_logs", [
                    "is_process" => 0
                ])->result()
        ;

//           echo "<pre>";
//           print_r($un_process_data);
//           exit;

        $user_id = '';
        $attendance_date = '';
        $success_output='';
        $updateStatus=[];
        if (count($un_process_data) > 0) {
            foreach ($un_process_data as $key=> $item) {
                $updateStatus[]=  $item;
                if(empty($item->applicant_primary_id)){
                    $updateStatus[$key]->upload_status='ApplicantIdisEmpty';

                    $update_data_info = [
                        "is_process" => 3,
                        "status" => 4,
                    ];

                    $this->db->where('id',$item->logs_primary_id);
                    $this->db->update("vgd_attendance_logs",$update_data_info);

                }else{

                    // checking existing
                    $existance_qry = $this->db->select("
                  food_vgd_receiver_info.id, 
                  food_vgd_receiver_info.applicant_id, 
                  food_vgd_receiver_info.vgd_circle_id, 
                  receive_dt,food_vgd_receiver_info.vgd_program_id
                  ")
                        ->join('food_program_info','food_program_info.id=food_vgd_receiver_info.vgd_program_id AND food_program_info.is_active=1 AND  food_program_info.program_type=2','left')
                        ->get_where("food_vgd_receiver_info", [
                            "food_vgd_receiver_info.applicant_id"=>  $item->applicant_primary_id,
                            "food_vgd_receiver_info.vgd_program_id"=>  $foodProgramData->programID

                        ]);
//                    echo $this->db->last_query();
//                    exit;

                    if ($existance_qry->num_rows() > 0) {
                        $update_data_info = [
                            "is_process" => 2,
                            "status" => 3,
                        ];

                        $this->db->where('id',$item->logs_primary_id);
                        $updated= $this->db->update("vgd_attendance_logs",$update_data_info);

                        $updateStatus[$key]->upload_status='AlreadyExist';
                    }else{


                        $data = array(
                            "vgd_circle_id" => $currentCircleData->circleID,
                            "receve_type" =>$currentCircleData->food_type,
                            "receive_amount" => $currentCircleData->food_amount,

                            "vgd_program_id" => $foodProgramData->programID,

                            "log_id" => $item->logs_primary_id,
                            "applicant_id" => (!empty(trim( $item->applicant_primary_id)) ? trim( $item->applicant_primary_id) : ''),
                            "receive_dt" => (!empty(trim($item->attendance_date)) ?date('Y-m-d',strtotime($item->attendance_date) ): date('Y-m-d')),

                            "implement_authority_id" => (!empty($item->implementing_authority)?$item->implementing_authority:$currentCircleData->implement_authority),
                            "responsible_officer_id" => (!empty($item->responsible_officer)?$item->responsible_officer:$currentCircleData->responsibile_officer),
                            "responsible_uno_id" => (!empty($item->responsible_uno_info)?$item->responsible_uno_info:$currentCircleData->responsibile_uno),


                            "is_active" => 1,
                            "created_time" => date('Y-m-d H:i:s'),
                            "created_by" => $this->session->userdata('id'),
                            "created_ip" => $this->__get_requested_agent_ip_address(),
                        );


                        $this->db->insert('food_vgd_receiver_info', $data);

                        $update_data_info = [
                            "is_process" => 1,
                            "status" => 2,
                        ];

                        $this->db->where('id',$item->logs_primary_id);
                        $updated= $this->db->update("vgd_attendance_logs",$update_data_info);

                        if($updated){
                            $updateStatus[$key]->upload_status='SuccessfullyUpload';
                            //$success_output='Successfully Saved this Information';
                        }else{
                            $updateStatus[$key]->upload_status='FailedUpload';

                        }


                        //  $this->db->trans_complete();
                        //  $success_output='Successfully Saved this Information';
                    }
                }

            }
            // echo "<pre>";
            echo json_encode(['status'=>'success','message'=>'Successfully Process Data','data'=>$updateStatus]); exit;
        }else{

            die(json_encode( ['status'=>'error','message'=>'No remaining data found for process','data'=>[]]));

        }

    }




}
