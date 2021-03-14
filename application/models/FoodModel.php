<?php
class FoodModel extends CI_Model
{
    var $table = "food_receiver_applicant_info";
    var $select_column = array("applicant_id", "card_no", "nid", "name",'pic','father_name','mobile','spouse_name','is_verify','id');
    var $order_column = array(null, "id", "name", null, null);
    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->where('is_active',1);
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("card_no", $_POST["search"]["value"]);
            $this->db->or_like("name", $_POST["search"]["value"]);
        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by('id', 'DESC');
        }
    }
    function get_data_info(){

        $this->make_query();
        if($_POST["length"] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $this->db->where('is_active',1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data(){
        $this->make_query();
        $this->db->where('is_active',1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data()
    {
        $this->db->select("*");
        $this->db->where('is_active',1);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function get_all_info($select=NULL,$table,$where=NULL)
    {
        if(!empty($select)){
            $this->db->select("*");
        }else {
            $this->db->select("*");
        }
        $this->db->from($table);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $query= $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return  false;
        }
    }

    function generateApplicantID()
    {
        $this->db->select("id");
        $this->db->from($this->table);
        $this->db->where('YEAR(created_time)',date('Y'));
        $count= $this->db->count_all_results();
        $finalID= $count+1;
        return date('Y').str_pad($finalID,5,0,STR_PAD_LEFT);
    }
    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen( $output_file, 'wb' );
        fwrite( $ifp, base64_decode( $base64_string ) );
        fclose( $ifp );
        return $output_file;
    }
    function get_single_info($select=NULL,$table,$where=NULL)
    {
        if(!empty($select)){
            $this->db->select($select);
        }else {
            $this->db->select("*");
        }
        $this->db->from($table);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->limit(1);
        $query= $this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return  false;
        }
    }

    function getApplicantInfoAutoComplete($searchInfo){
        $response = array();
        if(isset($searchInfo) ) {
            $this->db->select('id,name,mobile,nid');
            $this->db->where("nid like '%" . $searchInfo . "%' ");
            $this->db->or_where("name like '%" . $searchInfo . "%' ");
            $this->db->or_where("mobile like '%" . $searchInfo . "%' ");
            $this->db->where("is_active",1);
            $records = $this->db->get('food_receiver_applicant_info');
            if($records->num_rows()>0) {
                $data=$records->result();
                foreach ($data as $row) {
                    $response[] = array("value" => $row->id, "label" => $row->name . ' - ' . $row->mobile . ' - [' . $row->nid . ']');
                }
            }
        }
        return json_encode( $response);
    }

    function get_receive_food_info($where=NULL)
    {

        $this->db->select("receive.*,applicant.name,applicant.nid,applicant.mobile as applicant_mobile,applicant.village,applicant.wordNo,applicant.pic,dealer.name as dealer_name,dealer.shop_name,dealer.address,dealer.mobile as dealer_mobile,program.title as program_name,program.is_active as program_status");
        $this->db->from('food_receiver_record as receive');
        $this->db->join('food_receiver_applicant_info as applicant','applicant.id=receive.applicant_id',"left");
        $this->db->join('food_dealer_info as dealer','receive.dealer_id=dealer.id',"left");
        $this->db->join('food_program_info as program','program.id=receive.food_program_id',"left");
        if(!empty($where)){
            $this->db->where($where);
        }else {
            $this->db->where('receive.is_active !=', 0);
        }
        $query= $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }else{
            return  false;
        }
    }

    function getPorichoyApiInfo($data,$apiURL,$apiKey){
        $url = $apiURL;
// Collection object
// Initializes a new cURL session
        $curl = curl_init($url);
// Set the CURLOPT_RETURNTRANSFER option to true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// Set the CURLOPT_POST option to true for POST request
        curl_setopt($curl, CURLOPT_POST, true);
// Set the request data as JSON using json_encode function
        curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
// Set custom headers for RapidAPI Auth and Content-Type header
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'x-api-key:'.$apiKey,
            'Content-Type: application/json'
        ]);
// Execute cURL request with all previous settings
        $response = curl_exec($curl);
// Close cURL session
        curl_close($curl);
      if(!empty($response)){
          return $response;
      }else{
          return  false;
      }
    }
}