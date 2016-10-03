<?php

class Patients_model extends CI_Model {

    /**
     * get All Patients from database
     * @param string Pagination $start 
     * @param string Pagination $length
     * @param string order by
     * @return $array
     */
    public function getpatientlistDb($start = 0, $length = '', $order = "1 asc") {
        $rows = array();
        $count = 0;
        if ($this->db->select("patients.*,users.fullname as 'username'")->from("patients")
                        ->join("users", "users.user_id = patients.user_id")
                        ->order_by($order)
                        ->limit($start, $length)) {
            $rows = $this->db->get()->result_array();
            $count = $this->db->from('patients')->count_all_results();
        }
        return array($rows, $count);
    }

    /**
     * insert Patients from database
     * @param array insert values
     * @return $boolean
     */
    public function addPatient($params) {
        if ($this->db->insert('patients', $params))
            return $this->db->insert_id();
        else
            return false;
    }

    /**
     * delete test types from database
     * @param array delete id values
     * @return $boolean
     */
    public function delPatient($params) {
        if ($this->db->delete('patients', $params))
            return true;
        else
            return false;
    }

    /**
     * update test types on database
     * @param array update values
     * @return $boolean
     */
    public function updatePatient($params, $where) {
        $this->db->where($where);
        if ($this->db->update('patients', $params))
            return true;
        else
            return false;
    }

    /**
     * select Patients on database
     * @param array select id values
     * @return $boolean
     */
    public function selectPatient($params) {
        if ($result = $this->db->from('patients')->where($params)->get()->result_array())
            return $result;
        else
            return false;
    }

}
