<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-8-2
     * Time: 下午09:22
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Aboutme extends CI_Controller {

        public $header = array(),
               $page = array(),
               $footer = array();

        public function index(){
            $blog = new Myblog();

            //当前页数据

            //header和footer
            $header['title'] = $blog->name . ' - 关于我';
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('blog/header', $header);
            $this->load->view('blog/aboutme');
            $this->load->view('blog/footer', $footer);
        }

    }