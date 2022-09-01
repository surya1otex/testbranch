<?php

class Procurement_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getOrganizationId($user_id)
    {
        $user_id = (int)$user_id;
        $user_type = $this->get_user_type($user_id);
        $this->db->select("*");
       if ( $user_type == 3 ){
            $this->db->from('organization_user_details');
        }
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo "<pre>"; print_r($result);
        if( $user_type == 3){
            //echo " i m ehre";
            return $result[0]['organization_id'];
        }else{
            return  false;
        }
    }
    public function get_user_type($user_id){
        $this->db->select('user_type');
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['user_type'];
    }

    public function getProjectSector()
    {
        $this->db->select('*');
        $this->db->from('sector_master');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getProjectDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_detail');
        $this->db->where('id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    public function getProjectGroup()
    {
        $this->db->select('*');
        $this->db->from('group_master');
        $query = $this->db->get();
        return $query->result_array();
    }
    /*public function addPreTender( $data ){

        $insert = $this->db->insert('project_detail', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        }else{
            return false;
        }
    }*/
    public function addTender( $data ){
        unset($data['token']);
        $insert = $this->db->insert('tender_details', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        }else{
            return false;
        }
    }
    public function getNumericProjectID ($encrpt_project_id){

        $this->db->select('id');
        $this->db->from('project_detail');
        $this->db->where('md5(id)', $encrpt_project_id);
        $query = $this->db->get();
        $return = $query->result_array();

        return $return[0]['id'];
    }
    /*public function updatePreTender($data){

        $project_id = $data['project_id'];
        unset($data['project_id']);
        $this->db->where('id', $project_id);
        return $this->db->update('project_detail', $data);
    }*/
    public function updateTender($data){
        $tender_id = $data['tender_id'];
        unset($data['tender_id']);
        unset($data['token']);
        $this->db->where('id', $tender_id);
        return $this->db->update('tender_details', $data);
    }
    //move to project model
    public function getTenderDetails( $project_id ){
        $this->db->select('*');
        $this->db->from('tender_details');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getGroupName( $grp_id ){
        $this->db->select('name');
        $this->db->from('group_master');
        $this->db->where('id', $grp_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }
    public function getProjectTypeName( $p_type_id ){
        $this->db->select('project_type');
        $this->db->from('project_type_master');
        $this->db->where('id', $p_type_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['project_type'];
    }
    public function getDestinationName( $destination_id ){
        $this->db->select('name');
        $this->db->from('destination_master');
        $this->db->where('id', $destination_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }
    public function getAreaName( $area_id ){
        $this->db->select('name');
        $this->db->from('area_master');
        $this->db->where('id', $area_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }

    public function getSectorName( $sec_id ){
        $this->db->select('name');
        $this->db->from('sector_master');
        $this->db->where('id', $sec_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }
    public  function getAllProjects( $user_id ){

        $this->db->select('*');
        $this->db->from('project_detail');
        $this->db->where('project_creator_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function checkFieldStatus($fields, $project_id, $table = 'project_detail')
    {

        if ($fields == '*') {
            $this->db->select("*");
        } else {
            $this->db->select(implode(",", $fields));
        }

        $this->db->from($table);
        if ($table == 'tender_details') {
            $this->db->where('project_id', $project_id);
        } else {
            $this->db->where('id', $project_id);
        }

        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function addFinalRemarks($data)
    {   //echo "<pre>"; print_r($data); die;
        $project_id = $data['project_id'];
        unset($data['project_id']);
        $this->db->where('id', $project_id);
        $this->db->update('project_detail', $data);

        $this->db->where('project_id', $project_id);
        return $this->db->update('tender_details', array('status' => 'Y'));

    }

    public function getExtraRemarks($project_id)
    {

        $this->db->select('extra_remarks');
        $this->db->from('project_detail');
        $this->db->where('id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['extra_remarks'];
    }

    public function getAllArea()
    {

        $this->db->select('*');
        $this->db->from('area_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    public function getAllProjectType()
    {

        $this->db->select('*');
        $this->db->from('project_type_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    public function getDestinationByArea($area_id)
    {

        $this->db->select('*');
        $this->db->from('destination_master');
        $this->db->where('area_id', $area_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    public function getAllUserType()
    {
        $this->db->select('*');
        $this->db->from('user_designation_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    public function getAllUserName()
    {

        $this->db->select('u.*,um.id as uid,um.firstname as firstname, um.lastname as lastname');
        $this->db->from('user as u');

       
        $this->db->join('organization_user_details as um', 'um.user_id = u.id', 'LEFT');
        $this->db->order_by('um.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProjectUsers( $project_id ){

        $this->db->select('user_id,designation_id');
        $this->db->from('project_user');
        $this->db->where('project_id', $project_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }
}

?>