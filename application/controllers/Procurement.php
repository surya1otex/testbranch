<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Procurement extends MY_Controller
{
    public $form_fields;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security'));

        $this->load->model('Procurement_model');
        $this->form_fields = array('project_name',
            'project_sector',
            'project_group',
            'project_code',
            'project_destination',
            'project_area',
            'file_no',
            'project_type',
            'tender_document_approval_date',
            'aa_date',
            'estimate_total_cost',
            'rfp_publishing_date',
            'rfp_closing_date');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
    }


    public function index()
    {

    }

    public function procurement_list()
    {

        $project_details_arr = $this->Procurement_model->getAllProjects($this->session->userdata('id'));
        $data['project_deatail'] = $project_details_arr;
        $this->load->inner_template('procurement/project_list', $data);

    }

    public function pre_tender_stage($data = [])
    {

        $data = [];
        $data['project_id'] = $project_id = base64_decode($_REQUEST['project_id']);
        if (!empty($project_id)) {

            $data['result'] = $this->Procurement_model->getProjectDetails($project_id);

            $data['super_visor_dtl'] = $this->Procurement_model->getProjectUsers($project_id);
            $data['submit_status'] = $this->checkFormStatus($project_id);

        }
        $data['sectors'] = $this->Procurement_model->getProjectSector();
        $data['groups'] = $this->Procurement_model->getProjectGroup();

        $data['project_destinations'] = [];
        $data['project_area'] = $this->Procurement_model->getAllArea();
        $data['project_type'] = $this->Procurement_model->getAllProjectType();
        $data['user_type'] = $this->Procurement_model->getAllUserType();

        $data['user_name'] = $this->Procurement_model->getAllUserName();

        $html_usertype = '';
        foreach ($data['user_type'] as $type) {
            $html_usertype .= '<option value="' . $type['id'] . '">' . $type['designation'] . '</option>';
        }
        $data['html_usertype'] = $html_usertype;

        $html_username = '';
        foreach ($data['user_name'] as $type) {
            $html_username .= '<option value="' . $type['uid'] . '">' . $type['firstname'] . ' ' . $type['lastname'] . '</option>';
        }
        $data['html_username'] = $html_username;


        $this->form_validation->set_rules('project_name', 'Project’s name', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->inner_template('procurement/pre_tender_stage', $data);
        } else {

            $post_user_type = $_REQUEST['user_type'];
            $post_user_name = $_REQUEST['user_name'];


            $db_data['project_name'] = $_REQUEST['project_name'];
            $db_data['project_sector'] = $_REQUEST['project_sector'];
            $db_data['project_group'] = $_REQUEST['project_group'];
            $db_data['project_code'] = $_REQUEST['project_code'];
            $db_data['project_destination'] = $_REQUEST['project_destination'];
            $db_data['project_area'] = $_REQUEST['project_area'];
            $db_data['estimate_total_cost'] = $_REQUEST['estimate_total_cost'];
            $db_data['project_type'] = $_REQUEST['project_type'];
            $db_data['file_no'] = $_REQUEST['file_no'];
            $db_data['aa_date'] = $_REQUEST['aa_date'];
            $db_data['tender_document_approval_date'] = $_REQUEST['tender_document_approval_date'];
            $db_data['rfp_publishing_date'] = $_REQUEST['rfp_publishing_date'];
            $db_data['rfp_closing_date'] = $_REQUEST['rfp_closing_date'];
            $db_data['tender_document_approved'] = $_REQUEST['tender_document_approved'];
            $db_data['tender_call_no'] = $_REQUEST['tender_call_no'];
            $db_data['re_tender_status'] = $_REQUEST['re_tender_status'];
            $db_data['remarks_for_retender'] = $_REQUEST['remarks_for_retender'];
            $db_data['remarks_pre_tender'] = $_REQUEST['remarks_pre_tender'];

            $db_data['project_creator_id'] = $this->session->userdata('id');
            $db_data['modified_by'] = 0;

            if (empty($project_id)) {
                /*$db_data['organization_id'] = $this->Procurement_model->getOrganizationId($this->session->userdata('id'));
                $inserted_project_id = $result = $this->Procurement_model->addPreTender($db_data);
                $redirect_project_id = $inserted_project_id;*/

            } else {
                $db_data['modified_by'] = $this->session->userdata('id');
                $redirect_project_id = $inserted_project_id = $db_data['project_id'] = $project_id;

                $result = $this->Procurement_model->updatePreTender($db_data);
            }

            foreach ($post_user_type as $key => $val) {
                if ($val == 'Select User Type') {
                    unset($_REQUEST['user_type']);
                    unset($_REQUEST['user_name']);
                    break;
                }
                $insert_arr[] = array('user_id' => $post_user_name[$key],
                    'designation_id' => $val,
                    'project_id' => $inserted_project_id,
                    'status' => 'Y');
            }
            $this->Procurement_model->insert_Project_users($insert_arr, $project_id);
            if ($result) {

                redirect('Procurement/pre_tender_stage?project_id=' . base64_encode($redirect_project_id));
            }
        }


    }

    public function getDestination()
    {
        if ($_REQUEST['area_id']) {
            $destination_arr = $this->Procurement_model->getDestinationByArea($_REQUEST['area_id']);

            $html = ' <select id="project_destination" name="project_destination" class="form-control show-tick">
                      <option value="">Select Destination</option>';

            foreach ($destination_arr as $destination) {
                $html .= "<option value=" . $destination['id'] . ">" . $destination['name'] . "</option>";
            }
        }
        echo json_encode($html);
        exit;
    }

    public function checkFormStatus($project_id, $table = 'project_detail')
    {

        if ($table == 'tender_details') {
            $this->form_fields = array('final_date_rfp_publish',
                'final_date_rfp_close', 'tech_bid_opening_date', 'finance_bid_opening_date', 'agreement_date',
                'agreement_cost', 'agreement_end_date', 'bidder_details', 'representative_name', 'bg_amount', 'bg_validity_date', 'other_bidder_details');
        }
        $res = $this->Procurement_model->checkFieldStatus($this->form_fields, $project_id, $table);


        foreach ($res[0] as $key => $val) {

            $flag = 0;
            if ($val == '' || $val == '0000-00-00' || $val = 0) {

                $flag++;

            }
            if ($flag > 0) {
                break;
            }
        }

        return ($flag > 0 || count($res) == 0) ? false : true;
    }

    public function tender_stage($data = [])
    {

        $data = [];
        $project_id = base64_decode($_REQUEST['project_id']);
        if (!empty($project_id)) {

            $data['project_id'] = $project_id;

            $data['submit_status'] = $this->checkFormStatus($project_id, 'tender_details');
            $res = $this->Procurement_model->getProjectDetails($project_id);
            $res['group_name'] = $this->Procurement_model->getGroupName($res['project_group']);
            $res['sector_name'] = $this->Procurement_model->getSectorName($res['project_sector']);
            $res['project_type_name'] = $this->Procurement_model->getProjectTypeName($res['project_type']);
            $res['project_destination_name'] = $this->Procurement_model->getDestinationName($res['project_destination']);
            $res['project_area_name'] = $this->Procurement_model->getAreaName($res['project_area']);
            $data['result'] = $res;

            $arr = $this->Procurement_model->getTenderDetails($project_id);
            $data['result_tender'] = $arr[0];
            $data['tender_id'] = $data['result_tender']['id'];
        }
        $this->form_validation->set_rules('final_date_rfp_publish', 'Date of revised/Final publising date', 'required');


        if ($this->form_validation->run() == FALSE) {

            $this->load->inner_template('procurement/tender_stage', $data);
        } else {

            $data = [];

            $data['final_date_rfp_publish'] = $_REQUEST['final_date_rfp_publish'];
            $data['final_date_rfp_close'] = $_REQUEST['final_date_rfp_close'];
            $data['tech_bid_opening_date'] = $_REQUEST['tech_bid_opening_date'];
            $data['finance_bid_opening_date'] = $_REQUEST['finance_bid_opening_date'];
            $data['agreement_date'] = $_REQUEST['agreement_date'];
            $data['agreement_cost'] = $_REQUEST['agreement_cost'];
            $data['agreement_end_date'] = $_REQUEST['agreement_end_date'];
            $data['bidder_details'] = $_REQUEST['bidder_details'];
            $data['representative_name'] = $_REQUEST['representative_name'];
            $data['bg_amount'] = $_REQUEST['bg_amount'];
            $data['other_bidder_details'] = $_REQUEST['other_bidder_details'];
            $data['bg_validity_date'] = $_REQUEST['bg_validity_date'];
            $data['project_id'] = base64_decode($_REQUEST['project_id']);

            if (!empty($_REQUEST['tender_id'])) {
                $data['tender_id'] = base64_decode($_REQUEST['tender_id']);
                $data['project_id'] = base64_decode($_REQUEST['project_id']);

                $result = $this->Procurement_model->updateTender($data);
            } else {
                $result = $this->Procurement_model->addTender($data);
            }

            if ($result) {

                redirect('Procurement/tender_stage?project_id=' . $_REQUEST['project_id']);

            }
        }


    }

    public function final_step()
    {
        $data = [];
        $project_id = base64_decode($_REQUEST['project_id']);
        if (!empty($project_id)) {

            $data['project_id'] = $project_id;

            $data['submit_status'] = $this->checkFormStatus($project_id, 'tender_details');
            $res = $this->Procurement_model->getProjectDetails($project_id);
            $res['group_name'] = $this->Procurement_model->getGroupName($res['project_group']);
            $res['sector_name'] = $this->Procurement_model->getSectorName($res['project_sector']);
            $res['project_type_name'] = $this->Procurement_model->getProjectTypeName($res['project_type']);
            $res['project_destination_name'] = $this->Procurement_model->getDestinationName($res['project_destination']);
            $res['project_area_name'] = $this->Procurement_model->getAreaName($res['project_area']);
            $data['result'] = $res;

            $arr = $this->Procurement_model->getTenderDetails($project_id);
            $data['result_tender'] = $arr[0];
            $data['tender_id'] = $data['result_tender']['id'];
            if (!empty($_REQUEST['submit'])) {

                $val['extra_remarks'] = trim($_REQUEST['extra_remarks']);
                $val['status'] = 'Y';
                $val['project_id'] = $project_id;
                $this->Procurement_model->addFinalRemarks($val);
                
            }
        }
        $data['extra_remarks'] = $this->Procurement_model->getExtraRemarks($project_id);

        $this->load->inner_template('procurement/final', $data);
    }

}

?>