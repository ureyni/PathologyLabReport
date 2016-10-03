<?php

class Tests_model extends CI_Model {

    /**
     * get All Test Types from database
     * @param string Pagination $start 
     * @param string Pagination $length
     * @param string order by
     * @return $array
     */
    public function gettestlistDb($start = 0, $length, $order = "1 asc") {
        $this->db->from("test_types")
                ->join("users", "users.user_id = test_types.user_id")
                ->order_by($order)
                ->limit($start, $length);
        $rows = $this->db->get()->result_array();
        $count = $this->db->from('test_types')->count_all_results();
        return array($rows, $count);
    }

    /**
     * insert Test Types from database
     * @param array insert values
     * @return $boolean
     */
    public function addTestT($params) {
        if ($this->db->insert('test_types', $params))
            return $this->db->insert_id();
        else
            return false;
    }

    /**
     * delete test types from database
     * @param array delete id values
     * @return $boolean
     */
    public function delTestT($params) {
        if ($this->db->delete('test_types', $params))
            return true;
        else
            return false;
    }

    /**
     * update test types on database
     * @param array update values
     * @return $boolean
     */
    public function updateTestT($params, $where) {
        $this->db->where($where);
        if ($this->db->update('test_types', $params))
            return true;
        else
            return false;
    }

    /**
     * select Test Types on database
     * @param array select id values
     * @return $boolean
     */
    public function selectTestT($params) {
        if ($result = $this->db->from('test_types')->where($params)->get()->result_array())
            return $result;
        else
            return false;
    }

}
