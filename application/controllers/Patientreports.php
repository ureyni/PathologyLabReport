<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Patientreports extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('patientreports_model');

        if (!$this->session->userdata('logged_patient')) {
            redirect('patient/login');
        }
    }

    public function index() {
        $this->patientlist();
    }

    public function patientlist() {
        $this->load->view('header/header');
        $this->load->view('patient/reports');
        $this->load->view('patient/reports_footer');
    }

    public function getReportList() {
        $limit = '';
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $order = ($this->input->get('order')[0]['column'] + 1) . " " . $this->input->get('order')[0]['dir'];
        $result = $this->patientreports_model->getreportlist($start, $length, $order);
        header('Content-Type: application/json');
        print json_encode(array("draw" => $draw, "recordsTotal" => $result[1], "recordsFiltered" => $result[1], "data" => $result[0]));
    }

    public function getReportDetail() {
        $result = $this->patientreports_model->getreportdetail($this->input->post('report_id'));
        header('Content-Type: application/json');
        print json_encode($result);
    }

    /* Report Convert to Pdf via Dompdf Library */

    public function converttopdf() {
        $return = array();
        $this->form_validation->set_rules('report_id', 'lang:reportname', 'required');
        if ($this->form_validation->run() == FALSE) {
            header('Content-Type: application/json');
            print json_encode(array('errors' => validation_errors()));
            return;
        }
        $result = $this->patientreports_model->getreportdetail($this->input->post('report_id'));
        if (empty($result[0]['file_path']) || !file_exists($result[0]['file_path'])) {
            $html = '<html><head></head><body>';
            $html .= '<div class="box-body">
                    <div class="form-horizontal col-sm-12">
                        <h3 class="box-title"> ' . $this->config->item('LAB_NAME') . '</h3>
                        <h5 class="box-title"> ' . $this->config->item('LAB_ADDRESS_1') . '></h5>
                        <h5 class="box-title"> ' . $this->config->item('LAB_ADDRESS_2') . '></h5>
                        <h5 class="box-title"> E-mail:' . $this->config->item('LAB_EMAIL') . ' Phone:' . $this->config->item('LAB_PHONE') . '</h5>
                    </div>
                    <div id="divPatientDetail" class="form-horizontal col-sm-12">
                    <h4 class="box-title">Name : ' . $result[0]['fullname'] . ' Age : ' . $result[0]['age'] . ' Gender : ' . $result[0]['sex'] . ' E-Mail : ' . $result[0]['email'] . ' Phone : ' . $result[0]['phone'] . '</h4>
                    <h4 class="box-title">Rapor Name :' . $result[0]['report_name'] . '</h4>
                    <div class="box-header with-border"><i class="fa fa-text-width"></i><h3 class="box-title">Report Detail</h3></div>
                    </div>
                    <div id="divReportDetail" class="form-horizontal col-sm-12">';
            foreach ($result as $value) {
                $html .= '<h4 class="box-title">Test Name : ' . $value['test_name'] . '</h4>' . $value['test_value'];
            }
            $html .= '</div></div>';
            $html .= '</body></htmpl>';
            $this->load->library('PdfConverter', array('pdfhome' => $this->config->item('PDFHOME')));
            if ($pdffilename = $this->pdfconverter->dopdf($html)) {
                $this->patientreports_model->setpdffilename($this->input->post('report_id'), $pdffilename);
                $return['pdffile'] = basename($pdffilename);
            } else
                $return['errors'][] = "Can'nt Create Pdf file";
        }else
            $return['pdffile'] = basename($result[0]['file_path']);


        header('Content-Type: application/json');
        print json_encode($return);
    }

    /* Pdf Sent to Patient's email address as attach of email */

    public function senttopdf() {
        $return = array();
        $this->form_validation->set_rules('report_id', 'lang:reportname', 'required');
        $this->form_validation->set_rules('email', 'lang:email', 'required');
        if ($this->form_validation->run() == FALSE) {
            header('Content-Type: application/json');
            print json_encode(array('errors' => validation_errors()));
            return;
        }

        $recipient = preg_split("/[,;]+/", $this->input->post('email'));
        $is_valid = array();
        foreach ($recipient as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $is_valid[] = "$email is a invalid email address";
            }
        }

        if (count($is_valid) != 0) {
            header('Content-Type: application/json');
            print json_encode(array('errors' => $is_valid));
            return;
        }

        $options = array(
            'SMTP_HOST' => $this->config->item('SMTP_HOST'),
            'SMTP_PORT' => $this->config->item('SMTP_PORT'),
            'SMTP_USER' => $this->config->item('SMTP_USER'),
            'SMTP_PASS' => $this->config->item('SMTP_PASSWORD'),
            'SMTP_FROM' => $this->config->item('SMTP_FROM'),
            'SMTP_FROM_NAME' => $this->config->item('SMTP_FROM_NAME')
        );
        $this->load->library('SendMail', $options);

        if (($pdfinfo = $this->patientreports_model->getpdfinfo($this->input->post('report_id'))) != FALSE) {

            $subject = sprintf($this->lang->line('email_subject', FALSE), $this->config->item('LAB_NAME'));
            $body = sprintf($this->lang->line('email_body', FALSE), $this->config->item('LAB_NAME'), $this->config->item('LAB_ADDRESS_1'), $this->config->item('LAB_ADDRESS_2'), $this->config->item('LAB_EMAIL'), $this->config->item('LAB_PHONE'), $this->session->userdata('fullname'), $pdfinfo[0]['report_name']);

            if ($this->sendmail->sendtomail($recipient, $subject, $body, array(array('file_path' => $pdfinfo[0]['file_path'],
                            'file_name' => $pdfinfo[0]['report_name'] . ".pdf"))) == FALSE) {
                $return['errors'][] = $this->sendmail->errors;
            }
             $return['msg'] = 'Mail Sended';
        }
        header('Content-Type: application/json');
        print json_encode($return);
    }

    /* Pdf display new Windows */

    public function displaypdf() {

        if (!empty($this->input->get('pdf')) && file_exists($this->config->item('PDFHOME') . DIRECTORY_SEPARATOR . $this->input->get('pdf'))) {
            header('Content-Type: application/pdf');
            readfile($this->config->item('PDFHOME') . DIRECTORY_SEPARATOR . $this->input->get('pdf'));
        }else
            print "Pdf Can'nt Display";
    }

}
