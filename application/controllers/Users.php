<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
    }

    public function index() {
        $this->load->view('index');
    }

    public function plogin() {
        $this->load->view('patient/plogin');
    }

    public function alogin() {
        $this->load->view('admin/login');
    }

    public function userproc() {
        $this->load->view('admin/users');
    }

    public function userlist() {
        $this->load->view('header/header');
        $this->load->view('admin/users');
        $this->load->view('admin/users_footer');
    }

    public function getuserList() {
        $limit = '';
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $order = ($this->input->get('order')[0]['column'] + 1) . " " . $this->input->get('order')[0]['dir'];
        $result = $this->users_model->getuserlistDb($start, $length, $order);
        header('Content-Type: application/json');
        print json_encode(array("draw" => $draw, "recordsTotal" => $result[1], "recordsFiltered" => $result[1], "data" => $result[0]));
    }

    //users process save,update,delete,select

    public function usercrud() {
        $return = array();
        if ($this->input->post('proc') == 'save') {
            $this->form_validation->set_rules('username', 'lang:username', 'required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('fullname', 'lang:fullname', 'required|min_length[5]');
            $this->form_validation->set_rules('password', 'lang:password', 'required|min_length[5]');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required|regex_match[/^\+[0-9]{10,12}$/]');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = 0;
            } else {
                $params = array();
                $params['username'] = $this->input->post('username');
                $params['fullname'] = $this->input->post('fullname');
                $params['password'] = hash($this->config->item('HASH_ALGO'), $this->input->post('password'));
                $params['role_id'] = $this->input->post('role_id');
                $params['email'] = $this->input->post('email');
                $params['phone'] = $this->input->post('phone');
                $result = $this->users_model->addUser($params);
                if (is_numeric($result) && $result > 0)
                    $return['id'] = $result;
                else
                    $return['errors'][] = $this->lang->line('database_error', FALSE);
            }
        }
        if ($this->input->post('proc') == 'del') {
            if (!$this->users_model->delUser(array('user_id' => $this->input->post('user_id'))))
                $return['errors'] = $this->db->error()['message'];
        }
        /*
         * User Update Table
         * 
         */

        if ($this->input->post('proc') == 'update') {

            $this->form_validation->set_rules('user_id', 'lang:user_id', 'required');
            $this->form_validation->set_rules('username', 'lang:username', 'required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('fullname', 'lang:fullname', 'required|min_length[5]');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required|regex_match[/^\+[0-9]{10,12}$/]');
            $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $return['errors'][] = validation_errors();
                $return['id'] = '';
            } else {
                $params = array();
                $params['username'] = $this->input->post('username');
                $params['fullname'] = $this->input->post('fullname');
                $params['role_id'] = $this->input->post('role_id');
                $params['email'] = $this->input->post('email');
                $params['phone'] = $this->input->post('phone');
                if (!$this->users_model->updateUser($params, array('user_id' => $this->input->post('user_id'))))
                    $return['errors'][] = $this->db->error()['message'];
            }
        }

        /*
         * User Table Select
         * 
         */

        if ($this->input->post('proc') == 'select') {
            $result = $this->users_model->selectUser(array('user_id' => $this->input->post('user_id')));
            $result['password'] = '';
            $return['errors'] = $this->db->error()['message'];
            $return['data'] = $result;
        }

        header('Content-Type: application/json');
        print json_encode($return);
    }

    public function aloginProc() {



        $username = $this->input->post('user');
        $password = hash($this->config->item('HASH_ALGO'), $this->input->post('password'));

        $result = $this->users_model->checkuser($username, $password);
        if (is_array($result)) {

            $data = array(
                'user_id' => $result['user_id'],
                'username' => $username,
                'fullname' => $result['fullname'],
                'type' => $result['role_id'],
                'logged' => true
            );
            $this->session->set_userdata($data);
            redirect('/admin/main');
        } else { // incorrect username or password
            $data['errors'][] = $this->lang->line('incorrect_user', FALSE);
            $this->load->view('admin/login', $data);
        }
    }

}
