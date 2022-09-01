<?php

class Project_invoice_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }


    /* common function for get organization id */



    public function getOrganization_Users_OrganizationId($user_id){
        $user_id = (int)$user_id;
        $this->db->select('organization_id');
        $this->db->from('organization_user_details');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['organization_id'];
    }
    /*Get project list*/
    public function get_project_details($project_id = Null)
    {

        $this->db->select('project_detail.*,td.project_start_date as project_start_date,td.project_end_date  as project_end_date');
        if (!empty($project_id)) {
            $this->db->where('project_detail.id', $project_id);
        }
       
        //$this->db->where('project_detail.status', 'Y');
        $this->db->join('tender_details as td', 'td.project_id = project_detail.id', 'LEFT');
        $query = $this->db->get('project_detail');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    function get_project_single_data($project_id){
        $this -> db -> select('t1.project_name,t1.project_code,t1.id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type as project_type_name,t3.name as area_name,t4.name as sector_name,t5.project_start_date,t5.project_end_date');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.project_area ', 'left');
        $this->db->join('sector_master as t4', 't1.project_sector = t4.id', 'LEFT');
        $this->db->join('project_aggrement_stage as t5', 't1.id = t5.project_id', 'LEFT');
        $this -> db -> where('t1.id', $project_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        return $query->result_array();
    }

    public function get_all_vendors(){
        $this->db->select('*');
        $this->db->from('vendor_master');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();

    }
    public function get_invoice_account_head( $invoice_id ){
        $this->db->distinct();
        $this->db->select('major_head_id');
        $this->db->from('project_invoice_details');
        $this->db->where('invoice_id', $invoice_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_all_head( ){
        $this->db->select('*');
        $query = $this->db->get('account_head_master');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function  add( $table_name,$data){
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }
    public function update($table_name,$data,$p_key){

        $this->db->where('id', trim($p_key));
        return $this->db->update($table_name, $data);
    }
    public function clean_up_old_details( $invoice_id ){

        if ($invoice_id > 0) {
            $query = $this->db->query("DELETE FROM project_invoice_details WHERE invoice_id = '" . $invoice_id . "'");
        }
    }
    public function check_payment_histroy( $invoice_id ){
        $this->db->select('COUNT(id) AS total_history_count');
        $this->db->where('project_invoice_payment_history.invoice_id', $invoice_id);
        $query = $this->db->get('project_invoice_payment_history');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_invoice_list( $project_id ){

        $this->db->select('*');
        $this->db->where('project_invoice.project_id', $project_id);
        $query = $this->db->get('project_invoice');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_total_amount( $invoice_id = 0 , $head_id = 0 ){
        $this->db->select('SUM(amount) AS total_amount');
        $this->db->where('project_invoice_details.invoice_id', $invoice_id);
        if( $head_id > 0 ){
            $this->db->where('project_invoice_details.major_head_id', $head_id);

        }
        $query = $this->db->get('project_invoice_details');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_total_paid_amount_invoice( $invoice_id = 0 ){

        $this->db->select('SUM(paid_amount) AS total_paid_amount');
        $this->db->where('project_invoice_payment_history.invoice_id', $invoice_id);

        $query = $this->db->get('project_invoice_payment_history');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function get_invoice_details( $invoice_id ){
        $this->db->select('*');
        $this->db->where('project_invoice.id', $invoice_id);
        $query = $this->db->get('project_invoice');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_invoice_breakup_details( $invoice_id ){

        $this->db->select('*');
        $this->db->where('project_invoice_details.invoice_id', $invoice_id);
        $query = $this->db->get('project_invoice_details');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_head_details( $head_id){

        $this->db->select('*');
        $this->db->where('account_head_master.id', $head_id);
        $query = $this->db->get('account_head_master');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_due_amount( $head_id , $invoice_id){
        $this->db->select('*');
        $this->db->where('project_invoice_payment_history.major_head_id', $head_id);
        $this->db->where('project_invoice_payment_history.invoice_id', $invoice_id);
        $this->db->order_by('project_invoice_payment_history.id', 'DESC');
        $query = $this->db->get('project_invoice_payment_history');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function checkPayment( $head_id, $invoice_id ){
        $this->db->select('count(id) as totalRow');
        $this->db->where('project_invoice_payment_history.major_head_id', $head_id);
        $this->db->where('project_invoice_payment_history.invoice_id', $invoice_id);
        $query = $this->db->get('project_invoice_payment_history');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function get_amount( $head_id, $invoice_id ){

        $this->db->select('SUM(amount) AS total_amount');
        $this->db->where('project_invoice_details.invoice_id', $invoice_id);
        $query = $this->db->get('project_invoice_details');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_payment_histoy( $invoice_id ){
        $this->db->select('*');
        $this->db->where('project_invoice_payment_history.invoice_id', $invoice_id);
        $this->db->order_by('project_invoice_payment_history.payment_date', 'DESC');
        $query = $this->db->get('project_invoice_payment_history');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

}