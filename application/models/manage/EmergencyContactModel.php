<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class EmergencyContactModel extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

//end constructor

    function getSingleList($table, $filter = array()) {

        if (trim($table) != "" && trim($table) != null && count($filter) > 0) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($filter);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row();
            }
        }//end check condition		
        return array();
    }

// end getSingleList function

    public function make_query($params = array(), $filter = array(), $orderBy = array(), $count_only = 0) {

        if ($count_only == 1) {
            $this->db->select('count(1) as total_row');
        } else {
            $this->db->select('um.*,  concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
            $this->db->join('comm_admin cm', 'cm.admin_id = um.contact_added_by','left');
            $this->db->join('comm_admin cm1', 'cm1.admin_id = um.contact_edited_by','left');
        }


        $this->db->from($params['table'] . ' um');
        
        if (isset($params['search']['district']) && trim($params['search']['district']) != "") {
            $this->db->where('um.contact_district', trim($params['search']['district']));
        }
        if (isset($params['search']['status']) && trim($params['search']['status']) != "") {
            $this->db->where('um.contact_status', trim($params['search']['status']));
        }
       

        
       


        if (count($filter) > 0) {
            $this->db->where($filter);
        }

        //sort data by ascending or desceding order
        if (isset($params['search']['sortBy']) && trim($params['search']['sortBy']) != "") {
            $this->db->order_by('um.contact_id', $params['search']['sortBy']);
        }

        if (count($orderBy) > 0) {
            foreach ($orderBy as $key => $val) {
                $this->db->order_by($key, $val);
            }
        }
    }

//end make_query function

    public function make_datatable($params = array(), $filter = array(), $orderBy = array()) {

        $this->make_query($params, $filter, $orderBy);
        //set start and limit
        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        $query = $this->db->get();
        /* print_r($this->db->last_query());
        exit;*/
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

//end make_datatables function  

    public function get_filtered_data($params = array(), $filter = array(), $orderBy = array()) {
        $count_only = 1;
        $this->make_query($params, $filter, $orderBy, $count_only);
        $query = $this->db->get();
        //print_r($this->db->last_query());
        return ($query->num_rows() > 0) ? $query->row()->total_row : 0;
    }

//end get_filtered_data function  

    
}
