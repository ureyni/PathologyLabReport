<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('patients_model');

        if (!$this->session->userdata('logged')) {
            redirect('patient/login');
        }
    }

    public function index() {
        $this->patientlist();
    }

    public function patientlist() {
        $this->load->view('header/header');
        $this->load->view('admin/patients');
        $this->load->view('admin/patients_footer');
    }

    public function getpatientList() {
        $limit = '';
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $order = ($this->input->get('order')[0]['column'] + 1) . " " . $this->input->get('order')[0]['dir'];
        $result = $this->patients_model->getpatientlistDb($start, $length, $order);
        header('Content-Type: application/json');
        print json_encode(array("draw" => $draw, "recordsTotal" => $result[1], "recordsFiltered" => $result[1], "data" => $result[0]));
    }
    
        //Test Types process save,update,delete,select

    public function patientcrud() {
        $return = array();

        /* Test types Table Insert  */
        if ($this->input->post('proc') == 'save') {
            $this->form_validation->set_rules('fullname', 'lang:patientname', 'required|min_length[5]|is_unique[patients.fullname]');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required|regex_match[/^\+[0-9]{10,12}$/]');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
            $this->form_validation->set_rules('sex', 'lang:sex', 'required');
            $this->form_validation->set_rules('age', 'lang:age', 'required|max_length[3]|min_length[1]|numeric');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = 0;
            } else {
                $params = array();
                $params['fullname'] = $this->input->post('fullname');
                $params['email'] = $this->input->post('email');
                $params['phone'] = $this->input->post('phone');
                $params['sex'] = $this->input->post('sex');
                $params['age'] = $this->input->post('age');
                $params['code'] = $this->input->post('code');
                $params['user_id'] = $this->session->userdata('user_id');
                $result = $this->patients_model->addPatient($params);
                if (is_numeric($result) && $result > 0)
                    $return['id'] = $result;
                else
                    $return['errors'][] = $this->db->error()['message'];//$this->lang->line('database_error', FALSE);
            }
        }

        /* Test types Table Delete  */
        if ($this->input->post('proc') == 'del') {
            if (!$this->patients_model->delPatient(array('patients_id' => $this->input->post('patients_id'))))
                $return['errors'] = $this->db->error()['message'];//$this->lang->line('database_error', FALSE);;
        }

        /* Test types Table Update  */

        if ($this->input->post('proc') == 'update') {

            $this->form_validation->set_rules('fullname', 'lang:patientname', 'required|min_length[5]');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required|regex_match[/^\+[0-9]{10,12}$/]');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
            $this->form_validation->set_rules('sex', 'lang:sex', 'required');
            $this->form_validation->set_rules('age', 'lang:age', 'required|max_length[3]|min_length[1]|numeric');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = '';
            } else {
                $params = array();
                $params['fullname'] = $this->input->post('fullname');
                $params['email'] = $this->input->post('email');
                $params['phone'] = $this->input->post('phone');
                $params['sex'] = $this->input->post('sex');
                $params['age'] = $this->input->post('age');
                $params['code'] = $this->input->post('code');
                $params['user_id'] = $this->session->userdata('user_id');
                if (!$this->patients_model->updatePatient($params, array('patients_id' => $this->input->post('patients_id'))))
                    $return['errors'][] = $this->lang->line('database_error', FALSE);;
            }
        }

        /*
         * Test types Table Select
         * 
         */

        if ($this->input->post('proc') == 'select') {
            $result = $this->patients_model->selectPatient(array('patients_id' => $this->input->post('patients_id')));
            $return['errors'] = $this->db->error()['message'];
            $return['data'] = $result;
        }

        header('Content-Type: application/json');
        print json_encode($return);
    }

}
