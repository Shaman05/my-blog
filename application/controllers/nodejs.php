<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-8-2
     * Time: 下午10:03
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Nodejs extends CI_Controller {

        public $header = array(),
               $page = array(),
               $footer = array();

        public function index(){
            $blog = new Myblog();

            //header和footer
            $header['title'] = $blog->name . ' - Nodejs';
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('header', $header);
            $this->load->view('index');
            $this->load->view('footer', $footer);
        }

    }