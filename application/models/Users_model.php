<?php

class Users_model extends CI_Model {

    /**
     * User check with the database
     * @param string $username
     * @param string $password
     * @return $array or false
     */
    function checkuser($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $row = $this->db->get('users')->row_array();
        if (!empty($row['user_id'])) {
            return $row;
        }
        return false;
    }

    /**
     * patient check with the database
     * @param string $fullname
     * @param string $code
     * @return $array or false
     */
    function checkpatient($fullname, $code) {
        $this->db->where('fullname', $fullname);
        $this->db->where('code', $code);
        $row = $this->db->get('patients')->row_array();
        if (!empty($row['fullname'])) {
            return $row;
        }
        return false;
    }
    
    
    /**
     * get All User from database
     * @param string Pagination $start 
     * @param string Pagination $length
     * @param string order by
     * @return $array
     */
    public function getuserlistDb($start = 0, $length, $order = "1 asc") {
        $this->db->from("users")
                ->join("roles", "roles.role_id = users.role_id")
                ->order_by($order)
                ->limit($start, $length);
        $rows = $this->db->get()->result_array();
        $count = $this->db->from('users')->count_all_results();
        return array($rows, $count);
    }

    /**
     * insert User from database
     * @param array insert values
     * @return $boolean
     */
    public function addUser($params) {
        if ($this->db->insert('users', $params))
            return $this->db->insert_id();
        else
            return false;
    }

    /**
     * delete User from database
     * @param array delete id values
     * @return $boolean
     */
    public function delUser($params) {
        if ($this->db->delete('users', $params))
            return true;
        else
            return false;
    }

    /**
     * update User on database
     * @param array update values
     * @return $boolean
     */
    public function updateUser($params, $where) {
        $this->db->where($where);
        if ($this->db->update('users', $params))
            return true;
        else
            return false;
    }

    /**
     * select User on database
     * @param array select id values
     * @return $boolean
     */
    public function selectUser($params) {
        if ($result = $this->db->from('users')->where($params)->get()->result_array())
            return $result;
        else
            return false;
    }

    /**
     * Validate the login's data with the database
     * @param string $fullname
     * @param string $passcode
     * @return void
     */
    function validatePatient($fullname, $passcode) {
        $this->db->where('fullname', $fullname);
        $this->db->where('passcode', $passcode);
        $query = $this->db->get('patients');

        if ($query->num_rows == 1) {
            return true;
        }
    }

    /**
     * Validate the login's data with the database
     * @param string $fullname
     * @param string $passcode
     * @return void
     */
    function getPatientDetails($fullname, $passcode) {
        $this->db->where('fullname', $fullname);
        $this->db->where('passcode', $passcode);
        $query = $this->db->get('patients');
        return $query->result_array();
    }

    /**
     * Serialize the session data stored in the database, 
     * store it in a new array and return it to the controller 
     * @return array
     */
    function get_db_session_data() {
        $query = $this->db->select('user_data')->get('ci_sessions');
        $user = array(); /* array to store the user data we fetch */
        foreach ($query->result() as $row) {
            $udata = unserialize($row->user_data);
            /* put data in array using username as key */
            $user['user_name'] = $udata['user_name'];
            $user['is_logged_in'] = $udata['is_logged_in'];
        }
        return $user;
    }

    /**
     * Store the new user's data into the database
     * @return boolean - check the insert
     */
    function create_member() {

        $this->db->where('username', $this->input->post('username'));
        $query = $this->db->get('users');

        if ($query->num_rows > 0) {
            echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
            echo "Username already taken";
            echo '</strong></div>';
        } else {

            $new_member_insert_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email_addres' => $this->input->post('email_address'),
                'user_name' => $this->input->post('username'),
                'pass_word' => md5($this->input->post('password'))
            );
            $insert = $this->db->insert('membership', $new_member_insert_data);
            return $insert;
        }
    }

//create_member
}
