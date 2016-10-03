<?php

class Patientreports_model extends CI_Model {

    /**
     * get All Patients Reports from database
     * @param string Pagination $start 
     * @param string Pagination $length
     * @param string order by
     * @return $array
     */
    public function getreportlist($start = 0, $length = '', $order = "1 asc") {
        $rows = array();
        $count = 0;
        $this->db->select("patient_reports.*,users.fullname as 'username',patients.fullname")->from("patient_reports")
                ->join("users", "users.user_id = patient_reports.user_id")
                ->join("patients", "patients.patients_id= patient_reports.patient_id")
                ->where("patients.patients_id=" . $this->session->userdata('patient_id'));
        if ($this->db->order_by($order)->limit($start, $length)) {
            $rows = $this->db->get()->result_array();
            $count = $this->db->count_all_results();
        }
        return array($rows, $count);
    }

    /**
     * get one Reports Details from database
     * @param string Pagination $start 
     * @param string Pagination $length
     * @param string reports id for details
     * @param string order by
     * @return $array
     */
    public function getreportdetail($reportsid) {
        $this->db->select("patient_report_details.test_value,patients.fullname,patients.sex,patients.age,patients.phone,patients.email,"
                . "test_types.test_name,patient_reports.report_name,patient_reports.file_path")->from("patient_report_details")
                ->join("test_types", "test_types.test_types_id = patient_report_details.test_types_id")
                ->join("patient_reports", "patient_reports.patient_reports_id= patient_report_details.patient_reports_id")
                ->join("patients", "patients.patients_id= patient_reports.patient_id")
                ->where("patients.patients_id=" . $this->session->userdata('patient_id') . " and  patient_reports.patient_reports_id=$reportsid");
        return $this->db->get()->result_array();
    }

    /**
     * get one Reports Details from database
     * @param string Reports Id $reportsid 
     * @param string Pdf filename with path $pdfilename
     * @return $boolean
     */
    public function setpdffilename($reportsid, $pdfilename) {
        $this->db->where("patient_reports.patient_reports_id=$reportsid and patient_reports.patient_id=" . $this->session->userdata('patient_id'))
                ->limit(1);
        return $this->db->update("patient_reports", array("file_path" => $pdfilename));
    }

    /**
     * get one Reports Details from database
     * @param string Reports Id $reportsid 
     * @param string Pdf filename with path $pdfilename
     * @return $boolean
     */
    public function getpdfinfo($reportsid) {
        $this->db->where("patient_reports.patient_reports_id=$reportsid and patient_reports.patient_id=" . $this->session->userdata('patient_id'))
                ->limit(1);
        if ($row = $this->db->select('file_path,report_name')->from("patient_reports")->get()->result_array())
                return $row;
        return false;
    }

}
