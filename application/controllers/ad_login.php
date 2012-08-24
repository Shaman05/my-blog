<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-8-24
     * Time: 上午09:27
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Ad_login extends CI_Controller {

        function index(){
            $this->session->sess_destroy();
            $admin = $this->input->post('admin');
            $pwd = $this->input->post('pwd');
            if(isset($admin) && isset($pwd)){
                $blog = new Myblog();
                if(($admin == $blog->admin) && ($pwd == $blog->loginPwd)){
                    $this->session->set_userdata("loginAdmin", "shaman");
                    header("Location:ad_index");
                }
            }
            $this->load->view("admin/ad_login.html");
        }
    }