<?php

class Master_model extends CI_Model {
	
	  function __construct(){
        parent :: __construct();
        $this->load->database();
	  }

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
          $query = $this->db->query('SELECT * FROM '.$table.' WHERE 1 = 1');
          return $query->num_rows();
      }
      public function getDetails( $id, $data = [] ){

          $this->db->select('*');
          $this->db->from($data['table']);
          $this->db->where('md5(id)', $id);
          $query = $this->db->get();
          return $query->result_array();
      }

}
?>