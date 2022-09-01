<?php

class Master_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

    /*INSERT data to table*/
    public function add($table,$data){
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }
    /*#END INSERT data to table*/

    public function getProjectCircle(){

      $this->db->select('*');
      $this->db->from('wing_master');
      $this->db->where('status', 'Y');
      $query = $this->db->get();
      return $query->result_array();
      }

    /*For Any UPDATE Query*/ 
    public function updateData($tableName, $data, $where){
      $this->db->where($where);
      $this->db->update($tableName, $data);
      //echo $this->db->last_query().'<br><br>';
      return TRUE;
    }
    /*#END For Any UPDATE Query End*/

    /*DELETE for all*/ 
    public function deleteRecord($tableName,$deleteClause){
      $this->db->delete($tableName, $deleteClause); 
    }
    /*#END DELETE for all End*/

    /*Get WI Type master list*/
    public function get_work_item_type_master_details(){
      $this->db->select('work_item_type_master.*');
      $this->db->where('work_item_type_master.status', 'Y');
      $query = $this->db->get('work_item_type_master');
      return $query->result_array();
    }
    /*#END Get WI Type master list*/

    /*Get WI master list*/
    public function get_work_item_details($work_item_id=null){
      $this->db->select('wim.*, witm.type_name');
      $this->db->from('work_item_master as wim');
      if(!empty($work_item_id)){
        $this->db->where('wim.id', $work_item_id);  
      }
      //$this->db->where('wim.status', 'Y');
      $this->db->join('work_item_type_master as witm', 'wim.type_id = witm.id', 'LEFT');
      $this->db->order_by('wim.id', 'DESC');
      $query = $this->db->get();
       // echo $this->db->last_query(); die;
      return $query->result_array();
    }
    /*#END Get WI master list*/

    public function get_vendor_details($vendor_id){

        $this->db->select('*');
        $this->db->where('vendor_master.id', $vendor_id);
        $query = $this->db->get('vendor_master');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_account_head_details($head_id){

        $this->db->select('*');
        $this->db->where('account_head_master.id', $head_id);
        $query = $this->db->get('account_head_master');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_account_head_master_list(){

        $this->db->select('*');
		$query = $this->db->get('account_head_master');

        //echo $this->db->last_query(); die;
        return $query->result_array();
    }


    /* Work Item Financial Dependencies Check */
    public function workItemFinancialDependencyCheck($work_item_id){ 
      $this->db->where('project_work_item_id', $work_item_id);
      $this->db->from('project_financial_planning_main');
      //$this->db->count_all_results(); // Produces an integer, like 17
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END Work Item Financial Dependencies Check */

    /* Work Item Physical Dependencies Check */
    public function workItemPhysicalDependencyCheck($work_item_id){ 
      $this->db->where('project_work_item_id', $work_item_id);
      $this->db->from('project_physical_planning_main');
      //$this->db->count_all_results(); // Produces an integer, like 17
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END Work Item Physical Dependencies Check */


    /*Get supervisor list*/
    public function get_supervisor_details($supervisor_id=null){
      $this->db->select('designing_supervisor_master.*');
      $this->db->from('designing_supervisor_master ');
      if(!empty($work_item_id)){
        $this->db->where('designing_supervisor_master.id', $supervisor_id);  
      }
      $this->db->order_by('designing_supervisor_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get WI master list*/


    /* Supervisor Dependencies Check */
    public function supervisorDependencyCheck($supervisor_id){ 
      $this->db->where('project_supervisor', $supervisor_id);
      $this->db->from('project_detail');
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END Supervisor Item Physical Dependencies Check */


    /*Get agency list*/
    public function get_agency_details($agency_id=null){
      $this->db->select('agency_master.*');
      $this->db->from('agency_master ');
      if(!empty($agency_id)){
        $this->db->where('agency_master.id', $agency_id);  
      }
      $this->db->order_by('agency_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get agency list*/


    /* agency Dependencies Check */
    public function agencyDependencyCheck($agency_id){ 
      $this->db->where('project_implementing_agency', $agency_id);
      $this->db->from('project_detail');
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END agency Dependencies Check */


    /*Get NGO list*/
    public function get_ngo_details($ngo_id=null){
      $this->db->select('ngo_master.*');
      $this->db->from('ngo_master');
      if(!empty($ngo_id)){
        $this->db->where('ngo_master.id', $ngo_id);  
      }
      $this->db->order_by('ngo_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get NGO list*/


    /* NGO Dependencies Check */
    public function ngoDependencyCheck($ngo_id){ 
      $this->db->where('project_ngo', $ngo_id);
      $this->db->from('project_detail');
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END NGO Dependencies Check */


    /*Get TSU list*/
    public function get_tsu_details($tsu_id=null){
      $this->db->select('tsu_master.*');
      $this->db->from('tsu_master');
      if(!empty($tsu_id)){
        $this->db->where('tsu_master.id', $tsu_id);  
      }
      $this->db->order_by('tsu_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get TSU list*/


    /* TSU Dependencies Check */
    public function tsuDependencyCheck($tsu_id){ 
      $this->db->where('project_ngo', $tsu_id);
      $this->db->from('project_detail');
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END TSU Dependencies Check */

    /*Get Unit list*/
    public function get_unit_details($unit_id=null){
      $this->db->select('unit_master.*');
      $this->db->from('unit_master');
      if(!empty($unit_id)){
        $this->db->where('unit_master.id', $unit_id);  
      }
      $this->db->order_by('unit_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }

    /*#END Get unit list*/
    public function get_sector_details($unit_id=null){
        $this->db->select('sector_master.*');
        $this->db->from('sector_master');
        if(!empty($unit_id)){
            $this->db->where('sector_master.id', $unit_id);
        }
        $this->db->order_by('sector_master.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_group_details($unit_id=null){
        $this->db->select('group_master.*');
        $this->db->from('group_master');
        if(!empty($unit_id)){
            $this->db->where('group_master.id', $unit_id);
        }
        $this->db->order_by('group_master.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }


    /* Unit Dependencies Check */
    public function unitDependencyCheck($unit_id){ 
      $this->db->where('activity_quantity_unit_id', $unit_id);
      $this->db->from('project_physical_planning_main');
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END Unit Dependencies Check */

    /*Get area list*/
    public function get_area_details($area_id=null){

      $this->db->select('area_master.*');
      $this->db->from('area_master');
      if(!empty($area_id)){
        $this->db->where('area_master.id', $area_id);
      }
      $this->db->order_by('area_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get area list*/

    public function get_project_type_details($project_type_id=null){

        $this->db->select('project_type_master.*');
        $this->db->from('project_type_master');
        if(!empty($project_type_id)){
            $this->db->where('project_type_master.id', $project_type_id);
        }
        $this->db->order_by('project_type_master.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /* area Dependencies Check */
    public function areaDependencyCheck($area_id){ 
      $this->db->where('project_area', $area_id);
      $this->db->from('project_detail');
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END area Dependencies Check */

    /*Get destination list*/
    public function get_destination_details($destination_id=null){

      $this->db->select('dm.*, am.name as area_name');
      $this->db->from('destination_master as dm');
      if(!empty($destination_id)){
        $this->db->where('dm.id', $destination_id);  
      }
      $this->db->join('area_master as am', 'dm.area_id = am.id', 'LEFT');
      $this->db->order_by('dm.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get destination list*/

    /* Destination Dependencies Check */
    public function destinationDependencyCheck($destination_id){ 
      $this->db->where('project_destination', $destination_id);
      $this->db->from('project_detail');
      if($this->db->count_all_results()>0){
        return false; // Has dependencies
      }else{
        return true; // No dependencies
      }
    }
    /* #END Destination Dependencies Check */

    public function checkDuplicate($table_name, $field , $value )
    {  // echo "<pre>"; $table_name; print_r($value); die;

        $str = '';
        foreach ($value as $key =>$val){
            $str .= "AND ".$key." = "."'$val'";
        }

        $query = $this->db->query('SELECT * FROM '.$table_name.' WHERE 1 '.$str );

        return $query->num_rows();
    }
    public function insertData( $data, $table_name ){
        if($table_name == 'user_type_master'){
            $data['type'] = $data['name'];
            unset($data['name']);
        }
        if (!empty($data)) {
            $insert = $this->db->insert($table_name, $data);
            if ($insert) {
                $insert_id = $this->db->insert_id();
                return $insert_id > 0 ? $insert_id : false;
            }
            return false;
        }
        return false;

    }

    public function  updatetData($data,$table){
        $id = $data['id'];
        unset($data['id']);
        $this->db->where('md5(id)', trim($id));
        return $this->db->update($table, $data);
    }
    public function getMasterList($table_name,$limit,$start){
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from($table_name);
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getTotalCount($table)
    {
        $query = $this->db->query('SELECT * FROM '.$table.' WHERE 1=1');
        return $query->num_rows();
    }
    public function getDetails( $id, $data = [] ){

        $this->db->select('*');
        $this->db->from($data['table']);
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getSector( $sector_id ){
        $this->db->select('*');
        $this->db->from('sector_master');
        $this->db->where('id', $sector_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function  getAllSectors(){
        $this->db->select('*');
        $this->db->from('sector_master');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function  getAllGroups(){
        $this->db->select('*');
        $this->db->from('group_master');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_source_fund_details( $sss_id ){
        $this->db->select('*');
        $this->db->from('source_of_fund_master');
        $this->db->where('id', $sss_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function  getAllSourceFund(){
        $this->db->select('*');
        $this->db->from('source_of_fund_master');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function  getAllUsertype(){
        $this->db->select('*');
        $this->db->from('user_designation_master');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_user_type_details( $sss_id ){
        $this->db->select('*');
        $this->db->from('user_designation_master');
        $this->db->where('id', $sss_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    /*Get destination list*/
    public function get_user_details($user_id=null){

        $this->db->select('um.*, um.id as user_id , u.*');
        $this->db->from('user as u');
        if(!empty($user_id)){
            $this->db->where('um.id', $user_id);
        }
        $this->db->join('user_master as um', 'um.user_id = u.id', 'LEFT');
        $this->db->order_by('um.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	 /*Get work item type list org wise*/
    public function  getAllWork_item_type(){
        $this->db->select('*');
        $this->db->from('work_item_type_master');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function  get_vendor_master_list(){
        $this->db->select('*');
        $this->db->from('vendor_master');
        $query = $this->db->get();
        return $query->result_array();
    }

	/*#END Get work item type DETAILS*/
    public function get_Workitemtype_details($unit_id=null){
        $this->db->select('work_item_type_master.*');
        $this->db->from('work_item_type_master');
        if(!empty($unit_id)){
            $this->db->where('work_item_type_master.id', $unit_id);
        }
        $this->db->order_by('work_item_type_master.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

	 /*Get ACTIVE work item type Type master list*/
    public function get_workitemtype_master_list(){
      $this->db->select('work_item_type_master.*');
      $this->db->where('work_item_type_master.status', 'Y');
	  $query = $this->db->get('work_item_type_master');
      return $query->result_array();
    }
    /*#END Get WI Type master list*/

    /* for model function user access*/

    public function get_user_access_data($user_id){
        $this->db->select('*');
        $this->db->from('module_master');
         $this->db->where('parent_relation_id', 6);
         //$this->db->where('t2.menu_display', 'Y');
         $this->db->where('status','Y');
         $this->db->order_by('display_order','ASC');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
    
    public function get_organization_access_count_data($table_name){
      $this->db->where('status', 'Y');
      $query=$this->db->get($table_name);
      $num_rows = $query->num_rows();
      return $num_rows;
    }
	
	 /*Get area list*/
    public function get_district_details($district_id=null){

      $this->db->select('district_master.*');
      $this->db->from('district_master');
      if(!empty($district_id)){
        $this->db->where('district_master.id', $district_id);
      }
      $this->db->order_by('district_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
	
	 /*Get division list*/
    public function get_division_details($division_id=null){

      $this->db->select('dm.*, am.district_name as district_name');
      $this->db->from('division_master as dm');
      if(!empty($division_id)){
        $this->db->where('dm.id', $division_id);  
      }
      $this->db->join('district_master as am', 'dm.district_id = am.id', 'LEFT');
      $this->db->order_by('dm.id', 'DESC');
	 // echo  $this->db->last_query(); die();
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get division list*/

   
	 /*Get division list*/
    public function get_tehsil_details($tehsil_id=null){

      $this->db->select('dm.*, am.district_name as district_name');
      $this->db->from('tahsil_master as dm');
      if(!empty($tehsil_id)){
        $this->db->where('dm.id', $tehsil_id);  
      }
      $this->db->join('district_master as am', 'dm.district_id = am.id', 'LEFT');
      $this->db->order_by('dm.id', 'DESC');
	 // echo  $this->db->last_query(); die();
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get division list*/
	
		
function get_division_all($district_id){
		
	$query = $this->db->query("Select esm.*,ecm.id as distId,ecm.district_name
			 from division_master esm
			 left join district_master ecm on ecm.id=esm.district_id
			 where esm.district_id='".$district_id."' order by esm.division_name ");
		 //echo  $this->db->last_query(); die();
				return $query->result(); 
		
}	

function get_tehsil_all($district_id){
		
	$query = $this->db->query("Select esm.*,ecm.id as distId,ecm.district_name
			 from tahsil_master esm
			 left join district_master ecm on ecm.id=esm.district_id
			 where esm.district_id='".$district_id."' order by esm.tahsil_name ");
		 //echo  $this->db->last_query(); die();
				return $query->result(); 
		
}

  public function get_block_details($tehsil_id=null){

      $this->db->select('dm.*, am.district_name as district_name');
      $this->db->from('block_master as dm');
      if(!empty($tehsil_id)){
        $this->db->where('dm.id', $tehsil_id);  
      }
      $this->db->join('district_master as am', 'dm.district_id = am.id', 'LEFT');
      $this->db->order_by('dm.id', 'DESC');
	 // echo  $this->db->last_query(); die();
      $query = $this->db->get();
      return $query->result_array();
    }
	
  public function get_village_details($tehsil_id=null){

      $this->db->select('dm.*, am.district_name as district_name');
      $this->db->from('village_master as dm');
      if(!empty($tehsil_id)){
        $this->db->where('dm.id', $tehsil_id);  
      }
      $this->db->join('district_master as am', 'dm.district_id = am.id', 'LEFT');
      $this->db->order_by('dm.id', 'DESC');
	 // echo  $this->db->last_query(); die();
      $query = $this->db->get();
      return $query->result_array();
    }
    public function get_ulb_details($ulb_id=null){

      $this->db->select('dm.*, am.district_name as district_name');
      $this->db->from('ulb_master as dm');
      if(!empty($ulb_id)){
        $this->db->where('dm.id', $ulb_id);  
      }
      $this->db->join('district_master as am', 'dm.district_id = am.id', 'LEFT');
      $this->db->order_by('dm.id', 'DESC');
	 // echo  $this->db->last_query(); die();
      $query = $this->db->get();
      return $query->result_array();
    }
	
	    public function get_wing_details($wing_id=null){

      $this->db->select('wing_master.*');
      $this->db->from('wing_master');
      if(!empty($wing_id)){
        $this->db->where('wing_master.id', $wing_id);
      }
      $this->db->order_by('wing_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
	    public function get_designation_details($designation_id=null){

      $this->db->select('user_designation_master.*');
      $this->db->from('user_designation_master');
      if(!empty($designation_id)){
        $this->db->where('user_designation_master.id', $designation_id);
      }
      $this->db->order_by('user_designation_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
	    public function get_encroachment_details($encroachment_id=null){

      $this->db->select('encroachment_master.*');
      $this->db->from('encroachment_master');
      if(!empty($encroachment_id)){
        $this->db->where('encroachment_master.id', $encroachment_id);
      }
      $this->db->order_by('encroachment_master.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
	
	  /*Get destination list*/
    public function get_recipient_details($recipient_id=null){

      $this->db->select('dm.*');
      $this->db->from('recipient_master as dm');
      if(!empty($recipient_id)){
        $this->db->where('dm.id', $recipient_id);  
      }
      $this->db->order_by('dm.id', 'DESC');
      $query = $this->db->get();
      return $query->result_array();
    }
    /*#END Get destination list*/
	
}



?>