<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Labreports extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('reports_model');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
    }

    public function index() {
        $this->reportlist();
    }

    public function reportlist() {
        $this->load->view('header/header');
        $this->load->view('admin/reports');
        $this->load->view('admin/reports_footer');
    }

    public function getreportdetailList() {
        $limit = '';
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $reportsid = $this->input->get('report_id');
        $reportsid = (empty($reportsid) ? '' : ' patient_reports.patient_reports_id=' . $reportsid);
        $order = ($this->input->get('order')[0]['column'] + 1) . " " . $this->input->get('order')[0]['dir'];
        $result = $this->reports_model->getreportdetaillistDb($start, $length, $reportsid, $order);
        header('Content-Type: application/json');
        print json_encode(array("draw" => $draw, "recordsTotal" => $result[1], "recordsFiltered" => $result[1], "data" => $result[0]));
    }

    public function getreportList() {
        $limit = '';
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $patientid = $this->input->get('patient_id');
        $patientid = (empty($patientid) ? '' : ' patient_id=' . $patientid);
        $order = ($this->input->get('order')[0]['column'] + 1) . " " . $this->input->get('order')[0]['dir'];
        $result = $this->reports_model->getreportlistDb($start, $length, $patientid, $order);
        header('Content-Type: application/json');
        print json_encode(array("draw" => $draw, "recordsTotal" => $result[1], "recordsFiltered" => $result[1], "data" => $result[0]));
    }

    /* patient search with like for ajax */

    public function psearch() {
        $return = array();
        $this->form_validation->set_rules('patientname', 'lang:patientname', 'min_length[5]');
        if ($this->form_validation->run() == FALSE) {
            $return['errors'][] = validation_errors();
        } else {
            $result = $this->reports_model->getpatientlist($this->input->post('patientname'));
            $return['data'] = $result;
        }
        header('Content-Type: application/json');
        print json_encode($return);
    }

     /* report sent to patient via sms or email */

    public function reportsendpatient() {
        $return = array();
        $this->form_validation->set_rules('reports_id', 'lang:reportname', 'required');
        if ($this->form_validation->run() == FALSE) {
            $return['errors'][] = validation_errors();
        } else {
            $result = $this->reports_model->patientcodecheck($this->input->post('reports_id'));
            $return['msg'] = "Dear ".$result[0]['fullname'].
                    " Phatology Test completed.you can see enter this "
                    .PHP_EOL."link : ".
                    base_url()." and click 'Pathology Reports Result' unit".PHP_EOL
                    .$this->lang->line('yourfullname', FALSE).":".$result[0]['fullname'].PHP_EOL
                    .$this->lang->line('yourpasscode', FALSE).":".$result[0]['code'];
        }
        header('Content-Type: application/json');
        print json_encode($return);
    }
    
    
    //Reports process save,update,delete,select

    public function reportcrud() {
        $return = array();

        /* Test types Table Insert  */
        if ($this->input->post('proc') == 'save') {
            $this->form_validation->set_rules('report_name', 'lang:reportname', 'required|min_length[5]|is_unique[patient_reports.report_name]');
            $this->form_validation->set_rules('report_date', 'lang:reportdate', 'required');
            $this->form_validation->set_rules('date_of_sample_received', 'lang:reportsampledate', 'required');
            $this->form_validation->set_rules('patient_id', 'lang:patientname', 'required');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = 0;
            } else {
                $params = array();
                $params['patient_id'] = $this->input->post('patient_id');
                $params['report_name'] = $this->input->post('report_name');
                $params['report_date'] = $this->input->post('report_date');
                $params['date_of_sample_received'] = $this->input->post('date_of_sample_received');
                $params['user_id'] = $this->session->userdata('user_id');
                $result = $this->reports_model->addReport($params);
                if (is_numeric($result) && $result > 0)
                    $return['id'] = $result;
                else
                    $return['errors'][] = $this->db->error()['message']; //$this->lang->line('database_error', FALSE);
            }
        }

        /* Test types Table Delete  */
        if ($this->input->post('proc') == 'del') {
            if (!$this->reports_model->delReport(array('patient_reports_id' => $this->input->post('patient_reports_id'))))
                $return['errors'] = $this->db->error()['message']; //$this->lang->line('database_error', FALSE);;
        }

        /* Test types Table Update  */

        if ($this->input->post('proc') == 'update') {

            $this->form_validation->set_rules('report_name', 'lang:reportname', 'required|min_length[5]');
            $this->form_validation->set_rules('report_date', 'lang:reportdate', 'required');
            $this->form_validation->set_rules('date_of_sample_received', 'lang:reportsampledate', 'required');
            $this->form_validation->set_rules('patient_id', 'lang:patientname', 'required');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = '';
            } else {
                $params = array();
                $params['patient_id'] = $this->input->post('patient_id');
                $params['report_name'] = $this->input->post('report_name');
                $params['report_date'] = $this->input->post('report_date');
                $params['date_of_sample_received'] = $this->input->post('date_of_sample_received');
                $params['user_id'] = $this->session->userdata('user_id');
                if (!$this->reports_model->updateReport($params, array('patient_reports_id' => $this->input->post('patient_reports_id'))))
                    $return['errors'][] = $this->lang->line('database_error', FALSE);;
            }
        }

        /*
         * Test types Table Select
         * 
         */

        if ($this->input->post('proc') == 'select') {
            $result = $this->reports_model->selectReport(array('patient_reports_id' => $this->input->post('patient_reports_id')));
            $return['errors'] = $this->db->error()['message'];
            $return['data'] = $result;
        }

        header('Content-Type: application/json');
        print json_encode($return);
    }

    //Report Detailsprocess save,update,delete,select

    public function reportdetailcrud() {
        $return = array();

        /* Report Details Table Insert  */
        if ($this->input->post('proc') == 'save') {
            $this->form_validation->set_rules('patient_reports_id', 'lang:patientname', 'required');
            $this->form_validation->set_rules('test_types_id', 'lang:test_name', 'required');
            $this->form_validation->set_rules('test_value', 'lang:test_result', 'required');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = 0;
            } else {
                $params = array();
                $params['patient_reports_id'] = $this->input->post('patient_reports_id');
                $params['test_types_id'] = $this->input->post('test_types_id');
                $params['test_value'] = $this->input->post('test_value');
                $params['user_id'] = $this->session->userdata('user_id');
                $result = $this->reports_model->addReportDetail($params);
                if (is_numeric($result) && $result > 0)
                    $return['id'] = $result;
                else
                    $return['errors'][] = $this->db->error()['message']; //$this->lang->line('database_error', FALSE);
            }
        }

        /* Report Details Table Delete  */
        if ($this->input->post('proc') == 'del') {
            if (!$this->reports_model->delReportDetail(array('patient_report_details_id' => $this->input->post('patient_report_details_id'))))
                $return['errors'] = $this->db->error()['message']; //$this->lang->line('database_error', FALSE);;
        }

        /* Report Details Table Update  */

        if ($this->input->post('proc') == 'update') {

            $this->form_validation->set_rules('patient_reports_id', 'lang:patientname', 'required');
            $this->form_validation->set_rules('test_types_id', 'lang:test_name', 'required');
            $this->form_validation->set_rules('test_value', 'lang:test_result', 'required');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = '';
            } else {
                $params = array();
                $params['patient_reports_id'] = $this->input->post('patient_reports_id');
                $params['test_types_id'] = $this->input->post('test_types_id');
                $params['test_value'] = $this->input->post('test_value');
                $params['user_id'] = $this->session->userdata('user_id');
                if (!$this->reports_model->updateReportDetail($params, array('patient_report_details_id' => $this->input->post('patient_report_details_id'))))
                    $return['errors'][] = $this->lang->line('database_error', FALSE);;
            }
        }

        /*
         * Report Details Table Select
         * 
         */

        if ($this->input->post('proc') == 'select') {
            $result = $this->reports_model->selectReportDetail(array('patient_report_details_id' => $this->input->post('patient_report_details_id')));
            $return['errors'] = $this->db->error()['message'];
            $return['data'] = $result;
        }

        header('Content-Type: application/json');
        print json_encode($return);
    }

}
