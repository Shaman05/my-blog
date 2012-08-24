<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-7-30
     * Time: 下午09:12
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Ad_index extends CI_Controller {

        function index(){
            $session = $this->session->userdata('loginAdmin');
            if($session !== FALSE){
                $this->load->view("admin/ad_index.html");
            }else{
                header("Location:ad_login");
            }
        }
    }