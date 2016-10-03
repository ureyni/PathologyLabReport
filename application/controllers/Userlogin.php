<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userlogin extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
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

    /* admin and operator users login */

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

    /* patients  users login */

    public function ploginProc() {
        $fullname = $this->input->post('fullname');
        $code = $this->input->post('code');

        $result = $this->users_model->checkpatient($fullname, $code);
        if (is_array($result)) {

            $data = array(
                'patient_id' => $result['patients_id'],
                'username' => $username,
                'fullname' => $result['fullname'],
                'logged_patient' => true
            );
            $this->session->set_userdata($data);
            redirect('/patient/main');
        } else { // incorrect username or password
            $data['errors'][] = $this->lang->line('incorrect_user', FALSE);
            $this->load->view('patient/plogin', $data);
        }
    }

    /* users signout login */

    public function signout() {
            $this->session->sess_destroy();
            redirect('/patient/main');
    }


}
