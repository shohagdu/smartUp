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
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data(){
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data()
    {
        $this->db->select("*");
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
            return $query->row();
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