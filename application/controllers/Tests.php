<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('tests_model');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
    }

    public function index() {
        $this->testlist();
    }

    public function testlist() {
        $this->load->view('header/header');
        $this->load->view('admin/testtypes');
        $this->load->view('admin/testtypes_footer');
    }

    public function getTestTList() {
        $limit = '';
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $order = ($this->input->get('order')[0]['column'] + 1) . " " . $this->input->get('order')[0]['dir'];
        $result = $this->tests_model->gettestlistDb($start, $length, $order);
        header('Content-Type: application/json');
        print json_encode(array("draw" => $draw, "recordsTotal" => $result[1], "recordsFiltered" => $result[1], "data" => $result[0]));
    }

    //Test Types process save,update,delete,select

    public function testTcrud() {
        $return = array();
        
        /* Test types Table Insert  */
        if ($this->input->post('proc') == 'save') {
            $this->form_validation->set_rules('test_name', 'lang:test_name', 'required|min_length[5]|is_unique[test_types.test_name]');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = 0;
            } else {
                $params = array();
                $params['test_name'] = $this->input->post('test_name');
                $params['explain'] = $this->input->post('explain');
                $params['user_id'] = $this->session->userdata('user_id');
                $result = $this->tests_model->addTestT($params);
                if (is_numeric($result) && $result > 0)
                    $return['id'] = $result;
                else
                    $return['errors'][] = $this->lang->line('database_error', FALSE);
            }
        }
        
        /* Test types Table Delete  */
        if ($this->input->post('proc') == 'del') {
            if (!$this->tests_model->delTestT(array('test_types_id' => $this->input->post('test_types_id'))))
                $return['errors'] = $this->lang->line('database_error', FALSE);;
        }
        
        /* Test types Table Update  */

        if ($this->input->post('proc') == 'update') {

            $this->form_validation->set_rules('test_name', 'lang:test_name', 'required|min_length[5]');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = '';
            } else {
                $params = array();
                $params['test_name'] = $this->input->post('test_name');
                $params['explain'] = $this->input->post('explain');
                if (!$this->tests_model->updateTestT($params, array('test_types_id' => $this->input->post('test_types_id'))))
                    $return['errors'][] = $this->lang->line('database_error', FALSE);;
            }
        }

        /*
         * Test types Table Select
         * 
         */

        if ($this->input->post('proc') == 'select') {
            $result = $this->tests_model->selectTestT(array('test_types_id' => $this->input->post('test_types_id')));
            $return['errors'] = $this->db->error()['message'];
            $return['data'] = $result;
        }

        header('Content-Type: application/json');
        print json_encode($return);
    }


}
