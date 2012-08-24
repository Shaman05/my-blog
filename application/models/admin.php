<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-8-23
     * Time: 上午10:29
     * To change this template use File | Settings | File Templates.
     */
    
    Class Admin extends CI_Model{

        function __construct(){
            parent::__construct();
        }

        function get_admin(){
            $sql = 'select * from admin limit 1';
            $query = $this->db->query($sql);
            return $query->row_array();
        }

        function artList(){
            $sql = 'select * from article order by pub_date desc';
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function comment(){
            $sql = 'select * from comment order by c_time desc';
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function flink(){
            $sql = 'select * from flinks order by add_time desc';
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        function get_flink($fid){
            $sql = 'select * from flinks where id="'.$fid.'" limit 1';
            $query = $this->db->query($sql);
            return $query->row_array();
        }
    }