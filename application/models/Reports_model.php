<?php

class Reports_model extends CI_Model {

    /**
     * get All Reports from database
     * @param string Pagination $start 
     * @param string Pagination $length
     * @param string patient_id
     * @param string order by
     * @return $array
     */
    public function getreportlistDb($start = 0, $length = '', $where = '', $order = "1 asc") {
        $rows = array();
        $count = 0;
        $this->db->select("patient_reports.*,users.fullname as 'username',patients.fullname")->from("patient_reports")
                ->join("users", "users.user_id = patient_reports.user_id")
                ->join("patients", "patients.patients_id= patient_reports.patient_id");
        if (!empty($where))
            $this->db->where($where);

        if ($this->db->order_by($order)->limit($start, $length)) {
            $rows = $this->db->get()->result_array();
            $count = $this->db->from('patient_reports')->count_all_results();
        }
        return array($rows, $count);
    }

    /**
     * get All Reports Details from database
     * @param string Pagination $start 
     * @param string Pagination $length
     * @param string reports id for details
     * @param string order by
     * @return $array
     */
    public function getreportdetaillistDb($start = 0, $length = '', $where = '', $order = "1 asc") {
        $rows = array();
        $count = 0;
        $this->db->select("patient_report_details.*,users.fullname as 'username',patients.fullname,test_types.test_name,patient_reports.report_name")->from("patient_report_details")
                ->join("users", "users.user_id = patient_report_details.user_id")
                ->join("test_types", "test_types.test_types_id = patient_report_details.test_types_id")
                ->join("patient_reports", "patient_reports.patient_reports_id= patient_report_details.patient_reports_id")
                ->join("patients", "patients.patients_id= patient_reports.patient_id");

        if (!empty($where))
            $this->db->where($where);

        if ($this->db->order_by($order)->limit($start, $length)) {
            $rows = $this->db->get()->result_array();
            $count = $this->db->from('patient_reports')->count_all_results();
        }
        return array($rows, $count);
    }

    /**
     * get Reports with like willcards
     * @param string patientname values
     * @return $boolean
     */
    public function getpatientlist($patientname) {
        $rows = array();
        if ($this->db->select("patients_id,fullname,sex,age,email,phone")->from("patients")->like("fullname", $patientname)->limit(10)) {
            $rows = $this->db->get()->result_array();
        }
        return $rows;
    }

    public function patientcodecheck($reportsid) {
        $rows = false;
        if ($this->db->select("patients_id,code,fullname,email,phone")->from("patients")
                        ->join("patient_reports", "patients.patients_id= patient_reports.patient_id")
                        ->where("patient_reports.patient_reports_id", $reportsid)->limit(1)) {
            $rows = $this->db->get()->result_array();
            if (empty($rows[0]['code'])) {
                $code = md5(uniqid($rows[0]["patients_id"]));
                $code = strtoupper(substr($code, 0, 10));
                $rows[0]['code'] = $code;
                $this->db->where(array("patients_id"=>$rows[0]["patients_id"]));
                if ($this->db->update('patients', array('code'=>$code)))
                    return $rows;
                else
                    return false;
            } else
                return $rows;
        }
        return $rows;
    }

    /**
     * insert Reports from database
     * @param array insert values
     * @return $boolean
     */
    public function addReport($params) {
        if ($this->db->insert('patient_reports', $params))
            return $this->db->insert_id();
        else
            return false;
    }

    /**
     * delete test types from database
     * @param array delete id values
     * @return $boolean
     */
    public function delReport($params) {
        if ($this->db->delete('patient_reports', $params))
            return true;
        else
            return false;
    }

    /**
     * update test types on database
     * @param array update values
     * @return $boolean
     */
    public function updateReport($params, $where) {
        $this->db->where($where);
        if ($this->db->update('patient_reports', $params))
            return true;
        else
            return false;
    }

    /**
     * select Reports on database
     * @param array select id values
     * @return $boolean
     */
    public function selectReport($params) {
        if ($result = $this->db->from('patient_reports')->where($params)->get()->result_array())
            return $result;
        else
            return false;
    }

    /*     * ********************************
     *   * ********** Report Details ************************* 
     * ***********************************     */

    /**
     * insert Reports from database
     * @param array insert values
     * @return $boolean
     */
    public function addReportDetail($params) {
        if ($this->db->insert('patient_report_details', $params))
            return $this->db->insert_id();
        else
            return false;
    }

    /**
     * delete test types from database
     * @param array delete id values
     * @return $boolean
     */
    public function delReportDetail($params) {
        if ($this->db->delete('patient_report_details', $params))
            return true;
        else
            return false;
    }

    /**
     * update test types on database
     * @param array update values
     * @return $boolean
     */
    public function updateReportDetail($params, $where) {
        $this->db->where($where);
        if ($this->db->update('patient_report_details', $params))
            return true;
        else
            return false;
    }

    /**
     * select Reports on database
     * @param array select id values
     * @return $boolean
     */
    public function selectReportDetail($params) {
        if ($result = $this->db->from('patient_report_details')->where($params)->get()->result_array())
            return $result;
        else
            return false;
    }

}
