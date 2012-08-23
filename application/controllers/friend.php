<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-8-1
     * Time: 下午08:41
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Friend extends CI_Controller {

        public $header = array(),
               $page = array(),
               $footer = array();

        public function index(){
            $blog = new Myblog();

            //header和footer
            $header['title'] = $blog->name . ' - 网上邻居';
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('blog/header', $header);
            $this->load->view('blog/friend');
            $this->load->view('blog/footer', $footer);
        }

    }