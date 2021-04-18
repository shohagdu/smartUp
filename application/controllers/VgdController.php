<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class VgdController extends CI_Controller
{

    public function __construct()
    {
        ob_start();
        parent::__construct();
        $this->load->library('session');
        // $this->load->model('FoodModel','foodmodel');
        $this->load->model('Security_set', 'sq');
        $this->load->model('Role_chk', 'chk');
        $this->load->model('Setup_model', 'Setup');


        $logged_status = $this->session->userdata('logged_status');

        // echo $this->sq->check_exist_q();

        if ($logged_status == FALSE) {
            redirect('mms24', 'location');
        }

        $passChang = $this->setup->forcePassChange();

        if ($passChang == false) {
            redirect("setup_section/changePassword");
        }
        $get = $this->setup->basicUnionSetup();
        if ($get == false) {
            redirect("setup/updatesetupform", 'location');
        }
    }

    //functions
    function index()
    {
        $data["title"] = "সদস্যদের তথ্য (ভিজিডি)";
        $data["dealerInfo"] = $this->Setup->get_all_info('id,name', "food_dealer_info", ['is_active' => 1, 'type' => 1]);
        $this->load->view('admin/topBar', $data);
        $this->load->view('admin/leftMenu');
        $this->load->view('admin/vgdProgram/applicantInfo');
        $this->load->view('admin/footer');
    }
    public function applicantInfo(){
        $postData = $this->input->post();
        $fetch_data = $this->Setup->getVGDApplicantInfo($postData);
        echo json_encode($fetch_data); exit;
    }
    function addNewMember(){
        $data["title"] = "নতুন আবেদনকারীর তথ্য (ভিজিডি) ";
        $data["implementAuth"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>3]);
        $data["responsibleOfficer"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>4]);
        $data["responsibleUNO"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>5]);
        $data['circleInfo']=$this->Setup->get_row('food_vgd_circle_setup',['is_active'=>1],'id,title,issue_dt,distributes_dt,implement_authority,responsibile_officer,responsibile_uno',['filed'=>'id','order'=>'DESC']);
        $data['AllCircleInfo']=$this->Setup->get('food_vgd_circle_setup',['is_active'=>1],'id,title,issue_dt,distributes_dt,implement_authority,responsibile_officer,responsibile_uno',['filed'=>'id','order'=>'DESC']);

        $this->load->view('admin/topBar',$data);
        $this->load->view('admin/leftMenu');
        $this->load->view('admin/vgdProgram/addNewMember');
        $this->load->view('admin/footer');
    }
    function editNewMember($id){
        $data["title"] = "আপডেট আবেদনকারীর তথ্য (ভিজিডি) ";
        $data["implementAuth"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>3]);
        $data["responsibleOfficer"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>4]);
        $data["responsibleUNO"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>5]);
        $data['AllCircleInfo']=$this->Setup->get('food_vgd_circle_setup',['is_active'=>1],'id,title,issue_dt,distributes_dt,implement_authority,responsibile_officer,responsibile_uno',['filed'=>'id','order'=>'DESC']);
        $data['info']=$this->Setup->get_row('food_vgd_applicant_info',['md5(id)'=>$id]);
        $this->load->view('admin/topBar',$data);
        $this->load->view('admin/leftMenu');
        $this->load->view('admin/vgdProgram/editNewMember');
        $this->load->view('admin/footer');
    }

    public function addNewMemberAction()
    {

        if(isset($_POST['vgd_applicant_info'])){
            extract($_POST);
//            echo "<pre>";
//            print_r($_POST);
//            exit;
            $error_array = array();
            $success_output = '';

            if(empty($n_id)){
                $error_array[] = 'জাতীয় পরিচয় পত্র  নম্বর   প্রদান করূন';
            }
            if(empty($vgd_cricle)){
                $error_array[] = 'ভিজিটি চক্র চিহ্নিত করূন';
            }

            if(empty($cardNo)){
                $error_array[] = 'কার্ড নম্বর প্রদান করুন';
            }

            if(empty($full_name)){
                $error_array[] = 'কার্ডধারীর নাম  প্রদান করুন';
            }
//            if(empty($dofb)){
//                $error_array[] = 'জম্ম তারিখ প্রদান করুন';
//            }
            if(empty($village)){
                $error_array[] = 'গ্রামের নাম প্রদান করূন';
            }
            if(empty($wordNo)){
                $error_array[] = 'ওয়ার্ড নং   প্রদান করূন';
            }
//            if(empty($post_office)){
//                $error_array[] = 'ডাকঘর  প্রদান করূন';
//            }
//            if(empty($upazila)){
//                $error_array[] = 'উপজেলা প্রদান করূন';
//            }
//            if(empty($district)){
//                $error_array[] = 'জেলা প্রদান করূন';
//            }

//            if(empty($dealer_name)){
//                $error_array[] = 'ডিলারের নাম সিলেক্ট করুন ';
//            }
//            if(empty($issueingAuthority)){
//                $error_array[] = 'ইস্যুকারী কর্তৃপক্ষের নাম সিলেক্ট করুন  ';
//            }
            if(empty($cardIssueDt)){
                $error_array[] = 'কার্ড ইস্যুর তারিখ    ';
            }

            if(empty($error_array)) {
                if (!empty($is_verify) && $is_verify == 2) {
                    $pic = (!empty($old_image) ? $old_image : '');
                } else {
                    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                        $pic = $this->setup->uploadimageFoodApplicant($_FILES['image']);
                    } elseif (!empty($old_image) && empty($_FILES['image']['name'])) {
                        $pic = (!empty($old_image) ? $old_image : '');
                    } else {
                        $pic = 'img/default/profile.png';
                    }
                }

                if(empty($updateID)) {
                    $data = array(
                        "applicant_id" => $this->Setup->generateApplicantVGDID(),
                        "vgd_cricle" => (!empty(trim($_POST['vgd_cricle'])) ? trim($_POST['vgd_cricle']) : ''),
                        "vgd_card_no" => (!empty(trim($_POST['cardNo'])) ? trim($_POST['cardNo']) : ''),
                        "nid" => (!empty(trim($_POST['n_id'])) ? trim($_POST['n_id']) : ''),
                        "name" => (!empty(trim($_POST['full_name'])) ? trim($_POST['full_name']) : ''),
                        "gurdian_name" => (!empty(trim($_POST['guardina_name'])) ? trim($_POST['guardina_name']) : ''),

                        "mother_name" => (!empty(trim($_POST['motherName'])) ? trim($_POST['motherName']) : NULL),
                        "guardian_type" => (!empty(trim($_POST['guardina_type'])) ? trim($_POST['guardina_type']) : NULL),
                        "date_of_birth" => (!empty($dofb) ? date('Y-m-d', strtotime($_POST['dofb'])) : ''),
                        "age" => (!empty(trim($_POST['age'])) ? trim($_POST['age']) : ''),
                        "village" => (!empty(trim($_POST['village'])) ? trim($_POST['village']) : ''),

                        "wordNo" => (!empty(trim($_POST['wordNo'])) ? trim($_POST['wordNo']) : ''),
                        "post_office" => (!empty(trim($_POST['post_office'])) ? trim($_POST['post_office']) : ''),
                        "upazila" => (!empty(trim($_POST['upazila'])) ? trim($_POST['upazila']) : ''),
                        "district" => (!empty(trim($_POST['district'])) ? trim($_POST['district']) : ''),
                        "pic" => $pic,
                        "is_verify" => (!empty($is_verify) ? $is_verify : 1),
                        "api_data" => (!empty($api_data) ? $api_data : 1),
                        "mobile_no" => (!empty(trim($_POST['mobile'])) ? trim($_POST['mobile']) : NULL),
                        "total_family_member" => (!empty(trim($_POST['total_family_member'])) ? trim($_POST['total_family_member']) : NULL),

                        "card_issue_dt" => (!empty($cardIssueDt) ? date('Y-m-d', strtotime($_POST['cardIssueDt'])) : ''),
                        "card_distributes_dt" => (!empty(trim($_POST['cardDistributeDt'])) ? date('Y-m-d', strtotime($_POST['cardDistributeDt'])) : NULL),
                        "implementing_authority" => (!empty(trim($_POST['implementing_authority'])) ? trim($_POST['implementing_authority']) : NULL),
                        "responsible_uno_info" => (!empty(trim($_POST['responsible_uno_info'])) ? trim($_POST['responsible_uno_info']) : NULL),
                        "responsible_officer" => (!empty(trim($_POST['responsible_officer'])) ? trim($_POST['responsible_officer']) : NULL),




                        "created_time" => date('Y-m-d H:i:s'),
                        "created_by" => $this->session->userdata('id'),
                        "created_ip" => (string)$this->input->ip_address(),
                    );

                    $this->db->trans_start();
                    $this->db->insert('food_vgd_applicant_info', $data);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();
                        $success_output='Failed to Saved Information';
                    }
                    else {
                        # Everything is Perfect.
                        # Committing data to the database.
                        $this->db->trans_commit();
                        $success_output='Successfully Saved this Information';
                    }

                }else{
                    $data = array(

                        "vgd_cricle" => (!empty(trim($_POST['vgd_cricle'])) ? trim($_POST['vgd_cricle']) : ''),
                        "vgd_card_no" => (!empty(trim($_POST['cardNo'])) ? trim($_POST['cardNo']) : ''),
                        "nid" => (!empty(trim($_POST['n_id'])) ? trim($_POST['n_id']) : ''),
                        "name" => (!empty(trim($_POST['full_name'])) ? trim($_POST['full_name']) : ''),
                        "gurdian_name" => (!empty(trim($_POST['guardina_name'])) ? trim($_POST['guardina_name']) : ''),

                        "mother_name" => (!empty(trim($_POST['motherName'])) ? trim($_POST['motherName']) : NULL),
                        "guardian_type" => (!empty(trim($_POST['guardina_type'])) ? trim($_POST['guardina_type']) : NULL),
                        "date_of_birth" => (!empty($dofb) ? date('Y-m-d', strtotime($_POST['dofb'])) : ''),
                        "age" => (!empty(trim($_POST['age'])) ? trim($_POST['age']) : ''),
                        "village" => (!empty(trim($_POST['village'])) ? trim($_POST['village']) : ''),

                        "wordNo" => (!empty(trim($_POST['wordNo'])) ? trim($_POST['wordNo']) : ''),
                        "post_office" => (!empty(trim($_POST['post_office'])) ? trim($_POST['post_office']) : ''),
                        "upazila" => (!empty(trim($_POST['upazila'])) ? trim($_POST['upazila']) : ''),
                        "district" => (!empty(trim($_POST['district'])) ? trim($_POST['district']) : ''),
                        "pic" => $pic,

                        "mobile_no" => (!empty(trim($_POST['mobile'])) ? trim($_POST['mobile']) : NULL),
                        "total_family_member" => (!empty(trim($_POST['total_family_member'])) ? trim($_POST['total_family_member']) : NULL),

                        "card_issue_dt" => (!empty($cardIssueDt) ? date('Y-m-d', strtotime($_POST['cardIssueDt'])) : ''),
                        "card_distributes_dt" => (!empty(trim($_POST['cardDistributeDt'])) ? date('Y-m-d', strtotime($_POST['cardDistributeDt'])) : NULL),
                        "implementing_authority" => (!empty(trim($_POST['implementing_authority'])) ? trim($_POST['implementing_authority']) : NULL),
                        "responsible_uno_info" => (!empty(trim($_POST['responsible_uno_info'])) ? trim($_POST['responsible_uno_info']) : NULL),
                        "responsible_officer" => (!empty(trim($_POST['responsible_officer'])) ? trim($_POST['responsible_officer']) : NULL),

                        "is_verify" => (!empty($is_verify) ? $is_verify : 1),
                        "api_data" => ((!empty($api_data) && $is_verify==2) ? $api_data : NULL),

                        "is_active" => (!empty(trim($_POST['status'])) ? trim($_POST['status']) : ''),
                        "updated_time" => date('Y-m-d H:i:s'),
                        "updated_by" => $this->session->userdata('id'),
                        "updated_ip" => (string)$this->input->ip_address(),
                    );

                    $this->db->trans_start();
                    $this->db->where('id',$updateID);
                    $this->db->update('food_vgd_applicant_info', $data);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();
                        $success_output='Failed to Saved Information';
                    }
                    else {
                        # Everything is Perfect.
                        # Committing data to the database.
                        $this->db->trans_commit();
                        $success_output='Successfully Update this Information';
                    }

                }



            }
            $output = array(
                'error' => $error_array,
                'success' => $success_output,
                'redirect_page' => 'VgdController'
            );
            echo json_encode($output);
        }
    }
    function deleteVGDApplicantInfo(){
        extract($_POST);
        if(!empty($id)){
            $data=[
                "is_active" =>0,
                "updated_time" => date('Y-m-d H:i:s'),
                "updated_by" => $this->session->userdata('id'),
                "updated_ip" => (string)$this->input->ip_address(),
            ];

            $info_data=$this->Setup->get_row('food_vgd_receiver_info',['applicant_id'=>$id,'is_active'=>1]);
            if(!empty($info_data->applicant_id) && $info_data->applicant_id!=1){
                echo json_encode( ['status'=>'error','message'=>'Sorry ! This applicant already  received food (VGD), Your are not eligible for delete this.']);exit;
            }

            $this->db->trans_start();
            $this->db->where('id',$id);
            $this->db->update("food_vgd_applicant_info",$data);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                # Something went wrong.
                $this->db->trans_rollback();
                echo json_encode( ['status'=>'error','message'=>'Failed to delete information',]);exit;
            } else {
                # Everything is Perfect.
                # Committing data to the database.
                $this->db->trans_commit();
                echo json_encode(['status'=>'success','message'=>'Successfully Delete Information']); exit;

            }

        }
    }


    function setupInfo(){
        $data["title"] = "সেটিংস সমূহ (ভিজিডি) ";
        $data["implementAuth"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>3]);
        $data["responsibleOfficer"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>4]);
        $data["responsibleUNO"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>5]);
        $data['circleInfo']=$this->Setup->get_row('food_vgd_circle_setup',['is_active'=>1],'id,title,issue_dt,distributes_dt,implement_authority,responsibile_officer,responsibile_uno',['filed'=>'id','order'=>'DESC']);
        $data['AllCircleInfo']=$this->Setup->get('food_vgd_circle_setup',['is_active'=>1],'id,title,issue_dt,distributes_dt,implement_authority,responsibile_officer,responsibile_uno',['filed'=>'id','order'=>'DESC']);

        $this->load->view('admin/topBar',$data);
        $this->load->view('admin/leftMenu');
        $this->load->view('admin/vgdProgram/setup/setupInfo');
        $this->load->view('admin/footer');
    }
    public function setupVGDCircle(){
        $data["heading"] = "ভিজিডি চক্র সেটিংস";
        $data["add_title"] = "ভিজিডি চক্র ";
        $data["implementAuth"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>3]);
        $data["responsibleOfficer"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>4]);
        $data["responsibleUNO"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>5]);
        $data["record"] = $this->Setup->get_all_info('*',"food_vgd_circle_setup",['is_active'=>1]);
        $this->load->view('admin/vgdProgram/setup/setupVGDCircle',$data);

    }
    public function setupVGDmonths(){
        $data["heading"] = "ভিজিডি মাস সমূহ";
        $data["add_title"] = "ভিজিডি মাস ";
        $data['AllCircleInfo']=$this->Setup->get('food_vgd_circle_setup',['is_active'=>1],'id,title,issue_dt,distributes_dt,implement_authority,responsibile_officer,responsibile_uno',['filed'=>'id','order'=>'DESC']);

        $data['record']=$this->Setup->get_join('food_program_info',['food_program_info.is_active !='=>0,'program_type'=>2],'food_program_info.id,food_program_info.title,food_vgd_circle_setup.title as circle_title,food_program_info.is_active','',['filed'=>'food_program_info.id','order'=>'DESC'],'',[["table"=>"food_vgd_circle_setup","relation"=>"food_vgd_circle_setup.id=food_program_info.vgd_cricle","type"=>"inner"]],'','');
        $this->load->view('admin/vgdProgram/setup/setupVGDmonths',$data);

    }
    public function setupVGDImpAuthority(){
        $data["heading"] = "ভিজিডি বাস্তবায়নকারী কর্তৃপক্ষ গণ";
        $data["add_title"] = "বাস্তবায়নকারী কর্তৃপক্ষ";
        $data["record"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>3]);
        $this->load->view('admin/vgdProgram/setup/setupVGDImpAuthority',$data);

    }
    public function setupVGDResponsibleOffier(){
        $data["heading"] = "দায়িত্বপ্রাপ্ত কর্মকর্তা গণ";
        $data["add_title"] = "দায়িত্বপ্রাপ্ত কর্মকর্তা";
        $data["record"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>4]);
        $this->load->view('admin/vgdProgram/setup/setupVGDResponsibleOffier',$data);

    }
    public function setupVGDUno(){
        $data["heading"] = "উপজেলা নির্বাহি অফিসার সমূহ";
        $data["add_title"] = "উপজেলা নির্বাহি অফিসার ";
        $data["record"] = $this->Setup->get_all_info('id,name',"food_dealer_info",['is_active'=>1,'type'=>5]);
        $this->load->view('admin/vgdProgram/setup/setupVGDUno',$data);

    }

    function saveVgdCircle(){
        extract($_POST);
        if(isset($_POST['submit_info'])){
            $error_array = array();
            $success_output = '';

            if(empty($name)){
                $error_array[] = 'ভিজিডি চক্রের নাম  প্রদান করুন ';
            }
            if(empty($cardIssueDt)){
                $error_array[] = 'উপকারভোগী তালিকাভুক্তির তারিখ  প্রদান করুন';
            }
            if(empty($cardDistributesDt)){
                $error_array[] = 'ভিজিডি কার্ড বিতরণের তারিখ  প্রদান করুন';
            }
            if(empty($foodType)){
                $error_array[] = 'খাদ্যের ধরন  প্রদান করুন';
            }
            if(empty($implementing_authority)){
                $error_array[] = 'বাস্তবায়নকারী কর্তৃপক্ষ  প্রদান করুন';
            }
            if(empty($responsible_officer)){
                $error_array[] = 'দায়িত্বপ্রাপ্ত কর্মকর্তা   প্রদান করুন';
            }
            if(empty($responsible_uno_info)){
                $error_array[] = 'উপজেলা নির্বাহি অফিসারের নাম   প্রদান করুন';
            }

            if(empty($status)){
                $error_array[] = 'স্ট্যাটাস চিহ্নিত করূন';
            }


            if(empty($error_array)) {
                if(empty($updateId)) {
                    $data = array(
                        "title" => (!empty(trim($name)) ? trim($name) : NULL),
                        "issue_dt" => (!empty(trim($cardIssueDt)) ? date('Y-m-y',strtotime($cardIssueDt)) : NULL),
                        "distributes_dt" => (!empty(trim($cardDistributesDt)) ? date('Y-m-y',strtotime($cardDistributesDt)) : NULL),
                        "food_type" => (!empty(trim($foodType)) ? trim($foodType) :NULL),
                        "implement_authority" => (!empty(trim($implementing_authority)) ? trim($implementing_authority) : NULL),
                        "responsibile_officer" => (!empty(trim($responsible_officer)) ? trim($responsible_officer) : NULL),
                        "responsibile_uno   " => (!empty(trim($responsible_uno_info)) ? trim($responsible_uno_info) : NULL),
                        "is_active" => (!empty(trim($status)) ? trim($status) : 1),
                        "created_time" => date('Y-m-d H:i:s'),
                        "created_by" => $this->session->userdata('id'),
                        "created_ip" => (string)$this->input->ip_address(),
                    );


                    $this->db->trans_start();
                    $this->db->insert('food_vgd_circle_setup', $data);
                    $this->db->trans_complete();
                    $success_output='Successfully Saved this Information';

                }else{

                    $data = array(
                        "title" => (!empty(trim($name)) ? trim($name) : NULL),
                        "issue_dt" => (!empty(trim($cardIssueDt)) ? date('Y-m-y',strtotime($cardIssueDt)) : NULL),
                        "distributes_dt" => (!empty(trim($cardDistributesDt)) ? date('Y-m-y',strtotime($cardDistributesDt)) : NULL),
                        "food_type" => (!empty(trim($foodType)) ? trim($foodType) :NULL),
                        "implement_authority" => (!empty(trim($implementing_authority)) ? trim($implementing_authority) : NULL),
                        "responsibile_officer" => (!empty(trim($responsible_officer)) ? trim($responsible_officer) : NULL),
                        "responsibile_uno   " => (!empty(trim($responsible_uno_info)) ? trim($responsible_uno_info) : NULL),
                        "is_active" => (!empty(trim($status)) ? trim($status) : ''),
                        "updated_time" => date('Y-m-d H:i:s'),
                        "updated_by" => $this->session->userdata('id'),
                        "updated_ip" => (string)$this->input->ip_address(),
                    );


                    $this->db->trans_start();
                    $this->db->where('id',$updateId);
                    $this->db->update('food_vgd_circle_setup', $data);
                    $this->db->trans_complete();
                    $success_output='Successfully update this Information';
                }

                if ($this->db->trans_status() === FALSE) {
                    # Something went wrong.
                    $this->db->trans_rollback();
                    $success_output='Failed to Update Information';
                } else {
                    # Everything is Perfect.
                    # Committing data to the database.
                    $this->db->trans_commit();

                }

            }
            $output = array(
                'error' => $error_array,
                'success' => $success_output,
                'redirect_page' => 'FoodController/dealerInfo'
            );
            echo json_encode($output);
        }
    }

    function getVGDcircleInfo(){
        extract($_POST);
        if(!empty($id)){
            $info=$this->Setup->get_single_info('*',"food_vgd_circle_setup",['id'=>$id]);
            $info->issue_dt=(!empty($info->issue_dt)?date('d-m-Y',strtotime($info->issue_dt)):'');
            $info->distributes_dt=(!empty($info->distributes_dt)?date('d-m-Y',strtotime($info->distributes_dt)):'');
            if(!empty($info)){
                echo json_encode(['status'=>'success','message'=>'Successfully Data Found','data'=>$info]); exit;
            }else{
                echo json_encode( ['status'=>'error','message'=>'No Data Found','data'=>[]]);exit;
            }
        }
    }


    function deleteVGDcircleInfo(){
        extract($_POST);
        if(!empty($id)){
            $data=[
                "is_active" =>0,
                "updated_time" => date('Y-m-d H:i:s'),
                "updated_by" => $this->session->userdata('id'),
                "updated_ip" => (string)$this->input->ip_address(),
            ];
            $info=$this->Setup->get_single_info('id',"food_vgd_receiver_info",['vgd_circle_id'=>$id]);
            if(!empty($info)){
                echo json_encode( ['status'=>'error','message'=>'Sorry ! This information already used in VGD Received Product.']);exit;
            }

            $this->db->trans_start();
            $this->db->where('id',$id);
            $this->db->update("food_vgd_circle_setup",$data);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                # Something went wrong.
                $this->db->trans_rollback();
                echo json_encode( ['status'=>'error','message'=>'Failed to delete information',]);exit;
            } else {
                # Everything is Perfect.
                # Committing data to the database.
                $this->db->trans_commit();
                echo json_encode(['status'=>'success','message'=>'Successfully Delete Information']); exit;

            }

        }
    }
}