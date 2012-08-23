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
            $this->load->view("admin/ad_index.html");
        }
    }