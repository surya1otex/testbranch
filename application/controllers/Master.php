<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper(array('url', 'security'));

        $this->load->model('Master_model');
        //$this->load->model('Procurement_model');
        $this->load->model('Organization_model');
        $this->allowedModule = array(1 => true, 3 => false, 6 => false, 2 => false, 5 => false, 7 => false, 4 => false);
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }

    public function work_item($data = NULL)
    {
        /* Getting work item type master list */
        $data['ar_work_item_type_master_details'] = $this->Master_model->get_workitemtype_master_list();
        /* #END Getting work item type master list */

        /* Getting work item master list */
        $data['ar_work_item_details'] = $this->Master_model->get_work_item_details('');
        /* #END Getting work item master list */
        if (!empty($_REQUEST['work_item_id'])) {
            $work_item_id = base64_decode($_REQUEST['work_item_id']);
            $data['work_item_id'] = $work_item_id;
            $data['work_item_detail_edit'] = $this->Master_model->get_work_item_details($work_item_id);
        }
        $this->load->common_template('master/work_item', $data);
    }

    public function account_head($data = NULL)
    {

        /* Getting work item type master list */
        $data['ar_account_head_master_details'] = $this->Master_model->get_account_head_master_list();

        /* #END Getting work item type master list */

        /* Getting work item master list */

        /* #END Getting work item master list */
        if (!empty($_REQUEST['head_id'])) {
            $head_id = base64_decode($_REQUEST['head_id']);
            $data['head_id'] = $head_id;
            $data['head_detail_edit'] = $this->Master_model->get_account_head_details($head_id);
            //echo "<pre>"; print_r($data['vendor_detail_edit']);
        }
        $this->load->common_template('master/account', $data);
    }
    public function vendor($data = NULL)
    {

        /* Getting work item type master list */
        $data['ar_vendor_master_details'] = $this->Master_model->get_vendor_master_list();

        /* #END Getting work item type master list */

        /* Getting work item master list */

        /* #END Getting work item master list */
        if (!empty($_REQUEST['vendor_id'])) {
            $vendor_id = base64_decode($_REQUEST['vendor_id']);
            $data['vendor_id'] = $vendor_id;
            $data['vendor_detail_edit'] = $this->Master_model->get_vendor_details($vendor_id);
            //echo "<pre>"; print_r($data['vendor_detail_edit']);
        }
        $this->load->common_template('master/vendor', $data);
    }

    /* Add/Update Vendor */
    public function add_account_head()
    {
        if (!empty($_REQUEST['submit'])) {

            $head_master = array();
            $head_master['major_head '] = $_REQUEST['title'];
            $head_master['status'] = $_REQUEST['status'];

            if (empty($_REQUEST['head_id'])) {
                $this->Master_model->add('account_head_master', $head_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');

            } else {

                $where = array('id' => base64_decode($_REQUEST['head_id']));
                $this->Master_model->updateData('account_head_master', $head_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }

            redirect('Master/account_head');
        }
    }
    /* Add/Update Vendor */
    public function add_vendor()
    {
        if (!empty($_REQUEST['submit'])) {

            $vendor_master = array();
            $vendor_master['vendor '] = $_REQUEST['title'];
            $vendor_master['status'] = $_REQUEST['status'];

            if (empty($_REQUEST['vendor_id'])) {
                $this->Master_model->add('vendor_master', $vendor_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');

            } else {

                $where = array('id' => base64_decode($_REQUEST['vendor_id']));
                $this->Master_model->updateData('vendor_master', $vendor_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }

            redirect('Master/vendor');
        }
    }

    /* Add/Update Work Items */
    public function add_work_item()
    {
        if (!empty($_REQUEST['submit'])) {

            $work_item_master = array();
            $work_item_master['work_item_description'] = $_REQUEST['title'];
            $work_item_master['created_by'] = $this->session->userdata('id');
            $work_item_master['created_on'] = Date('Y-m-d');
            $work_item_master['modified_by'] = $this->session->userdata('id');
            $work_item_master['type_id'] = $_REQUEST['workItemTypeId'];
            $work_item_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['work_item_id'])) {

                $this->Master_model->add('work_item_master', $work_item_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['work_item_id']));
                $this->Master_model->updateData('work_item_master', $work_item_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }

            redirect('Master/work_item');
        }
    }
    /* #END Add/Update Work Items */

    /* Work Item Delete*/
    public function delete_work_item()
    {
        $work_item_id = base64_decode($_REQUEST['work_item_id']);
        $deleteClause = array('id' => $work_item_id);
        $workItemDependenciesFlag = true;
        // Check whether this WI id has any dependencies or not
        if (!$this->Master_model->workItemFinancialDependencyCheck($work_item_id)) {
            $workItemDependenciesFlag = false;
        }
        if (!$this->Master_model->workItemPhysicalDependencyCheck($work_item_id)) {
            $workItemDependenciesFlag = false;
        }
        if ($workItemDependenciesFlag) {
            $this->Master_model->deleteRecord('work_item_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/work_item');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/work_item');
        }


    }
    /* #END Work Item Delete*/
    public function delete_vendor()
    {
        $vendor_id = base64_decode($_REQUEST['vendor_id']);
        $deleteClause = array('id' => $vendor_id);
        $this->Master_model->deleteRecord('vendor_master', $deleteClause);
        $this->session->set_flashdata('message', 'Data deleted Successfully');
        redirect('Master/vendor');

        $vendorDependenciesFlag = true;
        // Check whether this WI id has any dependencies or not
        /*if (!$this->Master_model->workItemFinancialDependencyCheck($work_item_id)) {
            $workItemDependenciesFlag = false;
        }
        if (!$this->Master_model->workItemPhysicalDependencyCheck($work_item_id)) {
            $workItemDependenciesFlag = false;
        }
        if ($workItemDependenciesFlag) {

        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/work_item');
        }*/

    }
    public function delete_head(){

        $head_id = base64_decode($_REQUEST['head_id']);
        $deleteClause = array('id' => $head_id);
        $this->Master_model->deleteRecord('account_head_master', $deleteClause);
        $this->session->set_flashdata('message', 'Data deleted Successfully');
        redirect('Master/account_head');
    }

    /* Supervisor List */
    public function supervisor($data = NULL)
    {
        /* Getting supervisor master list //designing_supervisor_master */
        $data['ar_supervisor_details'] = $this->Master_model->get_supervisor_details();
        /* #END Getting work item master list */
        if (!empty($_REQUEST['supervisor_id'])) {
            $supervisor_id = base64_decode($_REQUEST['supervisor_id']);
            $data['supervisor_id'] = $supervisor_id;
            $data['supervisor_detail_edit'] = $this->Master_model->get_supervisor_details($supervisor_id);
        }
        $this->load->common_template('master/supervisor', $data);
    }
    /* #END Supervisor List */

    /* Add/Update supervisor */
    public function add_supervisor()
    {
        if (!empty($_REQUEST['submit'])) {
            //echo "<pre>"; print_r($_REQUEST); //die();
            $supervisor_master = array();
            $supervisor_master['name'] = $_REQUEST['supervisor_name'];

            $supervisor_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['supervisor_id'])) {

                $this->Master_model->add('designing_supervisor_master', $supervisor_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['supervisor_id']));
                $this->Master_model->updateData('designing_supervisor_master', $supervisor_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/supervisor');
        }
    }
    /* #END Add/Update supervisor */

    /* supervisor Delete*/
    public function delete_supervisor()
    {
        $supervisor_id = base64_decode($_REQUEST['supervisor_id']);
        $deleteClause = array('id' => $supervisor_id);
        $supervisorDependenciesFlag = true;
        // Check whether this supervisor id has any dependencies or not
        if (!$this->Master_model->supervisorDependencyCheck($supervisor_id)) {
            $supervisorDependenciesFlag = false;
        }
        if ($supervisorDependenciesFlag) {
            $this->Master_model->deleteRecord('designing_supervisor_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/supervisor');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/supervisor');
        }


    }
    /* #END Work Item Delete*/


    /* Agency List */
    public function agency($data = NULL)
    {
        /* Getting agency master list //agency_master */
        $data['ar_agency_details'] = $this->Master_model->get_agency_details();
        /* #END Getting agency master list */
        if (!empty($_REQUEST['agency_id'])) {
            $agency_id = base64_decode($_REQUEST['agency_id']);
            $data['agency_id'] = $supervisor_id;
            $data['agency_detail_edit'] = $this->Master_model->get_agency_details($agency_id);
        }
        $this->load->common_template('master/agency', $data);
    }
    /* #END agency List */

    /* Add/Update agency */
    public function add_agency()
    {
        if (!empty($_REQUEST['submit'])) {
            $agency_master = array();
            $agency_master['name'] = $_REQUEST['agency_name'];
            $agency_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['agency_id'])) {

                $this->Master_model->add('agency_master', $agency_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['agency_id']));
                $this->Master_model->updateData('agency_master', $agency_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/agency');
        }
    }
    /* #END Add/Update agency */

    /* Agency Delete*/
    public function delete_agency()
    {
        $agency_id = base64_decode($_REQUEST['agency_id']);
        $deleteClause = array('id' => $agency_id);
        $agencyDependenciesFlag = true;
        // Check whether this agency id has any dependencies or not
        if (!$this->Master_model->agencyDependencyCheck($agency_id)) {
            $agencyDependenciesFlag = false;
        }
        if ($agencyDependenciesFlag) {
            $this->Master_model->deleteRecord('agency_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/agency');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/agency');
        }
    }
    /* #END agency Delete*/


    /* NGO List */
    public function ngo($data = NULL)
    {
        /* Getting ngo master list //ngo_master */
        $data['ar_ngo_details'] = $this->Master_model->get_ngo_details();
        /* #END Getting ngo master list */
        if (!empty($_REQUEST['ngo_id'])) {
            $ngo_id = base64_decode($_REQUEST['ngo_id']);
            $data['ngo_id'] = $ngo_id;
            $data['ngo_detail_edit'] = $this->Master_model->get_ngo_details($ngo_id);
        }
        $this->load->common_template('master/ngo', $data);
    }
    /* #END NGO List */

    /* Add/Update NGO */
    public function add_ngo()
    {
        if (!empty($_REQUEST['submit'])) {
            $ngo_master = array();
            $ngo_master['name'] = $_REQUEST['ngo_name'];
            $ngo_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['ngo_id'])) {

                $this->Master_model->add('ngo_master', $ngo_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['ngo_id']));
                $this->Master_model->updateData('ngo_master', $ngo_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/ngo');
        }
    }
    /* #END Add/Update NGO */

    /* NGO Delete*/
    public function delete_ngo()
    {
        $ngo_id = base64_decode($_REQUEST['ngo_id']);
        $deleteClause = array('id' => $ngo_id);
        $ngoDependenciesFlag = true;
        // Check whether this ngo id has any dependencies or not
        if (!$this->Master_model->ngoDependencyCheck($ngo_id)) {
            $ngoDependenciesFlag = false;
        }
        if ($ngoDependenciesFlag) {
            $this->Master_model->deleteRecord('ngo_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/ngo');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/ngo');
        }
    }
    /* #END NGO Delete*/


    /* TSU List */
    public function tsu($data = NULL)
    {
        /* Getting tsu master list //tsu_master */
        $data['ar_tsu_details'] = $this->Master_model->get_tsu_details();
        /* #END Getting ngo master list */
        if (!empty($_REQUEST['tsu_id'])) {
            $tsu_id = base64_decode($_REQUEST['tsu_id']);
            $data['tsu_id'] = $tsu_id;
            $data['tsu_detail_edit'] = $this->Master_model->get_tsu_details($tsu_id);
        }
        $this->load->common_template('master/tsu', $data);
    }
    /* #END TSU List */

    /* Add/Update TSU */
    public function add_tsu()
    {
        if (!empty($_REQUEST['submit'])) {
            $tsu_master = array();
            $tsu_master['name'] = $_REQUEST['tsu_name'];
            $tsu_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['tsu_id'])) {

                $this->Master_model->add('tsu_master', $tsu_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['tsu_id']));
                $this->Master_model->updateData('tsu_master', $tsu_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/tsu');
        }
    }
    /* #END Add/Update TSU */

    /* TSU Delete*/
    public function delete_tsu()
    {
        $tsu_id = base64_decode($_REQUEST['tsu_id']);
        $deleteClause = array('id' => $tsu_id);
        $tsuDependenciesFlag = true;
        // Check whether this tsu id has any dependencies or not
        if (!$this->Master_model->tsuDependencyCheck($tsu_id)) {
            $tsuDependenciesFlag = false;
        }
        if ($tsuDependenciesFlag) {
            $this->Master_model->deleteRecord('tsu_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/tsu');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/tsu');
        }
    }
    /* #END TSU Delete*/

    /* Unit List */
    public function unit($data = NULL)
    {
        /* Getting unit master list //unit_master */
        $data['ar_unit_details'] = $this->Master_model->get_unit_details();
        /* #END Getting unit master list */
        if (!empty($_REQUEST['unit_id'])) {
            $unit_id = base64_decode($_REQUEST['unit_id']);
            $data['unit_id'] = $unit_id;
            $data['unit_detail_edit'] = $this->Master_model->get_unit_details($unit_id);
        }
        $this->load->common_template('master/unit', $data);
    }
    /* #END Unit List */

    /* Add/Update Unit */
    public function add_unit()
    {
        if (!empty($_REQUEST['submit'])) {
            $unit_master = array();
            $unit_master['unit_name'] = $_REQUEST['unit_name'];
            $unit_master['status'] = $_REQUEST['status'];
            $unit_master['created_by'] = $this->session->userdata('id');
            if (empty($_REQUEST['unit_id'])) {

                $this->Master_model->add('unit_master', $unit_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['unit_id']));
                $this->Master_model->updateData('unit_master', $unit_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/unit');
        }
    }
    /* #END Add/Update Unit */

    /* Unit Delete*/
    public function delete_unit()
    {
        $unit_id = base64_decode($_REQUEST['unit_id']);
        $deleteClause = array('id' => $unit_id);
        $unitDependenciesFlag = true;
        // Check whether this unit id has any dependencies or not
        if (!$this->Master_model->unitDependencyCheck($unit_id)) {
            $unitDependenciesFlag = false;
        }
        if ($unitDependenciesFlag) {
            $this->Master_model->deleteRecord('unit_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/unit');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/unit');
        }
    }
    /* #END Unit Delete*/

    /* Area List */
    public function area($data = NULL)
    {        
	$data['ar_area_details'] = $this->Master_model->get_area_details('');

        /* #END Getting ngo master list */
        if (!empty($_REQUEST['area_id'])) {
            $area_id = base64_decode($_REQUEST['area_id']);
            $data['area_id'] = $area_id;
            $data['area_detail_edit'] = $this->Master_model->get_area_details($area_id);
        }
        $this->load->common_template('master/area', $data);

    }
    /* #END Area List */

    /* Add/Update area */
    public function add_area()
    {
        if (!empty($_REQUEST['submit'])) {
            $area_master = array();
            $area_master['name'] = $_REQUEST['area_name'];
            $area_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['area_id'])) {
                $this->Master_model->add('area_master', $area_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('id' => base64_decode($_REQUEST['area_id']));
                $this->Master_model->updateData('area_master', $area_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/area');
        }
    }
    /* #END Add/Update Area */

    /* Area Delete*/
    public function delete_area()
    {
        $area_id = base64_decode($_REQUEST['area_id']);
        $deleteClause = array('id' => $area_id);
        $areaDependenciesFlag = true;
        // Check whether this area id has any dependencies or not
        if (!$this->Master_model->areaDependencyCheck($area_id)) {
            $areaDependenciesFlag = false;
        }
        if ($areaDependenciesFlag) {
            $this->Master_model->deleteRecord('area_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/area');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/area');
        }
    }
    /* #END Area Delete*/

    /* Destination List */
    public function destination($data = NULL)
    {
        $data['ar_area_details'] = $this->Master_model->get_area_details('');
        /* #END Getting work item type master list */

        /* Getting destination  list */
        $data['ar_destination_details'] = $this->Master_model->get_destination_details('');
        /* #END Getting destination list */
        if (!empty($_REQUEST['destination_id'])) {
            $destination_id = base64_decode($_REQUEST['destination_id']);
            $data['destination_id'] = $destination_id;
            $data['destination_detail_edit'] = $this->Master_model->get_destination_details($destination_id);

        }
        $this->load->common_template('master/destination', $data);
    }
    /* #END Destination List */

    /* Add/Update destination */
    public function add_destination()
    {
        if (!empty($_REQUEST['submit'])) {

            $destination_master = array();
            $destination_master['area_id'] = $_REQUEST['area_id'];
            $destination_master['name'] = $_REQUEST['destination_name'];
            $destination_master['status'] = $_REQUEST['status'];
			
			            if (empty($_REQUEST['destination_id'])) {

                $this->Master_model->add('destination_master', $destination_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['destination_id']));
                $this->Master_model->updateData('destination_master', $destination_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/destination');
        }
    }
    /* #END Add/Update destination */

    /* destination Delete*/
    public function delete_destination()
    {
        $destination_id = base64_decode($_REQUEST['destination_id']);
        $deleteClause = array('id' => $destination_id);
        $destinationDependenciesFlag = true;
        // Check whether this destination id has any dependencies or not
        if (!$this->Master_model->destinationDependencyCheck($destination_id)) {
            $destinationDependenciesFlag = false;
        }
        if ($destinationDependenciesFlag) {
            $this->Master_model->deleteRecord('destination_master', $deleteClause);
            $this->session->set_flashdata('message', 'Data deleted Successfully');
            redirect('Master/destination');
        } else {
            $this->session->set_flashdata('message', "Data can't be deleted due to dependencies!");
            redirect('Master/destination');
        }
    }

    public function Sector()
    {

        /* #END Getting Sector master list */
        if (!empty($_REQUEST['sector_id'])) {
            $sector_id = base64_decode($_REQUEST['sector_id']);

            $data['sector_id'] = $sector_id;
            $data['unit_detail_edit'] = $this->Master_model->get_sector_details($sector_id);
        }

        $data['ar_unit_details'] = $this->Master_model->getAllSectors();
        $this->load->common_template('master/sector_list', $data);
    }

    /* Add/Update Unit */
    public function add_sector()
    {

        if (!empty($_REQUEST['submit'])) {
            $sector_master = array();
            $sector_master['name'] = $_REQUEST['name'];
            $sector_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['sector_id'])) {

                $this->Master_model->add('sector_master', $sector_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['sector_id']));
                $this->Master_model->updateData('sector_master', $sector_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/sector');
        }
    }

    public function group()
    {

        /* #END Getting groupss master list */
        if (!empty($_REQUEST['group_id'])) {
            $group_id = base64_decode($_REQUEST['group_id']);

            $data['group_id'] = $group_id;
            $data['unit_detail_edit'] = $this->Master_model->get_group_details($group_id);

        }
        $data['ar_unit_details'] = $this->Master_model->getAllGroups();
        $this->load->common_template('master/group_list', $data);
    }

    public function add_group()
    {

        if (!empty($_REQUEST['submit'])) {
            $sector_master = array();
            $sector_master['name'] = $_REQUEST['name'];
            $sector_master['status'] = $_REQUEST['status'];
			
			            if (empty($_REQUEST['group_id'])) {

                $this->Master_model->add('group_master', $sector_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['group_id']));
                $this->Master_model->updateData('group_master', $sector_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/group');
        }
    }

    public function source_of_fund()
    {

        /* #END Getting source of fund master list */
        if (!empty($_REQUEST['sfund_id'])) {
            $sfund_id = base64_decode($_REQUEST['sfund_id']);

            $data['sfund_id'] = $sfund_id;
            $data['unit_detail_edit'] = $this->Master_model->get_source_fund_details($sfund_id);
        }
 
        $data['ar_unit_details'] = $this->Master_model->getAllSourceFund();
        $this->load->common_template('master/source_fund_list', $data);
    }

    public function add_source_of_fund()
    {

        if (!empty($_REQUEST['submit'])) {
            $sector_master = array();
            $sector_master['name'] = $_REQUEST['name'];
            $sector_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['sfund_id'])) {

                $this->Master_model->add('source_of_fund_master', $sector_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['sfund_id']));
                $this->Master_model->updateData('source_of_fund_master', $sector_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/source_of_fund');
        }
    }

    public function user_type()
    {

        /* #END Getting user typr master list */
        if (!empty($_REQUEST['user_type_id'])) {
            $usr_type_id = base64_decode($_REQUEST['user_type_id']);

            $data['user_type_id'] = $usr_type_id;
            $data['unit_detail_edit'] = $this->Master_model->get_user_type_details($usr_type_id);

        }

        $data['ar_unit_details'] = $this->Master_model->getAllUsertype();
        $this->load->common_template('master/user_type_list', $data);
    }

    public function add_user_type()
    {
        if (!empty($_REQUEST['submit'])) {
            $sector_master = array();
            $sector_master['designation'] = $_REQUEST['name'];
            $sector_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['user_type_id'])) {

                $this->Master_model->add('user_designation_master', $sector_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['user_type_id']));
                $this->Master_model->updateData('user_designation_master', $sector_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/user_type');
        }
    }

    public function project_type()
    {

        /* #END Getting user typr master list */
        if (!empty($_REQUEST['project_type_id'])) {
            $project_type_id = base64_decode($_REQUEST['project_type_id']);

            $data['project_type_id'] = $project_type_id;
            $data['unit_detail_edit'] = $this->Master_model->get_project_type_details($project_type_id);

        }

        $data['ar_unit_details'] = $this->Master_model->get_project_type_details('');
        $this->load->common_template('master/project_type_list', $data);
    }

    public function add_project_type()
    {
        if (!empty($_REQUEST['submit'])) {
            $project_type_master = array();
            $project_type_master['project_type'] = $_REQUEST['name'];
            $project_type_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['project_type_id'])) {

                $this->Master_model->add('project_type_master', $project_type_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['project_type_id']));
                $this->Master_model->updateData('project_type_master', $project_type_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/project_type');
        }
    }

    public function users()
    {

        /* #END Getting users master list */
        if (!empty($_REQUEST['user_id'])) {
            $user_id = base64_decode($_REQUEST['user_id']);
            $data['user_id'] = $user_id;
            $data['unit_detail_edit'] = $this->Master_model->get_user_details($user_id);
            $data['master_user_id'] = $data['unit_detail_edit'][0]['id'];

        }
        $data['ar_unit_details'] = $this->Master_model->get_user_details('');
        $this->load->common_template('master/users', $data);
    }

    public function add_user()
    {
        if (!empty($_REQUEST['submit'])) {
            $user_master = $user = array();
            $user['firstname'] = $_REQUEST['name'];
            $user['username'] = $_REQUEST['user_name'];
            $user['password'] = md5($_REQUEST['password']);
            $user['user_type'] = 3;
            $user['status'] = $_REQUEST['status'];
            $user['created_by'] = $this->session->userdata('id');

            if (empty($_REQUEST['user_id'])) {
                $created_user_id = $this->Organization_model->addUser($user);
                $this->Organization_model->addPermission($this->allowedModule, $created_user_id);

                $user_master['user_id'] = $created_user_id;
				$user_master['status'] = $_REQUEST['status'];
                $this->Master_model->add('user_master', $user_master);

                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                if (empty($_REQUEST['password'])) {
                    unset($user['password']);
                }
                $user['id'] = base64_decode($_REQUEST['main_user_id']);
                $this->Organization_model->updateUser($user);
                $user_master['status'] = $_REQUEST['status'];
                $where = array('id' => base64_decode($_REQUEST['user_id']));
                $this->Master_model->updateData('user_master', $user_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/users');
        }
    }
	
	 /* View work item type  START*/
	 public function Work_item_type()
    {

        /* # Getting work item type master list */
        if (!empty($_REQUEST['witype_id'])) {
            $witype_id = base64_decode($_REQUEST['witype_id']);

            $data['witype_id'] = $witype_id;
            $data['unit_detail_edit'] = $this->Master_model->get_Workitemtype_details($witype_id);
        }

        $data['ar_witype_details'] = $this->Master_model->getAllWork_item_type();
        $this->load->common_template('master/work_item_type_list', $data);
    }

    /*  Add/Update work item type */
    public function add_work_item_type()
    {

        if (!empty($_REQUEST['submit'])) {
            $witype_master = array();
            $witype_master['type_name'] = $_REQUEST['name'];
            $witype_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['witype_id'])) {

                $this->Master_model->add('work_item_type_master', $witype_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['witype_id']));
                $this->Master_model->updateData('work_item_type_master', $witype_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/Work_item_type');
        }
    }
 	/*  work item type  END*/

    /* for master dashboard */

    public function dashboard(){
		/*echo "<pre>";
					print_r($this->session->userdata);
					echo "</pre>";
					die;*/
        $user_id = $this->session->userdata('id');
        $data['accessData'] = $this->Master_model->get_user_access_data($user_id);

        
        
        $this->load->common_template('master/dashboard', $data);
    }

    /* for mastar dashboard table counter */

    public function get_organization_access_count($table_name){ 
       return $cnt = $this->Master_model->get_organization_access_count_data($table_name);
    }


    
    /* District List */
    public function district($data = NULL)
    {        
	$data['ar_dis_details'] = $this->Master_model->get_district_details('');

        /* #END Getting ngo master list */
        if (!empty($_REQUEST['district_id'])) {
            $district_id = base64_decode($_REQUEST['district_id']);
            $data['district_id'] = $district_id;
            $data['dist_detail_edit'] = $this->Master_model->get_district_details($district_id);
        }
        $this->load->common_template('master/district', $data);

    }
    /* #END District List */

    /* Add/Update District */
    public function add_district()
    {
        if (!empty($_REQUEST['submit'])) {
            $area_master = array();
            $area_master['district_name'] = $_REQUEST['dist_name'];
            $area_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['district_id'])) {
                $this->Master_model->add('district_master', $area_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('id' => base64_decode($_REQUEST['district_id']));
                $this->Master_model->updateData('district_master', $area_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/division');
        }
    }
    /* #END Add/Update District */
	
	   /* division List */
    public function division($data = NULL)
    {
        $data['ar_dist_details'] = $this->Master_model->get_district_details('');
        /* #END Getting work item type master list */

        $data['circles'] = $this->Master_model->getProjectCircle();

        /* Getting destination  list */
        $data['ar_destination_details'] = $this->Master_model->get_division_details('');
        /* #END Getting destination list */
		//echo $_REQUEST['division_id'];
		
        if (!empty($_REQUEST['division_id'])) {
            $division_id = base64_decode($_REQUEST['division_id']);
            $data['division_id'] = $division_id;
            $data['division_detail_edit'] = $this->Master_model->get_division_details($division_id);

        }
        $this->load->common_template('master/division', $data);
    }
    /* #END division List */

    /* Add/Update division */
    public function add_division()
    {
        if (!empty($_REQUEST['submit'])) {

            $destination_master = array();
            $destination_master['district_id'] = $_REQUEST['district_id'];
            $destination_master['division_name'] = $_REQUEST['division_name'];
            $destination_master['circle_id'] = $_REQUEST['circle_id'];
            $destination_master['status'] = $_REQUEST['status'];
			
			 if (empty($_REQUEST['division_id'])) {

                $this->Master_model->add('division_master', $destination_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['division_id']));
                $this->Master_model->updateData('division_master', $destination_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/division');
        }
    }
    /* #END Add/Update division */
	
	   /* tehsil List */
    public function tehsil($data = NULL)
    {
        $data['ar_dist_details'] = $this->Master_model->get_district_details('');
        /* #END Getting work item type master list */

        /* Getting tehsil  list */
        $data['ar_destination_details'] = $this->Master_model->get_tehsil_details('');
        /* #END Getting tehsil list */
		
        if (!empty($_REQUEST['tehsil_id'])) {
            $tehsil_id = base64_decode($_REQUEST['tehsil_id']);
            $data['tehsil_id'] = $tehsil_id;
            $data['tehsil_detail_edit'] = $this->Master_model->get_tehsil_details($tehsil_id);

        }
        $this->load->common_template('master/tahsil', $data);
    }
    /* #END tehsil List */
    /* Add/Update tahsil */
    public function add_tehsil()
    {
        if (!empty($_REQUEST['submit'])) {

            $destination_master = array();
            $destination_master['district_id'] = $_REQUEST['district_id'];
            $destination_master['division_id'] = $_REQUEST['division_id'];
            $destination_master['tahsil_name'] = $_REQUEST['tahsil_name'];
            $destination_master['status'] = $_REQUEST['status'];
			
			            if (empty($_REQUEST['tehsil_id'])) {

                $this->Master_model->add('tahsil_master', $destination_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['tehsil_id']));
                $this->Master_model->updateData('tahsil_master', $destination_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/tehsil');
        }
    }
    /* #END Add/Update tahsil */
public function getdivisionList(){

	$district_id = $this->input->post('district_id');
	
	if($district_id!=''){
		$data['all_div']= $this->Master_model->get_division_all($district_id);
		//print_r($data['all_state']);
			echo json_encode($data);
	}else{
					
	}

}
	   /* block List */
    public function block($data = NULL)
    {
        $data['ar_dist_details'] = $this->Master_model->get_district_details('');
        /* #END Getting work item type master list */

        /* Getting tehsil  list */
        $data['ar_destination_details'] = $this->Master_model->get_block_details('');
        /* #END Getting tehsil list */
		
        if (!empty($_REQUEST['block_id'])) {
            $tehsil_id = base64_decode($_REQUEST['block_id']);
            $data['block_id'] = $tehsil_id;
            $data['block_detail_edit'] = $this->Master_model->get_block_details($tehsil_id);

        }
        $this->load->common_template('master/block', $data);
    }
    /* #END block List */
    /* Add/Update block */
    public function add_block()
    {
        if (!empty($_REQUEST['submit'])) {

            $destination_master = array();
            $destination_master['district_id'] = $_REQUEST['district_id'];
            $destination_master['division_id'] = $_REQUEST['division_id'];
            $destination_master['block_name'] = $_REQUEST['block_name'];
            $destination_master['status'] = $_REQUEST['status'];
			
			            if (empty($_REQUEST['block_id'])) {

                $this->Master_model->add('block_master', $destination_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['block_id']));
                $this->Master_model->updateData('block_master', $destination_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/block');
        }
    }
    /* #END Add/Update tahsil */
	
	   /* village List */
    public function village($data = NULL)
    {
        $data['ar_dist_details'] = $this->Master_model->get_district_details('');
        /* #END Getting work item type master list */

        /* Getting tehsil  list */
        $data['ar_destination_details'] = $this->Master_model->get_village_details('');
        /* #END Getting tehsil list */
		
        if (!empty($_REQUEST['village_id'])) {
            $village_id = base64_decode($_REQUEST['village_id']);
            $data['village_id'] = $village_id;
            $data['village_detail_edit'] = $this->Master_model->get_village_details($village_id);

        }
        $this->load->common_template('master/village', $data);
    }
    /* #END village List */
    /* Add/Update village */
    public function add_village()
    {
        if (!empty($_REQUEST['submit'])) {

            $destination_master = array();
            $destination_master['district_id'] = $_REQUEST['district_id'];
            $destination_master['tahsil_id'] = $_REQUEST['tehsil_id'];
            $destination_master['village_name'] = $_REQUEST['village_name'];
            $destination_master['status'] = $_REQUEST['status'];
			
			            if (empty($_REQUEST['village_id'])) {

                $this->Master_model->add('village_master', $destination_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['village_id']));
                $this->Master_model->updateData('village_master', $destination_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/village');
        }
    }
    /* #END Add/Update village */
	
	public function gettehsilList(){

	$district_id = $this->input->post('district_id');
	
	if($district_id!=''){
		$data['all_div']= $this->Master_model->get_tehsil_all($district_id);
		//print_r($data['all_state']);
			echo json_encode($data);
	}else{
					
	}

}


	   /* division List */
    public function ulb($data = NULL)
    {
        $data['ar_dist_details'] = $this->Master_model->get_district_details('');
        /* #END Getting work item type master list */

        /* Getting destination  list */
        $data['ar_destination_details'] = $this->Master_model->get_ulb_details('');
        /* #END Getting destination list */
		
        if (!empty($_REQUEST['ulb_id'])) {
            $division_id = base64_decode($_REQUEST['ulb_id']);
            $data['ulb_id'] = $division_id;
            $data['ulb_detail_edit'] = $this->Master_model->get_ulb_details($ulb_id);

        }
        $this->load->common_template('master/ulb', $data);
    }
    /* #END division List */

    /* Add/Update division */
    public function add_ulb()
    {
        if (!empty($_REQUEST['submit'])) {

            $destination_master = array();
            $destination_master['district_id'] = $_REQUEST['district_id'];
            $destination_master['ulb_name'] = $_REQUEST['ulb_name'];
            $destination_master['status'] = $_REQUEST['status'];
			
			            if (empty($_REQUEST['ulb_id'])) {

                $this->Master_model->add('ulb_master', $destination_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['ulb_id']));
                $this->Master_model->updateData('ulb_master', $destination_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/ulb');
        }
    }
    /* #END Add/Update division */
	
	 /* Wing List */
    public function wing($data = NULL)
    {        
	$data['ar_dis_details'] = $this->Master_model->get_wing_details('');

        /* #END Getting ngo master list */
        if (!empty($_REQUEST['wing_id'])) {
            $wing_id = base64_decode($_REQUEST['wing_id']);
            $data['wing_id'] = $wing_id;
            $data['wing_detail_edit'] = $this->Master_model->get_wing_details($wing_id);
        }
        $this->load->common_template('master/wing', $data);

    }
    /* #END District List */

    /* Add/Update District */
    public function add_wing()
    {
        if (!empty($_REQUEST['submit'])) {
            $area_master = array();
            $area_master['wing_name'] = $_REQUEST['wing_name'];
            $area_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['wing_id'])) {
                $this->Master_model->add('wing_master', $area_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('id' => base64_decode($_REQUEST['wing_id']));
                $this->Master_model->updateData('wing_master', $area_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/wing');
        }
    }
	 /* designation List */
    public function designation($data = NULL)
    {        
	$data['ar_dis_details'] = $this->Master_model->get_designation_details('');

        /* #END Getting ngo master list */
        if (!empty($_REQUEST['designation_id'])) {
            $designation_id = base64_decode($_REQUEST['designation_id']);
            $data['designation_id'] = $designation_id;
            $data['designation_detail_edit'] = $this->Master_model->get_designation_details($designation_id);
        }
        $this->load->common_template('master/designation', $data);

    }
    /* #END District List */

    /* Add/Update District */
    public function add_designation()
    {
        if (!empty($_REQUEST['submit'])) {
            $area_master = array();
            $area_master['designation'] = $_REQUEST['designation_name'];
            $area_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['designation_id'])) {
                $this->Master_model->add('user_designation_master', $area_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('id' => base64_decode($_REQUEST['designation_id']));
                $this->Master_model->updateData('user_designation_master', $area_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/designation');
        }
    } 
	
	/* encroachment List */
    public function encroachment($data = NULL)
    {        
	$data['ar_dis_details'] = $this->Master_model->get_encroachment_details('');

        /* #END Getting ngo master list */
        if (!empty($_REQUEST['encroachment_id'])) {
            $encroachment_id = base64_decode($_REQUEST['encroachment_id']);
            $data['encroachment_id'] = $designation_id;
            $data['encroachment_detail_edit'] = $this->Master_model->get_encroachment_details($encroachment_id);
        }
        $this->load->common_template('master/encroachment', $data);

    }
    /* #END encroachment List */

    /* Add/Update encroachment */
    public function add_encroachment()
    {
        if (!empty($_REQUEST['submit'])) {
            $area_master = array();
            $area_master['name'] = $_REQUEST['encroachment_name'];
            $area_master['status'] = $_REQUEST['status'];
            if (empty($_REQUEST['encroachment_id'])) {
                $this->Master_model->add('encroachment_master', $area_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('id' => base64_decode($_REQUEST['encroachment_id']));
                $this->Master_model->updateData('encroachment_master', $area_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/encroachment');
        }
    }
	
	
    /* Email Recipient List */
    public function email_recipient($data = NULL)
    {

        /* Getting destination  list */
        $data['ar_recipient_details'] = $this->Master_model->get_recipient_details('');
        /* #END Getting destination list */
        if (!empty($_REQUEST['email_recipient_id'])) {
            $recipient_id = base64_decode($_REQUEST['email_recipient_id']);
            $data['recipient_id'] = $recipient_id;
            $data['recipient_detail_edit'] = $this->Master_model->get_recipient_details($recipient_id);

        }
        $this->load->common_template('master/email_recipient', $data);
    }
    /* #END Email Recipient List */
	
	
    public function add_email_recipient()
    {
        if (!empty($_REQUEST['submit'])) {

            $email_master = array();
            $email_master['email_id'] = $_REQUEST['email'];
            $email_master['name'] = $_REQUEST['name'];
            $email_master['status'] = $_REQUEST['status'];
			
			            if (empty($_REQUEST['email_recipient_id'])) {

                $this->Master_model->add('recipient_master', $email_master);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {

                $where = array('id' => base64_decode($_REQUEST['email_recipient_id']));
                $this->Master_model->updateData('recipient_master', $email_master, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Master/email_recipient');
        }
    }


}

?>